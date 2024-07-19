<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Josantonius\Session\Session;
use Illuminate\Support\Facades\DB;

class EnsureAdminNotAuthenticated
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

        if (!is_null($adminId)) {
            return redirect(route('stagiaire'));
        }

        return $next($request);
    }
}
