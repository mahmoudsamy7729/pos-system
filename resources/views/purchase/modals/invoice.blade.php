<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <button type="button" class="btn btn-outline-light float-start"><i class="fas fa-print me-2"></i> Print</button>
            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="text-center">
            <h5>daslite POS</h5>
            <h6>Invoice Details</h6>
          </div>
          <hr class="mt-3">
          <div class="row" style="font-weight: 600;">
            <div class="col-md-6 col-12">
              <p>Date : <span id="invoice_date">	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Invoice # : <span id="invoice_code">	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Biller : <span id="biller_name"> 	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Warehouse : <span id="warehouse"> 	</span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Supplier : <span id="customer_name"> </span></p>
            </div>
            <div class="col-md-6 col-12">
              <p>Phone : <span id="customer_phone"> </span></p>
            </div>
          </div>
          <hr class="mt-3">
          <table class="table table-bordered  mb-3">
            <thead class="text-center">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>QTY</th>
                    <th>Price</th>
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