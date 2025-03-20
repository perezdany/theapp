<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\User_departement;

use App\Models\User;

use App\Http\Controllers\UserController;

use Livewire\Attributes\On;

use DB;

use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';
    public $login, $nom_prenoms, $poste, $active;
    public  $departements_id = "";
    public $id = "";
    public $search = '';
    public $AddUser = [];
    public $data;

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

    public function AddUserForm(User $user)
    {
        //dd('ici');
        $this->AddUser = $user->toArray();
      
        $this->dispatchBrowserEvent('showAddModal');
        //$this->dispatch('addModal');
    }

    public function Add()
    {
        //dd($this->poste);
        if($this->departements_id === "")
        {
            session()->flash('warn', 'Choisissez un departememnt svp');
          
        }
        else
        {
            $user_password = Hash::make("123456");
            if(User::where('login', $this->login)->count() == 0)
            {
                $Insert = User::create([
                    'login' => $this->login, 
                    'password' => $user_password,
                     'nom_prenoms' => $this->nom_prenoms, 
                     'departements_id' => $this->departements_id,
                     'poste' => $this->poste, 
                   
                     'active' => 1,
                      'created_by' => auth()->user()->id,
                      'count_login' => 0,
               ]);
    
               $this->dispatch('showAddSuccessMessage');
               $this->dispatch('closeAddModal');
               

            }
            //session()->flash('warn', 'Cette adresse mail existe déja!');
            //return redirect('users')->with('error', 'Adresse mail est déja utilisée')$nom_prenoms, $id ' {{ $user->nom_prenoms }} ', '{{ $user->id }}';
         
        }

       
    }

    public function confirmDelete($nom_prenoms, $id)
    {
        //dd($id);
         
        $data = [
            "text" => "Vous êtes sur le point de supprimer le fichier intitulé $nom_prenoms de la base de données.",
            "title" => "Êtes vous sûre de continuer?",
            "type" => "warning",
            "id_user" => $id
        ];
        $this->dispatch('delete-prompt',  data: $id);
    }

   
    public function delete(User $user)
    {
        //dd($this->id);
        $try = ( new UserController())->tryDelete($this->id);

        if($try != 0)
        {
            //Déclenche l'evenement  #[On('do-delete')] 
        }

       
    }

    public function close()
    {
        $this->reset();
    }

    

    public function render()
    {
        $userQuery = User_departement::query();

        if($this->search != "")
        {
            $userQuery->where("nom_prenoms", "LIKE", "%".$this->search."%")
            ->orwhere('libele_departement', "LIKE", "%". $this->search."%")
            ->orwhere('login', "LIKE", "%". $this->search."%")
            ->orwhere('poste', "LIKE", "%". $this->search."%");
        }

        if($this->departements_id != "")
        {
            //dd('id');
            $userQuery->where("departements_id", $this->departements_id);
           
        }

        if($this->active != "")
        {
            //dd('id');
            $userQuery->where("active", $this->active);
           
        }

        return view('livewire.users.index',  ['users' => $userQuery->orderBy($this->orderField, $this->orderDirection)->paginate(5)]);
    }
}
