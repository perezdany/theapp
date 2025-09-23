@php
    use App\Http\Controllers\Calculator;
    use App\Http\Controllers\FactureController;
    use App\Http\Controllers\ArticleController;
    $calculator = new Calculator();
    $facturecontroller = new FactureController();
    $articlecontroller = new ArticleController();

    use App\Models\Suivi_user;
    use App\Models\Suivicommercial;

@endphp
@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-md-12">
          <div class="card">
                <div class="card-header"><h3 class="card-title">Suivi de prospects</h3><br>
                    <button class="btn btn-primary" 
                    data-toggle="modal" data-target="#add" >
                    <b><i class="fa fa-plus"></i></b></button>
                    <div class="modal fade" id="add"  
                    role="dialog" aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Nouvel évenement</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <!--begin::Form-->
                                    <form method="post" action="addsuiviprospect">
                                        <!--begin::Body-->
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                <label>Objet </label>
                                                <input type="text"  name="title" id="title" class="form-control" 
                                                maxlenght="150" placeholder="Entrer ..." required>
                                                <span id="titleError" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                <label>Date-Heure de l'évenement</label>
                                                <input type="datetime-local"  name="start" 
                                                class="form-control" maxlenght="150" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                <label>Date-Heure de fin</label>
                                                <input type="datetime-local"  name="end"  id="end" 
                                                class="form-control"
                                                maxlenght="150" placeholder="Entrer ..." required>
                                                </div>
                                                <span id="endError" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="form-group">
                                                    <label>Date relance:</label>
                                                    <input type="date" class="form-control" 
                                                    id="date_relance" name="date_relance" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Choisir le client</label>
                                                <select class="form-control" name="id_client">
                                                    @php
                                                        $clients = DB::table('clients')->
                                                        where('id_statutclient', 1)
                                                        ->orderBy('nom', 'ASC')->get();
                                                    @endphp
                                                 
                                                    @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <label>Observation/Commentaire/Plus de détails</label>
                                            <textarea name="more" class="form-control" id="more">
                                        
                                            </textarea>
                                            </div>
                                        </div>

                                        
                                    <div class="row modal-footer justify-content-between">
                                        <button wire:click="close" type="button" class="btn btn-danger"
                                            data-dismiss="modal">Retour</button>
                                        <button type="submit" id="savebtn" class="btn btn-info float-right">Valider</button>
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
                    <br>
                    <a href="suivi_prospect" style="color:blue"><u>Rétablir<i class="fa fa-retweet" aria-hidden="true"></i></u></a> &emsp;&emsp; <label>Filtrer par:</label>
                    <div class="row">
                        <form action="filter_date_suivi_prospect"  class="row" method="post">
                            @csrf
                            Date du-au:<br>
                            <div class="col-xs-2">
                                <input type="date" class="form-control" required name="debut">
                            </div>
                            <div class="col-xs-2">
                                <input type="date" class="form-control" required name="fin">
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
                        @can("super_admin")
                            <form method="post" action="filter_user_suivi_prospect" class="row">
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
                        @endcan
                        </div>   

                        <div class="col-md-3 input-group input-group-sm">
                        <form method="post" action="filter_search_suivi_prospect" class="row">
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

                    <!--<div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" wire:model.live.debounce.250ms="search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                        </div>
                    </div>
                    </div>-->
    
                </div>
                <!-- /.card-header -->
              

                <div class="card-body table-responsive p-0">
                    <table id="example2" class="table table-bordered table-hover">
                
                    <thead>
                        <tr>
                            <th>Titre de l'évènement</th>
                            <th>Date de début</th>
                            <th>Client</th>
                            <th>Details</th>
                            <th>Date de relance</th>
                            <th>Mod/Supp</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($suivis as $suivi)
                        <tr class="align-middle">
                            <td>{{$suivi->title}}</td>
                            <td>
                                @php echo date('d/m/Y',strtotime($suivi->start)) ;
                                echo "à".date('H:i:s',strtotime($suivi->start));@endphp
                            </td>
                           
                            <td>
                                {{$suivi->nom}}
                            </td>
                            <td>
                                {{$suivi->more}}
                            </td>
                            <td>
                                
                                @if($suivi->date_relance != null)
                                    @php 
                                        $d = date("Y-m-d H:i:s");
                        
                                        //VOIR SI L'EVENEMENT EST DEPASSE
                                        if($suivi->end <= $d)
                                        {
                                            echo '<span class="bg-danger">Évènement dépassé</span>';
                                        }
                                        else
                                        {
                                            //PAS DEPASSE
                                            if($suivi->date_relance >= $d)
                                            {
                                                echo "<span class='bg-warning'>".
                                                date('d/m/Y',strtotime($suivi->date_relance))."</span>" ;
                                            }
                                            else
                                            {
                                                echo "<span class='bg-primary'>".
                                                date('d/m/Y',strtotime($suivi->date_relance))."</span>" ;
                                            }
                                           
                                        }
                                        
                                    @endphp
                                @else
                                @endif
                               
                            </td>
                            <td>
                                <div class="row">
                                    @can("edit")
                                    <div class="col-sm-6">
                                        <button class="btn btn-info" 
                                        data-toggle="modal" data-target="#edit{{$suivi->id}}" >
                                        <b><i class="fa fa-edit"></i></b></button>
                                        <div class="modal fade" id="edit{{$suivi->id}}"  
                                        role="dialog" aria-hidden="true" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modification</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!--begin::Form-->
                                                        <form method="post" action="updatesuiviprospect">
                                                            <!--begin::Body-->
                                                            @csrf
                                                            <input type="text" value="{{$suivi->id}}" style="display:none;" name="id">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                    <label>Action </label>
                                                                    <input type="text"  name="title" id="title" class="form-control" 
                                                                    maxlenght="150" placeholder="Entrer ..."  value="{{$suivi->title}}">
                                                                    <span id="titleError" class="text-danger"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                    <label>Date de l'évenement</label>
                                                                    <input type="datetime-local"  name="start"  value="{{$suivi->start}}"
                                                                    class="form-control" maxlenght="150" >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                    <label>Date-Heure de fin</label>
                                                                    <input type="datetime-local"  name="end"  id="end" 
                                                                    class="form-control"
                                                                    maxlenght="150" placeholder="Entrer ..." value="{{$suivi->end}}" >
                                                                    </div>
                                                                    <span id="endError" class="text-danger"></span>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Date relance:</label>
                                                                        <input type="date" class="form-control" 
                                                                        id="date_relance" name="date_relance" 
                                                                        value="{{$suivi->date_relance}}"/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label>Choisir le client</label>
                                                                    <select class="form-control" name="id_client">
                                                                        @php
                                                                            $clients = DB::table('clients')->orderBy('nom', 'ASC')->get();
                                                                        @endphp
                                                                        <option value="{{$suivi->id_client}}">{{$suivi->nom}}</option>
                                                                        @foreach($clients as $client)
                                                                            <option value="{{$client->id}}">{{$client->nom}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                <label>Observation/Commentaire/Plus de détails</label>
                                                                <textarea name="more" class="form-control" id="more">
                                                                    {{$suivi->more}}
                                                                </textarea>
                                                                </div>
                                                            </div>

                                                            
                                                        <div class="row modal-footer justify-content-between">
                                                            <button wire:click="close" type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Retour</button>
                                                            <button type="submit" id="savebtn" class="btn btn-info float-right">Valider</button>
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
                                    @can("delete")
                                    <div class="col-sm-6">
                                        <button class="btn btn-danger" 
                                        data-toggle="modal" data-target="#delete{{$suivi->id}}" >
                                        <b><i class="fa fa-trash"></i></b></button>
                                        <div class="modal fade" id="delete{{$suivi->id}}" role="dialog" aria-hidden="true" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!--begin::Form-->
                                                    <form method="post" action="deletesuivi">
                                                        <!--begin::Body-->
                                                        @csrf
                                                        <label style="text-align:center; color:red">Voulez vous vraiment supprimer ?</label>
                                                        <input type="text" class="form-control" value="{{$suivi->id}}" wire-model="id" 
                                                        name="id" id="{{$suivi->id}}" style="display:none;">

                                                        <!--end::Body-->
                                                        <!--begin::Footer delete($type->id)  wire:click="confirmDelete(' $type->nom_prenoms ', 
                                                        '$type->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
                                                        <div class=" row modal-footer justify-content-between" style="aling:center">
                                                        
                                                        <button type="button" wire:click="close" class="btn btn-danger btn-lg col-md-3" data-dismiss="modal">NON</button>
                                                
                                                        <button type="submit"  class="btn btn-success btn-lg col-md-3">OUI</button>
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
                    {{$suivis->links()}}
                </ul>
            </div>
          </div>
        </div>
        <!-- /.col -->
      
    </div>
    <!--end::Row-->
    
@endsection