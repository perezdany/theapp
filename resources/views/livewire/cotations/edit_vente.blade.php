@php
    use App\Http\Controllers\CotationController;
    use App\Http\Controllers\ServiceController;

    $servicecontroller = new ServiceController();
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
        <div class="col-md-6">
        <!-- general form elements disabled -->
            
            @if(isset($id))
                <div class="row">
                    <div class="col-sm-3">
                        <form action="see_devis" method="post">
                            @csrf
                            <input type="text" value={{$id}} style="display:none" name="id_cotation">
                            <button class="btn btn-info">
                                <b><i class="fa fa-eye"></i>AFFICHER</b></button>
                        </form>
                        <!--<button class="btn btn-success" 
                        data-toggle="modal" data-target="#article{{$id}}" >
                            <b><i class="fa fa-plus"></i>ARTICLE</b></button>-->
                        <div class="modal fade" id="article{{$id}}"  wire:ignore.self  
                        role="dialog" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Ajouter un article</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <!--begin::Form-->
                                    <form method="post" action="addarticlefordevis">
                                        <!--begin::Body-->
                                        @csrf
                                    
                                        <input type="text" class="form-control" value="{{$id}}" 
                                        name="id_cotation" id="{{$id}}" style="display:none;">

                                        <div class="form-group">
                                        <label>Articles:</label>
                                        <select class="form-control" name="article">
                                            @php
                                                $t = DB::table('articles')->get();
                                            @endphp
                                            @foreach($t as $t)
                                                <option value={{$t->id}}>{{$t->designation}}</option>
                                            @endforeach
                                            
                                        </select>   
                                        </div>

                                        <div class="form-group">
                                        <label>Quantité:</label>
                                        <input type="number" name="qte" min="1" value="1"
                                        class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label>Prix unitaire:</label>
                                        <input type="number" name="pu" 
                                        class="form-control">
                                        </div>
                                        <div class="row modal-footer justify-content-between" style="aling:center">
                                        
                                        <button type="button" wire:click="close" class="btn btn-danger col-md-3" data-dismiss="modal">Fermer</button>
                                
                                        <button type="submit"  class="btn btn-success col-md-3">Ajouter</button>

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
                     <div class="col-sm-3"></div>
                      <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        
                        <a href="devis"><button class="btn btn-danger"><b><i class="fa fa-times"></i>RETOUR</b>
                        </button></a>
                      
                    </div>
                </div>
                @php
                    //dd($id);
                    $le_devis = $cotationcontroller->GetDevisArticle($id);
                @endphp
                @foreach($le_devis as $devis)
                    
                    <div class="card card-warning">
                        <div class="card-header">
                        
                        <h3 class="card-title">{{$devis->numero_devis}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="edit_devis_mat">
                                @csrf
                                <div class="content" id="support">
                                    <input type="text" value="{{$id}}" name="id_cotation" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Date de création</label>
                                            <input type="date" name="date_creation" class="form-control" value="{{$devis->date_creation}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <label>Numero du devis</label>
                                            <input type="text" name="numero_devis" class="form-control" value="{{$devis->numero_devis}}"  required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Valide jusqu'au:</label>
                                            <input type="date" name="date_validite" class="form-control" value="{{$devis->date_validite}}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <label>Choisir le client</label>
                                                <select class="form-control" required name="id_client">
                                                    @php
                                                        $clients = DB::table('clients')->get();
                                                    @endphp
                                                    <option value="{{$devis->id_client}}">{{$devis->nom}}</option>
                                                    @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @if($devis->valide == 0)
                                @php
                                    $les_articles = DB::table('cotation_article')
                                    ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                                    ->join('articles', 'cotation_article.article_id', 'articles.id')
                                    ->where('cotation_article.cotation_id', $devis->id)
                                    ->get(['cotation_article.*', 'articles.designation', ]);
                                    
                                    $i = 1;
                                
                                @endphp
                                    
                                @foreach($les_articles as $a)
                                        <input type="text" class="form-control" value="{{$a->id}}"  
                                    name="idd{{$i}}"  style="display:none;">
                                    <div class="row">
                                        <div class="col-sm-4">
                                    
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="@php echo 'article'.$i @endphp" id="@php echo 'article'.$i @endphp" >
                                                @php
                                                    $t = DB::table('articles')->get();
                                                @endphp
                                                <option value={{$a->article_id}}>{{$a->designation}}</option>
                                                @foreach($t as $t)
                                                    <option value={{$t->id}}>{{$t->designation}}</option>
                                                @endforeach
                                                
                                            </select>   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="@php echo 'qte'.$i @endphp" min="1" 
                                            class="form-control" id="@php echo 'qte'.$i @endphp" value="{{$a->quantite}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="@php echo 'pu'.$i @endphp" 
                                                class="form-control" id="@php echo 'pu'.$i @endphp" value="{{$a->pu}}">
                                            </div> 
                                        </div>
                                    
                                    </div>
                                    @php
                                        $i = $i+ 1;
                                    @endphp
                                @endforeach 
                             
                                @include('livewire.cotations.lines_edit_article')
                                @else
                                @endif
                                <div class="card-footer">
                                
                                @if($devis->valide == 0)
                                    <button type="submit" class="btn btn-info float-right">VALIDER</button>
                                @else
                                @endif
                                </div>
                            </form>
                            
                           
                           
                            <!-- /.table-responsive -->
                            <script type="text/javascript">
                                function displayLine()
                                {
                                    //alert('ici');
                                    //SCRIPT POUR AJOUTER DES LIGNES DE FACON MODULABLE.
                                    let choix = document.getElementById('selservice').value;
                                    let id_div = choix+choix;
                                    let id_prix = 'prix_ht'+choix;
                                    let duree = 'duree'+choix;
                                    let type_d = 'duree_type'+choix;
                                    document.getElementById(choix).setAttribute("checked", "checked");
                                    document.getElementById(id_prix).removeAttribute("disabled");
                                    document.getElementById(duree).removeAttribute("disabled");
                                    document.getElementById(type_d).removeAttribute("disabled");
                                    document.getElementById(id_div).removeAttribute("style");
                                    
                                
                                }

                                function hideLine()
                                {
                                    //alert('ici');
                                    //SCRIPT POUR AJOUTER DES LIGNES DE FACON MODULABLE.
                            
                                    let collection = document.getElementById("SUR");
                                    if (collection.checked) {}
                                    else{
                                        collection.removeAttribute("checked");
                                        document.getElementById('SURSUR').setAttribute("style", "display:none");
                                        
                                    }
                                    let sec = document.getElementById("SECURINC");
                                    if (sec.checked) {}
                                    else{
                                        sec.removeAttribute("checked");
                                        document.getElementById('SECURINCSECURINC').setAttribute("style", "display:none");}

                                    let am = document.getElementById("AM");
                                    if (am.checked) {}
                                    else{ 
                                        am.removeAttribute("checked");
                                        document.getElementById('AMAM').setAttribute("style", "display:none");}
                                    let form = document.getElementById("FORM");
                                    if (form.checked) {}
                                    else{
                                        form.removeAttribute("checked");
                                        document.getElementById('FORMFORM').setAttribute("style", "display:none");}
                                    let heb = document.getElementById("HEB");
                                    if (heb.checked) {}
                                    else{
                                        heb.removeAttribute("checked");
                                        document.getElementById('HEBHEB').setAttribute("style", "display:none");}
                                    let mat = document.getElementById("MAT");
                                    if (mat.checked) {}
                                    else{
                                        mat.removeAttribute("checked");
                                        document.getElementById('MATMAT').setAttribute("style", "display:none");}
                                    //console.log(collection);
                                    /*for (let i = 0; i < collection.length; i++) {
                                        //console.log(collection[i].getAttribute('checked'));
                                        //collection[i].setAttribute("style", "display:none") ;
                                        if (collection[i].getAttribute('checked') == "checked") {
                                        
                                        document.getElementById('SURSUR').setAttribute("style", "display:none");
                                        }
                                        else
                                        {

                                        }
                                    }*/
                    
                                }

                                function displayTheLine(id, id_bt)
                                {
                                    //alert($id);
                                    let bt = document.getElementById(id_bt);
                                    let support = document.getElementById(id);
                                    support.removeAttribute("style");
                                    bt.setAttribute("style", "display:none");
                                   
                                }

                                function EnableFields(sel, q, p)
                                {
                                    let article = document.getElementById(sel);
                                    
                                    quantite = document.getElementById(q);
                                    prix = document.getElementById(p);
                                    if(article.value != "--")
                                    {
                                       
                                        quantite.removeAttribute("disabled");
                                        quantite.setAttribute("enabled", "enabled");
                                        prix.removeAttribute("disabled");
                                        prix.setAttribute("enabled", "enabled");
                                    }
                                    else
                                    {  
                                        quantite.removeAttribute("enabled");
                                          quantite.setAttribute("disabled", "disabled");
                                        prix.removeAttribute("enabled");
                                      
                                        prix.setAttribute("disabled", "disabled");
                                    }

                                    
                                }


                            </script>
                        </div>
                        
                        <!-- /.card-body -->
                    </div> 
                @endforeach
                    
                
            @endif
            <!-- /.card -->
       
        </div>
        
        
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                        
                <h3 class="card-title">Articles ajoutés</h3>
            </div>
            <div class="card-body">
                @php
                    $total_ht = 0;
                    $les_articles = DB::table('cotation_article')
                    ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                    ->join('articles', 'cotation_article.article_id', 'articles.id')
                    ->where('cotation_article.cotation_id', $id)
                    ->get(['cotation_article.*', 'articles.designation', ]);
                @endphp
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Quantité</th>
                            <th>Prix</th>   
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($les_articles as $article)
                            
                                <tr>
                                    <td><b>{{$article->designation}}</b> </td>
                                    <td>{{$article->quantite}}</td>
                                    <td>
                                        @php
                                            $p = $article->pu * $article->quantite;
                                            $total_ht = $total_ht + $p;
                                            echo number_format($p, 2, ".", " ")."F CFA"; 
                                        @endphp
                                        
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-danger" 
                                        data-toggle="modal" data-target="#delete{{$article->id}}" >
                                        <b><i class="fa fa-trash"></i></b></button>
                                        <div class="modal fade" id="delete{{$article->id}}"  
                                        wire:ignore.self  role="dialog" aria-hidden="true" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h4 class="modal-title">ATTENTION <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!--begin::Form-->
                                                    <form method="post" action="supp2">
                                                        <!--begin::Body-->
                                                        @csrf
                                                        <label style="text-align:center; color:red">
                                                        Voulez vous vraiment supprimer cette ligne ?</label>
                                                        <input type="text" class="form-control" value="{{$article->id}}" wire-model="id" 
                                                        name="id" id="{{$article->id}}" style="display:none;">

                                                        <!--end::Body-->
                                                        <!--begin::Footer delete($type->id)  wire:click="confirmDelete(' $type->nom_prenoms ', '$type->id' )"data-toggle="modal" data-target="#delete(user->id)"-->
                                                        <div class=" row modal-footer justify-content-between" style="aling:center">
                                                        
                                                        <button type="button" wire:click="close" class="btn btn-danger btn-lg col-md-3" 
                                                        data-dismiss="modal">NON</button>
                                                
                                                        <button type="submit"  class="btn btn-success btn-lg col-md-3">OUi</button>
                                                                                                                
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
                                    <div clas="col-sm-6">
                                        <!--<button class="btn btn-primary" 
                                        data-toggle="modal" data-target="#edit{{$article->id}}" >
                                        <b><i class="fa fa-edit"></i></b></button>-->
                                        <div class="modal fade" id="edit{{$article->id}}"  
                                        wire:ignore.self  role="dialog" aria-hidden="true" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                <h4 class="modal-title">Modification <!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!--begin::Form-->
                                                    <form method="post" action="editarticleforcreating">
                                                        <!--begin::Body-->
                                                        @csrf
                                                            <input type="text" class="form-control" value="{{$id}}"
                                                            name="id_cotation" style="display:none;">
                                                        <input type="text" class="form-control" value="{{$article->id}}" 
                                                        name="id" id="{{$article->id}}" style="display:none;">
                                                            <div class="form-group">
                                                            <label>Articles:</label>
                                                            <select class="form-control" name="article">
                                                                @php
                                                                    $t = DB::table('articles')->get();
                                                                @endphp
                                                                @foreach($t as $t)
                                                                    <option value={{$t->id}}>{{$t->designation}}</option>
                                                                @endforeach
                                                                
                                                            </select>   
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Quantité:</label>
                                                            <input type="number" name="qte" min="1" value="{{$article->quantite}}"
                                                            class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                            <label>Prix unitaire:</label>
                                                            <input type="number" name="pu"  value="{{$article->pu}}"
                                                            class="form-control">
                                                            </div>
                                                        <!--end::Body-->
                                                        
                                                        <div class=" row modal-footer justify-content-between" style="aling:center">
                                                        
                                                        <button type="button" wire:click="close" class="btn btn-danger btn-lg col-md-3" 
                                                        data-dismiss="modal">FERMER</button>
                                                
                                                        <button type="submit"  class="btn btn-success btn-lg col-md-3">VALIDER</button>
                                                                                                                
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
                                    </div>
                                    </td>
                                </tr>
                            
                            @endforeach
                            <tr>
                                <th >Sous-total:</th>
                                <td colspan="2">@php echo number_format($total_ht, 2, ".", " ")."F CFA"; @endphp</td>
                            </tr>
                            @php
                                $tva = DB::table('taxes')->get();
                            @endphp
                            @foreach($tva as $tva)
                                @if($tva->active == 0)
                                    
                                    <tr>
                                        <th>Total:</th>
                                        <td colspan="2">
                                        @php 
                                            echo number_format($total_ht, 2, ".", " ")."F CFA"; 
                                            
                                        @endphp</td>
                                    </tr>
                                @else
                                
                                    @php
                                        $v = DB::table('cotations')->where('id', $id)->get(['date_creation']);
                                        foreach($v as $verif)
                                        {
                                            if($verif->date_creation >= $tva->date_activation)
                                            {
                                                echo' <tr><th>Tax (18%)</th>
                                                <td>';
                                                    
                                            
                                                $m = $total_ht * (18/100);
                                                echo number_format($m, 2, ".", " ")."F CFA</td> </tr>";
                                            }
                                            else
                                            {
                                                
                                            }
                                        }
                                        
                                    @endphp

                                
                                <tr>
                                    <th>Total:</th>
                                    <td colspan="2">
                                        @php
                                            $l = $total_ht + $m;
                                            echo number_format($l, 2, ".", " ")."F CFA";
                                            
                                        @endphp
                                    </td>
                                </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        
        </div>                
    </div>

   
    <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                            
                    <h3 class="card-title">Conditions de paiement</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="update_conditionv">
                        @csrf
                        <input type="text" value="{{$id}}" name="id_cotation" style="display: none;">
                        @php
                            $condition = DB::table('cotations')
                            ->join('conditions_paiements', 'cotations.id_condition', '=', 'conditions_paiements.id')
                            ->where('cotations.id', $id)
                            ->get(['cotations.id_condition', 'conditions_paiements.*']);
                        @endphp
                        <select class="form-control" name="condition">
                            @foreach($condition as $condition)
                                <option value="{{$condition->id_condition}}">{{$condition->libele}}</option>
                            @endforeach
                            @php
                                $g = DB::table('conditions_paiements')->get();
                            @endphp
                            @foreach($g as $g)
                                <option value="{{$g->id}}">{{$g->libele}}</option>
                            @endforeach
                        </select>
                        
                        <div class="card-footer">
                        
                            <button type="submit" class="btn btn-primary float-right">VALIDER</button>
                        </div>
                    </form>
                </div>
            </div>                
        </div>

@endsection
    