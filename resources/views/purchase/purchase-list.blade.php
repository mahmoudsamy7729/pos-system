@extends('layouts.master')
@section('title','Purchases List')
@section('js-files')
<script src="{{asset('assets/js/libs/datatable-btns.js')}}"></script>
<script>
    var cx = 0;
    var wx = 0;
    var bx = 0;
    function GetSuppliers()
    {
        if(cx == 0)
        {
            cx = 1;
            var element = document.getElementById("suppliers_list");
            var url = "{{route('purchase.filter.suppliers')}}";
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url: url,
                        datatype: "json", 
                        success: function(response)
                        {
                            for(var i = 0 ; i < response.suppliers.length; i++)
                            {
                                option = '<option value="'+response.suppliers[i].id+'">'+response.suppliers[i].name+'</option>';
                                $('#suppliers_list').append(option);
                            }
                            $('#suppliers_list').selectpicker('refresh');
                        }
                    }
                )
            });
        }
    }
    function GetBillers()
    {
        if(bx == 0)
        {
            bx = 1;
            var element = document.getElementById("biller_list");
            var url = "{{route('purchase.filter.billers')}}";
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url: url,
                        datatype: "json", 
                        success: function(response)
                        {
                            for(var i = 0 ; i < response.users.length; i++)
                            {
                                option = '<option value="'+response.users[i].id+'">'+response.users[i].name+'</option>';
                                $('#biller_list').append(option);
                            }
                            $('#biller_list').selectpicker('refresh');
                        }
                    }
                )
            });
        }
    }
    function GetWarehouses()
    {
        if(wx == 0)
        {
            wx = 1;
            var element = document.getElementById("warehouse_list");
            var url = "{{route('purchase.filter.warehouses')}}";
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url: url,
                        datatype: "json", 
                        success: function(response)
                        {
                            for(var i = 0 ; i < response.warehouses.length; i++)
                            {
                                option = '<option value="'+response.warehouses[i].id+'">'+response.warehouses[i].name+'</option>';
                                $('#warehouse_list').append(option);
                            }
                            $('#warehouse_list').selectpicker('refresh');
                        }
                    }
                )
            });
        }
    }
    function PayInvoice(ID)
    {
        var url = "{{route('purchase.invoice.details.show',123456789)}}";
        $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url:  url.replace('123456789',ID),
                        datatype: "json", 
                        success: function(response)
                        {
                            
                            document.getElementById('pay-date').value = response.invoice.date;
                            document.getElementById('payinvoicecode').value = response.invoice.invoice_code;
                            document.getElementById('totalPayment').value = response.invoice.total - response.invoice.paid ;
                            var action = '{{ route("purchase.invoice.pay", ["invoice_id" => 123456789 , "max_value" => 987654321]) }}';
                            action = action.replace('123456789', response.invoice.id ).replace('987654321', response.invoice.total - response.invoice.paid);
                            //console.log(action);
                            //document.getElementById("invoice_pdf").href = url; 
                            document.getElementById("payment-form").action = action;
                        }
                    }
                )
            });
    }
    function GetInvoice(ID)
    {
            var url = "{{route('purchase.invoice.details.show',123456789)}}";
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url:  url.replace('123456789',ID),
                        datatype: "json", 
                        success: function(response)
                        {
                            document.getElementById('products_list').innerHTML = "";
                            var productNumber = 0;
                            for(let  i = 0 ; i < response.invoice.products.length ; i++)
                            {
                                productNumber++;
                                var product = '<tr class="text-center"><td>'+ productNumber +'</td> <td>'+response.invoice.products[i].name+'</td><td>'+response.invoice.products[i].pivot.quantity+'</td><td>'+response.invoice.products[i].pivot.price+'</td><td>'+response.invoice.products[i].pivot.price * response.invoice.products[i].pivot.quantity+'</td></tr>';
                                $('#products_list').append(product);
                            }
                            var total_products = '<tr> <td colspan = "2">Total Products : </td> <td class="text-center"> '+response.invoice.quantity+'  </td> <td></td> <td class="text-center">'+response.invoice.subtotal+'</td></tr>';
                            var discount = '<tr> <td colspan = "4">Discount : </td> <td class="text-center"> '+response.invoice.discount+'  </td> </tr>';
                            var shipping = '<tr> <td colspan = "4">Shipping : </td> <td class="text-center"> '+response.invoice.shipping+'  </td> </tr>'
                            var tax = '<tr> <td colspan = "4">Tax : </td> <td class="text-center"> 0.00 </td> </tr>'
                            var total = '<tr> <td colspan = "4">Total : </td> <td class="text-center"> '+response.invoice.total+'  </td> </tr>'

                            $('#products_list').append(total_products,discount,shipping,tax,total);

                            document.getElementById('invoice_date').innerHTML = response.invoice.date;
                            document.getElementById('invoice_code').innerHTML = response.invoice.invoice_code;
                            document.getElementById('biller_name').innerHTML = response.invoice.user.name;
                            document.getElementById('warehouse').innerHTML = response.invoice.warehouse.name;
                            document.getElementById('customer_name').innerHTML = response.invoice.supplier.name;
                            document.getElementById('customer_phone').innerHTML = response.invoice.supplier.phone;

                            
                            
                        }
                    }
                )
            });
        
    }
