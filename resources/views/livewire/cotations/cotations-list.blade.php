<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
    
    <div class="col-12">
        <div>
            @php
                $tva = DB::table('taxes')->get();
            @endphp
            @foreach($tva as $tva)
                @if($tva->active == 0)
                    <form action="manage_taxes" method="post">
                    @csrf
                    <button class="btn btn-danger" type="submit">Activer la TVA</button>
                    </form>
                @else
                    <form action="manage_taxes" method="post">
                    @csrf
                    <button class="btn btn-warning" type="submit">Désactiver la TVA</button>
                    </form>
                @endif
            @endforeach
          
           
        </div>
        <div class="card">
         
            <div class="card-header"><h3 class="card-title">Liste des devis</h3><br>
                <div class="row">
                    <div  class="col-xs-3">
                        <!--<a href=""><button class="btn btn-primary">
                         <b><i class="fa fa-plus"></i></b></button><br></a>-->

                        <button class="btn btn-primary" 
                        data-toggle="modal" data-target="#createds" >
                            <b><i class="fa fa-plus"></i>DEVIS PRESTATIONS DE SERVICES</b></button>
                        <div class="modal fade" id="createds"  
                            wire:ignore.self  role="dialog" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Quel service concerne ce devis ?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <!--begin::Form-->
                                    <form method="get" action="create_devis">
                                        <!--begin::Body-->
                                        @csrf
                                        <div class="form-group">
                                        <label>Service:</label>
                                            <select class="form-control" name="service" required>
                                                
                                                @php
                                                    $s = DB::table('services')->get();
                                                @endphp
                                                @foreach($s as $s)
                                                    <option value={{$s->id}}>{{$s->libele_service}}</option>
                                                @endforeach
                                                
                                            </select>   
                                        </div>

                                        <div class="form-group">
                                        <label>Service:</label>
                                            <select class="form-control" name="client" required>
                                                
                                                @php
                                                    $clients = DB::table('clients')->get();
                                                @endphp
                                                @foreach($clients as $client)
                                                    <option value={{$client->id}}>{{$client->nom}}</option>
                                                @endforeach
                                                
                                            </select>   
                                        </div>

                                       
                                        <div class=" row modal-footer justify-content-between" style="aling:center">
                                        
                                        <button type="button" wire:click="close" class="btn btn-danger col-md-3" data-dismiss="modal">Fermer</button>
                                
                                        <button type="submit"  class="btn btn-success col-md-3">Aller au devis</button>
                                                
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
                        <!-- /.modal -->
          
                    </div>

                   
                    <div class="col-xs-3">
                         <button class="btn btn-success" 
                        data-toggle="modal" data-target="#createdv" >
                            <b><i class="fa fa-plus"></i>DEVIS VENTE DE MATERIEL</b></button>
                        <div class="modal fade" id="createdv"  
                            wire:ignore.self  role="dialog" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Choisissez le client</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <!--begin::Form-->
                                    <form method="get" action="add_devis_vente">
                                        <!--begin::Body-->
                                        @csrf
                                       
                                        <div class="form-group">
                                        <label>Service:</label>
                                            <select class="form-control" name="client" required>
                                                
                                                @php
                                                    $clients = DB::table('clients')->get();
                                                @endphp
                                                @foreach($clients as $client)
                                                    <option value={{$client->id}}>{{$client->nom}}</option>
                                                @endforeach
                                                
                                            </select>   
                                        </div>

                                       
                                        <div class=" row modal-footer justify-content-between" style="aling:center">
                                        
                                        <button type="button" wire:click="close" class="btn btn-danger col-md-3" data-dismiss="modal">Fermer</button>
                                
                                        <button type="submit"  class="btn btn-success col-md-3">Aller au devis</button>
                                                
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
                        <!-- /.modal -->
                        <!--<a href="add_devis_vente" class="col-sm-3"><button class="btn btn-success">
                        <b><i class="fa fa-plus"></i></b></button><br></a>-->
                    </div>
             
                </div>
          
                 
              
                <a href="devis" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                <div class="row">
                    Date de création:
                    <div class="col-xs-2">
                        <select class="" id="compare" wire:model.live.debounce.250ms="compare">
                            <option value="">Choisir</option>
                            <option value="<"><</option> 
                            <option value=">">></option>
                            <option value="=">=</option>                              
                        </select>   
                    </div>
                    <div class="col-xs-2">
                        <select class="" id="anne_depuis" wire:model.live.debounce.250ms="annee">
                            <option value="">Choisir</option>
                            @php
                                $annee_fin = "2050";
                                for($annee="2014"; $annee<=$annee_fin; $annee++)
                                {
                                    echo'<option value='.$annee.'>'.$annee.'</option>';
                                }
                            @endphp
                            
                        </select>   
                    </div>
                </div><br>
                <div class="row">
                
                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="statut">
                            <option value="">Statut</option>
                            <option value="1">VALIDE</option>
                            <option value="0">PAS VALIDE</option>

                        </select>   
                    </div>    

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="user">
                            <option value="">Utilisateurs</option>
                            @php
                                $t = DB::table('users')->get();
                            @endphp
                            @foreach($t as $t)
                                <option value={{$t->id}}>{{$t->nom_prenoms}}</option>
                            @endforeach
                            
                        </select>   
                    </div>    
                   
                </div>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" wire:model.live.debounce.250ms="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
  
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Date de création</th>
                        <th>Numéro</th>
                        <th>Date de validité</th>
                        <th>Client</th>
                        <th>Etat</th>
                        <th>Marq. comme rejeté</th>
                        <th>Par:</th>
                        <th>Ajouter un service</th>
                        <th>Ajouter un article</th>
                        <th>Détails</th>
                        <th>Modifier les lignes</th>
                        <th>Mod/Supp/Valider</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($cotations as $cotation)
                        <tr class="align-middle">
                        <td>@php echo date('d/m/Y',strtotime($cotation->created_at));@endphp</td>
                        <td>{{$cotation->numero_devis}}</td>
                        <td>{{$cotation->date_validite}}</td>
                        <td>{{$cotation->nom}}</td>
                        <td>
                            @if($cotation->valide == 1)
                               <span class="bg-success">Validé</span>
                            @elseif($cotation->rejete == 1)
                                <span class="bg-danger">Rejeté</span>
                            @else
                                <span class="bg-danger">Pas validé</span>
                                
                            @endif
                        </td>
                        <td>
                           <button class="btn btn-info" 
                            data-toggle="modal" data-target="#r{{$cotation->id}}" >
                                <b><i class="fa fa-cogs"></i></b></button>
                            <div class="modal fade" id="r{{$cotation->id}}"  
                                wire:ignore.self  role="dialog" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Marquer comme rejeté</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--begin::Form-->
                                        <form method="post" action="updaterejeter">
                                            <!--begin::Body-->
                                            @csrf
                                           
                                            <input type="text" class="form-control" value="{{$cotation->id}}" wire-model="id" 
                                            name="id" id="{{$cotation->id}}" style="display:none;">
                                            
                                            <div class="form-group">
                                            <label>Rejeté:</label>
                                                <select class="form-control" name="rejeter" required>
                                                   
                                                    @if($cotation->rejete == 0)
                                                        <option value="0">NON</option>
                                                        <option value="1">OUI</option> 
                                                    @else
                                                        <option value="1">OUI</option> 
                                                        <option value="0">NON</option>
                                                    @endif
                                                        
                                                </select>   
                                            </div>

                                            <div class="form-group">
                                            <label>Motif:</label>
                                                <textarea class="form-control" name="motif">
                                                    {{$cotation->motif}}
                                                </textarea>
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
                            <!-- /.modal -->
                        </td>
                        <td>{{$cotation->nom_prenoms}}</td>
                        <td>
                            <button class="btn btn-success" 
                            data-toggle="modal" data-target="#serv{{$cotation->id}}" >
                                <b><i class="fa fa-plus"></i></b></button>
                            <div class="modal fade" id="serv{{$cotation->id}}"  
                                wire:ignore.self  role="dialog" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Service</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--begin::Form-->
                                        <form method="post" action="addaservice">
                                            <!--begin::Body-->
                                            @csrf
                                           
                                            <input type="text" class="form-control" value="{{$cotation->id}}" wire-model="id" 
                                            name="id" id="{{$cotation->id}}" style="display:none;">
                                            
                                            <div class="form-group">
                                            <label>Service:</label>
                                                <select class="form-control" name="service" required>
                                                   
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    @foreach($s as $s)
                                                        <option value={{$s->id}}>{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>

                                            <div class="form-group">
                                            <label>Prix Hors taxe:</label>
                                            <input type="number" name="prix" class="form-control" placeholder="un nombre..." required>
                                            </div>

                                            <div class="form-group">
                                            <label>Durée:</label>
                                            <input type="number" name="duree" min="0" value="0"
                                            class="form-control" placeholder="Entrez ..." >
                                            </div>

                                            <div class="form-group">
                                            <label>Choisir:</label>
                                            <select  class="form-control" name="duree_type" id="duree_type">
                                                <option value="jours">Jours</option>
                                                <option value="mois">Mois</option>
                                                <option value="annees">Années</option>
                                            </select>
                                            
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
                            <!-- /.modal -->
                               
                        </td>
                        <td>
                            <button class="btn btn-success" 
                            data-toggle="modal" data-target="#article{{$cotation->id}}" >
                                <b><i class="fa fa-plus"></i></b></button>
                            <div class="modal fade" id="article{{$cotation->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Article</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--begin::Form-->
                                        <form method="post" action="addanarticle">
                                            <!--begin::Body-->
                                            @csrf
                                           
                                            <input type="text" class="form-control" value="{{$cotation->id}}" 
                                            name="id_cotation" id="{{$cotation->id}}" style="display:none;">

                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article">
                                                @php
                                                    $t = DB::table('articles')->get();
                                                @endphp
                                                @foreach($t as $t)
                                                    <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                @endforeach
                                                
                                            </select>   
                                            </div>

                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte" min="1" value="1"
                                            class="form-control">
                                            </div>
                                            <div class="row modal-footer justify-content-between" style="aling:center">
                                            
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
                            <!-- /.modal -->    
                        </td>
                        <td>
                            <form action="see_devis" method="post">
                                @csrf
                                <input type="text" value="{{$cotation->id}}" name="id_cotation" style="display:none">
                                <button class="btn btn-warning"><i class="fa fa-eye"></i></button>
                            </form>
                        </td>
                        <td>
                            <!--<form action="edit_lines" method="post">
                              
                                <input type="text" value="" name="id_cotation" style="display:none">
                                <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
                            </form>-->
                            <button class="btn btn-primary" 
                                data-toggle="modal" data-target="#editlines{{$cotation->id}}" >
                                    <b><i class="fa fa-edit"></i></b></button>
                            <div class="modal fade" id="editlines{{$cotation->id}}" role="dialog" aria-hidden="true" >
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edition des lignes du devis {{$cotation->numero_devis}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--begin::Form-->
                                        <form method="post" action="edit_lines">
                                            @php
                                                //CODE POUR AFFICHER LES FORMULAIRES EN FONCTION DES SERVICES
                                                if(isset($cotation->id))
                                                {
                                                    $get_service = DB::table('details_cotations')
                                                    ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                                                    ->join('services', 'cotations.id_service', '=', 'services.id')
                                                    ->where('cotation_id', $cotation->id)
                                                    ->get(['details_cotations.*', 'services.libele_service', 'services.code']);
                                                }
                                                //dd($get_service);
                                            @endphp
                                            @csrf
                                            <div class="row">
                                                <input type="text" value="{{$cotation->id}}" name="id_cotation" 
                                                style="display:none;">
                                          
                                                @if(isset($get_service))
                                                    @foreach($get_service as $service)
                                                    <div class="col-sm-3">
                                                        @if($service->code == "MAT")
                                                    
                                                            <!-- text input -->
                                                            <input type="text" value={{$service->service_id}} name="{{$service->code}}" style="display:none;">
                                                            <div class="form-group">
                                                                @php
                                                                    $infos = DB::table('cotation_article')
                                                                    ->join('articles', 'cotation_article.article_id', '=', 'articles.id')
                                                                    ->where('cotation_id', $cotation->id)
                                                                    ->count()
                                                                    //->get(['cotation_article.*', 'articles.designation', 'articles.prix_unitaire']);
                                                                @endphp
                                                                @if($infos != 0)
                                                                    @php
                                                                        
                                                                        $infos = DB::table('cotation_article')
                                                                        ->join('articles', 'cotation_article.article_id', '=', 'articles.id')
                                                                        ->where('cotation_id', $cotation->id)
                                                                        //->count()
                                                                        ->get(['cotation_article.*', 'articles.designation', 'articles.prix_unitaire']);
                                                                    @endphp
                                                                    @foreach($infos as $info)
                                                                    <label>Articles:</label>
                                                                    <select class="form-control" name="article">
                                                                        <option value={{$info->id}}>{{$info->designation}}/Prix:{{$info->prix_unitaire}}XOF</option>
                                                                        @php
                                                                            $t = DB::table('articles')->get();
                                                                        @endphp
                                                                        @foreach($t as $t)
                                                                            <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                                        @endforeach
                                                                        
                                                                    </select>   
                                                                    <label>Quantité:</label>
                                                                    <input type="number" class="form-control"  name="qte"
                                                                     value={{$info->quantite}} required>
                                                                    @endforeach
                                                                @else
                                                                    <label>Articles:</label>
                                                                    <select class="form-control" name="article">
                                                                        @php
                                                                            $t = DB::table('articles')->get();
                                                                        @endphp
                                                                        @foreach($t as $t)
                                                                            <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                                        @endforeach
                                                                    </select>   
                                                                    <label>Quantité:</label>
                                                                    <input type="number" class="form-control"  name="qte" required>
                                                                @endif
                                                               
                                                            </div>
                                                           
                                                        @else
                                                           
                                                            <!-- text input -->
                                                             @php
                                                                $infos =  DB::table('details_cotations')
                                                            ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                                                            ->join('services', 'cotations.id_service', '=', 'services.id')
                                                                ->where('cotation_id', $cotation->id)
                                                                ->get(['details_cotations.*', 'services.code']);
                                                                //dd($infos);
                                                            @endphp
                                                            @foreach($infos as $info)
                                                            <input type="text" value={{$info->id}} name="line"{{$info->id}} style="display:none;">
                                                            <div class="form-group">
                                                            
                                                            <div class="form-group">
                                                                <label>Désignation:</label>
                                                                <textarea name="designation" class="form-control" >
                                                                    {{$service->designation}}
                                                                </textarea>
                                                        
                                                            </div>
                                                            <label>Prix Hors taxe:</label>
                                                            <input type="number" class="form-control"  name="prix_ht{{$service->code}}" value="{{$info->prix_ht}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Durée:</label>
                                                            <input type="number" name="duree{{$service->code}}" value={{$info->duree}} 
                                                            min="0" class="form-control"  >
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Choisir:</label>
                                                            <select  class="form-control" name="duree_type{{$info->id}}">
                                                                <option value="{{$info->duree_type}}">{{$info->duree_type}}</option>
                                                                <option value="jours">Jours</option>
                                                                <option value="mois">Mois</option>
                                                                <option value="annees">Années</option>
                                                            </select>
                                                            
                                                            </div>
                                                      
                                                            @endforeach
                                                      
                                                        @endif
                                                    </div>
                                                
                                                    @endforeach
                                                @endif

                                            </div>
                                             
                                            <div class="row modal-footer justify-content-between">
                                            <button data-dismiss="modal" class="btn btn-danger">Retour</button>
                                            <button type="submit" class="btn btn-info float-right">Valider</button>
                                            </div>
                                        </form>
                                        <!--end::Form-->

                                    </div> 
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>    
                            <!-- /.modal -->
                        </td> 
                        <td>
                        <div class="row">
                            @can("edit")
                            <div class="col-sm-4">
                                <button class="btn btn-info" 
                                data-toggle="modal" data-target="#edit{{$cotation->id}}" >
                                    <b><i class="fa fa-edit"></i></b></button>
                                <div class="modal fade" id="edit{{$cotation->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Edition du devis {{$cotation->numero_devis}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <!--begin::Form-->
                                            <form method="post" action="edit_devis">
                                                @csrf
                                                <input type="text" value="{{$cotation->id}}" name="id" style="display:none;"/>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                        <label>Date de création</label>
                                                        <input type="date" name="date_creation"  value="{{$cotation->date_creation}}" class="form-control" placeholder="Enter ..." required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                        <label>Numero du devis</label>
                                                        <input type="text" name="numero_devis"  value="{{$cotation->numero_devis}}" class="form-control" placeholder="Entrez ..." required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                        <label>Valide jusqu'au:</label>
                                                        <input type="date" name="date_validite" value="{{$cotation->date_validite}}" class="form-control" placeholder="Enter ..." required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                        <label>Choisir le client</label>
                                                            <select class="form-control" required name="id_client">
                                                                @php
                                                                    $clients = DB::table('clients')->get();
                                                                @endphp
                                                                <option value="{{$cotation->id_client}}">{{$cotation->nom}}</option>
                                                                @foreach($clients as $client)
                                                                    <option value="{{$client->id}}">{{$client->nom}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2"></div>
                                                    <div class="form-group">
                                                       <label>Service:</label>
                                                        <select class="form-control" name="service" >
                                                            
                                                            @php
                                                                $services = DB::table('services')->get();
                                                            @endphp
                                                            <option value={{$cotation->id_service}}>{{$cotation->libele_service}}</option>
                                                            @foreach($services as $service)
                                                                <option value={{$service->id}}>{{$service->libele_service}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div>
                                                    <div class="col-sm-2"></div>
                                                </div>
                                                    
                                                <div class="row modal-footer justify-content-between">
                                                <a href="devis"><span class="btn btn-danger">Retour</span></a>
                                                <button type="submit" class="btn btn-info float-right">Valider</button>
                                                </div>
                                            </form>
                                            <!--end::Form-->

                                        </div> 
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>    
                                <!-- /.modal -->
                            </div>
                            @endcan
                            @can("delete")
                            <div class="col-sm-4">
                                <button class="btn btn-danger" 
                                data-toggle="modal" data-target="#delete{{$cotation->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$cotation->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <!--begin::Form-->
                                            <form method="post" action="deletedevis">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer le devis {{$cotation->numero_devis}}?</label>
                                                <input type="text" class="form-control" value="{{$cotation->id}}" wire-model="id" 
                                                name="id" id="{{$cotation->id}}" style="display:none;">

                                                <!--end::Body-->
                                                 <!--begin::Footer delete($type->id)  wire:click="confirmDelete(' $type->nom_prenoms ', '$type->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
                                                <div class=" row modal-footer justify-content-between" style="aling:center">
                                                
                                                <button type="button" wire:click="close" class="btn btn-danger btn-lg col-md-3" data-dismiss="modal">NON</button>
                                        
                                                <button type="submit"  class="btn btn-success btn-lg col-md-3">OUi</button>
                                                        
                                                    
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
                                <!-- /.modal -->
                               
                            </div>
                            @endcan
                            <div class="col-sm-4">
                                @if($cotation->valide == 0)
                                    <form action="validecotation" method="post">  
                                    @csrf
                                    <input type="text" value="{{$cotation->id}}" name="id" style="display:none">
                                    <button class="btn btn-success">
                                        <b><i class="fa fa-check"></i></b></button>
                                    </form>
                                @else
                                    <form action="cvalidecotation" method="post">  
                                    @csrf
                                    <input type="text" value="{{$cotation->id}}" name="id" style="display:none">
                                    <button class="btn btn-danger">
                                        <b><i class="fa fa-times"></i></b></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        </td>
                    </tr>
                @empty
                    <tr colspan="9">
                        <div class="alert alert-info alert-dismissible">
                            
                            <h4><i class="icon fa fa-ban"></i> Oups!</h4>
                            Aucune donnée trouvée
                        </div>
                    </tr>
                @endforelse
                    
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination  m-0 float-end">
                    {{$cotations->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->