<div class="modal fade" id="addModal"  wire:ignore.self  role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Ajouter une facture(Avoir)</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!--begin::Form-->
            <form wire:submit="addFacture">
                @csrf
                
                <div class="row">
                    <div class="col-sm-6">
                         
                        <div class="form-group">
                        <label>Numéro avoir</label>
                        <input type="text"  wire:model="numero_avoir" class="form-control" placeholder="Entrer ..." >
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group">
                        <label>Montant</label>
                        <input type="number"  wire:model="montant_facture" class="form-control" placeholder="Entrer ..." >
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Date d'émission:</label>
                           <input type="date"  wire:model="date_emission" class="form-control" placeholder="Entrer ..." >
                        </div>
                       <!--<div class="form-group">
                        <label>A régler d'ici le </label>
                        <input type="date"  wire:model="date_regelement" class="form-control" placeholder="Entrer ..." >
                        </div>-->
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Numéro Devis</label>
                            <select class="form-control" wire:model="id_cotation">
                                @php
                                    $les_devis = DB::table('cotations')->get();
                                @endphp
                                <!--<option>--Choisir Si Existant--</option>-->
                                @foreach($les_devis as $devis)
                                    <option value="{{$devis->id}}">N°{{$devis->numero_devis}} du {{$devis->date_creation}}</option>
                                @endforeach
                                
                            </select>
                        
                        </div>
                    </div>
                </div>

                <div class="row">
                   
                    <div class="col-sm-6">
                      
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="display:none;">
                        <label>Annulée</label>
                        <select class="form-control" wire:model="annulee">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                        
                        </div>
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