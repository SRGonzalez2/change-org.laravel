<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petition;

class AdminPetitionController extends Controller
{
    //Ver todas las peticiones para el admin
    public function index()
    {
        $petitions = Petition::all();
        return view('admin.petitions.index', compact('petitions'));
    }

    //Para borrar las peticiones
    public function delete($id)
    {
        $petition = Petition::findOrFail($id);
        $petition->delete();
        return back();
    }


}
