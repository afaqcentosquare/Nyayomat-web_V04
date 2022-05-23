<?php


namespace App\Nyayomat\USSD\Actions;


use App\Nyayomat\Repositories\UserRepository;
use App\Nyayomat\USSD\Action;
use App\Nyayomat\USSD\USSDHandler;
use Illuminate\Support\Facades\DB;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ChangePin extends Action
{

    public function steps()
    {
        return [
            [
                'query' => 'Please enter 4 digit pin',
                'field' => 'pin',
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
          "You've changed your PIN!";

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

        $message = 'Please confirm your PIN:' . PHP_EOL . PHP_EOL .
            'New PIN: ' . $data['pin'] . PHP_EOL ;

        $message .= PHP_EOL . '1: CONFIRM ' . '2: CHANGE PIN';

        return $this->respond($message, 'con');
    }

    private function saveApplicationAccountDetails(USSDHandler $handler)
    {
        $data = $this->handler->getSessionData('data');

         $input = [
            'pin' => $data['pin']
        ];
 //       DB::transaction(function () use ($input) {
//            $userRepository = $this->handler->getUser()->mobile;
//
  //          $customer = $userRepository->updateClient($input);
            
 //           $customer->update(['pin' => $pin]);

  //          $userRepository->pinChange($customer);
  //      });

  //      return true;
    }
}
