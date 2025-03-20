<div class="modal fade" id="addModal" wire:ignore.self tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title">Ajouter un utilisateur</h4>
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
                 

                    @if(session('warn'))
                      <div class="alert alert-warning">
                        {{session('warn')}}
                      </div>
                    @endif
                    
                    <div class="card-body">
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Email(*)</label>
                        <div class="col-sm-8">
                          <input type="email" maxlength="50" class="form-control" id="inputEmail3" wire:model="login" required/>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label  class="col-sm-4 col-form-label">Nom & Prénom(s) (*) </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" maxlength="160" id="inputPassword3" wire:model="nom_prenoms" required onkeyup='this.value=this.value.toUpperCase()' />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label  class="col-sm-4 col-form-label">Département(*)</label>
                        <div class="col-sm-8">
                        
                          <select class="form-control" wire:model="departements_id" required >
                            @php
                              $dep = $departementcontroller->GetAll();
                            @endphp
                            <option>--Veuillez Choisir--</option>
                            @foreach($dep as $dep)
                              
                                <option value="{{$dep->id}}">{{$dep->libele_departement}}</option>
                                
                            @endforeach
                          </select>

                        </div>
                      </div>
                      <div class="row mb-3">
                        <label  class="col-sm-4 col-form-label" >Intiutlé du poste (*)</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" maxlength="60" wire:model="poste" required onkeyup='this.value=this.value.toUpperCase()' />
                        </div>
                      </div>
                      <!--<fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                        <div class="col-sm-10">
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="gridRadios"
                              id="gridRadios1"
                              value="option1"
                              checked
                            />
                            <label class="form-check-label" for="gridRadios1"> First radio </label>
                          </div>
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="gridRadios"
                              id="gridRadios2"
                              value="option2"
                            />
                            <label class="form-check-label" for="gridRadios2"> Second radio </label>
                          </div>
                          <div class="form-check disabled">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="gridRadios"
                              id="gridRadios3"
                              value="option3"
                              disabled
                            />
                            <label class="form-check-label" for="gridRadios3">
                              Third disabled radio
                            </label>
                          </div>
                        </div>
                      </fieldset>
                      <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1" />
                            <label class="form-check-label" for="gridCheck1">
                              Example checkbox
                            </label>
                          </div>
                        </div>
                      </div>-->
                      <!--<div class="row mb-3">
                        <label class="col-sm-12 col-form-label">Rôles</label>
                        <div class="form-group">
                        
                         
                         
                        </div>
                      </div>-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="modal-footer">
                      <button type="button" wire:click="close" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
                      
                      <button type="submit" class="btn btn-success pull-right">Valider</button>
                                    
                           
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