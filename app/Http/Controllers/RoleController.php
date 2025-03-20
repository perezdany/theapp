<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Role;    

class RoleController extends Controller
{
    //
    public function deleteRole(Request $request)
    {
       
        $v = DB::table('role_user')->where('role_id', $request->id)->count();

        if($v == 0)
        {
            $delete =  Role::destroy($request->id);
        }
        else
        {
            return back()->with('error', 'Ce rôle ne peut être supprimé! Des utilisateurs y sont associé');
        }

        return back()->with('success', 'Elément supprimé avec succès');
    }
}
