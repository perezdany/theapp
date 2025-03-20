<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Typearticle;
use DB;

class TypearticleController extends Controller
{
    //

    public function GetAll()
    {
        return Typearticle::all();
    }

    public function DeleteType(Request $request)
    {
        //ON VA VERIFIER SI IL N'A PAS DE PRODUITS
        $v = DB::table('articles')->where('id_typearticle', $request->id)->count();
        if($v == 0)
        {
            Typearticle::destroy($request->id);
            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Ce élément contient des produits. Impossible de le supprimer');
        }     
    }
}
