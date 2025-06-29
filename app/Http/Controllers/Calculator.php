<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Article;
use App\Models\Service;
use App\Models\Cotation;

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

    //POUR LE GRAPHE MENSUEL
    public function MonthlyChart()
    {
        //LES GRAPHES SONT FAITS PAR FACTURE REGELEES
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE
        
        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //LE TABLEAU QUI VA RECCUEILLIR LES ENTREPRISES
        $company = [];

        //LE TABLEAU POUR LES POURCENTAGE DE CHAQUE ENTREPRISE CE MOIS CI
        $percent = [];

        //l'année en cours
        $year = date('Y');

        //le mois en cours
        $month = date('m');

        //FAIRE UN TABLEAU POUR LE MOIS EN FRANCAIS
        $mois_francais = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 
        'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $francais = $mois_francais[($month-1)];


        //Le montant total des factures réalisé c'est a dire des facutres réglées de ce contrat
        $total = 0;

        //nombre de jours dans le mois
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        //LA BOUCLE DES JOURS DU MOIS
        for($i = 1; $i <= $number; $i++)
        {
            $somme = 0;   
            //$first_date = $year."-".$i."01";
            $the_date = $year."-". $month."-".$i;
            //echo $the_date."<br>";
            //LA REQUETE MAINTENANT
            $get = DB::table('factures')
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
            ->join('clients', 'clients.id', '=', 'cotations.id_client')
            ->where('factures.date_emission', '=', $the_date)
            ->where('factures.annulee', "0")
            ->select(['factures.*', 'clients.nom'])
            ->get();
            
            //dump($get);
            
            //FAIRE UN FOREACH POUR FAIRE LA SOMME
            foreach($get as $all)
            {
                //echo $all->montant."<br";
                $somme = $somme + $all->montant_facture;
                //dump($somme);
            }
            
            $total = $total + $somme;
            //dump($total);
            
            //METTRE DANS LE TABLEAU data
            array_push($data, $somme);
            //dd($data[0]);
            //echo $data[$i]."<br>";
            
            //var_dump($data);
        }          
        //echo  $total;

        //NOMBRE TOTAL DES ENTREPRISE
        $totalnb_entreprise = 0;
        //CALCUL POUR LES POURCENTAGES 

        //Prendre toutes les entreprises et pour chaque entrprise recupérer le montant des contrats dans le mois en questions
        $all_entreprises = Client::all();
        
        foreach($all_entreprises as $all_entreprises)
        {
            //montant de contrat pour chaque entreprise
            $montant = 0;
            for($i = 1; $i <= $number; $i++)
            {
                $the_date = $year."-". $month."-".$i;
                
                $contrats =  DB::table('factures')
                ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
                ->join('clients', 'clients.id', '=', 'cotations.id_client')
                ->where('factures.date_emission', '=', $the_date)
                //->where('factures.annulee', 0)
                ->where('cotations.id_client', $all_entreprises->id)
                ->get(['factures.date_emission', 'clients.nom', 'factures.montant_facture']);
                foreach($contrats as $contrats)
                {
                    $montant = $montant + $contrats->montant_facture;
                }

            }  

            //METTRE LES VALLEURS DANS LES DIFFERENTS TABLEAUX
            if($montant != 0) //Si cette entreprise a rapporté quelque chose il faut remplir dans le tableu pour le gaph
            {
                //dump($all_entreprises->nom_entreprise);
                $totalnb_entreprise = $totalnb_entreprise + 1;
                array_push($company, $all_entreprises->nom);
                //CALCULER LE POURCENTAGE ET METTRE DANS LE TABLEAU
                $p = ($montant * 100) / $total;
                //echo $total;
                array_push($percent, $p);

            }
                
            
        }
        
        //dd($percent);
        //dd($totalnb_entreprise);
        //ON AURA $totalnb_entreprise COULEURS DONC FAIRE UN TABLEAU QUI VA AVOIR LE NOMRE TOTAL DE COULEUR DIFFERENTES
        $alpha = ['A', 'B', 'C', 'D', 'E', 'F', ];
        $colors = [];
        //FAIRE UNE BOUCLE POUR CONCEVOIR LA COULEUR DE CHAQUE ENTREPRISE DETECTEE
        for($c=0; $c < $totalnb_entreprise; $c++)
        {   
            $bol = rand(0,1);
            $chaine_couleur = "#";
            for($l = 1; $l<=6; $l++)
            {
                if($bol == 0)
                {
                    $a = rand(0,5);
                    $chaine_couleur =  $chaine_couleur.$alpha[$a];//les 26 lettre de l'alphabet
                    //$bol ++;
                }
                else{
                    $chaine_couleur =  $chaine_couleur.rand(0,9);
                    //$bol = $bol - 1 ;
                }
            }
            //echo $chaine_couleur ."<br>";
            //mettre la couelur formée dans le tableau colors
            array_push($colors, $chaine_couleur);
            
        
        
        }
        //dd($colors);
        //AFFICHER LES GRAPHES PAR PRESTATIONS, PAR SERVICES

        //Prendre touts les services et pour chaque service recupérer le total des contrats dans le mois en questions
        
        //TABLEAU QUI VA RECUPERER LES SERVICES
        $serv = [];
        //TABLEAU QUI VA RECUPER LE TOTAL DES PRESTATIONS
        $data_serv = [];

        //Compter toutes les prestations du mois

        $first_date = $year."-".$month."-01";
        $last_date = $year."-".$month."-".$number;

        //PARCOURIR TOUS LES SERVICES
        $all_services = Service::all();
        
        foreach($all_services as $all_services)
        {    
            $compte_prestations  = 0; 
            //LES DETAILS DES DEVIS. ON VA RECUPER LES SERVICES AVEC CA
            $toutes_reglees =  DB::table('cotations')
            ->where('cotations.date_creation', '>=', $first_date)
            ->where('cotations.date_creation', '<=', $last_date)
            ->get();
           
            foreach($toutes_reglees as $toutes_reglee)
            {   
                //QUAND IL S'AGIT DE VENTE DE MATERIEL
                if($all_services->code = "MAT")
                {
                    $compte_prestations_service =  DB::table('cotation_article')
                    ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'cotations.id_service')
                    ->where('cotation_article.cotation_id', $toutes_reglee->id)
                    ->where('cotations.id_service', '=', $all_services->id)
                    ->count();

                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }

                }
                else
                {
                     //pour récupérer le nombre total de la prestation spécifique ce mois ci
                    $compte_prestations_service =  DB::table('details_cotations')
                    ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'details_cotations.id_service')
                    ->where('details_cotations.cotation_id', $toutes_reglee->cotation_id)
                    ->where('details_cotations.service_id', '=', $all_services->id)
                    //->where('cotations.valide', 1)
                    ->count();
                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }
                }
            
            }

            if($compte_prestations != 0)
            {
                //ON VA METTRE LE NOM DU SERVICE DANS LE TABLEAU
                if($serv == null)
                {
                    array_push($serv, $all_services->libele_service);
                }
                else
                {

                    if(array_search($all_services->libele_service, $serv) == false)
                    {
                        array_push($serv, $all_services->libele_service);
                    }   
                    
                }
                array_push($data_serv, $compte_prestations);    
            }
          
           
        }
        //dd($data_serv);


        return view('graphs/search_monthly', compact('data', 'company', 'percent', 'francais', 'serv', 'colors', 'data_serv', 'total'));
    }
      
    public function SearchMonth(Request $request)
    {
        //dd($request->month);
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE
        
        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //LE TABLEAU QUI VA RECCUEILLIR LES ENTREPRISES
        $company = [];

        //LE TABLEAU POUR LES POURCENTAGE DE CHAQUE ENTREPRISE CE MOIS CI
        $percent = [];

        
        //le mois en cours
        $month_get = date_parse($request->month);
        //dd($month_get);
        $month = $month_get['month'];
    
        //l'année recherchée
        $year = $month_get['year'];

        //dd($month);
        //FAIRE UN TABLEAU POUR LE MOIS EN FRANCAIS
        $mois_francais = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 
        'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $francais = $mois_francais[($month-1)];

        //dd($francais);
        //Le montant total des contrats réalisé
        $total = 0;
        
        //nombre de jours dans le mois
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        //LA BOUCLE DES JOURS DU MOIS
        for($i = 1; $i <= $number; $i++)
        {
            $somme = 0;   
            //$first_date = $year."-".$i."01";
            $the_date = $year."-". $month."-".$i;
            //echo $the_date."<br>";
            //LA REQUETE MAINTENANT
            $get = DB::table('factures')
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
            ->join('clients', 'clients.id', '=', 'cotations.id_client')
            ->where('factures.date_emission', '=', $the_date)
            ->where('factures.annulee', "0")
            ->select(['factures.*', 'clients.nom'])
            ->get();
            
            //dump($get);
            
            //FAIRE UN FOREACH POUR FAIRE LA SOMME
            foreach($get as $all)
            {
                //echo $all->montant."<br";
                $somme = $somme + $all->montant_facture;
                //dump($somme);
            }
            
            $total = $total + $somme;
            //dump($total);
            
            //METTRE DANS LE TABLEAU data
            array_push($data, $somme);
            //dd($data[0]);
            //echo $data[$i]."<br>";
            
            //var_dump($data);
        }          
        //echo  $total;
 
        //NOMBRE TOTAL DES ENTREPRISE
        $totalnb_entreprise = 0;
        //CALCUL POUR LES POURCENTAGES 

        //Prendre toutes les entreprises et pour chaque entrprise recupérer le montant des contrats dans le mois en questions
        $all_entreprises = Client::all();
         
        foreach($all_entreprises as $all_entreprises)
        {
            //montant de contrat pour chaque entreprise
            $montant = 0;
            for($i = 1; $i <= $number; $i++)
            {
                $the_date = $year."-". $month."-".$i;
                
                $contrats =  DB::table('factures')
                ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
                ->join('clients', 'clients.id', '=', 'cotations.id_client')
                ->where('factures.date_emission', '=', $the_date)
                //->where('factures.annulee', 0)
                ->where('cotations.id_client', $all_entreprises->id)
                ->get(['factures.date_emission', 'clients.nom', 'factures.montant_facture']);
                foreach($contrats as $contrats)
                {
                    $montant = $montant + $contrats->montant_facture;
                }

            }  

            //METTRE LES VALLEURS DANS LES DIFFERENTS TABLEAUX
            if($montant != 0) //Si cette entreprise a rapporté quelque chose il faut remplir dans le tableu pour le gaph
            {
                //dump($all_entreprises->nom_entreprise);
                $totalnb_entreprise = $totalnb_entreprise + 1;
                array_push($company, $all_entreprises->nom);
                //CALCULER LE POURCENTAGE ET METTRE DANS LE TABLEAU
                $p = ($montant * 100) / $total;
                //echo $total;
                array_push($percent, $p);

            }
                
            
        }
         
        //dd($percent);
        //dd($totalnb_entreprise);
        //ON AURA $totalnb_entreprise COULEURS DONC FAIRE UN TABLEAU QUI VA AVOIR LE NOMRE TOTAL DE COULEUR DIFFERENTES
        $alpha = ['A', 'B', 'C', 'D', 'E', 'F', ];
        $colors = [];
        //FAIRE UNE BOUCLE POUR CONCEVOIR LA COULEUR DE CHAQUE ENTREPRISE DETECTEE
        for($c=0; $c < $totalnb_entreprise; $c++)
        {   
            $bol = rand(0,1);
            $chaine_couleur = "#";
            for($l = 1; $l<=6; $l++)
            {
                if($bol == 0)
                {
                    $a = rand(0,5);
                    $chaine_couleur =  $chaine_couleur.$alpha[$a];//les 26 lettre de l'alphabet
                    //$bol ++;
                }
                else{
                    $chaine_couleur =  $chaine_couleur.rand(0,9);
                    //$bol = $bol - 1 ;
                }
            }
            //echo $chaine_couleur ."<br>";
            //mettre la couelur formée dans le tableau colors
            array_push($colors, $chaine_couleur);
            
        
        
        }
        //dd($colors);
        //AFFICHER LES GRAPHES PAR PRESTATIONS, PAR SERVICES

        //Prendre touts les services et pour chaque service recupérer le total des contrats dans le mois en questions
        
        //TABKEAU QUI VA RECUPERER LES SERVICES
        $serv = [];
        //TABLEAU QUI VA RECUPER LE TOTAL DES PRESTATIONS
        $data_serv = [];
 
        //Compter toutes les prestations du mois

        $first_date = $year."-".$month."-01";
        $last_date = $year."-".$month."-".$number;

        //PARCOURIR TOUS LES SERVICES
        $all_services = Service::all();
        
        foreach($all_services as $all_services)
        {    
            $compte_prestations  = 0; 
            //LES DETAILS DES DEVIS. ON VA RECUPER LES SERVICES AVEC CA
            $toutes_reglees =  DB::table('cotations')
            ->where('cotations.date_creation', '>=', $first_date)
            ->where('cotations.date_creation', '<=', $last_date)
            ->get();
           
            foreach($toutes_reglees as $toutes_reglee)
            {   
                //QUAND IL S'AGIT DE VENTE DE MATERIEL
                if($all_services->code = "MAT")
                {
                    $compte_prestations_service =  DB::table('cotation_article')
                    ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'cotations.id_service')
                    ->where('cotation_article.cotation_id', $toutes_reglee->id)
                    ->where('cotations.id_service', '=', $all_services->id)
                    ->count();

                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }

                }
                else
                {
                     //pour récupérer le nombre total de la prestation spécifique ce mois ci
                    $compte_prestations_service =  DB::table('details_cotations')
                    ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'details_cotations.id_service')
                    ->where('details_cotations.cotation_id', $toutes_reglee->cotation_id)
                    ->where('details_cotations.service_id', '=', $all_services->id)
                    //->where('cotations.valide', 1)
                    ->count();
                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }
                }
            
            }

            if($compte_prestations != 0)
            {
                //ON VA METTRE LE NOM DU SERVICE DANS LE TABLEAU
                if($serv == null)
                {
                    array_push($serv, $all_services->libele_service);
                }
                else
                {

                    if(array_search($all_services->libele_service, $serv) == false)
                    {
                        array_push($serv, $all_services->libele_service);
                    }   
                    
                }
                array_push($data_serv, $compte_prestations);    
            }
          
           
        }
        //dd($data_serv);
        
        return view('graphs/search_monthly', compact('data', 'company', 'percent', 'francais', 'serv', 'colors', 'data_serv', 'total'));
    }


    public function YearlyChart()
    {
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE

        //LE TABLEAU QUI VA RECCUEILLIR LES ENTREPRISES
        $company = [];

        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //TABLEAU DES POURCENTAGE POUR L'ENTREPRISE
        $percent = [];
        
        //chiffre d'affaire annuel en cours
        $total_chiffre_annuel = 0;

        //LE TABLEAUD DES MOIS
        $mois_francais = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 
        'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        
        //l'année en cours
        $year = date('Y');

        //REQUETE POUR RECUPERER LA RECETTE ANNUELLE
        $first_date = date('Y')."-01-01";
        $last_date = date('Y')."-12-31";
        //dd($last_date);
        $total_annuel = 0;
        $annuelle = DB::table('factures')
        ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
        //->where('factures.annulee', 0)
        ->where('factures.date_emission', '>=', $first_date)
        ->where('factures.date_emission', '<=', $last_date)
        ->get();
        //dd($annuelle);
        foreach($annuelle as $annuelle)
        {
            $total_annuel = $total_annuel + $annuelle->montant_facture;
        }
        //dd($total_annuel);
        
        //LA BOUCLE DES 12 MOIS
        for($i = 1; $i <= 12; $i++)
        {
            //Montant total pour chaque mois
            $total = 0;
            //Total des montants dans un mois
            $somme = 0;
            //nombre de jours dans le mois
            $number = cal_days_in_month(CAL_GREGORIAN, $i, $year);

            //$last_date = $year."-".$i."-".$number;
            
            for($j = 1; $j<$number; $j++)
            {
                
                $the_date = $year."-".$i."-".$j;
                //LA REQUETE MAINTENANT
                $get =  $get = DB::table('factures')
                ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
                ->where('factures.date_emission', '=', $the_date)
                //->where('factures.annulee', "0")
                ->get();

                //FAIRE UN FOREACH POUR FAIRE LA SOMME
                foreach($get as $all)
                {
                    //echo $all->montant."<br";
                    $somme = $somme + $all->montant_facture;
                }
                

            }
            $total = $total + $somme;
            //METTRE DANS LE TABLEAU data
            array_push($data, $total); 
            
        } 
        //dd($data);
        //NOMBRE TOTAL DES ENTREPRISE
        $totalnb_entreprise = 0;

        
        $toutes_reglees = DB::table('factures')
        ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
        //->where('factures.annulee', 0)
        ->where('factures.date_emission', '>=', $first_date)
        ->where('factures.date_emission', '<=', $last_date)
        ->get(['factures.*', 'cotations.id',]);
        //dd($toutes_reglees);
        
        //PAR CLIENT 
        $all_entreprises = Client::all();
        //Prendre toutes les entreprises et pour chaque entreprise recupérer le montant des contrats dans le mois en questions
        foreach($all_entreprises as $all_entreprises )
        {   
        
            $montant = 0;
            $the_date = $year."-".$i."-".$j;
            //LA REQUETE MAINTENANT
            $contrats =  DB::table('factures')
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
            //->where('factures.annulee', 0)
            ->where('factures.date_emission', '>=', $first_date)
            ->where('factures.date_emission', '<=', $last_date)
            ->where('cotations.id_client', '=', $all_entreprises->id)
            ->get();

            foreach($contrats as $contrats)
            {
                $montant = $montant + $contrats->montant_facture;
            }
            //METTRE LES VALLEURS DANS LES DIFFERENTS TABLEAUX
            if($montant != 0) //Si cette entreprise a rapporter quelque chose il faut remplir dans le tableu pour le gaph
            {   
                //dump('i');
                $totalnb_entreprise = $totalnb_entreprise + 1;
                array_push($company, $all_entreprises->nom);
                //CALCULER LE POURCENTAGE ET METTRE DANS LE TABLEAU
                $p = ($montant * 100) / $total_annuel;

                array_push($percent, $p);

            }  
            //dump($company);
            //echo $total."<br>";
        
        }
        //dd($percent);

        //ON AURA $totalnb_entreprise COULEURS DONC FAIRE UN TABLEAU QUI VA AVOIR LE NOMRE TOTAL DE COULEUR DIFFERENTES
        $alpha = ['A', 'B', 'C', 'D', 'E', 'F', ];
        $colors = [];
        //FAIRE UNE BOUCLE POUR CONCEVOIR LA COULEUR DE CHAQUE ENTREPRISE DETECTEE
        for($c=0; $c < $totalnb_entreprise; $c++)
        {   
            $bol = rand(0,1);
            $chaine_couleur = "#";
            for($l = 1; $l<=6; $l++)
            {
                if($bol == 0)
                {
                    $a = rand(0,5);
                    $chaine_couleur =  $chaine_couleur.$alpha[$a];//les 26 lettre de l'alphabet
                    //$bol ++;
                }
                else{
                    $chaine_couleur =  $chaine_couleur.rand(0,9);
                    //$bol = $bol - 1 ;
                }
            }
        //echo $chaine_couleur ."<br>";
            //mettre la couelur formée dans le tableau colors
            array_push($colors, $chaine_couleur);
            //dd($colors);
        
        }

        //AFFICHER LES GRAPHES PAR PRESTATIONS, PAR SERVICES

        //Prendre touts les services et pour chaque service recupérer le total des contrats dans l'année en questions
    
        //TABKEAU QUI VA RECUPERER LES SERVICES
        $serv = [];
        //TABLEAU QUI VA RECUPER LE TOTAL DES PRESTATIONS
        $data_serv = [];

        //Compter toutes les prestations de l'année

        $first_date = $year."-01-01";
        $last_date = $year."-12-31";
        
        //PARCOURIR TOUS LES SERVICES
        $all_services = Service::all();
       
        foreach($all_services as $all_services)
        {    
            $compte_prestations  = 0; 
            //LES DETAILS DES DEVIS. ON VA RECUPER LES SERVICES AVEC CA
            $toutes_reglees =  DB::table('cotations')
            ->where('cotations.date_creation', '>=', $first_date)
            ->where('cotations.date_creation', '<=', $last_date)
            ->get();
           
            foreach($toutes_reglees as $toutes_reglee)
            {   
                //QUAND IL S'AGIT DE VENTE DE MATERIEL
                if($all_services->code = "MAT")
                {
                    $compte_prestations_service =  DB::table('cotation_article')
                    ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'cotations.id_service')
                    ->where('cotation_article.cotation_id', $toutes_reglee->id)
                    ->where('cotations.id_service', '=', $all_services->id)
                    ->count();

                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }

                }
                else
                {
                     //pour récupérer le nombre total de la prestation spécifique ce mois ci
                    $compte_prestations_service =  DB::table('details_cotations')
                    ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'details_cotations.id_service')
                    ->where('details_cotations.cotation_id', $toutes_reglee->cotation_id)
                    ->where('details_cotations.service_id', '=', $all_services->id)
                    //->where('cotations.valide', 1)
                    ->count();
                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }
                }
            
            }

            if($compte_prestations != 0)
            {
                //ON VA METTRE LE NOM DU SERVICE DANS LE TABLEAU
                if($serv == null)
                {
                    array_push($serv, $all_services->libele_service);
                }
                else
                {

                    if(array_search($all_services->libele_service, $serv) == false)
                    {
                        array_push($serv, $all_services->libele_service);
                    }   
                    
                }
                array_push($data_serv, $compte_prestations);    
            }
          
           
        }
        return view('graphs/yearly', compact('data', 'mois_francais', 'percent', 'company', 'serv', 'data_serv', 'colors', 'total_annuel'));
    }

    public function SearchYear(Request $request)
    {
        
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE

        //LE TABLEAU QUI VA RECCUEILLIR LES ENTREPRISES
        $company = [];

        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //TABLEAU DES POURCENTAGE POUR L'ENTREPRISE
        $percent = [];

        //chiffre d'affaire annuel en cours
        $total_chiffre_annuel = 0;

        //LE TABLEAUD DES MOIS
        $mois_francais = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 
        'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        //l'année en cours
        $year_get = date_parse($request->year);

        $year = $year_get['year'];
        //dd($year);
        //REQUETE POUR RECUPERER LA RECETTE ANNUELLE
        $first_date = $year."-01-01";
        $last_date = $year."-12-31";
        //dd($first_date);
        $total_annuel = 0;
        $annuelle = DB::table('factures')
        ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
        //->where('factures.annulee', 0)
        ->where('factures.date_emission', '>=', $first_date)
        ->where('factures.date_emission', '<=', $last_date)
        ->get();
        //dd($annuelle);
        foreach($annuelle as $annuelle)
        {
            $total_annuel = $total_annuel + $annuelle->montant_facture;
        }
        //dd($total_annuel);
        
        //LA BOUCLE DES 12 MOIS
        for($i = 1; $i <= 12; $i++)
        {
            //Montant total pour chaque mois
            $total = 0;
            //Total des montants dans un mois
            $somme = 0;
            //nombre de jours dans le mois
            $number = cal_days_in_month(CAL_GREGORIAN, $i, $year);

            //$last_date = $year."-".$i."-".$number;
            
            for($j = 1; $j<$number; $j++)
            {
                
                $the_date = $year."-".$i."-".$j;
                //LA REQUETE MAINTENANT
                $get =  $get = DB::table('factures')
                ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
                ->where('factures.date_emission', '=', $the_date)
                //->where('factures.annulee', "0")
                ->get();

                //FAIRE UN FOREACH POUR FAIRE LA SOMME
                foreach($get as $all)
                {
                    //echo $all->montant."<br";
                    $somme = $somme + $all->montant_facture;
                }
                

            }
            $total = $total + $somme;
            //METTRE DANS LE TABLEAU data
            array_push($data, $total); 
            
        } 
        //dd($data);
        //NOMBRE TOTAL DES ENTREPRISE
        $totalnb_entreprise = 0;

        
        $toutes_reglees = DB::table('factures')
        ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
        //->where('factures.annulee', 0)
        ->where('factures.date_emission', '>=', $first_date)
        ->where('factures.date_emission', '<=', $last_date)
        ->get(['factures.*', 'cotations.id',]);
        //dd($toutes_reglees);
        
        //PAR CLIENT 
        $all_entreprises = Client::all();
        //Prendre toutes les entreprises et pour chaque entreprise recupérer le montant des contrats dans le mois en questions
        foreach($all_entreprises as $all_entreprises )
        {   
        
            $montant = 0;
            $the_date = $year."-".$i."-".$j;
            //LA REQUETE MAINTENANT
            $contrats =  DB::table('factures')
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
            //->where('factures.annulee', 0)
            ->where('factures.date_emission', '>=', $first_date)
            ->where('factures.date_emission', '<=', $last_date)
            ->where('cotations.id_client', '=', $all_entreprises->id)
            ->get();

            foreach($contrats as $contrats)
            {
                $montant = $montant + $contrats->montant_facture;
            }
            //METTRE LES VALLEURS DANS LES DIFFERENTS TABLEAUX
            if($montant != 0) //Si cette entreprise a rapporter quelque chose il faut remplir dans le tableu pour le gaph
            {   
                //dump('i');
                $totalnb_entreprise = $totalnb_entreprise + 1;
                array_push($company, $all_entreprises->nom);
                //CALCULER LE POURCENTAGE ET METTRE DANS LE TABLEAU
                $p = ($montant * 100) / $total_annuel;

                array_push($percent, $p);

            }  
            //dump($company);
            //echo $total."<br>";
        
        }
        //dd($percent);

        //ON AURA $totalnb_entreprise COULEURS DONC FAIRE UN TABLEAU QUI VA AVOIR LE NOMRE TOTAL DE COULEUR DIFFERENTES
        $alpha = ['A', 'B', 'C', 'D', 'E', 'F', ];
        $colors = [];
        //FAIRE UNE BOUCLE POUR CONCEVOIR LA COULEUR DE CHAQUE ENTREPRISE DETECTEE
        for($c=0; $c < $totalnb_entreprise; $c++)
        {   
            $bol = rand(0,1);
            $chaine_couleur = "#";
            for($l = 1; $l<=6; $l++)
            {
                if($bol == 0)
                {
                    $a = rand(0,5);
                    $chaine_couleur =  $chaine_couleur.$alpha[$a];//les 26 lettre de l'alphabet
                    //$bol ++;
                }
                else{
                    $chaine_couleur =  $chaine_couleur.rand(0,9);
                    //$bol = $bol - 1 ;
                }
            }
        //echo $chaine_couleur ."<br>";
            //mettre la couelur formée dans le tableau colors
            array_push($colors, $chaine_couleur);
            //dd($colors);
        
        }

        //AFFICHER LES GRAPHES PAR PRESTATIONS, PAR SERVICES

        //Prendre touts les services et pour chaque service recupérer le total des contrats dans l'année en questions
    
        //TABKEAU QUI VA RECUPERER LES SERVICES
        $serv = [];
        //TABLEAU QUI VA RECUPER LE TOTAL DES PRESTATIONS
        $data_serv = [];

        //Compter toutes les prestations de l'année

        $first_date = $year."-01-01";
        $last_date = $year."-12-31";
        
        //PARCOURIR TOUS LES SERVICES
        $all_services = Service::all();
       
        foreach($all_services as $all_services)
        {    
            $compte_prestations  = 0; 
            //LES DETAILS DES DEVIS. ON VA RECUPER LES SERVICES AVEC CA
            $toutes_reglees =  DB::table('cotations')
            ->where('cotations.date_creation', '>=', $first_date)
            ->where('cotations.date_creation', '<=', $last_date)
            ->get();
           
            foreach($toutes_reglees as $toutes_reglee)
            {   
                //QUAND IL S'AGIT DE VENTE DE MATERIEL
                if($all_services->code = "MAT")
                {
                    $compte_prestations_service =  DB::table('cotation_article')
                    ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'cotations.id_service')
                    ->where('cotation_article.cotation_id', $toutes_reglee->id)
                    ->where('cotations.id_service', '=', $all_services->id)
                    ->count();

                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }

                }
                else
                {
                     //pour récupérer le nombre total de la prestation spécifique ce mois ci
                    $compte_prestations_service =  DB::table('details_cotations')
                    ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                    ->join('services', 'services.id', '=', 'details_cotations.id_service')
                    ->where('details_cotations.cotation_id', $toutes_reglee->cotation_id)
                    ->where('details_cotations.service_id', '=', $all_services->id)
                    //->where('cotations.valide', 1)
                    ->count();
                    if($compte_prestations_service != 0)
                    {   
                        $compte_prestations++;
                    }
                }
            
            }

            if($compte_prestations != 0)
            {
                //ON VA METTRE LE NOM DU SERVICE DANS LE TABLEAU
                if($serv == null)
                {
                    array_push($serv, $all_services->libele_service);
                }
                else
                {

                    if(array_search($all_services->libele_service, $serv) == false)
                    {
                        array_push($serv, $all_services->libele_service);
                    }   
                    
                }
                array_push($data_serv, $compte_prestations);    
            }
          
           
        }
        
        return view('graphs/search_yearly', compact('data', 'mois_francais', 'percent', 'company', 'data_serv', 'serv', 'year', 'colors', 'total_annuel'));
    }

    public function NewCustomerInYear()
    {
        //FAIRE UNE BOUCLE POUR TOUS LES MOIS DE L'ANNEE

        //LE TABLEAU QUI VA RECCUEILLIR LES ENTREPRISES
        $company = [];

        //LE TABLEAU QUI VA RECCUEILLIR LES DONNES 
        $data = [];

        //NOMBRE DES CLIENTS AU TOTAL
        $customers = [];

        //LE TABLEAUD DES MOIS
        $mois_francais = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 
        'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        
        //l'année en cours
        $year = date('Y');

        //REQUETE POUR RECUPERER LES NOUVEAUX CLIENTS
        
        $get =  DB::table('entreprises')
        ->where('id_statutentreprise', 2)
        ->get();
        //dd($total_annuel);
        //FAIRE UN FOREACH POUR FAIRE LA SOMME
        
        //LA BOUCLE DES 12 MOIS
        for($i = 1; $i <= 12; $i++)
        {
            //total pour chaque mois
            $total = 0;
            
            //nombre de jours dans le mois
            $number = cal_days_in_month(CAL_GREGORIAN, $i, $year);

            $first_date = date('Y')."-".$i."-01";
            $last_date = date('Y')."-".$i."-".$number;
            foreach($get as $all)
            {   
                
                if($all->client_depuis != NULL)
                {
                    if($all->client_depuis >= $first_date AND $all->client_depuis <= $last_date)
                    {
                        $total = $total++;
                        array_push($company, $all->nom_entreprise);
                        array_push($customers, 1);
                    }
                }
                else
                {
                    $to_convert = date('d/m/Y',strtotime($all->created_at));
                    if($to_convert >= $first_date AND $to_convert <= $last_date)
                    {
                        $total = $total++;
                        array_push($company, $all->nom_entreprise);
                        array_push($customers, 1);
                    }
                }
                
            } 
            array_push($data, $total); 
        
        }
        
        
        return view('graph/newcustomery', compact('data', 'mois_francais',  'company' , 'year', 'customers'));
    }

    public function GenerateNumDevis($date)
    {
        //$service
        //dd($date);
         $date_aujourdhui = Date('Y-m-d');
         //dd($date_aujourdhui);
        $recup_les_devis = Cotation::where('date_creation', $date)->count();
        //dd($recup_les_devis);
        if($recup_les_devis != 0 )
        {
           
            //IL EXISTE DES FACTURES
            //ON INCREMENTE LE DERNIER ID
            $nouveau_id = $recup_les_devis + 1;
            //CONVERTIR EN STRING
            $to_chaine = strval($nouveau_id);
            //FAIRE LA DIFFRENCE POUR LA TAILLE EN VU DE VOIR LE NOMRE DE ZERO A AJOUTER 
            $taille_to_chaine = strlen($to_chaine);
            $diff_taille = 3 - $taille_to_chaine;
            //dd($diff_taille);
            $i= 0;
            $id = "";
            //FAIRE UNE BOUCLE POUR ECRIRE L'ID A LA SUITE DU CODE DU SERVIE
            while ($i < $diff_taille) {
                $id = $id."0";
                $i++;
            }
            $id = $id."".$nouveau_id;
            //dd($id);
            $recup_les_devis = Cotation::where('date_creation', $date)->orderBy('id', 'DESC')->get('id', 'numero_devis');
             
            /*foreach($recup_les_devis as $recup)
            {
                //$serv = DB::table('services')->where('id', $service)->get(['code']);
                foreach($serv as $serv)
                {
                    
                }
            }*/

            $timestamp = strtotime($date);
            $date_f = date("Ymd",  $timestamp);
            $numero_devis = "DEVIS-".$date_f."-".$id;

            //dd($numero_devis);
           
        }
        else
        {
            //$serv = DB::table('services')->where('id', $service)->get(['code']);
            /*foreach($serv as $serv)
            {
                $numero_devis = "DEVIS-".Date('dmY')."-001";
            }*/
            //dd($numero_devis);
            $timestamp = strtotime($date);
            $date_f = date("Ymd",  $timestamp);
            $numero_devis = "DEVIS-".$date_f."-001";
           
        }

        return $numero_devis;
    }
}
