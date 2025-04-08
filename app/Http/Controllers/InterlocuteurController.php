<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Interlocuteur;

class InterlocuteurController extends Controller
{
    //
    public function delete(Request $request)
    {
        $delete = DB::table('interlocuteurs')->where('id', '=', $request->id)->delete();
        return back()->with('success', 'Elément supprimé');
    }
}
