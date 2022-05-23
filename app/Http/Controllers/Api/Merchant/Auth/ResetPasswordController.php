<?php


namespace App\Http\Controllers\Api\Merchant\Auth;


use App\Http\Controllers\Controller;
use App\Nyayomat\Repositories\UserRepository;

class ResetPasswordController extends Controller
{
    protected $userRepository;

    /**
     * ResetPasswordController constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function authenticateReminder()
    {
        $user = $this->userRepository->getUserByEmail(request()->get('email'));

        if (!$user){
            return response()->json([
                'success' => false,
                'message' => 'No user exists under that email.'
            ]);
        }
    }
}