@extends('layouts/app')
@php
   
    use App\Http\Controllers\PaiementController;

    use App\Http\Controllers\FactureController;

    use App\Http\Controllers\Calculator;

    $calculator = new Calculator();

  
    $paiementcontroller = new PaiementController();

    $facturecontroller =  new FactureController();

@endphp

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        
        </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
    </div>
    <div class="row">
  
    <!-- left column -->

        <div class="col-md-6">
            @if(isset($id))
                @php
                    $my_own = $paiementcontroller->GetPaimentByIdFacture($id);
                @endphp

                <div class="card table-responsive">
                    <div class="card-header">
                        <h3 class="card-title">Paiements effectués</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead style="display:none;">
                            <tr>
                                <th>Montant</th>
                                <th>Date de paiement</th>
                                <th>Mode de paiement</th>
                            
                                <th>Numéro de virement/transfert...</th>
                                <th>Commentaire</th>
                        
                            </tr>
                            </thead>
                            <tbody style="display:none;">
                                @foreach($my_own as $my_own)
                                    <tr>
                                        <td>
                                            @php
                                                echo  number_format($my_own->paiement, 2, ".", " ")." XOF";
                                            @endphp
                                        </td>

                                        <td>{{$my_own->date_paiement}}</td>
                                        <td>{{$my_own->libele}}</td>
                                
                                        <td>{{$my_own->numero}}</td>
                                        <td>{{$my_own->commentaire}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Montant</th>
                                <th>Date de paiement</th>
                                <th>Mode de paiement</th>
                            
                                <th>Numéro de virement/transfert...</th>
                                <th>Commentaire</th>
                                <th>Modifier</th>
                                <th>Supp</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($my_own as $my_own)
                                    <tr>
                                        <td>
                                            @php
                                                echo  number_format($my_own->paiement, 2, ".", " ")." XOF";
                                            @endphp
                                        </td>

                                        <td>{{$my_own->date_paiement}}</td>
                                        <td>{{$my_own->libele}}</td>
                                
                                        <td>{{$my_own->numero}}</td>
                                        <td>{{$my_own->commentaire}}</td>
                                    
                                        @can("comptable")
                                            <td>
                                                <form action="edit_paiement_form" method="post">
                                                    @csrf
                                                    <input type="text" value={{$my_own->id_paiement}} style="display:none;" name="id_paiement">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                                </form>
                                            </td>
                                            @can("delete")
                                            
                                                <td>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="@php echo "#delete".$my_own->id.""; @endphp">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <div class="modal modal-danger fade" id="@php echo "delete".$my_own->id.""; @endphp">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                    
                                                            <h4 class="modal-title">Supprimer </h4>
                                                            </div>
                                                            <form action="delete_paiement" method="post">
                                                            <div class="modal-body">
                                                                <p>Voulez-vous supprimer le paiement du montant de {{$my_own->paiement}} XOF?</p>
                                                                @csrf
                                                                @csrf
                                                                <input type="text" value="{{$id}}" style="display:none;" name="id">
                                                                <input type="text" value="{{$my_own->id_paiement}}" style="display:none;" name="id_paiement">
                                                                <input type="text" value={{$my_own->id}} style="display:none;" name="id_details"><!--les details-->
                                                                <input type="text" value={{$my_own->id_facture}} style="display:none;" name="id_facture">
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn pull-left btn-danger" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn  btn-success">Supprimer</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                </td>
                                            @endcan
                                        @endcan

                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
              <!-- /.box -->
            @endif
           
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            @php
                $retrive = $facturecontroller->GetById($id);
                
                //dd($retrive);
            @endphp
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Effectuer un paiement</h3>
                </div>
                <div class="card-body">
                
                    @foreach($retrive as $retrive)
                        <!-- form start -->
                        <form role="form" action="do_paiement" method="post">
                            @csrf
                            <input type="text" value="{{$id}}" name="id_facture" style="display:none;">
                            <input type="text" value="{{$retrive->montant_facture}}" name="montant_facture" style="display:none;">
                        
                            <input type="text" value="{{$retrive->id}}" name="id_facture" style="display:none;">
                        
                            <div class="box-body">

                            
                                <div class="form-group">
                                    <label>Numéro facture</label>
                                    <input type="text" maxlength="30" readonly="true" class="form-control" name="numero_facture" value="{{$retrive->numero_facture}}">
                                </div>
                                <div class="form-group">
                                    <label>MONTANT RESTANT DE LA FACTURE:</label>
                                    <!--CODE POUR DETECTER LES TOUS LES PAIEMENTS DE CETTE FACTURE ET RETOURNER LE RESTE-->
                                    <p>
                                            @php
                                                $rest  = $calculator->RetrunMontantRest($retrive->id, $retrive->montant_facture);
                                            @endphp
                                            <input type="text" class="form-control"  value="{{$rest}}"  id="lereste" disabled>
                                        
                                    </p>
                                </div>
                            
                    
                                <div class="form-group">
                                    <label>Entrer le montant du paiement</label>
                                    <input type="number" class="form-control" name="paiement" required id="mt" onkeyup="VerifRest()">
                                </div>
                                <div class="form-group" id="message">
                                    
                                </div>

                                <div class="form-group">
                                    <label>Type de paiement</label>
                                    <select class="form-control" name="mode" id="m" >
                                        @php
                                            $t = DB::table('mode_reglements')->get();
                                        @endphp
                                        <option value="--">--Choisir--</option>
                                        @foreach($t as $t)
                                            <option value={{$t->id}}>{{$t->libele}}</option>
                                        @endforeach
                                        
                                    </select>   
                                   
                                </div>

                                <div class="form-group">
                                    <label>Date du paiement</label>
                                    <input type="date" class="form-control" 
                                    name="date_paiement" id="date_paiement"  required>
                                </div>

                                <div class="form-group">
                                    <label>Numéro de virement/ou de la transaction</label>
                                    <input type="text" class="form-control" name="numero_virement" id="numero_virement">
                                </div>
  
                                <div class="form-group">
                                    <label>Commentaire</label>
                                    <textarea class="form-control" name="commentaire" ></textarea>
                                </div>
                                
                            </div>
                            <!-- /.box-body -->
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

                                function EnableChamps()
                                {
                                    //alert('ici');
                                    let choix =  document.getElementById("m");
                                    //alert(choix.value);
                                    if(choix.value == "--choisir--")
                                    {
                                        //dd('ici');
                                        champ1 = document.getElementById("banque");
                                        champ2 = document.getElementById("date_reception");  
                                        champ3 = document.getElementById("date_virement");
                                        champ4 = document.getElementById("numero_virement");
                                        champ0 = document.getElementById("date_paiement");

                                        champ0.setAttribute("disabled", "disabled");
                                        champ1.setAttribute("disabled", "disabled");
                                        champ2.setAttribute("disabled", "disabled");
                                        champ3.setAttribute("disabled", "disabled");
                                        champ4.setAttribute("disabled", "disabled");
                                    }
                                    else
                                    {
                                        //alert('la')
                                        if(choix.value == 1)//espece
                                        {
                                            
                                            champ0 = document.getElementById("date_paiement");
                                            champ0.removeAttribute("disabled");

                                            champ1 = document.getElementById("banque");
                                            champ2 = document.getElementById("date_reception");  
                                            champ3 = document.getElementById("date_virement");
                                            champ4 = document.getElementById("numero_virement"); 

                                            champ1.setAttribute("disabled", "disabled");
                                            champ3.setAttribute("disabled", "disabled");
                                            champ4.setAttribute("disabled", "disabled");
                                            champ2.setAttribute("disabled", "disabled");   
                                        }
                                        if(choix.value == 2)//chèque
                                        {
                                            champ1 = document.getElementById("banque");
                                            champ2 = document.getElementById("date_reception");  
                                            champ3 = document.getElementById("date_virement");
                                            champ4 = document.getElementById("numero_virement");   
                                            champ0 = document.getElementById("date_paiement");
                                            champ0.removeAttribute("disabled");

                                            champ3.setAttribute("disabled", "disabled");
                                            champ4.setAttribute("disabled", "disabled");
                                            champ1.removeAttribute("disabled");
                                            champ2.removeAttribute("disabled");
                                        }

                                        if(choix.value == 3)//virement
                                        {
                                            
                                            champ3 = document.getElementById("date_virement");
                                            champ4 = document.getElementById("numero_virement");    
                                            champ3.removeAttribute("disabled");
                                            champ4.removeAttribute("disabled");

                                            champ0 = document.getElementById("date_paiement");
                                            champ0.removeAttribute("disabled");
                                            champ1 = document.getElementById("banque");
                                            champ2 = document.getElementById("date_reception");  
                                            champ1.setAttribute("disabled", "disabled");
                                            champ2.setAttribute("disabled", "disabled"); 
                                        }
                                    }
                                    
                                }
                            </script>
                            <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="bt" disabled="disabled">VALIDER</button>
                            </div>
                           
                        </form>

                    @endforeach
                </div>
            </div>		
        </div>
        
    </div>
    <!-- Main row -->  
    <div class="row">
       
    <!-- left column -->
     
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            @if(isset($id_edit))
                    <div class="card card-info">
                    <div class="card-header with-border">
                        <b><h3 class="box-title">Paiements </h3><br>
                        (*)champ obligatoire</b>
                    </div>
                    @php
                    $retrive =  $paiementcontroller->GetById($id_edit)
                    
                    
                    @endphp
                    @foreach($retrive as $retrive)
                        <!-- form start -->
                        <form role="form" action="edit_paiement" method="post">
                            @csrf
                            <input type="text" value="{{$retrive->id_prestation}}" name="id_prestation" style="display:none;">
                            <input type="text" value="{{$retrive->montant}}" name="montant" style="display:none;">
                            <input type="text" value="{{$retrive->id_contrat}}" name="id_contrat" style="display:none;">
                            <input type="text" value="{{$retrive->id}}" name="id_paiement" style="display:none;">
                            <input type="text" value="{{$retrive->id_facture}}" name="id_facture" style="display:none;">
                        
                            <div class="card-body">

                                
                                <div class="form-group">
                                    <label>MONTANT RESTANT:</label>
                                    <p><h3>
                                            @php
                                                echo  number_format($retrive->reste_a_payer, 2, ".", " ")." XOF";
                                            @endphp
                                        </h3>
                                    </p>
                                </div>
                              
                                <div class="form-group">
                                    <label>Entrer le montant du paiement</label>
                                    <input type="number" class="form-control input-lg" required name="paiement" value="{{$retrive->paiement}}">
                                </div>

                                <div class="form-group">
                                    <label>Date du paiement</label>
                                    <input type="date" class="form-control input-lg" required name="date_paiement" value="{{$retrive->date_paiement}}">
                                </div>
                                
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                            <button type="submit" class="btn btn-primary">VALIDER</button>
                            </div>
                        </form>

                    @endforeach
                
                </div>		
            @endif
            
        </div>
        
    </div>
    <!-- Main row -->  

@endsection
     
    
   