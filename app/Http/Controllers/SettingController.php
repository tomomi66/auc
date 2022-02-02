<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Consts\YahuokuConsts;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setting::find(1);

        return view('setting/detail', ['title'=> '詳細設定', 'data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'comment1' => 'required',
            'comment2' => 'required',
            'comment3' => 'required',
            'from_prefecture' => 'required',
            'fee_burden' => 'required',
            'pay_method' => 'required',
            'min_rate' => 'required',
            'evil_rate_limit' => 'required',
            'authen_limit' => 'required',
            'auto_extend' => 'required',
            'auto_listing' => 'required',
            'tax_preference' => 'required',
            'in_tax_setting_flg' => 'required',
        ]);
        
        $comment1 = $request->comment1;
        $comment2 = $request->comment2;
        $comment3 = $request->comment3;
        $from_prefecture = $request->from_prefecture;
        $fee_burden = $request->fee_burden;
        $pay_method = $request->pay_method;
        $min_rate = $request->min_rate;
        $evil_rate_limit = $request->evil_rate_limit;
        $authen_limit = $request->authen_limit;
        $auto_extend = $request->auto_extend;
        $auto_listing = $request->auto_listing;
        $tax_preference = $request->tax_preference;
        $in_tax_setting_flg = $request->in_tax_setting_flg;
        // $requests = $request->all();
        $settings = Setting::find(1);

        $settings->comment1 = $comment1;
        $settings->comment2 = $comment2;
        $settings->comment3 = $comment3;
        $settings->from_prefecture = $from_prefecture;
        $settings->fee_burden = $fee_burden;
        $settings->pay_method = $pay_method;
        $settings->min_rate = $min_rate;
        $settings->evil_rate_limit = $evil_rate_limit;
        $settings->authen_limit = $authen_limit;
        $settings->auto_extend = $auto_extend;
        $settings->auto_listing = $auto_listing;
        $settings->tax_preference = $tax_preference;
        $settings->in_tax_setting_flg = $in_tax_setting_flg;
        $settings->save();

        $data = Setting::find(1);

        return view('setting/detail', ['title'=> '詳細設定', 'data' => $data]);
    }

}
