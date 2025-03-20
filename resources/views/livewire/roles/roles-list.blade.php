<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Les roles</h3><br>
                <button class="btn btn-primary" wire:click="addmodal" ><b><i class="fa fa-plus"></i> <i class="fa fa-folder"></i></b></button> <br>
            
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
                        <th>#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Ajouté le:</th>
                       
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                        <tr class="align-middle">
                         <td>{{$role->id}}</td>
                        <td>{{$role->intitule}}</td>
                        <td>{{$role->description}}</td>
                        <td>@php echo date('d/m/Y',strtotime($role->created_at));@endphp</td>
                        <td>
                        <div class="row">
                            <div class="col-sm-6">
                              <button wire:click="editmodal('{{$role->id}}')"
                               class="btn btn-info"><i class="fa fa-edit"></i></button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-danger" 
                               data-toggle="modal" data-target="#delete{{$role->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$role->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        
                                        </div>
                                        <div class="modal-body">
                                          
                                        
                                            <!--begin::Form-->
                                            <form method="post" action="deleterole">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer le role "{{$role->intitule}}"?</label>
                                                <input type="text" class="form-control" value="{{$role->id}}" wire-model="id" 
                                                name="id" id="{{$role->id}}" style="display:none;">

                                                <!--end::Body-->
                                                 <!--begin::Footer delete($role->id)  wire:click="confirmDelete(' $role->nom_prenoms ', '$role->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
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
                @endforeach
                    
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination  m-0 float-end">
                    {{$roles->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->