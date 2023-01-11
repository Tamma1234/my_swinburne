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
                                Create Question Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ route('question.store') }}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body" >
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Question Type:</label>
                                    <select class="form-control" name="question_type">
                                        <option value="">Choose Question Type</option>
                                        @foreach($questionType as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="file" name="file_image" class="form-control"
                                           placeholder="Enter File Image" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Type Answers:</label>
                                    <select class="form-control" name="type_answers">
                                        <option value="">Choose Type Answers</option>
                                            <option value="0">0</option>
                                            <option value="1">2</option>
                                            <option value="2">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="card-border-primary mb-3 col-md-12">
                                        <div class="row" id="modul-row">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--success">
                                                    <input class="checkbox_wraper custom-control-input" type="text">Answers
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="permission-row">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a type="button" onclick="createAnswers()" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
                                    </g>
                                </svg>
                            </a>
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
@section('script')
    <script>
       function createAnswers() {
           var answers = document.getElementById('permission-row');
           var div = document.createElement('div');
           div.setAttribute('class', 'form-group col-md-6')
           var create = document.createElement('input');
           create.setAttribute("class", "form-control");
           create.setAttribute("type", "text");
           create.setAttribute("name", "answers[]");
           create.setAttribute("placeholder", "Enter Answers");


           div.appendChild(create);
           answers.appendChild(div);
       }
    </script>
@endsection
