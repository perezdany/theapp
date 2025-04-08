<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
use App\Models\Fournisseur;
use App\Models\Fournisseur_user;

use Livewire\WithPagination;


class Fournisseurs extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $compare = '';
    public $annee = '';

    public $search = '';

    public $nom;
    public $telephone;
    public $user = '';


    public $editFournisseur = [];

    public function editmodal(Fournisseur $fournisseur)
    {
        //dd('ici'); 
        $this->editFournisseur = $fournisseur->toArray();

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

    public function addFournisseur()
    {
        $add = Fournisseur::create([
            'nom' => $this->nom, 'telephone' => $this->telephone, 'id_user' => auth()->user()->id
        ]);

        $this->dispatch('showAddSuccessMessage');
        $this->reset();
        $this->dispatch('closeAddModal');
    }

    public function updateFournisseur()
    {
        $edit = Fournisseur::where('id', $this->editFournisseur['id'])->update([
            'nom' => $this->editFournisseur['nom'], 'telephone' => $this->editFournisseur['telephone'],
        ]);

        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');
    }

    public function render()
    {
        $fournisseurQuery = Fournisseur_user::query();
        if($this->user != "")
        {
            $fournisseurQuery->where("id_user", $this->user);
        }

        if($this->search != "")
        {
            $fournisseurQuery->where("nom", "LIKE", "%".$this->search."%")
            ->orwhere("telephone", "LIKE", "%".$this->search."%");
           
        }
        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $fournisseurQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $fournisseurQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $fournisseurQuery->where("created_at", $this->compare,  $annee);
            }
            
        }
        return view('livewire.fournisseurs.index',  ['fournisseurs' => $fournisseurQuery->orderBy($this->orderField, $this->orderDirection)->paginate(20)]);
    }
}
