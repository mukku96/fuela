    <div class="content">

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">User Personal Detail
                    
                  <?php if(empty($userDetail['admin_value'])) { if(!empty($userDetail['id'])){ ?>
                    <a href="<?php if(!empty($userDetail['id'])) { echo base_url('users/credit-amount/'.$userDetail['id']); } else { echo "#"; } ?>" class="btn btn-danger" id="content-wrapper">Approve Account</a>
                  <?php }  } ?>
                  </h4>
                </div>

                <div class="card-body">

                  <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Name : </label>

                          <?php echo $userDetail['name'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Email : </label>

                          <?php echo $userDetail['email'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Mobile : </label>

                          <?php echo $userDetail['mobile'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">id type : </label>

                          <?php echo $userDetail['id_type'];?>

                        </div>

                      </div>

                      <div class="col-md-8">

                        <div class="form-group">

                          <label class="bmd-label-floating">id No : </label>

                          <?php echo $userDetail['id_number'];?>

                        </div>

                      </div>

                      <div class="col-md-12">

                        <div class="form-group">

                          <label class="bmd-label-floating">Address : </label>

                          <?php echo $userDetail['address'];?>

                        </div>

                      </div>

                      

                    </div>

                   

                  

                </div>

              </div>

            </div>

          <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">User Work Detail</h4>

                  <!--<p class="card-category">Complete your profile</p>-->

                </div>

                <div class="card-body">

                  <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">employer : </label>

                          <?php echo $userDetail['employer'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Occupation : </label>

                          <?php echo $userDetail['Occupation'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Experience : </label>

                          <?php echo $userDetail['experience_year']. ' '.$userDetail['experience_month'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">contact person : </label>

                          <?php echo $userDetail['contact_person'];?>

                        </div>

                      </div>

                      <div class="col-md-8">

                        <div class="form-group">

                          <label class="bmd-label-floating">Address : </label>

                          <?php echo $userDetail['work_address'];?>

                        </div>

                      </div>

                      <div class="col-md-12">

                        <div class="form-group">

                          <label class="bmd-label-floating">contact number : </label>

                          <?php echo $userDetail['contact_number'];?>

                        </div>

                      </div>

                      

                    </div>

                   

                  

                </div>

              </div>

            </div>

          <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">User Income Detail</h4>

                  <!--<p class="card-category">Complete your profile</p>-->

                </div>

                <div class="card-body">

                  <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">source income : </label>

                          <?php echo $userDetail['source_income'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">salary date : </label>

                          <?php echo $userDetail['salary_date'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">additional income : </label>

                          <?php echo $userDetail['additional_income']. ' '.$userDetail['experience_month'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">total income : </label>

                          <?php echo $userDetail['total_income'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">total expenses : </label>

                          <?php echo $userDetail['total_expenses'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">net income : </label>

                          <?php echo $userDetail['net_income'];?>

                        </div>

                      </div>

                      

                    </div>

                   

                  

                </div>

              </div>

            </div>

          <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">User Bank Detail</h4>

                  <!--<p class="card-category">Complete your profile</p>-->

                </div>

                <div class="card-body">

                  <div class="row">

                      <div class="col-md-6">

                        <div class="form-group">

                          <label class="bmd-label-floating">account holder name : </label>

                          <?php echo $userDetail['account_holder_name'];?>

                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group">

                          <label class="bmd-label-floating">bank name : </label>

                          <?php echo $userDetail['bank_name'];?>

                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group">

                          <label class="bmd-label-floating">account number : </label>

                          <?php echo $userDetail['account_number'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">branch code : </label>

                          <?php echo $userDetail['branch_code'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">branch Name : </label>

                          <?php echo $userDetail['branch_code'];?>

                        </div>

                      </div>

                      

                      

                    </div>

                   

                  

                </div>

              </div>

            </div>

          <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title">User Credited Request</h4>

                  <!--<p class="card-category">Complete your profile</p>-->

                </div>

                <div class="card-body">

                  <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">User Requested : </label>

                          <?php echo $userDetail['value'];?>

                        </div>

                      </div>

                      <?php

                        if(!empty($userDetail['admin_value'])){

                      ?>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">Admin Value : </label>

                          <?php echo $userDetail['admin_value'];?>

                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label class="bmd-label-floating">interest rate : </label>

                          <?php echo $userDetail['interest_rate'];?>

                        </div>

                      </div>

                      <?php

                            }

                      ?>

                      

                      

                      

                    </div>

                   

                  

                </div>

              </div>

            </div>

          </div>

        </div>

    </div>

  <div id="loadcontent_wrapper"></div>