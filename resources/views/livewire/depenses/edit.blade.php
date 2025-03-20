<div class="modal fade" id="editModal" wire:ignore.self  >
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
                 <form wire:submit="updateDepense">
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
                            <label  class="col-sm-12 col-form-label">Objet(*) </label>
                            <div class="col-sm-12">
                            <textarea type="text" class="form-control" wire:model="editDepense.objet" required>
                            </textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Date(*) </label>
                            <div class="col-sm-12">
                            <input type="date" class="form-control" maxlength="30" wire:model="editDepense.date_sortie" 
                            required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Nom du bénéficiaire</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="150" wire:model="editDepense.nom_beneficiaire" 
                            onkeyup='this.value=this.value.toUpperCase()' />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Montant(*) </label>
                            <div class="col-sm-12">
                            <input type="number" class="form-control" maxlength="15" wire:model="editDepense.montant" 
                            required  />
                            </div>
                    
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Numéro de chèque(*) </label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="15" wire:model="editDepense.numero_cheque" />
                            </div>
                        
                        </div>
                        
                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Nom de la banque(*) </label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="15" wire:model="editDepense.banque" 
                           />
                            </div>
                        
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Numéro de virement </label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="15" wire:model="editDepense.numero_virement" 
                         />
                            </div>
                    
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Date de virement </label>
                            <div class="col-sm-12">
                            <input type="date" class="form-control" wire:model="editDepense.date_virement" />
                            </div>
                    
                        </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="close" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
                    
                    <button type="submit"  wire:click="$refresh" class="btn btn-success pull-right">Valider</button>

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