<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// use App\Permission; 


class RoleManagerController extends Controller
{

    public function index()
    {
        return Permission::all();
    }

    public function rolesIndex()
    {
        return Role::all()->paginate(100);
    }

    public function rolesAddUser(Request $request, Role $role, User $user)
    {

        $user->assignRole($role);

        return response()->json([
            "message" => $role->name . " Role successfully assigned to User!",
        ], 200);
    }

    public function rolesRemoveUser(Request $request, Role $role, User $user)
    {
        $user->removeRole($role);

        return response()->json([
            "message" => $role->name . " Role successfully removed from User",
        ], 200);
    }
}
