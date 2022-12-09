@extends('admin.layouts.main')
@section('title', 'Edit')

@section('content')

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create Wards Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ route('wards.update', ['id' => $wards->id]) }}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Name:</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Enter Name" value="{{ $wards->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Type:</label>
                                    <input type="text" name="type" class="form-control"
                                           placeholder="Enter Type" value="{{ $wards->type }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Province:</label>
                                    <input type="text" name="district_id" class="form-control"
                                           placeholder="Enter Province" value="{{ $wards->districts ? $wards->districts->name : "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('wards.index')}}" class="btn btn-secondary">Cancel</a>
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
