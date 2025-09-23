<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Suivi_user;
use App\Models\Suivicommercial;

use Livewire\WithPagination;

use DB;

class Tablesuivis extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $compare = '';
    public $annee = '';

    public $search = '';

    public $f = '';
    public $user = '';
    public $entreprise = '';
    public $p = '';

    public $editSuivi = [];

    public function editmodal(Suivicommercial $suivi)
    {
        //dd('ici'); 
        $this->editSuivi = $suivi->toArray();

        $this->dispatch('editmodal');
    }

    public function updateSuivi()
    {
        /*$edit = Projet::where('id', $this->editProjet['id'])->update([
            'nom_projet' => $this->editProjet['nom_projet'], 
        ]);*/
        $create = Suivicommercial::where('id', $this->editSuivi['id'])->update(
            [ 
                'title' => $this->editSuivi['title'], 
                'start' => $this->editSuivi['start'], 'end' => $this->editSuivi['end'], 
                'id_projet' => $this->editSuivi['id_projet'], 'id_fournisseur' => $this->editSuivi['id_fournisseur'], 
                'more' => $this->editSuivi['more'],
                  
            ]
        );

        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');
    }

    public function render()
    {   
        $get =  DB::table('role_user')->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->where('user_id', auth()->user()->id)
        ->where('roles.intitule', "super_admin")->count();
  
        if($get != 0)
        {
            $suiviQuery = Suivi_user::query();
        }
        else
        {
            $suiviQuery = Suivi_user::query()->where('id_user', auth()->user()->id);
        }
        

        if($this->compare != "" AND $this->annee != "")
        {
            
            /*$convert1 = date('Y-m-d H:i:s',strtotime($this->annee));
            $convert2 = date('Y-m-d H:i:s',strtotime($this->compare));*/
            //d($this->annee);
            $suiviQuery->where("start", '>=', $this->compare)->where("end", '<=', $this->annee);
            
            /*if($this->compare == "=")
            {
                $annee = $this->annee."-01-01";
                $annee_f = $this->annee."-12-31";
             
                $suiviQuery->where("created_at", '<', $annee_f)->where("created_at", '>', $annee);
            }
            elseif($this->compare == "<")
            {
                $annee = $this->annee."-01-01";
                $suiviQuery->where("created_at", $this->compare,  $annee);
            }
            else
            {
                $annee = $this->annee."-12-31";
                $suiviQuery->where("created_at", $this->compare,  $annee);
            }*/
            
        }

        if($this->search != "")
        {
            $suiviQuery->where("title", "LIKE", "%".$this->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->search."%");
           
        }

        if($this->user != "")
        {
            $suiviQuery->where("id_user", $this->user);
           
        }

        if($this->entreprise != "")
        {
            $suiviQuery->where("id_client", $this->entreprise);
           
        }

        if($this->f != "")
        {
            $suiviQuery->where("id_fournisseur", $this->f);
           
        }

        if($this->p != "")
        {
            $suiviQuery->where("id_projet", $this->p);
           
        }
        
        return view('livewire.tablesuivis.index',  ['suivis' => $suiviQuery->orderBy($this->orderField, $this->orderDirection)->paginate(20)]);
    }
}
