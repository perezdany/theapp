
                                <input type="text" value="{{$id}}" name="id_cotation" style="display: none;">
                                <div class="card-body">
                                <div  id="support1">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article1" id="article1" onchange="EnableFields('article1', 'qte1', 'pu1')" >
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte1" id="qte1" min="1" value="1"
                                            class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu1" 
                                                class="form-control" id="pu1" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div c id="support2">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article2" id="article2" onchange="EnableFields('article2', 'qte2', 'pu2')" >
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte2" min="1" value="1"
                                            class="form-control" disabled id="qte2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu2" 
                                                class="form-control" disabled id="pu2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="support3">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article3" id="article3" onchange="EnableFields('article3', 'qte3', 'pu3')">
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte3" min="1" value="1"
                                            class="form-control" id="qte3" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu3" 
                                                class="form-control" id="pu3" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div  id="support4">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article4" id="article4" onchange="EnableFields('article4', 'qte4', 'pu4')">
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte4" min="1" value="1"
                                            class="form-control" id="qte4" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu4" 
                                                class="form-control" id="pu4" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="support5">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article5" id="article5" onchange="EnableFields('article5', 'qte5', 'pu5')">
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte5" min="1" value="1"
                                            class="form-control" id="qte5" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu5" 
                                                class="form-control" id="pu5" disabled>
                                            </div> <button type="button" id="bt5" 
                                            class="btn btn-warning float-right" onclick="displayTheLine('support6','bt5')">
                                            <i class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="col-sm-4">
                                           
                                               
                                          
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!--FAIRE UN INCLUDE POUR AJOUTER -->
                                @include("forms.lignes_articles")
                                </div>
                               <!--<div class="card-footer">
                                  <button type="submit" id="go" class="btn btn-warning float-right">AJOUTER LES LIGNES</button> 
                                </div>-->
                                 
                       
                            <hr>   