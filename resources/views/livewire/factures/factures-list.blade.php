<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
    
    <div class="col-12">
       
        <div class="card">
         
            <div class="card-header"><h3 class="card-title">Liste des factures</h3><br>
            
              <button class="btn btn-primary" wire:click="addmodal" >
                <b><i class="fa fa-plus"></i></b></button><br>
              
                <a href="factures" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
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
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="statut">
                            <option value="">Etat</option>
                            <option value="1">ANNULEE</option>
                            <option value="0">PAS ANNULEE</option>

                        </select>   
                    </div>   

                    <div class="col-md-2 input-group input-group-sm">
                        <select class="form-control" id="departement" wire:model.live.debounce.250ms="t_reglee">
                            <option value="">Facture réglée</option>
                            <option value="1">OUI</option>
                            <option value="0">NON</option>

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
                        <th wire:click="setOrderField('numero_facture')"><i class="fa fa-sort" aria-hidden="true"></i>N°</th>
                        <th wire:click="setOrderField('date_emission')"><i class="fa fa-sort" aria-hidden="true"></i>Date</th>
                        <th wire:click="setOrderField('montant')"><i class="fa fa-sort" aria-hidden="true"></i>Montant</th>
                        <th>Type</th>
                        <th wire:click="setOrderField('date_reglement')"><i class="fa fa-sort" aria-hidden="true"></i>Régler avant le:</th>
                        <th>Etat</th>
                        <th wire:click="setOrderField('numero_devis')"><i class="fa fa-sort" aria-hidden="true"></i>Devis N°:</th>
                        <th>Client</th>
                        
                        <th>Ajouter le fichier</th>
                        <th>Aperçu du fichier</th>
                        <th>Paiements</th>
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($factures as $facture)
                    <tr class="align-middle">
                        <td>
                            @if($facture->numero_facture == NULL)
                                {{$facture->numero_avoir}}
                            @else
                                {{$facture->numero_facture}}
                            @endif
                        
                        </td>
                        <td>@php echo date('d/m/Y',strtotime($facture->date_emission));@endphp</td>
                        <td>@php echo number_format($facture->montant_facture, 2, ".", " ")."F CFA"; @endphp</td>
                        <td> 
                            @if($facture->numero_facture == NULL)
                                <span class="bg-warning">Avoir</span>
                            @else
                                <span class="bg-primary">Facture</span>
                            @endif
                        </td>
                        <td>@php echo date('d/m/Y',strtotime($facture->date_reglement));@endphp</td>
                        <td>
                            @if($facture->annulee == 0)
                               <!--<span class="bg-success">Pas annulée</span>-->
                                @if($facture->reglee == 0)
                                    <span class="bg-danger">Non réglée</span>
                                @else
                                    <span class="bg-success">Réglée</span>
                                @endif
                            @else
                                
                                <span class="bg-danger">Annulée</span>
                            @endif
                        </td>
                        <td>{{$facture->numero_devis}}</td>
                        
                        <td>{{$facture->nom}}</td>
                        <td>
                            @can("edit")
                        
                            <button class="btn btn-primary" 
                                data-toggle="modal" data-target="#upload{{$facture->id}}" >
                                 <b><i class="fa fa-upload"></i></b></button>
                            <div class="modal fade" id="upload{{$facture->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ajouter le fichier scanné (PDF)</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <!--begin::Form-->
                                    <form method="post" action="uploadfileinvoice" enctype="multipart/form-data">
                                        <!--begin::Body-->
                                        @csrf
                                        <input type="text" class="form-control" value="{{$facture->id}}"
                                        name="id" id="{{$facture->id}}" style="display:none;">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Fichier PDF</label>
                                
                                            <input type="file" class="form-control" id="path" name="file">

                                        </div>
                                    
                                        <!--end::Body-->
                                        <div class=" row modal-footer justify-content-between" style="aling:center">
                                        
                                        <button type="button" wire:click="close" class="btn btn-danger btn-lg col-md-3" data-dismiss="modal">Fermer</button>
                                
                                        <button type="submit"  class="btn btn-success btn-lg col-md-3">Valider</button>
  
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
                            @endcan
                        </td>
                        <td>
                            <form action="dld_invoice" method="post" target="blank" enctype="multipart/form-data">
                                @csrf
                                <input type="text" style="display:none;" value="{{$facture->id}}">
                                <input type="text" style="display:none;" class="form-control" name="file" value="{{$facture->file_path}}">
                                <button class="btn btn-warning" type="submit"><i class="fa fa-download"></i></button>
                            </form>    
                        </td>
                         <td>
                            @if($facture->numero_facture != NULL)
                            <form action="paiement_form" method="post" target="blank">
                                @csrf
                                <input type="text" value={{$facture->id}} style="display:none;" name="id_facture">
                                <button type="submit" class="btn btn-success"><i class="fa fa-credit-card"></i></button>
                            </form>  
                            @else
                            @endif
                        </td>
                        <td>
                        <div class="row">
                            @can("edit")
                            <div class="col-sm-6">
                                <button wire:click="editmodal('{{$facture->id}}')"
                               class="btn btn-info"><i class="fa fa-edit"></i></button>
                               
                            </div>
                            @endcan
                            @can("delete")
                            <div class="col-sm-6">
                                <button class="btn btn-danger" 
                                data-toggle="modal" data-target="#delete{{$facture->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$facture->id}}"  wire:ignore.self  role="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <!--begin::Form-->
                                            <form method="post" action="deletefacture">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer la facture?</label>
                                                <input type="text" class="form-control" value="{{$facture->id}}" wire-model="id" 
                                                name="id" id="{{$facture->id}}" style="display:none;">

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
                    {{$factures->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->