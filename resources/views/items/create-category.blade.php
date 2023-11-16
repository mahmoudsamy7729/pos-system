@extends('layouts.master')
@section('title','Add Item Category')
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
                                    <h4 class="nk-block-title fw-normal">{{__('new category')}} <small style="font-size:0.9rem" class="text-muted">{{__('enter category data')}}.</small></h4>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block nk-block-lg">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <div class="preview-block">
                                            <form method="POST" action="{{route('items.category.add.form.save')}}" enctype="multipart/form-data" class="row gy-4">
                                                @csrf
                                                
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="category_name">{{__('category name')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-pen2"></em>                                                            </div>
                                                            <input required type="text" class="form-control" id="category_name" placeholder="{{__('category name')}}" name="name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="desctiption">{{__('description')}}</label>
                                                        <div class="form-control-wrap">
                                                            <textarea  class="form-control no-resize" id="desctiption" name="description"></textarea>
                                                        </div>
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