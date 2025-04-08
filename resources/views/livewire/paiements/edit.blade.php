
@extends('layouts/app')
@php
    use App\Http\Controllers\PaiementController;

    $paiementcontroller = new PaiementController();

@endphp

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
        <div class="col-md-3"></div>
        <div class="col-md-6">
 
            <!-- general form elements disabled -->
            <div class="card card-info">
                <div class="card-header">
                <h3 class="card-title">Modification</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(isset($id_edit))
                        
                        @php
                            $retrive =  $paiementcontroller->GetById($id_edit)
                        @endphp
                        @foreach($retrive as $retrive)
                            <!-- form start -->
                            <form role="form" action="updatepaiement" method="post">
                                @csrf
                                <input type="text" value="{{$retrive->id}}" name="id_paiement" style="display:none;">
                                <input type="text" value="{{$retrive->montant_facture}}" name="montant" style="display:none;">
                                <input type="text" value="{{$retrive->id_facture}}" name="id_facture" style="display:none;">
                                <div class="form-group">
                                    <label>Entrer le montant du paiement</label>
                                    <input type="number" class="form-control input-lg" name="paiement" value="{{$retrive->paiement}}">
                                </div>

                                <div class="form-group">
                                    <label>Date du paiement</label>
                                    <input type="date" class="form-control input-lg" name="date_paiement" value="{{$retrive->date_paiement}}">
                                </div>

                                <div class="form-group">
                                    <label>Nom de la banque</label>
                                    <input type="text" class="form-control" name="banque" value="{{$retrive->banque}}">
                                </div>
                                <div class="form-group">
                                    <label>Date de virement</label>
                                    <input type="date" class="form-control" name="date_virement" value="{{$retrive->date_virement}}">
                                </div>
                                <div class="form-group">
                                    <label>Date de reception</label>
                                    <input type="date" class="form-control" name="date_reception" value="{{$retrive->date_reception}}">
                                </div>
                                <div class="form-group">
                                    <label>Numéro de virement</label>
                                    <input type="date" class="form-control" name="numero_virement" value="{{$retrive->numero_virement}}">
                                </div>
                                    
                                <div class="box-footer">
                                <button type="submit" class="btn btn-primary">VALIDER</button>
                                </div>
                            </form>

                        @endforeach
                        
                     	
                    @endif
                </div>
                   <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
        </div>
        <!--/.col (right) -->

        <div class="col-md-3"></div>
    </div>
    <!-- /.row -->

@endsection
    
   