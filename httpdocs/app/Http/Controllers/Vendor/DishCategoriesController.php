<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class DishCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("vendor.category.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("vendor.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DishCategory  $dishCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DishCategory $dishCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DishCategory  $dishCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(DishCategory $dishCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DishCategory  $dishCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DishCategory $dishCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DishCategory  $dishCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DishCategory $dishCategory)
    {
        //
    }
}
