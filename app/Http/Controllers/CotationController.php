<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cotation;
use App\Models\Facture;
use DB;

class CotationController extends Controller
{
    //
    public function CreateDevis(Request $request)
    {
        //dd($request->all());
      
        $date = Date('Y-m-d');
        $timestamp = strtotime($date);
        $departtime = strtotime('+7 days', $timestamp);
        $date_valide = date("Y-m-d",  $departtime);

        if($request->service == "8")
        {
            $le_service_vente = DB::table('services')->where('code', 'MAT')->get();
            //dd($le_service_vente);
            foreach( $le_service_vente as $serv)
            {
                //dd('ici');
                $numero_devis = (new Calculator())-> GenerateNumDevis($date, $serv->id);
                //IL FAUT EVITER DE CREER DES LIGNES DE DOUBLONS SI ON ACTUALISE LA PAGE
                $doublon = Cotation::where('numero_devis', $numero_devis)->count();
                if($doublon != 0)//ON LE REDIRIGE IMMEDIATEMENT AU DEVIS
                {
                    $doublon = Cotation::where('numero_devis', $numero_devis)->get();
                    return view('forms/devis_vente',[
                        'id' => $doublon->id,
                    ]);
                }
                $create = Cotation::create(
                [ 
                    'numero_devis' => $numero_devis,
                    'date_creation' => $date, 
                    'date_validite' =>  $date_valide, 
                    'id_client' => $request->client,
                    'id_service' => $serv->id,
                    'valide' => 0,
                    'rejete' => 0,
                    'id_user' => auth()->user()->id,
                ]
            );
            }
        
            return view('forms/devis_vente',[
                'id' => $create->id,
            ]);

        }
        else {
            $numero_devis = (new Calculator())-> GenerateNumDevis($date, $request->service);
            //IL FAUT EVITER DE CREER DES LIGNES DE DOUBLONS SI ON ACTUALISE LA PAGE
            $doublon = Cotation::where('numero_devis', $numero_devis)->count();
            if($doublon != 0)//ON LE REDIRIGE IMMEDIATEMENT AU DEVIS
            {
                $doublon = Cotation::where('numero_devis', $numero_devis)->get();
                return view('forms/devis_vente',[
                    'id' => $doublon->id,
                ]);
            }
            $create = Cotation::create(
                [ 
                    'numero_devis' => $numero_devis,
                    'date_creation' => $date, 
                    'date_validite' =>  $date_valide, 
                    'id_client' => $request->client,
                    'id_service' => $request->service,
                    'valide' => 0,
                    'rejete' => 0,
                    'id_user' => auth()->user()->id,
                ]
            );

            //METTRE A JOUR LE NUMERO DE DEVIS
            //INCREMENTER EN FONCTION DE L'ORDRE PAR JOUR
        

            return view('forms/add_devis',[
                'id' => $create->id,
            ]);
        }

       

    }


    public function AddDevis(Request $request)
    {

        //dd($request->all());
        //ON VA VOIR SI Y A AUCUNE LIGNE AJOUTEE ON SE RETOUR ET ON LUI DIT IL N'A QU'AJOUTER AU MOINS UNE LIGNE
        $les_articles = DB::table('details_cotations')
        ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->where('details_cotations.cotation_id', $request->id_cotation)
        ->count();
        if($les_articles == 0)
        {
            return view('forms/add_devis',[
                'id' => $request->id_cotation,
                'error' => 'il faut au moins renseigner une ligne pour le devis!'
            ]);
        }
       

        $up = DB::table('cotations')->where('id', $request->id_cotation)
        ->update(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis' => $request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
            ]
        );
    
        return view('admins/devis')->with('success', 'Le devis a été créé!');
       /*$create = Cotation::create(
            [ 
                'date_creation' => $request->date_creation, 
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
                'valide' => 0,
                'id_user' => auth()->user()->id,
            ]
        );*/
       
