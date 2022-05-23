<?php


namespace App\Nyayomat\USSD\Actions;


use App\Nyayomat\Repositories\UserRepository;
use App\Nyayomat\USSD\Action;
use App\Nyayomat\USSD\USSDHandler;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateAccount extends Action
{

    public function steps()
    {
        return [
            [
                'query' => 'Please enter your preferred Username/Nickname:',
                'field' => 'name',
                'post' => 'verifyInput'
            ],
            [
                'query' => '{confirmMessage}',
                'pre' => 'getDetailsToConfirm',
                'post' => 'confirmDetails',
                'field' => 'details_confirmed'
            ],
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function nextAction()
    {
        $msg = "SUCCESS! " .
            "You've been awarded free 10 points. Shop with Nyayomat to earn more!";

        return $this->respond($msg, 'end');
    }

    /**
     * @param $step
     * @return bool|object
     * @throws Exception
     */
    protected function verifyInput($step)
    {
        $input = $this->latestInput();

        if ($input == '') {
            return (object)[
                'status' => false,
                'message' => 'Incorrect input, try again ' . PHP_EOL . $step['query']
            ];
        }

        return true;
    }

    /**
     * @param $step
     * @return bool|object
     * @throws Exception
     */

    protected function confirmDetails($step)
    {
        $input = $this->latestInput();

        if ($input == 1) {

            $this->saveApplicationAccountDetails($this->handler);

            return true;
        }

        if ($input == 2) {
            return (object)[
                'status' => 'reset'
            ];
        }

        $msg = 'Incorrect input, try again ' . PHP_EOL . $step['query'];

        return (object)[
            'status' => false,
            'message' => $msg
        ];
    }

    /**
     * @param $step
     * @param null $message
     * @return array
     * @throws \Exception
     */
    protected function getDetailsToConfirm($step, $message = null)
    {
        $data = $this->handler->getSessionData('data');

        $message = 'Please confirm your details:' . PHP_EOL . PHP_EOL .
            'Username/Nickname: ' . $data['name'] . PHP_EOL ;

        $message .= PHP_EOL . '1: CONFIRM ' . '2: CHANGE DETAILS';

        return $this->respond($message, 'con');
    }

    private function saveApplicationAccountDetails(USSDHandler $handler)
    {
        $data = $handler->getSessionData('data');

        $phone = ltrim($handler->getPhoneNumber(), '+');
        $phone = ltrim($phone, '254');

        $phone = '0' . $phone;

        $input = [
            'mobile' => $phone,
            'name' => $data['name']
        ];

        DB::transaction(function () use ($input) {
            $userRepository = new UserRepository();

            $customer = $userRepository->createClient($input);

            $userRepository->pinProvision($customer);
        });

        return true;
    }
}