<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Depense;

class DepenseController extends Controller
{
    //

    public function TryDelete(Request $request)
    {
        $delete = Depense::destroy($request->id);

        return back()->with('success','Elément supprimé');
    }

    public function FilterByUser(Request $request)
    {
        //dd($request->all());
        $user = $request->user;
        return view('livewire.depenses.filter_user', compact('user'));

    }

    public function FilterByDateCrea(Request $request)
    {
        //dd($request->all());
        $annee = $request->annee;
        $compare = $request->compare;
        return view('livewire.depenses.date_creation_filter', compact('compare', 'annee'));

    }
}
