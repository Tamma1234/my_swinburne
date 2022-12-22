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
                    <form class="kt-form kt-form--label-right" action="{{ route('exam.store') }}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Date:</label>
                                    <input type="date" name="date_test" class="form-control"
                                           placeholder="Enter Name" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Type Test:</label>
                                    <select class="form-control" name="time_id">
                                        <option value="">Choose Type</option>
                                        @foreach($group_test as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Question Test:</label>
                                    <select class="form-control question" name="question_type" >
                                        <option value="">Choose Question Type</option>
                                        @foreach($questionType as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Question:</label>
                                    <select multiple placeholder="Question Select" name="question_id[]"
                                            data-search="true" data-silent-initial-value-set="true" id="multipleSelect">
                                        <option value="">Choose Question</option>
{{--                                        @foreach($questions as $item)--}}
{{--                                            <option value="{{ $item->id }}">{{ $item->question_content }}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('province.index')}}" class="btn btn-secondary">Cancel</a>
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
    <script src="{{ asset('assets/js/virtual-select.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.question').on('change', function () {
                var id =  $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('exam.get') }}",
                    method: 'POST',
                    data: { id:id, _token:_token },
                    success:function (data) {
                        let d = "";
                        $.each(data, function (k, v) {
                           d += '<option value="'+k["id"]+'">'+v["question_content"]+'</option>'
                        })
                      $('#multipleSelect').html(d);
                    }
                });
            })
        })
        VirtualSelect.init({
            ele: '#multipleSelect'
        });
    </script>
@endsection
