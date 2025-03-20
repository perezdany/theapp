<div class="modal fade" id="editModal" wire:ignore.self >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title">Modification</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
           
        </div>
        <div class="modal-body">
            <div class="card card-info card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header"><div class="card-title">(*) Obligatoire</div></div>
                <!--end::Header-->
                <!--begin::Form-->
                <form wire:submit="updateService">
                    <!--begin::Body-->
                    @csrf
                    @if(session('warn'))
                    <div class="alert alert-warning">
                        {{session('warn')}}
                    </div>
                    @endif

                     @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    
                    <div class="card-body">
                    
                    <div class="row mb-3">
                        <label  class="col-sm-12 col-form-label">Désignation(*) </label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" maxlength="160" wire:model="editService.libele_service" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label  class="col-sm-4 col-form-label">Code(*) </label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" maxlength="30" wire:model="editService.code" 
                        required onkeyup='this.value=this.value.toUpperCase()' />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label  class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" maxlength="250" wire:model="editService.description" 
                        required onkeyup='this.value=this.value.toUpperCase()' />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label  class="col-sm-4 col-form-label">Suspendu?(*) </label>
                        <div class="col-sm-8">
                            <select class="form-control" wire:model="editService.suspendu" >
                                <option value="0">NON</option>
                                <option value="1">OUI</option>
                            </select>
                        </div>
                    </div>
                    
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="modal-footer justify-content-between">
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