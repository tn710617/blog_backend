<?php

namespace App\Http\Middleware\V1;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class LogRequestResponse
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $cloneResponse = clone($response);
        $cloneRequest = clone($request);

        $this->maskSensitiveInfo($cloneRequest, $cloneResponse);

        if ($cloneRequest->hasHeader('Authorization')) {
            $cloneRequest->headers->set('Authorization', 'Bearer ******');
        }

        Log::debug(
            PHP_EOL.'Request:'.PHP_EOL.
            PHP_EOL.
            $cloneRequest->getMethod().' '.$cloneRequest->getRequestUri().' '.$cloneRequest->getProtocolVersion().
            PHP_EOL.
            $cloneRequest->headers.
            'Cookies:'.PHP_EOL.
            json_encode($cloneRequest->cookie()).
            PHP_EOL.
            json_encode($request->getClientIps()).
            PHP_EOL.
            json_encode($cloneRequest->all()).
            PHP_EOL.
            PHP_EOL.'====================分隔線===================='.PHP_EOL.
            PHP_EOL.
            'Response:'.PHP_EOL.
            PHP_EOL.
            $cloneResponse.
            PHP_EOL.
            PHP_EOL.'====================結束線===================='.PHP_EOL.
            PHP_EOL
        );

        return $response;
    }

    private function maskSensitiveInfo(&$cloneRequest, $cloneResponse)
    {
        if (app()->isProduction()) {
            if ($cloneRequest->has('password')) {
                $cloneRequest = $cloneRequest->merge(['password' => '******']);
            }
            if ($cloneRequest->cookie('one_dream_user_refresh_token')) {
                $cloneRequest->cookies->set('one_dream_user_refresh_token', '******');
            }

            if (Arr::has($cloneResponse->getOriginalContent(), 'data.access_token')) {
                $content = $cloneResponse->getOriginalContent();
                $content['data']['access_token'] = '******';
                $cloneResponse->setContent(json_encode($content));
            }

            $cloneResponse->cookie('one_dream_user_refresh_token', 'masked');
        }
    }
}
