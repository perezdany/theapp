<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Facture;

use DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
 
use Barryvdh\DomPDF\Facade\Pdf;

class FactureController extends Controller
{
    //

    public function CreateInvoice(Request $request)
    {
        //dd($request->all());
         //PRENDRE TOUS LES MONTANTS DES DETAILS ET AJOUTER DANS LE DEVIS 
        $somme = 0;
        $sommea = 0;
        $count_lines = DB::table('details_cotations')
        ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
        ->where('details_cotations.cotation_id', $request->id_cotation)->count();
         $count_articles = DB::table('cotation_article')
            ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
            ->where('cotation_article.cotation_id', $request->id_cotation)->count();
        if($count_lines != 0)//C'EST SERVICE PAS VENTE
        {
            $lines = DB::table('details_cotations')
            ->join('cotations', 'details_cotations.cotation_id', '=', 'cotations.id')
            ->where('details_cotations.cotation_id', $request->id_cotation)
            ->get(['details_cotations.*', 'cotations.date_creation', 'cotations.numero_devis']);

            foreach($lines as $line)
            {
                $partie = explode("-", $line->numero_devis);
                $somme = $somme + $line->prix_ht;
            }
        }

        if($count_articles != 0)
        {
            $lines = DB::table('cotation_article')
            ->join('cotations', 'cotation_article.cotation_id', '=', 'cotations.id')
            ->where('cotation_article.cotation_id', $request->id_cotation)
            ->get(['cotation_article.*', 'cotations.date_creation', 'cotations.numero_devis']);

            foreach($lines as $line)
            {
                $partie = explode("-", $line->numero_devis);
                $sommea = $sommea + $line->pu;
            }
        }
  
        $numero = "FACT-".$partie[1]."-".$partie[2];
        //dd($numero);
        $tout = $somme + $sommea;
        
        $today = date('Y-m-d');
        $timestamp = strtotime($today);
        $departtime1 = strtotime('+15 days', $timestamp);
        $result_date = date("Y-m-d", $departtime1 );
        $insert = Facture::create([
                'numero_facture' => $numero, 
                'date_reglement' => $result_date, 'date_emission' => $today, 
                'montant_facture' => $request->montant_facture , 'id_cotation' => $request->id_cotation, 
                'reglee' => 0, 'annulee' => 0, 'id_user' => auth()->user()->id,
            ]);
        //récupérer la dernière facture pour le numero facture

        $count = Facture::count();
        //dd($count);
        /*if($count != 0)
        {
            $last = Facture::orderBy('created_at', 'DESC')->limit(1)->get();
            foreach($last as $last)
            {
                $number = $last->id + 1;
                $num = 'INV'.$number;
                $today = date('Y-m-d');
                $timestamp = strtotime($today);
                $departtime1 = strtotime('+15 days', $timestamp);
                $result_date = date("Y-m-d", $departtime1 );
            }
            $insert = Facture::create([
                'numero_facture' => $num, 
                'date_reglement' => $result_date, 'date_emission' => $today, 
                'montant_facture' => $request->montant_facture , 'id_cotation' => $request->id_cotation, 
                'reglee' => 0, 'annulee' => 0, 'id_user' => auth()->user()->id,
            ]);
        }
        else
        {
            $num = 'INV1';
            $today = date('Y-m-d');
            $timestamp = strtotime($today);
            $departtime1 = strtotime('+15 days', $timestamp);
            $result_date = date("Y-m-d", $departtime1 );
            //dd($depart);
            
        }*/
        //Ne pas oublier de valider le devis
        $valider_devis = DB::table('cotations')->where('id', $request->id_cotation)
        ->update(['valide' => 1]);

        //METTRE LE CLIENT EN DEFINITIF
        //dd('ici');
        //RECUPERER LE CLIENT VOIR SI LE CLIENT EST PROSPETC LE METTRE A JOUR 
        $get_clt = DB::table('cotations')->where('id', $request->id_cotation)->get();
        //dd($get_clt);
        foreach($get_clt as $c)
        {
            $u = DB::table('clients')->where('id', $c->id_client)
            ->update(['id_statutclient' => 2]);
            //dd($u);
        }
       
        return view('livewire/factures/seefacture',[
            'id_cotation' => $request->id_cotation,
            'id_facture' => $insert->id
        ]);

       
    }

    public function DisplayFacture(Request $request)
    {
         return view('livewire/factures/seefacture',[
            'id_cotation' => $request->id_cotation,
            'id_facture' => $request->id
        ]);
    }

