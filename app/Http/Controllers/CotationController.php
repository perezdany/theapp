<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cotation;
use App\Models\Facture;
use DB;
//use PDF;
 use Barryvdh\DomPDF\Facade\Pdf;

class CotationController extends Controller
{
    //
    /*@if($cotation->valide == 0)
        @if($cotation->id_service == 8)
        <button class="btn btn-success" 
            data-toggle="modal" data-target="#serv{{$cotation->id}}" >
            <b><i class="fa fa-plus"></i></b></button>
        <div class="modal fade" id="serv{{$cotation->id}}"  
            wire:ignore.self  role="dialog" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Détails</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!--begin::Form-->
                    <form method="post" action="addanarticle">
                        <!--begin::Body-->
                        @csrf
                    
                        <input type="text" class="form-control" value="{{$cotation->id}}" wire-model="id" 
                        name="id_cotation" id="{{$cotation->id}}" style="display:none;">
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                <label>Articles:</label>
                                <select class="form-control" name="article" >
                                    @php
                                        $t = DB::table('articles')->get();
                                    @endphp
                                    
                                    @foreach($t as $t)
                                        <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                    @endforeach
                                    
                                </select>   
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Quantité:</label>
                                <input type="number" name="qte" 
                                class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Prix unitaire:</label>
                                    <input type="number" name="pu" 
                                    class="form-control">
                                </div> 
                            </div>
                        
                        </div>
                        <div class=" row modal-footer justify-content-between" style="aling:center">
                        
                        <button type="button" wire:click="close" class="btn btn-danger col-md-3" data-dismiss="modal">Fermer</button>
                
                        <button type="submit"  class="btn btn-success col-md-3">Enregistrer</button>
                                
                            
                        </div>
                        <!--end::Footer-->
                        
                    </form>
                    <!--end::Form-->
                </div> 
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>    
        
        @else
        <button class="btn btn-success" 
            data-toggle="modal" data-target="#serv{{$cotation->id}}" >
            <b><i class="fa fa-plus"></i></b></button>
        <div class="modal fade" id="serv{{$cotation->id}}"  
            wire:ignore.self  role="dialog" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Détails</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!--begin::Form-->
                    <form method="post" action="addaservice">
                        <!--begin::Body-->
                        @csrf
                    
                        <input type="text" class="form-control" value="{{$cotation->id}}" wire-model="id" 
                        name="id_cotation" id="{{$cotation->id}}" style="display:none;">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                <label>Désignation:</label>
                                    <textarea name="designation" class="form-control" >
                                
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Prix Hors taxe:</label>
                                <input type="number" name="prix" class="form-control" 
                                placeholder="un nombre..." >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Durée:</label>
                                    <input type="number" name="duree" min="0" 
                                    class="form-control" placeholder="Entrez ..."  >                                           
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Choisir:</label>
                                <select  class="form-control" name="duree_type" >
                                
                                    <option value="jours">Jours</option>
                                    <option value="mois">Mois</option>
                                    <option value="annees">Années</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class=" row modal-footer justify-content-between" style="aling:center">
                        
                        <button type="button" wire:click="close" class="btn btn-danger col-md-3" data-dismiss="modal">Fermer</button>
                
                        <button type="submit"  class="btn btn-success col-md-3">Enregistrer</button>
                                
                            
                        </div>
                        <!--end::Footer-->
                        
                    </form>
                    <!--end::Form-->
                </div> 
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>    
        
        @endif
    @else
    @endif*/
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
                $numero_devis = (new Calculator())-> GenerateNumDevis($request->date_creation, $serv->id);
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
                    'date_creation' => $request->date_creation, 
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
                    'date_creation' => $request->date_creation, 
                    'date_validite' =>  $date_valide, 
                    'id_client' => $request->client,
                    //'id_service' => $request->service,
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
        //Création du numéro devis
        $date = Date('Y-m-d');
        $timestamp = strtotime($date);
        $departtime = strtotime('+7 days', $timestamp);
        $date_valide = date("Y-m-d",  $departtime);

        $numero_devis = (new Calculator())->GenerateNumDevis($request->date_creation);
        
