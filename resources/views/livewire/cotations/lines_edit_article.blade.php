<div>
    <div class="row">
        <button type="button" id="bta5" 
            class="btn btn-warning float-right" onclick="displayTheLine('supporta6','bta5')">
        <i class="fa fa-plus"></i></button>
    </div>

    <div  id="supporta6" style="display:none;">
        
        <div class="row">
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article6" id="article6" 
                onchange="EnableFieldsA('article6', 'qte6', 'pu6')">
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
                </div> <button type="button" id="bta6" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta7','bta6')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>
    <div id="supporta7" style="display:none;">
        
        <div class="row">
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article7" onchange="EnableFieldsA('article7', 'qte7', 'pu7')">
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
                </div> <button type="button" id="bta7" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta8','bta7')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>
    <div  id="supporta8" style="display:none;">
        
        <div class="row">
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article8" 
                onchange="EnableFieldsA('article8', 'qte8', 'pu8')">
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
                </div> <button type="button" id="bta8" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta9','bta8')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>
    <div id="supporta9" style="display:none;">
        
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
            <div class="col-sm-4">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte9" min="1" value="1" id="qte9"
                class="form-control" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu9"  id="pu9"
                    class="form-control" disabled>
                </div> <button type="button" id="bta9" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta10','bta9')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>

    <div id="supporta10" style="display:none;">
        
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
            <div class="col-sm-4">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte10" min="1" value="1" id="qte10"
                class="form-control" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu10"  id="pu10"
                    class="form-control" disabled>
                </div> <button type="button" id="bta10" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta11','bta10')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>

    <div id="supporta11" style="display:none;">
        
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
            <div class="col-sm-4">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte11" min="1" value="1" id="qte11"
                class="form-control" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu11"  id="pu11"
                    class="form-control" disabled>
                </div> <button type="button" id="bta11" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta12','bta11')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>
    <div id="supporta12" style="display:none;">
        
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
            <div class="col-sm-4">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte12" min="1" value="1" id="qte12"
                class="form-control" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu12"  id="pu12"
                    class="form-control" disabled>
                <!--</div> <button type="button" id="bta9" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta9','bta8')"><i class="fa fa-plus"></i></button>-->
            </div>
            
        </div>
    </div>
</div>

