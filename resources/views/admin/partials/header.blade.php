    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo"><b>Meat</b>Empire</a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- Notifications: style can be found in dropdown.less -->              
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Meat Empire</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                    <p>
                      Meat
                      <small>Empire</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                 <!--  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->


                  <!-- Menu Footer-->
                  <li class="user-footer">
                  <!--   <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="{{url('admin-logout')}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Meat Empire Admin</p>

              <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
          </div>
          <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
      
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
            </li>

             <li class="treeview">
              <a href="{{url('admin-dashboard')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
              </a>
              </li>

            <li class="treeview">
              <a href="{{url('user')}}">
                <i class="fa fa-user"></i>
                <span>User Management</span>
              </a>
            </li>

            <li class="treeview">
              <a href="{{url('categories')}}">
                <i class="fa fa-th-large"></i>
                <span>Category Management</span>
               
              </a>
            </li>

            <li class="treeview">
              <a href="{{url('product')}}">
                <i class="fa fa-list-alt"></i>
                <span>Product Management</span>
              </a>
            </li>

            <li class="treeview">
              <a href="{{url('testimonials')}}">
                <i class="fa fa-user"></i>
                <span>Testimonial Management</span>
              </a>
            </li>
            <li class="treeview">
              <a href="{{url('deal-of-day')}}">
                <i class="fa fa-thumbs-up"></i>
                <span>Deal Of Day Management</span>
              </a>
            </li>
           <li class="treeview">
              <a href="{{url('co-brand')}}">
                <i class="fa fa-cog"></i>
                <span>Co Brand Management</span>
              </a>
          </li>
          <li class="treeview">
              <a href="{{url('coupon')}}">
                <i class="fa fa-cog"></i>
                <span>Coupon Management</span>
              </a>
           </li>

<!--           <li class="treeview">
              <a href="{{url('tax')}}">
                <i class="fa fa-cog"></i>
                <span>Tax Management</span>
              </a>
           </li> -->
          <li class="treeview">
              <a href="{{url('order')}}">
                <i class="fa fa-cog"></i>
                <span>Order Management</span>
              </a>
           </li>

           <li class="treeview">
              <a href="{{url('cutting-instructions-view')}}">
                <i class="fa fa-cog"></i>
                <span>Cutting Instr Management</span>
              </a>
           </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i> <span>City Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('city')}}"><i class="fa fa-circle-o"></i>Apply Category</a></li>
                <li><a href="{{url('min-order-amount')}}"><i class="fa fa-circle-o"></i>Manage Min Amount</a></li>
                <li><a href="{{url('sector')}}"><i class="fa fa-circle-o"></i>Sector Management</a></li>
                <!-- <li><a href="{{url('cms-best-seller')}}"><i class="fa fa-circle-o"></i>Best Seller</a></li> -->
                <!-- <li><a href="{{url('cms-deal-of-day')}}"><i class="fa fa-circle-o"></i>Deal Of the Day</a></li> -->
              </ul>
            </li>


              <li class="treeview">
              <a href="#">
                <i class="fa fa-copy"></i> <span>Report</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('payment-report')}}"><i class="fa fa-circle-o"></i>Payment Report</a></li>
                <li><a href="{{url('order-report')}}"><i class="fa fa-circle-o"></i>Order Report</a></li>
                <!-- <li><a href="{{url('cms-best-seller')}}"><i class="fa fa-circle-o"></i>Best Seller</a></li> -->
                <!-- <li><a href="{{url('cms-deal-of-day')}}"><i class="fa fa-circle-o"></i>Deal Of the Day</a></li> -->
              </ul>
            </li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-picture-o"></i> <span>CMS</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('cms-topbar-category')}}"><i class="fa fa-circle-o"></i>Top Header Category</a></li>
                <li><a href="{{url('cms-explore-by-category')}}"><i class="fa fa-circle-o"></i>Explore By Categories</a></li>
                <li><a href="{{url('cms-best-seller')}}"><i class="fa fa-circle-o"></i>Best Seller</a></li>
                <li><a href="{{url('cms-deal-of-day')}}"><i class="fa fa-circle-o"></i>Deal Of the Day</a></li>
            <!--     <li><a href="{{url('cms-coupon')}}"><i class="fa fa-circle-o"></i>Coupon Code</a></li> -->
              </ul>
            </li>

<!--            <li class="treeview">
              <a href="#">
                <i class="fa fa-picture-o"></i> <span>Discount</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('signup-discount')}}"><i class="fa fa-circle-o"></i>Sign Up Discount</a></li>
                <li><a href="{{url('discount')}}"><i class="fa fa-circle-o"></i>
                Amount Discount
                </a></li>
                <li><a href="{{url('happy-hours-discount')}}"><i class="fa fa-circle-o"></i>
                Happy Hours Discount
                </a></li>
                <li><a href="{{url('launching-discount')}}"><i class="fa fa-circle-o"></i>Inaugral/Launch Discount </a></li>
               
              </ul>
            </li> -->
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
