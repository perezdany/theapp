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
                        
                       <!-- <form action="retour_delete" method="post">
                            @csrf   
                            <input type="text" value="{{$id}}" name="id" style="display:none;">
                            <button class="btn btn-danger"><b><i class="fa fa-times"></i>ANNULER</b></button>
                        </form>-->
                        
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
                            <b><u>Cliquer sur le bouton valider en dessous</u></b>
                            <form method="post" action="save_devis_vente">
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
                             
                                 Veuillez renseigner les détails
                                <!--LES FORMULAIRES DES LIGNES-->
                                @include("forms.btn_add_lines")

                                <div class="card-footer">
                                 <!--<form action="retour_delete" method="post">
                                -->  
                                    <!--<input type="text" value="{{$id}}" name="id" style="display:none;">-->
                                    <a href="retour_delete/{{$id}}" class="btn btn-danger">
                                    <i class="fa fa-times"></i>ANNULER
                                    </a>
                                <!--</form>-->
                                <button type="submit" class="btn btn-info float-right">VALIDER</button>
                                </div>
                            </form>
                            <hr>
                            
                           
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
                @include("forms.tableau_lignes_articles")
            </div>

        </div>                
    </div>
    <div class="row">                
        <!--/.col (left) -->
        <!-- right column -->

        <div class="col-md-8">
 
            
        </div>
        <!--/.col (right) -->
        <div class="col-md-4">
           
        </div>       
    </div>
    <!-- /.row -->

@endsection
    