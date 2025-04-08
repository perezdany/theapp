@php

@endphp
@extends('layouts.app')
<!--.form-control-border.border-width-2-->

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">                
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-2"></div>
        <div class="col-md-8">
 
            <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                <h3 class="card-title">Créer un devis</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="add_devis">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                <label>Date de création</label>
                                <input type="date" name="date_creation" class="form-control" placeholder="Enter ..." required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Numero du devis</label>
                                <input type="text" name="numero_devis" class="form-control" placeholder="Entrez ..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                <label>Valide jusqu'au:</label>
                                <input type="date" name="date_validite" class="form-control" placeholder="Enter ..." required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Choisir le client</label>
                                    <select class="form-control" required name="id_client">
                                        @php
                                            $clients = DB::table('clients')->get();
                                        @endphp
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
                                @php
                                    $services = DB::table('services')->get();
                                @endphp
                                @foreach($services as $services)
                                    @php
                                    /*$roles_u = DB::table('cotation_service')->where('i', $user->id)
                                    ->where('role_id', $services->id)->count();*/
                                    @endphp
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        value="{{$services->id}}" name="{{$services->code}}">
                                    <label class="form-check-label"><b>{{$services->libele_service}}</b></label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                             
                        <div class="card-footer">
                        <a href="devis"><span class="btn btn-danger">Retour</span></a>
                        <button type="submit" class="btn btn-info float-right">Valider</button>
                        </div>
                    </form>
                </div>
                   <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
        </div>
        <!--/.col (right) -->

        <div class="col-md-2"></div>
    </div>
    <!-- /.row -->

@endsection
    