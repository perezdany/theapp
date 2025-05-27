 <div class="row"><button type="button" id="bt5" 
                                    class="btn btn-warning float-right" 
                                    onclick="displayTheLine('support6','bt5')"><i class="fa fa-plus"></i></button></div>
                                    <div id="support6" style="display:none;">
                                       
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>--Prestation:</label>
                                                        <select name="prest6" class="form-control" id="prest6" 
                                                            onkeyup="EnableFields('prest6', 'peutmodif6', 
                                                            'designation6', 'prix6', 'duree6', 'duree_type6')">
                                                    
                                                            @php
                                                                $s = DB::table('services')->where('code','<>', 'MAT')->get();
                                                            @endphp
                                                            <option value="">--Choisir le Code--</option>
                                                            @foreach($s as $s)
                                                            <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    
                                                        <input type="text" name="peutmodif6" class="form-control" id="peutmodif6">
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation6" class="form-control" id="designation6"
                                                            disabled>
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
                                                        class="form-control" placeholder="Entrez ..."  id='duree6' disabled>                                            </div>
                                                </div>
                                                <div class="col-sm-4s">
                                                    <div class="form-group">
                                                    <label>Choisir:</label>
                                                    <select  class="form-control" name="duree_type6" 
                                                    id="duree_type6" disabled>
                                                        <option value="jours">Jours</option>
                                                        <option value="mois">Mois</option>
                                                        <option value="annees">Années</option>
                                                    </select>
                                                    </div><button type="button" id="bt6" 
                                            class="btn btn-warning float-right" onclick="displayTheLine('support7','bt6')"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div id="support7"  style="display:none;">
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                     <div class="form-group">
                                                        <label>--Prestation:</label>
                                                        <select name="prest7" class="form-control" id="prest7" 
                                                            onkeyup="EnableFields('prest7', 'peutmodif7', 
                                                            'designation7', 'prix7', 'duree7', 'duree_type7')">
                                                    
                                                            @php
                                                                $s = DB::table('services')->where('code','<>', 'MAT')->get();
                                                            @endphp
                                                            <option value="">--Choisir le Code--</option>
                                                            @foreach($s as $s)
                                                            <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    
                                                        <input type="text" name="peutmodif7" class="form-control" id="peutmodif7">
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation7" class="form-control" id="designation7"
                                                        disabled>
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
                                                        class="form-control" placeholder="Entrez ..."  id='duree7' disabled>                                            </div>
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
                                                    </div><button type="button" id="bt7" 
                                            class="btn btn-warning float-right" onclick="displayTheLine('support8','bt7')"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>   
                                        </div>

                                    </div>
                                    <div id="support8" style="display:none">

                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>--Prestation:</label>
                                                        <select name="prest8" class="form-control" id="prest8" 
                                                            onkeyup="EnableFields('prest8', 'peutmodif8', 
                                                            'designation8', 'prix8', 'duree8', 'duree_type8')">
                                                    
                                                            @php
                                                                $s = DB::table('services')->where('code','<>', 'MAT')->get();
                                                            @endphp
                                                            <option value="">--Choisir le Code--</option>
                                                            @foreach($s as $s)
                                                            <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    
                                                        <input type="text" name="peutmodif8" class="form-control" id="peutmodif8">
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation8" class="form-control" id="designation8"
                                                       disabled>

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
                                                        class="form-control" placeholder="Entrez ..."  id='duree8' disabled>                                            </div>
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
                                                    </div><button type="button" id="bt8" 
                                            class="btn btn-warning float-right" onclick="displayTheLine('support9','bt8')"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="support9" style="display:none;">
                                        <div class="content" id="support">
                                             <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                     <div class="form-group">
                                                        <label>--Prestation:</label>
                                                        <select name="prest9" class="form-control" id="prest9" 
                                                            onkeyup="EnableFields('prest9', 'peutmodif9', 
                                                            'designation9', 'prix9', 'duree9', 'duree_type9')">
                                                    
                                                            @php
                                                                $s = DB::table('services')->where('code','<>', 'MAT')->get();
                                                            @endphp
                                                            <option value="">--Choisir le Code--</option>
                                                            @foreach($s as $s)
                                                            <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    
                                                        <input type="text" name="peutmodif9" class="form-control" id="peutmodif9">
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation9" class="form-control" id="designation9"
                                                       disabled>

                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                    <label>Prix Hors taxe:</label>
                                                    <input type="number" name="prix9" class="form-control" 
                                                    placeholder="un nombre..." id='prix9' disabled>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Durée:</label>
                                                        <input type="number" name="duree9" min="0" value="0"
                                                        class="form-control" placeholder="Entrez ..."  id='duree9' disabled>                                            </div>
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
                                                    </div><button type="button" id="bt9" 
                                            class="btn btn-warning float-right" onclick="displayTheLine('support10','bt9')"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>  
                                        </div>

                                    </div>

                                    <div id="support10" style="display:none;">
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                     <div class="form-group">
                                                        <label>--Prestation:</label>
                                                        <select name="prest10" class="form-control" id="prest10" 
                                                            onkeyup="EnableFields('prest10', 'peutmodif10', 
                                                            'designation10', 'prix10', 'duree10', 'duree_type10')">
                                                    
                                                            @php
                                                                $s = DB::table('services')->where('code','<>', 'MAT')->get();
                                                            @endphp
                                                            <option value="">--Choisir le Code--</option>
                                                            @foreach($s as $s)
                                                            <option value={{$s->id}}>({{$s->code}})-{{$s->libele_service}}</option>
                                                            @endforeach
                                                            
                                                        </select>   
                                                    
                                                        <input type="text" name="peutmodif10" class="form-control" id="peutmodif10">
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation10" class="form-control" id="designation10"
                                                        disabled>

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
                                                        class="form-control" placeholder="Entrez ..."  id='duree10' disabled>                                            </div>
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
                                    </div>