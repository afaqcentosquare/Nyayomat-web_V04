<?php


namespace App\Http\Controllers\Nyayomat;


class SMSIntegration
{
    public static function sendSMSNotification($phoneNumbers, $message)
    {
        // Specify your authentication credentials
        $username = env('AFRICASTALKING_USERNAME');
        $apikey = env('AFRICASTALKING_API_KEY');
        $from_ = env('AFRICASTALKING_SENDER_ID');

        // Specify the numbers that you want to send to in a comma-separated list
        // Please ensure you include the country code (+254 for Kenya in this case)
        $recipients = $phoneNumbers;
        // And of course we want our recipients to know what we really do

        // Create a new instance of our awesome gateway class
        $gateway = new AfricaStalkingGateway($username, $apikey);
        /*************************************************************************************
         * NOTE: If connecting to the sandbox:
         * 1. Use "sandbox" as the username
         * 2. Use the apiKey generated from your sandbox application
         * https://account.africastalking.com/apps/sandbox/settings/key
         * 3. Add the "sandbox" flag to the constructor
         * $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
         **************************************************************************************/
        // Any gateway error will be captured by our custom Exception class below,
        // so wrap the call in a try-catch block
        try {
            // Thats it, hit send and we'll take care of the rest.
            $results = $gateway->sendMessage($recipients, $message, $from_);
//
//            foreach ($results as $result) {
//                // status is either "Success" or "error message"
//                echo " Number: " . $result->number;
//                echo " Status: " . $result->status;
//                echo " MessageId: " . $result->messageId;
//                echo " Cost: " . $result->cost . "\n";
//            }
        } catch (\Exception $e) {
            //echo "Encountered an error while sending: " . $e->getMessage();
        }

        @ob_clean();
    }
}