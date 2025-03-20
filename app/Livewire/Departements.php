<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use App\Http\Controllers\DepartementController;

use App\Models\Departement;
use DB;

class Departements extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $formetitle = 'Ajouter un département';

    public $libele_departement = '';
    public $search = '';

    public $editDep = [];

    public $editHasChanged;
    public $editOldValues = [];

     //FONCTION POUR FAIRE ORDRE DECROISSANT
    public function setOrderField($champ)
    {
        
        if($champ == $this->orderField)
        {
        
            //$this->reset('orderDirection');
            $this->orderDirection =  $this->orderDirection = 'DESC' ? 'ASC' : 'DESC';
            
        }
        else
        {
            //dd('ici');

            $this->orderField = $champ;
            $this->orderDirection =  $this->orderDirection = 'DESC' ? 'ASC' : 'DESC';
            //dump($this->orderDirection);
            $this->reset('orderDirection');

        }
        //return $la;
    }

    public function addmodal()
    {
        $this->dispatch('addmodal');
    }

    public function close()
    {
        $this->reset();
    }

    public function Add()
    {
        $Insert = Departement::create([
            'libele_departement' => $this->libele_departement,
        ]);
        
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');
        //return $this->redirect('/departements');
    }

    public function editmodal(Departement $departement)
    {
        //dd($departement); 
        $this->editDep = $departement->toArray();
        //dd($this->editDep);
        $this->editOldValues = $this->editDep; //Mettre les valeurs ancienne dedans

        //dd($this->editOldValues );
        $this->dispatch('editmodal');
    }

    public function showUpdateButton()
    {
        //dd('ici');
        $this->editHasChanged = false;
        
        if(
            $this->editDep['libele_departement'] != $this->editOldValues['libele_departement'] 
           
        )
        {
           
            $this->editHasChanged = true;
        }

        return $this->editHasChanged;
   
    }

    public function updateDep()
    {
        $affected = DB::table('departements')
        ->where('id', $this->editDep['id'])
        ->update([
            'libele_departement' =>  $this->editDep['libele_departement'] 

        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');

    }

    public function render()
    {
        $departementsQuery =  Departement::query();
        
        if($this->editDep != []) 
        {
            //dd('ici');
            //Ca veut dire que des valeurs sont en train d'être modifié dans le formulaire de modification
            $this->showUpdateButton();
        }

        if($this->search != "")
        {
            $departementsQuery->where("libele_departement", "LIKE", "%".$this->search."%");
        }

        return view('livewire.departements.index',  ['departements' => $departementsQuery->orderBy($this->orderField, $this->orderDirection)->paginate(5)]);
    }
}
