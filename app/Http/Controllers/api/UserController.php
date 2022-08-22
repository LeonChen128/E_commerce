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
        if (!$img = $request->file('img'))
            return response()->json(['message' => 'img 為必要參數'], 400);

        if (!in_array($img->extension(), ['jpg', 'jpeg', 'png']))
            return response()->json(['message' => '上傳格式須為 【jpg, jpeg, png】之圖片檔案'], 400);

        !is_dir($dir = config('app.user_dir') . $this->user->id) && mkdir($dir);

        move_uploaded_file($_FILES['img']['tmp_name'], $dir . '/head.jpg');
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
