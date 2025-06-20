<!--<form method="post" action="addaserviceforcreate">-->
                                <div class="card-body">
                                    <div id="support1">
                                        
                                        <div class="row">
                                            <!-- text input -->
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest1" class="form-control" id="prest1" 
                                                    onchange="ChooseTheLine('contents1', 'contenta1', 'prest1', 'peutmodif1',
                                                     'designation1', 'prix1', 'duree1', 'duree_type1', 'article1', 'qte1', 'pu1')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>(({{$s->code}}))-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                <select id="cache1" style="display:none;">
                                        
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>
                                            <div class="form-group col-sm-8">
                                                <label>&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif1" class="form-control" id="peutmodif1" disabled>
                                            </div>
                                        
                                        </div>
                                        <div class="content" id="contents1" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation1" class="form-control" id="designation1" 
                                                       onfocus = "EnableFields('designation1', 'prix1', 'duree1', 'duree_type1')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix1" class="form-control" 
                                                    placeholder="un nombre..." id='prix1' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree1" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree1' disabled>                                            </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type1" 
                                                    id="duree_type1" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta1" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article1" id="article1" onchange="EnableFieldsA('article1', 'qte1', 'pu1')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte1" min="1" value="1" id="qte1"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu1"  id="pu1"
                                                        class="form-control" disabled>
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite1" id="disponibilite1">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div id="support2">
                                    
                                        <div class="row">
                                            <!-- text input -->
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest2" class="form-control" id="prest2" 
                                                     onchange="ChooseTheLine('contents2', 'contenta2', 'prest2', 'peutmodif2',
                                                     'designation2', 'prix2', 'duree2', 'duree_type2', 'article2', 'qte2', 'pu2')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                <select id="cache2" style="display:none;">
                                            
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   

                                            </div>
                                            <div class="form-group col-sm-8">
                                                <label>&nbsp;&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif2" class="form-control" id="peutmodif2" disabled>
                                            </div>
                                        </div>
                                        <div class="content" id="contents2" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation2" class="form-control" id="designation2" 
                                                         onfocus = "EnableFields('designation2', 'prix2', 'duree2', 'duree_type2')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix2" class="form-control" 
                                                    placeholder="un nombre..." id='prix2' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree2" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree2' disabled>                                            </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type2" 
                                                        id="duree_type2" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta2" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article2" id="article2" onchange="EnableFieldsA('article2', 'qte2', 'pu2')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte2" min="1" value="1" id="qte2"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu2"  id="pu2"
                                                        class="form-control" disabled>
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite2" id="disponibilite2">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="support3">
                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest3" class="form-control" id="prest3" 
                                                     onchange="ChooseTheLine('contents3', 'contenta3', 'prest3', 'peutmodif3',
                                                     'designation3', 'prix3', 'duree3', 'duree_type3', 'article3', 'qte3', 'pu3')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>  
                                                <select id="cache3" style="display:none;">
                                        
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>    
                                            </div>
                                            <div class="col-sm-8">
                                                <label>&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif3" class="form-control" id="peutmodif3" disabled>
                                            </div>
                                        </div>
                                        <div class="content" id="contents3" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation3" class="form-control" id="designation3" 
                                                      onfocus = "EnableFields('designation3', 'prix3', 'duree3', 'duree_type3')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix3" class="form-control" 
                                                    placeholder="un nombre..." id='prix3' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree3" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree3' disabled>                                            </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type3" 
                                                        id="duree_type3" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta3" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article3" id="article3" 
                                                    onchange="EnableFieldsA('article3', 'qte3', 'pu3')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte3" min="1" value="1" id="qte3"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu3"  id="pu3"
                                                        class="form-control" disabled>
                                                   </div> <!-- <button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite3" id="disponibilite3">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="support4">
                                      
                                        <div class="row">
                                                <!-- text input -->
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest4" class="form-control" id="prest4" 
                                                   onchange="ChooseTheLine('contents4', 'contenta4', 'prest4', 'peutmodif4',
                                                     'designation4', 'prix4', 'duree4', 'duree_type4', 'article4', 'qte4', 'pu4')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                <select id="cache4" style="display:none;">
                                        
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>
                                            <div class="col-sm-8">
                                                <label>&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif4" class="form-control" id="peutmodif4" disabled>
                                            </div>
                                        </div>
                                        <div class="content" id="contents4" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation4" class="form-control" id="designation4" 
                                                       onfocus = "EnableFields('designation4', 'prix4', 'duree4', 'duree_type4')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix4" class="form-control" 
                                                    placeholder="un nombre..." id='prix4' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree4" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree4' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type4" 
                                                        id="duree_type4" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta4" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article4" id="article4" onchange="EnableFieldsA('article4', 'qte4', 'pu4')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte4" min="1" value="1" id="qte4"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu4"  id="pu4"
                                                        class="form-control" disabled>
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite4" id="disponibilite4">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="support5">

                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest5" class="form-control" id="prest5" 
                                                   onchange="ChooseTheLine('contents5', 'contenta5', 'prest5', 'peutmodif5',
                                                     'designation5', 'prix5', 'duree5', 'duree_type5', 'article5', 'qte5', 'pu5')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                <select id="cache5" style="display:none;">
                                            
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                
                                            </div>
                                            <div class="col-sm-8">
                                                <label>&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif5" class="form-control" id="peutmodif5" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="content" id="contents5" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation5" class="form-control" id="designation5" 
                                                       onfocus = "EnableFields('designation5', 'prix5', 'duree5', 'duree_type5')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix5" class="form-control" 
                                                    placeholder="un nombre..." id='prix5' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree5" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree5' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type5" 
                                                        id="duree_type5" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta5" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article5" id="article5" onchange="EnableFieldsA('article5', 'qte5', 'pu5')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte5" min="1" value="1" id="qte5"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu5"  id="pu5"
                                                        class="form-control" disabled>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite5" id="disponibilite5">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="bt5" 
                                        class="btn btn-warning float-right" 
                                        onclick="displayTheLine('support6','bt5')"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div id="support6" style="display:none;">
                                       
                                        <div class="row">
                                            
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest6" class="form-control" id="prest6" 
                                                    onchange="ChooseTheLine('contents6', 'contenta6', 'prest6', 'peutmodif6',
                                                     'designation6', 'prix6', 'duree6', 'duree_type6', 'article6', 'qte6', 'pu6')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                <select id="cache6" style="display:none;">
                                        
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <label>&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif6" class="form-control" id="peutmodif6" disabled>
                                            </div>
                                        </div>
                                        <div class="content" id="contents6" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation6" class="form-control" id="designation6" 
                                                      onfocus = "EnableFields('designation6', 'prix6', 'duree6', 'duree_type6')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix6" class="form-control" 
                                                    placeholder="un nombre..." id='prix6' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree6" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree6' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type6" 
                                                        id="duree_type6" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="content" id="contenta6" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article6" id="article6" onchange="EnableFieldsA('article6', 'qte6', 'pu6')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte6" min="1" value="1" id="qte6"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu6"  id="pu6"
                                                        class="form-control" disabled>
                                                    </div>
                                                    
                                                </div>
                                                 <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite6" id="disponibilite6">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="bt6" 
                                        class="btn btn-warning float-right" 
                                        onclick="displayTheLine('support7','bt6')"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div id="support7"  style="display:none;">
                          
                                        <div class="row">                                              
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest7" class="form-control" id="prest7" 
                                                  onchange="ChooseTheLine('contents7', 'contenta7', 'prest7', 'peutmodif7',
                                                     'designation7', 'prix7', 'duree7', 'duree_type7', 'article7', 'qte7', 'pu7')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                    <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select> 
                                                <select id="cache7" style="display:none;">
                                        
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>     
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <label>&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif7" class="form-control" id="peutmodif7" disabled>
                                            </div>
                                        </div>
                                        <div class="content" id="contents7" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation7" class="form-control" id="designation7" 
                                                        onfocus = "EnableFields('designation7', 'prix7', 'duree7', 'duree_type7')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix7" class="form-control" 
                                                    placeholder="un nombre..." id='prix7' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree7" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree7' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type7" 
                                                        id="duree_type7" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta7" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article7" id="article7" onchange="EnableFieldsA('article7', 'qte7', 'pu7')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte7" min="1" value="1" id="qte7"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu7"  id="pu7"
                                                        class="form-control" disabled>
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite7" id="disponibilite7">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="bt7" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support8','bt7')"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div id="support8" style="display:none">
                                            <div class="row">
                                                
                                                <div class="form-group col-sm-4">
                                                    <label>--Prestation:</label>
                                                    <select name="prest8" class="form-control" id="prest8" 
                                                       onchange="ChooseTheLine('contents8', 'contenta8', 'prest8', 'peutmodif8',
                                                     'designation8', 'prix8', 'duree8', 'duree_type8', 'article8', 'qte8', 'pu8')">
                                                
                                                        @php
                                                            $s = DB::table('services')->get();
                                                        @endphp
                                                        <option value="">--Choisir le Code--</option>
                                                        @foreach($s as $s)
                                                        <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    <select id="cache8" style="display:none;">
                                                        @php
                                                            $cache = DB::table('services')->get();
                                                        @endphp
                                                    
                                                        @foreach($cache as $c)
                                                            <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                </div>
                                                <div class="col-sm-8 form-group">
                                                    <label>&nbsp;&nbsp;</label>
                                                    <input type="text" name="peutmodif8" class="form-control" id="peutmodif8" disabled>
                                                </div>
                                            </div>
                                        <div class="content" id="contents8" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation8" class="form-control" id="designation8" 
                                                     onfocus = "EnableFields('designation8', 'prix8', 'duree8', 'duree_type8')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix8" class="form-control" 
                                                    placeholder="un nombre..." id='prix8' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree8" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree8' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type8" 
                                                        id="duree_type8" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta8" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article8" id="article8" onchange="EnableFieldsA('article8', 'qte8', 'pu8')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte8" min="1" value="1" id="qte8"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu8"  id="pu8"
                                                        class="form-control" disabled>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite8" id="disponibilite8">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <button type="button" id="bt8" 
                                        class="btn btn-warning float-right" 
                                        onclick="displayTheLine('support9','bt8')"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div id="support9" style="display:none;">
                                        <div class="row">
                                            <!-- text input -->
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest9" class="form-control" id="prest9" 
                                                   onchange="ChooseTheLine('contents9', 'contenta9', 'prest9', 'peutmodif9',
                                                     'designation9', 'prix9', 'duree9', 'duree_type9', 'article9', 'qte9', 'pu9')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                        <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                                <select id="cache9" style="display:none;">
                                            
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                   
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>
                                            <div class="col-sm-8 form-group">
                                                <label>&nbsp;&nbsp;</label>
                                                <input type="text" name="peutmodif9" class="form-control" id="peutmodif9" disabled>
                                            </div>
                                        </div>
                                        <div class="content" id="contents9" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation9" class="form-control" id="designation9" 
                                                     onfocus = "EnableFields('designation9', 'prix9', 'duree9', 'duree_type9')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix8" class="form-control" 
                                                    placeholder="un nombre..." id='prix9' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree9" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree9' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type9" 
                                                        id="duree_type9" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta9" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article9" id="article9" onchange="EnableFieldsA('article9', 'qte9', 'pu9')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte9" min="1" value="1" id="qte9"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu9"  id="pu9"
                                                        class="form-control" disabled>
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite9" id="disponibilite9">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <button type="button" id="bt9" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support10','bt9')"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div id="support10" style="display:none;">
                                     
                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest10" class="form-control" id="prest10" 
                                                    onchange="ChooseTheLine('contents10', 'contenta10', 'prest10', 'peutmodif10',
                                                    'designation10', 'prix10', 'duree10', 'duree_type10', 'article10', 'qte10', 'pu10')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                        <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach     
                                                </select>   
                                                <select id="cache10" style="display:none;">
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>
                                            <div class="col-sm-8 form-group">  
                                                <label>&nbsp;&nbsp;</label> 
                                                <input type="text" name="peutmodif10" class="form-control" id="peutmodif10" disabled>
                                            </div>
                                        </div>   
                                        <div class="content" id="contents10" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation10" class="form-control" id="designation10" 
                                                     onfocus = "EnableFields('designation10', 'prix10', 'duree10', 'duree_type10')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix10" class="form-control" 
                                                    placeholder="un nombre..." id='prix10' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree10" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree10' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type10" 
                                                        id="duree_type10" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta10" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article10" id="article10" onchange="EnableFieldsA('article10', 'qte10', 'pu10')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte10" min="1" value="1" id="qte10"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu10"  id="pu10"
                                                        class="form-control" disabled>
                                                    </div>
                                                    <!--<button type="button" id="bt9" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support10','bt9')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite10" id="disponibilite10">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>
                                         <button type="button" id="bt10" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support11','bt10')"><i class="fa fa-plus"></i></button>
                                    </div>

                                    <div id="support11" style="display:none;">
                                     
                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest11" class="form-control" id="prest11" 
                                                    onchange="ChooseTheLine('contents11', 'contenta11', 'prest11', 'peutmodif11',
                                                    'designation11', 'prix11', 'duree11', 'duree_type11', 'article11', 'qte11', 'pu11')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                        <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach     
                                                </select>   
                                                <select id="cache11" style="display:none;">
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>
                                            <div class="col-sm-8 form-group">  
                                                <label>&nbsp;&nbsp;</label> 
                                                <input type="text" name="peutmodif11" class="form-control" id="peutmodif11" disabled>
                                            </div>
                                        </div>
                                          
                                        <div class="content" id="contents11" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation11" class="form-control" id="designation11" 
                                                     onfocus = "EnableFields('designation11', 'prix11', 'duree11', 'duree_type11')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix11" class="form-control" 
                                                    placeholder="un nombre..." id='prix11' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree11" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree11' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type11" 
                                                        id="duree_type11" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta11" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article11" id="article11" onchange="EnableFieldsA('article11', 'qte11', 'pu11')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte11" min="1" value="1" id="qte11"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu11"  id="pu11"
                                                        class="form-control" disabled>
                                                    </div>
                                                    <!---->
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite11" id="disponibilite11">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="bt11" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support12','bt11')"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div id="support12" style="display:none;">
                                     
                                        <div class="row">
                                            <div class="form-group col-sm-4">
                                                <label>--Prestation:</label>
                                                <select name="prest12" class="form-control" id="prest12" 
                                                    onchange="ChooseTheLine('contents12', 'contenta12', 'prest12', 'peutmodif12',
                                                    'designation12', 'prix12', 'duree12', 'duree_type12', 'article12', 'qte12', 'pu12')">
                                            
                                                    @php
                                                        $s = DB::table('services')->get();
                                                    @endphp
                                                    <option value="">--Choisir le Code--</option>
                                                    @foreach($s as $s)
                                                        <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                    @endforeach     
                                                </select>   
                                                <select id="cache12" style="display:none;">
                                                    @php
                                                        $cache = DB::table('services')->get();
                                                    @endphp
                                                
                                                    @foreach($cache as $c)
                                                        <option value={{$c->libele_service}}>{{$c->libele_service}}</option>
                                                    @endforeach
                                                    
                                                </select>   
                                            </div>
                                            <div class="col-sm-8 form-group">  
                                                <label>&nbsp;&nbsp;</label> 
                                                <input type="text" name="peutmodif12" class="form-control" id="peutmodif12" disabled>
                                            </div>
                                        </div>
                                          
                                        <div class="content" id="contents12" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation12" class="form-control" id="designation12" 
                                                     onfocus = "EnableFields('designation12', 'prix12', 'duree12', 'duree_type12')">

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix12" class="form-control" 
                                                    placeholder="un nombre..." id='prix12' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree12" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree12' disabled>  
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type12" 
                                                        id="duree_type12" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="contenta12" style="display:none;">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Articles:</label>
                                                    <select class="form-control" name="article12" id="article12" onchange="EnableFieldsA('article12', 'qte12', 'pu12')">
                                                        @php
                                                            $t = DB::table('articles')->get();
                                                        @endphp
                                                        <option value="--">--Choisir--</option>
                                                        @foreach($t as $t)
                                                            <option value={{$t->id}}>{{$t->designation}}</option>
                                                        @endforeach
                                                        
                                                    </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                    <label>Quantité:</label>
                                                    <input type="number" name="qte12" min="1" value="1" id="qte12"
                                                    class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Prix unitaire:</label>
                                                        <input type="number" name="pu12"  id="pu12"
                                                        class="form-control" disabled>
                                                    </div>
                                                    <!--<button type="button" id="bt9" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support10','bt9')"><i class="fa fa-plus"></i></button>-->
                                                </div>

                                                 <div class="col-sm-3">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Disponlibité:</label>
                                                        <select class="form-control" name="disponibilite12" id="disponibilite12">
                                                            @php
                                                                $dispo = DB::table('disponibilites')->get();
                                                            @endphp
                                                            
                                                            @foreach($dispo as $dispo)
                                                                <option value={{$dispo->id}}>{{$dispo->libele}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    </div> <!--<button type="button" id="bt1" 
                                                    class="btn btn-warning float-right" 
                                                    onclick="displayTheLine('support2','bt1')"><i class="fa fa-plus"></i></button>-->
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="card-footer">
                                  <button type="submit" id="go" class="btn btn-warning float-right">AJOUTER LES LIGNES</button> 
                                </div>-->
                            <!--</form>-->