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
                <thead style="display:none">
                    <tr>
                        <th>Date</th>
                        <th>Objet/Commentaire</th>
                        <th>Montant</th>
                        <th>Numéro de transaction</th>
           
                    </tr>
                </thead>
                <tbody style="display:none">
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
                   
                    </tr>
                @empty
                  
                @endforelse
                    
                </tbody>
                </table>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Objet/Commentaire</th>
                        <th>Montant</th>
                        <th>Numéro de transaction</th>
                        <th></th>
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