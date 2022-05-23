<?php

namespace App\Helpers;

use AfricasTalking\SDK\AfricasTalking;
use App\SentMessage;
use Auth;
use DB;

/**
 * Provide messaging functionality
 */
class Messaging
{

    public static function sendMessage($recipient_phone, $message)
    {
        $gateway = new AfricasTalking(env('AFRICASTALKING_USERNAME'), env('AFRICASTALKING_API_KEY'));
        $sms_gateway = $gateway->sms();
        $message = trim($message);
        $phone_number = Payments::formatPhoneNumber($recipient_phone);
        $sender_id = env('AFRICASTALKING_SENDER_ID');
        $options = [
            'to' => $phone_number,
            'message' => $message
        ];

        if ($sender_id) {
            $options['from'] = $sender_id;
        }

        try {
            $results = $sms_gateway->send($options);
            $overall_status = SentMessage::STATUS_SUCCESS;
            foreach ($results as $result) {
                $status = $result->status;
                $status = ($status == 'Success') ? SentMessage::STATUS_SUCCESS : SentMessage::STATUS_FAILED;
                $number = $result->number;
                $message_id = $result->messageId;
                $cost = $result->cost;
                $cost = trim(str_ireplace('KES', '', $cost));

                // Save the message
                $sent_message = new SentMessage;
                $sent_message->fill([
                    'recipient_phone' => $number,
                    'message_id' => $message_id,
                    'text' => $message,
                    'cost' => $cost,
                    'status' => $status
                ]);
                $sent_message->save();
                

                $overall_status = $status;
            }
            dd($overall_status);
            return $overall_status;
        } catch (\Exception $e) {
            $status = SentMessage::STATUS_FAILED;
            $failure_reason = $e->getMessage();

            // Save the failed message
            $sent_message = new SentMessage;
            $sent_message->fill([
                'recipient_phone' => $phone_number,
                'text' => $message,
                'cost' => 0,
                'status' => $status,
                'failure_reason' => $failure_reason
            ]);
            $sent_message->save();

            return $status;
        }
    }
}