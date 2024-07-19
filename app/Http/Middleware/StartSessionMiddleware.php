<?php

namespace App\Http\Middleware;

use Closure;
use Josantonius\Session\Session;
use Illuminate\Http\Request;

class StartSessionMiddleware
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
        $this->session->start([
            'cookie_httponly' => true
        ]);

        return $next($request);
    }
}
