<?php


namespace App\Nyayomat\Handlers;

use Exception;
use App\Exceptions\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpFoundation\Response;

class ExceptionHandler extends Handler
{
    public function reportException(Exception $exception)
    {
        return parent::report($exception);
    }

    public function renderKnownClasses($request, $e)
    {
        if ($e instanceof TokenMismatchException) {
            Flash::error('Couldn\'t execute that, please try again');

            if ($request->wantsJson()) {
                return \response()->json(['error' => 'Unknown general error, try again', 'title'=>'token_mismatch']);
            }

            return redirect()->back()->withInput($request->except('_token'));
        }

        if ($e instanceof AuthenticationException) {
            Flash::error('Please login to proceed.');

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            } else {
                return redirect('/sso/authorize');
            }
        }

        return false;
    }
}