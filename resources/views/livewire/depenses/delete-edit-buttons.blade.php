 <div class="row">
                            @can("edit")
                            <div class="col-sm-6">
                              <button wire:click="editmodal('{{$depense->id}}')"
                               class="btn btn-info"><i class="fa fa-edit"></i></button>
                            </div>
                            @endcan
                            @can("delete")
                            <div class="col-sm-6">
                                <button class="btn btn-danger" 
                               data-toggle="modal" data-target="#delete{{$depense->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$depense->id}}"  wire:ignore.self  depense="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        
                                        </div>
                                        <div class="modal-body">
                                          
                                            <!--begin::Form-->
                                            <form method="post" action="deletedepense">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer cette dépense?</label>
                                                <input type="text" class="form-control" value="{{$depense->id}}" wire-model="id" 
                                                name="id" id="{{$depense->id}}" style="display:none;">

                                                <!--end::Body-->
                                                 <!--begin::Footer delete($depense->id)  wire:click="confirmDelete(' $depense->nom_prenoms ', '$depense->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
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