<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Josantonius\Session\Facades\Session;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;


class AuthenticationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private Factory $validatorFactory)
    {
    }

    public function show()
    {
        return view('home', [
            'name' => 'mehdi'
        ]);
    }

    public function login(Request $request)
    {
        // validate inputs
        try {
            $validator = $this->validatorFactory->make($request->all(), [
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            $attributes = $validator->validate();
            $admin = DB::select('select id, email , password from admins where email=? limit 1', [$attributes['email']]);
            if (count($admin) === 0) {
                Session::set('errors', ['email' => 'email incorrect']);
                return redirect(route('home'));
            }
            
            if (!password_verify($attributes['password'], $admin[0]->password)) {
                Session::set('errors', ['password' => 'mot de passe incorrect']);
                return redirect(route('home'));
            }
            Session::set('adminauth', $admin[0]->id);
            return redirect(route('stagiaire'));
        } catch (ValidationException $e) {
            dd($e->errors());
            Session::set('errors', $e->errors());
            return redirect(route('home'));
        }
        // get the user from database
        // check if the password is correct (use https://www.php.net/manual/en/function.password-verify.php)
        // set errors to session 
        // otherwise create a session then redirect to interns page (auth)
    }
}