        return back()->with('success', 'Le devis a été créé!');
    }

    public function CreateDevisVente(Request $request)
    {
        
        $date = Date('Y-m-d');
        $timestamp = strtotime($date);
        $departtime = strtotime('+7 days', $timestamp);
        $date_valide = date("Y-m-d",  $departtime);
        
        $le_service_vente = DB::table('services')->where('code', 'MAT')->get();
        //dd($le_service_vente);
        foreach( $le_service_vente as $serv)
        {
            //dd('ici');
            $numero_devis = (new Calculator())-> GenerateNumDevis($date, $serv->id);
            //dd($numero_devis);
             $create = Cotation::create(
            [ 
                'numero_devis' => $numero_devis,
                'date_creation' => $date, 
                'date_validite' =>  $date_valide, 
                'id_client' => $request->client,
                'id_service' => $serv->id,
                'valide' => 0,
                'rejete' => 0,
                'id_user' => auth()->user()->id,
            ]
        );
        }
       
        return view('forms/devis_vente',[
            'id' => $create->id,
        ]);

    }

    public function SaveDevisVente(Request $request)
    {
        //dd($request->all());
        $les_articles = DB::table('cotation_article')
        ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
        ->join('articles', 'cotation_article.article_id', 'articles.id')
        ->where('cotation_article.cotation_id', $request->id_cotation)
        ->count();
        if($les_articles == 0)
        {
            return view('forms/devis_vente',[
                'id' => $request->id_cotation,
                'error' => 'il faut au moins renseigner une ligne pour le devis!'
            ]);
        }
        $up = DB::table('cotations')->where('id', $request->id_cotation)
        ->update(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis' => $request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
            ]
        );

        return view('admins/devis')->with('success', 'Le devis a été créé!');

    }

    public function CancelCreation(Request $request)
    {
        $delete = DB::table('cotations')->where('id', $request->id)->delete();
        return view('admins/devis');
    }

    public function EditDevis(Request $request)
    {

        //dd($request->all());
        
        $edit = DB::table('cotations')
        ->where('id', $request->id)
        ->update(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis'=>$request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
                'id_service' => $request->service,
                'id_user' => auth()->user()->id,
            ]
        );
        /*
        if(isset($request->SUR))//SI IL A COCHE LA CASE DE LA PERMISSION SUPPRIMER
        {
            //dd('dd');
            //SI Y A DEJA UNE OCCURENCE DE L'ELEMENT, ON NE FAIT RIEN 
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->SUR)->count();
            if($v == 0)
            {
                //Y A RIEN DONC ON PEUT AJOUTER
                DB::table('cotation_service')->insert(['cotation_id' => $request->id, 'service_id' => $request->SUR]);
            }else{}
            
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 1)->delete();
            
        }
        
        if(isset($request->SECURINC))//SI IL A COCHE CETTE CASE
        {
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->SECURINC)->count();
            if($v == 0)
            {  DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->SECURINC]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 3)->delete();
            
        }
        if(isset($request->AM))
        {
            
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->AM)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->AM]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 4)->delete();
            
        }
        if(isset($request->FORM))
        {
            //dd('da');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->FORM)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->FORM]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 5)->delete();
            
        }
        if(isset($request->DEV))
        {
            //dd('dadcv');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->DEV)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->DEV]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 6)->delete();
            
        }
        if(isset($request->HEB))
        {
            //dd('df');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->HEB)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->HEB]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 7)->delete();
            
        }
       
        if(isset($request->MAT))
        {
            //dd('a');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->MAT)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->MAT]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 8)->delete();
            
        }*/

        return back()->with(
            'success', 'Modification effectuée avec succès'
        );
     
    }

    public function GoFormLines(Request $request)
    {
        return view('forms/form_edit_lines',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function GoEdit(Request $request)
    {
        //dd($request->all());
        return view('livewire/cotations/edit',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function GetById($id)
    {
        $get = DB::table('cotations')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->where('cotations.id', $id)
        ->get(['cotations.*', 'clients.nom']);

        return $get;
    }

    public function GetDevis($id)
    {
        $get = DB::table('cotations')
        ->where('cotations.id', $id)
        ->get(['cotations.*']);

        return $get;
    }

    public function AddLines(Request $request)
    {
        //dd($request->all());
        $servs = DB::table('services')->get();
        if(isset($request->service8))
        {
            $insert =  DB::table('cotation_article')->where('cotation_id', $request->id_cotation)
            ->where('article_id', $request->service8)->update(['article_id' => $request->article,'quantite' => $request->qte,]);
        }
        if(isset($request->service1))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service1)
            ->update(['prix_ht' => $request->prix_ht1,'duree_mois' => $request->mois1,
            'duree_jours' => $request->jours1,'duree_semaines' => $request->semaines1,]);
        }
        if(isset($request->service2))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service2)
            ->update(['prix_ht' => $request->prix_ht2,'duree_mois' => $request->mois2,
            'duree_jours' => $request->jours2,'duree_semaines' => $request->semaines2,]);
        }
        if(isset($request->service3))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service3)
            ->update(['prix_ht' => $request->prix_ht3,'duree_mois' => $request->mois3,
            'duree_jours' => $request->jours3,'duree_semaines' => $request->semaines3,]);
        }
        if(isset($request->service4))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service4)
            ->update(['prix_ht' => $request->prix_ht4,'duree_mois' => $request->mois4,
            'duree_jours' => $request->jours4,'duree_semaines' => $request->semaines4,]);
        }
        if(isset($request->service5))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service5)
            ->update(['prix_ht' => $request->prix_ht5,'duree_mois' => $request->mois5,
            'duree_jours' => $request->jours5,'duree_semaines' => $request->semaines5,]);
        }
        if(isset($request->service6))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service6)
            ->update(['prix_ht' => $request->prix_ht6,'duree_mois' => $request->mois6,
            'duree_jours' => $request->jours6,'duree_semaines' => $request->semaines6,]);
        }
        if(isset($request->service7))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service7)
            ->update(['prix_ht' => $request->prix_ht7,'duree_mois' => $request->mois7,
            'duree_jours' => $request->jours7,'duree_semaines' => $request->semaines7,]);
        }
        if(isset($request->service8))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service8)
            ->update(['prix_ht' => $request->prix_ht8,'duree_mois' => $request->mois8,
            'duree_jours' => $request->jours8,'duree_semaines' => $request->semaines8,]);
        }
    
        return back()->with('success', 'Enregistrement effecuté');
    }

    public function EditLines(Request $request)
    {
        
        //dd($request->all());
        if(isset($request->idd1))
        {
            $add = DB::table('details_cotations')->where('id', $request->idd1)
            ->update([
                'designation' => $request->designation1,
                'prix_ht' => $request->prix1,
                'duree' => $request->duree1,
                'duree_type' => $request->duree_type1,
                
        ]);
        }
       if(isset($request->idd2))
       {
            $add = DB::table('details_cotations')
            ->where('id', $request->idd2)
            ->update([
           
                'designation' => $request->designation2,
                'prix_ht' => $request->prix2,
                'duree' => $request->duree2,
                'duree_type' => $request->duree_type2,
                   
          ]);
       }

       if(isset($request->idd3))
       {
            $add = DB::table('details_cotations')
            ->where('id', $request->idd3)
            ->update([
                'designation' => $request->designation3,
                'prix_ht' => $request->prix3,
                'duree' => $request->duree3,
                'duree_type' => $request->duree_type3,
                   
          ]);
       }
       if(isset($request->idd4))
       {
            $add = DB::table('details_cotations')
            ->where('id', $request->idd4)
            ->update([
                'designation' => $request->designation4,
                'prix_ht' => $request->prix4,
                'duree' => $request->duree4,
                'duree_type' => $request->duree_type4,
                   
          ]);
       }
       if(isset($request->idd5))
       {
            $add = DB::table('details_cotations')
            ->where('id', $request->idd5)
            ->update([
               
                'designation' => $request->designation5,
                'prix_ht' => $request->prix5,
                'duree' => $request->duree5,
                'duree_type' => $request->duree_type5,
                   
          ]);
       }

        if(isset($request->idd6))
       {
            $add = DB::table('details_cotations')
            ->where('id', $request->idd6)
            ->update([
              
                'designation' => $request->designation6,
                'prix_ht' => $request->prix6,
                'duree' => $request->duree6,
                'duree_type' => $request->duree_type6,
                   
          ]);
       }


       if(isset($request->idd7))
       {
            $add = DB::table('details_cotations')
            ->where('id', $request->idd7)
            ->update([
              
                'designation' => $request->designation7,
                'prix_ht' => $request->prix7,
                'duree' => $request->duree7,
                'duree_type' => $request->duree_type7,
                   
          ]);
       }

       if(isset($request->idd8))
       {
            $add = DB::table('details_cotations')
            ->where('cotation_id', $request->idd8)
            ->update([
                'designation' => $request->designation8,
                'prix_ht' => $request->prix8,
                'duree' => $request->duree8,
                'duree_type' => $request->duree_type8,
                   
          ]);
       }
       if(isset($request->idd9))
       {
            $add = DB::table('details_cotations')
            ->where('cotation_id', $request->idd9)
            ->update([
       
                'designation' => $request->designation9,
                'prix_ht' => $request->prix9,
                'duree' => $request->duree9,
                'duree_type' => $request->duree_type9,
                   
          ]);
       }
       if(isset($request->idd10))
       {
            $add = DB::table('details_cotations')
            ->where('cotation_id', $request->idd10)
            ->update([
                'designation' => $request->designation10,
                'prix_ht' => $request->prix10,
                'duree' => $request->duree10,
                'duree_type' => $request->duree_type10,
                   
          ]);
       }
        return back()->with('success', 'Modification effectuée');
    }

    public function EditLineAs(Request $request)
    {
        /*$add = DB::table('cotation_article')->where('cotation_id', $request->id)->get();
        dd($add);*/
       //dd($request->all());

         if(isset($request->idd1))
        {
            //dd('ici');
            $add = DB::table('cotation_article')->where('id', $request->idd1)
            ->update([
                        'article_id' => $request->article1,
                        'quantite' => $request->qte1,
                        'pu' => $request->pu1,
            ]);
           //
            //dd($add);
        }
        if(isset($request->idd2))
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idd2)
            ->update([
                        'article_id' => $request->article2,
                        'quantite' => $request->qte2,
                        'pu' => $request->pu2,
            ]);
        }
        if(isset($request->idd3))
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idd3)
            ->update([
                        'article_id' => $request->article3,
                        'quantite' => $request->qte3,
                        'pu' => $request->pu3,
            ]);
        }
        if(isset($request->idd4))
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idd4)
            ->update([
                        'article_id' => $request->article4,
                        'quantite' => $request->qte4,
                        'pu' => $request->pu4,
            ]);
        }
        if(isset($request->idd5))
        {
            $add = DB::table('cotation_article')
           ->where('id', $request->idd5)
            ->update([
                        'article_id' => $request->article5,
                        'quantite' => $request->qte5,
                        'pu' => $request->pu5,
            ]);
        }
        if(isset($request->article6))
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idd6)
            ->update([
                        'article_id' => $request->article6,
                        'quantite' => $request->qte6,
                        'pu' => $request->pu6,
            ]);
        }
        if(isset($request->idd7))
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idd7)
            ->update([
                        'article_id' => $request->article7,
                        'quantite' => $request->qte7,
                        'pu' => $request->pu7,
            ]);
        }

        if(isset($request->idd8))
        {
            $add = DB::table('cotation_article')
           ->where('id', $request->idd8)
            ->update([
                        'article_id' => $request->article8,
                        'quantite' => $request->qte8,
                        'pu' => $request->pu8,
            ]);
        }

        if(isset($request->idd9))
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idd9)
            ->update([
                        'article_id' => $request->article9,
                        'quantite' => $request->qte9,
                        'pu' => $request->pu9,
            ]);
        }
       
        return back()->with('success', 'Modification effectuée');

    }

    public function TryDelete(Request $request)
    {
        //dd($request->all());
        //VOIR SI Y A PAS DES FACTURES
        $v = DB::table('factures')->where('id_cotation', $request->id)->count();
        if($v == 0)
        {
            //ON PEUT SUPPRIMER TRANQUIELLEMENT
            Cotation::destroy($request->id);

            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Ce devis ne peut être supprimé car il y a des factures associées');
        }
        //SUPPRIMER TOUS SES FILS
        $l = DB::table('cotation_service')->where('cotation_id', $request->id)->get();
        foreach($l as $l)
        {
            $delete = DB::table('cotation_service')->where('id', $l->id)->delete();
        }
        $b = DB::table('cotation_article')->where('cotation_id', $request->id)->get();
        foreach($b as $b)
        {
            $delete = DB::table('cotation_article')->where('id', $b->id)->delete();
        }
    }

    public function GoDetails(Request $request)
    {
        return view('livewire/cotations/seedevis',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function PrintDevis(Request $request)
    {
        return view('livewire/cotations/devis-print',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function GetLinesinfoCustomer($id)
    {
        $get = DB::table('cotations')->where('cotations.id', $id)
        //->join('cotations', 'cotation_service.cotation_id', '=', 'cotations.id')
        ->join('services', 'cotations.id_service', '=', 'services.id')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->limit(1)
        ->get(['cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'clients.nom', 'clients.adresse', 'clients.telephone', 'clients.activite',
                'clients.adresse_email', 'adresse_facturation', 'clients.numero_contribuable',
                'services.libele_service', 'services.code'
            ]);

        //dd($get);
        
        return $get;
    }

    public function GetLines($id)
    {
        $get = DB::table('details_cotations')->where('cotation_id', $id)
        ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->join('services', 'cotations.id_service', '=', 'services.id')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->get(['details_cotations.*', 'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'clients.nom', 'clients.adresse', 'clients.telephone', 'clients.activite',
                'clients.adresse_email', 'adresse_facturation', 'clients.numero_contribuable',
                'services.libele_service', 'services.code'
            ]);

       //dd($get);
        
        return $get;
    }

    public function GetArticleLines($id)
    {
        //dd('ici');
        $get = DB::table('cotation_article')->where('cotation_id', $id)
        ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
        ->join('articles', 'cotation_article.article_id', '=', 'articles.id')
        ->join('typearticles', 'articles.id_typearticle', '=', 'typearticles.id')
        ->join('services', 'cotations.id_service', '=', 'services.id')
        ->get(['cotation_article.*', 'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'articles.designation', 'articles.code', 'articles.prix_unitaire',
                'services.code', 'services.libele_service'
            ]);
        //dd($get);
        return $get;
    }

    public function EnableTaxe(Request $request)
    {
        //dd('ici');
        $v = DB::table('taxes')->get();
        foreach($v as $v)
        {
            if($v->active == 0)
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 1, 'date_activation' => $today]);
        
                return view('livewire/cotations/seedevis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été activée'
                ]);
            }
            else
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 0]);
        
                return view('livewire/cotations/seedevis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été désactivée'
                ]);
            }
        }
    }

    public function EnableTVA(Request $request)
    {
        $today = Date('Y-m-d');
        $v = DB::table('taxes')->get();
        foreach($v as $v)
        {
            if($v->active == 0)
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 1, 'date_activation' => $today]);
        
                return view('admins/devis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été activée'
                ]);
            }
            else
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 0]);
        
                return view('admins/devis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été désactivée'
                ]);
            }
        }
       
    }

    public function AddaService(Request $request)
    {
        //dd($request->all());
        $add = DB::table('details_cotations')
        ->insert(['cotation_id' => $request->id_cotation,
                    'designation' => $request->designation,
                    'prix_ht' => $request->prix,
                    'duree' => $request->duree,
                    'duree_type' => $request->duree_type,
                   
          ]);
          return back()->with('success', 'Opération effectuée avec succès');
    }

    public function AddAnArticle(Request $request)
    {
        $add = DB::table('cotation_article')
        ->insert(['cotation_id' => $request->id_cotation,
                    'article_id' => $request->article,
                    'quantite' => $request->qte,
                    'pu' => $request->pu
          ]);
          return back()->with('success', 'Opération effectuée avec succès');
    }

    public function AddLineArticle(Request $request)
    {
        //dd($request->all());
        if(isset($request->article))
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article,
                        'quantite' => $request->qte,
                        'pu' => $request->pu,
            ]);
        }
        if($request->article1 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article1,
                        'quantite' => $request->qte1,
                        'pu' => $request->pu1,
            ]);
        }
        if($request->article2 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article2,
                        'quantite' => $request->qte2,
                        'pu' => $request->pu2,
            ]);
        }
        if($request->article3 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article3,
                        'quantite' => $request->qte3,
                        'pu' => $request->pu3,
            ]);
        }
        if($request->article4 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article4,
                        'quantite' => $request->qte4,
                        'pu' => $request->pu4,
            ]);
        }
        if($request->article5 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article5,
                        'quantite' => $request->qte5,
                        'pu' => $request->pu5,
            ]);
        }
        if($request->article6 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article6,
                        'quantite' => $request->qte6,
                        'pu' => $request->pu6,
            ]);
        }
        if($request->article7 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article7,
                        'quantite' => $request->qte7,
                        'pu' => $request->pu7,
            ]);
        }

        if($request->article8 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article8,
                        'quantite' => $request->qte8,
                        'pu' => $request->pu8,
            ]);
        }

        if($request->article9 != "--")
        {
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article9,
                        'quantite' => $request->qte9,
                        'pu' => $request->pu9,
            ]);
        }
       

        return view('forms/devis_vente',[
            'id' => $request->id_cotation,
        ]);
    }

    public function EditLineArticle(Request $request)
    {
        //dd($request->all());
        $add = DB::table('cotation_article')->where('id', $request->id)
        ->update([
                    'article_id' => $request->article,
                    'quantite' => $request->qte,
                    'pu' => $request->pu,
        ]);

        return view('forms/devis_vente',[
            'id' => $request->id_cotation,
        ]);
    }

    public function UpdateRejeter(Request $request)
    {
        //dd($request->all());
        $edit = DB::table('cotations')->where('id', $request->id)
        ->update(['rejete' => $request->rejeter, 'motif' => $request->motif]);

        //SI C'EST REJETE SUPPRIMER TOUTES LES FACTURES EVENTUELLES 
        //$search = DB::

        return back()->with('success', 'Modification effectuée');
    }

    public function ValideCotation(Request $request)
    {
        //dd($request->all());
        $somme = 0;
        $services = DB::table('cotation_service')->where('cotation_id', $request->id)
        ->join('cotations', 'cotation_service.cotation_id', '=', 'cotations.id')
        ->join('services', 'cotation_service.service_id', '=', 'services.id')
        ->get(['cotation_service.*', 'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'services.libele_service', 'services.code'
            ]);
        //dd($services);
        foreach($services as $services)
        {
            if($services->code == "MAT")
            {
                //dd('i');
                $a = DB::table('cotation_article')->where('cotation_id', $request->id)
                ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                ->join('articles', 'cotation_article.article_id', '=', 'articles.id')
                ->get(['cotation_article.*',
                        'articles.designation', 'articles.code', 'articles.prix_unitaire',
                ]);

                foreach($a as $a)
                {
                    $total = $a->quantite * $a->prix_unitaire;
                    $somme = $somme + $total;
                }

            }
            else{
                //dd('ip');
                $somme = $somme + $services->prix_ht;
            }
        }
        //dd($somme);

      
        $count = Facture::count();
        //dd($count);
        if($count != 0)
        {
            $last = Facture::orderBy('created_at', 'DESC')->limit(1)->get();
            foreach($last as $last)
            {
                $number = $last->id + 1;
                $num = 'INV'.$number;
                $today = date('Y-m-d');
                $timestamp = strtotime($today);
                $departtime1 = strtotime('+15 days', $timestamp);
                $result_date = date("Y-m-d", $departtime1 );
            }
            $insert = Facture::create([
                'numero_facture' => $num, 
                'date_reglement' => $result_date, 'date_emission' => $today, 
                'montant_facture' => $somme , 'id_cotation' => $request->id, 
                'reglee' => 0, 'annulee' => 0, 'id_user' => auth()->user()->id,
            ]);
        }
        else
        {
            $num = 'INV1';
            $today = date('Y-m-d');
            $timestamp = strtotime($today);
            $departtime1 = strtotime('+15 days', $timestamp);
            $result_date = date("Y-m-d", $departtime1 );
            //dd($depart);
            $insert = Facture::create([
                'numero_facture' => $num, 
                'date_reglement' => $result_date, 'date_emission' => $today, 
                'montant_facture' => $somme , 'id_cotation' => $request->id, 
                'reglee' => 0, 'annulee' => 0, 'id_user' => auth()->user()->id,
            ]);
        }
        //Ne pas oublier de valider le devis
        $valider_devis = DB::table('cotations')->where('id', $request->id)
        ->update(['valide' => 1]);

        return back()->with('success', 'Devis validé');
    }

    public function CancelValideCotation(Request $request)
    {
 
        //Ne pas oublier de valider le devis
        $valider_devis = DB::table('cotations')->where('id', $request->id)
        ->update(['valide' => 0]);

        return back()->with('success', 'Modification effectuée');
    }

    /*<div class="col-sm-3">
        <div class="form-group">
        <label>Ajouter un service:</label>
        <select  class="form-control" name="" id="selservice" onchange="displayLine();" required>
            @php
                $get_serv = $servicecontroller->GetAll();
            @endphp
            <option value="">--Choisir--</option>
            @foreach($get_serv as $serv)
                @if($serv->code == "MAT")
                    @break
                @endif
                <option value="{{$serv->code}}">{{$serv->libele_service}}</option>

            @endforeach
        </select>
        
        </div>
    </div>
    <hr>
                                        <p><b><i>Décocher pour supprimer le service</i></b></p>
                                        @php
                                            $services = DB::table('services')->get();
                                        @endphp
                                    
                                        @foreach($services as $services)
                                            <div class="row" id="{{$services->code}}{{$services->code}}"  
                                            name="{{$services->code}}" style="display:none">
                                                @php
                                                /*$roles_u = DB::table('cotation_service')->where('i', $user->id)
                                                ->where('role_id', $services->id)->count();
                                                @endphp

                                                <!--<div class="col-sm-2">
                                                <button class="btn btn-danger" onclick="hideLine();" id="{{$services->code}}">
                                                    <span class="fa fa-times"></span>
                                                    </button>
                                                </div>-->
                                                
                                                <div class="col-sm-3">
                                                    <div class="form-check" >
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{$services->id}}" name="{{$services->code}}" 
                                                        id="{{$services->code}}" onchange="hideLine();">
                                                    <label class="form-check-label"><b>{{$services->libele_service}}</b></label>
                                                    
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix_ht{{$services->code}}"
                                                    class="form-control" placeholder="Ex:1500000" id="prix_ht{{$services->code}}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Durée:</label>
                                                    <input type="number" name="duree{{$services->code}}" min="0" value="0"
                                                    class="form-control" placeholder="Entrez ..." id="duree{{$services->code}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type{{$services->code}}" disabled id="duree_type{{$services->code}}">
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        
                                        @endforeach
                                        */
    
}
