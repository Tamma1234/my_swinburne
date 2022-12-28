@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Table User Options
            </h3>
        </div>

    </div>
    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="example"">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type </th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($provinces as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->type}}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('province.restore', ['id' => $item->id]) }}" data-toggle="tooltip"
                                   data-original-title="Edit"><i class="flaticon2-refresh-1"></i>
                                </a>
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
