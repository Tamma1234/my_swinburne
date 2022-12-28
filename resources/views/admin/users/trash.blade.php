@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Table User Options
            </h3>
        </div>

    </div>
    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example"">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Middlename</th>
                        <th>Givenname</th>
                        <th>Email</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->full_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td class="text-nowrap">
                                <a href="{{route('users.restore', ['id' => $user->id])}}" data-toggle="tooltip"
                                   data-original-title="Close"> <i class="flaticon2-refresh-1"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <!--end::Section-->
    </div>
</div>
@endsection
