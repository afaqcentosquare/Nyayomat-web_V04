<?php


namespace App\Nyayomat\Notifications;


use App\Helpers\Messaging;
use App\Http\Controllers\Nyayomat\SMSIntegration;

class SendMessages
{
    const TERMS_LINK = "https://nyayomat.com";
    /**
     * Create a new job instance.
     *
     * @param $phone
     * @param $type
     * @param array $data
     */
    public function __construct($phone, $type, $data = [])
    {
        $this->phone = $phone;

        $this->type = $type;

        $this->data = $data;
    }

    public function sendNotification()
    {
        switch ($this->type) {
            case 'on-boarding-customer':
                $this->onBoardCustomer();
                break;
            case 'pin-reset':
                    $this->onPinReset();
                    break;
            default:
                return false;
        }
    }

    private function onBoardCustomer()
    {
        $message = "Thank you for joining Nyayomat. " .
            "Dial *483*616#  and use {pin} as your PIN. " .
            "Visit us at {link}. " ;

        $message = $this->setVars($message);

        SMSIntegration::sendSMSNotification($this->phone,$message);
    }
    
    private function onPinReset()
    {
        $message = "PIN successfully reset. " .
            "Dial *483*616#  and use {pin} as your new PIN. " ;

        $message = $this->setVars($message);

        SMSIntegration::sendSMSNotification($this->phone,$message);
    }

    /**
     * @param string $message
     * @return string|string[]
     */
    protected function setVars(string $message)
    {
        $message = str_replace("{link}", static::TERMS_LINK, $message);
        $message = str_replace("{name}", $this->data['name'], $message);
        $message = str_replace("{pin}", $this->data['pin'], $message);
        return $message;
    }
}