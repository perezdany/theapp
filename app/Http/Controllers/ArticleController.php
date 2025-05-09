<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;

use DB;

class ArticleController extends Controller
{
    //

    public function TryDelete(Request $request)
    {
        //dd($request->all());
        //VERIFIER SI IL EST PAS DANS UN DEVIS
        $v = DB::table('cotation_article')->where('id_article', $request->id)->count();

        if($v == 0)
        {
            //ON PEUT SUPPRIMER
            Article::destroy($request->id);

            return back()->with('success', 'Elément supprimé');
        }
        else
        {
            return back()->with('error', 'Vous ne pouvez pas supprimer cet article. En effet, un devis contient ce article');
        }
    }

    public function GetLastest()
    {
        $get = DB::table('articles')
            ->join('typearticles', 'articles.id_typearticle', '=', 'typearticles.id')
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get(['articles.*', 'typearticles.libele']);

        return $get;
    }

    public function DeleteLineArticle(Request $request)
    {
        $get = DB::table('cotation_article')
        ->where('id', $request->id)
        ->get(['cotation_article.cotation_id']);
        //dd($get);
        foreach($get as $get)
        {
            $id = $get->cotation_id;
        }
       
        $delete = DB::table('cotation_article')->where('id', $request->id)->delete();

        return view('forms/devis_vente', compact('id'));
    }
}
