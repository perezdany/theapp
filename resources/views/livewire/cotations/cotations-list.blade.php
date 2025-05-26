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
                            <b><i class="fa fa-plus"></i>DEVIS</b></button>
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
                                
                                        <button type="submit" target="blank" class="btn btn-success col-md-3">Aller au devis</button>
                                                
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
                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="service" wire:model.live.debounce.250ms="service">
                            <option value="">Par service</option>
                            @php
                                $s = DB::table('services')->get();
                            @endphp
                            @foreach($s as $s)
                                <option value={{$s->id}}>{{$s->libele_service}}</option>
                            @endforeach
                            
                        </select>   
                    </div>

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="rejete" wire:model.live.debounce.250ms="rejete">
                            <option value="">Rejeté?</option>
                            <option value="1">OUI</option>
                            <option value="0">NON</option>
                        
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
                        <th wire:click="setOrderField('date_creation')"><i class="fa fa-sort" aria-hidden="true"></i>Date de création</th>
                        <th wire:click="setOrderField('numero_devis')"><i class="fa fa-sort" aria-hidden="true"></i>Numéro</th>
                        <th wire:click="setOrderField('date_validite')"><i class="fa fa-sort" aria-hidden="true"></i>Date de validité</th>
                        <th wire:click="setOrderField('id_client')"><i class="fa fa-sort" aria-hidden="true"></i>Client</th>
                        <th>Etat</th>
                        <th>Marq. comme rejeté</th>
                        <th>Par:</th>
                        <!--<th>Ajouter une ligne</th>-->
                        <!--<th>Détails</th>
                        <th>Modifier les lignes</th>-->
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
                        <div class="row">
                            @can("edit")
                          
                            <div class="col-sm-4">
                                <form action="editcotation" method="post" target="blank">
                                    @csrf
                                    <input type="text" value="{{$cotation->id}}" name="id_cotation" style="display:none">
                                    <button class="btn btn-info"><i class="fa fa-edit"></i></button>
                                </form>
                            
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