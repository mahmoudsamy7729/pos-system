<!DOCTYPE html>
<html   >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Information</title>
    @include('partials.pdf-css')  
        <style>
             * {
            font-family: DejaVu Sans !important;
        }
        span {
            font-size: 16px;
            font-family: 'DejaVu Sans', 'Roboto', 'Montserrat', 'Open Sans', sans-serif;
            color: #777;
        }

        body {
            
            font-size: 16px;
            font-family: 'DejaVu Sans', 'Roboto', 'Montserrat', 'Open Sans', sans-serif !important;
            color: #777;
        }
            @page{
                    margin-top: 180px;
                    margin-bottom: 180px;
                }
                header{
                    position: fixed;
                    left: 0px;
                    right: 0px;
                    height: 150px;
                    margin-top: -150px;
                }
                footer{
                    position: fixed;
                    left: 0px;
                    right: 0px;
                    height: 150px;
                    bottom: 0px;
                    margin-bottom: -150px;
                }

                footer p.page-number::after{
                    content: counter(page); 
                }
                table {
    border-left: 0.01em solid #ccc;
    border-right: 0;
    border-top: 0.01em solid #ccc;
    border-bottom: 0;
    border-collapse: collapse;
    text-align: center;
    font-size: 15px;
    width: 100%;
}
table td,
table th {
    border-left: 0;
    border-right: 0.01em solid #ccc;
    border-top: 0;
    border-bottom: 0.01em solid #ccc;
}
        </style>
<body onload="window.print()">
    <div>
        <header>
            <div style="padding-top:10px; padding-left: 20px; padding-right: 20px ;">
                <div class="text-center">
                    <h5>daslite POS</h5>
                    <h6>Invoice Details</h6>
                </div>
            </div>
        </header>
        <footer>
            <p style="text-align: center; margin-top:100px" class="page-number"></p>
        </footer>
        <main style="margin-top: -80px">
            <hr>
            <div class="col-md-6 col-12" >
              <p>Date : <span id="invoice_date"> {{$invoice->date}}	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Invoice #  <span id="invoice_code">{{$invoice->invoice_code}}		</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Biller : <span id="biller_name" >{{$invoice->biller->name}}	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Warehouse : <span id="warehouse">{{$invoice->warehouse->name}}	 	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Customer : <span id="customer_name">@if ($invoice->customer_id == 0)
                {{__('walk in customer')}}
                  @else
                  {{$invoice->customer->name}}
              @endif	 </span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Phone : <span id="customer_phone">@if ($invoice->customer_id == 0)
                
                @else
                {{$invoice->customer->phone}}
            @endif	 </span></p>
            </div>
          <hr class="mt-3">
          <table class="table table-bordered  mb-3">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>{{__('product')}}</th>
                    <th>{{__('quantity')}}</th>
                    <th>{{__('price')}}</th>
                    <th>{{__('total')}}</th>
                </tr>
            </thead>
            <tbody id="products_list">
                @php
                    $ProductNumber = 0;
                @endphp
                @foreach ($invoice->products as $product)
                @php
                    $ProductNumber++;
                @endphp
                <tr class="text-center">
                    <td>{{$ProductNumber}}</td> <td>{{$product->name}}</td><td>{{$product->pivot->quantity}}</td><td>{{$product->pivot->price}}</td><td>{{$product->pivot->price * $product->pivot->quantity}}</td>
                </tr>
                @endforeach
                
                <tr>
                    <td colspan = "2">Total Products : </td> <td class="text-center"> {{$invoice->quantity}} </td> <td></td> <td class="text-center">{{$invoice->subtotal}}</td>
                </tr>
                <tr>
                    <td colspan = "4">Discount : </td> <td class="text-center"> {{$invoice->discount}} </td>
                </tr>
                <tr> 
                    <td colspan = "4">Shipping : </td> <td class="text-center"> {{$invoice->shipping}}  </td> 
                </tr>
                <tr> 
                    <td colspan = "4">Tax : </td> <td class="text-center"> 0.00 </td> 
                </tr>
                <tr> 
                    <td colspan = "4">Total : </td> <td class="text-center"> {{$invoice->total}}  </td>
                </tr>
            </tbody>
          </table>

        </main>
</body>
</html>
