@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Province', 'value' => "List User", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label col-md-2">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        List Province
                    </h3>
                </div>
                <div class="col-md-6 col-4 align-self-center">
                    <a href="{{ route('province.create') }}" class="btn pull-right hidden-sm-down btn-success"><i
                            class="mdi mdi-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="kt-portlet__body" id="table-room">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($provinces as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->type}}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('province.edit', ['id' => $item->id]) }}" data-toggle="tooltip"
                                           data-original-title="Edit"><i class="flaticon-edit"></i>
                                        </a>
                                        <a href="{{ route('province.delete', ['id' => $item->id]) }}" data-toggle="tooltip"
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
                            {{--                        {{ $getEvent->links('pagination::bootstrap-4') }}--}}
                        </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>
        </div>
    </div>

@endsection


