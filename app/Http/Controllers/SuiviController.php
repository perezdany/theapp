<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Suivi_user;
use App\Models\Suivicommercial;

class SuiviController extends Controller
{
    //

    public function Add(Request $request)
    {
        //dd('ici');
        $t_colour = ["#00A36C", "#0047AB", "#9b59b6", "Black",
        "CornflowerBlue", "DarkGoldenRod", "DarkGreen", "DeepPink", "Gold",
        "Indigo", "LightCoral", "LightSeaGreen", "#4A919E", "#E1A624", 
        "#FF9CB6", "#FC4E00", "#7D4FFE", "#A4BD01",
        "#F27438", "#939597", "#74EC8D", "#8FB43A", "#003C57", "#000000", "#F8D7D7"];

        //CAHQUE UTILISATEUR A SA COULEUR
        $i = auth()->user()->id;
        $validated = $request->validate([
            'title' => 'required|string',
            'end' => 'required'
        ]);

       
        $date_start = $request->start." ".$request->startime;

        //METTRE LA DATE POUR LE FILTRE
        //$date_filter = 
        $create = Suivicommercial::create(
            [ 
                'title' => $request->title, 
                //'date_f'=> $request->start,
                'color' => $t_colour[$i], 
                'start' => $date_start, 'end' => $request->end, 
                'id_projet' => $request->id_projet, 'id_fournisseur' => $request->id_fournisseur, 
                'id_client' => $request->id_client, 
                 'more' => $request->more,
                'id_user' => auth()->user()->id
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

    public function AddSuiviProspect(Request $request)
    {
        //dd($request->all());

        $t_colour = ["#00A36C", "#0047AB", "#9b59b6", "Black",
        "CornflowerBlue", "DarkGoldenRod", "DarkGreen", "DeepPink", "Gold",
        "Indigo", "LightCoral", "LightSeaGreen", "#4A919E", "#E1A624", 
        "#FF9CB6", "#FC4E00", "#7D4FFE", "#A4BD01",
        "#F27438", "#939597", "#74EC8D", "#8FB43A", "#003C57", "#000000", "#F8D7D7"];

        //CAHQUE UTILISATEUR A SA COULEUR
        $i = auth()->user()->id;
        $validated = $request->validate([
            'title' => 'required|string',
            'end' => 'required'
        ]);

       
        $date_start = $request->start." ".$request->startime;

        //METTRE LA DATE POUR LE FILTRE
        //$date_filter = 
        $create = Suivicommercial::create(
            [ 
                'title' => $request->title, 
                //'date_f'=> $request->start,
                'color' => $t_colour[$i], 
                'start' => $request->start, 'end' => $request->end, 
                'id_client' => $request->id_client, 
                'date_relance' => $request->date_relance,
                'more' => $request->more,
                'id_user' => auth()->user()->id
            ]
        );

        return back()->with('success', 'Ajout effectué avec succès!');
    }

    public function UpdateSuiviProspect(Request $request)
    {
        //dd($request->all());

        //CAHQUE UTILISATEUR A SA COULEUR
        $validated = $request->validate([
            'title' => 'required|string',
            'end' => 'required'
        ]);

        $date_start = $request->start." ".$request->startime;

        //METTRE LA DATE POUR LE FILTRE
        //$date_filter = 
        $update = DB::table('suivicommercials')->where('id', $request->id)
        ->update(
            [ 
                'title' => $request->title, 
                'start' => $request->start, 'end' => $request->end, 
                'id_client' => $request->id_client, 
                'date_relance' => $request->date_relance,
                'more' => $request->more,
            ]
        );

        return back()->with('success', 'Modification effectué avec succès!');
    }

    public function FilterDate(Request $request)
    {
        //dd($request->all());
        $get = DB::table('role_user')->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->where('user_id', auth()->user()->id)
        ->where('roles.intitule', "super_admin")->count();
        //dd($get);
        if($get != 0)
        {
            $suiviQuery = Suivi_user::query()
            ->where("start", ">=", $request->debut)
            ->where("start", "<=", $request->fin);
        }
        else
        {

            $suiviQuery = Suivi_user::query()
            ->where("start", ">=", $request->debut)
            ->where("start", "<=", $request->fin)->where('id_user', auth()->user()->id);
        }

        $suivis = $suiviQuery->paginate(5);
        //dd($suivis);
        
        return view("suivi-prospect",
            [
                'suivis' => $suivis
            ]            
        );
    }

    public function FilterUser(Request $request)
    {
        //dd($request->all());
        $suiviQuery = Suivi_user::query()
        ->where("id_user", ">=", $request->user);
       
        $suivis = $suiviQuery->paginate(5);

        return view("suivi-prospect",
            [
                'suivis' => $suivis
            ]            
        );
    }

    public function FilterSearchSuiviProspect(Request $request)
    {
        //dd($request->all());
        $suiviQuery = Suivi_user::query()
            ->where("title", "LIKE", "%".$request->search."%")
            ->where("end", "LIKE", "%".$request->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$request->search."%")
            ->orwhere("date_relance", "LIKE", "%".$request->search."%")
            ->orwhere("nom", "LIKE", "%".$request->search."%")
            ->orwhere("more", "LIKE", "%".$request->search."%");
       
        $suivis = $suiviQuery->paginate(5);

        return view("suivi-prospect",
            [
                'suivis' => $suivis
            ]            
        );
    }

    public function PageSuiviProspect()
    {
        $get = DB::table('role_user')->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->where('user_id', auth()->user()->id)
        ->where('roles.intitule', "super_admin")->count();
        //dd($get);
        if($get != 0)
        {
            $suiviQuery = Suivi_user::query();
        }
        else
        {
            $suiviQuery = Suivi_user::query()->where('id_user', auth()->user()->id);
        }

        $suivis = $suiviQuery->paginate(5);

        return view("suivi-prospect",
            [
                'suivis' => $suivis
            ]            
        );
    }
    
}

