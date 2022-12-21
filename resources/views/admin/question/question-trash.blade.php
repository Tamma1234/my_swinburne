@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Question Delete Options
                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Question Type Name</th>
                            <th>Question Content</th>
                            <th>File Image</th>
                            <th>Type Answers</th>
                            <th class="text-nowrap"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($question as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->question_type_name}}</td>
                                <td>{{$item->question_content}}</td>
                                <td>{{$item->file_image}}</td>
                                <td>{{$item->type_answers}}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('question.edit', ['id' => $item->id]) }}" data-toggle="tooltip"
                                       data-original-title="Edit"><i class="flaticon-edit"></i>
                                    </a>
                                    <a href="{{ route('question.delete', ['id' => $item->id]) }}" data-toggle="tooltip"
                                       data-original-title="Close"> <i class="flaticon-delete"></i> </a>
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
