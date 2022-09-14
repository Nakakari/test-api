 <div class="leftside-menu">

     <!-- LOGO -->
     <a href="/" class="logo text-center logo-light">
         <span class="logo-lg">
             <img src="{{ asset('template') }}/assets/images/logo.png" alt="" height="16">
         </span>
         <span class="logo-sm">
             <img src="{{ asset('template') }}/assets/images/logo_sm.png" alt="" height="16">
         </span>
     </a>

     <!-- LOGO -->
     <a href="/" class="logo text-center logo-dark">
         <span class="logo-lg">
             <img src="{{ asset('template') }}/assets/images/logo-dark.png" alt="" height="16">
         </span>
         <span class="logo-sm">
             <img src="{{ asset('template') }}/assets/images/logo_sm_dark.png" alt="" height="16">
         </span>
     </a>

     <div class="h-100" id="leftside-menu-container" data-simplebar>

         <!--- Sidemenu -->
         {{-- Admin --}}
         @if (Auth::user()->type == 'admin')
             <ul class="side-nav">

                 <li class="side-nav-item active">
                     <a href="/admin/home" class="side-nav-link">
                         <i class="uil-home-alt"></i>
                         <span> Dashboards </span>
                     </a>
                 </li>
                 <li class="side-nav-title side-nav-item">Master Data Produk</li>
                 <li class="side-nav-item">
                     <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false"
                         aria-controls="sidebarTasks" class="side-nav-link">
                         <i class="uil-key-skeleton-alt"></i>
                         <span> Master Data Produk</span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarTasks">
                         <ul class="side-nav-second-level">
                             <li>
                                 <a href="/produk">Produk</a>
                             </li>
                             <li>
                                 <a href="/transaksi">Transaksi</a>
                             </li>
                         </ul>
                     </div>
                 </li>
             </ul>
         @else
             <ul class="side-nav">

                 <li class="side-nav-item">
                     <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false"
                         aria-controls="sidebarDashboards" class="side-nav-link">
                         <i class="uil-home-alt"></i>
                         <span> Dashboards </span>
                     </a>
                 </li>
             </ul>
         @endif

         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

 </div>
