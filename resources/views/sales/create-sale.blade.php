@extends('layouts.master')
@section('title','Add Sales')
@section('js-files')
<script src="{{asset('assets/js/pos-script.js')}}"></script>
<script>
    var x = 0;
    function GetCustomers()
    {
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
            var warehouse =  document.getElementById('warehouse_id').value;
            $(document).ready(function()
            {
                $.ajax(
                    {
                        type: "GET",
                        url: url.replace('123456789',ID).replace('789654123',warehouse),
                        datatype: "json", 
                        success: function(response)
                        {          
                            product = '<tr><td><input type="hidden" value="'+response.item.id+'" name="products[]"> <input type="hidden" readonly id="inv_products_'+response.item.id+'" value="'+response.item.sales_price+'">'+response.item.name+'</td><td>'+response.item.warehouse_quantity[0].quantity+'</td><td style="width: 25%"><input type="number" onkeyup="GetSubTotal('+response.item.id+')" id="quantity'+response.item.id+'"  min="1" max="'+response.item.warehouse_quantity[0].quantity+'" class="form-control text-center" value="1" name="quantity[]"></td><td id="price'+response.item.id+'">'+response.item.sales_price+'</td><td  id="total'+response.item.id+'">'+response.item.sales_price+'</td><td><a href="#" onclick="deleteRow(this)"><span class="badge bg-danger">X </span></a></td></tr>'
                            $('#products-list').append(product);
                            numberofproducts++;
                            CalcQuantity();
                            CalcTotal();
                            console.log(response);
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
                                        
                                        <div class="preview-block">
                                            @include('pos.modals.discount')
                                                @include('pos.modals.tax')
                                                @include('pos.modals.shipping')
                                            <form method="POST"  action="#" id="pos-form" enctype="multipart/form-data" class="row gy-4">
                                                @csrf
                                                <div class="col-sm-4" onclick="GetCustomers()" >
                                                    <div class="form-group">
                                                        <div class="form-control-wrap ">
                                                            <label class="form-label" for="amount">{{__('customer name')}} </label>

                                                                <select   required data-live-search="true" class="selectpicker" id="customers_list" name="category_id" >
                                                                    <option value="0" selected >{{__('walk in customer')}}</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="amount">{{__('sales date')}} </label>
                                                        <div class="form-control-wrap">
                                                            
                                                            <input required type="date" class="form-control" id="mobile" name="amount">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="amount">{{__('warehouse')}}</label>
                                                        <div class="form-control-wrap ">
                                                                <select required class="form-select" id="warehouse_id" name="warehouse_id">
                                                                    <option value="" selected>Select Warehouse</option>
                                                                    @foreach ($warehouse as $wh)
                                                                        <option value="{{$wh->id}}" >{{$wh->name}}</option>
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
                                                                    
                                                                </ul>                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
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
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('total amount')}}:</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="all_subtotal">0.00</span>
                                                        <input type="hidden" id="Invoice_Subtotal">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('discount')}} <a href="#" data-bs-toggle="modal" data-bs-target="#OrderDiscount"><em class="icon ni ni-edit"></em></a>:</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="invoice_discount">0.00</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('tax')}} <a href="#" data-bs-toggle="modal" data-bs-target="#Tax"><em class="icon ni ni-edit"></em></a>:</span>
                                                        <span class="float-end" style="font-size: 1rem;">0.00</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('shipping')}} <a href="#" data-bs-toggle="modal" data-bs-target="#Shipping"><em class="icon ni ni-edit"></em></a>:</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="invoice_shipping">0.00</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span style="font-size: 1rem;">{{__('total')}} :</span>
                                                        <span class="float-end" style="font-size: 1rem;" id="all_total">0.00</span>
                                                        <input type="hidden" id="Invoice_Total">
                                                    </div>
                                                    <hr style="margin-bottom: 10px;margin-top: 10px;">
                                                    <div class="col-12 text-center">
                                                        <button type="button" class="btn btn-success "><em class="icon ni ni-money me-1"></em> {{__('pay')}} </button>
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