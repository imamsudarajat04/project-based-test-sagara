@extends('layouts.DashboardLayout')

@section('title', 'Transactions')
@section('transactions', 'active')

@push('custom-css')
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="{!! asset('vendor/datatables/dataTables.bootstrap4.min.css') !!}">

    <!-- SweetAlert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
        <a href="{!! route('transactions.create') !!}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Create new transaction
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap w-100 display" id="tableTransactions">
                            <thead>
                                <tr>
                                    <th width="70px">No</th>
                                    <th>Service Name</th>
                                    <th>Product Name</th>
                                    <th>Customer Name</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Created Name</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <!-- Page custom scripts -->
    <script src="{!! asset('vendor/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('vendor/datatables/dataTables.bootstrap4.min.js') !!}"></script>

    <script>
        // DataTable
        var tableTransactions = $('#tableTransactions').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: '{!! url()->current() !!}',
            order: [
                [1, 'asc']
            ],
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    width: '1%',
                    orderable: false,
                    searchable: false
                },
                {
                    name: 'services',
                    data: 'services',
                },
                {
                    data: 'products',
                    name: 'products',
                },
                {
                    data: 'customer_name',
                    name: 'customer_name',
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    searchable: false,
                },
                {
                    data: 'total',
                    name: 'total',
                    searchable: false,
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'users',
                    name: 'users',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                }
            ],
            sDom: '<"secondBar d-flex flex-w1rap justify-content-between mb-2";f>rt<"bottom"p>',
            "fnCreatedRow": function(nRow, data) {
                $(nRow).attr('id', 'transaction' + data.id);
            },
        });

        // Delete Transaction
        $(document).on('click', '#remove-btn', function () {
            let id = $(this).data('id');
            let token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('transactions') }}" + '/' + id,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': token,
                        },
                        success: function (data) {
                            $('#transaction' + id).remove();
                            $('#tableTransactions').DataTable().ajax.reload();
                            $('#tableTransactions').DataTable().draw();
                            
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        },
                        error: function (data) {
                            Swal.fire(
                                'Error!',
                                'There is an error!',
                                'error'
                            );
                        }
                    });
                }
            })
        });
    </script>
@endpush