<?php


namespace App\Nyayomat\USSD\Actions;


use App\Nyayomat\USSD\Action;

class MyAccountAction extends Action
{

    public function steps()
    {
        return [
            [
                'query' => 'Choose option:' . PHP_EOL .
                    '1. Check Nyayo Points' . PHP_EOL .
                    '2. Change PIN' . PHP_EOL .
                    '3. Exit' ,
                'post' => 'confirmChoiceOption',
                'field' => 'choice_option'
            ],
        ];
    }

    public function nextAction()
    {
        $input = $this->handler->getSessionData('data.choice_option');

        switch ($input) {
            case '1':
                  $msg = $this->handler->getUser()->points;
                  return $this->respond('You have ' . $msg . ' nyayo points.' . PHP_EOL . 
                          '1. Check points' . PHP_EOL .
                          '2. Change PIN' . PHP_EOL .
                          '3. Exit' , 'con');
                break;
            case '2':
                  return $this->redirect(ChangePin::class);
                break;
            case '3':
                  return $this->respond('Welcome again to Nyayomat.', 'end');
            default:
                return $this->redirect(MyAccountAction::class);
        }
    }

    public function confirmChoiceOption()
    {
        return true;
    }
}