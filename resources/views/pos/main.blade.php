@extends('layouts.master')
@section('title','POS')
@section('content')

@section('js-files')
<script>
    function quantity_alert() {
        alert("This Item Is Out Of Stock!");
    }
</script>
    @if (session('active_session')==0)
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#NewSession').modal('show');
        });
    </script>
    @endif
    <script src="{{asset('assets/js/pos-script.js')}}"></script>
    

    @if (session('status'))
        <script>
            $('.eg-swal-av2').on("click", function (e) {
            Swal.fire({
            icon: 'success',
            title: {!! json_encode(session('status')) !!},
            showConfirmButton: false,
            timer: 1500
            });
            e.preventDefault();
        });
            document.getElementById('saved-status').click();
        </script>
    @endif
<script>
    var warehouse = {{session('warehouse')}};
    var x = 0;
    function GetCustomers()
    {
        //var value = document.querySelector('input[name="products[]"]').value
        //console.log(value)
        if(x == 0)
        {
            x = 1;
            var element = document.getElementById("customers_list");
            var url = "{{route('pos.customers.show')}}";
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
                                option = '<option value="'+response.customers[i].id+'">'+response.customers[i].name+' | '+response.customers[i].phone+'</option>';
                                $('#customers_list').append(option);
                            }
                            $('#customers_list').selectpicker('refresh');
                        }
                    }
                )
            });
        }
    }
    function GetItems()
        {
            var Query = document.getElementById("search_input").value;
            var list = document.getElementById("itemsList");
            if(Query != '')
            {
                var url = "{{route('pos.items.show',':query')}}";
                $(document).ready(function()
                {
                    $.ajax(
                        {
                            type: "GET",
                            url: url.replace(':query',Query),
                            datatype: "json", 
                            success: function(response)
                            {
                                list.innerHTML = "";
                                for(var i = 0 ; i < response.items.length; i++)
                                {
                                    option = '<li><a class="dropdown-item" onclick="GetProductDetails('+response.items[i].id+')">'+response.items[i].name+' | '+response.items[i].barcode+'</a></li>'
                                    $('#itemsList').append(option);
                                }
                            }
                        }
                    )
                });
            }
        }
        

        function GetProductDetails(ID)
        {    
            var exist = document.getElementById('quantity'+ID);
            if(exist) {
                exist.value ++;
                CalcQuantity();
                GetSubTotal(ID)
                CalcTotal();
            }else
            {
            var url = "{{route('pos.item.details',['id' => 123456789 , 'warehouse' => 789654123])}}";
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url: url.replace('123456789',ID).replace('789654123',warehouse),
                        datatype: "json", 
                        success: function(response)
                        {          
                            if(response.item.warehouse_quantity[0].quantity == 0)
                            {
                                quantity_alert();
                            }else
                            {
                            product = '<tr><td><input type="hidden" value="'+response.item.id+'" name="products[]"> <input type="hidden" readonly id="inv_products_'+response.item.id+'" value="'+response.item.sales_price+'">  <input type="hidden" readonly name="product_price[]" value="'+response.item.sales_price+'">'+response.item.name+'</td><td>'+response.item.warehouse_quantity[0].quantity+'</td><td style="width: 25%"><input type="number" onkeyup="GetSubTotal('+response.item.id+')" id="quantity'+response.item.id+'"  min="1" max="'+response.item.warehouse_quantity[0].quantity+'" class="form-control text-center" value="1" name="quantity[]"></td><td id="price'+response.item.id+'">'+response.item.sales_price+'</td><td  id="total'+response.item.id+'">'+response.item.sales_price+'</td><td><a href="#" onclick="deleteRow(this)"><span class="badge bg-danger">X </span></a></td></tr>'
                            $('#products-list').append(product);
                            numberofproducts++;
                            CalcQuantity();
                            CalcTotal();
                            }
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
                                document.getElementById('customer_name').innerHTML = "Walk In Customer";
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
    @include('partials.sidebar')
    
    <div class="nk-wrap">
        @include('partials.header')
        
        {{-- 
        @if (session('status'))
                        <div   aria-live="polite" aria-atomic="true" style="position: relative; min-height: 85px;">
                            <div class="toast-container  position-absolute top-0 end-0 p-3">
                                <div class="toast show "  id="myToast" >
                                    <div class="toast-header">
                                        <strong class="me-auto">POS </strong>
                                        <small>seconds ago</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body text-white bg-success">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            </div> 
                        </div>
                        @endif--}}
        <div class="nk-content ">
            <div class="container-fluid">
                <li><a href="#" id="saved-status" style="display:none;" class="btn btn-primary eg-swal-av2">Advanced 02</a></li>

                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="nk-block">
                            <div class="row g-gs">
                                <div class="col-md-7">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-0">
                                                <div class="card-title" style="margin-top: 0.5rem">
                                                    <h6 class="title">{{__('sales invoice')}}</h6>
                                                </div>
                                                <div>
                                                    <a href="{{route('pos.close.session')}}" class="btn btn-secondary">{{__('close session')}}</a>
                                                </div>
                                            </div>
                                            <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                @include('pos.modals.discount')
                                                @include('pos.modals.tax')
                                                @include('pos.modals.shipping')
                                                @if (session('active_session')==0)
                                                    @include('pos.modals.new_session')
                                                @endif
                                            <form class="row gy-4"  method="POST" action="{{route('pos.new.invoice')}}" id="pos-form">
                                                @csrf
                                                <div class="col-sm-6" onclick="GetCustomers()" >
                                                    <div class="form-group">
                                                        <div class="form-control-wrap ">
                                                                <select   required data-live-search="true" class="selectpicker" id="customers_list" name="customer" >
                                                                    <option value="0" selected >{{__('walk in customer')}}</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="fa fa-barcode"></em>  
                                                            </div>
                                                            <input onkeydown="GetItems()"  onfocus= "clearInput(this)" data-bs-toggle="dropdown" type="text" id="search_input"  class="form-control" placeholder="{{__('item name')}}/{{__('barcode')}}/{{__('itemcode')}}" autocomplete="off">
                                                            <ul class="dropdown-menu" style="width: 100%" id="itemsList" aria-labelledby="dropdownMenuLink">
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                <div style="height: 20rem;overflow: auto; ">
                                                
                                                <table class="table table-bordered text-center" style="margin-top: 0;vertical-align: middle;">
                                                    <thead>
                                                        <tr>
                                                            <th>{{__('name')}}</th>
                                                            <th>{{__('stock')}}</th>
                                                            <th>{{__('quantity')}}</th>
                                                            <th>{{__('price')}}</th>
                                                            <th>{{__('total')}}</th>
                                                            <th>X</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody id="products-list">
                                                        
                                                        
                                                    </tbody>
                                                </table>

                                                </div>
                                                <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                <div >
                                                    <div class="col-md-3 col-4 float-end" style="margin-top: -1.5rem">
                                                        <input type="text"  placeholder="{{__('other charges')}}" class="form-control col-3 text-center" >
                                                    </div>
                                                </div>
                                                <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('quantity')}}:</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="invoice_quantity">0(0)</span>
                                                        <input type="hidden" id="Invoice_Quantity" name="Invoice_Quantity">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('total amount')}}:</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="all_subtotal">0.00</span>
                                                        <input type="hidden" id="Invoice_Subtotal" name="Invoice_Subtotal">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('discount')}} <a href="#" data-bs-toggle="modal" data-bs-target="#OrderDiscount"><em class="icon ni ni-edit"></em></a>:</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="invoice_discount">0.00</span>
                                                        <input type="hidden" id="Invoice_Discount" name="Invoice_Discount">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('tax')}} <a href="#" data-bs-toggle="modal" data-bs-target="#Tax"><em class="icon ni ni-edit"></em></a>:</span>
                                                        <span class="float-end" style="font-size: 1rem;">0.00</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('shipping')}} <a href="#" data-bs-toggle="modal" data-bs-target="#Shipping"><em class="icon ni ni-edit"></em></a>:</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="invoice_shipping">0.00</span>
                                                        <input type="hidden" id="Invoice_Shipping" name="Invoice_Shipping" value="0.00">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('total')}} :</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="all_total">0.00</span>
                                                        <input type="hidden" id="Invoice_Total" name="Invoice_Total">
                                                    </div>
                                                    <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                    <div class="col-12 text-center">
                                                        <button type="submit" class="btn btn-success "><em class="icon ni ni-money me-1"></em> {{__('pay')}} </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- .card -->
                                </div><!-- .col -->
                                <div class="col-md-5">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner">
                                            <div class="card-title" style="margin-top: 0.5rem">
                                                <h6 class="title">{{__('recent transactions')}}</h6>
                                            </div>
                                            <hr style="margin-bottom: 10px;margin-top: 10px;">
    
                                            <div style="height: 29rem;overflow: auto; ">
                                                <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Customer</th>
                                                            <th>{{__('total')}}</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (session('recent_invoices'))
                                                        @foreach (array_reverse(session('recent_invoices')) as $invoice)
                                                            <tr>
                                                                <td style="color: #465fff;"> {{$invoice->invoice_code}}</td>
                                                                <td>
                                                                    @if ($invoice->customer_id == 0)
                                                                        {{__('walk in customer')}}
                                                                    @else
                                                                        {{$invoice->customer->name}}
                                                                    @endif
                                                                    </td>
                                                                <td>{{$invoice->total}}</td>
                                                                <td><a href="#" onclick="GetInvoice({{$invoice->id}})" data-bs-toggle="modal" data-bs-target="#invoiceModal"><span class="badge bg-success">View </span></a></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                              <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <span style="font-size: 1rem;">{{__('session total')}}:</span>
                                                        <span class="float-end" style="font-size: 1rem; direction: ltr;">{{session('session_total')}} EGP</span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span style="font-size: 1rem;">{{__('session started at')}}:</span>
                                                        <span class="float-end" style="font-size: 1rem; direction: ltr;" >{{session('started_at')}}</span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span style="font-size: 1rem;">{{__('biller')}}:</span>
                                                        <span class="float-end" style="font-size: 1rem;">{{auth()->user()->name}}</span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <span style="font-size: 1rem;">{{__('warehouse')}}:</span>
                                                        <span class="float-end" style="font-size: 1rem;">{{session('warehouse_name')}}</span>
                                                    </div>
                                                </div>
                                        </div>
                                    </div><!-- .card -->
                                </div><!-- .col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sales.modals.invoice')

@endsection