<?php 

namespace App\Http\Controllers;

use App\Models\RolUser;
use Illuminate\Http\Request;
use App\Models\User;

class MenuController extends Controller
{
    public function getUserInfo(Request $request)
    {
        try {
            $user = User::with('roles.menus')->find($request->user->id);
            // $role = $user->role; // Get the user's role object
            // $menus = $user->menus;

            return response()->json(['user' => $user], 201);
        } catch (\Throwable $th) {
            
            
            return response()->json(['message' => $th->getMessage()], 402);
        }

    }

}
