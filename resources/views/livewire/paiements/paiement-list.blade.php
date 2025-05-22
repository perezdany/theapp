<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
    
    <div class="col-12">
       
        <div class="card">
         
            <div class="card-header"><h3 class="card-title">Liste des paiements</h3><br>
            
              <!--<button class="btn btn-primary" wire:click="addmodal" >
                <b><i class="fa fa-plus"></i></b></button><br>-->
              
                <a href="paiements" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                <div class="row">
                    Date de création:
                    <div class="col-xs-2">
                        <select class="" id="compare" wire:model.live.debounce.250ms="compare">
                            <option value="">Choisir</option>
                            <option value="<"><</option> 
                            <option value=">">></option>
                            <option value="=">=</option>                              
                        </select>   
                    </div>
                    <div class="col-xs-2">
                        <select class="" id="anne_depuis" wire:model.live.debounce.250ms="annee">
                            <option value="">Choisir</option>
                            @php
                                $annee_fin = "2050";
                                for($annee="2014"; $annee<=$annee_fin; $annee++)
                                {
                                    echo'<option value='.$annee.'>'.$annee.'</option>';
                                }
                            @endphp
                            
                        </select>   
                    </div>
                </div><br>
                <div class="row">
                
                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="client">
                            <option value="">Clients</option>
                            @php
                                $c = DB::table('clients')->get();
                            @endphp
                            @foreach($c as $c)
                                <option value={{$c->id}}>{{$c->nom}}</option>
                            @endforeach
                            
                        </select>     
                    </div>    

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="user">
                            <option value="">Utilisateurs</option>
                            @php
                                $t = DB::table('users')->get();
                            @endphp
                            @foreach($t as $t)
                                <option value={{$t->id}}>{{$t->nom_prenoms}}</option>
                            @endforeach
                            
                        </select>   
                    </div>  

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="id_cotation">
                            <option value="">Devis</option>
                            @php
                                $d = DB::table('cotations')->get();
                            @endphp
                            @foreach($d as $d)
                                <option value={{$d->id}}>{{$d->numero_devis}}</option>
                            @endforeach
                            
                        </select>   
                    </div>  

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="id_facture">
                            <option value="">Factures</option>
                            @php
                                $f = DB::table('factures')->get();
                            @endphp
                            @foreach($f as $f)
                                <option value={{$f->id}}>{{$f->numero_facture}}</option>
                            @endforeach
                            
                        </select>   
                    </div>    
                   
                </div>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" wire:model.live.debounce.250ms="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
  
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th wire:click="setOrderField('paiement')"><i class="fa fa-sort" aria-hidden="true"></i>Montant</th>
                        <th wire:click="setOrderField('numero_facture')"><i class="fa fa-sort" aria-hidden="true"></i>N° de la facture</th>
                        <th>N° de virement/de transfert</th>
                        <th>Banque</th>
                        <th wire:click="setOrderField('date_paiement')"><i class="fa fa-sort" aria-hidden="true"></i>Date de paiemennt</th>
                        <th>Enregistré par:</th>
                        <th>Client</th>
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($paiements as $paiement)
                        <tr class="align-middle">
                        <td>{{$paiement->paiement}}</td>
                        <td>{{$paiement->numero_facture}}</td>
                        <td>{{$paiement->numero}}</td>
                        <td>{{$paiement->banque}}</td>
                        <td>{{$paiement->date_paiement}}</td>
                        <td> {{$paiement->nom_prenoms}}</td>    
                        <td>{{$paiement->nom}}</td>
        
                        <td>
                        <div class="row">
                            @can("edit")
                            <div class="col-sm-6">
                                <form action="p_edit" method="post" target="blank">
                                    @csrf
                                    <input type="text" value={{$paiement->id_paiement}} style="display:none;" name="id_paiement">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i></button>
                                </form>
                            </div>
                            @endcan
                            @can("delete")
                            <div class="col-sm-6">
                                <button class="btn btn-danger" 
                                data-toggle="modal" data-target="#delete{{$paiement->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$paiement->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <!--begin::Form-->
                                            <form method="post" action="deletepaiement">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer ce paiement?</label>
                                                <input type="text" class="form-control" value="{{$paiement->id}}" wire-model="id" 
                                                name="id" id="{{$paiement->id}}" style="display:none;">

                                                <!--end::Body-->
                                                 <!--begin::Footer delete($type->id)  wire:click="confirmDelete(' $type->nom_prenoms ', '$type->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
                                                <div class=" row modal-footer justify-content-between" style="aling:center">
                                                
                                                <button type="button" wire:click="close" class="btn btn-danger btn-lg col-md-3" data-dismiss="modal">NON</button>
                                        
                                                <button type="submit"  class="btn btn-success btn-lg col-md-3">OUi</button>
                                                        
                                                    
                                                </div>
                                                <!--end::Footer-->
                                               
                                                
                                            </form>
                                            <!--end::Form-->
                                        </div> 
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>    
                                <!-- /.modal -->
                            </div>
                            @endcan
                        </div>
                        </td>
                    </tr>
                @empty
                    <tr colspan="9">
                        <div class="alert alert-info alert-dismissible">
                            
                            <h4><i class="icon fa fa-ban"></i> Oups!</h4>
                            Aucune donnée trouvée
                        </div>
                    </tr>
                @endforelse
                    
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination  m-0 float-end">
                    {{$paiements->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->