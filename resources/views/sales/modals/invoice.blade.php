<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <a  href="{{route('invoice.pdf',"invoice_id")}}"  id="invoice_pdf" target="_blank" role="button" class="btn btn-outline-light float-start"><i class="fas fa-print me-2"></i> {{__('print')}}</a>
            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="text-center">
            <h5>daslite POS</h5>
            <h6>Invoice Details</h6>
          </div>
          <hr class="mt-3">
          <div class="row" style="font-weight: 600;">
            <div class="col-md-6 col-12">
              <p>{{__('date')}} : <span id="invoice_date">	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>{{__('invoice #')}} : <span id="invoice_code">	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>{{__('biller')}} : <span id="biller_name"> 	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>{{__('warehouse')}} : <span id="warehouse"> 	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>{{__('customer name')}} : <span id="customer_name"> </span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>{{__('phone')}} : <span id="customer_phone"> </span></p>
            </div>
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
                
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>