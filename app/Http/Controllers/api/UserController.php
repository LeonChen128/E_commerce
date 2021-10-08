<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Exceptions\Error;
use \App\Model\User;

class UserController extends \App\Http\Controllers\Controller
{
    public $user;

    public function __construct(Request $request)
    {
        $request->route('id') && $this->user = User::findOrFail($request->route('id'));
    }

    public function updateHead(Request $request)
    {
        if (!$img = $request->file('img')) {
            return response()->json(['message' => '參數錯誤'], 400);
        }

        if (!in_array($img->extension(), ['jpg', 'jpeg', 'png'])) {
            return response()->json(['message' => '檔案格式有誤'], 400);
        }

        move_uploaded_file($_FILES['img']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/asset/photo/user/' . $this->user->id . '/head.jpg');
        $this->user->update(['head' => 'head.jpg']);

        return response()->json(['message' => '上傳成功']);
    }

    public function update(Request $request)
    {
        $params = $this->validate($request, [
            'name' => 'string|nullable|max:190',
            'address' => 'string|nullable|max:190',
            'phone' => 'string|nullable|max:50'
        ]);

        $this->user->update($params);

        return response()->json(['message' => '修改成功']);
    }
}
