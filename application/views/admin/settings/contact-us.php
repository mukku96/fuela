<div class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Contact-us</h4>
          <p class="card-category">Edit Contact-us detail</p>
        </div>
        <div class="card-body">
          <form name="common-form" id="common-form" action="<?php if(!empty($contacts['id'])){ echo base_url('settings/do-update-contact/'.$contacts['id']); } else { echo "#";} ?>" method="post" >
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Contact Number</label>
                  <input type="text" class="form-control" name="contact_number" id="contact_number" value="<?php if(!empty($contacts['contact_number'])){ echo $contacts['contact_number']; } ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Contact Email Id</label>
                  <input type="text" class="form-control" name="contact_email" id="contact_email" value="<?php if(!empty($contacts['contact_email'])){ echo $contacts['contact_email']; } ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Contact-us details</label>
                  <div class="form-group">
                    <label class="bmd-label-floating"> Enter Details Here.</label>
                    <textarea class="form-control" rows="5" name="description" id="description"><?php if(!empty($contacts['description'])){ echo $contacts['description']; } ?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>