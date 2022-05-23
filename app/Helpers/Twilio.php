<?php

namespace App\Helpers;

use DB;
use App\Disbursement;
use Auth;
use App\User;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

/**
 * Provide integrations to whatsapp messaging via AfricasTalking
 */
class Twilio
{
    const OPT_IN = 'OptIn';
    const OPT_OUT = 'OptOut';


    public static function clientAuthentication($customerNumber)
    {
        $sid = env('TWILIO_ID');
        $token = env('TWILIO_TOKEN');
        $response = new VoiceResponse;
        $response->say("Hello World!");

        header("content-type: text/xml");
        echo $response;
        $client = new Client($sid, $token);
    }

    public static function sendClientMessage($customerNumber,$message)
    {
        $sid = env('TWILIO_ID');
        $token = env('TWILIO_TOKEN');
        $channelNumber = env('TWILIO_NUMBER');

        $twilio = new Client($sid, $token);
        $message = $twilio->messages
            ->create(
                "whatsapp:".$customerNumber, // to
                [
                    "from" => "whatsapp:".$channelNumber,
                    "body" => $message
                ]
            );

        print($message->sid);
    }

    /**
     * Send Client Consent Request request
     *
     */
    public static function clientConsentRequest($customerNumber)
    {
        $url = env('AFRICASTALKING_CONSENT_URL');
        $username = env('AFRICASTALKING_USERNAME');
        $channel = 'WhatsApp';
        $channelNumber = env('AFRICASTALKING_CHANNEL_NUMBER');


        $curl_post_data = array(
            'username' => $username,
            'customerNumber' => $customerNumber,
            'channel' => $channel,
            'channelNumber' => $channelNumber,
            'action' => Whatsapp::OPT_IN
        );

        $data_string = json_encode($curl_post_data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'apiKey:' . env('AFRICASTALKING_API_KEY'),
            'Content-Type:application/json',
            'Accept:application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        return $curl_response;
        /**
         * Json Response
         * {
         *      'status': 'OptInRequestSent'
         *      'statusCode':'101'
         *      'description':'Request was processed successfully'
         *      'customerId':'ATZCid_JaneCustomerId'
         * }
         */
    }


    /**
     * Send Client Consent Request request
     *
     */
    public static function sendMaytapiMessage($customerNumber,$message)
    {
        $maytapiUrl = env('MAYTAPI_BASE_URL');
        $phone_id = env('MAYTAPI_PHONE_ID');
        $product_id = env('MAYTAPI_PRODUCT_ID');
        $token = env('MAYTAPI_TOKEN');
        $type = "media";
        $logo = "https://nyayomat.com/images/logo.png";
        $url = $maytapiUrl . "/" . $phone_id . "/sendMessage";


        $curl_post_data = array(
            'message' => $logo,
            'text' => $message,
            'to_number' => $customerNumber,
            'type' => $type
        );

        $data_string = json_encode($curl_post_data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'x-maytapi-key:' . $token,
            'Content-Type:application/json',
            'Accept:application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        return $curl_response;
        /**
         * Json Response
         * {
         *      'success': 'true'
         *      'data':{
         *          "chatId": "254722149301@c.us",
         *          "msgId": "82e1cdf0-da1b-11ea-a95e-fd4a31935faa"
         *       }
         * }
         */
    }

    public static function returnJsonError($payload)
    {
        echo json_encode($payload);
        exit();
    }


    public static function formatPhoneNumber($mobile_number)
    {
        $mobile_number = ltrim($mobile_number, '+');
        $mobile_number = ltrim($mobile_number, '254');
        $mobile_number = ltrim($mobile_number, '0');
        return '+254' . $mobile_number;
    }
}
