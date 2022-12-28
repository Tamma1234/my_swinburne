@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Exam Options
                </h3>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <a href="{{ route('exam.create') }}" class="btn pull-right hidden-sm-down btn-success"><i
                        class="mdi mdi-plus-circle"></i>Create</a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead >
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Type Exam</th>
                            <th>Time</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exam as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->date_test}}</td>
                                <td>{{$item->groups ? $item->groups->name : ""}}</td>
                                <td>{{$item->groups ? $item->groups->time : ""}}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('exam.restore', ['id' => $item->id]) }}" data-toggle="tooltip"
                                       data-original-title="Edit"><i class="flaticon2-refresh-1"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"
                         style="margin-left: 450px">
                        {{--                    {{ $questions->links('pagination::bootstrap-4') }}--}}
                    </div>
                </div>
            </div>

            <!--end::Section-->
        </div>
    </div>

@endsection
