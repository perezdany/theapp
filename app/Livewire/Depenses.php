<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use DB;
use App\Models\Depense;
use App\Models\Depense_user;

class Depenses extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $date_sortie;
    public $montant = '';
    public $nom_beneficiaire, $numero_cheque, $banque,  $numero_virement, $objet;
    public $date_virement;
    public $search = '';
    public $id_user;
    public $user = ''; 
    public $compare, $annee;

    public $editDepense = [];
    public $Details = [];

    public $editHasChanged;
    public $editOldValues = [];

    public function editmodal(Depense $depense)
    {
        //dd('ici'); 
        $this->editDepense = $depense->toArray();

        $this->editOldValues = $this->editDepense; //Mettre les valeurs ancienne dedans

        $this->dispatch('editmodal');
    }

    public function detailsmodal(Depense $depense)
    {
        //dd('ici'); 
        $this->Details = $depense->toArray();

        $this->dispatch('detailsmodal');
    }

    public function close()
    {
        $this->reset();
    }

    public function addmodal()
    {
        $this->dispatch('addmodal');
    }

    public function Add()
    {
        //dd($this->description);
        $create = Depense::create(
            [ 
                'date_sortie' => $this->date_sortie,
                'montant' => $this->montant,
                'nom_beneficiaire' => $this->nom_beneficiaire,
                'numero_cheque' => $this->numero_cheque,
                'banque' => $this->banque,
                'date_virement' => $this->date_virement,
                'numero_virement' => $this->numero_virement,
                'objet' => $this->objet,
                'id_user' => auth()->user()->id,
            ]
        );
        //session()->flash('success', 'Enregistrement effectué');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');
        //return $this->redirect('/depenses');
    }

    public function updateDepense()
    {
        //dd($this->editDepense['date_virement']);
        $affected = DB::table('depenses')
        ->where('id', $this->editDepense['id'])
        ->update([
                'date_sortie' => $this->editDepense['date_sortie'],
                'montant' => $this->editDepense['montant'],
                'nom_beneficiaire' => $this->editDepense['nom_beneficiaire'],
                'numero_cheque' => $this->editDepense['numero_cheque'],
                'banque' => $this->editDepense['banque'],
                'date_virement' => $this->editDepense['date_virement'],
                'numero_virement' => $this->editDepense['numero_virement'],
                'objet' => $this->editDepense['objet'],
            
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showUpdSuccessMessage');
        $this->dispatch('closeUpdateModal');
       
        
        //$this->reset();
        //return back()->with('success', 'Modification effectuée');
    }

    public function render()
    {
        
        $depenseQuery = Depense_user::query();
       
        if($this->search != "")
        {
           $depenseQuery->where("montant", "LIKE", "%".$this->search."%")
            ->orwhere("nom_beneficiaire", "LIKE", "%".$this->search."%")
            ->orwhere("numero_cheque", "LIKE", "%".$this->search."%")
            ->orwhere("banque", "LIKE", "%".$this->search."%")
            ->orwhere("numero_virement", "LIKE", "%".$this->search."%")
            ->orwhere("objet", "LIKE", "%".$this->search."%");
        }

        if($this->user != "")
        {
           $depenseQuery->where("id_user", $this->user);
        }

        if($this->compare != "" AND $this->annee != "")
        {
            
            if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
                $depenseQuery->where("date_sortie", '<', $annee_f)->where("date_sortie", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $depenseQuery->where("date_sortie", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $depenseQuery->where("date_sortie", $this->compare,  $annee);
            }
            
        }


        return view('livewire.depenses.index',  ['depenses' => $depenseQuery->orderBy($this->orderField, $this->orderDirection)->paginate(10)]);
    }
}
