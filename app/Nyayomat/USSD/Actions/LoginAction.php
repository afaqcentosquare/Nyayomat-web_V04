<?php


namespace App\Nyayomat\USSD\Actions;


use App\Customer;
use App\Nyayomat\USSD\Action;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Nyayomat\AfricaStalkingGateway;

class LoginAction extends Action
{

    public function steps()
    {
        return [
            [
                'query' => '{welcome_message}',
                'pre' => 'checkUserActive',
                'post' => 'confirmLoginDetails',
                'field' => 'pin'
            ],
        ];
    }

    public function nextAction()
    {
        return $this->redirect(MyAccountAction::class);
    }


    /**
     * @param $step
     * @return array
     * @throws \Exception
     */
    protected function checkUserActive($step)
    {
        $query = $step['query'];

        $user = $this->handler->getUser();

        if (!is_null($user)) {
            $str = 'Welcome to Nyayomat. Please Enter your PIN' . PHP_EOL . PHP_EOL .
                '00: Change or Reset PIN' . PHP_EOL;

            $q = str_replace('{welcome_message}', $str, $query);

            return $this->respond($q, 'con');
        }
    }

    /**
     * @param $step
     * @return bool|object
     * @throws \Exception
     */
    protected function confirmLoginDetails($step)
    {
        $input = $this->latestInput();

        if ($input === '00') {
              $user = $this->handler->getUser();
              $pin = rand(1001, 9998);
              $user->update(['pin' => $pin]);
              $phone = $this->handler->getUser()->mobile;
              $gateway = new AfricaStalkingGateway('nyuser', '70e507c620ba25c1d84d87119fbb974964cac3a9bdc220930bf5b396a2d322ed');
              $gateway->sendMessage($phone,'Reset successful!. New Nyayomat pin is:  ' . $pin . '.');
        }

        $user = $this->handler->getUser();

        if ($this->tooManyAttempts($user)) {
            return (object)[
                'status' => 'end',
                'message' => 'Too many incorrect PIN attempts. Try again after one hour.'
            ];
        }

        if (!($this->verifyPin(trim($input)))) {
            $this->incrementAttempts($user);

            return (object)[
                'status' => false,
                'message' => 'Try again with new pin. ' . $step['query']
            ];
        }

        $this->resetAttempts($user);

        $this->handler->setSessionData('user_id', $this->handler->getUser()->id);

        return true;
    }

    private function authKey(Customer $user)
    {
        return 'ussd_user_auth_attempts_' . $user->id;
    }

    /**
     * @param Customer $user
     * @return bool
     * @throws \Exception
     */
    private function tooManyAttempts(Customer $user)
    {
        $attempts = (int)cache()->get($this->authKey($user));

        return $attempts >= 3;
    }

    /**
     * @param Customer $user
     * @throws \Exception
     */
    private function incrementAttempts(Customer $user)
    {
        $key = $this->authKey($user);

        if (!cache()->has($key)) {
            cache([$key => 1], Carbon::now()->addHour());
        }

        $attempts = (int)cache()->get($key);

        cache([$key => $attempts + 1], Carbon::now()->addHour());
    }


    /**
     * @param Customer $user
     * @throws \Exception
     */
    private function resetAttempts(Customer $user)
    {
        cache([$this->authKey($user) => 0], Carbon::now()->addMinutes(15));
    }

    /**
     * @param $input
     * @return bool
     */
    protected function verifyPin($input)
    {
        $user = $this->handler->getUser();

        return (Hash::check($input, $user->pin));
    }
}
