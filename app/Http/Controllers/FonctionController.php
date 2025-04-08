<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class FonctionController extends Controller
{
    //

    public function deletefonction(Request $request)
    {
        //VOIR SI IL N' A PAS DE FILS
        $v = DB::table('interlocuteurs')->where('id_fonction', $request->id)->count();
        //dd($v);
        if($v == 0)
        {
            //dd('ici');
            $delete = DB::table('fonctions')->where('id', '=', $request->id)->delete();
            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Vous ne pouvez pas supprimer cet élément, car des interlocuteurs y sont associés');

        }
     
    }
}
