@extends('clients.layouts.main')
@section('title', 'Create')

@section('content')
    @include('clients.templates.content-header', ['name' => 'Swinburne', 'key' => 'Queries', 'value' => "", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::App-->
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
            <!--Begin:: App Aside Mobile Toggle-->
            <!--End:: App Aside-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">Account Information</h3>
                                </div>
                            </div>
                            <form class="kt-form kt-form--label-right"
                                  action="{{ route('update.profile', ['id' => $user->id]) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                {!! QrCode::format('svg')->merge('qr-code/'.$user->path , 0.3, true)->size(200)->generate(route('profile.detail', ['hash' => $user->hash_id])); !!}
                                            </div>
                                            <a href="{{ route('profile.download', ['file' => $user->path]) }}" class="btn btn-info" target="_blank" download="{{ $user->path }}">Download</a>
                                            <div></div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Họ và tên:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                           value="{{ $user->full_name }}" name="full_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Email:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" disabled
                                                           value="{{ $user->email }}" name="email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Số điện thoại:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" name="phone_number"
                                                           value="{{ $user->phone_number }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Địa chỉ:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                           value="{{ $user->address }}" name="address">
                                                </div>
                                            </div>
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <h2 class="col-xl-3 col-lg-3">Các chương trình đào tạo</h2>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <label class="col-xl-3 col-lg-3 col-form-label">Công nghệ thông tin:</label>--}}
                                            {{--                                                <div class="col-lg-9 col-xl-6">--}}
                                            {{--                                                    <select class="custom-select form-control">--}}
                                            {{--                                                        <option selected>Chọn</option>--}}
                                            {{--                                                        <option value="1">Phát triển phần mềm</option>--}}
                                            {{--                                                        <option value="2">Trí tuệ nhân tạo</option>--}}
                                            {{--                                                        <option value="3">Internet of Things(IoT)</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <label class="col-xl-3 col-lg-3 col-form-label">Kinh doanh:</label>--}}
                                            {{--                                                <div class="col-lg-9 col-xl-6">--}}
                                            {{--                                                    <select class="custom-select form-control">--}}
                                            {{--                                                        <option selected>Chọn</option>--}}
                                            {{--                                                        <option value="1">Quản trị kinh doanh</option>--}}
                                            {{--                                                        <option value="1">Kinh doanh quốc tế</option>--}}
                                            {{--                                                        <option value="2">Marketing</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <label class="col-xl-3 col-lg-3 col-form-label">Truyền thông đa phương tiện:</label>--}}
                                            {{--                                                <div class="col-lg-9 col-xl-6">--}}
                                            {{--                                                    <select class="custom-select form-control">--}}
                                            {{--                                                        <option selected>Chọn</option>--}}
                                            {{--                                                        <option value="1">Truyền thông xã hội</option>--}}
                                            {{--                                                        <option value="1">Quảng cáo</option>--}}
                                            {{--                                                        <option value="2">Quan hệ công chúng</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">1. Các ngành học hiện nay
                                                    ở Swinburne Việt Nam, bạn quan tâm đến ngành nào:</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Công nghệ thông tin:</label>
                                                <div class="col-9">
                                                    <div class="kt-radio-inline">
                                                        @foreach($information as $item)
                                                            @if($user->hasInformation != null)
                                                                <label class="kt-radio">
                                                                    <input type="radio"
                                                                           {{ $item->id == $user->hasInformation->id ? 'checked' : 0 }} name="information_id"
                                                                           value="{{ $item->id }}"> {{ $item->industry_name }}
                                                                    <span></span>
                                                                </label>
                                                            @else
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="information_id"
                                                                           value="{{ $item->id }}"> {{ $item->industry_name }}
                                                                    <span></span>
                                                                </label>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Kinh doanh:</label>
                                                <div class="col-9">
                                                    <div class="kt-radio-inline">
                                                        @foreach($business as $item)
                                                            @if($user->hasBusiness != null)
                                                                <label class="kt-radio">
                                                                    <input type="radio"
                                                                           {{ $item->id == $user->hasInformation->id ? 'checked' : 0 }} name="information_id"
                                                                           value="{{ $item->id }}"> {{ $item->industry_name }}
                                                                    <span></span>
                                                                </label>
                                                            @else
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="information_id"
                                                                           value="{{ $item->id }}"> {{ $item->industry_name }}
                                                                    <span></span>
                                                                </label>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label ">Truyền thông đa phương
                                                    tiện:</label>
                                                <div class="col-9">
                                                    <div class="kt-radio-inline">
                                                        @foreach($media as $item)
                                                            @if($user->hasMedia != null)
                                                                <label class="kt-radio">
                                                                    <input type="radio"
                                                                           {{ $item->id == $user->hasInformation->id ? 'checked' : 0 }} name="information_id"
                                                                           value="{{ $item->id }}"> {{ $item->industry_name }}
                                                                    <span></span>
                                                                </label>
                                                            @else
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="information_id"
                                                                           value="{{ $item->id }}"> {{ $item->industry_name }}
                                                                    <span></span>
                                                                </label>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">2. Kế hoạch
                                                    sau khi thi
                                                    THPT Quốc gia của bạn:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 1 ? 'checked' : "" }} name="after_exam"
                                                                   value="1"> Du học
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 2 ? 'checked' : "" }} name="after_exam"
                                                                   value="2"> Học ĐH Quốc tế
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 3 ? 'checked' : "" }} name="after_exam"
                                                                   value="3"> Học ĐH công lập
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 4 ? 'checked' : "" }} name="after_exam"
                                                                   value="4"> Khác
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">3. Tham gia ký
                                                    chuyển tiếp
                                                    quốc tế với Swinburne Australia:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->transition == 1 ? 'checked' : "" }} name="transition"
                                                                   value="1"> Có
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->transition == 2 ? 'checked' : "" }} name="transition"
                                                                   value="2"> Không
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">4. Trình độ
                                                    tiếng Anh của
                                                    bạn hiện nay:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->english_level == 1 ? 'checked' : "" }} name="english_level"
                                                                   value="1"> Trung bình
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->english_level == 2 ? 'checked' : "" }} name="english_level"
                                                                   value="2"> Khá
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->english_level == 3 ? 'checked' : "" }} name="english_level"
                                                                   value="3"> Tốt
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">Chứng chỉ quốc
                                                    tế
                                                    IELTS/TOEFL/PTE thi gần nhất đạt:</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-1 col-lg-2 col-form-label">IELTS:</label>
                                                <div class="col-lg-2 col-xl-2">
                                                    <input class="form-control" type="text" name="ielts"
                                                           value="{{ $user->ielts }}">
                                                </div>
                                                <label class="col-xl-1 col-lg-2 col-form-label">TOEFL:</label>
                                                <div class="col-lg-2 col-xl-2">
                                                    <input class="form-control" type="text" name="toefl"
                                                           value="{{ $user->toefl }}">
                                                </div>
                                                <label class="col-xl-1 col-lg-2 col-form-label">Khác:</label>
                                                <div class="col-lg-2 col-xl-2">
                                                    <input class="form-control" type="text" name="certificate"
                                                           value="{{ $user->certificate }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left"> 5. Bạn có
                                                    thích được tham
                                                    gia hoạt động sinh viên, thực tế tại doanh nghiệp và môi trường trải
                                                    nghiệm quốc tế không ?</label>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline text-center">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->participation == 1 ? 'checked' : "" }} name="participation"
                                                                   value="1"> Rất thích tham gia
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->participation == 2 ? 'checked' : "" }} name="participation"
                                                                   value="2"> Bình hường
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->participation == 3 ? 'checked' : "" }} name="participation"
                                                                   value="3"> Không thích tham gia
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">6. Bạn có quan tâm đến kỳ
                                                    thi tuyển học bổng "Thắp sáng tương lai" của Swinburne không?</label>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline text-center">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->scholarship_exam == 1 ? 'checked' : "" }} name="scholarship_exam"
                                                                   value="1"> Có
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->scholarship_exam == 2 ? 'checked' : "" }} name="scholarship_exam"
                                                                   value="2"> Không
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->scholarship_exam == 3 ? 'checked' : "" }} name="scholarship_exam"
                                                                   value="3"> Em muốn tư vấn thêm
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="kt-form__actions text-center">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--End:: App Content-->
        </div>

        <!--End::App-->
    </div>
@endsection



