<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
{
    // new added function
    public function configureTheme(){
        $themes = Auth::user()->api()->rest('GET', '/admin/api/2022-04/themes.json');    
        $shopThemes = $themes['body']['themes'];
        $searchedThemeRole = "main";
        //search for the right theme id with the main role
        $activeTheme = array_filter(
            $shopThemes->toArray(),
            function ($e) use (&$searchedThemeRole) {
                return $e['role'] == $searchedThemeRole;
            }
        );
        $activeThemeId = $activeTheme[0]['id'];
        $snippet = "Hello this is new file Ls";
        //Snippet to pass to rest api request
        $data = array(
            'asset'=> [
                'key' => 'snippets/ls_newcode.liquid',
                'value' => $snippet
            ]
        );
        Auth::user()->api()->rest('PUT', '/admin/api/2022-04/themes/'.$activeThemeId.'/assets.json', $data);

        return Setting::updateOrCreate([
            'shop_id' => Auth::user()->name,
            'shop_active_theme_id' => $activeThemeId,
            'activated' => true,
        ]) ?  ['message' => 'Theme setup successfully'] : ['message' => 'Theme setup error!'];
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Setting $setting)
    {
        //
    }

    public function edit(Setting $setting)
    {
        //
    }

    public function update(Request $request, Setting $setting)
    {
        //
    }

    public function destroy(Setting $setting)
    {
        //
    }
}
