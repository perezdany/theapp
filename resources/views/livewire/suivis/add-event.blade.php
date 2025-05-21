<div class="modal fade" id="addModal"  wire:ignore.self  role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Ajouter un évènement</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!--begin::Form wire:submit="addEvent"-->
            <form >
              
                
                <div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Titre de l'évenement</label>
                        <input type="text"  wire:model="title" id="title" class="form-control" 
                        maxlenght="150" placeholder="Entrer ..."  required>
                        <span id="titleError" class="text-danger"></span>
                        </div>
                    </div>
                   
                </div>
                <!--<div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Date de l'évenement</label>
                        <input type="date"  wire:model="nom_projet" class="form-control" maxlenght="150" placeholder="Entrer ..." >
                        </div>
                    </div>
                   
                </div>-->
                <div class="row">
                    <div class="col-sm-6">
                         
                        <div class="form-group">
                        <label>Heure de début</label>
                        <input type="time"  id="startime" class="form-control" 
                        maxlenght="150" placeholder="Entrer ..." >
                        </div>
                    </div>

                    <div class="col-sm-6">
                         
                        <div class="form-group">
                        <label>Date-Heure de fin</label>
                        <input type="datetime-local"  wire:model="end"  id="end" class="form-control"
                         maxlenght="150" placeholder="Entrer ..." required >
                        </div>
                        <span id="endError" class="text-danger"></span>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-sm-12">
                         
                        <div class="form-group">
                        <label>Client</label>
                        <select wire:model="id_client" class="form-control" id="id_client">
                            @php
                                $g = DB::table('clients')->get();
                            @endphp
                            <option value="">--Choisir--</option>
                            @foreach($g as $g)
                               <option value="{{$g->id}}">{{$g->nom}}</option> 
                            @endforeach
                        </select>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-sm-6">
                         
                        <div class="form-group">
                        <label>Projet</label>
                        <select wire:model="id_projet" class="form-control" id="id_projet">
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
                        <select wire:model="id_fournisseur" class="form-control" id="id_fournisseur">
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

                <div class="row modal-footer justify-content-between">
                    <button wire:click="close" type="button" class="btn btn-danger" data-dismiss="modal">Retour</button>
                    <button type="button" id="savebtn" class="btn btn-info float-right">Valider</button>
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