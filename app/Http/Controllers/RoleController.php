<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }
     public function givenAdminRole(string $id){

         $user = User::find($id);
         if (!$user) {
             return response()->json(['error' => 'User not found.'], 404);
         }
         $user->syncRoles(['super-admin']);
         return response()->json(['message' => 'Role assigned successfully.']);
     }
    public function givenModeratorRole(string $id){
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        $user->syncRoles(['moderator']);
        return response()->json(['message' => 'Role assigned successfully.']);
    }
    public function givenUserRole(string $id){
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        $user->syncRoles(['simple-user']);
        return response()->json(['message' => 'Role assigned successfully.']);
    }

    public  function getPermissions(Request $request){
        $role = Role::findByName($request->name);
        $permissions = $role->permissions->toArray();
        return response()->json($permissions);
    }
}
