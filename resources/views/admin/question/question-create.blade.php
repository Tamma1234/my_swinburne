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
                                Create Exam Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ route('question.store') }}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Question Name:</label>
                                    <input type="text" name="question_type_name" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="Enter Question Type Name" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Question Content:</label>
                                    <input type="text" name="question_content" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="Enter Question Content" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>File Image:</label>
                                    <input type="text" name="file_image" class="form-control"
                                           placeholder="Enter File Image" >
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('question.question')}}" class="btn btn-secondary">Cancel</a>
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
