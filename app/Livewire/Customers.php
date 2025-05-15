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
    $adresse_email, $adresse_facturation, $actif, $numero_contribuable, $id_user;

    public $id_statutclient = '';
    public $si_actif = '';

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
        //dd('part'); 
        $this->editCustomer = $customer->toArray();

        $this->editOldValues = $this->editCustomer; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodal');
    }

    public function editmodalparticulier(Client $customer)
    {
        //dd('ici'); 
        $this->editCustomerParticulier= $customer->toArray();

        $this->editOldValues = $this->editCustomerParticulier; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodalparticulier');
    }

    public function detailsmodal(Client $customer)
    {
        
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
                'id_statutclient' => $this->id_statutclient, 'particulier' => 1, 'actif' => 0, 
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
                'id_statutclient' => $this->id_statutclient, 'particulier' => 0, 'actif' => 0, 
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
        //dd($this->editCustomerParticulier);
        $affected = DB::table('clients')
        ->where('id', $this->editCustomerParticulier['id'])
        ->update([
            'nom' => $this->editCustomerParticulier['nom'], 'adresse'=>$this->editCustomerParticulier['adresse'], 
                'id_statutclient' => $this->editCustomerParticulier['id_statutclient'], 
                'particulier' => $this->editCustomerParticulier['particulier'], 'actif' => $this->editCustomerParticulier['actif'], 
                'telephone' => $this->editCustomerParticulier['telephone'], 'activite' => $this->editCustomerParticulier['activite'], 
                'adresse_email' => $this->editCustomerParticulier['adresse_email'], 
                   
        ]);

        //dd($affected);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModalParticulier');

    }

    public function updateCustomer()
    {
        //dd($this->editCustomer['id_statutclient']);
        $affected = DB::table('clients')
        ->where('id', $this->editCustomer['id'])
        ->update([
            'nom' => $this->editCustomer['nom'], 'adresse'=>$this->editCustomer['adresse'], 
            'id_statutclient' => $this->editCustomer['id_statutclient'], 'particulier' => $this->editCustomer['particulier'], 
            'actif' => $this->editCustomer['actif'],
            'telephone' => $this->editCustomer['telephone'], 'activite' => $this->editCustomer['activite'], 
            'adresse_email' => $this->editCustomer['adresse_email'], 
            'adresse_facturation' => $this->editCustomer['adresse_facturation'],  
            'numero_contribuable' => $this->editCustomer['numero_contribuable'],  
            
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');

    }

    public function render()
    {     
        $customerQuery = Client_statut::query();
        
        if($this->search != "")
        {
            $customerQuery->where("nom", "LIKE", "%".$this->search."%")
            ->orwhere("adresse", "LIKE", "%".$this->search."%")
            ->orwhere("telephone", "LIKE", "%".$this->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->search."%");
        }

        if($this->user != "")
        {
            $customerQuery->where("id_user", $this->user);
        }

        if($this->si_actif!= "")
        {
            $customerQuery->where("actif", $this->si_actif);
        }

        if($this->statut != "")
        {
            $customerQuery->where("id_statutclient", $this->statut);
        }

        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $customerQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $customerQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $customerQuery->where("created_at", $this->compare,  $annee);
            }
            
        }

        return view('livewire.customers.index',  ['customers' => $customerQuery->orderBy($this->orderField, $this->orderDirection)->paginate(10)]);
    }
}
