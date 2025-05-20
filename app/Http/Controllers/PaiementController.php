<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Paiement;

class PaiementController extends Controller
{
    //
    public function GoForm(Request $request)
    {
        return view('finances/paiements_form',
            [
                'id' => $request->id_facture,
            ]
        );
    }

    public function DoPaiement(Request $request)
    {
        //dd($request->all());
        $ch = strval($request->paiement);
        if(strlen($ch) > 13)
        {
            //rediriger pour lui dire que c'est trop long
            return redirect('facture')->with('error', 'données montant saisies trop long');
        }
        
        //FAIRE LES MISES A JOURS DES TABLES CONCERNEES
        $total_paiement = 0;

        $total_montant_facture = 0;

        $Insert = Paiement::create([
            'paiement' => $request->paiement, //c'est le montant
            'id_facture' => $request->id_facture, 
            'id_mode_reglement' => $request->mode,
            'id_user' => auth()->user()->id, 
        ]);

        $add_details = DB::table('details_paiements')->insert(
            [
                'id_paiement' => $Insert->id,
                'date_paiement' => $request->date_paiement, 
                'date_virement' => $request->date_virement,
                'numero_virement' => $request->numero_virement,
                'date_reception' => $request->date_reception,
                'banque' => $request->banque,
            ]
        );

        //Récuper tous les anciens montants POUR DEFINIR SI LA FACTURE EST REGLEE TOTALEMENT
        $get_montants = DB::table('paiements')
        ->where('paiements.id_facture', $request->id_facture)
        ->join('factures', 'paiements.id_facture', '=', 'factures.id')
        
        ->get(['paiements.paiement']);

        foreach($get_montants as $get_montants)
        {
            $total_paiement = $total_paiement + $get_montants->paiement;
        }
    
        //Calcul du nouveau reste 
        $rest = $request->montant_facture - $total_paiement;
        //dd($rest);
        //MISE A JOUR DE LA TABLE FACTURE
        if($rest == 0)
        {
            $affected = DB::table('factures')
            ->where('id', $request->id_facture)
            ->update([ 'reglee' => 1, 
            'date_reglement' => date('Y-m-d')]); //LA FACTURE DEVIENT REGLEE DEFINITIVEMENT aprs je mets ce code 'date_reglement' => date('Y-m-d')
        }
        

        return view('finances/paiements_form',
            [
                'id' => $request->id_facture,
                'success' => 'Paiement enregistré'
            ]
        );
        

    }

    public function EditPaiement(Request $request)
    {
        //dd($request->all());
        $ch = strval($request->paiement);
        if(strlen($ch) > 13)
        {
            //rediriger pour lui dire que c'est trop long
            return back()->with('error', 'données montant saisies trop long');
        }
        
        //FAIRE LES MISES A JOURS DES TABLES CONCERNEES
        $total_paiement = 0;

        $total_montant_facture = 0;

        $affected = DB::table('paiements')
        ->where('id', $request->id_paiement)
        ->update([

            'paiement' => $request->paiement, //c'est le montant
            
        ]);

        $update_details = DB::table('details_paiements')
        ->where('id', $request->id_details)
        ->update([
           'date_paiement' => $request->date_paiement, 
            'date_virement' => $request->date_virement,
            'numero_virement' => $request->numero_virement,
            'date_reception' => $request->date_reception,
            'banque' => $request->banque,
        ]);


        //Récuper tous les anciens montants
        $get_montants = DB::table('paiements')
        ->where('paiements.id_facture', $request->id_facture)
        ->join('factures', 'paiements.id_facture', '=', 'factures.id')
        ->get(['paiements.paiement']);

        foreach($get_montants as $get_montants)
        {
            $total_paiement = $total_paiement + $get_montants->paiement;
        }

        //Calcul du nouveau reste 
        $rest = $request->montant_facture - $total_paiement;
        
        //MISE A JOUR DE LA TABLE FACTURE
        if($rest == 0)
        {
            $affected = DB::table('factures')
            ->where('id', $request->id_facture)
            ->update([ 'reglee' => 1, 
            'date_reglement' => date('Y-m-d')]); //LA FACTURE DEVIENT REGLEE DEFINITIVEMENT
        }
        return view('finances/paiements_form',
            [
                'id' => $request->id_facture,
                'success' => 'Paiement modifié'
            ]
        );

    } 

