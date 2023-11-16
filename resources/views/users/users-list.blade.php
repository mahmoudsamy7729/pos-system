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
                                                    <h3 class="nk-block-title page-title">Users List</h3>
                                                </div><!-- .nk-block-head-content -->
                                                <div class="nk-block-head-content">
                                                    <div class="toggle-wrap nk-block-tools-toggle">
                                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                        <div class="toggle-expand-content" data-content="pageMenu">
                                                            <ul class="nk-block-tools g-3">
                                                                <li class="nk-block-tools-opt">
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a  href="{{route('users.add.form.show')}}"><span>Add User</span></a></li>
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
                                                        <table class="table table-bordered text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Mobile</th>
                                                                    <th>Role</th>
                                                                    <th>Created On</th>
                                                                    <th>Status</th>
                                                                    <th>Edit</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($users as $user)
                                                                <tr>
                                                                    <td>{{$user->name}}</td>
                                                                    <td>{{$user->mobile}}</td>
                                                                    <td >@foreach ($user->roles as $role)
                                                                        {{$role->slug}}
                                                                    @endforeach</td>
                                                                    <td>{{$user->created_at}}</td>
                                                                    <td><span class="badge bg-success">Active</span></td>
                                                                    <td><a href="#"><span class="badge bg-primary">Edit </span></a></td>
                                                                    <td><a href="#"><span class="badge bg-danger">Delete </span></a></td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                            </tbody>
                                                          </table>
                                                       
                                                    </div><!-- .card-inner -->
                                                </div><!-- .card-inner-group -->
                                            </div><!-- .card -->
                                        </div><!-- .nk-block -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- content @e -->
    </div>
@endsection