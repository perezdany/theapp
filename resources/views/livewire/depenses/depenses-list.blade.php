<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
   
    <div class="col-12">
        
        <div class="card">
            <div class="card-header"><h3 class="card-title">Les dépenses</h3><br>
                <button class="btn btn-primary" wire:click="addmodal" ><b><i class="fa fa-plus"></i></b></button> <br>
                <a href="depenses" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>

                <form action="filter_depense_date_crea"  class="row"method="post">
                @csrf
                 Date du-au:<br>
                    <div class="col-xs-2">
                        <input type="date" class="form-control" name="debut">
                        <!--<select class="form-control" id="compare" name="compare">
                            <option value="">Choisir</option>
                            <option value="<"><</option> 
                            <option value=">">></option>
                            <option value="=">=</option>                              
                        </select>-->
                    </div>
                    <div class="col-xs-2">
                        <input type="date" class="form-control" name="fin">
                        <!--<select class="form-control" id="anne_depuis" name="annee">
                            <option value="">Choisir</option>
                            @php
                                $annee_fin = "2050";
                                for($annee="2014"; $annee<=$annee_fin; $annee++)
                                {
                                    echo'<option value='.$annee.'>'.$annee.'</option>';
                                }
                            @endphp
                        </select>   -->
                    </div>
                    <div class="input-group-append pull-right col-sx-2">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <br>
                <div class="row">
                
                    <!--wire:model.live.debounce.250ms="user"-->
           
                    <div class="col-md-3 input-group input-group-sm">
                    <form method="post" action="filter_user_depenses" class="row">
                        @csrf
                        <select class="form-control col-sm-10" id="user" name ="user">
                            <option value="">Utilisateurs</option>
                            @php
                                $t = DB::table('users')->get();
                            @endphp
                            @foreach($t as $t)
                                <option value={{$t->id}}>{{$t->nom_prenoms}}</option>
                            @endforeach
                            
                        </select>   
                        <div class="input-group-append pull-right col-sm-2">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    </div>    
                   
                </div>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <!--<input type="text" wire:model.live.debounce.250ms="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>-->
                  </div>
                </div>
  
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Objet/Commentaire</th>
                        <th>Montant</th>
                        <th>Numéro de transaction</th>
                        <th>Mod/Supp</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($depenses as $depense)
                    <tr class="align-middle">
                        <td>@php echo date('d/m/Y',strtotime($depense->date_sortie));@endphp</td>
                        <td>{{$depense->objet}}</td>
                        <td>
                            @php
                                echo number_format($depense->montant, 2, ',', ' ')." XOF";
                            @endphp
                        </td>
                        <td>{{$depense->numero}}</td>
                        <td>
                        <div class="row">
                            @can("edit")
                            <div class="col-sm-6">
                              <button wire:click="editmodal('{{$depense->id}}')"
                               class="btn btn-info"><i class="fa fa-edit"></i></button>
                            </div>
                            @endcan
                            @can("delete")
                            <div class="col-sm-6">
                                <button class="btn btn-danger" 
                               data-toggle="modal" data-target="#delete{{$depense->id}}" >
                                 <b><i class="fa fa-trash"></i></b></button>
                                <div class="modal fade" id="delete{{$depense->id}}"  wire:ignore.self  depense="dialog" aria-hidden="true" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        
                                        </div>
                                        <div class="modal-body">
                                          
                                            <!--begin::Form-->
                                            <form method="post" action="deletedepense">
                                                <!--begin::Body-->
                                                @csrf
                                                <label style="text-align:center; color:red">Voulez vous vraiment supprimer cette dépense?</label>
                                                <input type="text" class="form-control" value="{{$depense->id}}" wire-model="id" 
                                                name="id" id="{{$depense->id}}" style="display:none;">

                                                <!--end::Body-->
                                                 <!--begin::Footer delete($depense->id)  wire:click="confirmDelete(' $depense->nom_prenoms ', '$depense->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
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
                    <tr colspan="8">
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
                    {{$depenses->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->