    public function UpdatePaiement(Request $request)
    {
        //dd($request->all());
        $ch = strval($request->paiement);
        if(strlen($ch) > 13)
        {
            //rediriger pour lui dire que c'est trop long
            return back()->with('error', 'données montant saisies trop long');
        }
        
        //FAIRE LES MISES A JOURS DES TABLES CONCERNEES
        $total_paiement = 0;

        $total_montant_facture = 0;

        $affected = DB::table('paiements')
        ->where('id', $request->id_paiement)
        ->update([

            'paiement' => $request->paiement, //c'est le montant
            
        ]);

        $update_details = DB::table('details_paiements')
        ->where('id', $request->id_details)
        ->update([
           'date_paiement' => $request->date_paiement, 
            'date_virement' => $request->date_virement,
            'numero_virement' => $request->numero_virement,
            'date_reception' => $request->date_reception,
            'banque' => $request->banque,
        
        ]);

        //Récuper tous les anciens montants
        $get_montants = DB::table('paiements')
        ->where('paiements.id_facture', $request->id_facture)
        ->join('factures', 'paiements.id_facture', '=', 'factures.id')
        ->get(['paiements.paiement']);

        foreach($get_montants as $get_montants)
        {
            $total_paiement = $total_paiement + $get_montants->paiement;
        }

        //Calcul du nouveau reste 
        $rest = $request->montant_facture - $total_paiement;
        
        //MISE A JOUR DE LA TABLE FACTURE
        if($rest == 0)
        {
            $affected = DB::table('factures')
            ->where('id', $request->id_facture)
            ->update([ 'reglee' => 1, 
            'date_reglement' => date('Y-m-d')]); //LA FACTURE DEVIENT REGLEE DEFINITIVEMENT
        }
        
        return view('finances/paiements_form',
            [
                'id' => $request->id_facture,
                'success' => 'Paiement modifié'
            ]
        );
        //return back()->with('success', 'Paiement modifié');    

    } 

    public function GetPaimentByIdFacture($id)
    {
        /**/
        $get = DB::table('details_paiements')
            ->join('paiements', 'details_paiements.id_paiement', '=', 'paiements.id')
            ->join('factures', 'paiements.id_facture', '=', 'factures.id')
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
            ->join('clients', 'cotations.id_client', '=', 'clients.id') 
            ->where('id_facture', $id) 
           
            ->get( ['paiements.*', 'details_paiements.date_reception',  'details_paiements.date_paiement',
                    'details_paiements.banque',  'details_paiements.date_virement', 'details_paiements.numero_virement',
                    'factures.numero_facture', 'factures.montant_facture', 'factures.date_emission',
                    'factures.date_reglement', 'clients.nom'
                ]);

        
        return $get;
    }

    public function EditPaiementForm(Request $request)
    {
        return view('finances/edit_paiements_form',
            [
                'id_edit' => $request->id_paiement,
            ]
        );
    }

    public function EditForm(Request $request)
    {
        //dd('ici');
        return view('livewire/paiements/edit',
            [
                'id_edit' => $request->id_paiement,
            ]
        );
    }

    public function PaiementByFacture(Request $request)
    {
        //dd($request->all());
        return view('admin/paiements_by_facture',
            [
                'id' => $request->id_facture,
            ]
        );
    }

    public function GetById($id)
    {
        $get = DB::table('details_paiements')
            ->join('paiements', 'details_paiements.id_paiement', '=', 'paiements.id')
            ->join('factures', 'paiements.id_facture', '=', 'factures.id')
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
            ->join('clients', 'cotations.id_client', '=', 'clients.id') 
            ->where('paiements.id', $id)
            ->get(['details_paiements.*', 'paiements.paiement', 'paiements.id_facture',
                'paiements.id_mode_reglement',  'factures.numero_facture', 
                'factures.montant_facture', 'factures.date_emission',
                'factures.date_reglement', 'clients.nom']);
       
        return $get;
    }

    public function DeletePaiement(Request $request)
    {
        //dd($request->all());
        $delete = DB::table('paiements')->where('id', '=', $request->id)->delete();
        return back()->with('success', 'Elément supprimé');
        
    }

    
}
