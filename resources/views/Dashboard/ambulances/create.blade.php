@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
   {{__('ambulance.add_ambulance')}}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('ambulance.ambulance')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">{{__('ambulance.add_ambulance')}}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{route('ambulances.store')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>{{__('ambulance.car_number')}}</label>
                            <input type="text" name="car_number"  value="{{old('car_number')}}" class="form-control @error('car_number') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{__('ambulance.car_model')}}</label>
                            <input type="text" name="car_model"  value="{{old('car_model')}}" class="form-control @error('car_model') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{__('ambulance.car_year_made')}}</label>
                            <input type="number" name="car_year_made"  value="{{old('car_year_made')}}" class="form-control @error('car_year_made') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{__('ambulance.car_type')}}</label>
                            <select class="form-control" name="car_type">
                                <option value="1">مملوكة</option>
                                <option value="2">ايجار</option>
                            </select>
                        </div>

                    </div>
                    <br>

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('ambulance.' . $localeCode . '.driver_name')}}</label>
                            <input type="text" name="{{ $localeCode }}[driver_name]" class="form-control" value="{{ old($localeCode . '.driver_name') }}">
                        </div>
                    @endforeach

                    <br/>

                    <div class="row">


                        <div class="col-6">
                            <label>{{__('ambulance.driver_license_number')}}</label>
                            <input type="number" name="driver_license_number"  value="{{old('driver_license_number')}}" class="form-control @error('driver_license_number') is-invalid @enderror">
                        </div>

                        <div class="col-6">
                            <label>{{__('ambulance.driver_phone')}}</label>
                            <input type="number" name="driver_phone"  value="{{old('driver_phone')}}" class="form-control @error('driver_phone') is-invalid @enderror">
                        </div>

                    </div>

                    <br>

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('ambulance.' . $localeCode . '.notes')}}</label>
                            <textarea type="text" name="{{ $localeCode }}[notes]" class="form-control" >{{ old($localeCode . '.notes') }}</textarea>
                        </div>
                    @endforeach

                    <br>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">{{__('ambulance.save')}}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
