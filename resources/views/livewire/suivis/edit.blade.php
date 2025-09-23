<div class="modal fade" id="editModal"  wire:ignore.self  role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Modification</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!--begin::Form wire:submit="addEvent"-->
            <form wire:submit="updateSuivi">

                <div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Titre de l'évenement</label>
                        <input type="text"  wire:model="editSuivi.title" id="title" class="form-control" 
                        maxlenght="150" placeholder="Entrer ..."  disabled>
                        <span id="titleError" class="text-danger"></span>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Date de l'évenement</label>
                        <input type="datetime-local"  wire:model="editSuivi.start" 
                        class="form-control" maxlenght="150" placeholder="Entrer ..." disabled >
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <!--<div class="col-sm-6">
                         
                        <div class="form-group">
                        <label>Heure de début</label>
                        <input type="time"  id="startime" class="form-control" 
                        maxlenght="150" placeholder="Entrer ..." >
                        </div>
                    </div>-->

                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Date-Heure de fin</label>
                        <input type="datetime-local"  wire:model="editSuivi.end"  id="end" class="form-control"
                         maxlenght="150" placeholder="Entrer ..." disabled >
                        </div>
                        <span id="endError" class="text-danger"></span>
                    </div>
                   
                </div>
             
                <div class="row">
                    <div class="col-sm-6">
                         
                        <div class="form-group">
                        <label>Projet</label>
                        <select wire:model="editSuivi.id_projet" class="form-control" id="id_projet" disabled>
                            @php
                                $get_projet = DB::table('projets')->get();
                            @endphp
                            <option value="">--Choisir--</option>
                            @foreach($get_projet as $get_projet)
                               <option value="{{$get_projet->id}}">{{$get_projet->nom_projet}}</option> 
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                         
                        <div class="form-group">
                        <label>Fournisseur</label>
                        <select wire:model="editSuivi.id_fournisseur" class="form-control" id="id_fournisseur" disabled>
                            @php
                                $f = DB::table('fournisseurs')->get();
                            @endphp
                            <option value="">--Choisir--</option>
                            @foreach($f as $f)
                               <option value="{{$f->id}}">{{$f->nom}}</option> 
                            @endforeach
                        </select>
                        </div>
                    </div>
                   
                </div>

                 <div class="row">
                    <div class="form-group col-md-6">
                        <label>Choisir le client</label>
                        <select class="form-control" wire:model="editSuivi.id_client" name="id_client" disabled>
                            @php
                                $clients = DB::table('clients')->orderBy('nom', 'ASC')->get();
                            @endphp
                            <option value="">--selectionner un client--</option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <label>Observation/Commentaire/Plus de détails</label>
                    <textarea wire:model="editSuivi.more" class="form-control" id="more" disabled>
                    </textarea>
                </div>

                <div class="row modal-footer justify-content-between">
                    <button wire:click="close" type="button" class="btn btn-danger" data-dismiss="modal">Retour</button>
                    <button type="submit" id="savebtn" class="btn btn-info float-right">Valider</button>
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