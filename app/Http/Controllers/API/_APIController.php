<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class _APIController extends \App\Http\Controllers\Controller
{
    /**
     * 讓 Laravel 驗證器轉換中文說明
     *
     * @param  array  $params 請求的參數
     * @param  array  $rules 驗證規則
     * @return Illuminate\Support\Facades\Validator
     */
    protected function validatorTransfer(Request $request, array $rules)
    {
        foreach ($rules as $key => $rule) {
            $keys = explode('|', $key);

            $validate[$keys[0]] = $rule;
            $transferDesc[$keys[0]] = '「' . ($keys[1] ?? $keys[0]) . '」';
        }

        return $this->validate($request, $validate, [], $transferDesc);
    }
}
