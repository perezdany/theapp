<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
use App\Models\Projet;
use App\Models\Projet_user;

use Livewire\WithPagination;

class Projets extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $compare = '';
    public $annee = '';

    public $search = '';

    public $nom_projet;
    public $description, $id_client, $date_debut, $date_fin;
    public $client;
    public $user = '';


    public $editProjet = [];

    public function editmodal(Projet $projet)
    {
        //dd('ici'); 
        $this->editProjet = $projet->toArray();

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

    public function addProjet()
    {
        $add = Projet::create([
            'nom_projet' => $this->nom_projet, 
            'id_client' => $this->id_client, 'description' => $this->description, 
            'date_debut' => $this->date_debut, 'date_fin' => $this->date_fin,
            'id_user' => auth()->user()->id
        ]);

        $this->dispatch('showAddSuccessMessage');
        $this->reset();
        $this->dispatch('closeAddModal');
    }

    public function updateProjet()
    {
        $edit = Projet::where('id', $this->editProjet['id'])->update([
            'nom_projet' => $this->editProjet['nom_projet'], 
             'id_client' => $this->editProjet['id_client'], 'description' => $this->editProjet['description'], 
            'date_debut' => $this->editProjet['date_debut'], 'date_fin' => $this->editProjet['date_fin'],
        ]);

        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');
    }
    public function render()
    {

        $projetQuery = Projet_user::query();
        if($this->user != "")
        {
            $projetQuery->where("id_user", $this->user);
        }

        if($this->search != "")
        {
            $projetQuery->where("nom_projet", "LIKE", "%".$this->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->search."%");
           
        }

        if($this->client != "")
        {
            $projetQuery->where("id_client", $this->client);
           
        }

        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $projetQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $projetQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $projetQuery->where("created_at", $this->compare,  $annee);
            }
            
        }
        return view('livewire.projets.index',  ['projets' => $projetQuery->orderBy($this->orderField, $this->orderDirection)->paginate(20)]);
    }
}
