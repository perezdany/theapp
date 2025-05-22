
@extends('layouts/app')
@php
    use App\Http\Controllers\PaiementController;

    $paiementcontroller = new PaiementController();

    use App\Http\Controllers\Calculator;

    $calculator = new Calculator();

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
                                <input type="text" value="{{$retrive->id_paiement}}" name="id_paiement" style="display:none;">
                                <input type="text" value="{{$retrive->montant_facture}}" name="montant" style="display:none;">
                                <input type="text" value="{{$retrive->id_facture}}" name="id_facture" style="display:none;">
                                <input type="text" value="{{$retrive->id}}" name="id_details" style="display:none;">
                                @php
                                    $rest  = $calculator->RetrunMontantRest($retrive->id_paiement, $retrive->montant_facture);
                                @endphp
                                <input type="text" class="form-control"  value="{{$rest}}"  id="lereste" disabled style="display:none;">
                                <div class="form-group">
                                    <label>Montant du paiement</label>
                                    <input type="number" class="form-control input-lg" name="paiement" value="{{$retrive->paiement}}"
                                    id="mt" onkeyup="VerifRest()">
                                </div>
                                <div class="form-group" id="message">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Date du paiement/Virement/reception du chèque</label>
                                    <input type="date" class="form-control input-lg" name="date_paiement" value="{{$retrive->date_paiement}}">
                                </div>
                                <div class="form-group">
                                    <label>Numéro de virement</label>
                                    <input type="text" class="form-control" name="numero_virement" value="{{$retrive->numero}}">
                                </div>
                                
                                <div class="box-footer">
                                <button type="submit" class="btn btn-primary" id="bt">VALIDER</button>
                                </div>
                            </form>

                        @endforeach
                        
                     	
                    @endif

                    <script>
                        function VerifRest() {
                        
                            /* ce script permet de vérifier si le montant saisi est trop élevé et l'obliger a saisir un montant plus bas*/
                            var val = document.getElementById("lereste").value;
                            var val2 = document.getElementById("mt").value;

                            var button = document.getElementById("bt")

                            var diff = val - val2;
                            //alert(diff)

                            if((diff < 0))
                            {  
                            
                                var theText = "<p style='color:red'>MONTANT SUPERIEUR AU RESTE !.</p>";
                                document.getElementById("message").innerHTML= theText;
                                button.setAttribute("disabled", "true");
                                
                            }
                            else
                            {
                            button.removeAttribute("disabled");
                            var theText = "<p style='color:red'></p>";
                                document.getElementById("message").innerHTML= theText;
                            
                            }
                        
                        }

                        
                    </script>
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
    
   