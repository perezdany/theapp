<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Facture;

use DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FactureController extends Controller
{
    //

    public function CreateInvoice(Request $request)
    {
        //dd($request->all());
        //récupérer la dernière facture pour le numero facture
        $count = Facture::count();
        //dd($count);
        if($count != 0)
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
            $insert = Facture::create([
                'numero_facture' => $num, 
                'date_reglement' => $result_date, 'date_emission' => $today, 
                'montant_facture' => $request->montant_facture , 'id_cotation' => $request->id_cotation, 
                'reglee' => 0, 'annulee' => 0, 'id_user' => auth()->user()->id,
            ]);
        }
        //Ne pas oublier de valider le devis
        $valider_devis = DB::table('cotations')->where('id', $request->id_cotation)
        ->update(['valide' => 1]);
       
        return view('livewire/factures/seefacture',[
            'id_cotation' => $request->id_cotation,
            'id_facture' => $insert->id
        ]);
    }

    public function GetByIdCotation($id)
    {
        $get = Facture::where('id_cotation', $id)->get();
        return $get;
    }

    public function PrintInvoice(Request $request)
    {
        //dd($request->all());
        return view('livewire/factures/facture-print',[
            'id_cotation' => $request->id_cotation,
        ]);
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
}
