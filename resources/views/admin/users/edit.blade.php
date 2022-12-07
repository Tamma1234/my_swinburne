@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit User Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('users.update', ['id' => $user->id])}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Full Name:</label>
                                    <input type="text" name="full_name" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Full Name" value="{{$user->full_name}}">
                                </div>
                                <div class="col-lg-6">
                                    <label>Email:</label>
                                    <input type="text"  name="email" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Email" value="{{$user->email}}" >
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Address:</label>
                                    <input type="text" name="address" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="Enter User Address" value="{{$user->address}}">
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-lg-6">
                                    <label>Phone Number:</label>
                                    <input type="text" name="phone_number" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="Enter Phone Number" value="{{$user->phone_number}}">
                                </div>
                                @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('admin.dashboard')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection
