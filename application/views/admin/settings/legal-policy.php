<div class="content">

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">Legal Policy</h4>

                  <p class="card-category">Edit Legal Policy</p>

                </div>

                <div class="card-body">

                  <form name="common-form" id="common-form" action="<?php echo base_url('settings/do-update-settings'); ?>" method="post" >
                  
                    <div class="row">

                      <div class="col-md-12">

                        <div class="form-group">

                            <input type="hidden" name="key" id="key" value="legale">
                            
                            <input type="hidden" name="page_url" id="page_url" value="<?php if(!empty($page_url)) { echo $page_url;} ?>">
                        </div>

                        <div class="form-group">

                          <label>Legal Policy</label>

                          <div class="form-group">

                            <label class="bmd-label-floating"> Enter Legal Policy here ...</label>

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