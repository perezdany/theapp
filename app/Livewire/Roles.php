<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use App\Http\Controllers\DepartementController;

use App\Models\Role;
use DB;

class Roles extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $formetitle = 'Ajouter un département';

    public $intitule = '';
    public $description =  '';
    public $search = '';

    public $editRole = [];

    public $editHasChanged;
    public $editOldValues = [];

    public function editmodal(Role $role)
    {
        //dd($departement); 
        $this->editRole = $role->toArray();
        //dd($this->editDep);
        $this->editOldValues = $this->editRole; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodal');
    }

    public function addmodal(Role $role)
    {
        //dd($departement); 
        $this->dispatch('addmodal');
    }

    public function close()
    {
        $this->reset();
    }

    public function Add()
    {
        $create = Role::create(
            [
                'intitule' => $this->intitule,
                'description' => $this->description
            ]
        );
        //session()->flash('success', 'Enregistrement effectué');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');
        //return $this->redirect('/roles');
    }

    public function updateRole()
    {
        //dd($this->editRole['id']);
        $affected = DB::table('roles')
        ->where('id', $this->editRole['id'])
        ->update([
            'intitule' =>  $this->editRole['intitule'],
            'description' => $this->editRole['description']
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');

    }
    

    public function render()
    {
       
        $rolesQuery = Role::query();

        if($this->search != "")
        {
            $rolesQuery->where("intitule", "LIKE", "%".$this->search."%")
            ->orwhere("description", "LIKE", "%".$this->search."%");
        }

        return view('livewire.roles.index',  ['roles' => $rolesQuery->orderBy($this->orderField, $this->orderDirection)->paginate(3)]);
    }
}
