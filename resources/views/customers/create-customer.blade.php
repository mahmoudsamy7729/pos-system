@extends('layouts.master')
@section('title','Add Customer')
@section('content')
    @include('partials.sidebar')
    <div class="nk-wrap">
        @include('partials.header')
        <div class="nk-content">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="components-preview wide-md mx-auto">
                            <div class="nk-block-head nk-block-head-lg wide-sm" style="padding-bottom: 0.5rem">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title fw-normal">{{__('new customer')}} <small style="font-size:0.9rem" class="text-muted">{{__('enter customer information')}}.</small></h4>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block nk-block-lg">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <div class="preview-block">
                                            <form method="POST" action="{{route('customers.add.form.save')}}" enctype="multipart/form-data" class="row gy-4">
                                                @csrf
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="full-name">{{__('full name')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-user"></em>
                                                            </div>
                                                            <input required type="text" class="form-control" id="full-name" placeholder="{{__('full name')}}" name="name" value="{{ old('name') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Email">{{__('mail')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-mobile"></em>
                                                            </div>
                                                            <input  type="text" class="form-control" id="Email" placeholder="{{__('mail')}}" name="email" value="{{ old('email') }}">
                                                        </div>
                                                        @if($errors->has('email'))
                                                            <span  class="invalid">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="PhoneNumber">{{__('phone number')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-mobile"></em>
                                                            </div>
                                                            <input  required type="text" class="form-control" id="PhoneNumber" placeholder="{{__('phone number')}}" name="phone" value="{{ old('phone') }}">
                                                        </div>
                                                        @if($errors->has('phone'))
                                                            <span  class="invalid">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row g-3 text-center">
                                                    <div class="col-12 ">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="btn btn-small btn-primary">{{__('save')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection