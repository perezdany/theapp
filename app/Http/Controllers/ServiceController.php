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

    public function GetAll()
    {
        return Service::all();
    }

    public function AddLineForCreation(Request $request)
    {
        //dd($request->all());
        $add = DB::table('cotation_service')
        ->insert([
                'cotation_id' => $request->id_cotation,
                'service_id' => $request->service,
                'prix_ht' => $request->prix,
                'duree' => $request->duree,
                'duree_type' => $request->duree_type,
                   
          ]);

          return view('forms/add_devis',[
            'id' => $request->id_cotation,
        ]);
    }

    public function DeleteLineService(Request $request)
    {
        //dd($request->all());
        $get = DB::table('cotation_service')
        ->where('id', $request->id)
        ->get(['cotation_service.cotation_id']);
        //dd($get);
        foreach($get as $get)
        {
            $id = $get->cotation_id;
        }
       
        $delete = DB::table('cotation_service')->where('id', $request->id)->delete();

        return view('forms/add_devis', compact('id'));
    }
}
