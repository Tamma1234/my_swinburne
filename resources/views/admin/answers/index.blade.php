@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Answers Options
                </h3>
            </div>
            <div class="col-md-6 col-4 align-self-center">
                <a href="{{ route('answers.create') }}" class="btn pull-right hidden-sm-down btn-success"><i
                        class="mdi mdi-plus-circle"></i> Create</a>
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
                            <th>Answers</th>
                            <th>Question Name</th>
                            <th>File Image</th>
                            <th class="text-nowrap"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($answers as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->answers}}</td>
                                <td>{{$item->questions ? $item->questions->question_content : ""}}</td>
                                <td>{{$item->file_image}}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('answers.edit', ['id' => $item->id]) }}" data-toggle="tooltip"
                                       data-original-title="Edit"><i class="flaticon-edit"></i>
                                    </a>
                                    <a href="{{ route('answers.delete', ['id' => $item->id]) }}" data-toggle="tooltip"
                                       data-original-title="Close"> <i class="flaticon-delete"></i> </a>
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
                        {{ $answers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            <!--end::Section-->
        </div>
    </div>

@endsection
