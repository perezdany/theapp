<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Suivicommercial;

class SuiviController extends Controller
{
    //

    public function Add(Request $request)
    {
        $t_colour = ["#00A36C", "#0047AB", "#9b59b6", "Black",
        "CornflowerBlue", "DarkGoldenRod", "DarkGreen", "DeepPink", "Gold",
        "Indigo", "LightCoral", "LightSeaGreen",];

        $i = rand(0, 11);
        $validated = $request->validate([
            'title' => 'required|string',
            'end' => 'required'
        ]);

        $date_start = $request->start." ".$request->startime;
        $create = Suivicommercial::create(
            [ 
                'title' => $request->title, 'color' => $t_colour[$i], 
                'start' => $date_start, 'end' => $request->end, 
                'id_projet' => $request->id_projet, 'id_fournisseur' => $request->id_fournisseur, 
                'id_client' => $request->id_client,  'id_user' => auth()->user()->id
            ]
        );
        //return back()->wit
        return response()->json($create);
   
       
    }
    public function UpdateSuivi(Request $request, $id)
    {
        //return back()->wi
        $findit = Suivicommercial::find($id);
        if(! $findit)
        {
            return response()->json([
                'error' => 'Impossible de retrouver l\'élément'
            ], 404);
        }
      
        $start_date = str_replace( ".000Z", "", $request->start);
        $end_date = str_replace(".000Z", "", $request->end);
        $findit->update([
            'start' => $start_date , 'end' => $end_date, 
        ]);
        return response()->json('Modification effectuée');;
   
    }

    public function deleteSuivi(Request $request, $id)
    {
        //return back()->wi
        $findit = Suivicommercial::find($id);
        if(! $findit)
        {
            return response()->json([
                'error' => 'Impossible de retrouver l\'élément'
            ], 404);
        }
        $findit->delete();
        return response($findit);//->json('Modification effectuée');;
   
    }

    public function DestroySuivi(Request $request)
    {
        //dd('icio');
        $f = Suivicommercial::find($request->id);
        
        Suivicommercial::destroy($request->id);

        return back()->with('success', 'Elément supprimée');

    }
}
