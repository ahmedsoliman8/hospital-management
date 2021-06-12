@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
   {{__('ambulance.edit_ambulance')}}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">   {{__('ambulance.ambulance')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">   {{__('ambulance.edit_ambulance')}}</span>
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
                <form action="{{route('ambulances.update','test')}}" method="post">
                    @method('PUT')
                    @csrf
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('ambulance.' . $localeCode . '.driver_name')}}</label>
                            <input type="text" name="{{ $localeCode }}[driver_name]" class="form-control" value="{{  $ambulance->translateOrNew($localeCode)->driver_name  }}">
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col">
                            <label>{{__('ambulance.car_number')}}</label>
                            <input type="text" name="car_number"  value="{{$ambulance->car_number}}" class="form-control @error('car_number') is-invalid @enderror">
                            <input type="hidden" name="id" value="{{$ambulance->id}}">
                        </div>

                        <div class="col">
                            <label>{{__('ambulance.car_model')}}</label>
                            <input type="text" name="car_model"  value="{{$ambulance->car_model}}" class="form-control @error('car_model') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{__('ambulance.car_year_made')}}</label>
                            <input type="number" name="car_year_made"  value="{{$ambulance->car_year_made}}" class="form-control @error('car_year_made') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{__('ambulance.car_type')}}</label>
                            <select class="form-control" name="car_type">
                                <option value="1" {{$ambulance->car_type == 1 ? 'selected':''}}>مملوكة</option>
                                <option value="2" {{$ambulance->car_type == 2 ? 'selected':''}}>ايجار</option>
                            </select>
                        </div>

                    </div>
                    <br>

                    <div class="row">


                        <div class="col-6">
                            <label>{{__('ambulance.driver_license_number')}}</label>
                            <input type="number" name="driver_license_number"  value="{{$ambulance->driver_license_number}}" class="form-control @error('driver_license_number') is-invalid @enderror">
                        </div>

                        <div class="col-6">
                            <label>{{__('ambulance.driver_phone')}}</label>
                            <input type="number" name="driver_phone"  value="{{$ambulance->driver_phone}}" class="form-control @error('driver_phone') is-invalid @enderror">
                        </div>

                    </div>

                    <br>


                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                        <div class="form-group">
                            <label>{{trans('ambulance.' . $localeCode . '.notes')}}</label>
                            <input type="text" name="{{ $localeCode }}[notes]" class="form-control" value="{{  $ambulance->translateOrNew($localeCode)->notes }}">
                        </div>
                    @endforeach

                    <br>
                    <div class="row">
                        <div class="col">
                            <label>{{__('ambulance.status')}}</label>
                            &nbsp;
                            <input name="is_available" {{$ambulance->is_available == 1 ? 'checked' : ''}} value="{{$ambulance->is_available}}" type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </div>

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
