<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Article;
use DB;

class Calculator extends Controller
{
    //

    public function CountCustomer()
    {
        $count = Client::where('id_statutclient', '=', 2)
        ->count();
         return  $count;
    }

    public function CountArticle()
    {
        $count = Article::count();
         return  $count;
    }

    public function CountFacture()
    {
        $count = Facture::all()
        ->count();
         return  $count;
    }

    public function CountFactureNoReglee()
    {
        $count = Facture::where('reglee', 0)->where('annulee', 0)
        ->count();
         return  $count;
    }
    public function CountFactureReglee()
    {
        $count = Facture::where('reglee', 1)->where('annulee', 0)
        ->count();
         return  $count;
    }

    public function CountProspect()
    {
        $count = Client::where('id_statutclient', '=', 1)
        ->count();
        return  $count;
    }

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
