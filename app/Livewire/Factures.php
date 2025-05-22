<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
use Livewire\WithPagination;

use App\Models\Facture_devis_user;
use App\Models\Facture;

class Factures extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $compare = '';
    public $annee = '';
    public $t_reglee = '';

    public $search = '';

    public $statut = '';
    public $user = '';

    public  $numero_facture,  $numero_avoir, $date_reglement, $date_emission, $numero_impot,
            $montant_facture, $id_cotation, $reglee, $annulee, $id_user, $file_path; 

    public $editFacture = [];
    public $editOldValues = [];

    public function editmodal(Facture $facture)
    {
        //dd('ici'); 
        $this->editFacture = $facture->toArray();

        $this->editOldValues = $this->editFacture; //Mettre les valeurs ancienne dedans
        //dd( $this->editFacture);
        $this->dispatch('editmodal');
    }

    public function addmodal()
    {
        $this->dispatch('addmodal');
    }

    public function close()
    {
        $this->reset();
    }

    //FONCTION POUR FAIRE ORDRE DECROISSANT
    public function setOrderField($champ)
    {
        
        if($champ == $this->orderField)
        {
            if($this->orderDirection = 'ASC')
            {
                $this->orderDirection = 'DESC';
            }
            $this->orderDirection =  $this->orderDirection = 'DESC' ? 'ASC' : 'DESC';
            
        }
        else
        {
  
            $this->orderField = $champ;
            $this->orderDirection =  $this->orderDirection = 'DESC' ? 'ASC' : 'DESC';
            
            $this->reset('orderDirection');

        }
        //return $la;
    }

    public function addFacture()
    {
        //dd('ici');
        Facture::create(
            [
               
                '$numero_avoir' => $this->numero_avoir, 'date_reglement' => $this->date_reglement, 
                'date_emission' => $this->date_emission, 'montant_facture' => $this->montant_facture, 
                'id_cotation' => $this->id_cotation, 
                'reglee' => 0, 'annulee' => 0, 'id_user' => auth()->user()->id, 

            ]
        );

        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');
    }

    public function updateFacture()
    {
        //dd('ici');
        $edit = DB::table('factures')->where('id', $this->editFacture['id'])
        ->update([
            'numero_facture' => $this->editFacture['numero_facture'],  
            'numero_avoir' => $this->editFacture['numero_avoir'], 
            'numero_impot' => $this->editFacture['numero_impot'], 
            'date_reglement' => $this->editFacture['date_reglement'], 
            'date_emission' => $this->editFacture['date_emission'], 
            'montant_facture' => $this->editFacture['montant_facture'], 'id_cotation' => $this->editFacture['id_cotation'], 
             'annulee' => $this->editFacture['annulee'], 
            
        ]);

        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');
    }

    public function render()
    {
        $factureQuery = Facture_devis_user::query();

        if($this->search != "")
        {
            $factureQuery->where("numero_devis", "LIKE", "%".$this->search."%")
            ->orwhere("numero_facture", "LIKE", "%".$this->search."%")
            ->orwhere("nom", "LIKE", "%".$this->search."%")
            ->orwhere("date_reglement", "LIKE", "%".$this->search."%")
            ->orwhere("date_emission", "LIKE", "%".$this->search."%")
            ->orwhere("montant_facture", "LIKE", "%".$this->search."%");
        }

        if($this->statut != "")
        {
            $factureQuery->where("annulee", $this->statut);
        }

        if($this->user != "")
        {
            $factureQuery->where("id_user", $this->user);
        }

        if($this->t_reglee != "")
        {
            $factureQuery->where("reglee", $this->t_reglee);
        }

        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $factureQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $factureQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $factureQuery->where("created_at", $this->compare,  $annee);
            }
            
        }
        
        return view('livewire.factures.index',  ['factures' => $factureQuery->orderBy($this->orderField, $this->orderDirection)->paginate(15)]);
    }
}
