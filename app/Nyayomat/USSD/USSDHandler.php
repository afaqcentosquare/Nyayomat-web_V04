<?php


namespace App\Nyayomat\USSD;

use App\Customer;
use App\Nyayomat\USSD\Actions\HomeAction;
use App\Nyayomat\USSD\Actions\LoginAction;
use App\Nyayomat\USSD\Actions\WelcomeAction;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;

class USSDHandler
{
    const CACHE_FOR = 5;

    private $sessionId;
    private $serviceCode;
    private $phoneNumber;
    private $text = '';

    private $currency;
    private $balance;
    private $unInvestedAmount;
    private $userFund;
    private $userProduct;
    private $billOption;
    private $lockInDays;
    private $withdrawalFee;
    private $withdrawalUnits;
    private $ownedUnits;
    private $newApplicationId;
    private $cytonnPhone = '0724808805';

    protected $actions = [
        ];

    /**
     * USSDHandler constructor.
     * @param $sessionId
     * @param $serviceCode
     * @param $phoneNumber
     * @param $text
     * @throws Exception
     */
    public function __construct($sessionId, $serviceCode, $phoneNumber, $text)
    {
        $this->sessionId = $sessionId;
        $this->serviceCode = $serviceCode;
        $this->phoneNumber = $phoneNumber;
        $this->text = $text;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function handle()
    {
        if ($this->text == '' && $this->allowNullInput()) {
            return $this->handleFirst();
        }

        return $this->handleCont();
    }

    /**
     * @return mixed
     * @throws Exception
     */
    private function handleCont()
    {
        $session = $this->getSessionData();

        $action = $session['action'] ? $session['action'] : null;

        if (!$action) {
            return $this->resetMenu();
        }

        return $this->render(new $action($this));
    }

    /**
     * @return bool
     * @throws Exception
     */
    private function allowNullInput()
    {
        $session = $this->getSessionData();

        // will allow if its the first step
        return is_null($session['step']);
    }

    /**
     * @param null $key
     * @return mixed
     * @throws Exception
     */
    public function getSessionData($key = null)
    {
        $data = cache()->get('sessionId_' . $this->sessionId);

        if (!$data) {
            $data = $this->buildSessionData();
        }

        return Arr::get($data, $key);
    }

    private function buildSessionData()
    {
        return [
            'reset_menu' => '',
            'action' => '',
            'data' => [],
            'step' => null,
            'user_id' => null
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    private function handleFirst()
    {
        /** Activate only when doing live testing**/
        //if ($this->platformUnderTesting()) {
        //  return $this->render(new TestingPlatformAction($this));
        //}

        if ($this->checkUserExists()) {
            return $this->render(new LoginAction($this));
        }

        return $this->render(new WelcomeAction($this));
    }

    /**
     * @return bool
     * @throws Exception
     */
    private function checkUserExists()
    {
        $userExists = $this->getUserQuery()
            ->exists();

        if (!$userExists) {
            return false;
        }

        $user = $this->getUserQuery();

        return (bool)$user;
    }

    private function getUserQuery()
    {
        list($phone_alt, $phone, $phone_country_code) = $this->cleanUpForm();

        return Customer::where('mobile', $phone);
    }

    /**
     * @param $key
     * @param $value
     * @throws Exception
     */
    public function setSessionData($key, $value)
    {
        $array = $this->getSessionData();

        Arr::set($array, $key, $value);

        $this->createCache($array);
    }

    /**
     * @param null $data
     * @throws Exception
     */
    public function createCache($data = null)
    {
        $data = is_null($data) ? $this->buildSessionData() : $data;

        cache()->put('sessionId_' . $this->sessionId, $data, Carbon::now()->addMinutes(15));
    }

    /**
     * @return array
     */
    protected function cleanUpForm(): array
    {
        $phone = ltrim($this->getPhoneNumber(), '+');
        $phone = ltrim($phone, '254');
        $phone = ltrim($phone, '0');

        $phone_alt = '0' . $phone;
        $phone_country_code = '254' . $phone;
        $phone_plus = '+254' . $phone;

        return array($phone, $phone_alt, $phone_country_code, $phone_plus);
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function getText()
    {
        return $this->text;
    }

    /**
     * @param null $action
     * @return array
     * @throws Exception
     */
    public function resetMenu($action = null)
    {
        $this->setSessionData('reset_menu', $this->text);
        $user_id = $this->getSessionData('user_id');

        if (!$action) {
            return $user_id ?
                $this->render(new HomeAction($this))
                : $this->handleFirst();
        }

        return $this->render(new $action($this));
    }

    /**
     * @param Action $action
     * @return array
     * @throws Exception
     */
    private function render(Action $action)
    {
        return $action->handle();
    }

    /**
     * @throws Exception
     */
    public function forgetSession()
    {
        cache()->forget('sessionId_' . $this->getSessionId());
    }

    public function validateNames($input)
    {
        $names = explode(" ", $input);

        $longNames = array_filter($names, function ($name) {
            return strlen($name) > 2;
        });

        return count($longNames) >= 2;
    }

    /**
     * @return Customer
     */
    public function getUser()
    {
        return $this->getUserQuery()->first();
    }
}