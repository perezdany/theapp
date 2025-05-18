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
       if(isset($request->designation))
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation,
                'prix_ht' => $request->prix,
                'duree' => $request->duree,
                'duree_type' => $request->duree_type,
                   
          ]);
       }
       if($request->designation1 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation1,
                'prix_ht' => $request->prix1,
                'duree' => $request->duree1,
                'duree_type' => $request->duree_type1,
                   
          ]);
       }
       if($request->designation2 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation2,
                'prix_ht' => $request->prix2,
                'duree' => $request->duree2,
                'duree_type' => $request->duree_type2,
                   
          ]);
       }

       if($request->designation3 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation3,
                'prix_ht' => $request->prix3,
                'duree' => $request->duree3,
                'duree_type' => $request->duree_type3,
                   
          ]);
       }
       if($request->designation4 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation4,
                'prix_ht' => $request->prix4,
                'duree' => $request->duree4,
                'duree_type' => $request->duree_type4,
                   
          ]);
       }
       if($request->designation5 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation5,
                'prix_ht' => $request->prix5,
                'duree' => $request->duree5,
                'duree_type' => $request->duree_type5,
                   
          ]);
       }

       if($request->designation6 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation7,
                'prix_ht' => $request->prix7,
                'duree' => $request->duree7,
                'duree_type' => $request->duree_type7,
                   
          ]);
       }

       if($request->designation8 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation8,
                'prix_ht' => $request->prix8,
                'duree' => $request->duree8,
                'duree_type' => $request->duree_type8,
                   
          ]);
       }
       if($request->designation9 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation9,
                'prix_ht' => $request->prix9,
                'duree' => $request->duree9,
                'duree_type' => $request->duree_type9,
                   
          ]);
       }
       if($request->designation10 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation10,
                'prix_ht' => $request->prix10,
                'duree' => $request->duree10,
                'duree_type' => $request->duree_type10,
                   
          ]);
       }

        return view('forms/add_devis',[
            'id' => $request->id_cotation,
        ]);
    }

     public function EditLineForCreation(Request $request)
    {
       //dd($request->all());
        $add = DB::table('details_cotations')->where('id', $request->id)
        ->update([
                
                'designation' => $request->designation,
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
        $get = DB::table('details_cotations')
        ->where('id', $request->id)
        ->get(['details_cotations.cotation_id']);
        //dd($get);
        foreach($get as $get)
        {
            $id = $get->cotation_id;
        }
       
        $delete = DB::table('details_cotations')->where('id', $request->id)->delete();

        return view('forms/add_devis', compact('id'));
    }
}
