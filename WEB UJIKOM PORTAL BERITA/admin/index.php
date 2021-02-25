<?php 
   @session_start();
   include "../inc/koneksi.php";
   if (@$_SESSION['username']) 
   {
     if (@!$_SESSION['tipe_user'] =="admin")  
       {
         header("location:admin/index.php");
       }
     else{
       if (@$_SESSION['tipe_user'] =="author") 
         { 
           header("location:author/index.php");
       }
     }
   }
   else{
     header("location:../inc/login.php");
   }
   
   $username=$_SESSION['username'];
   $QUERY="SELECT * FROM login WHERE username='$username'";
   $result=mysqli_query($koneksi,$QUERY);

    ?>
    <?php
if (mysqli_num_rows($result)) {
   $data_user=mysqli_fetch_array($result);
   $_SESSION['id_login']=$data_user['id_login'];
   $_SESSION['nama_lengkap']=$data_user['nama_lengkap'];
   $_SESSION['gambar']=$data_user['gambar'];
   $_SESSION['username']=$data_user['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from themesbrand.com/skote/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jan 2021 03:07:23 GMT -->
   <head>
      <meta charset="utf-8" />
      <title>Admin | Portal Berita</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
      <meta content="Themesbrand" name="author" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="assets/images/favicon.ico">
      <!-- Bootstrap Css -->
      <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <!-- Icons Css -->
      <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

      <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

      <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
   </head>
   <body data-sidebar="dark">
      <!-- <body data-layout="horizontal" data-topbar="dark"> -->
      <!-- Begin page -->
      <div id="layout-wrapper">
         <header id="page-topbar">
            <div class="navbar-header">
               <div class="d-flex">
                  <!-- LOGO -->
                  <div class="navbar-brand-box">
                     <a href="index.html" class="logo logo-dark">
                     <span class="logo-sm">
                     <img src="assets/images/logo.svg" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                     <img src="assets/images/logo-dark.png" alt="" height="17">
                     </span>
                     </a>
                     <a href="index.php" class="logo logo-light">
                     <span class="logo-sm">
                     <img src="assets/images/logo-light.svg" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                     <img src="assets/images/logo-light.png" alt="" height="19">
                     </span>
                     </a>
                  </div>
                  <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                  <i class="fa fa-fw fa-bars"></i>
                  </button>
                  <!-- App Search-->
                  <form class="app-search d-none d-lg-block">
                     <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                     </div>
                  </form>
               </div>
               <div class="d-flex">
                  <div class="dropdown d-inline-block d-lg-none ml-2">
                     <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="mdi mdi-magnify"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                           <div class="form-group m-0">
                              <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="dropdown d-none d-lg-inline-block ml-1">
                     <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                     <i class="bx bx-fullscreen"></i>
                     </button>
                  </div>
                  <div class="dropdown d-inline-block">
                     <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="rounded-circle header-profile-user" src="../pages/images/profile/<?php echo $_SESSION['gambar'] ?>"
                        alt="Header Avatar">
                     <span class="d-none d-xl-inline-block ml-1" key="t-henry"><?php echo $_SESSION['nama_lengkap'] ?></span>
                     <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="?page=profil"><i class="bx bx-user font-size-16 align-middle mr-1"></i> <span key="t-profile">Profile</span></a>
                        <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                        <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> <span key="t-settings">Settings</span></a>
                        <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="../inc/logout.php"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                     </div>
                  </div>
                  <div class="dropdown d-inline-block">
                     <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                     <i class="bx bx-cog bx-spin"></i>
                     </button>
                  </div>
               </div>
            </div>
         </header>
         <!-- ========== Left Sidebar Start ========== -->
         <div class="vertical-menu">
            <div data-simplebar class="h-100">
               <!--- Sidemenu -->
               <div id="sidebar-menu">
                  <!-- Left Menu Start -->
                  <ul class="metismenu list-unstyled" id="side-menu">
                     <li class="menu-title" key="t-menu">Dashboard</li>
                     <li>
                        <a href="index.php" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">04</span>
                        <span key="t-dashboards">Dashboards</span>
                        </a>
                     </li>
                     <li class="menu-title" key="t-apps">Menu</li>
                     <?php @$page = $_GET['page']; ?>
                     <li <?php if ($page == "kategori") { ?> class = "active" <?php }  ?>>
                        <a href="?page=kategori" class="waves-effect">
                        <i class="bx bx-menu"></i>
                        <span key="t-calendar">Kategori</span>
                        </a>
                     </li>
                     <li <?php if ($page == "post") { ?> class = "active" <?php }  ?>>
                        <a href="?page=post" class="waves-effect">
                        <i class="bx bx-edit"></i>
                        <span key="t-calendar">Postingan</span>
                        </a>
                     </li>
                     <li <?php if ($page == "user") { ?> class = "active" <?php }  ?>>
                        <a href="?page=user" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-calendar">User</span>
                        </a>
                     </li>
                     <li <?php if ($page == "iklan") { ?> class = "active" <?php }  ?>>
                        <a href="?page=iklan" class="waves-effect">
                        <i class="bx bx-card"></i>
                        <span key="t-calendar">Iklan</span>
                        </a>
                     </li>
                     <li <?php if ($page == "headline") { ?> class = "active" <?php }  ?>>
                        <a href="?page=headline" class="waves-effect">
                        <i class="bx bx-list-check"></i>
                        <span key="t-calendar">Headline</span>
                        </a>
                     </li>
                     <li <?php if ($page == "instansi") { ?> class = "active" <?php }  ?>>
                        <a href="?page=instansi" class="waves-effect">
                        <i class="bx bxs-business"></i>
                        <span key="t-calendar">Instansi</span>
                        </a>
                     </li>
                     <li class="menu-title" key="t-apps">Media</li>
                     <li <?php if ($page == "foto") { ?> class = "active" <?php }  ?>>
                        <a href="?page=foto" class="waves-effect">
                        <i class="bx bx-image-add"></i>
                        <span key="t-calendar">Picture</span>
                        </a>
                     </li>
                     <li <?php if ($page == "video") { ?> class = "active" <?php }  ?>>
                        <a href="?page=video" class="waves-effect">
                        <i class="bx bxs-video-plus"></i>
                        <span key="t-calendar">Video</span>
                        </a>
                     </li>
                  </ul>
               </div>
               <!-- Sidebar -->
            </div>
         </div>
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <?php  
                     //include "../inc/informasi.php";
                     include "../inc/menu.php";
                     
                     ?>
                  <!-- main content -->
               </div>
               <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <!-- Modal -->
            <div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                        <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>
                        <div class="table-responsive">
                           <table class="table table-centered table-nowrap">
                              <thead>
                                 <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th scope="row">
                                       <div>
                                          <img src="assets/images/product/img-7.png" alt="" class="avatar-sm">
                                       </div>
                                    </th>
                                    <td>
                                       <div>
                                          <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                          <p class="text-muted mb-0">$ 225 x 1</p>
                                       </div>
                                    </td>
                                    <td>$ 255</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">
                                       <div>
                                          <img src="assets/images/product/img-4.png" alt="" class="avatar-sm">
                                       </div>
                                    </th>
                                    <td>
                                       <div>
                                          <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                          <p class="text-muted mb-0">$ 145 x 1</p>
                                       </div>
                                    </td>
                                    <td>$ 145</td>
                                 </tr>
                                 <tr>
                                    <td colspan="2">
                                       <h6 class="m-0 text-right">Sub Total:</h6>
                                    </td>
                                    <td>
                                       $ 400
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="2">
                                       <h6 class="m-0 text-right">Shipping:</h6>
                                    </td>
                                    <td>
                                       Free
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="2">
                                       <h6 class="m-0 text-right">Total:</h6>
                                    </td>
                                    <td>
                                       $ 400
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end modal -->
            <footer class="footer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Skote.
                     </div>
                     <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                           Design & Develop by Themesbrand
                        </div>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
         <!-- end main content-->
      </div>
      <!-- END layout-wrapper -->
      <!-- Right Sidebar -->
      <div class="right-bar">
         <div data-simplebar class="h-100">
            <div class="rightbar-title px-3 py-4">
               <a href="javascript:void(0);" class="right-bar-toggle float-right">
               <i class="mdi mdi-close noti-icon"></i>
               </a>
               <h5 class="m-0">Settings</h5>
            </div>
            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>
            <div class="p-4">
               <div class="mb-2">
                  <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
               </div>
               <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                  <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
               </div>
               <div class="mb-2">
                  <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
               </div>
               <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" />
                  <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
               </div>
               <div class="mb-2">
                  <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
               </div>
               <div class="custom-control custom-switch mb-5">
                  <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
                  <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
               </div>
            </div>
         </div>
         <!-- end slimscroll-menu-->
      </div>
      <!-- /Right-bar -->
      <!-- Right bar overlay-->
      <div class="rightbar-overlay"></div>
      <!-- JAVASCRIPT -->
      <script src="assets/libs/jquery/jquery.min.js"></script>
      <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/libs/metismenu/metisMenu.min.js"></script>
      <script src="assets/libs/simplebar/simplebar.min.js"></script>
      <script src="assets/libs/node-waves/waves.min.js"></script>
      <!-- apexcharts -->
      <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
      <script src="assets/js/pages/dashboard.init.js"></script>
      <!-- App js -->
      <script src="assets/js/app.js"></script>

       <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>    

        <script src="assets/js/app.js"></script>
   </body>
   <!-- Mirrored from themesbrand.com/skote/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jan 2021 03:07:34 GMT -->
</html>