<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $categories = Category::all();

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $allowed = ['created_at', 'signeds'];

        if (!in_array($sort, $allowed)) {
            $sort = 'created_at';
        }

        $petitions = Petition::orderBy($sort, $direction)->get();

        return view('petitions.index', compact('petitions', 'categories'));
    }

    public function show(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);
        $user = $petition->user;

        $hasSigned = false; //El user todavia no la ha firmado
        if (Auth::check()) {
            $hasSigned = $petition->signedUsers()->where('user_id', Auth::id())->exists();
        }

        return view('petitions.show', compact('petition', 'user', 'hasSigned'));
    }

    public function listMine(Request $request)
    {
        try {
            $user = Auth::user();
            $petitions = Petition::where('user_id', $user->id)->paginate(5);
            $categories = Category::all();
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return view('petitions.index', compact('petitions', 'categories'));
    }



    public function fileUpload(Request $req, $petition_id = null)
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

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $categories = Category::all();
        return view('petitions.edit-add', compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "destinatary" => "required",
            "category" => "required",
            "file" => "required|file|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048",
        ]);

        $input = $request->all();
        try {
            $category = Category::findOrFail($input['category']);
            $user = Auth::user();
            $petition = new Petition($input);
            $petition->category()->associate($category);
            $petition->user()->associate($user);

            $petition->signeds = 0;
            $petition->status = "pending";

            $res = $petition->save();

            if ($res) {
                $res_file = $this->fileUpload($request, $petition->id);
                if ($res_file) {
                    return redirect("/mypetitions");
                }
                return back()->withError("Error creando la peticion")->withInput();
            }
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

    }


    public function sign(Request $request, $id)
    {
        try {
            $petition = Petition::findOrFail($id);
            $user = Auth::user();
            $signeds = $petition->signedUsers;
            foreach ($signeds as $firma) {
                if ($firma->id == $user->id) {
                    return back()->withError("Ya has firmado esta peticion")->withInput();
                }
            }
            $user_id = [$user->id];
            $petition->signedUsers()->attach($user_id);
            $petition->signeds = $petition->signeds + 1;
            $petition->save();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back();
    }

    public function signedPetitions()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $petitions = $user->signedPetitions;
        $categories = Category::all();
        return view('petitions.index', compact('petitions', 'categories'));
    }

    public function delete($id)
    {

        try {
            $petition = Petition::findOrFail($id);
            $this->authorize('delete', $petition);

            $userId = Auth::id();

            if ($petition->user_id !== $userId) {
                return back()->withErrors("No tienes permiso para borrar esta peticion");
            }

            if ($petition->file) {
                $path = public_path('petitions/' . $petition->file->file_path);

                if (file_exists($path)) {
                    unlink($path);
                }

                $petition->file->delete();
            }

            // Borrar firmas relacionadas
            $petition->signedUsers()->detach();

            // Borrar petición
            $petition->delete();

            return redirect('/mypetitions')->with('success', 'Petición eliminada correctamente.');

        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function edit(Petition $petition)
    {
        $this->authorize('edit', $petition);

        $categories = Category::all();
        return view('petitions.edit', compact('petition', 'categories'));
    }
    public function update(Request $request, Petition $petition) {
        $this->authorize('update', $petition);

        try {
            $userId = Auth::id();
            if ($petition->user_id !== $userId) {
                return back()->withErrors("No tienes permiso para borrar esta peticion");
            }

            $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required',
                'file' => 'nullable|file|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            ]);

            $petition->title = $request->title;
            $petition->description = $request->description;
            $petition->category_id = $request->category_id;

            if ($request->hasFile('file')) {
                // Borra la imagen antigua si quieres
                if ($petition->file) {
                    @unlink(public_path('petitions/' . $petition->file->file_path));
                    $petition->file->delete();
                }
                $this->fileUpload($request, $petition->id);
            }

            $petition->save();


            return redirect()->route('petitions.mine')->with('success', 'Petición actualizada correctamente.');
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }
}
