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
                                Edit Student Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('student.update', ['id' => $student->id])}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Full Name:</label>
                                    <input type="text" name="full_name" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Full Name" value="{{$student->full_name}}">
                                </div>
                                <div class="col-lg-6">
                                    <label>Email:</label>
                                    <input type="text"  name="email" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter User Email" value="{{$student->email}}" >
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Phone Number:</label>
                                    <input type="text" name="phone_number" class="form-control"
                                           placeholder="Enter Phone Number" value="{{$student->phone_number}}">
                                </div>
                                @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-lg-6">
                                    <label>Province:</label>
                                    <select class="form-control choose province" id="city" name="province_id">
                                        <option value="">Choose Province</option>
                                        @foreach($provinces as $item)
                                            <option {{ $student->provinces->id ==  $item->id ? "selected" : "" }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('province_id')
                                <div class="alert alert-solid-danger alert-bold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>District:</label>
                                    <select class="form-control choose district" id="district" name="district_id">
                                        @foreach($districts as $item)
                                            <option {{ $student->district->id == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('district_id')
                                <div class="alert alert-solid-danger alert-bold">{{ $message }}</div>
                                @enderror
                                <div class="col-lg-6">
                                    <label>Wards:</label>
                                    <select class="form-control ward" name="ward_id" id="ward">
                                        @foreach($wards as $item)
                                            <option {{ $student->wards->id ==  $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ward_id')
                                <div class="alert alert-solid-danger alert-bold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Address:</label>
                                <input type="text" name="address" class="form-control"
                                       placeholder="Enter User Address" value="{{$student->address}}">
                            </div>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
