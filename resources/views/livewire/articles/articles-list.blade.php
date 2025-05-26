<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Les articles</h3><br>
                <button class="btn btn-primary" wire:click="addmodal" ><b><i class="fa fa-plus"></i></b></button> <br>
                <a href="articles" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                <div class="row">
                
                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="id_type">
                            <option value="">Type</option>
                            @php
                                $t = ($typecontrollercontroller )->GetAll();
                            @endphp
                            
                            @foreach($t as $t)
                                <option value={{$t->id}}>{{$t->libele}}</option>
                                
                            @endforeach
                            
                        </select>   
                    </div>    

                    <div class="col-md-2 input-group input-group-sm">
                
                        <select class="form-control" id="active" wire:model.live.debounce.250ms="id_user">
                            <option value="">Utilisateurs</option>
                            @php
                                $u = ($usercontroller )->GetAll();
                            @endphp
                            
                            @foreach($u as $u)
                                <option value={{$u->id}}>{{$u->nom_prenoms}}</option>
                                
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
                        <th>Désignation</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Type d'article</th>
                        <th>Ajouté le:</th>
                        <th>Ajouté par:</th>
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($articles as $article)
                        <tr class="align-middle">
                        <td>{{$article->designation}}</td>
                        <td>{{$article->code}}</td>
                        <td>{{$article->description_article}}</td>
                        <td>{{$article->libele}}</td>
                        <td>@php echo date('d/m/Y',strtotime($article->created_at));@endphp</td>
                        <td>
                          {{$article->nom_prenoms}}
                        </td>
                        <td>
                        <div class="row">
                            @can("edit")
                                <div class="col-sm-6">
                                <button wire:click="editmodal('{{$article->id}}')"
                                class="btn btn-info"><i class="fa fa-edit"></i></button>
                                </div>
                            @endcan
                            @can("delete")
                                <div class="col-sm-6">
                                    <button class="btn btn-danger" 
                                data-toggle="modal" data-target="#delete{{$article->id}}" >
                                    <b><i class="fa fa-trash"></i></b></button>
                                    <div class="modal fade" id="delete{{$article->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                            
                                            
                                                <!--begin::Form-->
                                                <form method="post" action="deletearticle">
                                                    <!--begin::Body-->
                                                    @csrf
                                                    <label style="text-align:center; color:red">Voulez vous vraiment supprimer le type "{{$article->libele}}"?</label>
                                                    <input type="text" class="form-control" value="{{$article->id}}" wire-model="id" 
                                                    name="id" id="{{$article->id}}" style="display:none;">

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
                    {{$articles->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->