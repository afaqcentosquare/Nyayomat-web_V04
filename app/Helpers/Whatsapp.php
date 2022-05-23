<?php

namespace App\Helpers;

use DB;
use App\Disbursement;
use Auth;
use App\User;

/**
         * Provide integrations to whatsapp messaging via AfricasTalking
         */
class Whatsapp



{
    const OPT_IN = 'OptIn';
    const OPT_OUT = 'OptOut';

    /**
     * Register validation and confirmation urls
     * 
     */


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
     * Send client message
     *
     */
    public static function sendClientMessage($customerNumber, $message)
    {
        $url = env('AFRICASTALKING_MESSAGING_URL');
        $username = env('AFRICASTALKING_USERNAME');
        $channel = 'WhatsApp';
        $channelNumber = env('AFRICASTALKING_CHANNEL_NUMBER');
        $productId = env('AFRICASTALKING_PRODUCT_ID');


        $curl_post_data = array(
            'username' => $username,
            'customerNumber' => $customerNumber,
            'productId' => $productId,
            'channel' => $channel,
            'channelNumber' => $channelNumber,
            'body' =>  $message
            /**
             * TextMessageBody
             * {
             * 	"type": "Text",
             * 	"text": "We have processed payment for your loan"
             * }
             */
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
         *      "status": "Sent",
         *      "statusCode": 101,
         *      "description": "The message has been sent",
         *      "customerId": "ATZMid_JaneCustomerId",
         *      "messageId": "ATZCid_SomeMessageId"
         * }
         */
    }


    public static function returnJsonError($payload)
    {
        echo json_encode($payload);
        exit();
    }
}