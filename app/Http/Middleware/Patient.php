<?php

namespace App\Http\Middleware;

use Closure;

class Patient
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->checkRoles() == false)
            return response($this->buildError(403, 'Unauthorized', 403), 403);

        return $next($request);
    }

    /**
     * check user permissions
     *
     * @return bool
     */
    private function checkRoles()
    {
        if (!isset(auth()->user()->id))
            return false;
        else
            return true;
    }

    public function buildError($code, $message, $statusCode)
    {
        return [
            "status_code" => $statusCode,
            'error' => [
                "message" => $message,
                "code" => $code
            ]
        ];
    }
}
