@php
    use App\Http\Controllers\CotationController;

    $cotationcontroller = new CotationController();
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TheApp | Facture</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body onload="window.print();">
<div class="wrapper">
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
                        De
                        <address>
                            <strong>Nom entreprise, Inc.</strong><br>
                            Adresse Géo<br>
                            Adresse postale<br>
                            Phone: (804) 123-5432<br>
                            Email: info@example.com
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        A
                        <address>
                            <strong>{{$devis->nom}}</strong><br>
                            {{$devis->adresse}}<br>
                            <!--San Francisco, CA 94107<br>-->
                            {{$devis->telephone}}<br>
                            {{$devis->adresse_email}}
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        <b>Devis N° {{$devis->numero_devis}}</b><br>
                        <br>
                        <!--<b>Order ID:</b> 4F3S8J<br>-->
                        <!--<b>Payment Due:</b> 2/22/2014<br>-->
                        <b>Valide jusqu'au: </b>@php echo date('d/m/Y',strtotime($devis->date_validite));@endphp
                        <!--<b>Account:</b> 968-34567-->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                @endforeach
                @php
                    $devis = $cotationcontroller->GetLines($id_cotation);
                    $somme = 0;
                @endphp
                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>Service</th>
                        <th>Code</th>
                        <th>Durée(M./Jr./Sem)/Désignation</th>
                        <th>Qté</th>
                        <th>Prix (Unitaire)</th>
                        <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($devis as $devis)
                            @if($devis->service_id == 8)

                                @php
                                    //dump("i");
                                    $articles = $cotationcontroller->GetArticleLines($id_cotation);
                                @endphp  
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$devis->libele_service}}</td>
                                        <td>{{$devis->code}}</td>
                                        <td>{{$article->designation}}</td>
                                        <td>{{$article->quantite}}</td>
                                        <td>@php echo number_format($article->prix_unitaire, 2, ".", " ")."F CFA"; @endphp</td>
                                        <td>
                                            @php
                                                $total = $article->quantite * $article->prix_unitaire;
                                                echo number_format($total, 2, ".", " ")."F CFA";
                                                $somme = $somme + $total;
                                            @endphp
                                        </td>
                                    <tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>{{$devis->libele_service}}</td>
                                    <td>{{$devis->code}}</td>
                                    <td>{{$devis->duree_mois}}mois/{{$devis->duree_jours}}jours/{{$devis->duree_jours}}semaines</td>
                            
                                    <td>N/A</td>
                                    <td>@php echo number_format($devis->prix_ht, 2, ".", " ")."F CFA"; @endphp</td>
                                    <td>
                                    @php echo number_format($devis->prix_ht, 2, ".", " ")."F CFA"; @endphp
                              
                                    </td>
                                <tr>
                                @php
                                    //dump("oi");
                                    $somme = $somme + $devis->prix_ht;
                                @endphp
                            @endif 
                        @endforeach
                          
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <!--<div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                        plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                    </div>-->
                    <!-- /.col -->
                    <div class="col-6">
                    <p class="lead">Détails montant total</p>

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th style="width:50%">Sous-total:</th>
                            <td>@php echo number_format($somme, 2, ".", " ")."F CFA"; @endphp</td>
                        </tr>

                        @php
                            $tva = DB::table('taxes')->get();
                        @endphp
                        @foreach($tva as $tva)
                            @if($tva->active == 0)
                                <tr>
                                    <th>Livraison:</th>
                                    <td>A définir</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>@php echo number_format($somme, 2, ".", " ")."F CFA"; @endphp</td>
                                </tr>
                            @else
                                <tr>
                                <th>Tax (18%)</th>
                                <td>
                                    @php
                                        $m = $somme * (18/100);
                                        echo number_format($m, 2, ".", " ")."F CFA";
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <th>Livraison:</th>
                                <td>A définir</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>
                                    @php
                                        $l = $somme + $m;
                                        echo number_format($l, 2, ".", " ")."F CFA";
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

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimer/télécharger</a>
                    <!--<button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
                        Payment
                    </button>-->
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fa fa-file"></i> Créer une facture
                    </button>
                    </div>
                </div>
                </div>
                <!-- /.invoice -->
        
            
            @endif
           
        </div><!-- /.col -->
    </div><!-- /.row -->
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
