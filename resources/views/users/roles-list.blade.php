@extends('layouts.master')
@section('title','Users List')
@section('js-files')
<script src="{{asset('assets/js/libs/datatable-btns.js')}}"></script>
@endsection
@section('content')
    @include('partials.sidebar')
    <div class="nk-wrap">
        @include('partials.header')
                        <!-- content @s -->
                        <div class="nk-content ">
                            <div class="container-fluid">
                                <div class="nk-content-inner">
                                    <div class="nk-content-body">
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-between">
                                                <div class="nk-block-head-content">
                                                    <h3 class="nk-block-title page-title">Roles List</h3>
                                                </div><!-- .nk-block-head-content -->
                                                <div class="nk-block-head-content">
                                                    <div class="toggle-wrap nk-block-tools-toggle">
                                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                        <div class="toggle-expand-content" data-content="pageMenu">
                                                            <ul class="nk-block-tools g-3">
                                                                <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                                                <li class="nk-block-tools-opt">
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a  href="{{route('roles.add.form.show')}}"><span>Add Role</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .toggle-wrap -->
                                                </div><!-- .nk-block-head-content -->
                                            </div><!-- .nk-block-between -->
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block">
                                            <div class="card card-bordered card-stretch" style="padding-right: 0">
                                                <div class="card-inner-group" style="white-space: nowrap;overflow-x: auto;">
                                                    <div class="card-inner position-relative card-tools-toggle">
                                                    <div class="card-inner p-0">
                                                        <table class="table table-bordered text-center mb-3" style="vertical-align: middle;">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('role name')}}</th>
                                                                    <th>{{__('description')}}</th>
                                                                    <th>{{__('action')}}</th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($roles as $role)
                                                                <tr>
                                                                    <td>{{$role->name}}</td>
                                                                    <td>{{$role->description}}</td>
                                                                    <td>
                                                                        <a href="{{route('role.permissions',$role->id)}}"><span class="badge bg-primary">Change Permissions</span></a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                            </tbody>
                                                          </table>
                                                          {!! $roles->withQueryString()->links('pagination::bootstrap-5') !!}


                                                       
                                                    </div><!-- .card-inner -->
                                                </div><!-- .card-inner-group -->
                                                
                                            </div><!-- .card -->
                                        </div><!-- .nk-block -->
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- content @e -->
    </div>
@endsection