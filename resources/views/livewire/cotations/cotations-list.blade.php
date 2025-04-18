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
            
                <a href="add_devis"><button class="btn btn-primary">
                <b><i class="fa fa-plus"></i></b></button><br></a>
              
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
                        <th>Ajouté par:</th>
                        <th>Ajouter un service</th>
                        <th>Ajouter un article</th>
                        <th>Détails</th>
                        <th>Modifier les lignes</th>
                        <th>Mod/Supp</th>
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
                            @else
                               <span class="bg-danger">Pas validé</span>
                            @endif
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
                                            <label>Durée en mois:</label>
                                            <input type="number" name="mois" min="0" value="0"
                                            class="form-control" placeholder="Entrez ..." >
                                            </div>

                                            <div class="form-group">
                                            <label>Durée en jours:</label>
                                            <input type="number" name="jours" min="0" value="0" 
                                            class="form-control" placeholder="Entrez ..." >
                                            </div>
                                            <div class="form-group">
                                            <label>Durée en semaines:</label>
                                            <input type="number" name="semaines" min="0" value="0"
                                            class="form-control" placeholder="Entrez ..." >
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
                                                    $get_service = DB::table('cotation_service')
                                                    ->join('services', 'cotation_service.service_id', '=', 'services.id')
                                                    ->where('cotation_id', $cotation->id)
                                                    ->get(['cotation_service.*', 'services.libele_service', 'services.code']);
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
                                                        @if($service->service_id == 8)
                                                       
                                                            <h3 class="card-title bg-warning"><b><u><i>{{$service->libele_service}}</i></u></b></h3><br>
                                                            <!-- text input -->
                                                            <input type="text" value={{$service->service_id}} name="service{{$service->service_id}}" style="display:none;">
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
                                                                        echo 'ssuper';
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
                                                            <h3 class="card-title bg-warning"><b><u><i>{{$service->libele_service}}</i></u></b></h3><br>
                                                            <!-- text input -->
                                                             @php
                                                                $infos = DB::table('cotation_service')
                                                                ->join('services', 'cotation_service.service_id', '=', 'services.id')
                                                                ->where('cotation_id', $cotation->id)->where('service_id', $service->service_id)
                                                                ->get(['cotation_service.*']);
                                                                //dd($infos);
                                                            @endphp
                                                            @foreach($infos as $info)
                                                            <input type="text" value={{$service->service_id}} name="service{{$service->service_id}}" style="display:none;">
                                                            <div class="form-group">
                                                            <label>Prix Hors taxe:</label>
                                                            <input type="number" class="form-control"  name="prix_ht{{$service->service_id}}" value={{$info->prix_ht}} required>
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Durée en mois:</label>
                                                            <input type="number" name="mois{{$service->service_id}}" value={{$info->duree_mois}} 
                                                            min="0" class="form-control"  >
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Durée en jours:</label>
                                                            <input type="number" name="jours{{$service->service_id}}" value={{$info->duree_jours}} min="0"
                                                            class="form-control" >
                                                            </div>
                                                            <div class="form-group">
                                                            <label>Durée en semaines:</label>
                                                            <input type="number" name="semaines{{$service->service_id}}" value={{$info->duree_semaines}} min="0" 
                                                            class="form-control"  >
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
                            <div class="col-sm-6">
                
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
                                                        @php
                                                            $services = DB::table('services')->get();
                                                        @endphp
                                                        @foreach($services as $services)
                                                            @php
                                                                $verif = DB::table('cotation_service')->where('cotation_id', $cotation->id)
                                                            ->where('service_id', $services->id)->count();
                                                            @endphp
                                                            @if($verif == 0)
                                                                <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="{{$services->id}}" name="{{$services->code}}">
                                                                <label class="form-check-label"><b>{{$services->libele_service}}</b></label>
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="{{$services->id}}" name="{{$services->code}}" checked>
                                                                <label class="form-check-label"><b>{{$services->libele_service}}</b></label>
                                                                </div>
                                                            @endif
                                                            
                                                        @endforeach
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
                            <div class="col-sm-6">
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