@extends('layouts.master')
@section('title','Purchases List')
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
                                                    <h3 class="nk-block-title page-title">{{__('payments list')}}</h3>
                                                </div><!-- .nk-block-head-content -->
                                                <div class="nk-block-head-content">
                                                    <div class="toggle-wrap nk-block-tools-toggle">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#filterModal" class="btn btn-dark">Filter</a>
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
                                                                    <th>{{__('date')}}</th>
                                                                    <th>{{__('invoice #')}}</th>
                                                                    <th>{{__('payment #')}}</th>
                                                                    <th>{{__('supplier')}}</th>
                                                                    <th>{{__('amount')}}</th>
                                                                    <th>{{__('biller')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($payments as $payment)
                                                                    <tr>
                                                                        <td style="direction: ltr">{{$payment->date}}</td>
                                                                        <td><a href="#">{{$payment->invoice->invoice_code}}</a></td>
                                                                        <td><a href="#">{{$payment->payment_code}}</a></td>
                                                                        <td>{{$payment->supplier->name}}</td>
                                                                        <td>{{$payment->amount}} EGP</td>
                                                                        <td>{{$payment->user->name}}</td>
                                                                    </tr>
                                                                @endforeach
                                                                
                                                            </tbody>
                                                          </table>
                                                          {!! $payments->withQueryString()->links('pagination::bootstrap-5') !!}
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
    @include('purchase.modals.filter')


@endsection