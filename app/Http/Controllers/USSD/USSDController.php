<?php


namespace App\Http\Controllers\USSD;


use App\Http\Controllers\Controller;
use App\Nyayomat\USSD\USSDHandler;

class USSDController extends Controller
{
    /**
     * @param $key
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function index($key)
    {
        $ussd = new USSDHandler(
            request("sessionId"),
            request("serviceCode"),
            request("phoneNumber"),
            request("text")
        );

        $response = $ussd->handle();

        if ($response['type'] == 'con' && !empty($response['text'])) {
            return $this->continueSession($response['text']);
        }

        return $this->terminateSession($response['text']);
    }

    private function terminateSession($response)
    {
        if (empty($response)) {
            reportException(new \InvalidArgumentException("Empty USSD response found"));

            $response = 'Could not process your request. Try again later';
        }

        return $this->respond('END '.$response);
    }

    private function continueSession($response)
    {
        return $this->respond('CON '.$response);
    }

    private function respond($response)
    {
        return response($response, 200, [
            'Content-type' => 'text/plain'
        ]);
    }
}