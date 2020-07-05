<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ValidateHttpsSignature
{
    var $keyResolver;

    public function __construct()
    {
        $this->keyResolver = function () {
            return App::make('config')->get('app.key');
        };
    }

    /**
     * gebaseerd op vendor/laravel/framework/src/Illuminate/Routing/Middleware/ValidateSignature.php
     * maar zorgt er voor dat een url altijd als https behandeld wordt. dit fixt het feit dat
     * laravel achter een rewrite proxy draait en urls binnenkrijgt als http.
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('class ValidateHttpsSignature в методе handle');
        Log::info($request);
        if ($this->hasValidSignature($request)) {
            return $next($request);
        }
        throw new InvalidSignatureException;

    }

    /**
     * Determine if the given request has a valid signature.
     * copied and modified from
     * vendor/laravel/framework/src/Illuminate/Routing/UrlGenerator.php:363
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $absolute
     * @return bool
     */
    public function hasValidSignature(Request $request, $absolute = true)
    {
      
        $url = $absolute ? $request->url() : '/'.$request->path();
        $url = str_replace("http://","https://", $url);
//        $original = rtrim($url.'?'.Arr::query(
//                Arr::except($request->query(), 'signature')
//            ), '?');
        $original = rtrim($url.'?expires='.$request->expires);

        $expires = $request->query('expires');
        $signature = hash_hmac('sha256', $original, call_user_func($this->keyResolver));
        
        return  hash_equals($signature, (string) $request->query('signature', '')) &&
            ! ($expires && Carbon::now()->getTimestamp() > $expires);

    }

}