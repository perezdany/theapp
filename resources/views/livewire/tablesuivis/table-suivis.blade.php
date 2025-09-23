<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
    
    <div class="col-12">
        <a href="suivi"><button class="btn btn-info" >
            <b><i class="fa fa-calendar"></i> ALLER AU CALENDRIER</b></button>
        </a><br>
        <div class="card">
         
            <div class="card-header"><h3 class="card-title">Liste des suivis</h3><br>
                <a href="suivi_table" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                <div class="row">
                    Date de création:
                    <div class="col-xs-2">
                        <input type="date" class="form-controller" wire:model.live.debounce.250ms="compare">
                    </div>
                    <div class="col-xs-2">
                        <input type="date" class="form-controller" wire:model.live.debounce.250ms="annee">
                            
                    </div>
                </div><br>
                <div class="row">
                
                    <div class="col-md-2 input-group input-group-sm">
                        @can("super_admin")
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="user">
                            <option value="">Utilisateurs</option>
                            @php
                                $t = DB::table('users')->get();
                            @endphp
                            @foreach($t as $t)
                                <option value={{$t->id}}>{{$t->nom_prenoms}}</option>
                            @endforeach
                            
                        </select>   
                        @endcan
                    </div>    

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" wire:model.live.debounce.250ms="entreprise">
                            <option value="">Entreprises</option>
                            @php
                                $e = DB::table('clients')->where('particulier', 0) ->get();
                            @endphp
                         
                            @foreach($e as $e)
                                <option value="{{$e->id}}">{{$e->nom}}</option>
                            @endforeach
                        
                        </select>   
                    </div>

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control"  wire:model.live.debounce.250ms="p">
                            <option value="">Projet</option>
                            @php
                                $fon = DB::table('projets')->get();
                            @endphp
                     
                            @foreach($fon as $fon)
                                <option value="{{$fon->id}}">{{$fon->nom_projet}}</option>
                            @endforeach
                        
                        </select>   
                    </div>    

                     <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control"  wire:model.live.debounce.250ms="f">
                            <option value="">Fournisseurs</option>
                            @php
                                $fon = DB::table('fournisseurs')->get();
                            @endphp
                            
                            @foreach($fon as $fon)
                                <option value="{{$fon->id}}">{{$fon->nom}}</option>
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
                @php
                    //dd($suivis);
                @endphp
                <thead>
                    <tr>
                        <th>Titre de l'évènement</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Projet</th>
                        <th>Fournisseur</th>
                        <th>Client</th>
                        <th>Details</th>
                        <!--<th>Date de relance</th>-->
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($suivis as $suivi)
                    <tr class="align-middle">
                        <td>{{$suivi->title}}</td>
                        <td>@php echo date('d/m/Y',strtotime($suivi->start)) ;
                        echo "à".date('H:i:s',strtotime($suivi->start));@endphp</td>
                         <td>@php echo date('d/m/Y',strtotime($suivi->start)) ;
                        echo "à".date('H:i:s',strtotime($suivi->start));@endphp</td>
                        <td>
                            @if($suivi->id_projet == NULL)
                                N/A
                            @else
                         
                                @php
                                    $p = DB::table('projets')->where('id', $suivi->id_projet)->get();
                                @endphp
                                @foreach($p as $p)
                                    {{$p->nom_projet}}
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($suivi->id_fournisseur == NULL)
                                N/A
                            @else
                                @php
                                    $f = DB::table('fournisseurs')->where('id', $suivi->id_fournisseur)->get();
                                    
                                @endphp
                                @foreach($f as $f)
                                    {{$f->nom}}
                                @endforeach
                            @endif
                        </td>
                        <td>
                             @if($suivi->id_client == NULL)
                                N/A
                            @else
                                @php
                                    $f = DB::table('clients')->where('id', $suivi->id_client)->get();
                                    
                                @endphp
                                @foreach($f as $f)
                                    {{$f->nom}}
                                @endforeach
                            @endif
                        </td>
                        <td>
                            {{$suivi->more}}
                        </td>
                        <!--<td>
                            @php 
                                //echo date('d/m/Y',strtotime($suivi->date_relance));
                            @endphp
                        </td>-->
                        <td>
                            <div class="row">
                                @can("edit")
                                <div class="col-sm-6">
                                    <button wire:click="editmodal('{{$suivi->id}}')"
                                class="btn btn-info"><i class="fa fa-edit"></i></button>
                                
                                </div>
                                @endcan
                                @can("delete")
                                <div class="col-sm-6">
                                    <button class="btn btn-danger" 
                                    data-toggle="modal" data-target="#delete{{$suivi->id}}" >
                                    <b><i class="fa fa-trash"></i></b></button>
                                    <div class="modal fade" id="delete{{$suivi->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <!--begin::Form-->
                                                <form method="post" action="deletesuivi">
                                                    <!--begin::Body-->
                                                    @csrf
                                                    <label style="text-align:center; color:red">Voulez vous vraiment supprimer ?</label>
                                                    <input type="text" class="form-control" value="{{$suivi->id}}" wire-model="id" 
                                                    name="id" id="{{$suivi->id}}" style="display:none;">

                                                    <!--end::Body-->
                                                    <!--begin::Footer delete($type->id)  wire:click="confirmDelete(' $type->nom_prenoms ', 
                                                    '$type->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
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
                    {{$suivis->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->