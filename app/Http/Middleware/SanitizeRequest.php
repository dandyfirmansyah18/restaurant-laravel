<?php
namespace App\Http\Middleware;
use Closure;

class SanitizeRequest
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
        $input = $request->all();
        if ($input) {
            array_walk_recursive($input, function (&$item, $key) {
                if($key != 'ARTICLE_CONTENT' and $key != 'CA_CONTENT' and $key != 'SLIDER_BUTTON_LINK')
                {
                    $item = preg_replace('/[^A-Za-z0-9 \.\,\-\|\*\;\/\&\#\(\)\~\_\@]/', '', $item);
                    $item = trim($item);
                }
            });
            $request->merge($input);
        }

        return $next($request);
    }
}