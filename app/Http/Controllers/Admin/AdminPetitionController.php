<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminPetitionController extends Controller
{
    //Ver todas las peticiones para el admin
    public function index()
    {
        $petitions = Petition::orderBy('created_at', 'desc')->get();
        return view('admin.petitions.index', compact('petitions'));
    }

    //Para borrar las peticiones
    public function delete($id)
    {
        $petition = Petition::findOrFail($id);
        $petition->delete();
        return back();
    }

    public function create() {
        $categories = Category::all();
        return view('admin.petitions.edit-add', compact('categories'));
    }

    public function store(\Illuminate\Http\Request $request)
    {

        $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "category_id" => "required",
            "file" => "required|file|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048",
        ]);

        $input = $request->all();
        try {

            $category = Category::findOrFail($input['category_id']);
            $petition = new Petition();
            $petition->title = $request->title;
            $petition->description = $request->description;
            $petition->signeds = 0;
            $petition->status = 'pending';
            $petition->destinatary = "everyone";
            $petition->category()->associate($category);
            $petition->user()->associate(Auth::user());

            $res = $petition->save();

            if ($res) {

                $res_file = $this->fileUpload($request, $petition->id);

                if ($res_file) {
                    return redirect("/admin");
                }
                return back()->withError("Error creando la peticion")->withInput();
            }
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

    }

    public function edit(Petition $petition)
    {
        $categories = Category::all();
        return view('admin.petitions.edit-add', compact('petition', 'categories'));
    }

    public function update(Request $request, Petition $petition)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'file' => 'nullable|file|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
        ]);

        $petition->title = $request->title;
        $petition->description = $request->description;
        $petition->category_id = $request->category_id;
        $petition->status = $request->status;

        if ($request->hasFile('file')) {
            // Borra la imagen antigua si quieres
            if ($petition->file) {
                @unlink(public_path('petitions/' . $petition->file->file_path));
                $petition->file->delete();
            }
            $this->fileUpload($request, $petition->id);
        }

        $petition->save();

        return redirect()->route('admin.home')->with('success', 'Petición actualizada correctamente.');
    }
    public function fileUpload($req, $petition_id = null)
    {
        $file = $req->file('file');
        $fileModel = new File;
        $fileModel->petition_id = $petition_id;
        if ($req->file('file')) {
            //return $req->file('file');

            $filename = $fileName = time() . '_' . $file->getClientOriginalName();
            //      Storage::put($filename, file_get_contents($req->file('file')->getRealPath()));
            $file->move('petitions', $filename);

            //  Storage::put($filename, file_get_contents($request->file('file')->getRealPath()));
            //   $file->move('storage/', $name);


            //$filePath = $req->file('file')->storeAs('/peticiones', $fileName, 'local');
            //    $filePath = $req->file('file')->storeAs('/peticiones', $fileName, 'local');
            // return $filePath;
            $fileModel->name = $filename;
            $fileModel->file_path = $filename;
            $res = $fileModel->save();
            return $fileModel;
        }
        return 1;
    }



}
