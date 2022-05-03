<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return Permission::select(['action', 'subject', 'section'])
            ->whereRelation('role', 'name', '=', \request('name'))->get();
    }

    public function update(Request $request, $id)
    {
        Permission::whereRoleId($id)->delete();

        foreach ($request['permissions'] as $item) {
            $permission = new Permission();
            $permission->action = implode("|", $item['action']);
            $permission->subject = $item['subject'];
            $permission->section = $item['section'];
            $permission->role_id = $id;
            $permission->save();
        }

        return $this->respondOk('Yangilandi.');
    }
}
