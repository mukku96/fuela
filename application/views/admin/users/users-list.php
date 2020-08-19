<div class="content">

        <div class="container-fluid">

          <div class="row">

            <div class="col-md-12">

              <div class="card card-plain">

                <div class="card-header card-header-primary">

                  <h4 class="card-title mt-0"> Users</h4>

                  <p class="card-category"> All users list view</p>

                </div>

                <div class="card-body">

                  <div class="table-responsive">

                    <table class="table table-hover" id="dataTable">

                      <thead class="">

                        <th> ID </th>

                        <th> Image </th>

                        <th> Name </th>

                        <th> Contact </th>

                        <th> Email </th>

                        <th> Status </th>

                        <th> Action </th>

                      </thead>

                        <tbody>

                        <?php 

                          if(!empty($users)){ 

                            $i = 1;

                            foreach($users as $user){  

                        ?>

                        <tr>

                          <td> <?php echo $i; ?>  </td>

                          <td>  <img src="<?php if(!empty($user['image_url'])) { echo base_url('uploads/users/'.$user['image_url']);} else { echo base_url('public/assets/img/faces/avatar1.jpg'); } ?>" alt="Image Not Found" height="100px" width="150px" style="border-radius: 50%;"></td>

                          <td>  <?php echo $user['name']; ?></td>

                          <td>  <?php echo $user['mobile']; ?></td>

                          <td>  <?php echo $user['email']; ?></td>

                          <td>  <?php echo $user['is_block']; ?></td>

                          <td>  Action </td>

                        </tr>

                        <?php $i++; } } else { ?>

                        <tr>

                          <td colspan="7" class="text-danger text-center">

                            <?php echo "No record found here.!"; ?>

                          </td>

                        </tr>

                        <?php } ?>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>