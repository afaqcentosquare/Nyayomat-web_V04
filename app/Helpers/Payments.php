<?php

namespace App\Helpers;

use DB;
use App\Disbursement;
use Auth;
use App\User;
use App\Cart;
use App\Order;
use App\Refund;
use App\Visitor;
use App\Dispute;
use App\Message;
use App\Customer;
use App\Merchant;
use App\Inventory;
use Carbon\Carbon;

/**
 * Provide statistics all over the application
 */
class Payments
{

    /**
     * Register validation and confirmation urls
     *
     * Request:
     *      POST /mpesa/c2b/v1/registerurl
     *      Authorization: Bearer [access token]
     *      Content-Type: application/json
     *      Body:
     *      {
     *      "ShortCode": "600610", - This is your paybill number/till number,
     *                               which you expect to receive payments notifications about.
     *      "ResponseType": "[Cancelled/Completed]", - This is the default action value that determines what
     *                       MPesa will do in the scenario that your endpoint is unreachable or is unable to respond on time.
     *                       Only two values are allowed: Completed or Cancelled. Completed means MPesa will automatically
     *                       complete your transaction, whereas Cancelled means MPesa will automatically cancel the transaction,
     *                       in the event MPesa is unable to reach your Validation URL.
     *      "ConfirmationURL": "[confirmation URL]",
     *      "ValidationURL": "[validation URL]"
     *      }
     *
     * Response:
     *      {
     *      "ConversationID": "",
     *      "OriginatorCoversationID": "",
     *      "ResponseDescription": "success"
     *      }
     *
     */
    public static function returnAccessToken($app)
    {
        $url = env('MPESA_OAUTH_URL');
        $consumerKey = env($app . '_CONSUMER_KEY');
        $consumerSecret = env($app . '_CONSUMER_SECRET');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        $json = json_decode($curl_response);
        $my_token = $json->access_token;

        return $my_token;
    }

