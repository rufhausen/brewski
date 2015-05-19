<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache as Cache;

class CacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getClear()
    {
        // Cache::forget('settings');
        // Cache::forget('popular_categories');
        Cache::flush();

        return redirect()->back()->withSuccess('Cache Cleared!');
    }

}
