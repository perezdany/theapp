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
                                        <th>Désignation</th>
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
                                                                <form method="post" action="suppserv">
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
                                                                        <label>Désignation:</label>
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