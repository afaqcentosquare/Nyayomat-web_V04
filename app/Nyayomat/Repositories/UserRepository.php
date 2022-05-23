<?php


namespace App\Nyayomat\Repositories;


use App\Customer;
use App\Nyayomat\Notifications\SendMessages;
use App\User;

class UserRepository
{
    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getUserByEmail($email)
    {
        return User::where('email',$email)->first();
    }

    public function createClient($input)
    {
        $data = [
            'name' => $input['name'],
            'email' => isset($input['email']) ? $input['email'] : null,
            'mobile' => $input['mobile'],
            'password' => isset($input['password']) ? $input['password'] : null,
            'accepts_marketing' => 1,
            'verification_token' => str_random(40),
            'active' => 1,
        ];

        return Customer::create($data);
    }
    
    public function updateClient($input)
    {
        $data = [
            'pin' => $input['pin'],
        ];

        return Customer::create($data);
    }

    public function pinProvision(Customer $customer)
    {
        if ($customer->pin) {
            return;
        }

        $pin = rand(1001, 9998);

//        $phone =  +254 . ltrim($customer->mobile, '0');

        $customer->update(['pin' => $pin]);

        $data = [
            'pin' => $pin,
            'name' => $customer->name,
        ];

        (new SendMessages($customer->mobile,'on-boarding-customer',$data))->sendNotification();

        return;
    }
    
    public function pinChange(Customer $customer)
    {
        if ($customer->pin) {
            return;
        }
//        $phone =  +254 . ltrim($customer->mobile, '0');
        $data = [
            'pin' => $pin,
        ];

        (new SendMessages($customer->mobile,'pin-reset',$data))->sendNotification();

        return;
    }
}