<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Josantonius\Session\Session;
use Illuminate\Support\Facades\DB;

class EnsureAdminAuthenticated
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // get session this session will contain the id of admin
        $adminId = $this->session->get('adminauth');

        if (is_null($adminId)) {
            return redirect(route('home'));
        }

        // find the admin by id from database if unable to retrive admin from database remove session then redirect to login route 
        $admin = DB::select('select id from admins where id=? limit 1', [$adminId]);
        if (count($admin) === 0) {
            $this->session->remove('adminauth');

            return redirect(route('home'));
        }

        // if admin exists continue otherwise redirect to home route
        return $next($request);
    }
}
