@extends('layouts/contentNavbarLayout')

@section('title', 'Inventory - Stocks')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Inventory /</span> Stocks
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Stocks</h6>
                    <a href="" class="btn btn-success btn-sm font-weight-bold text-xs float-end"
                        data-toggle="tooltip" data-original-title="Add Brand">
                        Eksport to Excel
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        width="5%">No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Werehouse</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 ">
                                        Product</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                                        width="15%">Debit</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                                        width="15%">Credit</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 "
                                        width="15%">Total Stock</th>
                                    <th class="text-secondary opacity-7" width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $k => $stock)
                                    <tr>
                                        <td class="text-center">{{ $k + 1 }}</td>
                                        <td>{{ $stock->warehouse_name }}</td>
                                        <td>{{ $stock->product_name }}</td>
                                        <td>{{ $stock->debit }}</td>
                                        <td>{{ $stock->credit }}</td>
                                        <td>{{ $stock->total_stock }}</td>
                                        <td class="align-middle">
                                            <a href="#"
                                                class="btn btn-primary btn-sm font-weight-bold text-xs"
                                                data-toggle="tooltip">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection