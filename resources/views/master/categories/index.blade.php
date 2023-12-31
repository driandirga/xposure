@extends('layouts/contentNavbarLayout')

@section('title', 'Master - Categories')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Categories
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Categories</h6>
                    <a href="{{ route('master.categories.create') }}" class="btn btn-primary btn-sm font-weight-bold text-xs float-end"
                        data-toggle="tooltip" data-original-title="Add Category">
                        Add
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
                                        Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 "
                                        width="15%">Initial</th>
                                    <th class="text-secondary opacity-7" width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $k => $category)
                                    <tr>
                                        <td class="text-center">{{ $k + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->initial }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('master.categories.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm font-weight-bold text-xs"
                                                data-toggle="tooltip">
                                                Edit
                                            </a>
                                            <a href="javascript:;"
                                                class="btn btn-danger btn-sm font-weight-bold text-xs delete"
                                                data-toggle="tooltip" data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}">
                                                Delete
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

    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
        aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Notification <i class="ni ni-bell-55"></i></h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <h4 class="text-secondary mt-4">Delete Data <span class="text-danger" id="name">Categories</span>
                        </h4>
                        <p>Are you sure you want to delete data?</p>
                        <input type="hidden" id="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-white" id="submitDelete">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.delete').on('click', function() {
                let id = $(this).data('id')
                let name = $(this).data('name')

                $('#modal-notification #id').val(id)
                $('#modal-notification #name').text(name)
                $('#modal-notification').modal('show')
            })

            $('#submitDelete').on('click', function() {
                let id = $('#modal-notification #id').val();
                let name = $('#modal-notification #name').text()
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: "categories/" + id,
                    type: 'DELETE',
                    data: {
                        id: id,
                        _token: token,
                        _method: "DELETE",
                    },
                    cache: false,
                    success: function(result) {
                        if (result) {
                            $('#modal-notification').modal('hide');
                            Swal.fire(
                                'Delete Data',
                                `${name} Success`,
                                'success'
                            ).then(function() {
                                window.location.href = "{{ route('master.categories.index') }}";
                            });
                        }
                        console.log("it Works");
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });

        function getDataCategories() {
            $.ajax({
                url: '/master/categories/get', // Sesuaikan dengan URL rute "categories/nama"
                method: 'GET',
                success: function(result) {
                    console.log(result);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
