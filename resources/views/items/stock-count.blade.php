@extends('layouts.master')
@section('title','Stock Count')
@section('js-files')
<script src="{{asset('assets/js/libs/datatable-btns.js')}}"></script>
<script>
    var wx = 0;
    function GetWarehouses()
    {
        if(wx == 0)
        {
            wx = 1;
            var element = document.getElementById("warehouse_list");
            var url = "{{route('stock.count.warehouses')}}";
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
    function UploadFinalFile(ID)
    {

        var action = '{{ route("items.stock.count.upload.final", ["id" => 123456789]) }}';
        action = action.replace('123456789', ID );
        document.getElementById("upload-form").action = action;
    }
    function CheckType(value)
    {
        var disabled = document.getElementById("categories_list").disabled;
        if(value == 2)
        {
            document.getElementById("categories_list").disabled = false;
        }else{
            document.getElementById("categories_list").disabled = true;
        }
        $('#categories_list').selectpicker('refresh');
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
                                                    <h3 class="nk-block-title page-title">{{__('stock count')}}</h3>
                                                </div><!-- .nk-block-head-content -->
                                                <div class="nk-block-head-content">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#CountStockModal" class="btn btn-dark"> + Count Stock</a>
                                                </div><!-- .nk-block-head-content -->
                                            </div><!-- .nk-block-between -->
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block">
                                            <div class="card card-bordered card-stretch" style="padding-right: 0">
                                                <div class="card-inner-group" style="white-space: nowrap;overflow-x: auto;">
                                                    <div class="card-inner position-relative card-tools-toggle">
                                                    <div class="card-inner p-0">
                                                        <table class="table table-bordered text-center mb-3" style="vertical-align: middle;">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('date')}}</th>
                                                                    <th>{{__('warehouse')}}</th>
                                                                    <th>{{__('type')}}</th>
                                                                    <th>{{__('initial file')}}</th>
                                                                    <th>{{__('final file')}}</th>
                                                                    <th>{{__('status')}}</th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($stockcounts as $sc)
                                                                <tr>
                                                                    <td style="direction: ltr;">{{$sc->date}}</td>
                                                                    <td>{{$sc->warehouse->name}}</td>
                                                                    <td>
                                                                        @if ($sc->type == 1)
                                                                        {{__('full')}}
                                                                        @else
                                                                        {{__('partial')}}
                                                                    @endif
                                                                    </td>
                                                                    <td>@if ($sc->initial_file)
                                                                        <a href="{{route('items.stock.count.file.download',$sc->initial_file)}}" title="download"><i class="fas fa-file-excel" style="color: #526484"></i></a>
                                                                    @endif</td>
                                                                    <td>@if ($sc->final_file)
                                                                        <a href="{{route('items.stock.count.file.download',$sc->final_file)}}" title="download"><i class="fas fa-file-excel" style="color: #526484"></i></a>
                                                                    @endif</td>
                                                                    <td>
                                                                        @if ($sc->final_file)
                                                                        <a href="#"><span class="badge bg-success">Finished </span></a>
                                                                        @else
                                                                        <a href="#"  onclick="UploadFinalFile({{$sc->id}})" data-bs-toggle="modal" data-bs-target="#FinishCountStockModal"><span class="badge bg-primary">Finish </span></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                            </tbody>
                                                          </table>
                                                          {!! $stockcounts->withQueryString()->links('pagination::bootstrap-5') !!}


                                                       
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
@include('items.modals.stock-count')
@include('items.modals.finish-stock-count')

@endsection