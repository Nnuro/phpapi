<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\ProductCategoryTypes;

class ProductCategoryTypesController extends Controller
{
    public $pageTitle = 'Product Category Types';
    public $productCategoryTypes, $productCategory;
    public function __construct(ProductCategoryTypes $productCategoryTypes, ProductCategory $productCategory)
    {
        $this->productCategoryTypes = $productCategoryTypes;
        $this->productCategory = $productCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategoryTypes = $this->productCategoryTypes::all();

        $productCategory = $this->productCategory::all();
        $pageTitle = $this->pageTitle;
        return view('admin.pages.product_category.product-category-types', compact('productCategoryTypes', 'productCategory','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productCategoryTypes =   $this->productCategoryTypes::create($request->all());
        return redirect()->route('product_category_types.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
