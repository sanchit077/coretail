<?php

namespace App\Http\Middleware;

use Closure;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Carbon\Carbon;

class AppApiLogger {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $now = Carbon::now('UTC')->format('Y-m-d');
        $file = 'Request_' . $now . '.logs';

        $view_log = new Logger('API Logs');
        $view_log->pushHandler(new StreamHandler('Logs/' . $file, Logger::INFO));

        $view_log->addInfo(json_encode(['Remote_address' => $_SERVER['REMOTE_ADDR'], 'Request_api' => $_SERVER['REQUEST_URI'], 'Data' => $request->all()]));
        return $next($request);
    }

    public function terminate($request, $response)
        {

            $now = Carbon::now('UTC')->format('Y-m-d');
            $file = 'Response_'.$now.'.logs';

            $view_log = new Logger('API Logs');
            $view_log->pushHandler(new StreamHandler('Logs/'.$file, Logger::INFO));        

            $view_log->addInfo(json_encode(['Remote_address'=>$_SERVER['REMOTE_ADDR'],'Request_api'=>$_SERVER['REQUEST_URI'], 'Response' => $response->original]));

        }
    
}
