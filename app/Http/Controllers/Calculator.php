<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class Calculator extends Controller
{
    //
    public function RetrunMontantRest($id_facture, $montant)
    {
        //somme des paiement
        $somme_paiement = 0;
        //Récuperer tout les paiement de la facture ['paiements.paiement']
        //dd($id_facture);
        $all_paiements = DB::table('paiements')
        ->join('factures', 'paiements.id_facture', '=', 'factures.id')
        ->where('paiements.id_facture', $id_facture)
        ->get();

        foreach($all_paiements as $all_paiements)
        {
            $somme_paiement =  $somme_paiement + $all_paiements->paiement;
        }
       
        //SOUSTRACTION
        $rest = $montant - $somme_paiement;
        
        return $rest;
    }
}
