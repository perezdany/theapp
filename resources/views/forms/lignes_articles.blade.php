<div  id="support6" style="display:none;">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article6" id="article6" 
                                            onchange="EnableFields('article6', 'qte6', 'pu6')">
                                                @php
                                                    $t = DB::table('articles')->get();
                                                @endphp
                                                <option value="--">--Choisir--</option>
                                                @foreach($t as $t)
                                                    <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                @endforeach
                                                
                                            </select>   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte6" min="1" value="1"
                                            class="form-control" id="qte6" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu6" 
                                                class="form-control" id="pu6" disabled>
                                            </div> <button type="button" id="bt6" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support7','bt6')"><i class="fa fa-plus"></i></button>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div id="support7" style="display:none;">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article7" onchange="EnableFields('article7', 'qte7', 'pu7')">
                                                @php
                                                    $t = DB::table('articles')->get();
                                                @endphp
                                                <option value="--">--Choisir--</option>
                                                @foreach($t as $t)
                                                    <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                @endforeach
                                                
                                            </select>   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte7" min="1" value="1" id="qte7"
                                            class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu7" id="pu7"
                                                class="form-control" disabled>
                                            </div> <button type="button" id="bt7" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support8','bt7')"><i class="fa fa-plus"></i></button>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div  id="support8" style="display:none;">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article8" 
                                            onchange="EnableFields('article8', 'qte8', 'pu8')">
                                                @php
                                                    $t = DB::table('articles')->get();
                                                @endphp
                                                <option value="--">--Choisir--</option>
                                                @foreach($t as $t)
                                                    <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                @endforeach
                                                
                                            </select>   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte8" min="1" value="1" id="qte8"
                                            class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu8" id="pu8"
                                                class="form-control" disabled>
                                            </div> <button type="button" id="bt8" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support9','bt8')"><i class="fa fa-plus"></i></button>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div id="support9" style="display:none;">
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                            <label>Articles:</label>
                                            <select class="form-control" name="article9" onchange="EnableFields('article9', 'qte9', 'pu9')">
                                                @php
                                                    $t = DB::table('articles')->get();
                                                @endphp
                                                <option value="--">--Choisir--</option>
                                                @foreach($t as $t)
                                                    <option value={{$t->id}}>{{$t->designation}}/Prix:{{$t->prix_unitaire}}XOF</option>
                                                @endforeach
                                                
                                            </select>   
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label>Quantité:</label>
                                            <input type="number" name="qte9" min="1" value="1" id="qte9"
                                            class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Prix unitaire:</label>
                                                <input type="number" name="pu9"  id="pu9"
                                                class="form-control">
                                            <!--</div> <button type="button" id="bt9" 
                                            class="btn btn-warning float-right" 
                                            onclick="displayTheLine('support9','bt8')"><i class="fa fa-plus"></i></button>-->
                                        </div>
                                        
                                    </div>
                                </div>