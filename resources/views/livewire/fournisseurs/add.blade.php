<div class="modal fade" id="addModal"  wire:ignore.self  role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Ajouter un Fournisseur</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!--begin::Form-->
            <form wire:submit="addFournisseur">
                @csrf
                
                <div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Nom du fournisseur</label>
                        <input type="text"  wire:model="nom" class="form-control" placeholder="Entrer ..." required >
                        </div>
                    </div>

                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text"  wire:model="telephone" class="form-control" placeholder="+225 65 98 74 52 10" >
                        </div>
                    </div>
                    
                    
                </div>
               
                <div class="row modal-footer justify-content-between">
                    <button wire:click="close" type="button" class="btn btn-danger" data-dismiss="modal">Retour</button>
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