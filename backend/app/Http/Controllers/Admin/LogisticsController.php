<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogisticsSetting;

class LogisticsController extends Controller
{
    public function index()
    {
        return [
            'clevver_api_key' => LogisticsSetting::get('clevver_api_key'),
            'shipping_markup_percent' => LogisticsSetting::get('shipping_markup_percent', 20),
            'activation_fee_us' => LogisticsSetting::get('activation_fee_us', 0),
            'activation_fee_cn' => LogisticsSetting::get('activation_fee_cn', 0),
            'handling_fee_photo' => LogisticsSetting::get('handling_fee_photo', 2.00),
            'handling_fee_consolidation' => LogisticsSetting::get('handling_fee_consolidation', 5.00),
        ];
    }

    public function update(Request $request)
    {
        $settings = $request->only([
            'clevver_api_key', 
            'shipping_markup_percent',
            'activation_fee_us',
            'activation_fee_cn',
            'handling_fee_photo',
            'handling_fee_consolidation'
        ]);

        foreach ($settings as $key => $value) {
            LogisticsSetting::set($key, $value);
        }

        return response()->json(['message' => 'Logistics settings updated successfully']);
    }
}
