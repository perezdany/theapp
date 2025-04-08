<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

use DB;

class CustomerController extends Controller
{
    //
    public function TryDelete(Request $request)
    {
        //VOIR SI IL A DES DEVIS
        $v = DB::table('cotations')->where('id_client', $request->id)->count();

        if($v == 0)
        {
            Client::destroy($request->id);
            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Vous ne pouvez pas supprimer ce client. En effet il a des devis');
        }
    }
}
