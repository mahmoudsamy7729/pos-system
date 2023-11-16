<div class="modal fade" id="NewSession" tabindex="-1" aria-labelledby="NewSessionLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OrderDiscountLabel">New Session</h5>
            </div>
            <div class="modal-body">
            <div  class="row"  >
                <form method="POST" class="row" action="{{route('pos.new.session')}}">
                @csrf
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="warehouse">Warehouse</label>
                        <div class="form-control-wrap ">
                                <select required class="form-select" id="warehouse" name="warehouse">
                                    <option value="" selected >-- select warehouse --</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}" >{{$warehouse->name}}</option>
                                    @endforeach
                                    
                                    
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <label for="cashinhand">Cash In Hand</label>
                            <input required type="text" class="form-control" value="0" name="cash_in_hand">
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