@extends('layouts.master')
@section('title','POS Sessions')
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
                                                    <h3 class="nk-block-title page-title">{{__('sessions')}}</h3>
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
                                                                                <li><a  href="{{route('roles.add.form.show')}}"><span>Add Item</span></a></li>
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
                                                        <table class="table table-bordered text-center mb-3">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{__('warehouse')}}</th>
                                                                    <th>{{__('biller')}}</th>
                                                                    <th>{{__('session code')}}</th>
                                                                    <th>{{__('status')}}</th>
                                                                    <th>{{__('opened at')}}</th>
                                                                    <th>{{__('closed at')}}</th>
                                                                    <th>{{__('cash in hand')}}</th>
                                                                    <th>{{__('session total')}}</th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $i = 0
                                                                @endphp
                                                                @foreach ($sessions as $session)
                                                                @php
                                                                    $i++
                                                                @endphp
                                                                <tr>
                                                                    <td >{{$i}}</td>
                                                                    <td style="color: #465fff;"> {{$session->warehouse->name}}</td>
                                                                    <td style="font-weight:700;">{{$session->biller->name}}</td>
                                                                    <td style="direction: ltr">{{$session->session_code}}</td>
                                                                    <td>
                                                                        @if ($session->status == 1)
                                                                            <span class="badge bg-primary">{{__('active')}} </span>
                                                                        @else
                                                                            <span class="badge bg-success">{{__('not active')}} </span>
                                                                        @endif    
                                                                    </td>
                                                                    <td style="direction: ltr">{{$session->opened_at}}</td>
                                                                    <td style="direction: ltr">{{$session->closed_at}}</td>
                                                                    <td>{{$session->cash_in_hand}}</td>
                                                                    <td>{{$session->session_total}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                          </table>
                                                          {!! $sessions->withQueryString()->links('pagination::bootstrap-5') !!}
                                                    

                                                       
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