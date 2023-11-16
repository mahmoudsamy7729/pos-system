@extends('layouts.master')
@section('title','Add Purchase')
@section('js-files')
<script src="{{asset('assets/js/purchase-script.js')}}"></script>
    <script>
        var source = "purchase";
        setTimeout(function() {
        $('#myToast').fadeOut('fast');
    }, 3000); // <-- time in milliseconds
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

        function ValidatePaymentAmount()
        {
            let x = document.forms["PurchaseForm"]["Invoice_Total"].value;
            let m = document.forms["PurchaseForm"]["paid"].value;
            if(m > x)
            {
                alert("You Cant Pay More Than "+ m);
                return false;
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
            var url = "{{route('purchase.item.details',123456789 )}}";
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url: url.replace('123456789',ID),
                        datatype: "json", 
                        success: function(response)
                        {          
                            product = '<tr><td><input type="hidden" value="'+response.item.id+'" name="products[]"> <input type="hidden" readonly id="inv_products_'+response.item.id+'" value="'+response.item.purchase_price+'">  <input type="hidden" readonly name="product_price[]" value="'+response.item.purchase_price+'">'+response.item.name+'</td> <td> '+response.item.purchase_unit+' </td> <td style="width: 25%"><input type="number" onkeyup="GetSubTotal('+response.item.id+')" id="quantity'+response.item.id+'"  min="1"  class="form-control text-center" value="1" name="quantity[]"></td><td id="price'+response.item.id+'">'+response.item.purchase_price+'</td><td  id="total'+response.item.id+'">'+response.item.purchase_price+'</td><td><a href="#" onclick="deleteRow(this)"><span class="badge bg-danger">X </span></a></td></tr>'
                            $('#products-list').append(product);
                            numberofproducts++;
                            CalcQuantity();
                            CalcTotal();
                        }
                    }
                )
            });
            }
        }

    </script>
@endsection
@section('content')
    @include('partials.sidebar')
    <div class="nk-wrap">
        @include('partials.header')
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
                        @endif
        <div class="nk-content">
            <div class="container-fluid">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        <div class="components-preview wide-md mx-auto">
                            <div class="nk-block-head nk-block-head-lg wide-sm" style="padding-bottom: 0.5rem">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title fw-normal">{{__('new invoice')}} <small style="font-size:0.9rem" class="text-muted">{{__('enter invoice data')}}.</small></h4>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block nk-block-lg">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        @include('pos.modals.discount')
                                        @include('pos.modals.tax')
                                        @include('pos.modals.shipping')
                                        <div class="preview-block">
                                            <form name="PurchaseForm" method="POST" onsubmit="return ValidatePaymentAmount()" action="{{route('purchase.add.form.save')}}" id="pos-form" enctype="multipart/form-data" class="row gy-4">
                                                @csrf
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="amount">{{__('supplier name')}}</label>
                                                        <div class="form-control-wrap ">
                                                                <select required class="form-select" id="supplier" name="supplier">
                                                                    <option value="" selected>-- select supplier --</option>
                                                                    @foreach ($suppliers as $supplier)
                                                                    <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                                                                    @endforeach
                                                                    
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="date">{{__('date')}} </label>
                                                        <div class="form-control-wrap">
                                                            
                                                            <input required type="date" class="form-control" id="date" name="date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="warehouse">{{__('warehouse')}}</label>
                                                        <div class="form-control-wrap ">
                                                                <select required class="form-select" id="warehouse" name="warehouse">
                                                                    <option value="" selected>Select Warehouse</option>
                                                                    @foreach ($warehouses as $warehouse)
                                                                    <option value="{{$warehouse->id}}" >{{$warehouse->name}}</option>
                                                                        
                                                                    @endforeach
                                                                    
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                <div class="row justify-content-center">
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
                                                </div>
                                                
                                                <div style="height: 20rem;overflow: auto; ">
                                                
                                                    <table class="table table-bordered text-center" style="margin-top: 0;vertical-align: middle;">
                                                        <thead>
                                                            <tr>
                                                                <th>{{__('name')}}</th>
                                                                <th>{{__('purchase unit')}}</th>
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
                                                        <input type="hidden" id="Invoice_Total" name="Invoice_Total" >
                                                    </div>
                                                    <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                    <div class="col-12 text-center">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#PaymentModal" type="button" class="btn btn-success "><em class="icon ni ni-money me-1"></em> {{__('pay')}} </a>
                                                    </div>
                                                </div>
                                                @include('purchase.modals.payment')
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