@php
    use App\Http\Controllers\CotationController;

    $cotationcontroller = new CotationController();
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
                @if(isset($id_cotation))
                    @php
                        $la_cotation = $cotationcontroller->GetById($id_cotation);
                    @endphp
                    @foreach($la_cotation as $la_cotation)
                        <div class="card-header">
                        <h3 class="card-title bg-warning">Modifier le devis N° {{$la_cotation->numero_devis}}</h3>
                        </div>
                        <div class="card-body">

                        <!-- /.card-header -->
                        <form method="post" action="edit_devis">
                            @csrf
                            <input type="text" value="{{$id_cotation}}" name="id" style="display:none;"/>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                    <label>Date de création</label>
                                    <input type="date" name="date_creation"  value="{{$la_cotation->date_creation}}" class="form-control" placeholder="Enter ..." required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Numero du devis</label>
                                    <input type="text" name="numero_devis"  value="{{$la_cotation->numero_devis}}" class="form-control" placeholder="Entrez ..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                    <label>Valide jusqu'au:</label>
                                    <input type="date" name="date_validite" value="{{$la_cotation->date_validite}}" class="form-control" placeholder="Enter ..." required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Choisir le client</label>
                                        <select class="form-control" required name="id_client">
                                            @php
                                                $clients = DB::table('clients')->get();
                                            @endphp
                                            <option value="{{$la_cotation->id_client}}">{{$la_cotation->nom}}</option>
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
                                            $verif = DB::table('cotation_service')->where('cotation_id', $la_cotation->id)
                                        ->where('service_id', $services->id)->count();
                                        @endphp
                                        @if($verif == 0)
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="{{$services->id}}" name="{{$services->code}}">
                                            <label class="form-check-label"><b>{{$services->libele_service}}</b></label>
                                            </div>
                                        @else
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="{{$services->id}}" name="{{$services->code}}" checked>
                                            <label class="form-check-label"><b>{{$services->libele_service}}</b></label>
                                            </div>
                                        @endif
                                        
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
                    @endforeach
                       
                @endif
            </div>
            <!-- /.card -->
       
        </div>
        <!--/.col (right) -->

        <div class="col-md-2"></div>
    </div>
    <!-- /.row -->

@endsection
    