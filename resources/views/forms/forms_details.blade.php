<!--<form method="post" action="addaserviceforcreate">-->

                                        <input type="text" value="{{$id}}" name="id_cotation" style="display: none;">
                                <div class="card-body">
                                    <div id="support1">
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>--Prestation:</label>
                                                        <input type="text" name="prest1" class="form-control" id="prest1" 
                                                        onkeyup="EnableFields('prest1', 'designation1', 'prix1', 'duree1', 'duree_type1')">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation1" class="form-control" id="designation1" 
                                                       disabled>

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
                                    </div>

                                     <div id="support2">
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>--Prestation:</label>
                                                        <input type="text" name="prest2" class="form-control" id="prest2" 
                                                        onkeyup="EnableFields('prest2', 'designation2', 'prix2', 'duree2', 'duree_type2')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation2" class="form-control" id="designation2"
                                                        disabled>

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

                                    </div>
                                    <div id="support3">
                        
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>--Prestation:</label>
                                                        <input type="text" name="prest3" class="form-control" id="prest3" 
                                                        onkeyup="EnableFields('prest3', 'designation3', 'prix3', 'duree3', 'duree_type3')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation3" class="form-control" id="designation3"
                                                       disabled>

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

                                    </div>
                                    <div id="support4">
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>--Prestation:</label>
                                                        <input type="text" name="prest4" class="form-control" id="prest4" 
                                                        onkeyup="EnableFields('prest4', 'designation4', 'prix4', 'duree4', 'duree_type4')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation4" class="form-control" id="designation4"
                                                       disabled>

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
                                                        class="form-control" placeholder="Entrez ..."  id='duree4' disabled>                                            </div>
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

                                    </div>
                                    <div id="support5">

                                        <div class="content" id="support">
                                             <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>--Prestation:</label>
                                                        <input type="text" name="prest5" class="form-control" id="prest3" 
                                                        onkeyup="EnableFields('prest5', 'designation5', 'prix5', 'duree5', 'duree_type5')">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation5" class="form-control" id="designation5"
                                                     disabled>

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
                                                        class="form-control" placeholder="Entrez ..."  id='duree5' disabled>                                            </div>
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
                                                    </div><button type="button" id="bt5" 
                                            class="btn btn-warning float-right" onclick="displayTheLine('support6','bt5')"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="support6" style="display:none;">
                                       
                                        <div class="content" id="support">
                                             <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>--Prestation:</label>
                                                        <input type="text" name="prest6" class="form-control" id="prest3" 
                                                        onkeyup="EnableFields('prest6', 'designation6', 'prix6', 'duree6', 'duree_type6')">
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
                                                        <input type="text" name="prest7" class="form-control" id="prest3" 
                                                        onkeyup="EnableFields('prest7', 'designation7', 'prix7', 'duree7', 'duree_type7')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation7" class="form-control" id="designation7"
                                                        onfocus="EnableFields('designation7', 'prix7', 'duree7', 'duree_type7')">

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
                                                class="btn btn-warning float-right" onclick="displayTheLine('support8','bt7')">
                                                <i class="fa fa-plus"></i></button>
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
                                                       <input type="text" name="prest8" class="form-control" id="prest8" 
                                                        onkeyup="EnableFields('prest8', 'designation8', 'prix8', 'duree8', 'duree_type8')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation8" class="form-control" id="designation8"
                                                        onfocus="EnableFields('designation8', 'prix8', 'duree8', 'duree_type8')">

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
                                                    class="btn btn-warning float-right" onclick="displayTheLine('support9','bt8')">
                                                    <i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="support9" style="display:none;">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- text input -->
                                                <div class="form-group">
                                                <label>--Prestation:</label>
                                                    <input type="text" name="prest9" class="form-control" id="prest9" 
                                                    onkeyup="EnableFields('prest9', 'designation9', 'prix9', 'duree9', 'duree_type9')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content" id="support">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation9" class="form-control" id="designation9"
                                                        onfocus="EnableFields('designation9', 'prix9', 'duree9', 'duree_type9')">

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
                                                        <input type="text" name="prest10" class="form-control" id="prest10" 
                                                        onkeyup="EnableFields('prest10', 'designation10', 'prix10', 'duree10', 'duree_type10')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <input type="text" name="prest0" class="form-control" id="designation10"
                                                        onfocus="EnableFields('prest10', 'prix10', 'duree10', 'duree_type10')">

                                                        </textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                    <label>Description:</label>
                                                        <textarea name="designation10" class="form-control" id="designation10"
                                                        onfocus="EnableFields('designation10', 'prix10', 'duree10', 'duree_type10')">

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
                                </div>
                                <!--<div class="card-footer">
                                  <button type="submit" id="go" class="btn btn-warning float-right">AJOUTER LES LIGNES</button> 
                                </div>-->
                            <!--</form>-->