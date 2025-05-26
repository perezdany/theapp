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
            <form wire:submit="updateProjet">
                @csrf
                
                <div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Titre du projet</label>
                        <input type="text"  wire:model="editProjet.nom_projet" class="form-control" placeholder="Entrer ..." >
                        </div>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Description</label>
                        <textarea  wire:model="editProjet.description" class="form-control" ></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label>Client</label>
                        <select class="form-control" wire:model="editProjet.id_client" required>
                                                
                            @php
                                $clients = DB::table('clients')->get();
                            @endphp
                            @foreach($clients as $client)
                                <option value={{$client->id}}>{{$client->nom}}</option>
                            @endforeach
                            
                        </select>   
                    </div><br><br>

                    <div class="col-sm-6">
                         
                        <label>Date de début</label>
                        <input type="date"  wire:model="editProjet.date_debut" class="form-control" placeholder="Entrer ..." >
                    </div>

                    <div class="col-sm-6">
                         
                        <label>Date de fin</label>
                        <input type="date"  wire:model="editProjet.date_fin" class="form-control" placeholder="Entrer ..." >
                    </div>

                    <div class="col-sm-6">
                         
                        <label>Statut</label>
                        <select class="form-control" wire:model="editProjet.cloture" >
                          
                            <option value="0">EN COURS</option>
                            <option value="1">CLOTURE</option>
                            
                        </select>   
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