<?php


namespace App\Nyayomat\USSD\Actions;


use App\Nyayomat\USSD\Action;
use Exception;

class HomeAction extends Action
{
    /**
     * @throws Exception
     */
    public function steps()
    {
        return [
            [
                'query' => 'Select  Option:' . PHP_EOL .
                    '1. My Account.',
                'post' => 'confirmOption',
                'pre' => 'getAccount',
                'field' => 'home_option'
            ]
        ];
    }

    public function nextAction()
    {
        $input = $this->handler->getSessionData('data.home_option');

        switch ($input) {
            case '1':
                return $this->redirect(MyAccountAction::class);
                break;
            default:
                return $this->redirect(HomeAction::class);
        }
    }

    /**
     * @param $step
     * @return array
     * @throws Exception
     */
    protected function getAccount($step)
    {
        $user = $this->handler->getUser();

        $message = str_replace('{name}', $user->name, $step['query']);

//        if ($this->handler->getClientsAccounts()->count() > 1) {
//            $message .= PHP_EOL . '0: BACK ';
//        }

        return $this->respond($message, 'con');
    }

    /**
     * @param $step
     * @return bool|object
     * @throws Exception
     */
    protected function confirmOption($step)
    {
        $input = $this->latestInput();

        if ($input === '0') {
            return (object)[
                'status' => 'back'
            ];
        }

        if ($input === '00') {
            return (object)[
                'status' => 'reset'
            ];
        }

        if ($input <= 0 || $input > 5) {
            return (object)[
                'status' => false,
                'message' => 'Incorrect input. ' . $step['query']
            ];
        }


        return (object)[
            'status' => 'skip',
            'steps' => 1
        ];
    }
}