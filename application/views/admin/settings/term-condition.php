<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Terms & Condition</h4>
                  <p class="card-category">Edit terms and condition</p>
                </div>
                <div class="card-body">
                  <form  name="common-form" id="common-form" action="<?php echo base_url('settings/do-update-settings'); ?>" method="post" >
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" name="key" id="key" value="term">
                        </div>
                        <div class="form-group">
                          <label>Terms and Condition </label>
                          <div class="form-group">
                            <label class="bmd-label-floating">Enter Term and Condition Here ...</label>
                            <textarea class="form-control" rows="10" name="description" id="description"><?php if(!empty($settings['message'])) { echo $settings['message']; }?></textarea>
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