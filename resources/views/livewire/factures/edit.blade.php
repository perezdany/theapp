<div class="modal fade" id="editModal"  wire:ignore.self  role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Modification</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!--begin::Form-->
            <form wire:submit="updateFacture">
                @csrf
                
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                        <label>Numéro de la facture</label>
                        <input type="text"  wire:model="editFacture.numero_facture" class="form-control" placeholder="Entrer ..." >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>Numéro avoir</label>
                        <input type="text"  wire:model="editFacture.numero_avoir" class="form-control" placeholder="Entrer ..." >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Facture émise le:</label>
                           <input type="date"  wire:model="editFacture.date_emission" class="form-control" placeholder="Entrer ..." >
                        </div>
                        <!--<div class="form-group">
                        <label>Numéro proforma</label>
                        <input type="text"  wire:model="editFacture.numero_proforma" class="form-control" placeholder="Entrer ..." >
                        </div>-->
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>A régler d'ici le </label>
                        <input type="date"  wire:model="editFacture.date_reglement" class="form-control" placeholder="Entrer ..." >
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>Montant</label>
                        <input type="number"  wire:model="editFacture.montant_facture" class="form-control" placeholder="Entrer ..." >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>Numéro avoir</label>
                        <select class="form-control" wire:model="editFacture.annulee">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                        
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                         <label>Numéro avoir</label>
                        <select class="form-control" wire:model="editFacture.id_cotation">
                            @php
                                $les_devis = DB::table('cotations')->get();
                            @endphp
                            @foreach($les_devis as $devis)
                                <option value="{{$devis->id}}">N°{{$devis->numero_devis}} du {{$devis->date_creation}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-sm-6">
                       
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