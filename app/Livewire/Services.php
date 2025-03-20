<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use DB;

use App\Models\Service;

class Services extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $libele_service = '';
    public $code = '';
    public $description;
    public $suspendu = 0;
    public $search = '';
    public $id_user = '';
    public $susp = '';

    public $editService = [];

    public $editHasChanged;
    public $editOldValues = [];

    public function editmodal(Service $service)
    {
        $this->editService = $service->toArray();

        $this->editOldValues = $this->editService; //Mettre les valeurs ancienne dedans

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

    public function Add()
    {
        //dd($this->description);
        $create = Service::create(
            [ 
                'libele_service' => $this->libele_service, 
                'code' => $this->code, 
                'description' => $this->description, 
                'suspendu' => $this->suspendu, 
                'id_user' => auth()->user()->id
            ]
        );
        //session()->flash('success', 'Enregistrement effectué');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');
        //return $this->redirect('/services');
    }

    public function updateService()
    {
        //dd($this->editArticle);
        $affected = DB::table('services')
        ->where('id', $this->editService['id'])
        ->update([
            'libele_service' => $this->editService['libele_service'], 
            'code' => $this->editService['code'], 
            'description' => $this->editService['description'], 
            'suspendu' => $this->editService['suspendu'],             
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');

    }

    public function render()
    {
        $serviceQuery = Service::query();

        if($this->search != "")
        {
            $serviceQuery->where("libele_service", "LIKE", "%".$this->search."%")
            ->orwhere("code", "LIKE", "%".$this->search."%")
            ->orwhere("description", "LIKE", "%".$this->search."%");
           
        }

        if($this->id_user != "")
        {
            $serviceQuery->where("id_user", $this->id_user);
           
        }

        if($this->susp != "")
        {
            $serviceQuery->where("suspendu", $this->susp);
           
        }

        return view('livewire.services.index',  ['services' => $serviceQuery->orderBy($this->orderField, $this->orderDirection)->paginate(10)]);
    }
}
