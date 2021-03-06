<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
    
 use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd();
        $categories = Category::all();
        return view('categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();
        $category=Category::create($input);
        return redirect(route('categories.index'))->with('success','category created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findOrfail($id);
        return  view('categories.create',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $request->validate([
           'name'=> 'required|unique:categories'
        ]);
        $newcategory=Category::findOrFail($id);
        $newcategory->name=$request->name;
        $newcategory->save();
        return redirect(route('categories.index'))->with('success','the category has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteditem=Category::findOrFail($id);
        $deleteditem->delete();
        return  redirect(route('categories.index'))->with('success','the category has been deleted successfuly');
    }
}
