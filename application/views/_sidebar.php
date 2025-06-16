<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$bux=base_url();
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!--a href="welcome/home" class="brand-link">
      <img src="<?php echo $bu;?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Employee Self Service</span>
    </a-->
	<a href="#" class="brand-link navbar-light">
		<img src="<?php echo $bu;?>/my/img/pgd.png" alt="Pegadaian" class="brand-image" />
		<span class="brand-text font-weight-bold" style="color: black; font-weight: bold;">&nbsp;&nbsp;Network Monitoring</span>
	</a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) --
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $bu;?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div-->

      <!-- SidebarSearch Form --
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo $bux;?>welcome/home" class="nav-link home">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
		  <!--li class="nav-item">
            <a href="<?php echo $bux;?>mp" class="nav-link mp">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                Media Plan
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="<?php echo $bux;?>task" class="nav-link task">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                My Task
              </p>
            </a>
          </li-->
		  <li class="nav-item master">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=kanwils" class="nav-link kanwils">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Kanwil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=outlets" class="nav-link outlets">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Outlet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=outips" class="nav-link outips">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Outlet IP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=holidays" class="nav-link holidays">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Holiday</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=filters" class="nav-link filters">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Filter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=notifys" class="nav-link notifys">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Notify</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=kanusers" class="nav-link kanusers">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Kanwil User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=m2ms" class="nav-link m2ms">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>M2M</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item hr">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Tickets
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $bux?>tickets" class="nav-link attendance">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>mo" class="nav-link mo">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Open</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo $bux?>iv" class="nav-link iv">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Jarkom</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo $bux?>ss" class="nav-link ss">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Relokasi</p>
                </a>
              </li>
            </ul>
          </li>
          <!--li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li-->
		  <li class="nav-item reports">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $bux?>iv" class="nav-link hratt">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Summary</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo $bux?>iv" class="nav-link iv">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Diagram</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo $bux?>ss" class="nav-link ss">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Tickets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Ticket History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>SLA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Status Duration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Custom</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Outlets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Outlets History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Data Link</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>M2M</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $bux?>bp" class="nav-link bp">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Archieve</p>
                </a>
              </li>
            </ul>
          </li>
		<?php if(true){?>
		  <li class="nav-item setting">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $bux?>md/?p=lovs" class="nav-link lovs">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List of Values</p>
                </a>
              </li>
			  <!--li class="nav-item">
                <a href="<?php echo $bux?>md/?p=num" class="nav-link num">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>MP Numbering</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li-->
            </ul>
          </li>
		<?php }?>
		
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark ">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5><?php echo $session["username"]?></h5>
      <p><?php echo $session["usergrp"]?></p>
    </div>
	<nav class="mt-2">
		<ul class="nav nav-sidebar flex-column">
		<?php if($session["userlevel"]=='0'){?>
		  <li class="nav-item">
			<a href="<?php echo $bux?>md/?p=users" class="nav-link users">
			  <i class="nav-icon fas fa-users"></i>
			  <p>
				User List
			  </p>
			</a>
		  </li>
		<?php }?>
		  <li class="nav-item">
			<a href="#" onclick="resetForm('#fpwd')" data-toggle="modal" data-target="#modal-pwd" class="nav-link">
			  <i class="nav-icon fas fa-user-lock"></i>
			  <p>
				Change Password
			  </p>
			</a>
		  </li>
		  <li class="nav-item">
			<a href="<?php echo $bux?>sign/out" class="nav-link">
			  <i class="nav-icon fas fa-sign-out-alt"></i>
			  <p>
				Sign Out
			  </p>
			</a>
		  </li>
		</ul>
	</nav>
  </aside>
  <!-- /.control-sidebar -->
  
  