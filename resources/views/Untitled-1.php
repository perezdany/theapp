       <!--<button class="btn btn-info" 
                                    data-toggle="modal" data-target="#edit{{$cotation->id}}" >
                                        <b><i class="fa fa-edit"></i></b></button>-->
                                    <div class="modal fade" id="edit{{$cotation->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Edition du devis {{$cotation->numero_devis}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <!--begin::Form-->
                                                <form method="post" action="edit_devis">
                                                    @csrf
                                                    <input type="text" value="{{$cotation->id}}" name="id" style="display:none;"/>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                            <label>Date de création</label>
                                                            <input type="date" name="date_creation"  value="{{$cotation->date_creation}}" class="form-control" placeholder="Enter ..." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label>Numero du devis</label>
                                                            <input type="text" name="numero_devis"  value="{{$cotation->numero_devis}}" class="form-control" placeholder="Entrez ..." required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                            <label>Valide jusqu'au:</label>
                                                            <input type="date" name="date_validite" value="{{$cotation->date_validite}}" class="form-control" placeholder="Enter ..." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label>Choisir le client</label>
                                                                <select class="form-control" required name="id_client">
                                                                    @php
                                                                        $clients = DB::table('clients')->get();
                                                                    @endphp
                                                                    <option value="{{$cotation->id_client}}">{{$cotation->nom}}</option>
                                                                    @foreach($clients as $client)
                                                                        <option value="{{$client->id}}">{{$client->nom}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2"></div>
                                                        <div class="form-group">
                                                        <label>Service:</label>
                                                            <select class="form-control" name="service" >
                                                                
                                                                @php
                                                                    $services = DB::table('services')->get();
                                                                @endphp
                                                                <option value={{$cotation->id_service}}>{{$cotation->libele_service}}</option>
                                                                @foreach($services as $service)
                                                                    <option value={{$service->id}}>{{$service->libele_service}}</option>
                                                                @endforeach
                                                                
                                                            </select>   
                                                        </div>
                                                        <div class="col-sm-2"></div>
                                                    </div>
                                                        
                                                    <div class="row modal-footer justify-content-between">
                                                    <a href="devis"><span class="btn btn-danger">Retour</span></a>
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