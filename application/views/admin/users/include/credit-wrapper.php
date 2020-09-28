<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form id="crdits-form" name="credit-allow" method="post" action="<?php if(!empty($user_id)) { echo base_url('users/do_credit_amount/'.$user_id); } else { echo "#"; } ?>">

          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label class="bmd-label-floating">Allow amount </label>

                <input type="text" class="form-control" name="amount" id="amount">

              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Intrest (%)</label>
                <input type="text" class="form-control" name="intrest" id="intrest">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary pull-left">Submit</button>
          <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right">Close</button> -->
          <div class="clearfix"></div>
          </form>
        </div>
        <!-- <div class="modal-footer">
          
        </div>  -->
      </div>
    </div>
  </div>