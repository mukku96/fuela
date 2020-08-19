<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"> Help </h4>
                  <p class="card-category"> Users query list view </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                      <thead class="">
                        <th> ID </th>
                        <th> Name </th>
                        <th> Email Id </th>
                        <th> Query </th>
                        <th> Action </th>
                      </thead>
                        <tbody>
                        <?php 
                          if(!empty($helps)){ 
                            $i = 1;
                            foreach($helps as $help){  
                        ?>
                        <tr>
                          <td>  <?php echo $i; ?>  </td>
                          <td>  <?php echo $help['name']; ?></td>
                          <td>  <?php echo $help['email']; ?></td>
                          <td>  <?php echo $help['query']; ?></td>
                          <td>  <a href="#" class="btn btn-primary"> View Fulll details </a> </td>
                        </tr>
                        <?php $i++; } } else { ?>
                        <tr>
                          <td colspan="5" class="text-danger text-center">
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