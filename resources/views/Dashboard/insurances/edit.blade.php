@extends('Dashboard.layouts.master')
@section('css')

    <!--Internal   Notify -->
    <link href="{{ URL::asset('Admin/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
@endsection
@section('title')
    {{trans('insurance.edit_insurance')}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{trans('main-sidebar_trans.Services')}}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('insurance.Insurance')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form action="{{route('insurances.update','test')}}" method="post">
                        @method('PUT')
                        @csrf

                        {{-- input hidden value => id   --}}
                        <input type="hidden" name="id" value="{{$insurance->id}}">

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                            <div class="form-group">
                                <label>{{trans('insurance.' . $localeCode . '.name')}}</label>
                                <input type="text" name="{{ $localeCode }}[name]" class="form-control" value="{{  $insurance->translateOrNew($localeCode)->name }}">
                            </div>
                        @endforeach



                        <div class="row">

                            <div class="col">
                                <label>{{trans('insurance.conpany_code')}}</label>
                                <input type="text" name="insurance_code" value="{{$insurance->insurance_code}}"
                                       class="form-control @error('insurance_code') is-invalid @enderror">
                                @error('insurance_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                         {{--    <div class="col">
                                <label>{{trans('insurance.Company_name')}}</label>
                                <input type="text" name="name" value="{{$insurance->name}}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>--}}

                        </div>

                        <br>

                        <div class="row">

                            <div class="col">
                                <label>{{trans('insurance.discount_percentage')}} %</label>
                                <input type="number" name="discount_percentage" value="{{$insurance->discount_percentage}}"
                                       class="form-control @error ('discount_percentage') is-invalid @enderror">
                                @error('discount_percentage')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col">
                                <label>{{trans('insurance.insurance_bearing_percentage')}} %</label>
                                <input type="number" name="Company_rate"
                                    value="{{$insurance->Company_rate}}"  class="form-control @error ('Company_rate') is-invalid @enderror">
                                @error('Company_rate')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <br>

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties )
                            <div class="form-group">
                                <label>{{trans('insurance.' . $localeCode . '.notes')}}</label>
                                <input type="text" name="{{ $localeCode }}[notes]" class="form-control" value="{{  $insurance->translateOrNew($localeCode)->notes }}">
                            </div>
                        @endforeach

                        <br>

                        <div class="row">
                            <div class="col">
                                <label>حالة التفعيل</label>
                                 &nbsp;
                                <input name="status" {{$insurance->status == 1 ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input" id="exampleCheck1">
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success">{{trans('insurance.save')}}</button>
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
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Admin/assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Admin/assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
