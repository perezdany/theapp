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
        <!--/.col (left) -->
        <!-- right column -->
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
                            data-toggle="modal" data-target="#serv{{$id}}" >
                                <b><i class="fa fa-plus">Détails</i></b></button>-->
                            <div class="modal fade" id="serv{{$id}}"  
                                wire:ignore.self  role="dialog" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Ajouter une ligne de détails</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--begin::Form-->
                                        <form method="post" action="addaserviceforcreate">
                                            <!--begin::Body-->
                                            @csrf
                                           
                                            <input type="text" class="form-control" value="{{$id}}" wire-model="id" 
                                            name="id_cotation" id="{{$id}}" style="display:none;">
                                            
                                            <div class="form-group">
                                                <label>Description de la prestation:</label>
                                                <textarea name="designation" class="form-control" required>

                                                </textarea>
                                          
                                            </div>

                                            <div class="form-group">
                                            <label>Prix Hors taxe:</label>
                                            <input type="number" name="prix" class="form-control" placeholder="un nombre..." required>
                                            </div>

                                            <div class="form-group">
                                            <label>Durée:</label>
                                            <input type="number" name="duree" min="0" value="0"
                                            class="form-control" placeholder="Entrez ..." >
                                            </div>

                                            <div class="form-group">
                                            <label>Choisir:</label>
                                            <select  class="form-control" name="duree_type" id="duree_type">
                                                <option value="jours">Jours</option>
                                                <option value="mois">Mois</option>
                                                <option value="annees">Années</option>
                                            </select>
                                            
                                            </div>
                                            <div class=" row modal-footer justify-content-between" style="aling:center">
                                            
                                            <button type="button" wire:click="close" class="btn btn-danger col-md-3" data-dismiss="modal">Fermer</button>
                                    
                                            <button type="submit"  class="btn btn-success col-md-3">Enregistrer</button>
                                                    
                                                
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
                        <a href="devis"><button class="btn btn-danger"><i class="fa fa-times"></i>RETOUR</button></a>
                    </div>
                </div>
                @php
                    //dd($id);
                    $le_devis = $cotationcontroller->GetDevis($id);
                    //dd($le_devis);
                @endphp
                @foreach($le_devis as $devis)
                    <div class="card card-warning">
                        <div class="card-header">
                        <h3 class="card-title">DEVIS N°{{$devis->numero_devis}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <b><u>Cliquer sur le bouton valider en dessous</u></b>
                            <form method="post" action="edit_devis">
                                @csrf
                                <input type="text" value="{{$id}}" name="id_cotation" style="display: none;">
                                <div class="content" id="support">
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
                                            <input type="text" name="numero_devis" class="form-control" value="{{$devis->numero_devis}}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Valide jusqu'au:</label>
                                            <input type="date" name="date_validite" class="form-control" value="{{$devis->date_validite}}" required>
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
                                @if($devis->valide == 0)
                                    <!--LES LIGNES DES DETAILS-->
                                    @if($devis->id_service == 8)

                                        @php
                                            $les_articles = DB::table('cotation_article')
                                            ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                                            ->join('articles', 'cotation_article.article_id', 'articles.id')
                                            ->where('cotation_article.cotation_id', $devis->id)
                                            ->get(['cotation_article.*', 'articles.designation', 'articles.prix_unitaire']);
                                            
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
                                                        <option value={{$a->article_id}}>{{$a->designation}}/Prix:{{$a->prix_unitaire}}XOF</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
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
                                        
                                    @else
                                        
                                        @php
                                            $i = 1;
                                            $les_articles = DB::table('details_cotations')
                                            ->join('services', 'details_cotations.id_service', '=', 'services.id')
                                            ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                                            ->where('details_cotations.cotation_id', $devis->id)
                                            ->get(['details_cotations.*', 'services.code', 'services.libele_service']);
                                            
                                        @endphp
                                        @foreach($les_articles as $a)
                                        <input type="text" class="form-control" value="{{$a->id}}"  
                                            name="idd{{$i}}"  style="display:none;">  
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label>--Prestation:</label>
                                            <!-- text input -->
                                                <!--<input type="text" name="@php echo 'prest'.$i @endphp" class="form-control"
                                                    id="@php echo 'prest'.$i @endphp" >-->

                                                <select class="form-control" name="@php echo 'prest'.$i @endphp" 
                                                    id="@php echo 'prest'.$i @endphp">
                                            
                                                    @php
                                                        $s = DB::table('services')->where('code','<>', 'MAT')->get();
                                                    @endphp
                                                    <option value={{$a->id_service}}>({{$a->code}})-{{$a->libele_service}}</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                    <label>&nbsp;&nbsp;&nbsp;</label>
                                                <input type="text" name="@php echo 'peutmodif'.$i @endphp" class="form-control"
                                                    id="@php echo 'peutmodif'.$i @endphp" value="{{$a->designation}}">
                                            </div>
                                        </div>     
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                                <div class="form-group">
                                                <label>Description de la prestation:</label>
                                                    <textarea name="@php echo 'designation'.$i @endphp" class="form-control" 
                                                    id="@php echo 'designation'.$i @endphp">
                                                    {{$a->descrpt}}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                <label>Prix Hors taxe:</label>
                                                <input type="number" name="@php echo 'prix'.$i @endphp" class="form-control" 
                                                placeholder="un nombre..." id="@php echo 'prix'.$i @endphp" value="{{$a->prix_ht}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                            
                                                <div class="form-group">
                                                    <label>Durée:</label>
                                                    <input type="number" name="@php echo 'duree'.$i @endphp" min="0" 
                                                    class="form-control" placeholder="Entrez ..."  
                                                    id="@php echo 'duree'.$i @endphp" value="{{$a->duree}}">                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                <label>Choisir:</label>
                                                <select  class="form-control" name="@php echo 'duree_type'.$i @endphp" 
                                                id="@php echo 'duree_type'.$i @endphp">
                                                <option value="{{$a->duree_type}}">{{$a->duree_type}}</option>
                                                    <option value="jours">Jours</option>
                                                    <option value="mois">Mois</option>
                                                    <option value="annees">Années</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                        @endforeach
                                        @include("livewire.cotations.lines_edit")
                                    @endif
                                @else
                                @endif
                          
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
                                        //alert(id);
                                        let bt = document.getElementById(id_bt);
                                        let support = document.getElementById(id);
                                        //salert(support);
                                        support.removeAttribute("style");
                                        bt.setAttribute("style", "display:none");
                                    
                                    }

                                    function EnableFields(sel, m, t, q, p, d)
                                    {
                                        
                                        let designation = document.getElementById(sel);
                                        
                                        prix= document.getElementById(q);
                                        duree = document.getElementById(p);
                                        type_d = document.getElementById(d);
                                        desi = document.getElementById(t);
                                        letexte = document.getElementById(m);
                                        //alert(type_d);
                                        if(designation.value != "")
                                        {
                                            //alert('ok');
                                            prix.removeAttribute("disabled");
                                            prix.setAttribute("enabled", "enabled");
                                            duree.removeAttribute("disabled");
                                            duree.setAttribute("enabled", "enabled");
                                            type_d.removeAttribute("disabled");
                                            type_d.setAttribute("enabled", "enabled");
                                            desi.removeAttribute("disabled");
                                            desi.setAttribute("enabled", "enabled");
                                            letexte.removeAttribute("disabled");
                                            letexte.setAttribute("enabled", "enabled");
                                        }
                                        else
                                        {  
                                            
                                            prix.removeAttribute("enabled");
                                            prix.setAttribute("disabled", "disabled");
                                            duree.removeAttribute("enabled");
                                            duree.setAttribute("disabled", "disabled");
                                            type_d.removeAttribute("enabled");
                                            type_d.setAttribute("disabled", "disabled");
                                            desi.removeAttribute("enabled");
                                            desi.setAttribute("disabled", "disabled");
                                            letexte.removeAttribute("enabled");
                                            letexte.setAttribute("disabled", "disabled");
                                        }
                                    }
                                </script>
                                        
                                <div class="card-footer">
                                    @if($devis->valide == 0)
                                        <button type="submit" class="btn btn-info float-right">VALIDER</button>
                                    @else
                                    @endif
                                </div>
                            </form>
                        </div>
                    
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endforeach
            @endif
       
        </div>
         <!--/.col (right) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> 
                    <h3 class="card-title">Détails</h3>      
                </div>
                <div class="card-body">
                    @php
                        $total_ht = 0;
                        $les_articles = DB::table('details_cotations')
                        ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                        ->where('details_cotations.cotation_id', $id)
                        ->get(['details_cotations.*',]);
                        //dd($les_articles);
                    @endphp
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Description de la prestation</th>
                                <th>Durée</th>
                                <th>Montant HT (F CFA)</th>  
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($les_articles as $article)
                                
                                    <tr>
                                        <td><b>{{$article->designation}}</b> </td>
                                        <td>{{$article->duree}} {{$article->duree_type}}</td>
                                        
                                        <td>
                                            @php
                                                $p = $article->prix_ht;
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
                                                        <form method="post" action="suppserv2">
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
                                        <div class="col-sm-6">
                                            <!--<button class="btn btn-primary" 
                                            data-toggle="modal" data-target="#edit{{$article->id}}" >
                                            <b><i class="fa fa-edit"></i></b></button>-->
                                            <div class="modal fade" id="edit{{$article->id}}"  
                                            wire:ignore.self  role="dialog" aria-hidden="true" >
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Modification<!--<ion-icon name="warning-outline" ></ion-icon>--></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!--begin::Form-->
                                                        <form method="post" action="editlinescreating">
                                                            <!--begin::Body-->
                                                            @csrf
                                                            <input type="text" class="form-control" value="{{$article->id}}" wire-model="id" 
                                                            name="id" id="{{$article->id}}" style="display:none;">
                                                            <input type="text" class="form-control" value="{{$id}}" wire-model="id" 
                                                            name="id_cotation" id="{{$id}}" style="display:none;">
                                                        
                                                            <div class="form-group">
                                                                <label>Description de la prestation:</label>
                                                                <textarea name="designation" class="form-control" >
                                                                    {{$article->designation}}
                                                                </textarea>
                                                        
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Prix Hors taxe:</label>
                                                            <input type="number" name="prix" class="form-control" 
                                                            value="{{$article->prix_ht}}">
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Durée:</label>
                                                            <input type="number" name="duree"
                                                            class="form-control" value="{{$article->duree}}">
                                                            </div>

                                                            <div class="form-group">
                                                            <label>Choisir:</label>
                                                            <select  class="form-control" name="duree_type" id="duree_type">
                                                                <option value="{{$article->duree_type}}">{{$article->duree_type}}</option>
                                                                <option value="jours">Jours</option>
                                                                <option value="mois">Mois</option>
                                                                <option value="annees">Années</option>
                                                            </select>
                                                            
                                                            </div>
                                                            <!--end::Body-->
                                                            
                                                            <div class="row modal-footer justify-content-between" style="aling:center">
                                                            
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
                    <!-- /.table-responsive -->
                </div>
                <hr>
                 
            </div>
            <!--TABLEAU REACP DES DETAILS AVEC LE MONTANT TOTAL EN BAS-->
            <div class="card">
                <div class="card-header">
                            
                    <h3 class="card-title">Conditions de paiement</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="update_condition">
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
                            <button type="submit" class="btn btn-info float-right">VALIDER</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>

    <div class="row">      
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
                
        </div>
    </div>
   
       

    <!-- /.row -->

@endsection
    