        //dd($numero_devis);
        //IL FAUT EVITER DE CREER DES LIGNES DE DOUBLONS SI ON ACTUALISE LA PAGE
        $doublon = Cotation::where('numero_devis', $numero_devis)->count();
        //dd($doublon);
        if($doublon != 0)//ON LE REDIRIGE IMMEDIATEMENT AU DEVIS
        {
            $doublon = Cotation::where('numero_devis', $numero_devis)->get();
            //dd($doublon);
            return view('forms/add_devis',[
                'id' => $doublon->id,
            ]);
        }
         
        $create = Cotation::create(
            [ 
                'numero_devis' => $numero_devis,
                'date_creation' => $request->date_creation, 
                'date_validite' =>  $request->date_validite, 
                'id_client' => $request->id_client,
                'id_condition' => $request->condition,
                'delais_livraison' => $request->delais_livraison,
                'valide' => 0,
                'rejete' => 0,
                'id_user' => auth()->user()->id,
            ]
        );
      
        
        /*$up = DB::table('cotations')->where('id', $request->id_cotation)
        ->update(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis' => $request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
            ]
        );*/

        //AJOUTER LES LIGNES DETAILS
        if($request->prest1 != null)
        {
            //voir c'est quel type de service pour ajouter en conséquence
            if($request->prest1 != 8)
            {
                
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest1,
                    'designation' => $request->peutmodif1,
                    'descrpt' => $request->designation1,
                    'prix_ht' => $request->prix1,
                    'duree' => $request->duree1,
                    'duree_type' => $request->duree_type1,
                    
                ]);
            }
            else
            {
                if($request->article1 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article1,
                                'quantite' => $request->qte1,
                                'pu' => $request->pu1,
                                'id_disponibilite' => $request->disponibilite1,
                    ]);
                }
            }
                
        }
        if($request->prest2 != null)
        {
            if($request->prest2 != 8)
            {
                
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest2,
                    'designation' => $request->peutmodif2,
                    'descrpt' => $request->designation2,
                    'prix_ht' => $request->prix2,
                    'duree' => $request->duree2,
                    'duree_type' => $request->duree_type2,
                    
                ]);
            }
            else
            {
                if($request->article2 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article2,
                                'quantite' => $request->qte2,
                                'pu' => $request->pu2,
                                'id_disponibilite' => $request->disponibilite2,
                    ]);
                }
            }
                
        }
        if($request->prest3 != null)
        {
            if($request->prest3 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest3,
                    'designation' => $request->peutmodif3,
                    'descrpt' => $request->designation3,
                    'prix_ht' => $request->prix3,
                    'duree' => $request->duree3,
                    'duree_type' => $request->duree_type3,
                        
                ]);
            }
            else
            {
                if($request->article3 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article3,
                                'quantite' => $request->qte3,
                                'pu' => $request->pu3,
                                'id_disponibilite' => $request->disponibilite3,
                    ]);
                }
            }
                
        }
        if($request->prest4 != null)
        {
            if($request->prest4 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest4,
                    'designation' => $request->peutmodif4,
                    'descrpt' => $request->designation4,
                    'prix_ht' => $request->prix4,
                    'duree' => $request->duree4,
                    'duree_type' => $request->duree_type4,
                        
                ]);
            }
            else
            {
                if($request->article4 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article4,
                                'quantite' => $request->qte4,
                                'pu' => $request->pu4,
                                'id_disponibilite' => $request->disponibilite4,
                    ]);
                }
            }
            
        }
        if($request->prest5 != null)
        {
            if($request->prest5 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest5,
                    'designation' => $request->peutmodif5,
                    'descrpt' => $request->designation5,
                    'prix_ht' => $request->prix5,
                    'duree' => $request->duree5,
                    'duree_type' => $request->duree_type5,
                        
                ]);
            }
            else
            {
                if($request->article5 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article5,
                                'quantite' => $request->qte5,
                                'pu' => $request->pu5,
                                'id_disponibilite' => $request->disponibilite5,
                    ]);
                }
            }
               
        }
        if($request->prest6 != null)
        {
            if($request->prest6 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                   'id_service' => $request->prest6,
                    'designation' => $request->peutmodif6,
                    'descrpt' => $request->designation6,
                    'prix_ht' => $request->prix6,
                    'duree' => $request->duree6,
                    'duree_type' => $request->duree_type6,
                    
                ]);
            }
            else
            {
                if($request->article6 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article6,
                                'quantite' => $request->qte6,
                                'pu' => $request->pu6,
                                'id_disponibilite' => $request->disponibilite6,
                    ]);
                }
            }
               
        }
        if($request->prest7 != null)
        {
            if($request->prest7 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest7,
                    'designation' => $request->peutmodif7,
                    'descrpt' => $request->designation7,
                    'prix_ht' => $request->prix7,
                    'duree' => $request->duree7,
                    'duree_type' => $request->duree_type7,
                        
                ]);
            }
            else
            {
                if($request->article7 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article7,
                                'quantite' => $request->qte7,
                                'pu' => $request->pu7,
                                'id_disponibilite' => $request->disponibilite7,
                    ]);
                }
            }
            
        }
        if($request->prest8 != null)
        {
            if($request->prest8 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest8,
                    'designation' => $request->peutmodif8,
                    'descrpt' => $request->designation8,
                    'prix_ht' => $request->prix8,
                    'duree' => $request->duree8,
                    'duree_type' => $request->duree_type8,
                        
                ]);
            }
            else
            {
                if($request->article8 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article8,
                                'quantite' => $request->qte8,
                                'pu' => $request->pu8,
                                'id_disponibilite' => $request->disponibilite8,
                    ]);
                }
            }
           
        }
        if($request->prest9 != null)
        {
            if($request->prest1 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest9,
                    'designation' => $request->peutmodif9,
                    'descrpt' => $request->designation9,
                    'prix_ht' => $request->prix9,
                    'duree' => $request->duree9,
                    'duree_type' => $request->duree_type9,
                        
                ]);
            }
            else
            {
                if($request->article9 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article9,
                                'quantite' => $request->qte9,
                                'pu' => $request->pu9,
                                'id_disponibilite' => $request->disponibilite9,
                    ]);
                }
            }
            
        }
        if($request->prest10 != null)
        {
            if($request->prest10 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest10,
                    'designation' => $request->peutmodif10,
                    'descrpt' => $request->designation10,
                    'prix_ht' => $request->prix10,
                    'duree' => $request->duree10,
                    'duree_type' => $request->duree_type10,
                        
                ]);
            }
            else
            {
                if($request->article10 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article10,
                                'quantite' => $request->qte10,
                                'pu' => $request->pu10,
                                'id_disponibilite' => $request->disponibilite10,
                    ]);
                }
            }
               
        }
        if($request->prest11 != null)
        {
            if($request->prest11 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest11,
                    'designation' => $request->peutmodif11,
                    'descrpt' => $request->designation11,
                    'prix_ht' => $request->prix11,
                    'duree' => $request->duree11,
                    'duree_type' => $request->duree_type11,
                        
                ]);
            }
            else
            {
                if($request->article11 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article11,
                                'quantite' => $request->qte11,
                                'pu' => $request->pu11,
                                'id_disponibilite' => $request->disponibilite11,
                    ]);
                }
            }
               
        }

        if($request->prest12 != null)
        {
            if($request->prest12 != 8)
            {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $create->id,
                    'id_service' => $request->prest12,
                    'designation' => $request->peutmodif12,
                    'descrpt' => $request->designation12,
                    'prix_ht' => $request->prix12,
                    'duree' => $request->duree12,
                    'duree_type' => $request->duree_type12,
                        
                ]);
            }
            else
            {
                if($request->article12 != "--")
                {
                    $add = DB::table('cotation_article')
                    ->insert(['cotation_id' => $create->id,
                                'article_id' => $request->article12,
                                'quantite' => $request->qte12,
                                'pu' => $request->pu12,
                                'id_disponibilite' => $request->disponibilite12,
                    ]);
                }
            }
               
        }
         //ON VA VOIR SI Y A AUCUNE LIGNE AJOUTEE ON SE RETOURNE ET ON LUI DIT IL N'A QU'AJOUTER AU MOINS UNE LIGNE
        $les_details = DB::table('details_cotations')
        ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->where('details_cotations.cotation_id', $create->id)
        ->count();
        if($les_details == 0)
        {
            $les_articles = DB::table('cotation_article')
            ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
            ->where('cotation_article.cotation_id', $create->id)
            ->count();
            if($les_articles == 0)
            {
                return view('forms/add_devis',[
                    'id' => $create->id,
                    'error' => 'il faut au moins renseigner une ligne pour le devis!'
                ]);
            }
           
        }

        return view('admins/devis')->with('success', 'Le devis a été créé!');
        /*$create = Cotation::create(
            [ 
                'date_creation' => $request->date_creation, 
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
                'valide' => 0,
                'id_user' => auth()->user()->id,
            ]
        );*/
       
        //return back()->with('success', 'Le devis a été créé!');
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
       
        $up = DB::table('cotations')->where('id', $request->id_cotation)
        ->update(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis' => $request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
            ]
        );

        //AJOUTER LES LIGNES DE DETAILS
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

        return view('admins/devis')->with('success', 'Le devis a été créé!');
        /*return view('forms/devis_vente',[
            'id' => $request->id_cotation,
        ]);*/

    }

    public function CancelCreation($id)
    {
        $delete = DB::table('cotations')->where('id', $id)->delete();
        return redirect('devis');
    }

    public function EditDevis(Request $request)
    {
        //dd($request->all());
        
        $edit = DB::table('cotations')
        ->where('id', $request->id_cotation)
        ->update(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis'=>$request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
                'id_service' => $request->service,  'id_condition' => $request->condition,
                'delais_livraison' => $request->delais_livraison,
                'id_user' => auth()->user()->id,
            ]
        );
        //MODIFIER LES LIGNES EXISTANTES 
        if(isset($request->idd1))
        {
            $add = DB::table('details_cotations')->where('id', $request->idd1)
            ->update([
                'id_service' => $request->prest1,
                'designation' => $request->peutmodif1,
                'descrpt' => $request->designation1,
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
                    'id_service' => $request->prest2,
                    'designation' => $request->peutmodif2,
                    'descrpt' => $request->designation2,
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
                    'id_service' => $request->prest3,
                    'designation' => $request->peutmodif3,
                    'descrpt' => $request->designation3,
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
                    'id_service' => $request->prest4,
                    'designation' => $request->peutmodif4,
                    'descrpt' => $request->designation4,
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
                    'id_service' => $request->prest5,
                    'designation' => $request->peutmodif5,
                    'descrpt' => $request->designation5,
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
                    'id_service' => $request->prest6,
                    'designation' => $request->peutmodif6,
                    'descrpt' => $request->designation6,
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
                   'id_service' => $request->pres71,
                    'designation' => $request->peutmodif7,
                    'descrpt' => $request->designation7,
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
                    'id_service' => $request->prest8,
                    'designation' => $request->peutmodif8,
                    'descrpt' => $request->designation8,
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
                    'id_service' => $request->prest9,
                    'designation' => $request->peutmodif9,
                    'descrpt' => $request->designation9,
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
                    'id_service' => $request->prest10,
                    'designation' => $request->peutmodif10,
                    'descrpt' => $request->designation10,
                    'prix_ht' => $request->prix10,
                    'duree' => $request->duree10,
                    'duree_type' => $request->duree_type10,
                    
            ]);
        }

        if(isset($request->idd11))
        {
            $add = DB::table('details_cotations')
            ->where('cotation_id', $request->idd11)
            ->update([
                'id_service' => $request->prest11,
                'designation' => $request->peutmodif11,
                'descrpt' => $request->designation11,
                'prix_ht' => $request->prix11,
                'duree' => $request->duree11,
                'duree_type' => $request->duree_type11,
                    
            ]);
        }
        if(isset($request->idd12))
        {
            $add = DB::table('details_cotations')
            ->where('cotation_id', $request->idd12)
            ->update([
                'id_service' => $request->prest12,
                'designation' => $request->peutmodif12,
                'descrpt' => $request->designation12,
                'prix_ht' => $request->prix12,
                'duree' => $request->duree12,
                'duree_type' => $request->duree_type12,
                    
            ]);
        }

        //SI Y A DE NOUVELLES LIGNES SERVICES
        if($request->prest6 != "")
        {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $request->id_cotation,
                    'id_service' => $request->prest6,
                    'designation' => $request->peutmodif6,
                    'descrpt' => $request->designation6,
                    'prix_ht' => $request->prix6,
                    'duree' => $request->duree6,
                    'duree_type' => $request->duree_type6,
                    
            ]);
        }
        if($request->prest7 != "")
        {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $request->id_cotation,
                    'id_service' => $request->prest7,
                    'designation' => $request->peutmodif7,
                    'descrpt' => $request->designation7,
                    'prix_ht' => $request->prix7,
                    'duree' => $request->duree7,
                    'duree_type' => $request->duree_type7,
                    
            ]);
        }
        if($request->prest8 != "")
        {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $request->id_cotation,
                    'id_service' => $request->prest8,
                    'designation' => $request->peutmodif8,
                    'descrpt' => $request->designation8,
                    'prix_ht' => $request->prix8,
                    'duree' => $request->duree8,
                    'duree_type' => $request->duree_type8,
                    
            ]);
        }
        if($request->prest9 != "")
        {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $request->id_cotation,
                    'id_service' => $request->prest9,
                    'designation' => $request->peutmodif9,
                    'descrpt' => $request->designation9,
                    'prix_ht' => $request->prix9,
                    'duree' => $request->duree9,
                    'duree_type' => $request->duree_type9,
                    
            ]);
        }
        if($request->prest10 != "")
        {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $request->id_cotation,
                    'id_service' => $request->prest10,
                    'designation' => $request->peutmodif10,
                    'descrpt' => $request->designation10,
                    'prix_ht' => $request->prix10,
                    'duree' => $request->duree10,
                    'duree_type' => $request->duree_type10,
                    
            ]);
        }
        if($request->prest11 != "")
        {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $request->id_cotation,
                    'id_service' => $request->prest11,
                    'designation' => $request->peutmodif11,
                    'descrpt' => $request->designation11,
                    'prix_ht' => $request->prix11,
                    'duree' => $request->duree11,
                    'duree_type' => $request->duree_type11,
                    
            ]);
        }
        if($request->prest12 != "")
        {
                $add = DB::table('details_cotations')
                ->insert([
                    'cotation_id' => $request->id_cotation,
                    'id_service' => $request->prest12,
                    'designation' => $request->peutmodif12,
                    'descrpt' => $request->designation12,
                    'prix_ht' => $request->prix12,
                    'duree' => $request->duree12,
                    'duree_type' => $request->duree_type12,
                    
            ]);
        }
        
        //ARTICLES
        if(isset($request->idda1) AND $request->idda1 != null)
        {
        
            $add = DB::table('cotation_article')->where('id', $request->idda1)
            ->update([
                        'article_id' => $request->article1,
                        'quantite' => $request->qte1,
                        'pu' => $request->pu1,
                        'id_disponibilite' => $request->disponibilite1,
            ]);
           //
            //dd($add);
        }
        if(isset($request->idda2) AND $request->idda2 != null)
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idda2)
            ->update([
                        'article_id' => $request->article2,
                        'quantite' => $request->qte2,
                        'pu' => $request->pu2,
                        'id_disponibilite' => $request->disponibilite2,
            ]);
        }
        if(isset($request->idda3) AND $request->idda3 != null)
        {
             
            $add = DB::table('cotation_article')
            ->where('id', $request->idda3)
            ->update([
                        'article_id' => $request->article3,
                        'quantite' => $request->qte3,
                        'pu' => $request->pu3,
                        'id_disponibilite' => $request->disponibilite3,
            ]);
        }
        if(isset($request->idda4) AND $request->idda4 != null)
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idda4 )
            ->update([
                        'article_id' => $request->article4,
                        'quantite' => $request->qte4,
                        'pu' => $request->pu4,
                        'id_disponibilite' => $request->disponibilite4,
            ]);
        }
        if(isset($request->idda5) AND $request->idda5 != null)
        {
            $add = DB::table('cotation_article')
           ->where('id', $request->idda5)
            ->update([
                        'article_id' => $request->article5,
                        'quantite' => $request->qte5,
                        'pu' => $request->pu5,
                        'id_disponibilite' => $request->disponibilite5,
            ]);
        }
        if(isset($request->idda6) AND $request->idda6 != null)
        {
            //dd('io');
            $add = DB::table('cotation_article')
            ->where('id', $request->idda6)
            ->update([
                        'article_id' => $request->article6,
                        'quantite' => $request->qte6,
                        'pu' => $request->pu6,
                        'id_disponibilite' => $request->disponibilite6,
            ]);
        }
        if(isset($request->idda7) AND $request->idda7  != null)
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idda7)
            ->update([
                        'article_id' => $request->article7,
                        'quantite' => $request->qte7,
                        'pu' => $request->pu7,
                        'id_disponibilite' => $request->disponibilite7,
            ]);
        }

        if(isset($request->idda8) AND $request->idda8 != null)
        {
            $add = DB::table('cotation_article')
           ->where('id', $request->idda8)
            ->update([
                        'article_id' => $request->article8,
                        'quantite' => $request->qte8,
                        'pu' => $request->pu8,
                        'id_disponibilite' => $request->disponibilite8,
            ]);
        }

        if(isset($request->idda9) AND $request->idda9 != null)
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idda9)
            ->update([
                        'article_id' => $request->article9,
                        'quantite' => $request->qte9,
                        'pu' => $request->pu9,
                        'id_disponibilite' => $request->disponibilite9,
            ]);
        }
        if(isset($request->idda10) AND $request->idda10 != null)
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idda10)
            ->update([
                        'article_id' => $request->article10,
                        'quantite' => $request->qte10,
                        'pu' => $request->pu10,
                        'id_disponibilite' => $request->disponibilite10,
            ]);
        }
         if(isset($request->idda11) AND $request->idda11 != null)
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idda11)
            ->update([
                        'article_id' => $request->article11,
                        'quantite' => $request->qte11,
                        'pu' => $request->pu11,
                        'id_disponibilite' => $request->disponibilite11,
            ]);
        }
        if(isset($request->idda12) AND $request->idda12 != null)
        {
            $add = DB::table('cotation_article')
            ->where('id', $request->idda12)
            ->update([
                        'article_id' => $request->article12,
                        'quantite' => $request->qte12,
                        'pu' => $request->pu12,
                        'id_disponibilite' => $request->disponibilite12,
            ]);
        }
       
        //NOUVELLES LIGNES
        /*if($request->article5 != "--")
        {
            dd('o');
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article5,
                        'quantite' => $request->qte5,
                        'pu' => $request->pu5,
            ]);
        }*/
        if(isset($request->article6) AND $request->article6 != null)
        {
            //dd('ici');
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article6,
                        'quantite' => $request->qte6,
                        'pu' => $request->pu6,
                        'id_disponibilite' => $request->disponibilite6,
            ]);
        }
        if(isset($request->article7) AND $request->article7 != null)
        {
            
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article7,
                        'quantite' => $request->qte7,
                        'pu' => $request->pu7,
                        'id_disponibilite' => $request->disponibilite7,
            ]);
        }
        if(isset($request->article8) AND $request->article8 != null)
        {
           
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article8,
                        'quantite' => $request->qte8,
                        'pu' => $request->pu8,
                        'id_disponibilite' => $request->disponibilit8,
            ]);
        }
        if(isset($request->article9) AND $request->article9 != null)
        {
            
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article9,
                        'quantite' => $request->qte9,
                        'pu' => $request->pu9,
                        'id_disponibilite' => $request->disponibilite9,
            ]);
        }
        if(isset($request->article10) AND $request->article10 != null)
        {
            
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article10,
                        'quantite' => $request->qte10,
                        'pu' => $request->pu10,
                        'id_disponibilite' => $request->disponibilite10,
            ]);
        }
        
        if(isset($request->article11) AND $request->article11 != null)
        {
            
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article11,
                        'quantite' => $request->qte11,
                        'pu' => $request->pu11,
                        'id_disponibilite' => $request->disponibilite11,
            ]);
        }
        if(isset($request->article12) AND $request->article12 != null)
        {
            
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article12,
                        'quantite' => $request->qte12,
                        'pu' => $request->pu12,
                        'id_disponibilite' => $request->disponibilite12,
            ]);
        }
        
        return view('livewire/cotations/edit',[
            'id' => $request->id_cotation,
            'success' => 'Modification effectuée'
        ]);

        /*return back()->with(
            'success', 'Modification effectuée avec succès'
        );*/
     
    }

    public function EditDevisMat(Request $request)
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
        if(isset($request->idd6))
        {
            //dd('io');
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

        //NOUVELLES LIGNES
        /*if($request->article5 != "--")
        {
            dd('o');
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article5,
                        'quantite' => $request->qte5,
                        'pu' => $request->pu5,
            ]);
        }*/
        if($request->article6 != "--")
        {
            //dd('id');
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article6,
                        'quantite' => $request->qte6,
                        'pu' => $request->pu6,
            ]);
        }
        if($request->article7 != "--")
        {
            //dd('b');
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article7,
                        'quantite' => $request->qte7,
                        'pu' => $request->pu7,
            ]);
        }
        if($request->article8 != "--")
        {
            //dd('c');
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article8,
                        'quantite' => $request->qte8,
                        'pu' => $request->pu8,
            ]);
        }
        if($request->article9 != "--")
        {
            //dd('a');
            $add = DB::table('cotation_article')
            ->insert(['cotation_id' => $request->id_cotation,
                        'article_id' => $request->article9,
                        'quantite' => $request->qte9,
                        'pu' => $request->pu9,
            ]);
        }

        return view('livewire/cotations/edit_vente',[
            'id' => $request->id_cotation,
            'success' => 'Modification effectuée'
        ]);

        /*return back()->with(
            'success', 'Modification effectuée avec succès'
        );*/
     
    }

    public function UpdateCondition(Request $request)
    {
        //dd($request->all());
        $edit = DB::table('cotations')
        ->where('id', $request->id_cotation)
        ->update(
            [ 
                
                'id_condition' => $request->condition,
                'id_user' => auth()->user()->id,
            ]
        );

        return view('livewire/cotations/edit',[
            'id' => $request->id_cotation,
            'success' => 'Modification effectuée'
        ]);
        
    }
    
    public function UpdateConditionv(Request $request)
    {
        //dd($request->all());
        $edit = DB::table('cotations')
        ->where('id', $request->id_cotation)
        ->update(
            [ 
                
                'id_condition' => $request->condition,
                'id_user' => auth()->user()->id,
            ]
        );

        return view('livewire/cotations/edit_vente',[
            'id' => $request->id_cotation,
            'success' => 'Modification effectuée'
        ]);
        
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
        $get_devis = Cotation::where('id', $request->id_cotation)->get();
        foreach($get_devis as $get_devis)
        {
            if($get_devis->id_service == 8)
            {
                return view('livewire/cotations/edit_vente',[
                    'id' => $request->id_cotation,
                ]);
            }
            else
            {
                 return view('livewire/cotations/edit',[
                    'id' => $request->id_cotation,
                ]);
            }
        }
        
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
       // ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        //->join('conditions_paiements', 'cotations.id_condition', '=', 'conditions_paiements.id')
        ->where('cotations.id', $id)
        ->limit(1)
        ->get(['cotations.*', 'clients.nom',]);
        //dd($get);
        return $get;
    }

    public function GetDevisArticle($id)
    {
        $get = DB::table('cotations')
        //->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->join('services', 'cotations.id_service', '=', 'services.id')
        ->where('cotations.id', $id)
        ->limit(1)
        ->get(['cotations.*', 'clients.nom', 'services.libele_service']);
        //dd($get);
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
        if(isset($request->idd6))
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
            //dd('ici');
            //SUPPRIMER TOUS SES FILS
            $l = DB::table('details_cotations')->where('cotation_id', $request->id)->get();
            foreach($l as $l)
            {
                $delete = DB::table('cotation_service')->where('id', $l->id)->delete();
            }
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
            //ON PEUT SUPPRIMER TRANQUIELLEMENT
            Cotation::destroy($request->id);

            return view('admins.devis')->with('success', 'Elément supprimé');
        }
        else
        {
            return view('admins.devis')->with('error', 'Ce devis ne peut être supprimé car il y a des factures associées');
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
        //dd($request->all());;
        $data = [
            'id_cotation' => $request->id_cotation,
        ];
        $a = Cotation::where('id', $request->id_cotation)->get();
        foreach($a as $a)
        {
            $file = strval($a->numero_devis).".pdf";
        }
        //dd($file) ;
        $pdf = Pdf::loadView('livewire/cotations/devis-print', $data);
        
        //return response()->file($pdf);
        return $pdf->stream($file);
    }

    public function GetLinesinfoCustomer($id)
    {
        $get = DB::table('cotations')->where('cotations.id', $id)
        ->join('users', 'cotations.id_user', '=', 'users.id')
        //->join('services', 'cotations.id_service', '=', 'services.id')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->limit(1)
        ->get(['cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'clients.nom', 'clients.adresse', 'clients.telephone', 'clients.activite',
                'clients.adresse_email', 'adresse_facturation', 'clients.numero_contribuable',
                /*'services.libele_service', 'services.code', */'users.nom_prenoms'
            ]);

        //dd($get);
        
        return $get;
    }

    public function GetLines($id)
    {
        $get = DB::table('details_cotations')->where('cotation_id', $id)
        ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->join('services', 'details_cotations.id_service', '=', 'services.id')
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
        $get = DB::table('cotation_article')
        ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
        ->join('articles', 'cotation_article.article_id', '=', 'articles.id')
        ->join('typearticles', 'articles.id_typearticle', '=', 'typearticles.id')
        ->join('disponibilites', 'cotation_article.id_disponibilite', '=', 'disponibilites.id')
        ->where('cotation_article.cotation_id', $id)
        //->where('services.code', "MAT")
        ->get(['cotation_article.*', 'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'articles.designation', 'articles.code', 'articles.description_article',
                'disponibilites.libele',
            ]);
        //dd(var_dump($get));
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
    
        $date = Date('Y-m-d');
        $somme = 0;
        $count_services = DB::table('details_cotations')->where('cotation_id', $request->id)
        ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->join('services', 'details_cotations.id_service', '=', 'services.id')
        ->count();
       
        //dd($request->id);
        if($count_services == 0)//C'est un devis article
        {
            $a = DB::table('cotation_article')
                ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                ->join('articles', 'cotation_article.article_id', '=', 'articles.id')
                ->where('cotation_article.cotation_id', $request->id)
                ->get(['cotation_article.*',
                        'articles.designation', 'articles.code',
                ]);
            //dd($a);
            foreach($a as $a)
            {
                $total = $a->quantite * $a->pu;
                $somme = $somme + $total;
            }

            //CALCUL AVEC LA TVA SI Y EN A
              
            $tva = DB::table('taxes')->get();
                        
            foreach($tva as $tva)
            {
                if($tva->active == 0 )   
                {
                    $pour_facture = $somme;
                }   
                else
                {    
                    
                    $v = DB::table('cotations')->where('id', $request->id)->get(['date_creation']);
                    foreach($v as $verif)
                    {
                        if($verif->date_creation >= $tva->date_activation)
                        {
                            
                            $m = $somme * (18/100);
                            
                        }
                        else
                        {
                            $m = 0;
                            //echo number_format($somme, 2, ".", " ")."F CFA"; 
                            $pour_facture = $somme;
                        }
                    } 
            

                
                    $l = $somme + $m;
                    $pour_facture = $l;
                }
            }

        }
        else
        {
            $s = DB::table('details_cotations')->where('cotation_id', $request->id)
            ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
            ->join('services', 'details_cotations.id_service', '=', 'services.id')
            ->get(['details_cotations.prix_ht', 'details_cotations.cotation_id', 
                'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'services.libele_service', 'services.code'
                ]);
            foreach($s as $s)
            {
                $somme = $somme + $s->prix_ht;
            }

            //CALCUL AVEC LA TVA SI Y EN A
              
            $tva = DB::table('taxes')->get();
                        
            foreach($tva as $tva)
            {
                if($tva->active == 0 )   
                {
                    $pour_facture = $somme;
                }   
                else
                {    
                    
                    $v = DB::table('cotations')->where('id', $request->id)->get(['date_creation']);
                    foreach($v as $verif)
                    {
                        if($verif->date_creation >= $tva->date_activation)
                        {
                            
                            $m = $somme * (18/100);
                            
                        }
                        else
                        {
                            $m = 0;
                            //echo number_format($somme, 2, ".", " ")."F CFA"; 
                            $pour_facture = $somme;
                        }
                    } 
            

                
                    $l = $somme + $m;
                    $pour_facture = $l;
                }
            }

        }
        
        //CREER LE NUMERO DE FACTURE
        //POUR LE NUMERO DEVIS RECUPER L'ID DU SERVICE DANS LE DEVIs
        $id_service = Cotation::where('id', $request->id)->get();
        foreach($id_service as $id_service)
        {
            $numero_devis = (new Calculator())-> GenerateNumDevis($date, $id_service->id_service);
        }

        $today = date('Y-m-d');
        $timestamp = strtotime($today);
        $departtime1 = strtotime('+15 days', $timestamp);
        $result_date = date("Y-m-d", $departtime1 );
        $num = "FACTURE-".$numero_devis;

        $insert = Facture::create([
            'numero_facture' => $num, 
            'date_reglement' => $result_date, 'date_emission' => $today, 
            'montant_facture' => $pour_facture , 'id_cotation' => $request->id, 
            'reglee' => 0, 'annulee' => 0, 'id_user' => auth()->user()->id,
        ]);
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
