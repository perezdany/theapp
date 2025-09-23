<!--begin::Row--><!--wire:click="AddUserForm"-->
<div class="content-header">
    <div class="container-fluid">
    
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>
<div class="row">
   
    <div class="col-12">
        
        <div class="card">
            <div class="card-header"><h3 class="card-title">Les infos de la caisse</h3><br>
                <button class="btn btn-primary" wire:click="addmodal" ><b><i class="fa fa-plus"></i></b></button> <br>
                <a href="depenses" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                <div class="row">
                    <form action="filter_depense_date_crea"  class="row"method="post">
                        @csrf
                        Date du-au:<br>
                        <div class="col-xs-2">
                            <input type="date" class="form-control" name="debut">
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
                        <div class=" pull-right col-sx-2">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--wire:model.live.debounce.250ms="user" wire:model.live.debounce.250ms="search"-->
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
                        <div class=" pull-right col-sm-2">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    </div>   

                    <div class="col-md-3 input-group input-group-sm">
                    <form method="post" action="filter_search_user_depenses" class="row">
                        @csrf
                        <div class="col-sm-10">
                        <input type="text" name="search" 
                        class="form-control" placeholder="Rechercher"></div>
                        <div class=" col-sm-2">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button></div>
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
                  <table id="example1" class="table table-bordered table-striped" style="display:none">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Objet/Commentaire</th>
                            <th>Numéro de transaction</th>
                            <th>Entrée</th>
                            <th>Sortie</th>
                        
                        </tr>
                    </thead>
                    <tbody>
            
                    @forelse($depenses as $depense)
                        <tr class="align-middle">
                            <td>@php echo date('d/m/Y',strtotime($depense->date_sortie));@endphp</td>
                            <td>{{$depense->objet}}</td>
                        
                            <td>{{$depense->numero}}</td>
                            @if($depense->type_caisse == 0)
                                <td></td>
                                <td>
                                    @php
                                        echo number_format($depense->montant, 2, ',', ' ')." XOF";
                                    @endphp
                                </td>
                                
                            @else
                                <td>
                                    @php
                                        echo number_format($depense->montant, 2, ',', ' ')." XOF";
                                    @endphp
                                </td>
                                <td></td>
                            @endif
                
                        </tr>
                    @empty
                       
                    @endforelse
                    
                    </tbody>
                </table>
            </div>
         
            <div class="card-body table-responsive p-0">

                <!------------->    
                <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Objet/Commentaire</th>
                        <th>Numéro de transaction</th>
                        <th>Entrée</th>
                        <th>Sortie</th>
                        <th>Mise à jour le:</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $somme_sorties = 0; 
                    $somme_entrees = 0;
                @endphp
                @forelse($depenses as $depense)
                    <tr class="align-middle">
                        <td>@php echo date('d/m/Y',strtotime($depense->date_sortie));@endphp</td>
                        <td>{{$depense->objet}}</td>
                     
                        <td>{{$depense->numero}}</td>
                        @if($depense->type_caisse == 0)
                            <td></td>
                            <td>
                                @php
                                    echo number_format($depense->montant, 2, ',', ' ')." XOF";
                                    $somme_sorties = $somme_sorties + $depense->montant;
                                @endphp
                            </td>
                            
                        @else
                            <td>
                                @php
                                    echo number_format($depense->montant, 2, ',', ' ')." XOF";
                                    $somme_entrees = $somme_entrees + $depense->montant
                                @endphp
                            </td>
                            <td></td>
                        @endif
                        <td>@php echo date('d/m/Y H:i:s',strtotime($depense->updated_at));@endphp</td>
                        <td>
                            @include('livewire/depenses/delete-edit-buttons')
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
            
           @php
                $solde = $somme_entrees - $somme_sorties;
           @endphp
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header bg-warning">
               
                @if($date_finale != null)
                    <span>
                        <b>SOLDE AU 
                        @php
                            echo date('d/m/Y',strtotime($date_finale))."</b>: <i>".number_format($solde, 2, ',', ' ')." XOF</i>";
                        @endphp
                    </span>
                @else
                
                     <span>
                        <b>
                            SOLDE AU
                            @php
                                $today = date('d/m/Y');
                                echo $today."</b>: <i>".number_format($solde, 2, ',', ' ')." XOF</i>";
                            @endphp</b>
                       
                    </span>
                @endif
               
                <!--<form action="filter_depense_date_crea"  class="row"method="post">
                    @csrf
                    Date du-au:<br>
                    <div class="col-xs-2">
                        <input type="date" class="form-control" name="debut">
                    </div>
                    <div class="col-xs-2">
                        <input type="date" class="form-control" name="fin">
                    </div>
                    <div class="input-group-append pull-right col-sx-2">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>-->
                <br>
               
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
        </div>
        <!-- /.card -->
    
    </div>
    <!-- /.col -->
    
</div>
<!--end::Row-->