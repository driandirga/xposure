@extends('layouts/contentNavbarLayout')

@section('title', 'Master - Add Product')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Add Product
    </h4>

    <div class="row">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Add Product</h5>
                </div>
                <div class="card-body pt-0 pb-2">
                    <form action="{{ route('master.products.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                                required>
                            <label for="initial" class="form-label">Initial</label>
                            <input type="text" class="form-control" id="initial" name="initial" autocomplete="off"
                                required>
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                            <option selected>Choose a Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            </select>
                            <label for="unit_id" class="form-label">Units</label>
                            <select class="form-select" id="unit_id" name="unit_id" aria-label="Default select example">
                            <option selected>Choose a Units</option>
                            @foreach($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                            </select>
                            <label for="brand_id" class="form-label">Brand</label>
                            <select class="form-select" id="brand_id" name="brand_id" aria-label="Default select example">
                            <option selected>Choose a Brand</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                            </select>
                            <label for="purchase_price" class="form-label">Purchase Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" placeholder="Purchase Price" aria-label="Amount (to the nearest dollar)" id="purchase_price" name="purchase_price" autocomplete="off"
                                required />
                                <span class="input-group-text">.00</span>
                            </div>
                            <label for="selling_price" class="form-label">Selling Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" placeholder="Selling Price" aria-label="Amount (to the nearest dollar)" id="selling_price" name="selling_price" autocomplete="off"
                                required />
                                <span class="input-group-text">.00</span>
                            </div>
                            <label for="annotation" class="form-label">Annotation</label>
                            <textarea class="form-control" aria-label="Annotation"id="annotation" name="annotation" autocomplete="off" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="active" value="0">
                            <input type="checkbox" class="form-check-input" id="active" name="active" value="1"
                                checked>
                            <label class="form-check-label" for="active">Status</label>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Save</button>
                    </form>
                </div>
            </div>
        </div>

    @endsection
