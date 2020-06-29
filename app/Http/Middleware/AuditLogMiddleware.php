<?php 
namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Closure, Auth, Session;
use App\User, App\Log;

class AuditLogMiddleware
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
        $LOG_URL = implode($request->segments(), '/');
        $USER_ID = (Auth::check()) ? Auth::user()->USER_ID : NULL;
        $SESSION_ID = (Auth::check()) ? Session::getId() : NULL;
        $REQUEST_METHOD = $request->method();
        $REQUEST_PAYLOAD = json_encode($request->all(), TRUE);
        $LOG_TASK = NULL;
        $CLIENT_IP_ADDRESS = $request->ip();
        $CLIENT_HTTP_AGENT = $request->header('User-Agent');

        // dd($LOG_URL);

        if($LOG_URL != 'postlogin')
        {
            Log::create([
                "USER_ID" => $USER_ID,
                "SESSION_ID" => $SESSION_ID,
                "REQUEST_METHOD" => $REQUEST_METHOD,
                "LOG_URL" => $LOG_URL,
                "REQUEST_PAYLOAD" => $REQUEST_PAYLOAD,
                "LOG_TASK" => $LOG_TASK,
                "CLIENT_IP_ADDRESS" => $CLIENT_IP_ADDRESS,
                "CLIENT_HTTP_AGENT" => $CLIENT_HTTP_AGENT,
            ]);
        }
        
        return $next($request);
    }
}