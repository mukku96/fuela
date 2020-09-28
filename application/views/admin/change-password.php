    <div class="content">

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">Change Password</h4>

                  <p class="card-category">Update your new password</p>

                </div>

                <div class="card-body">

                  <form id="common-form" name="change-password" method="post" action="<?php if(!empty($admin_id)) { echo base_url('admin/do_change_password/'.$admin_id); } else { echo "#"; } ?>">

                    <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Old Password</label>

                          <input type="password" class="form-control" name="oldpassword" id="oldpassword">

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">New Password</label>

                          <input type="password" class="form-control" name="newpassword" id="newpassword">

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Confirm Password</label>

                          <input type="password" class="form-control" name="cpassword" id="cpassword">

                        </div>

                      </div>

                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Change Password</button>

                    <div class="clearfix"></div>

                  </form>

                </div>

              </div>

            </div>

          </div>

        </div>

    </div>