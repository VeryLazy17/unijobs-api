<?php

namespace App\Http\Controllers;

use App\Models\Role;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return Role::where('name', '!=', 'superadmin')->get(['id', 'name']);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|unique:roles,name',
        ],
            [
                'name.unique' => 'Bu nom oldin kiritilgan !',
                'name.required' => 'Iltimos, yangi rolni nomini kiriting !',
            ]
        );

        Role::create([
            'name' => $request['name'],
        ]);

        return $this->respondWithSuccess(['message' => 'Role qo\'shildi !']);
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request['name']
        ]);

        return $this->respondWithSuccess(['message' => 'Role yangilandi !']);
    }
}
