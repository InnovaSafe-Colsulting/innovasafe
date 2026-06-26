<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

class AdminSessionMiddleware extends StartSession
{
    /**
     * Get the session configuration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function getSession(Request $request)
    {
        $session = parent::getSession($request);
        $session->setName('innovasafe_admin_session');
        return $session;
    }
}