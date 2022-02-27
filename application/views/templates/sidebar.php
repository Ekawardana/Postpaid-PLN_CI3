 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="text-warning fas fa-lightbulb"></i>
         </div>
         <div class="sidebar-brand-text mx-2">BAYAR<sup>l<i class="fas fa-bolt text-warning"></i>strik</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Ambil data dari session lalu isi variabel $level -->
     <?php $level = $this->session->userdata('id_level'); ?>
     <!-- Cek jika id_level 1 maka tampilkan menu admin -->
     <?php if ($level == 1) : ?>
         <!-- Heading -->
         <div class="sidebar-heading">
             Administrator
         </div>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
         <li class="nav-item">
             <a class="nav-link" href="<?= base_url('admin'); ?>">
                 <i class="fas fa-fw fa-home"></i>
                 <span>Dashboard</span>
             </a>
         </li>
         </li>
         <!-- Divider -->
         <hr class="sidebar-divider">

         <!-- Heading -->
         <div class="sidebar-heading">
             Kelola Data
         </div>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('tarif'); ?>">
                 <i class="fas fa-fw fa-lightbulb"></i>
                 <span>Data Tarif</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('dataPel'); ?>">
                 <i class="fas fa-fw fa-users"></i>
                 <span>Data Pelanggan</span>
             </a>
         </li>


         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('penggunaan'); ?>">
                 <i class="fas fa-fw fa-users"></i>
                 <span>Data Penggunaan</span>
             </a>
         </li>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider mt-3">

         <div class="sidebar-heading">
             Data Payment
         </div>


         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('tagihan'); ?>">
                 <i class="fas fa-fw fa-store"></i>
                 <span>Data Tagihan</span>
             </a>

             <a class="nav-link pb-0" href="<?= base_url('pembayaran'); ?>">
                 <i class="fas fa-fw fa-money-bill"></i>
                 <span>Data Pembayaran</span>
             </a>
         </li>
     <?php endif; ?>
     <!-- Divider -->
     <hr class="sidebar-divider mt-3">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->