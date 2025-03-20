<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use DB;
use App\Models\Typearticle;

class Typearticles extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $libele = '';
    public $id_user =  '';
    public $search = '';

    public $editType = [];

    public $editHasChanged;
    public $editOldValues = [];

    public function editmodal(Typearticle $typearticle)
    {
        //dd('ici'); 
        $this->editType = $typearticle->toArray();
        //dd($this->editDep);
        $this->editOldValues = $this->editType; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodal');
    }

    public function addmodal()
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
        //dd(auth()->user()->id);
        $create = Typearticle::create(
            [
                'libele' => $this->libele,
                'id_user' => auth()->user()->id,
            ]
        );
        //session()->flash('success', 'Enregistrement effectué');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');
        //return $this->redirect('/types');
    }

    public function updateType()
    {
        //dd('ici');
        $affected = DB::table('typearticles')
        ->where('id', $this->editType['id'])
        ->update([
           'libele' => $this->editType['libele'],
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');

    }
    

    public function render()
    {
        $typeQuery = Typearticle::query();
        if($this->search != "")
        {
            $typeQuery->where("libele", "LIKE", "%".$this->search."%");
           
        }
        return view('livewire.typearticles.index',  ['types' => $typeQuery->orderBy($this->orderField, $this->orderDirection)->paginate(3)]);
    }
}
