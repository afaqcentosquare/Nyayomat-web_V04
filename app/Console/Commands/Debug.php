<?php


namespace App\Console\Commands;


use App\Http\Controllers\Nyayomat\SMSIntegration;
use App\Nyayomat\Notifications\SendMessages;
use Illuminate\Console\Command;

class Debug extends Command
{
    protected $signature = 'debug:run';

    protected $description = 'Reset the application by clear all files, cache, drop all tables, re-run migrations, seed the database';

    public function handle()
    {
        $data = [
            'pin' => 2138,
            'name' => 'Doulfa',
        ];

        (new SendMessages($phone,'on-boarding-customer',$data))->sendNotification();
    }
}