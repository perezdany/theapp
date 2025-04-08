<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
use Livewire\WithPagination;

use App\Models\Interlocuteur_client_f;
use App\Models\Interlocuteur;

class Interlocuteurs extends Component
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
    public $titre;
    public $i_nom;
    public $prenom;
    public $tel;
    public $email;
    public $id_fonction; 
    public $id_client;
    public $id_user;

    public $entreprise;
    public $f;

    public $editInterlocuteur = [];

    public function editmodal(Interlocuteur $interlocuteur)
    {
        //dd('ici'); 
        $this->editInterlocuteur  = $interlocuteur->toArray();

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

    public function add()
    {
        $add = Interlocuteur::create([
            'titre' => $this->titre, 'i_nom' => $this->i_nom, 'prenom' => $this->prenom,
             'tel' => $this->tel, 'email' => $this->email, 
             'id_fonction' => $this->id_fonction, 'id_client' => $this->id_client, 
            'id_user' => auth()->user()->id
        ]);

        
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');
    }

    public function updateInterlocuteur()
    {
        $edit = Interlocuteur::where('id', $this->editInterlocuteur['id'])->update([
            'titre' => $this->editInterlocuteur['titre'], 'i_nom' => $this->editInterlocuteur['i_nom'], 
            'prenom' => $this->editInterlocuteur['prenom'],
             'tel' => $this->editInterlocuteur['tel'], 'email' => $this->editInterlocuteur['email'], 
             'id_fonction' => $this->editInterlocuteur['id_fonction'], 
             'id_client' => $this->editInterlocuteur['id_client'], 
            'id_user' => auth()->user()->id
        ]);

        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');
    
    }

    public function render()
    {
        $interlocuteurQuery = Interlocuteur_client_f::query();

        if($this->search != "")
        {
            $interlocuteurQuery->where("titre", "LIKE", "%".$this->search."%")
            ->orwhere("i_nom", "LIKE", "%".$this->search."%")
            ->orwhere("prenom", "LIKE", "%".$this->search."%")
            ->orwhere("tel", "LIKE", "%".$this->search."%")
            ->orwhere("email", "LIKE", "%".$this->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->search."%")
            ->orwhere("libele_fonction", "LIKE", "%".$this->search."%");
        }

        if($this->user != "")
        {
            $interlocuteurQuery->where("id_user", $this->user);
        }

        if($this->entreprise != "")
        {
            $interlocuteurQuery->where("id_client", $this->entreprise);
        }

        if($this->f != "")
        {
            $interlocuteurQuery->where("id_fonction", $this->f);
        }


        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $interlocuteurQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $interlocuteurQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $interlocuteurQuery->where("created_at", $this->compare,  $annee);
            }
            
        }
        
        return view('livewire.interlocuteurs.index',  ['interlocuteurs' => $interlocuteurQuery->orderBy($this->orderField, $this->orderDirection)->paginate(20)]);

    }
}
