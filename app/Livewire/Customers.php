<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use DB;

use App\Models\Client;
use App\Models\Client_statut;

class Customers extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $nom, $adresse, $particulier, $telephone, $activite, 
    $adresse_email, $adresse_facturation, $numero_contribuable, $id_user;

    public $id_statutclient = '';

    public $statut = '';
    public $user = '';
    public $editCustomer = [];
    public $Details = [];

    public $DetailsParticulier = [];
    public $editCustomerParticulier = [];

    public $compare = '';
    public $annee = '';

    public $search = '';

    public $editHasChanged;
    public $editOldValues = [];

    public function editmodal(Client $customer)
    {
        //dd('ici'); 
        $this->editCustomer = $customer->toArray();

        $this->editOldValues = $this->editCustomer; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodal');
    }

    public function editmodalparticulier(Client $customer)
    {
        //dd('ici'); 
        $this->editCustomer = $customer->toArray();

        $this->editOldValues = $this->editCustomerParticulier; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodalparticulier');
    }

    public function detailsmodal(Client $customer)
    {
        //dd('ici'); 
        $this->Details = $customer->toArray();

        $this->dispatch('details');
    }

    public function detailsmodalparticulier(Client $customer)
    {
        //dd('ici'); 
        $this->DetailsParticulier = $customer->toArray();

        $this->dispatch('detailsparticulier');
    }

    public function close()
    {
        $this->reset();
    }

    public function addmodal()
    {
        $this->dispatch('addmodal');
    }
    public function addmodalparticulier()
    {
        $this->dispatch('addmodalparticulier');
    }

    public function AddParticulier()
    {
        //dd($this->id_statutclient);
        $create = Client::create(
            [ 
                'nom' => $this->nom, 'adresse'=>$this->adresse, 
                'id_statutclient' => $this->id_statutclient, 'particulier' => 1, 
                'telephone' => $this->telephone, 'activite' => $this->activite, 'adresse_email' => $this->adresse_email, 
                'id_user' => auth()->user()->id,
            ]
        );

        $this->dispatch('showAddSuccessMessage');
        $this->reset();
        $this->dispatch('closeAddModalParticulier');

    }

    public function Add()
    {
        //dd($this->id_statutclient);
        $create = Client::create(
            [ 
                'nom' => $this->nom, 'adresse'=>$this->adresse, 
                'id_statutclient' => $this->id_statutclient, 'particulier' => 0, 
                'telephone' => $this->telephone, 'activite' => $this->activite, 'adresse_email' => $this->adresse_email, 
                'adresse_facturation' => $this->adresse_facturation,  'numero_contribuable' => $this->numero_contribuable, 
                'id_user' => auth()->user()->id,
            ]
        );

        $this->dispatch('showAddSuccessMessage');
        $this->reset();
        $this->dispatch('closeAddModal');

    }

    public function updateParticulier()
    {
        //dd($this->editCustomer['date_virement']);
        $affected = DB::table('depenses')
        ->where('id', $this->editCustomer['id'])
        ->update([
            'nom' => $this->nom, 'adresse'=>$this->adresse, 
                'id_statutclient' => $this->id_statutclient, 'particulier' => 0, 
                'telephone' => $this->telephone, 'activite' => $this->activite, 'adresse_email' => $this->adresse_email, 
            'id_user' => auth()->user()->id,
            
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showUpdSuccessMessage');
        $this->dispatch('closeUpdateModalParticulier');

    }

    public function updateCustomer()
    {
        //dd($this->editCustomer['date_virement']);
        $affected = DB::table('depenses')
        ->where('id', $this->editCustomer['id'])
        ->update([
            'nom' => $this->nom, 'adresse'=>$this->adresse, 
            'id_statutclient' => $this->id_statutclient, 'particulier' => 1, 
            'telephone' => $this->telephone, 'activite' => $this->activite, 'adresse_email' => $this->adresse_email, 
            'adresse_facturation' => $this->adresse_facturation,  'numero_contribuable' => $this->numero_contribuable,  
            
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showUpdSuccessMessage');
        $this->dispatch('closeUpdateModal');

    }

    public function render()
    {
        
        $customerQuery = Client_statut::query();
        //dd($customerQuery);
        return view('livewire.customers.index',  ['customers' => $customerQuery->orderBy($this->orderField, $this->orderDirection)->paginate(10)]);
    }
}
