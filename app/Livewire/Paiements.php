<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
use Livewire\WithPagination;

use App\Models\Paiement_facture_clt;
use App\Models\Paiement;

class Paiements extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $compare = '';
    public $annee = '';

    public $search = '';

    public $client = '';
    public $user = '';

    public $id_cotation = '';
    public $id_facture = '';

    public $editPaiement = [];

    public function editmodal(Paiement $paiement)
    {
        //dd('ici'); 
        $this->editPaiement = $paiement->toArray();

        //$this->editOldValues = $this->editFacture; //Mettre les valeurs ancienne dedans
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

    public function render()
    {
        $paiementQuery = Paiement_facture_clt::query();

        if($this->user != "")
        {
            $paiementQuery->where("id_user", $this->user);
        }

        if($this->client != "")
        {
            $paiementQuery->where("id_client", $this->client);
        }
        if($this->id_cotation != "")
        {
            $paiementQuery->where("id_cotation", $this->id_cotation);
        }
        if($this->id_facture != "")
        {
            $paiementQuery->where("id_facture", $this->id_facture);
        }

        if($this->search != "")
        {
            $paiementQuery->where("numero_facture", "LIKE", "%".$this->search."%")
            ->orwhere("nom", "LIKE", "%".$this->search."%")
            ->orwhere("paiement", "LIKE", "%".$this->search."%")
            ->orwhere("banque", "LIKE", "%".$this->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->search."%");
           
        }

        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $paiementQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $paiementQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $paiementQuery->where("created_at", $this->compare,  $annee);
            }
            
        }
        return view('livewire.paiements.index',  ['paiements' => $paiementQuery->orderBy($this->orderField, $this->orderDirection)->paginate(20)]);
    }
}
