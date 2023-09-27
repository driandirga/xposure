@extends('layouts/contentNavbarLayout')

@section('title', 'Sales - Add Salesman')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Sales /</span> Add Salesman
    </h4>

    <div class="row">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Add Salesman</h5>
                </div>
                <div class="card-body pt-0 pb-2">
                    <form action="{{ route('sales.salesmen.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                                required>
                            <label for="initial" class="form-label">Initial</label>
                            <input type="text" class="form-control" id="initial" name="initial" autocomplete="off"
                                required>
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" autocomplete="off"
                                required>
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" autocomplete="off"
                                required>
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
