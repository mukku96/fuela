<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Currency</h4>
                  <p class="card-category">Edit Currency</p>
                </div>
                <div class="card-body">
                  <form name="common-form" id="common-form" action="<?php echo base_url('admin/do-update-currency'); ?>" method="post" >
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Currency Name</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Enter currency Name here ...</label>
                            <input class="form-control" name="currency_name" id="currency_name" value="<?php if(!empty($currency)){ echo $currency['currency_name'];}?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Currency Sybmbol</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Enter currency Sybmbol here ...</label>
                            <input class="form-control" name="currency_symbol" id="currency_symbol" value="<?php if(!empty($currency)){ echo $currency['currency_symbol'];}?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>