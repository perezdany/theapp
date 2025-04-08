<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Projet;

class ProjetController extends Controller
{
    //
    public function delete(Request $request)
    {
        $v = DB::table('suivicommercials')->where('id_projet', $request->id)->count();
        //dd($v);
        if($v == 0)
        {
            //dd('ici');
            $delete = DB::table('projets')->where('id', '=', $request->id)->delete();
            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Vous ne pouvez pas supprimer cet élément, car des suivis y sont associés');

        }
    }
}