    public function GetByIdCotation($id, $id_facture)
    {
        $get = Facture::where('id_cotation', $id)->where('id', $id_facture)
        ->get();
        //sdd($get);
        return $get;
    }

    public function PrintInvoice(Request $request)
    {
        $data = [
            'id_cotation' => $request->id_cotation,
            'id_facture' => $request->id
        ];
        foreach($a = Facture::where('id_cotation', $request->id_cotation)->get() as $a)
        {
            $file = strval("FACTURE-".$a->numero_facture).".pdf";
        }
       
        $pdf = Pdf::loadView('livewire/factures/facture-print', $data);
        
        //return response()->file($pdf);
        return $pdf->stream($file);
        /*return view('livewire/factures/facture-print',[
            'id_cotation' => $request->id_cotation,
        ]);*/
    }

    public function upload(Request $request)
    {
        //dd($request->all());
         //ENREGISTRER LE FICHIER DE LA FACTURE

        //IL FAUT SUPPRIMER L'ANCIEN FICHIER DANS LE DISQUE DUR
        $fichier = $request->file;
  
        if($fichier != null)
        {
            //VERFIFIER LE FORMAT 
            $extension = pathinfo($fichier->getClientOriginalName(), PATHINFO_EXTENSION);
            
            //dd($extension);
            if($extension != "pdf")
            {
                return back()->with('error', 'LE FORMAT DE FICHIER DOIT ETRE UN FORMAT PDF!!');
            }

            //VERIFIER SI L'ENREGISTREMENT A UN CHEMIN D'ACCES ENREGISTRE
            $get_path = Facture::where('id', $request->id)->get();
            foreach($get_path as $get_path)
            {
                if($get_path->file_path == null)
                {
                    //enregistrement de fichier dans la base
                    $file_name = $fichier->getClientOriginalName();
                         
                    $path = $request->file('file')->storeAs(
                        'factures', $file_name
                    );
                    $new_path = 'private/'.$path;

                    $affected = DB::table('factures')
                    ->where('id', $request->id)
                    ->update([
                        'file_path'=> $path,
                        
                    ]);

                }
                else
                {
                    $get_path = Facture::where('id', $request->id)->get();

                    //SUPPRESSION DE L'ANCIEN FICHIER
                    foreach($get_path as $get_path)
                    {
                        Storage::delete($get_path->file_path);
                    }
                   
                    $file_name = $fichier->getClientOriginalName();
                     
                    $path = $request->file('file')->storeAs(
                        'factures', $file_name
                    );

                    $new_path = 'private/'.$path;

                    $affected = DB::table('factures')
                    ->where('id', $request->id)
                    ->update([
                       'file_path'=> $path,
                        
                    ]);

                    
                }
            }

           

            return back()->with('success', 'Le fichier a été enregistré');
            
        }
        else
        {
        
        }
    }

    public function View(Request $request)
    {
        //return response()->file(Storage::path($request->file));
        //dd(Storage::disk('local')->exists($request->file));
        if($request->file != null)
        {
            return response()->file(Storage::path($request->file));
        }
        else
        {
            return back()->with('error', 'Le fichier n\'existe pas');
        }
            
    }

    public function TryDelete(Request $request)
    {
        //dd($request->all());
        //SI LA FACTURE EST UNE FACTURE NORMAL APPARTENANT A UN DEVIS ON SUPPRIME PAS 
        $f = Facture::find($request->id);
        
        if($f->numero_facture != NULL)//C'est une facture normal et appartenant a un devis
        {
            //dd('ii');
            return back()->with('error', 'Impossible de supprimer cette facutre! Elle appartient à un devis validé');
        }
        else
        {
            //dd('f4');
            Facture::destroy($request->id);

            return back()->with('success', 'Facture supprimée');
        }
       
    }

    public function GetById($id)
    {
        $get = DB::table('factures')
            
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
         
            ->join('clients', 'cotations.id_client', '=', 'clients.id')       
            ->where('factures.id', $id)
            ->get(['factures.*',
                    'clients.nom', 
                ]);
       
        return $get;
    }

    public function GetNoreglee()
    {
        $get =DB::table('factures')
            ->join('cotations', 'factures.id_cotation', '=', 'cotations.id')
            ->join('clients', 'cotations.id_client', '=', 'clients.id' )
            ->limit(5)
            ->where('reglee', 0)->where('annulee', 0)->get(['factures.*', 'clients.nom']);
        return $get;
    }
}
