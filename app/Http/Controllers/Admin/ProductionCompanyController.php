<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionCompany;
use Illuminate\Http\Request;

class ProductionCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productionCompanies = ProductionCompany::orderBy('name')->get();

        return view('production-companies.index', compact('productionCompanies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('production-companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newProductionCompany = new ProductionCompany();

        $newProductionCompany->name = $data['name'];

        $newProductionCompany->save();

        return redirect()->route('production-companies.show', $newProductionCompany);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionCompany $productionCompany)
    {
        return view('production-companies.show', compact('productionCompany'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionCompany $productionCompany)
    {
        return view('production-companies.edit', compact('productionCompany'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionCompany $productionCompany)
    {
        $data = $request->all();

        $productionCompany->update($data);

        return redirect()->route('production-companies.edit', $productionCompany);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionCompany $productionCompany)
    {
        $productionCompany->delete();

        return redirect()->route('production-companies.index');
    }
}
