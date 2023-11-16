@extends('layouts.master')
@section('title','Add User')
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
                                    <h4 class="nk-block-title fw-normal">Create User <small style="font-size:0.9rem" class="text-muted">Enter User Information.</small></h4>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block nk-block-lg">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <div class="preview-block">
                                            <form method="POST" action="{{route('users.add.form.save')}}" enctype="multipart/form-data" class="row gy-4">
                                                @csrf
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="full-name">Full name</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-user"></em>
                                                            </div>
                                                            <input required type="text" class="form-control" id="full-name" placeholder="Full Name" name="name" value="{{ old('name') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="mobile">Mobile</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-mobile"></em>
                                                            </div>
                                                            <input required type="text" class="form-control" id="mobile" placeholder="Mobile" name="mobile" value="{{ old('mobile') }}">
                                                        </div>
                                                        @if($errors->has('mobile'))
                                                            <span  class="invalid">{{ $errors->first('mobile') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="role">Role</label>
                                                        <div class="form-control-wrap ">
                                                                <select required class="form-select" id="role" name="role" value="{{ old('role') }}">
                                                                    <option value="" selected>-select-</option>
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{$role->slug}}">{{$role->slug}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-lock"></em>
                                                            </div>
                                                            <input required type="password" class="form-control" id="mobile" placeholder="Password" name="password" value="{{ old('password') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-3 text-center">
                                                    <div class="col-12 ">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="btn btn-small btn-primary">Save</button>
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