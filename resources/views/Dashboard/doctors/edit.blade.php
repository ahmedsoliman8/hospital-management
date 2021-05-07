@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('title')
    {{trans('doctors.edit_doctor')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{trans('main-sidebar_trans.doctors')}}</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{trans('doctors.edit_doctor')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @include('Dashboard.messages_alert')

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('doctors.update', 'test') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        @csrf
                        <input type="hidden" name="id" value="{{ $doctor->id }}">
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <?php $autoFocus=true;  ?>
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-1">
                                        <label>{{trans('doctors.' . $localeCode . '.name')}}</label>
                                    </div>
                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <input  {{$autoFocus?"autofocus":""}} type="text" name="{{ $localeCode }}[name]" class="form-control" value="{{ $doctor->translateOrNew($localeCode)->name }}">
                                    </div>
                                    <?php $autoFocus=false;  ?>
                                </div>
                            @endforeach



                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{trans('doctors.email')}}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="email" value="{{$doctor->email}}" type="email">
                                </div>
                            </div>



                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ trans('doctors.phone') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="phone" type="tel" value="{{$doctor->phone}}">
                                </div>
                            </div>


                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{trans('doctors.section')}}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="section_id" class="form-control SlectBox">
                                        <option value="" selected disabled>------</option>
                                        @foreach($sections as $section)
                                            <option {{$doctor->section_id==$section->id?"selected":""}} value="{{$section->id}}">{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{trans('doctors.appointments')}}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select multiple="multiple" class="testselect2" name="appointments[]">
                                        <option selected value="" selected disabled>-- حدد المواعيد --</option>

                                        @foreach($appointments as $appointment)
                                            <option {{in_array($appointment->id,$appointmentSelected)?"selected":""}} value="{{$appointment->id}}">{{$appointment->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>





                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ trans('doctors.doctor_photo') }}</label>
                                </div>
                                @if($doctor->image&&\File::exists('Dashboard/img/doctors/'.$doctor->image->filename))
                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                        <img style="border-radius:50%"  src="{{Url::asset('Dashboard/img/doctors/'.$doctor->image->filename)}}" width="150px" height="150px" id="output"/>
                                    </div>
                                @else
                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                        <img style="border-radius:50%"  width="150px" height="150px" id="output"/>
                                    </div>
                                @endif

                            </div>



                            <button type="submit"
                                    class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ trans('doctors.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>


@endsection
