@extends('admin.index')

@section('page-css')
<link href="{{url('admin/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@include('admin.layouts.components.breadcrumbs', ['pageTitle' => $pageTitle ?? ''])
<div class="container-fluid">
    <!-- Page-Title -->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-7 card">
            <div class="card-header">
                ADD NEW PRODUCTS
            </div>
            <div class="card-body">
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="LeadName">Product Name</label>
                                <input type="text" name="name" class="form-control" id="LeadName" required="">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="LeadEmail">Manufacturer</label>
                                <select name="manufacturer_id" class="form-control custom-select" id="status-select">
                                    <option selected="">Select</option>
                                    @if ($manufacturers->isNotEmpty())
                                        @foreach ($manufacturers as $manufacturer)
                                        <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status-select" class="mr-2">Category</label>
                                <select name="product_category_id" class="form-control custom-select" id="productCatSelect">
                                    <option selected="">Select</option>
                                @if (!is_null($productCategory))
                                    @foreach ($productCategory as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="LeadEmail">Category Type</label>
                                <select name="product_category_type" class="form-control custom-select manufact-select" id="status-select">
                                    @if ($productCategoryTypes->isNotEmpty())
                                        <option></option>
                                        @foreach ($productCategoryTypes as $cattype)
                                            <option value="{{$cattype->id}}">{{$cattype->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    @include('admin.pages.wholesalers.products.additional_form')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="LeadEmail">Product Image</label>
                                <input type="file" class="form-control" name="product_image" id="product_image">
                            </div>
                        </div>
                    </div>

                    {{--
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status-select" class="mr-2">Product Image</label>
                                <input class="form-control" type="file" name="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="PhoneNo">Expiry Date</label>
                                <input type="date" name="expiry_date" class="form-control" id="price" required="">
                            </div>
                        </div>
                    </div>
                    --}}
            </div>
        </div>
        <div class="col-lg-4 card" style="margin-left:15px;">
            <div class="card-header">
                PRODUCTS COMPONENT (Drugs Only) *
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Drug Code">Drug Code</label>
                            <input type="text" name="code" class="form-control" id="LeadName">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Active Ingredients">Active Ingredients (Comma Seperated)</label>
                            <input type="text" name="active_ingredients" class="form-control" id="active_ingredients">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="AssociatedName">Associated Name</label>
                            <input type="text" name="associated_name" class="form-control" id="associated_name">
                        </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button type="button" onclick="history.back()" class="btn btn-sm btn-danger">Cancel</button>
                </div>
            </div>
        </form>
    </div><!--end row-->
    @include('admin.pages.dashboard.modal-page')
    </div><!-- container -->
@endsection
@section('page-js')
<script src="{{url('admin/assets/plugins/select2/select2.min.js')}}"></script>
    <script>
        $("#selectedDrugCat").hide();
        $("#selectedEquipCat").hide();
        var catslect;
        $(document).ready(function(){
            initSelectTags();
            $("#productCatSelect").change(function(){
                console.log(catslect);
                catslect = $("#productCatSelect").val();
                console.log(catslect);
                if(catslect == '1') {
                    $("#selectedDrugCat").show();
                }else{
                    $("#selectedDrugCat").hide();
                }
                if(catslect == '2') {
                    $("#selectedEquipCat").show();
                }else{
                    $("#selectedEquipCat").hide();
                }
            });
        });



    function initSelectTags() {
        $(".manufact-select").select2({
            placeholder: 'Select Category Type',
            width: '100%',
            // ajax: {
            //     url: 'https://api.github.com/orgs/select2/repos',
            //     data: function (params) {
            //     var query = {
            //         search: params.term,
            //         type: 'public'
            //     }

            //     // Query parameters will be ?search=[term]&type=public
            //     return query;
            //     }
            // }
                    }); 
    }
    </script>
@endsection