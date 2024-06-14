@extends('layouts.super-admin.master')

@section('super-admin')

    @if(session("success"))
        <div class="alert alert-success" role="alert">
            {{session("success")}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card p-3">
        <div class="card-header align-items-center">
            <h3 class="fw-bolder m-0">Ratings</h3>
        </div>
        <div class="card-body">
            <table id="tax_table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                <tr class="fw-bolder fs-6 px-7">
                    <th>Restaurant Name</th>
                    <th>Buyer Name</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Is Hide?</th>
                    <th class="d-flex justify-content-end pe-5">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ratings as $rating)
                    <tr>
                        <td>{{ $rating->vendor->name ?? "" }}</td>
                        <td>{{ $rating->buyer->name ?? "" }}</td>
                        <td>{{ $rating->rating }}</td>
                        <td>{{ $rating->comment }}</td>
                        <td><input type="checkbox" disabled <?php if($rating->is_hide): ?> checked <?php endif; ?> /></td>
                        <td class="text-end pe-5">
                            <div class="dropdown">
                                <a class="dots-btn rounded-circle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fs-4"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <form action="{{ route(!$rating->is_hide ? 'super.admin.ratings.hide' : 'super.admin.ratings.show', $rating->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <li><button class="dropdown-item {{ !$rating->is_hide ? 'hideBtn' : 'showBtn'}}">{{ !$rating->is_hide ? 'Hide' : 'Show'}}</button></li>
                                    </form>
                                    <form action="{{ route('super.admin.ratings.destroy', $rating->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <li><button class="dropdown-item deleteBtn">Delete</button></li>
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@push('super-admin-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".hideBtn").click(function(e){
                e.preventDefault()
                const form = $(this).parent().parent();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure you want to hide this comment?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            })


            $(".deleteBtn").click(function(e){
                e.preventDefault()
                const form = $(this).parent().parent();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure you want to delete?',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            })
        });
    </script>
@endpush
