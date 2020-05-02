
    <div class="col-lg-3">
        <div class="card">
           <a class="btn btn-default" href="{{route('retailer.purchaselist')}}">Purchase Order List
               <i class="fa fa-1x far fa-list-alt" ></i>
           </a>
        </div>
    </div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="datatable_length">
                            <label>Show
                                <select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="datatable_filter" class="dataTables_filter">
                            <label>Search:
                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 40px;">Batch Number</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Product Name: activate to sort column descending" style="width: 150px;">Product Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Category: activate to sort column ascending" style="width: 170px;">Description</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 69px;">Price</th>
                                    {{-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 81px;">Status</th> --}}
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Avai.Color: activate to sort column ascending" style="width: 130px;">Manufacturer</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 83px;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                        @if ($products)
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product->batch_number}}</td>
                                        <td>{{$product->id}} | {{$product->products->name}}</td>
                                        <td> {{$product->products->active_ingredients}}, {{$product->products->strength}}, {{$product->products->packet_size}}</td>
                                        <td>{{$product->formattedPrice()}}</td>
                                        {{-- <td>{{$product->expiry_status}} </td> --}}
                                        <td>{{$product->products->manufacturers->name}} </td>
                                        <td> 
                                            <form method="POST" action="{{url('admin/retailer/cart')}}" enctype="multipart/form-data" >
                                                @csrf
                                                <input class="form-control" value="{{$product->id}}" name="id" type="hidden">
                                                <input class="form-control" value="{{$product->products_id}}" name="products_id" type="hidden">
                                                <input class="form-control" value="{{$product->products->name}}" name="name" type="hidden">
                                                <input class="form-control" value="{{$product->formattedPrice()}}" name="price" type="hidden">
                                                <input class="form-control" value="1" name="quantity" type="hidden">
                                                <button type="submit" class="btn btn-sm btn-primary">ADD</button>
                                            </form>  
                                    </td>
                                    </tr>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 14 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>