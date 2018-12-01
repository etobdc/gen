<?php

namespace App\Http\Middleware;

use Closure;

use App\ApiIntegration;

class VerifyApiIntegration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty($request->header('ApiToken')))
            return response('Missing API Token', 401);

        $apiIntegration = ApiIntegration::where('token', $request->header('ApiToken'))->get();

        if(sizeof($apiIntegration) == 0)
                return response('Unauthorized.', 401);

        $request->attributes->add(['ApiIntegration' => $apiIntegration[0]]);

        return $next($request);
    }
}
