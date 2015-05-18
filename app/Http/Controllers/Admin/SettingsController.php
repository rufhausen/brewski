<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as Cache;
use Illuminate\Support\Facades\Storage as Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $settings = json_decode(Storage::get('settings.json'));
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function putUpdate(Request $request)
    {
        $settings_array = $request->except('_token', '_method');

        if (!in_array('enable_recaptcha', $settings_array)) {
            $settings_array = $settings_array+['enable_recaptcha' => 0];
        }

        $settings = json_encode($settings_array);

        Storage::put('settings.json', $settings);

        Cache::forever('settings', $settings_array);

        return redirect()->back()->withSuccess('updated');
    }
}