    /**
     * Send STK Push request
     *
     * Request:
     *      /mpesa/stkpush/v1/processrequest
     *      Authorization: Bearer [access token]
     *      Content-Type: application/json
     *      Body:
     *      {
     *      "BusinessShortCode": "174379", - shortcode of the organization initiating the request and expecting the payment.
     *      "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTgwNDA5MDkzMDAy",
     *                  - Base64-encoded value of the concatenation of the Shortcode + LNM Passkey + Timestamp
     *      "Timestamp": "20180409093002", - Timestamp used in the encoding above, in the format YYYMMDDHHmmss.
     *      "TransactionType": "[Transaction Type]", - The type of transaction being performed. These are the same values as the C2B command IDs
     *                  (CustomerPayBillOnline and CustomerBuyGoodsOnline) and the same rules apply here.
     *      "Amount": "1000", - Amount to debit
     *      "PartyA": "254708374149", - Debit party of the transaction, hereby the phone number of the customer.
     *      "PartyB": "174379", - The credit party of the transaction, hereby being the shortcode of the organization. This is the same value as the Business Shortcode
     *      "PhoneNumber": "254708374149", - Same as PartyA.
     *      "CallBackURL": "https://ip:port/" - endpoint where you want the results of the transaction delivered
     *      "AccountReference": "account", -  value the customer would have put as the account number on their phone if they had performed the transaction via phone.
     *      "TransactionDesc": "test" , - Short description of the transaction. Optional, but element must be present.
     *      }
     *
     * Response:
     *      {
     *      "MerchantRequestID": "25353-1377561-4",
     *      "CheckoutRequestID": "ws_CO_26032018185226297", - unique request ID and can be used later for the LNM Transaction Query API.
     *      "ResponseCode": "0", - value 0 (zero) means the request was accepted successfully. Any other value means there was an error validating your request.
     *      "ResponseDescription": "Success. Request accepted for processing", - description or error
     *      "CustomerMessage": "Success. Request accepted for processing"
     *      }
     */
    public static function stkPush($mobile_number, $account_number, $amount)
    {
        $acc_token = self::returnAccessToken(C2B_APP);
        $url = env('STK_PUSH_URL');
        $transaction_type = "CustomerBuyGoodsOnline";
        $timestamp = date("Ymdhis");
        $shortcode = env('C2B_SHORTCODE');
        $pass_key = env('STK_PASS_KEY');
        $appKeySecret = $shortcode . $pass_key . $timestamp;
        $password = base64_encode($appKeySecret);
        $call_back_url = env('STK_CALLBACK_URL');
        $phone_number = Payments::formatPhoneNumber($mobile_number);

        $curl_post_data = array(
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => $transaction_type,
            'Amount' => $amount,
            'PartyA' => $shortcode,
            'PartyB' => env('STK_PARTY_B'),
            'IdentifierType' => '4',
            'PhoneNumber' => $phone_number,
            'CallBackURL' => $call_back_url,
            'AccountReference' => $account_number,
            'TransactionDesc' => 'PURCHASE'
        );

        $data_string = json_encode($curl_post_data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization:Bearer ' . $acc_token
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        return $curl_response;
    }

    /**
     *
     * Request:
     *      // URL
     *      [POST] https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest
     *
     *      // HEADERS
     *      Host: sandbox.safaricom.co.ke
     *      Authorization: Bearer [access token]
     *      Content-Type: application/json
     *
     *      // BODY
     *      {
     *      "InitiatorName": "TestInit610", - The username of the API operator as assigned on the MPesa Org Portal.
     *      "SecurityCredential": "", - The password of the API operator encrypted using the public key certificate provided.
     *      "CommandID": "[CommandID]", - his specifies the type of transaction being performed. There are three allowed values on the API: SalaryPayment, BusinessPayment or PromotionPayment.
     *      "Amount": "1000",
     *      "PartyA": "600610", - Shortcode of the organization.
     *      "PartyB": "254708374149", - customer's phone number (beginning with 07XX or 2547XX)
     *      "QueueTimeOutURL": "https://ip:port/" , - allback URL used to send an error callback when the transaction was not able to be processed by MPesa within a stipulated time period.
     *      "ResultURL": "https://ip:port/", - This is the callback URL where the results of the transaction will be sent
     *      "Remarks": "", - A very short description of the transaction from your end. Occassion can be left blank, Remarks cannot be blank.
     *      "Occassion":  ""
     *      }
     *
     * Response:
     *      {
     *      "ConversationID": "AG_20180326_00005ca7f7c21d608166",
     *      "OriginatorConversationID": "12363-1328499-6",
     *      "ResponseCode": "0",
     *      "ResponseDescription": "Accept the service request successfully."
     *      }
     */
    public static function b2c($mobile_number, $amount)
    {
        $acc_token = self::returnAccessToken(B2C_APP);
        $url = env('B2C_URL');
        $call_back_url = env('B2C_CALLBACK_URL');
        $phone_number = Payments::formatPhoneNumber($mobile_number);

        $curl_post_data = array(
            'InitiatorName' => env('B2C_INITIATOR'),
            'SecurityCredential' => env('B2C_SECURITY_CREDENTIAL'),
            'CommandID' => 'BusinessPayment',
            'Amount' => $amount,
            'PartyA' => env('B2C_SHORTCODE'),
            'PartyB' => $phone_number,
            'QueueTimeOutURL' => $call_back_url,
            'ResultURL' => $call_back_url,
            'Remarks' => 'B2C',
            'Occassion' => 'B2C'
        );

        $data_string = json_encode($curl_post_data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization:Bearer ' . $acc_token
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        return $curl_response;
    }

    public static function disburse($user_id, $mobile_number, $amount)
    {
        $response = json_decode(Payments::b2c($mobile_number, $amount));
        // save the disbursement
        $conversation_id = $response->ConversationID;
        $original_conversation_id = $response->OriginatorConversationID;
        $response_code = $response->ResponseCode;
        $response_desc = $response->ResponseDescription;
        $status = $response_code == "0" ? Disbursement::STATUS_PENDING : Disbursement::STATUS_FAILED;

        // Save the disbursement
        $disbursement = new Disbursement;
        $disbursement->fill([
            'user_id' => $user_id,
            'amount' => $amount,
            'recipient_phone' => $mobile_number,
            'conversation_id' => $conversation_id,
            'originator_conversation_id' => $original_conversation_id,
            'status' => $status,
            'failure_reason' => $response_code == "0" ? null : $response_desc
        ]);
        $disbursement->save();

        return $status;
    }

    public static function getAccountBalance($user_id, $type)
    {
        return DB::table('accounts')->where('type', $type)->where('user_id', $user_id)->sum('amount');
    }

    public static function formatPhoneNumber($mobile_number)
    {
        $mobile_number = ltrim($mobile_number, '+');
        $mobile_number = ltrim($mobile_number, '254');
        $mobile_number = ltrim($mobile_number, '0');
        return '254' . $mobile_number;
    }

    public static function convertTimeToUTC($time = null)
    {
        if (!$time) {
            $time = time();
        }

        return gmdate("Y-m-d H:i:s", $time);
    }

    public static function currentUtcTime()
    {
        return self::convertTimeToUTC(time());
    }

    public static function convertUTCToLocal($utc_time, $timezone = 'Africa/Nairobi', $date_format = 'd/m/Y @ H:i:s')
    {
        date_default_timezone_set($timezone);
        $timestamp = (is_int($utc_time) || is_long($utc_time)) ? $utc_time : self::convertUTCToTimestamp($utc_time);
        return date($date_format, $timestamp);
    }

    public static function convertUTCToLocalDate($utc_time, $timezone = 'Africa/Nairobi')
    {
        return self::convertUTCToLocal($utc_time, $timezone, 'd/m/Y');
    }

    public static function formatDateTime($time, $timezone = 'Africa/Nairobi', $date_format = 'd/m/Y @ H:i:s')
    {
        if (!$time) {
            $time = time();
        }

        if (!$timezone) {
            $timezone = 'Africa/Nairobi';
        }

        if (!$date_format) {
            $date_format = 'd/m/Y @ H:i:s';
        }

        date_default_timezone_set($timezone);
        return date($date_format, $time);
    }

    public static function formatDate($time, $timezone = 'Africa/Nairobi')
    {
        return self::formatDateTime($time, $timezone, 'd/m/Y');
    }

    public static function convertUTCToTimestamp($utc_time)
    {
        return strtotime($utc_time . ' UTC');
    }

    public static function parseDate($date, $pattern)
    {
        return \DateTime::createFromFormat($pattern, $date)->getTimestamp();
    }

    public static function parseDateToUTC($date, $pattern)
    {
        return self::convertTimeToUTC(self::parseDate($date, $pattern));
    }

    public static function returnJsonError($payload)
    {
        echo json_encode($payload);
        exit();
    }
}