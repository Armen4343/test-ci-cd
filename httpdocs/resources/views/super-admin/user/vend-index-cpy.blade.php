@extends('layouts.super-admin.master')

 @section('super-admin')

<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users
                </h3>
                <a href="{{ route('add.user', 'vendor') }}" class="btn btn-success text-white"> <span> <i class="fa fa-plus-circle"></i> </span> Add user </a>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered text-nowrap key-buttons">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Sr.No</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Email</th>
                                    <th class="border-bottom-0">Phone</th>
                                    <th class="border-bottom-0">Role</th>
                                    <!-- <th class="border-bottom-0">Profile</th> -->
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr = 1;
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                         <td>{{ $sr++ }}</td>
                                           <td>{{ $user->name }}</td>
                                           <td>{{ $user->email }}</td>
                                           <td>{{ $user->phone }}</td>

                                            <td ><span class="badge bg-primary px-3 ">{{ $user->role }}</span> </td>

                                            <td>Active</td>

                                         <td>{{ $user->created_at }}</td>
                                         <td>
                                             <a href="{{ url('super-admin/user/edit/'.$user->id) }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit "></i></a>
                                             <a href="{{ url('super-admin/user/delete/'.$user->id) }}" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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
</div>

@endsection

