<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Fonction;

use DB;
use Livewire\WithPagination;

class Fonctions extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $compare = '';
    public $annee = '';

    public $search = '';

    public $user = '';

    public $libele_fonction;

    public $editFonction = [];

    public function editmodal(Fonction $fonction)
    {
        //dd('ici'); 
        $this->editFonction = $fonction->toArray();

        $this->editOldValues = $this->editFonction; //Mettre les valeurs ancienne dedans
        //dd( $this->editFonction);
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
    
    public function addFonction()
    {
        Fonction::create(
            [
                'libele_fonction' => $this->libele_fonction, 'id_user' => auth()->user()->id, 
            ]
        );

        $this->dispatch('showAddSuccessMessage');
        $this->reset();
        $this->dispatch('closeAddModal');
    }

    public function updateFonction()
    {
        //dd($this->editFonction);
        $edit = DB::table('fonctions')->where('id', $this->editFonction['id'])
        ->update([
            'libele_fonction' => $this->editFonction['libele_fonction'],
            
        ]);

        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');
    }
    
    public function render()
    {
        $fonctionQuery = Fonction::query();

        if($this->search != "")
        {
            $fonctionQuery->where("libele_fonction", "LIKE", "%".$this->search."%");
        }

        if($this->user != "")
        {
            $fonctionQuery->where("id_user", $this->user);
        }

        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $fonctionQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $fonctionQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $fonctionQuery->where("created_at", $this->compare,  $annee);
            }
            
        }

        return view('livewire.fonctions.index',  ['fonctions' => $fonctionQuery->orderBy($this->orderField, $this->orderDirection)->paginate(10)]);
    }
}
