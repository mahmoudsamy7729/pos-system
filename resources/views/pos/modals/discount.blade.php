<div class="modal fade" id="OrderDiscount" tabindex="-1" aria-labelledby="OrderDiscountLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OrderDiscountLabel">Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Type</label>
                        <div class="form-control-wrap ">
                                <select required class="form-select" name="discount_type" id="discount_type">
                                    <option value="1" >Fixed</option>
                                    <option value="2" selected >Percentage</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <label for="discount">Discount</label>
                            <input required type="text"  class="form-control" value="0" name="discount" id="discount_value">
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('save')}}</button>
            </div>
        </div>
    </div>
</div>