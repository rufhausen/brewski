<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache as Cache;
use Illuminate\Support\Facades\Storage as Storage;

class SettingsCacheMiddleware
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
        if (!Cache::has('settings')) {
            $settings = json_decode(Storage::get('settings.json'), true);
            Cache::forever('settings', $settings);
        }
        return $next($request);
    }
}
