<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cotation;
use DB;

class CotationController extends Controller
{
    //

    public function AddDevis(Request $request)
    {

        //dd($request->all());
        $create = Cotation::create(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis'=>$request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
                'valide' => 0,
                'id_user' => auth()->user()->id,
            ]
        );

        if(isset($request->s1))//SI IL A COCHE LA CASE DE LA PERMISSION SUPPRIMER
        {
            $create->services()->attach($request->s1);
        }
        
        if(isset($request->s2))//SI IL A COCHE CETTE CASE
        {
            $create->services()->attach($request->s2);
        }
        if(isset($request->s3))
        {
            $create->services()->attach($request->s3);
        }
        if(isset($request->s4))
        {
            $create->services()->attach($request->s4);
        }
        if(isset($request->s5))
        {
            $create->services()->attach($request->s5);
        }
        if(isset($request->s6))
        {
            $create->services()->attach($request->s6);
        }
        if(isset($request->s6))
        {
            $create->services()->attach($request->s6);
        }
        if(isset($request->s7))
        {
            $create->services()->attach($request->s7);
        }
       

        return view('forms/add_ligne_devis',[
            'id_devis' => $create->id,
            'success' => 'Enregistrement du devis effectué. 
            Veuillez renseigner les détails du service ou cliquez sur retour pour renseigner plus tard'
        ]);
    }

    public function EditDevis(Request $request)
    {

        //dd($request->all());
        
        $edit = DB::table('cotations')
        ->where('id', $request->id)
        ->update(
            [ 
                'date_creation' => $request->date_creation, 'numero_devis'=>$request->numero_devis,
                'date_validite' => $request->date_validite, 'id_client' => $request->id_client,
                'valide' => 0,
                'id_user' => auth()->user()->id,
            ]
        );

        if(isset($request->s1))//SI IL A COCHE LA CASE DE LA PERMISSION SUPPRIMER
        {
            //dd('dd');
            //SI Y A DEJA UNE OCCURENCE DE L'ELEMENT, ON NE FAIT RIEN 
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->s1)->count();
            if($v == 0)
            {
                //Y A RIEN DONC ON PEUT AJOUTER
                DB::table('cotation_service')->insert(['cotation_id' => $request->id, 'service_id' => $request->s1]);
            }else{}
            
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 1)->delete();
            
        }
        
        if(isset($request->s2))//SI IL A COCHE CETTE CASE
        {
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->s2)->count();
            if($v == 0)
            {  DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->s2]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 3)->delete();
            
        }
        if(isset($request->s3))
        {
            
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->s3)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->s3]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 4)->delete();
            
        }
        if(isset($request->s4))
        {
            //dd('da');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->s4)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->s4]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 5)->delete();
            
        }
        if(isset($request->s5))
        {
            //dd('dadcv');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->s5)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->s5]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 6)->delete();
            
        }
        if(isset($request->s6))
        {
            //dd('df');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->s6)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->s6]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 7)->delete();
            
        }
       
        if(isset($request->s7))
        {
            //dd('a');
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', $request->s7)->count();
            if($v == 0)
            { DB::table('cotation_service')->insert(['cotation_id' => $request->id,'service_id' => $request->s7]);}else{}
        }
        else
        {
            //IL PEUT AVOIR DECOCHE UN ELEMENT DANS CE CAS ON VA SUPPRIMER L'ANCIEN ENREGISTREMENT
            $v = DB::table('cotation_service')->where('cotation_id', $request->id)
            ->where('service_id', 8)->delete();
            
        }

        return back()->with(
            'success', 'Modification effectuée avec succès'
        );
     
    }

    public function GoFormLines(Request $request)
    {
        return view('forms/form_edit_lines',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function GoEdit(Request $request)
    {
        //dd($request->all());
        return view('livewire/cotations/edit',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function GetById($id)
    {
        $get = DB::table('cotations')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->where('cotations.id', $id)
        ->get(['cotations.*', 'clients.nom']);

        return $get;
    }

    public function AddLines(Request $request)
    {
        //dd($request->all());
        $servs = DB::table('services')->get();
        if(isset($request->service8))
        {
            $insert =  DB::table('cotation_article')->where('cotation_id', $request->id_cotation)
            ->where('article_id', $request->service8)->update(['article_id' => $request->article,'quantite' => $request->qte,]);
        }
        if(isset($request->service1))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service1)
            ->update(['prix_ht' => $request->prix_ht1,'duree_mois' => $request->mois1,
            'duree_jours' => $request->jours1,'duree_semaines' => $request->semaines1,]);
        }
        if(isset($request->service2))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service2)
            ->update(['prix_ht' => $request->prix_ht2,'duree_mois' => $request->mois2,
            'duree_jours' => $request->jours2,'duree_semaines' => $request->semaines2,]);
        }
        if(isset($request->service3))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service3)
            ->update(['prix_ht' => $request->prix_ht3,'duree_mois' => $request->mois3,
            'duree_jours' => $request->jours3,'duree_semaines' => $request->semaines3,]);
        }
        if(isset($request->service4))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service4)
            ->update(['prix_ht' => $request->prix_ht4,'duree_mois' => $request->mois4,
            'duree_jours' => $request->jours4,'duree_semaines' => $request->semaines4,]);
        }
        if(isset($request->service5))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service5)
            ->update(['prix_ht' => $request->prix_ht5,'duree_mois' => $request->mois5,
            'duree_jours' => $request->jours5,'duree_semaines' => $request->semaines5,]);
        }
        if(isset($request->service6))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service6)
            ->update(['prix_ht' => $request->prix_ht6,'duree_mois' => $request->mois6,
            'duree_jours' => $request->jours6,'duree_semaines' => $request->semaines6,]);
        }
        if(isset($request->service7))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service7)
            ->update(['prix_ht' => $request->prix_ht7,'duree_mois' => $request->mois7,
            'duree_jours' => $request->jours7,'duree_semaines' => $request->semaines7,]);
        }
        if(isset($request->service8))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service8)
            ->update(['prix_ht' => $request->prix_ht8,'duree_mois' => $request->mois8,
            'duree_jours' => $request->jours8,'duree_semaines' => $request->semaines8,]);
        }
    
        return back()->with('success', 'Enregistrement effecuté');
    }

    public function EditLines(Request $request)
    {
        
        //dd($request->all());
        //PARCOURIR LES SERVICE ET FAIRE LES ENREGISTREMENT EN FONCTION DES SERVICE ENVOYés dump($request->mois.$a);
        $servs = DB::table('services')->get();
        if(isset($request->service8))
        {
            $insert =  DB::table('cotation_article')->where('cotation_id', $request->id_cotation)
            ->where('article_id', $request->service8)->update(['article_id' => $request->article,'quantite' => $request->qte,]);
        }
        if(isset($request->service1))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service1)
            ->update(['prix_ht' => $request->prix_ht1,'duree_mois' => $request->mois1,
            'duree_jours' => $request->jours1,'duree_semaines' => $request->semaines1,]);
        }
        if(isset($request->service2))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service2)
            ->update(['prix_ht' => $request->prix_ht2,'duree_mois' => $request->mois2,
            'duree_jours' => $request->jours2,'duree_semaines' => $request->semaines2,]);
        }
        if(isset($request->service3))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service3)
            ->update(['prix_ht' => $request->prix_ht3,'duree_mois' => $request->mois3,
            'duree_jours' => $request->jours3,'duree_semaines' => $request->semaines3,]);
        }
        if(isset($request->service4))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service4)
            ->update(['prix_ht' => $request->prix_ht4,'duree_mois' => $request->mois4,
            'duree_jours' => $request->jours4,'duree_semaines' => $request->semaines4,]);
        }
        if(isset($request->service5))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service5)
            ->update(['prix_ht' => $request->prix_ht5,'duree_mois' => $request->mois5,
            'duree_jours' => $request->jours5,'duree_semaines' => $request->semaines5,]);
        }
        if(isset($request->service6))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service6)
            ->update(['prix_ht' => $request->prix_ht6,'duree_mois' => $request->mois6,
            'duree_jours' => $request->jours6,'duree_semaines' => $request->semaines6,]);
        }
        if(isset($request->service7))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service7)
            ->update(['prix_ht' => $request->prix_ht7,'duree_mois' => $request->mois7,
            'duree_jours' => $request->jours7,'duree_semaines' => $request->semaines7,]);
        }
        if(isset($request->service8))
        {
            $insert =  DB::table('cotation_service')->where('cotation_id', $request->id_cotation)
            ->where('service_id', $request->service8)
            ->update(['prix_ht' => $request->prix_ht8,'duree_mois' => $request->mois8,
            'duree_jours' => $request->jours8,'duree_semaines' => $request->semaines8,]);
        }
        
        return back()->with('success', 'Modification effectuée');
    }

    public function TryDelete(Request $request)
    {
        //dd($request->all());
        //VOIR SI Y A PAS DES FACTURES
        $v = DB::table('factures')->where('id_cotation', $request->id)->count();
        if($v == 0)
        {
            //ON PEUT SUPPRIMER TRANQUIELLEMENT
            Cotation::destroy($request->id);

            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Ce devis ne peut être supprimé car il y a des factures associées');
        }
        //SUPPRIMER TOUS SES FILS
        $l = DB::table('cotation_service')->where('cotation_id', $request->id)->get();
        foreach($l as $l)
        {
            $delete = DB::table('cotation_service')->where('id', $l->id)->delete();
        }
        $b = DB::table('cotation_article')->where('cotation_id', $request->id)->get();
        foreach($b as $b)
        {
            $delete = DB::table('cotation_article')->where('id', $b->id)->delete();
        }
    }

    public function GoDetails(Request $request)
    {
        return view('livewire/cotations/seedevis',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function PrintDevis(Request $request)
    {
        return view('livewire/cotations/devis-print',[
            'id_cotation' => $request->id_cotation,
        ]);
    }

    public function GetLinesinfoCustomer($id)
    {
        $get = DB::table('cotation_service')->where('cotation_id', $id)
        ->join('cotations', 'cotation_service.cotation_id', '=', 'cotations.id')
        ->join('services', 'cotation_service.service_id', '=', 'services.id')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->limit(1)
        ->get(['cotation_service.*', 'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'clients.nom', 'clients.adresse', 'clients.telephone', 'clients.activite',
                'clients.adresse_email', 'adresse_facturation', 'clients.numero_contribuable',
                'services.libele_service', 'services.code'
            ]);

       // dd($get);
        
        return $get;
    }

    public function GetLines($id)
    {
        $get = DB::table('cotation_service')->where('cotation_id', $id)
        ->join('cotations', 'cotation_service.cotation_id', '=', 'cotations.id')
        ->join('services', 'cotation_service.service_id', '=', 'services.id')
        ->join('clients', 'cotations.id_client', '=', 'clients.id')
        ->get(['cotation_service.*', 'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'clients.nom', 'clients.adresse', 'clients.telephone', 'clients.activite',
                'clients.adresse_email', 'adresse_facturation', 'clients.numero_contribuable',
                'services.libele_service', 'services.code'
            ]);

       // dd($get);
        
        return $get;
    }

    public function GetArticleLines($id)
    {
        $get = DB::table('cotation_article')->where('cotation_id', $id)
        ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
        ->join('articles', 'cotation_article.article_id', '=', 'articles.id')
        ->join('typearticles', 'articles.id_typearticle', '=', 'typearticles.id')
        ->get(['cotation_article.*', 'cotations.date_creation', 'cotations.numero_devis',
                'cotations.date_validite', 'cotations.id_client', 'cotations.valide',
                'articles.designation', 'articles.code', 'articles.prix_unitaire',
               
            ]);
        
        return $get;
    }

    public function EnableTaxe(Request $request)
    {
        //dd('ici');
        $v = DB::table('taxes')->get();
        foreach($v as $v)
        {
            if($v->active == 0)
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 1]);
        
                return view('livewire/cotations/seedevis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été activée'
                ]);
            }
            else
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 0]);
        
                return view('livewire/cotations/seedevis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été désactivée'
                ]);
            }
        }
    }

    public function EnableTVA(Request $request)
    {
        //dd('d/');
        $v = DB::table('taxes')->get();
        foreach($v as $v)
        {
            if($v->active == 0)
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 1]);
        
                return view('admins/devis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été activée'
                ]);
            }
            else
            {
                $edit = DB::table('taxes')->where('id', 1)
                ->update(['active' => 0]);
        
                return view('admins/devis',[
                    'id_cotation' => $request->id_cotation,
                    'success' => 'La TVA a été désactivée'
                ]);
            }
        }
       
    }

    public function AddaService(Request $request)
    {
        //dd($request->all());
        $add = DB::table('cotation_service')
        ->insert(['cotation_id' => $request->id,
                    'service_id' => $request->service,
                    'prix_ht' => $request->prix,
                    'duree_mois' => $request->mois,
                    'duree_jours' => $request->jours,
                    'duree_semaines' => $request->semaines
          ]);
          return back()->with('success', 'Opération effectuée avec succès');
    }

    public function AddAnArticle(Request $request)
    {
        $add = DB::table('cotation_article')
        ->insert(['cotation_id' => $request->id_cotation,
                    'article_id' => $request->article,
                    'quantite' => $request->qte
          ]);
          return back()->with('success', 'Opération effectuée avec succès');
    }
    
}
