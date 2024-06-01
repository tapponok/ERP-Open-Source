<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('permission:indexcategory', ['only' => ['show', 'index']]);
        $this->middleware('permission:createcategory', ['only' => ['create','store']]);
        $this->middleware('permission:updatecategory', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deletecategory', ['only' => ['destory']]);;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //$user = User::with('team')->orderBy("created_at", "desc")->get();

    public function index()
    {
        $category = Category::orderBy('created_at', 'DESC')
                            ->where('isarchive', '!=', '1')
                            ->get();
        return view('category.index', compact('category'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'categ_name' => 'required | min:3',
        ];
        $this->validate($request, $rules);
        try {
            $category = new Category();
            $useractive = Auth::id();
            $category->categ_name = $request->input('categ_name');
            $category->created_by = $useractive;
            $category->created_at = now();
            $category->save();
            return redirect()->route('category.index')->with('succes', 'Category was succesfully created');
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'categ_name' => 'required|min:3',
        ];
        $this->validate($request, $rules);
        try {
            $useractive = Auth::id();
            $category =  Category::findOrFail($id);
            $category->categ_name = $request->input('categ_name');
            $category->updated_by = $useractive;
            $category->updated_at = now();
            $category->save();
            return redirect()->route('category.index')->with('succes', 'Category was successfully updated');
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category =  Category::findOrFail($category->id);
            $category->isarchive = true;
            $category->save();
            return redirect()->route('category.index')->with('succes', 'Category was succesfully deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
