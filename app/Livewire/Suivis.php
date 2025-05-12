<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Suivi_user;
use App\Models\Suivicommercial;

use DB;

class Suivis extends Component
{
    public $events = [];
    public $title; 
    public $start, $end; 
    public $id_client;
    public $id_projet; 
    public $id_fournisseur; 
    public $id_user;

    public $t_colour = ["AliceBlue", "AntiqueWhite", "Aqua", "Black",
    "CornflowerBlue", "DarkGoldenRod", "DarkGreen", "DeepPink", "Gold",
    "Indigo", "LightCoral", "LightSeaGreen",];

    public function addEvent()
    {
        $start = str_replace('T', ' ', $this->start );
        $end = str_replace('T', ' ', $this->end );

        $i = rand(0, 11);

        $create = Suivicommercial::create(
            [ 
                'title' => $this->title, 'color' => $this->t_colour[$i], 
                'start' => $this->start, 'end' => $this->end, 
                'id_projet' => $this->id_projet, 'id_fournisseur' => $this->id_fournisseur, 
                'id_client' => $this->id_client,  'id_user' => auth()->user()->id
            ]
        );
        session()->flash('success', 'Enregistrement effectué');
        /*$this->dispatch('showAddSuccessMessage');
        $this->dispatch('closeAddModal');*/
        return $this->redirect('suivi');
    }

    public function close()
    {
        $this->reset();
    }

    public function render()
    {
        $events = [];
        //voir si c'est un admin
        $get =  DB::table('role_user')->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->where('user_id', auth()->user()->id)
        ->where('roles.intitule', "super_admin")->count();

        if($get !== 0)//C'est un admin
        {
            $this->events = Suivicommercial::all();
            foreach($this->events as $event)
            {
                $events[] = [
                    'id' => $event->id,
                    'title' => $event->title,
                    'color' => $event->color,
                    'start' => $event->start,
                    'end' => $event->end,
                    'id_projet' => $event->id_projet,
                    'id_fournisseur' => $event->id_fournisseur,
                    'id_client' => $event->id_client,
                    'id_user' => $event->id_user,
                    
                ];
            }
        }
        else
        {
            $this->events = Suivicommercial::where('id_user', auth()->user()->id)->get();
            //dd($this->events);
            foreach($this->events as $event)
            {
                $events[] = [
                    'id' => $event->id,
                    'title' => $event->title,
                    'color' => $event->color,
                    'start' => $event->start,
                    'end' => $event->end,
                    'id_projet' => $event->id_projet,
                    'id_fournisseur' => $event->id_fournisseur,
                    'id_client' => $event->id_client,
                    'id_user' => $event->id_user,
                    
                ];
            }
        }
       
        //dd($events);
        return view('livewire.suivis.index', ['events' => $events]);
    }
}
