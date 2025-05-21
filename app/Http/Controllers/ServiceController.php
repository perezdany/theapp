<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Service;
class ServiceController extends Controller
{
    //
    /*
         <!--!<td></td>-->
                      
                        <!--<td>
                            <form action="see_devis" method="post" target="blank">
                                @csrf
                                <input type="text" value="{{$cotation->id}}" name="id_cotation" style="display:none">
                                <button class="btn btn-warning"><i class="fa fa-eye"></i></button>
                            </form>
                        </td>-->
                        <!--<td>
                            
                            <button class="btn btn-primary" 
                                data-toggle="modal" data-target="#editlines{{$cotation->id}}" >
                                    <b><i class="fa fa-edit"></i></b></button>
                            <div class="modal fade" id="editlines{{$cotation->id}}" role="dialog" aria-hidden="true" >
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edition des lignes du devis {{$cotation->numero_devis}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        
                                        @if($cotation->id_service == 8)

                                        <form action="edit_lineas" method="post">
                                        @csrf
                                                                                  
                                            @php
                                                $les_articles = DB::table('cotation_article')
                                                ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
                                                ->join('articles', 'cotation_article.article_id', 'articles.id')
                                                ->where('cotation_article.cotation_id', $cotation->id)
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
                                            <div class="row modal-footer justify-content-between">
                                            <button data-dismiss="modal" class="btn btn-danger">Retour</button>
                                            <button type="submit" class="btn btn-info float-right">Valider</button>
                                            </div>
                                        </form>
                            
                                        @else
                                            <form action="edit_lines" method="post">
                                            @csrf
                                           
                                            @php
                                                $i = 1;
                                                $les_articles = DB::table('details_cotations')
                                                ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
                                                ->where('details_cotations.cotation_id', $cotation->id)
                                                ->get(['details_cotations.*',]);
                                            @endphp
                                            @foreach($les_articles as $a)
                                                <input type="text" class="form-control" value="{{$a->id}}"  
                                                name="idd{{$i}}"  style="display:none;">       
                                            <div class="row">
                                                <div class="col-sm-12">
                                                  
                                                    <div class="form-group">
                                                    <label>Désignation:</label>
                                                        <textarea name="@php echo 'designation'.$i @endphp" class="form-control" 
                                                        id="@php echo 'designation'.$i @endphp">
                                                        {{$a->designation}}
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
                                                        class="form-control" placeholder="Entrez ..."  id="@php echo 'duree'.$i @endphp" value="{{$a->duree}}">                                            </div>
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
                                                <div class="row modal-footer justify-content-between">
                                                <button data-dismiss="modal" class="btn btn-danger">Retour</button>
                                                <button type="submit" class="btn btn-info float-right">Valider</button>
                                                </div>
                                            </form>
                                        @endif
                                             

                                    </div> 
                                    </div>
                        
                                </div>
                               
                            </div>    
                            
                        </td> -->
    */
    public function TryDelete(Request $request)
    {
        //VOIR SI Y A PAS UN DEVIS DE CE SERVICE
        $v = DB::table('cotation_service')->where('id_service', $request->id)->count();
        if($v == 0)
        {
            Service::destroy($request->id);
            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Impossible de supprimer le service. Un devis y est associé');
        }
    }

    public function GetAll()
    {
        return Service::all();
    }

    public function AddLineForCreation(Request $request)
    {
       //dd($request->all());
       if(isset($request->designation))
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation,
                'prix_ht' => $request->prix,
                'duree' => $request->duree,
                'duree_type' => $request->duree_type,
                   
          ]);
       }
       if($request->designation1 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation1,
                'prix_ht' => $request->prix1,
                'duree' => $request->duree1,
                'duree_type' => $request->duree_type1,
                   
          ]);
       }
       if($request->designation2 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation2,
                'prix_ht' => $request->prix2,
                'duree' => $request->duree2,
                'duree_type' => $request->duree_type2,
                   
          ]);
       }

       if($request->designation3 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation3,
                'prix_ht' => $request->prix3,
                'duree' => $request->duree3,
                'duree_type' => $request->duree_type3,
                   
          ]);
       }
       if($request->designation4 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation4,
                'prix_ht' => $request->prix4,
                'duree' => $request->duree4,
                'duree_type' => $request->duree_type4,
                   
          ]);
       }
       if($request->designation5 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation5,
                'prix_ht' => $request->prix5,
                'duree' => $request->duree5,
                'duree_type' => $request->duree_type5,
                   
          ]);
       }

       if($request->designation6 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation7,
                'prix_ht' => $request->prix7,
                'duree' => $request->duree7,
                'duree_type' => $request->duree_type7,
                   
          ]);
       }

       if($request->designation8 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation8,
                'prix_ht' => $request->prix8,
                'duree' => $request->duree8,
                'duree_type' => $request->duree_type8,
                   
          ]);
       }
       if($request->designation9 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation9,
                'prix_ht' => $request->prix9,
                'duree' => $request->duree9,
                'duree_type' => $request->duree_type9,
                   
          ]);
       }
       if($request->designation10 != null)
       {
            $add = DB::table('details_cotations')
            ->insert([
                'cotation_id' => $request->id_cotation,
                'designation' => $request->designation10,
                'prix_ht' => $request->prix10,
                'duree' => $request->duree10,
                'duree_type' => $request->duree_type10,
                   
          ]);
       }

        return view('forms/add_devis',[
            'id' => $request->id_cotation,
        ]);
    }

     public function EditLineForCreation(Request $request)
    {
       //dd($request->all());
        $add = DB::table('details_cotations')->where('id', $request->id)
        ->update([
                
                'designation' => $request->designation,
                'prix_ht' => $request->prix,
                'duree' => $request->duree,
                'duree_type' => $request->duree_type,
                   
          ]);

          return view('forms/add_devis',[
            'id' => $request->id_cotation,
        ]);
    }

    public function DeleteLineService(Request $request)
    {
        //dd($request->all());
        $get = DB::table('details_cotations')
        ->where('id', $request->id)
        ->get(['details_cotations.cotation_id']);
        //dd($get);
        foreach($get as $get)
        {
            $id = $get->cotation_id;
        }
       
        $delete = DB::table('details_cotations')->where('id', $request->id)->delete();

        return view('forms/add_devis', compact('id'));
    }

    public function DeleteLineService2(Request $request)
    {
        //dd($request->all());
        $get = DB::table('details_cotations')
        ->where('id', $request->id)
        ->get(['details_cotations.cotation_id']);
        //dd($get);
        foreach($get as $get)
        {
            $id = $get->cotation_id;
        }
       
        $delete = DB::table('details_cotations')->where('id', $request->id)->delete();

        return view('livewire/cotations/edit', compact('id'));
    }
}