</script>

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
                                                    <h3 class="nk-block-title page-title">{{__('purchase list')}}</h3>
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
                                                                    <th>{{__('biller')}}</th>
                                                                    <th>{{__('supplier')}}</th>
                                                                    <th>{{__('total')}}</th>
                                                                    <th>{{__('status')}}</th>
                                                                    <th>{{__('paid / remain')}}</th>
                                                                    <th>{{__('warehouse')}}</th>
                                                                    <th>{{__('pay')}}</th>
                                                                    <th>PDF</th>
                                                                    <th>View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($purchases as $purchase)
                                                                    <tr>
                                                                        <td style="direction: ltr">{{$purchase->date->diffForHumans()}}</td>
                                                                        <td><a href="#">{{$purchase->invoice_code}}</a></td>
                                                                        <td>{{$purchase->user->name}}</td>
                                                                        <td>{{$purchase->supplier->name}}</td>
                                                                        <td>{{$purchase->total}} EGP</td>
                                                                        <td>
                                                                            @if ($purchase->status == 2)
                                                                                <span class="badge bg-success">{{__('paid')}} </span>
                                                                            @elseif($purchase->status == 1)
                                                                                <span class="badge bg-warning">{{__('partially')}} </span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$purchase->paid}} / {{$purchase->total - $purchase->paid}} </td>
                                                                        <td>{{$purchase->warehouse->name}}</td>
                                                                        
                                                                        <td>
                                                                            @if ($purchase->status == 2)
                                                                            <span class="btn btn-dim btn-outline-success btn-sm">{{__('paid')}} </span>
                                                                            @elseif($purchase->status == 1)
                                                                            <a href="#"  onclick="PayInvoice({{$purchase->id}})" data-bs-toggle="modal" data-bs-target="#PaymentModal"><span class="btn btn-dim btn-outline-light btn-sm" >{{__('pay')}} </span></a>
                                                                            @endif
                                                                        </td>
                                                                        <td><a href="#"><span class="badge bg-primary">PDF </span></a></td>
                                                                        <td><a href="#" onclick="GetInvoice({{$purchase->id}})" data-bs-toggle="modal" data-bs-target="#invoiceModal"><span class="badge bg-success">View </span></a></td>
                                                                    </tr>
                                                                @endforeach
                                                                
                                                            </tbody>
                                                          </table>
                                                          {!! $purchases->withQueryString()->links('pagination::bootstrap-5') !!}
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
    @include('purchase.modals.pay-invoice')
    @include('purchase.modals.invoice')
    @include('purchase.modals.filter')


@endsection