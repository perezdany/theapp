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
}
