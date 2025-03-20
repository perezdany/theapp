<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

use DB;

use App\Models\Article;
use App\Models\Article_type;

class Articles extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

    public $designation = '';
    public $code =  '';
    public $prix_unitaire, $id_typearticle;
    public $search = '';
    public $id_user = '';
    public $id_type = '';

    public $editArticle = [];

    public $editHasChanged;
    public $editOldValues = [];

    public function editmodal(Article $article)
    {
        //dd('ici'); 
        $this->editArticle = $article->toArray();

        $this->editOldValues = $this->editArticle; //Mettre les valeurs ancienne dedans

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
        //dd(auth()->user()->id);
        $create = Article::create(
            [ 
                'designation' => $this->designation,
                'code' => $this->code,
                'prix_unitaire' => $this->prix_unitaire,
                'id_typearticle' => $this->id_typearticle,
                'id_user' => auth()->user()->id,
            ]
        );
        //session()->flash('success', 'Enregistrement effectué');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');

    }

    public function updateArticle()
    {
        //dd($this->editArticle);
        $affected = DB::table('articles')
        ->where('id', $this->editArticle['id'])
        ->update([
            'designation' => $this->editArticle['designation'],
            'code' => $this->editArticle['code'],
            'prix_unitaire' => $this->editArticle['prix_unitaire'],
            'id_typearticle' => $this->editArticle['id_typearticle'],
            
        ]);
        //session()->flash('success', 'Modification effectuée');
        $this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeUpdateModal');

    }
    


    public function render()
    {
        $articleQuery = Article_type::query();
        if($this->search != "")
        {
            $articleQuery->where("designation", "LIKE", "%".$this->search."%")
            ->orwhere("code", "LIKE", "%".$this->search."%")
            ->orwhere("prix_unitaire", "LIKE", "%".$this->search."%")
            ->orwhere("libele", "LIKE", "%".$this->search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->search."%");
           
        }

        if($this->id_user != "")
        {
            $articleQuery->where("id_user", $this->id_user);
           
        }

        if($this->id_type != "")
        {
            $articleQuery->where("id_typearticle", $this->id_type);
           
        }

        return view('livewire.articles.index',  ['articles' => $articleQuery->orderBy($this->orderField, $this->orderDirection)->paginate(10)]);
    }
}
