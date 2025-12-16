<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Petition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function delete($id)
    {
        $petition = Category::findOrFail($id);
        $petition->delete();
        return back();
    }

    public function create() {
        return view('admin.categories.edit-add');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit-add', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->name = $request->name;

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Categoria actualizada correctamente.');
    }

    public function store(\Illuminate\Http\Request $request)
    {

        $request->validate([
            "name" => "required|max:255",
        ]);

        $input = $request->all();
        try {

            $category = new Category();
            $category->name = $request->name;
            $res = $category->save();

            if ($res) {
                return redirect("/admin/categories");
            }
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }
}
