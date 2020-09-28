    <div class="content">

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">Edit Profile</h4>

                  <p class="card-category">Complete your profile</p>

                </div>

                <div class="card-body">

                  <form id="fileupload-form" name="edit-profile" method="post" action="<?php if(!empty($admin_id)) { echo base_url('admin/do_edit_profile/'.$admin_id); } else { echo "#"; } ?>" enctype="multipart/form-data">
                    <div id="error_msg"></div>
                    <div class="row">
                    
                      <div class="col-md-3">

                        <div class="form-group">

                          <label class="bmd-label-floating">Username </label>

                          <input type="text" class="form-control" name="name" id="name" value="<?php if(!empty($admin['name'])) { echo  $admin['name']; } ?>">

                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group">

                          <label class="bmd-label-floating">Email address</label>

                          <input type="email" class="form-control"  name="email" id="email" value="<?php if(!empty($admin['email'])) { echo  $admin['email']; } ?>">

                        </div>

                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label class="bmd-label-floating">Password</label>

                          <input type="password" class="form-control" name="password" id="password" >

                        </div>

                      </div>

                    </div>

                    <!-- <div class="row">

                      <div class="col-md-12">

                        <div class="form-group">

                          <label class="bmd-label-floating">Profile Image</label>

                          <input type="file" class="form-control" name="image_url" id="image_url">
                          <br>
                          <?php if(!empty($admin['image_url'])) { ?>
                          <img src="<?php echo base_url('uploads/admin/'.$admin['image_url']); ?>" alt="Image Not found" height="120px" width="200px">
                          <?php } ?>
                        </div>

                      </div>

                    </div> -->

                    <button type="submit" class="btn btn-primary pull-right">Update Profile</button>

                    <div class="clearfix"></div>

                  </form>

                </div>

              </div>

            </div>

          </div>

        </div>

    </div>