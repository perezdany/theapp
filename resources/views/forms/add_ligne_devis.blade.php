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
       
        <div class="col-md-12">
 
            <!-- general form elements disabled -->
            <div class="card card-warning">
                <div class="card-header">
                <h3 class="card-title">Edition</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form method="post" action="add_line_devis">
                        <input type="text" value="{{$id_devis}}" name="id_cotation" style="display:none;">
                        @php
                            //CODE POUR AFFICHER LES FORMULAIRES EN FONCTION DES SERVICES
                            if(isset($id_devis))
                            {
                                $get_service = DB::table('cotation_service')
                                ->join('services', 'cotation_service.service_id', '=', 'services.id')
                                ->where('cotation_id', $id_devis)
                                ->get(['cotation_service.*', 'services.libele_service', 'services.code']);
                            }
                            //dd($get_service);
                        @endphp
                        @csrf
                        <div class="row">
                            @if(isset($get_service))
                                @foreach($get_service as $service)
                                    @if($service->service_id == 8)
                                        <div class="col-sm-6">
                                            
                                            <h3 class="card-title"><b><u><i>{{$service->libele_service}}</i></u></b></h3><br>
                                            <!-- text input -->
                                            <input type="text" value="{{$service->service_id}}" name="service{{$service->service_id}}" style="display:none;"> 
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article">
                                                @php
                                                    $t = DB::table('articles')->get();
                                                @endphp
                                                @foreach($t as $t)
                                                    <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                @endforeach
                                                
                                            </select>   
                                            </div>

                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte" min="1" value="1"
                                            class="form-control">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-sm-6">

                                            <h3 class="card-title"><b><u><i>{{$service->libele_service}}</i></u></b></h3><br>
                                            <!-- text input -->
                                            <input type="text" value="{{$service->service_id}}" name="service{{$service->service_id}}" style="display:none;"> 
                                            <div class="form-group">
                                            <label>Prix Hors taxe:</label>
                                            <input type="number" name="prix_ht{{$service->service_id}}" class="form-control" placeholder="Ex:1500000" required>
                                            </div>

                                            <div class="form-group">
                                            <label>Durée en mois:</label>
                                            <input type="number" name="mois{{$service->service_id}}" min="0" value="0"
                                            class="form-control" placeholder="Entrez ..." >
                                            </div>

                                            <div class="form-group">
                                            <label>Durée en jours:</label>
                                            <input type="number" name="jours{{$service->service_id}}" min="0" value="0" 
                                            class="form-control" placeholder="Entrez ..." >
                                            </div>
                                            <div class="form-group">
                                            <label>Durée en semaines:</label>
                                            <input type="number" name="semaines{{$service->service_id}}" min="0" value="0"
                                            class="form-control" placeholder="Entrez ..." >
                                            </div>
                                        </div>
                                    @endif
                               
                                @endforeach
                            @endif

                        </div>
                      
                             
                        <div class="card-footer">
                        <a href="devis"><button type="button" class="btn btn-danger">Retour</button></a>
                        <button type="submit" class="btn btn-info float-right">Valider</button>
                        </div>
                    </form>
                </div>
                   <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
        </div>
        <!--/.col (right) -->

    </div>
    <!-- /.row -->

@endsection
    