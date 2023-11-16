@extends('layouts.master')
@section('title','Sales List')
@section('js-files')
<script src="{{asset('assets/js/libs/datatable-btns.js')}}"></script>
<script>
    var cx = 0;
    var wx = 0;
    var bx = 0;
    function GetCustomers()
    {
        if(cx == 0)
        {
            cx = 1;
            var element = document.getElementById("customers_list");
            var url = "{{route('sales.filter.customers')}}";
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url: url,
                        datatype: "json", 
                        success: function(response)
                        {
                            for(var i = 0 ; i < response.customers.length; i++)
                            {
                                option = '<option value="'+response.customers[i].id+'">'+response.customers[i].name+'</option>';
                                $('#customers_list').append(option);
                            }
                            $('#customers_list').selectpicker('refresh');
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
            var url = "{{route('sales.filter.billers')}}";
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
            var url = "{{route('sales.filter.warehouses')}}";
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
    function GetInvoice(ID)
    {
            var url = "{{route('sales.invoice.details.show',123456789)}}";
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
                            var url = '{{ route("invoice.pdf", ":id") }}';
                            url = url.replace(':id', response.invoice.id);
                            document.getElementById("invoice_pdf").href = url; 

                            document.getElementById('invoice_date').innerHTML = response.invoice.date;
                            document.getElementById('invoice_code').innerHTML = response.invoice.invoice_code;
                            document.getElementById('biller_name').innerHTML = response.invoice.biller.name;
                            document.getElementById('warehouse').innerHTML = response.invoice.warehouse.name;
                            if(response.invoice.customer_id == 0)
                            {
                                document.getElementById('customer_name').innerHTML = "{{__('walk in customer')}}";
                                document.getElementById('customer_phone').innerHTML = "";
                            }else
                            {
                                document.getElementById('customer_name').innerHTML = response.invoice.customer.name;
                                document.getElementById('customer_phone').innerHTML = response.invoice.customer.phone;

                            }
                            
                            
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
                                                    <h3 class="nk-block-title page-title">{{__('invoices list')}}</h3>
                                                </div><!-- .nk-block-head-content -->
                                                <div class="nk-block-head-content">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#filterModal" class="btn btn-dark">Filter</a>
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
                                                                    <th>{{__('customer name')}}</th>
                                                                    <th>{{__('total')}}</th>
                                                                    <th>{{__('warehouse')}}</th>
                                                                    <th>{{__('print')}}</th>
                                                                    <th>PDF</th>
                                                                    <th>View</th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody>
                                                                @forelse($invoices as $invoice)
                                                                <tr>
                                                                    <td style="direction: ltr;">{{$invoice->date->diffForHumans()}}</td>
                                                                    <td style="color: #465fff;"> {{$invoice->invoice_code}}</td>
                                                                    <td style="font-weight:700;">{{$invoice->biller->name}}</td>
                                                                    <td>
                                                                    @if ($invoice->customer_id == 0)
                                                                        {{__('walk in customer')}}
                                                                    @else
                                                                        {{$invoice->customer->name}}
                                                                    @endif
                                                                    </td>
                                                                    <td>{{$invoice->total}} EGP</td>
                                                                    <td>{{$invoice->warehouse->name}}</td>
                                                                    <td><a href="{{route('invoice.pdf',$invoice->id)}}" target="_blank"><span class="badge bg-primary">{{__('print')}} </span></a></td>
                                                                    <td><a href="#"><span class="badge bg-primary">PDF </span></a></td>
                                                                    <td><a href="#" onclick="GetInvoice({{$invoice->id}})" data-bs-toggle="modal" data-bs-target="#invoiceModal" ><span class="badge bg-success">View </span></a></td>
                                                                </tr>
                                                                @empty
                                                                    <p>No users</p>
                                                                @endforelse
                                                            </tbody>
                                                          </table>
                                                          {!! $invoices->withQueryString()->links('pagination::bootstrap-5') !!}
                                                    

                                                       
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
     @include('sales.modals.invoice')
     @include('sales.modals.filter')

@endsection