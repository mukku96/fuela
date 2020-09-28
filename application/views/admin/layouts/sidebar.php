    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?php echo base_url('public/assets/img/sidebar-1.jpg');?>">

      <div class="logo"><a href="<?php echo base_url('admin/home');?>" class="simple-text logo-normal">

          Fuela Dashboard

        </a></div>

      <div class="sidebar-wrapper">

        <ul class="nav">

          <li class="nav-item <?php if($title == 'Dashboard' || $title == 'Edit Profile' || $title == 'Change Password') { echo "active"; } ?>">

            <a class="nav-link" href="<?php echo base_url('admin/home');?>">

              <i class="material-icons">dashboard</i>

              <p>Dashboard</p>

            </a>

          </li>

          <li class="nav-item <?php if($title == 'Users'){ echo "active"; } ?> ">

            <a class="nav-link" href="<?php echo base_url('users');?>">

              <i class="material-icons">person</i>

              <p>Users</p>

            </a>

          </li>

          <li class="nav-item <?php if($title == 'Currency'){ echo "active"; } ?> ">

            <a class="nav-link" href="<?php echo base_url('admin/currency');?>">

              <i class="material-icons">money</i>

              <p>Currency</p>

            </a>

          </li>

          <li class="nav-item <?php if($title == 'Users Notifications'){ echo "active"; } ?>">

            <a class="nav-link" href="<?php echo base_url('notifications'); ?>">

              <i class="material-icons">notifications</i>

              <p>Notifications</p>

            </a>

          </li>

          <li class="nav-item <?php if($title == 'Settings' || $title == 'Terms and Condition' || $title == 'Legal Policy' || $title == 'Help' || $title == 'Contact-us'){ echo "active"; } ?>">

            <a class="nav-link showMenu" href="#">

            <i class="material-icons">unarchive</i>

              <p>Settings</p>

              <div class ="settingMenu">

                <ul>

                  <li><a href ="<?php echo base_url('settings/help'); ?>">Help</a></li>
                  <li><a href ="<?php echo base_url('settings/contact-us'); ?>">Contact-us</a></li>
                  <li><a href ="<?php echo base_url('settings/terms-condition'); ?>">Term & Condition</a></li>

                  <li><a href ="<?php echo base_url('settings/legal-policy'); ?>">Legal Policy</a></li>

                </ul>

              </div>



            </a>

          </li>

        </ul>

      </div>

    </div>

    <div class="main-panel">

      <!-- Navbar -->

      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">

        <div class="container-fluid">

          <div class="navbar-wrapper">
          <?php if(!empty($title)) { ?>
            <a class="navbar-brand" href="<?php echo base_url('admin/home');?>"><?php echo $title; ?></a>
          <?php } ?>
          </div>

          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">

            <span class="sr-only">Toggle navigation</span>

            <span class="navbar-toggler-icon icon-bar"></span>

            <span class="navbar-toggler-icon icon-bar"></span>

            <span class="navbar-toggler-icon icon-bar"></span>

          </button>

          <div class="collapse navbar-collapse justify-content-end">

            <form class="navbar-form" style="display:none">

              <div class="input-group no-border">

                <input type="text" value="" class="form-control" placeholder="Search...">

                <button type="submit" class="btn btn-white btn-round btn-just-icon">

                  <i class="material-icons">search</i>

                  <div class="ripple-container"></div>

                </button>

              </div>

            </form>

            <ul class="navbar-nav">

              <li class="nav-item">

                <a class="nav-link" href="<?php echo base_url('admin/home');?>">

                  <i class="material-icons">dashboard</i>

                  <p class="d-lg-none d-md-block">

                    Stats

                  </p>

                </a>

              </li>

              <li class="nav-item dropdown">

                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <i class="material-icons">notifications</i>

                  <span class="notification">5</span>

                  <p class="d-lg-none d-md-block">

                    Some Actions

                  </p>

                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                  <a class="dropdown-item" href="#">Mike John responded to your email</a>

                  <a class="dropdown-item" href="#">You have 5 new tasks</a>

                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>

                  <a class="dropdown-item" href="#">Another Notification</a>

                  <a class="dropdown-item" href="#">Another One</a>

                </div>

              </li>

              <li class="nav-item dropdown">

                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                  <i class="material-icons">person</i>

                  <p class="d-lg-none d-md-block">

                    Account

                  </p>

                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                  <?php  if($this->session->userdata('admin_id')) { $admin_id = $this->session->userdata('admin_id'); } else{ $admin_id = '#';} ?>

                  <a class="dropdown-item" href="<?php echo base_url('admin/edit-profile/'.$admin_id);?>">Edit Profile</a>

                  <a class="dropdown-item" href="<?php echo base_url('admin/change-password/'.$admin_id);?>">Change Password</a>

                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item"  id="logout" href="<?php echo base_url('admin/logout'); ?>">Log out</a>

                </div>

              </li>

            </ul>

          </div>

        </div>

      </nav>

      <!-- End Navbar -->