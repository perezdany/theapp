@php
    use App\Http\Controllers\CotationController;

    $cotationcontroller = new CotationController();
@endphp
@extends('layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            
        </div><!-- /.container-fluid -->
    </section>

    <div class="row">
        <div class="col-12">
            @if(isset($id_cotation))
                @php
                    $devis = $cotationcontroller->GetLinesinfoCustomer($id_cotation);
                    $somme = 0;
                @endphp
                @foreach($devis as $devis)
                    <div class="row">
                        <div class="col-md-2">
                        @php
                            $tva = DB::table('taxes')->get();
                        @endphp
                        @foreach($tva as $tva)
                            @if($tva->active == 0)
                                <form action="manage_taxe" method="post">
                                    @csrf
                                    <input type="text" value={{$id_cotation}} style="display:none" name="id_cotation">
                                    <button class="btn btn-danger" type="submit">Activer la TVA</button>
                                </form>
                            @else
                                <form action="manage_taxe" method="post">
                                    @csrf
                                    <input type="text" value={{$id_cotation}} style="display:none" name="id_cotation">
                                    <button class="btn btn-warning" type="submit">Désactiver la TVA</button>
                                </form>
                            @endif
                        @endforeach
                        </div>
                        <div class="col-md-2">
                           
                            
                        </div>
                    </div>
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                        <h4>
                            <i class="fa fa-globe"></i>{{config('app.name')}} <!--AdminLTE, Inc.-->
                            <small class="float-right">
                                @php echo date('d/m/Y',strtotime($devis->date_creation));@endphp
                            </small>
                        </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <!--De
                            <address>
                                <strong>Nom entreprise, Inc.</strong><br>
                                Adresse Géo<br>
                                Adresse postale<br>
                                Phone: (804) 123-5432<br>
                                Email: info@example.com
                            </address>-->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col" style="border:solid 3px;">
                            <address>
                                <strong>{{$devis->nom}}</strong><br>
                                {{$devis->adresse}}<br>
                                <!--San Francisco, CA 94107<br>-->
                                {{$devis->telephone}}<br>
                                {{$devis->adresse_email}}
                            </address>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <b>Devis N° {{$devis->numero_devis}}</b><br>
                            <!--<b>Order ID:</b> 4F3S8J<br>-->
                            <!--<b>Payment Due:</b> 2/22/2014<br>-->
                            <b>Dossier suivi par:</b> {{$devis->nom_prenoms}}<br><br>
                            <!--<b>A régler avant le : </b>-->
                            @php //echo date('d/m/Y',strtotime($facture->date_reglement));
                            @endphp
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                       
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                       
                        </div>
                        <!-- /.col -->
                    </div><br>
                @endforeach
                @php
                   
                    $somme = 0;
                    $compter = DB::table('details_cotations')->where('cotation_id', $id_cotation)
                    ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                    ->join('services', 'cotations.id_service', '=', 'services.id')
                    ->join('clients', 'cotations.id_client', '=', 'clients.id')
                    ->count();
                    $i = 0;
                    //dd($devis->id); 
                    
                    //dd($devis);
                @endphp
                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        @if($compter  == 0)<!--Y A PAS D'ID DE DEVIS-->
                            @php
                                $devis = $cotationcontroller->GetArticleLines($id_cotation);
                            @endphp
                            <thead>
                                <tr style="background-color:#76d7c4">
                                <th>Code</th>
                                <th>Désignation</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>Qté</th>
                                <th>Prix (Unitaire)</th>
                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($devis as $devis)
                                    @php
                                        $articles = $cotationcontroller->GetArticleLines($id_cotation);
                                    @endphp  
                                    <tr style="background-color:#e8f8f5 ">
                                        @if($i == 0)
                                            
                                            <td>{{$devis->code}}</td>
                                        @else
                                            <td></td>
                                        @endif   
                                        <td>{{$devis->designation}}</td>
                                        <td>{{$devis->description_article}}</td>
                                        <td>N/A</td>
                                        <td>{{$devis->quantite}}</td>
                                        <td>@php echo number_format($devis->pu, 2, ".", " ")."F CFA"; @endphp</td>
                                        <td>
                                            @php
                                                $total = $devis->quantite * $devis->pu;
                                                echo number_format($total, 2, ".", " ")."F CFA";
                                                $somme = $somme + $total;
                                            @endphp
                                        </td>
                                        @php
                                            $i = $i+1;
                                        @endphp
                                    <tr>    
                                @if($devis->code == "MAT")


                                    @foreach($articles as $article)
                                    
                                    @endforeach
                                @else
                                 
                                @endif 
                            @endforeach  
                            </tbody>                  
                        @else
                            <thead>
                                <tr style="background-color:#76d7c4">
                                <th>Code</th>
                                <th>Prestation</th>
                                <th>Description</th>
                                
                                <th>Durée</th>
                                <th>Qté</th>
                                <th>Prix (Unitaire)</th>
                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $devis = $cotationcontroller->GetLines($id_cotation);
                            @endphp
                            @foreach($devis as $devis)
                                <tr style="background-color:#e8f8f5 ">
                                    @if($i == 0)
                                        <td syle="border:0px;">{{$devis->code}}</td>
                                    @else
                                        <td syle="border:0px;"></td>
                                    @endif   
                                    <td><b>{{$devis->designation}}</b></td>
                                    <td>{{$devis->descrpt}}</td>
                                    <td>{{$devis->duree}} {{$devis->duree_type}}</td>
                            
                                    <td>N/A</td>
                                    <td>@php echo number_format($devis->prix_ht, 2, ".", " ")."F CFA"; @endphp</td>
                                    <td>
                                    @php echo number_format(($devis->prix_ht), 2, ".", " ")."F CFA"; @endphp
                            
                                    </td>
                                <tr>
                                @php
                                    //dump("oi");
                                    $somme = $somme + ($devis->prix_ht);
                                    $i = $i+1;
                                @endphp
                            @endforeach               
                            </tbody>
                        @endif

                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                    <!-- <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                        plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>-->
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                     <!--<p class="lead">Détails montant total</p>-->

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th style="width:50%; background-color:#969696">Sous-total:</th>
                            <td>@php echo number_format($somme, 2, ".", " ")."F CFA"; @endphp</td>
                        </tr>

                        @php
                            $tva = DB::table('taxes')->get();
                        @endphp
                        @foreach($tva as $tva)
                            @if($tva->active == 0)
                               <tr><th style="background-color:#969696">Tax (18%)</th>
                                    <td> 0 F CFA</td>
                                </tr>
                                <tr >
                                    <th style="background-color:#969696">Total:</th>
                                    <td>
                                    @php 
                                        echo number_format($somme, 2, ".", " ")."F CFA"; 
                                        $pour_facture = $somme;
                                    @endphp</td>
                                </tr>
                            @else
                               
                                @php
                                    $v = DB::table('cotations')->where('id', $id_cotation)->get(['date_creation']);
                                    foreach($v as $verif)
                                    {
                                        if($verif->date_creation >= $tva->date_activation)
                                        {
                                            echo' <tr><th style="background-color:#969696">Tax (18%)</th>
                                            <td>';
                                            $m = $somme * (18/100);
                                            echo number_format($m, 2, ".", " ")."F CFA</td> </tr>";
                                        }
                                        else
                                        {
                                            $m = 0;
                                            //echo number_format($somme, 2, ".", " ")."F CFA"; 
                                            $pour_facture = $somme;
                                        }
                                    } 
                                @endphp

                                <tr>
                                    <th style="background-color:#969696">Total:</th>
                                    <td>
                                        @php
                                            $l = $somme + $m;
                                            echo number_format($l, 2, ".", " ")."F CFA";
                                            $pour_facture = $l;
                                        @endphp
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                      
                        
                        </table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <u>Conditions de paiement</u> :<br>
                <i style="color:red">100% à la livraison</i><br><br><br>
       

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <div class="col-md-12">
                        <form action="print_devis" method="post" target="blank">
                            @csrf
                            <input style="display:none;" value="{{$id_cotation}}" name="id_cotation">
                            <button target="blank" class="btn btn-default float-left"><i class="fa fa-print"></i> Imprimer/télécharger</button>

                        </form>
                        </div>
                        <div class="col-md-12">
                        @php
                            $voir_valider = DB::table('cotations')->where('id', $id_cotation)->get();
                        @endphp
                        @foreach($voir_valider as $voir_valider)
                            @if($voir_valider->valide == 0)
                                 <form action="gocreateinvoice" method="post">
                                    @csrf
                                    <input type="text" style="display:none;" value="{{$id_cotation}}" name="id_cotation">
                                    <input type="text" style="display:none;" value="{{$pour_facture}}" name="montant_facture">
                                    <button type="submit" class="btn btn-primary float-right">
                                    <i class="fa fa-file"></i> Créer une facture
                                    </button>
                                </form>
                            @else
                                <form action="print_invoice" method="post" target="blank">
                                    @csrf
                                    <input type="text" style="display:none;" value="{{$id_cotation}}" name="id_cotation">
                                    <button target="blank" class="btn btn-success float-right"><i class="fa fa-print"></i> Imprimer la facture</button>

                                </form>
                            @endif
                        @endforeach
                       
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.invoice -->
        
            
            @endif
           
        </div><!-- /.col -->
    </div><!-- /.row -->
       

@endsection