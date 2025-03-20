<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Departement;

use DB;


class DepartementController extends Controller
{
    //Handlle Departments

    public function GetAll()
    {
        $get =  Departement::all();

        return $get;
        
    }

    public function AddDepartement(Request $request)
    {
        
        $Insert = Departement::create([
            'libele_departement' => $request->libele, 
       ]);

       return redirect('departements')->with('success', 'Enregistrement effectué');
    }

    public function EditDepForm(Request $request)
    {
        return view('admin/departements',
            [
                'id_departement' => $request->libele,
            ]
        );
    }

    public function GetById($id)
    {
        
        $get =  Departement::where('id', $id)->get();

        return $get;
    }

    public function EditDepartement(Request $request)
    {
        //dd($request->libele);
        $affected = DB::table('departements')
        ->where('id', '=', $request->id_departement)
       
        ->update(['libele_departement' => $request->libele, ]);
         

        return redirect('departements')->with('success', 'Modification Effectuée avec succès');
    }

    public function tryDelete(Request $request)
    {
        //dd($request->all());
        //Vérifier si le département ne pas d'utilisateur
        $v = DB::table('users')->where('departements_id', $request->id)->count();

        if($v != 0)
        {
            //Déclenche l'evenement  #[On('do-delete')] 
            return back()->with('error', 'Désolé, vous ne pouvez supprimer cet utilisateur car il contient des utilisateurs');
        
        }
        else
        {
            Departement::destroy($request->id);

            return back()->with('success', 'Département supprimé avec succès');
        }
    }
}
