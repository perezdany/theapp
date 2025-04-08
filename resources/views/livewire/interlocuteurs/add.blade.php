<div class="modal fade" id="addModal"  wire:ignore.self  role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Ajouter un interlocuteur</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <!--begin::Form-->
            <form wire:submit="add">
                @csrf
                
                <div class="row">
                    <div class="form-group col-sm-4">
                    <label>Titre</label>
                    <select  wire:model="titre" class="form-control" required>
                        <option value="">--Choisir--</option>
                        <option value="M">M</option>
                        <option value="Mme">Mme</option>
                        <option value="Mlle">Mlle</option>
                    </select>
                    </div>
                    
                    <div class="form-group col-sm-12">
                    <label>Nom</label>
                    <input type="text"  wire:model="i_nom" class="form-control" placeholder="Entrer ..."  required>
                    </div>

                    <div class="form-group col-sm-12">
                    <label>Prénom(s)</label>
                    <input type="text"  wire:model="prenom" class="form-control" placeholder="Entrer ..."  required>
                    </div>

                    <div class="form-group col-sm-12">
                    <label>Téléphone</label>
                    <input type="text"  wire:model="tel" class="form-control" placeholder="+225 05 75 98 65 21"  required>
                    </div>

                    <div class="form-group col-sm-12">
                    <label>Email</label>
                    <input type="email"  wire:model="email" class="form-control" placeholder="example@email.com"  required >
                    </div>

                    <div class="form-group col-sm-12">
                    <label>Fonctions/Professions</label>
                    <select  wire:model="id_fonction" class="form-control"  required>
                        @php
                            $f = DB::table('fonctions')->get();
                        @endphp
                        <option value="">--Choisir--</option>
                        @foreach($f as $f)
                            <option value="{{$f->id}}">{{$f->libele_fonction}}</option>
                        @endforeach
                     
                    </select>
                    </div>

                    <div class="form-group col-sm-12">
                    <label>Entreprise(Client)</label>
                    <select  wire:model="id_client" class="form-control"  required>
                        @php
                            $e = DB::table('clients')->where('particulier', 0) ->get();
                        @endphp
                        <option value="">--Choisir--</option>
                        @foreach($e as $e)
                            <option value="{{$e->id}}">{{$e->nom}}</option>
                        @endforeach
                     
                    </select>
                    </div>
                </div>
               
                <div class="row modal-footer justify-content-between">
                    <button wire:click="close" class="btn btn-danger" data-dismiss="modal">Retour</button>
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