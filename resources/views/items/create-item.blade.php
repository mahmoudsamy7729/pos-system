@extends('layouts.master')
@section('title','Add Item')
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
                                    <h4 class="nk-block-title fw-normal">{{__('new item')}} <small style="font-size:0.9rem" class="text-muted">{{__('enter item data')}}.</small></h4>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block nk-block-lg">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        
                                        <div class="preview-block">
                                            <form method="POST" action="{{route('items.add.form.save')}}" enctype="multipart/form-data" class="row gy-4">
                                                @csrf
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="ItemName">{{__('item name')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="fas fa-signature"></i>
                                                            </div>
                                                            <input required type="text"  class="form-control" id="ItemName" placeholder="{{__('item name')}}" name="name">
                                                        </div>
                                                        @if($errors->has('name'))
                                                            <span  class="invalid">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="category">{{__('category')}}</label>
                                                        <div class="form-control-wrap ">
                                                            <select    data-live-search="true" class="selectpicker"  name="category_id" >
                                                                <option value="0" selected>- Select Category -</option>
                                                                    @foreach ($categories as $category)
                                                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="SellUnit">{{__('sell unit')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="fas fa-box"></i>
                                                            </div>
                                                            <input required type="text" class="form-control" id="SellUnit" placeholder="{{__('sell unit')}}" name="sell_unit">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="PurchaseUnit">{{__('purchase unit')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="fas fa-box"></i>
                                                            </div>
                                                            <input required type="text" class="form-control" id="PurchaseUnit" placeholder="{{__('purchase unit')}}" name="purchase_unit">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="QtyPurUnit">{{__('quantity in purchase unit')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="fas fa-box"></i>
                                                            </div>
                                                            <input required type="text" class="form-control" id="QtyPurUnit" placeholder="{{__('quantity in purchase unit')}}" name="qty_purchase_unit">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="ExpireDate">{{__('expire date')}}</label>
                                                        <div class="form-control-wrap">
                                                            
                                                            <input required type="date" class="form-control" id="ExpireDate"  name="expire_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Barcode">{{__('barcode')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="fas fa-barcode"></i>
                                                            </div>
                                                            <input  type="text" class="form-control" id="Barcode" placeholder="{{__('barcode')}}" name="barcode">
                                                        </div>
                                                        @if($errors->has('barcode'))
                                                            <span  class="invalid">{{ $errors->first('barcode') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="image">{{__('image')}}</label>
                                                        <div class="form-control-wrap">
                                                            <input  type="file" class="form-control" id="image"  name="image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="desctiption">{{__('description')}}</label>
                                                        <div class="form-control-wrap">
                                                            <textarea style="min-height: 70px"  class="form-control no-resize" id="desctiption" name="description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <hr>
                                                <div class="row justify-content-center">
                                                    <div class="col-12 col-sm-8">
                                                        <table class="table table-bordered text-center" style="margin-top: 0;vertical-align: middle;">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('warehouse')}}</th>
                                                                    <th>{{__('quantity')}}</th>                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($warehouses as $warehouse)
                                                                    <tr>
                                                                        <td>{{$warehouse->name}}</td>
                                                                        <td style="width: 50%"><input type="number"  min="0" class="form-control text-center" name="quantity[]" value="0"></td>                                                                
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="MinQuantity">{{__('min quantity')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="fas fa-sort-numeric-down-alt"></i>
                                                            </div>
                                                            <input required type="text" class="form-control" id="MinQuantity" placeholder="{{__('min quantity')}}" name="min_quantity" value="5">
                                                            <div  class="form-text">{{__('the default value')}} 5 .</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <hr>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="PurchasePrice">{{__('purchase price')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="far fa-money-bill-alt"></i>
                                                            </div>
                                                            <input required type="text" class="form-control" id="PurchasePrice" placeholder="0.00" name="purchase_price">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="SalesPrice">{{__('sales price')}}</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <i class="far fa-money-bill-alt"></i>
                                                            </div>
                                                            <input required  type="text" class="form-control" id="SalesPrice" placeholder="0.00" name="sales_price">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-3 text-center">
                                                    <div class="col-12 ">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="btn btn-small btn-primary">{{__('save')}}</button>
                                                        </div>
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