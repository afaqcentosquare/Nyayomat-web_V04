<?php


namespace App\Nyayomat\USSD\Actions;


use App\Nyayomat\USSD\Action;

class WelcomeAction extends Action
{
    public function steps()
    {
        return [
            [
                'query' => 'Welcome to Nyayomat. Please choose an action:' . PHP_EOL . PHP_EOL .
                    '1. Join Nyayomat' ,
                'post' => 'confirmOptions',
                'field' => 'welcome_option',
            ]
        ];
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function nextAction()
    {
        return $this->redirect(CreateAccount::class);
    }

    protected function confirmOptions($step)
    {
        $input = $this->latestInput();

        if ($input == 1) {
            return true;
        }

        $msg = 'Incorrect input, try again ' . PHP_EOL . $step['query'];

        return (object)[
            'status' => false,
            'message' => $msg
        ];
    }
}