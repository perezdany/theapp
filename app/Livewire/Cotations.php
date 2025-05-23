<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Cotation_clt_user;

use App\Models\Cotation;

use DB;
use Livewire\WithPagination;

class Cotations extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $compare = '';
    public $annee = '';

    public $search = '';

    public $statut = '';
    public $user = '';
    public $service = '';
    public $rejete = '';

    public $editCotation = [];

    public function editmodal(Cotation $cotation)
    {
        //dd('ici'); 
        $this->editCotation = $cotation->toArray();

        $this->editOldValues = $this->editCotation; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodal');
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
        $cotationQuery = Cotation_clt_user::query();

        if($this->search != "")
        {
            $cotationQuery->where("numero_devis", "LIKE", "%".$this->search."%")
            ->orwhere("nom", "LIKE", "%".$this->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->search."%");
        }

        if($this->statut != "")
        {
            $cotationQuery->where("valide", $this->statut);
        }

        if($this->user != "")
        {
            $cotationQuery->where("id_user", $this->user);
        }

        if($this->service != "")
        {
            $cotationQuery->where("id_service", $this->service);
        }

        if($this->rejete != "")
        {
            $cotationQuery->where("rejete", $this->rejete);
        }

        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $cotationQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $cotationQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $cotationQuery->where("created_at", $this->compare,  $annee);
            }
            
        }


        return view('livewire.cotations.index',  ['cotations' => $cotationQuery->orderBy($this->orderField, $this->orderDirection)->paginate(10)]);
    }
}
