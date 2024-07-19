<?php

namespace App\Http\Middleware;

use Closure;
use Josantonius\Session\Session;
use Illuminate\Http\Request;

class SetErrorsBagMiddleware
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
        $errors = $this->session->get('errors', []);

        $request->attributes->set('errors', $errors);
        $this->session->remove('errors');

        return $next($request);
    }
}
