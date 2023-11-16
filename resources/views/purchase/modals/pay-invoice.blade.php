<div class="modal fade" id="PaymentModal" tabindex="-1" aria-labelledby="PaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="text-center">
              <h5>daslite POS</h5>
              <h6>Invoices Payment</h6>
            </div>
            <hr class="mt-3">
            <form method="POST" action="#" class="row gy-4"  id="payment-form" style="font-weight: 600;margin-top:-1rem;">
               @csrf
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label class="form-label" for="date">{{__('date')}} </label>
                        <div class="form-control-wrap">
                            <input  type="text" disabled value="{{date('Y-m-d')}}" class="form-control" id="pay-date" >
                        </div>
                    </div>
            </div>
            <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label class="form-label" for="invoicecode">{{__('invoice #')}} </label>
                        <div class="form-control-wrap">
                            <input  type="text" disabled  class="form-control" id="payinvoicecode" >
                        </div>
                    </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label class="form-label" for="totalPayment">{{__('total')}} </label>
                    <div class="form-control-wrap">
                        <input  type="text" readonly  class="form-control" id="totalPayment" >
                        
                    </div>
                    
                </div>
              </div>
              
              <div class="col-md-6 col-12">
                <div class="form-group">
                    <label class="form-label" for="paid">{{__('paid')}}</label>
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-left">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <input required  type="text" class="form-control" id="paid" value="{{old('paid')}}" placeholder="{{__('paid')}}" name="paid">
                        @if($errors->has('paid'))
                            <span  class="invalid">{{ $errors->first('paid') }}</span>
                        @endif
                    </div>
                </div>
              </div>
              <div class="row g-3 text-center">
                <div class="col-12 ">
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-small btn-primary">{{__('pay')}}</button>
                    </div>
                </div>
            </div>
        </form>

          </div>
        </div>
      </div>
    </div>
  </div>