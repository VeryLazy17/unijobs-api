<?php

namespace App\Http\Controllers\User;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return User::whereRelation('role', 'name', '!=', 'superadmin')
            ->with('role:id,name')
            ->paginate(10);
    }

    public function getRoles()
    {
        return Role::all(['id', 'name']);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|max:8',
            'role_id' => 'required',
        ],
            [
                'name.max' => 'Iltimos, nom 100 ta belgidan oshmasin !',
                'name.required' => 'Iltimos,nomni kiriting !',
                'email.unique' => 'Bu login oldin ro\'yxatdan o\'tgan !',
                'email.required' => 'Iltimos, loginni kiriting !',
                'password.required' => 'Iltimos, parolni kiriting !',
                'password.max' => 'Iltimos,kod 8 ta belgidan oshmasin !',
                'role_id.required' => 'Iltimos, roleni tanlang !',
            ]
        );

        User::create($request->only('name', 'email', 'password', 'role_id', 'created_at'));

        return $this->respondOk('Foydalanuvchi qo\'shildi.');
    }

    public function show(User $user)
    {
        return $user;
    }

    public function imageUpload(Request $request)
    {

        $this->validate(request(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'image.image' => 'Iltimos, rasm yuklang !',
                'image.mimes' => 'Iltimos, rasm yuklang !',
                'image.max' => 'Iltimos, rasm hajmi 2MB dan oshmasin !',
            ]
        );

        $user = User::findOrFail(\request('id'));

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        $user->image = $imageName;
        $user->update();

        return $this->respondOk('Foydalanuvchi yangilandi.');
    }

    public function updateLoginAndName(Request $request)
    {
        $this->validate(request(), [
            'name' => 'max:100',
        ],
            [
                'name.max' => 'Iltimos, nom 100 ta belgidan oshmasin !',
            ]
        );

        $user = User::findOrFail($request['id']);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->update();

        return $this->respondOk('Foydalanuvchi yangilandi.');
    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail($request['id']);

        $passwordCheck = Hash::check($user->password, $request['old_password']);
        if (!$passwordCheck) {
            return response()->json(['success' => false, 'message' => 'Joriy parol xato !'], 409);
        }

        $user->password = $request['password'];
        $user->update();

        return $this->respondOk('Foydalanuvchi yangilandi.');
    }

    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'name' => 'required|max:100',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|max:8',
            'role_id' => 'required',
        ],
            [
                'name.max' => 'Iltimos, nom 100 ta belgidan oshmasin !',
                'name.required' => 'Iltimos,nomni kiriting !',
                'email.required' => 'Iltimos, loginni kiriting !',
                'image.image' => 'Iltimos, rasm yuklang !',
                'image.mimes' => 'Iltimos, rasm yuklang !',
                'image.max' => 'Iltimos, rasm hajmi 2MB dan oshmasin !',
                'password.required' => 'Iltimos, parolni kiriting !',
                'password.max' => 'Iltimos,kod 8 ta belgidan oshmasin !',
                'role_id.required' => 'Iltimos, roleni tanlang !',
            ]
        );

        $user->update($request->only('name', 'email', 'password', 'role_id', 'created_at'));

        return $this->respondOk('Foydalanuvchi yangilandi.');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->respondOk('Foydalanuvchi o\'chirildi.');
    }
}
