<?php


namespace App\Nyayomat\USSD;


abstract class Action
{
    protected $handler;

    const CACHE_FOR = 120;

    /**
     * Action constructor.
     * @param $handler
     */
    public function __construct(USSDHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function handle()
    {
        $this->handler->setSessionData('action', static::class);

        return $this->handleAction();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function handleAction()
    {
        $step = $this->getCurrentStep();

        $post = $this->processPostStep($step);


        if ($post && !$post->status) {
            return $this->repeatStep($step, $post->message);
        }


        if ($post && ($post->status === 'reset' || $post->status === 'redirect')) {
            $action = null;
            if (isset($post->action)) {
                $action = $post->action;
            }

            $this->reset();
            return $this->handler->resetMenu($action);
        }

        if ($post && $post->status === 'end') {
            return $this->respond($post->message, 'end');
        }

        $newStep = $this->advanceToNextStep();

        if ($post && $post->status === 'back') {
            $steps = 2;
            if (isset($post->steps)) {
                $steps = $post->steps;
            }

            $newStep = $this->returnToPreviousStep($steps);
        }

        if ($post && $post->status === 'skip') {
            $skips = 1;
            if (isset($post->steps)) {
                $skips = $post->steps;
            }

            $newStep = $this->advanceToNextStep($skips);
        }

        if (is_null($newStep)) {
            return $this->nextAction();
        }

        return $this->processPreStep($newStep);
    }

    abstract public function steps();

    abstract public function nextAction();

    /**
     * @param $text
     * @param $type
     * @return array
     * @throws \Exception
     */
    protected function respond($text, $type)
    {
        if (!in_array($type, ['con', 'end'])) {
            throw new \InvalidArgumentException("Type can only be con or end");
        }

        if ($type == 'end') {
            $this->forgetSession();
        }

        return ['text' => $text, 'type' => $type];
    }

    protected function latestInput()
    {
        return last(explode('*', $this->handler->getText()));
    }

    /**
     * @throws \Exception
     */
    protected function forgetSession()
    {
        $this->handler->forgetSession();
    }

    /**
     * @return |null
     * @throws \Exception
     */
    protected function getCurrentStep()
    {
        $step = $this->handler->getSessionData('step');

        if (is_null($step)) {
            return null;
        }

        $max = count($this->steps()) - 1;

        if ($step > $max) {
            return null;
        }

        return $this->steps()[$step];
    }


    /**
     * @param int $skips
     * @return |null
     * @throws \Exception
     */
    protected function advanceToNextStep($skips = 1)
    {
        $step = $this->handler->getSessionData('step');

        if (is_null($step)) {
            $step = - 1;
        }

        $next = $step + $skips;

        if ($next <= (count($this->steps()) - 1)) {
            $this->handler->setSessionData('step', $next);
            return $this->steps()[$next];
        }

        return null;
    }

    /**
     * @param $steps
     * @return |null
     * @throws \Exception
     */
    protected function returnToPreviousStep($steps)
    {
        $step = $this->handler->getSessionData('step');

        if (is_null($step)) {
            $step = 0;
        }

        $previous = $step - $steps;

        $previous = $previous < 0 ? 0 : $previous;

        if ($previous <= (count($this->steps()) - 1)) {
            $this->handler->setSessionData('step', $previous);
            return $this->steps()[$previous];
        }

        return null;
    }


    /**
     * @throws \Exception
     */
    protected function reset()
    {
        $this->handler->setSessionData('step', null);
        $this->handler->setSessionData('data', []);
    }


    /**
     * @param $action
     * @return array
     * @throws \Exception
     */
    protected function redirect($action)
    {
        $this->reset();

        return $this->handler->resetMenu($action);
    }

    /**
     * @param $step
     * @return object
     * @throws \Exception
     */
    protected function processPostStep($step)
    {
        if (is_null($step)) {
            return (object)[
                'status' => true,
                'message' => ''
            ];
        }

        if (isset($step['post'])) {
            $resp = $this->{$step['post']}($step);

            $skipping = isset($resp->status) ? $resp->status === 'skip' : false;

            if ($resp === true || $skipping) {
                $this->handler->setSessionData('data.' . $step['field'], $this->latestInput());
            }

            if ($resp === true) {
                return (object)[
                    'status' => true,
                    'message' => ''
                ];
            }

            return $resp;
        }

        $this->handler->setSessionData('data.' . $step['field'], $this->latestInput());

        return (object)[
            'status' => true,
            'message' => ''
        ];
    }

    /**
     * @param $step
     * @return array
     * @throws \Exception
     */
    protected function processPreStep($step)
    {
        if (!isset($step['pre'])) {
            return $this->respond($step['query'], 'con');
        }

        return $this->{$step['pre']}($step);
    }

    /**
     * @param $step
     * @param null $message
     * @return array
     * @throws \Exception
     */
    protected function repeatStep($step, $message = null)
    {
        if (!$message) {
            $message = $step['query'];
        }

        if (!isset($step['pre'])) {
            return $this->respond($message, 'con');
        }

        $step['query'] = $this->respond($message, 'con')['text'];

        return $this->{$step['pre']}($step, $message);
    }
}