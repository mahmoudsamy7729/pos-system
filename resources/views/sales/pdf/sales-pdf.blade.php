<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales List</title>
    @include('partials.pdf-css')  
        <style>
            * {
            font-family: DejaVu Sans !important;
        }

        body {
            font-size: 16px;
            font-family: 'DejaVu Sans', 'Roboto', 'Montserrat', 'Open Sans', sans-serif;
            color: #777;
        }
            @page{
                    margin-top: 180px;
                    margin-bottom: 100px;
                }
                header{
                    position: fixed;
                    left: 0px;
                    right: 0px;
                    height: 150px;
                    margin-top: -150px;
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
<body>
    <div>
        <header>
            <div style="padding-top:10px; padding-left: 20px; padding-right: 20px ;">
                <div class="text-center">
                    <h5>daslite POS</h5>
                    <h6>Invoice Details</h6>
                </div>
            </div>
        </header>
        <main style="margin-top: -80px">
          <hr class="mt-3">
          <table >
            <thead>
                <tr>
                    <th>{{__('date')}}</th>
                    <th>{{__('invoice #')}}</th>
                    <th>{{__('biller')}}</th>
                    <th>{{__('customer name')}}</th>
                    <th>{{__('total')}}</th>
                    <th>{{__('warehouse')}}</th>
                </tr>
                
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td style="direction: ltr;">{{$invoice->date}}</td>
                    <td > {{$invoice->invoice_code}}</td>
                    <td >{{$invoice->biller->name}}</td>
                    <td>
                    @if ($invoice->customer_id == 0)
                        {{__('walk in customer')}}
                    @else
                        {{$invoice->customer->name}}
                    @endif
                    </td>
                    <td>{{$invoice->total}} EGP</td>
                    <td>{{$invoice->warehouse->name}}</td>
                </tr>
                @endforeach
                
            </tbody>
          </table>

        </main>
</body>
</html>
