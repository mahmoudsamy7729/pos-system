<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="text-center">
              <h5>daslite POS</h5>
              <h6>Invoices Filter</h6>
            </div>
            <hr class="mt-3">
            <form class="row gy-4" action="{{route('purchase.filter')}}" method="GET" style="font-weight: 600;">
              <div class="col-md-6 col-12">
                <div class="form-group">
                    <label class="form-label" for="date">{{__('date')}} </label>
                    <div class="form-control-wrap">
                        <input  type="date" class="form-control" id="date" name="date">
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                    <label class="form-label" for="inv_number">{{__('invoice #')}}</label>
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-left">
                          <i class="fas fa-hashtag"></i>
                        </div>
                        <input  type="text" class="form-control" id="inv_number" placeholder="{{__('invoice #')}}" name="inv_number">
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12" onclick="GetBillers()">
                <div class="form-group">
                    <label class="form-label" for="biller">{{__('biller')}}</label>
                    <div class="form-control-wrap">
                      <select    data-live-search="true" class="selectpicker" id="biller_list" name="biller" >
                        <option value="" selected ></option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12" onclick="GetWarehouses()">
                <div class="form-group">
                    <label class="form-label" for="warehouse">{{__('warehouse')}}</label>
                    <div class="form-control-wrap">
                      <select    data-live-search="true" class="selectpicker" id="warehouse_list" name="warehouse" >
                        <option value="" selected ></option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12" onclick="GetSuppliers()">
                <div class="form-group">
                    <label class="form-label" for="supplier_name">{{__('supplier name')}}</label>
                    <div class="form-control-wrap">
                      <select    data-live-search="true" class="selectpicker" id="suppliers_list" name="supplier" >
                        <option value="" selected ></option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12" >
                <div class="form-group">
                    <label class="form-label" for="status">{{__('status')}}</label>
                    <div class="form-control-wrap">
                      <select    data-live-search="true" class="selectpicker"  name="status" >
                        <option value="" selected ></option>
                        <option value="2"  >{{__('paid')}}</option>
                        <option value="1"  >{{__('partially')}}</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="row g-3 text-center">
                <div class="col-12 ">
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-small btn-primary">Filter</button>
                    </div>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>