<div class="modal fade" id="CountStockModal" tabindex="-1" aria-labelledby="CountStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="text-center">
              <h5>daslite POS</h5>
              <h6>{{__('stock count')}}</h6>
            </div>
            <hr class="mt-3">
            <form class="row gy-4" action="{{route('items.stock.count.intial')}}" method="GET" style="font-weight: 600;margin-top:-1rem;">
                <div class="col-md-6 col-12"  onclick="GetWarehouses()">
                    <div class="form-group">
                        <label class="form-label" for="warehouse">{{__('warehouse')}}</label>
                        <div class="form-control-wrap">
                          <select  required title="{{__('choose warehouse')}}"  data-live-search="true" class="selectpicker" id="warehouse_list" name="warehouse" >
                          </select>
                        </div>
                    </div>
                </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                    <label class="form-label" for="type">{{__('type')}}</label>
                    <div class="form-control-wrap">
                      <select required title="{{__('choose type')}}"  class="selectpicker" id="type_list" name="type" onchange="CheckType(this.value);" >
                        <option value="1"  >{{__('full')}}</option>
                        <option value="2"  >{{__('partial')}}</option>
                      </select>
                    </div>
                </div>
              </div>
              
              <div class="col-md-6 col-12" >
                <div class="form-group">
                    <label class="form-label" for="customer_name">{{__('category')}}</label>
                    <div class="form-control-wrap">
                      <select  multiple="multiple" title="{{__('choose category')}}"  data-live-search="true" disabled class="selectpicker" id="categories_list" name="category[]"  >
                        <option value="4" >{{__('walk in customer')}}</option>
                        <option value="2" >{{__('walk in customer')}}</option>
                        <option value="5" >{{__('walk in customer')}}</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="row g-3 text-center">
                <div class="col-12 ">
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-small btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>