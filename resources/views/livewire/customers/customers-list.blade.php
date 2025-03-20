<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Les clients</h3><br>
            
                <button class="btn btn-primary" wire:click="addmodalparticulier" >
                <b><i class="fa fa-plus"></i>Particulier</b></button>
                <button class="btn btn-primary" wire:click="addmodal" >
                <b><i class="fa fa-plus"></i>Entreprise</b></button> <br>
                <a href="customers" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                <div class="row">
                    Date d'évènement:
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
                            <option value="1">PROSPECT</option>
                            <option value="2">DEFINITIF</option>

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
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Activité</th>
                        <th>Ajouté par:</th>
                        <th>Ajouté le:</th>
                        <th>Détails</th>
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                        <tr class="align-middle">
                        <td>{{$customer->nom}}</td>
                        <td>{{$customer->adresse}}</td>
                        <td>{{$customer->adresse_email}}</td>
                        <td>{{$customer->telephone}}</td>
                        <td>{{$customer->activite}}</td>
                         <td>{{$customer->nom_prenoms}}</td>
                        <td>@php echo date('d/m/Y',strtotime($customer->created_at));@endphp</td>
                        <td>
                            @if($customer->particulier == 1)
                                <button wire:click="detailsmodalparticulier('{{$customer->id}}')"
                                    class="btn btn-success"><i class="fa fa-eye"></i></button>
                            @else
                                <button wire:click="detailsmodal('{{$customer->id}}')"
                                    class="btn btn-success"><i class="fa fa-eye"></i></button>
                            @endif

                        </td>
                        <td>
                        <div class="row">
                            <div class="col-sm-6">
                             @if($customer->particulier == 1)
                              <button wire:click="editmodalparticulier('{{$customer->id}}')"
                               class="btn btn-info"><i class="fa fa-edit"></i></button>
                            @else
                                 <button wire:click="editmodal('{{$customer->id}}')"
                               class="btn btn-info"><i class="fa fa-edit"></i></button>
                            @endif
                              
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-danger" 
                               data-toggle="modal" data-target="#delete{{$customer->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$customer->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                          
                                        
                                            <!--begin::Form-->
                                            <form method="post" action="deletecustomer">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer le client"{{$customer->nom}}"?</label>
                                                <input type="text" class="form-control" value="{{$customer->id}}" wire-model="id" 
                                                name="id" id="{{$customer->id}}" style="display:none;">

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
                    {{$customers->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->