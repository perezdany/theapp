<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid -->
</div>
<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Liste des utilisateurs</h3><br>
                <button class="btn btn-primary"  data-toggle="modal" data-target="#addModal"><b><i class="fa fa-user-plus"></i></b></button> <br>
                <a href="users" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                <div class="row">
                
                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="departements_id">
                            <option value="">Département</option>
                            @php
                                $departement = ($departementcontroller)->GetAll();
                            @endphp
                            
                            @foreach($departement as $departement)
                                <option value={{$departement->id}}>{{$departement->libele_departement}}</option>
                                
                            @endforeach
                            
                        </select>   
                    </div>    

                    <div class="col-md-2 input-group input-group-sm">
                
                        <select class="form-control" id="active" wire:model.live.debounce.250ms="active">
                        
                            <option value="">Statut</option>
                            <option value="0">Inactif</option>
                            <option value="1">Actif</option>
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
                        <th>Nom & Prénoms</th>
                        <th>Email</th>
                        <th>Département</th>
                        <th>Poste</th>
                        <th>Activer/Désactiver</th>
                        <th>Rôles</th>
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                        <tr class="align-middle">
                        <td>{{$user->nom_prenoms}}</td>
                        <td>{{$user->login}}</td>
                        <td>{{$user->libele_departement}}</td>
                        <td>{{$user->poste}}</td>
                        
                        <td>
                        @if($user->active == true)
                        
                            <form action="disable_user" method="post">
                            @csrf
                            <input type="text" value={{$user->id}} style="display:none;" name="id_user">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                        @else
                    
                            <form action="enable_user" method="post">
                            @csrf
                            <input type="text" value={{$user->id}} style="display:none;" name="id_user">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
                            </form>
                        @endif
                        </td>

                        <td>
                            
                           <button class="btn btn-primary"  data-toggle="modal" data-target="#roles{{$user->id}}"><b><i class="fa fa-cogs"></i></b></button>
                            <div class="modal fade" id="roles{{$user->id}}" wire:ignore.self  role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Rôles de {{$user->nom_prenoms}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-info card-outline mb-4">
                                    
                                        <!--begin::Form-->
                                        <form action="update_roles" method="post">
                                            <!--begin::Body-->
                                            @csrf
                                           
                                            <div class="card-body">
                                            <div class="row mb-3">
                                                <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        @php
                                                            $roles = DB::table('roles')->get();
                                                        @endphp
                                                        @foreach($roles as $roles)
                                                            @php
                                                            $roles_u = DB::table('role_user')->where('user_id', $user->id)
                                                            ->where('role_id', $roles->id)->count();
                                                            @endphp
                                                            @if($roles_u != 0)
                                                                <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                 value="{{$roles->id}}" name="{{$roles->intitule}}" checked>
                                                                <label class="form-check-label">{{$roles->intitule}}</label>
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                 value="{{$roles->id}}" name="{{$roles->intitule}}">
                                                                <label class="form-check-label">{{$roles->intitule}}</label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                       
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            </div>
                                            <!--end::Body-->
                                            <!--begin::Footer-->
                                            <div class="modal-footer">
                                            <button type="button" wire:click="close" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
                                            
                                            <button type="submit" class="btn btn-success pull-right">Valider</button>
                                                            
                                                
                                            </div>
                                            <!--end::Footer-->
                                        </form>
                                        <!--end::Form-->
                                        </div>

                                        
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
                                <form action="edit_user_form" method="post">
                                    @csrf
                                    <input type="text" value={{$user->id}} style="display:none;" name="id_user">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i></button>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-danger" 
                               data-toggle="modal" data-target="#delete{{$user->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$user->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        
                                        </div>
                                        <div class="modal-body">
                                          
                                        
                                            <!--begin::Form-->
                                            <form method="post" action="deleteuser">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer "{{$user->nom_prenoms}}"?</label>
                                                <input type="text" class="form-control" value="{{$user->id}}" wire-model="id" 
                                                name="id" id="{{$user->id}}" style="display:none;">

                                                <!--end::Body-->
                                                 <!--begin::Footer delete($user->id)  wire:click="confirmDelete(' $user->nom_prenoms ', '$user->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
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
                    <tr colspan="7">
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
                    {{$users->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->