<div class="modal fade" id="detailsModal" wire:ignore.self >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title">Ajouter une entreprise</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
           
        </div>
        <div class="modal-body">
            <div class="card card-info card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header"><div class="card-title">(*) Obligatoire</div></div>
                <!--end::Header-->
                <!--begin::Form-->
                <form wire:submit="Add">
                    <!--begin::Body-->
                    @csrf
                    @if(session('warn'))
                    <div class="alert alert-warning">
                        {{session('warn')}}
                    </div>
                    @endif
                    
                    <div class="card-body">
                    
                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Nom </label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control"  maxlength="150" wire:model="Details.nom" disabled />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Adresse </label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="60" wire:model="Details.adresse" 
                            disabled placeholder="COCODY RIVIERA 2" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Téléphone</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="150" wire:model="Details.telephone" 
                            placeholder="+225 0154795240" disabled/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Activité</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="80" wire:model="Details.activite" disabled/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Email </label>
                            <div class="col-sm-12">
                            <input type="email" class="form-control" maxlength="30" wire:model="Details.adresse_email" 
                            disabled />
                            </div>
                    
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Adresse de facturation</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="60" wire:model="Details.adresse_facturation" 
                            disabled />
                            </div>
                    
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Numéro de contribuable </label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" maxlength="150" wire:model="Details.numero_contribuable" 
                            disabled  />
                            </div>
                    
                        </div>

                        <div class="row mb-3">
                            <label  class="col-sm-12 col-form-label">Statut: </label>
                            <div class="col-sm-12">
                                <select class="form-control" wire:model="Details.id_statutclient" disabled>
                                    <option value="">Choisir</option>
                                    <option value="1">PROSPECT</option>
                                    <option value="2">DEFINITIF</option>
                                </select>
                            </div>
                    
                        </div>

                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="close" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
                    
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