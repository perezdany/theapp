
    <div class="row">
        <button type="button" id="bta5" 
            class="btn btn-warning float-right" onclick="displayTheLine('supporta6','bta5')">
        <i class="fa fa-plus"></i></button>
    </div>

    <div  id="supporta6" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input     onchange="EnableFieldsA('article6', 'qte6', 'pu6')"-->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article6" id="article6" >
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte6" min="1" value="1"
                class="form-control" id="qte6" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu6" 
                    class="form-control" id="pu6" >
                </div> <button type="button" id="bta6" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta7','bta6')"><i class="fa fa-plus"></i></button>
            </div>

        </div>
    </div>
    <div id="supporta7" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article7" id="article7">
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte7" min="1" value="1" id="qte7"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu7" id="pu7"
                    class="form-control" >
                </div> <button type="button" id="bta7" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta8','bta7')"><i class="fa fa-plus"></i></button>
            </div>
           
        </div>
    </div>
    <div  id="supporta8" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input onchange="EnableFieldsA('article8', 'qte8', 'pu8')"-->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article8" id="article8">
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte8" min="1" value="1" id="qte8"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu8" id="pu8"
                    class="form-control" >
                </div> 
                <button type="button" id="bta8" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta9','bta8')"><i class="fa fa-plus"></i></button>
            </div>
          
        </div>
    </div>
    <div id="supporta9" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input onchange="EnableFieldsA('article9', 'qte9', 'pu9')"-->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article9" id="article9" >
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte9" min="1" value="1" id="qte9"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu9"  id="pu9"
                    class="form-control" >
                </div> <button type="button" id="bta9" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta10','bta9')"><i class="fa fa-plus"></i></button>
            </div>
          
        </div>
    </div>

    <div id="supporta10" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article10" id="article10" >
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte10" min="1" value="1" id="qte10"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu10"  id="pu10"
                    class="form-control" >
                </div> 
                <button type="button" id="bta10" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta11','bta10')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>

    <div id="supporta11" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article11" id="article11" >
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte11" min="1" value="1" id="qte11"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu11"  id="pu11"
                    class="form-control" >
                </div> 
                <button type="button" id="bta11" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta12','bta11')"><i class="fa fa-plus"></i></button>
            </div>
             
        </div>
    </div>
    <div id="supporta12" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article12" id="article12">
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte12" min="1" value="1" id="qte12"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu12"  id="pu12"
                    class="form-control" >
                </div> <button type="button" id="bta12" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta13','bta12')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>

    <div id="supporta13" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article13" id="article13">
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte13" min="1" value="1" id="qte13"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu13"  id="pu13"
                    class="form-control" >
                </div> <button type="button" id="bta13" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta14','bta12')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>

    <div id="supporta14" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article14" id="article14">
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte14" min="1" value="1" id="qte14"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu14"  id="pu14"
                    class="form-control" >
                </div> <button type="button" id="bta14" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta15','bta14')"><i class="fa fa-plus"></i></button>
            </div>
            
        </div>
    </div>

     <div id="supporta15" style="display:none;">
        
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                <label>Articles:</label>
                <select class="form-control" name="article15" id="article15">
                    @php
                        $t = DB::table('articles')->get();
                    @endphp
                    <option value="">--Choisir--</option>
                    @foreach($t as $t)
                        <option value="{{$t->id}}">{{$t->designation}}</option>
                    @endforeach
                    
                </select>   
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                <label>Quantité:</label>
                <input type="number" name="qte15" min="1" value="1" id="qte15"
                class="form-control" >
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>Prix unitaire:</label>
                    <input type="number" name="pu15"  id="pu15"
                    class="form-control" >
                </div> <!--<button type="button" id="bta15" 
                class="btn btn-warning float-right" 
                onclick="displayTheLine('supporta15','bta14')"><i class="fa fa-plus"></i></button>-->
            </div>
            
        </div>
    </div>

