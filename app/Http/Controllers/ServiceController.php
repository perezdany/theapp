<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Service;
class ServiceController extends Controller
{
    //

    public function TryDelete(Request $request)
    {
        //VOIR SI Y A PAS UN DEVIS DE CE SERVICE
        $v = DB::table('cotation_service')->where('id_service', $request->id)->count();
        if($v == 0)
        {
            Service::destroy($request->id);
            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Impossible de supprimer le service. Un devis y est associé');
        }
    }
}
