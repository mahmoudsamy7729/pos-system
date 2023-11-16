<div class="modal fade" id="FinishCountStockModal" tabindex="-1" aria-labelledby="FinishCountStockModalLabel" aria-hidden="true">
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
            <form class="row gy-4" action="#" id="upload-form" method="POST" enctype="multipart/form-data" style="font-weight: 600;margin-top:-1rem;">
                @csrf
                <div class="col-12"  >
                    <div class="form-group">
                        <label class="form-label" for="final_file">{{__('Upload Updated File')}}</label>
                        <input type="file" class="form-control" id="final_file" name="final_file">
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