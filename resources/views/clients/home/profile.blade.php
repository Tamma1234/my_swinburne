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
                                                <label class="col-xl-3 col-lg-3 col-form-label">H??? v?? t??n:</label>
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
                                                <label class="col-xl-3 col-lg-3 col-form-label">S??? ??i???n tho???i:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text" name="phone_number"
                                                           value="{{ $user->phone_number }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">?????a ch???:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                           value="{{ $user->address }}" name="address">
                                                </div>
                                            </div>
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <h2 class="col-xl-3 col-lg-3">C??c ch????ng tr??nh ????o t???o</h2>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <label class="col-xl-3 col-lg-3 col-form-label">C??ng ngh??? th??ng tin:</label>--}}
                                            {{--                                                <div class="col-lg-9 col-xl-6">--}}
                                            {{--                                                    <select class="custom-select form-control">--}}
                                            {{--                                                        <option selected>Ch???n</option>--}}
                                            {{--                                                        <option value="1">Ph??t tri???n ph???n m???m</option>--}}
                                            {{--                                                        <option value="2">Tr?? tu??? nh??n t???o</option>--}}
                                            {{--                                                        <option value="3">Internet of Things(IoT)</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <label class="col-xl-3 col-lg-3 col-form-label">Kinh doanh:</label>--}}
                                            {{--                                                <div class="col-lg-9 col-xl-6">--}}
                                            {{--                                                    <select class="custom-select form-control">--}}
                                            {{--                                                        <option selected>Ch???n</option>--}}
                                            {{--                                                        <option value="1">Qu???n tr??? kinh doanh</option>--}}
                                            {{--                                                        <option value="1">Kinh doanh qu???c t???</option>--}}
                                            {{--                                                        <option value="2">Marketing</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="form-group row">--}}
                                            {{--                                                <label class="col-xl-3 col-lg-3 col-form-label">Truy???n th??ng ??a ph????ng ti???n:</label>--}}
                                            {{--                                                <div class="col-lg-9 col-xl-6">--}}
                                            {{--                                                    <select class="custom-select form-control">--}}
                                            {{--                                                        <option selected>Ch???n</option>--}}
                                            {{--                                                        <option value="1">Truy???n th??ng x?? h???i</option>--}}
                                            {{--                                                        <option value="1">Qu???ng c??o</option>--}}
                                            {{--                                                        <option value="2">Quan h??? c??ng ch??ng</option>--}}
                                            {{--                                                    </select>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">1. C??c ng??nh h???c hi???n nay
                                                    ??? Swinburne Vi???t Nam, b???n quan t??m ?????n ng??nh n??o:</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">C??ng ngh??? th??ng tin:</label>
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
                                                <label class="col-3 col-form-label ">Truy???n th??ng ??a ph????ng
                                                    ti???n:</label>
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
                                                <label class="col-form-label btn-label text-left">2. K??? ho???ch
                                                    sau khi thi
                                                    THPT Qu???c gia c???a b???n:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 1 ? 'checked' : "" }} name="after_exam"
                                                                   value="1"> Du h???c
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 2 ? 'checked' : "" }} name="after_exam"
                                                                   value="2"> H???c ??H Qu???c t???
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 3 ? 'checked' : "" }} name="after_exam"
                                                                   value="3"> H???c ??H c??ng l???p
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->after_exam == 4 ? 'checked' : "" }} name="after_exam"
                                                                   value="4"> Kh??c
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">3. Tham gia k??
                                                    chuy???n ti???p
                                                    qu???c t??? v???i Swinburne Australia:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->transition == 1 ? 'checked' : "" }} name="transition"
                                                                   value="1"> C??
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->transition == 2 ? 'checked' : "" }} name="transition"
                                                                   value="2"> Kh??ng
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">4. Tr??nh ?????
                                                    ti???ng Anh c???a
                                                    b???n hi???n nay:</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->english_level == 1 ? 'checked' : "" }} name="english_level"
                                                                   value="1"> Trung b??nh
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->english_level == 2 ? 'checked' : "" }} name="english_level"
                                                                   value="2"> Kh??
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->english_level == 3 ? 'checked' : "" }} name="english_level"
                                                                   value="3"> T???t
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">Ch???ng ch??? qu???c
                                                    t???
                                                    IELTS/TOEFL/PTE thi g???n nh???t ?????t:</label>
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
                                                <label class="col-xl-1 col-lg-2 col-form-label">Kh??c:</label>
                                                <div class="col-lg-2 col-xl-2">
                                                    <input class="form-control" type="text" name="certificate"
                                                           value="{{ $user->certificate }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left"> 5. B???n c??
                                                    th??ch ???????c tham
                                                    gia ho???t ?????ng sinh vi??n, th???c t??? t???i doanh nghi???p v?? m??i tr?????ng tr???i
                                                    nghi???m qu???c t??? kh??ng ?</label>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline text-center">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->participation == 1 ? 'checked' : "" }} name="participation"
                                                                   value="1"> R???t th??ch tham gia
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->participation == 2 ? 'checked' : "" }} name="participation"
                                                                   value="2"> B??nh h?????ng
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->participation == 3 ? 'checked' : "" }} name="participation"
                                                                   value="3"> Kh??ng th??ch tham gia
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label btn-label text-left">6. B???n c?? quan t??m ?????n k???
                                                    thi tuy???n h???c b???ng "Th???p s??ng t????ng lai" c???a Swinburne kh??ng?</label>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="kt-radio-inline text-center">
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->scholarship_exam == 1 ? 'checked' : "" }} name="scholarship_exam"
                                                                   value="1"> C??
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->scholarship_exam == 2 ? 'checked' : "" }} name="scholarship_exam"
                                                                   value="2"> Kh??ng
                                                            <span></span>
                                                        </label>
                                                        <label class="kt-radio">
                                                            <input type="radio"
                                                                   {{ $user->scholarship_exam == 3 ? 'checked' : "" }} name="scholarship_exam"
                                                                   value="3"> Em mu???n t?? v???n th??m
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



