 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ url('/') }}" class="brand-link">
         <span class="brand-text font-weight-light h2">{{ env('APP_NAME') }}</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">


         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <li class="nav-item">
                     <a href="{{ url('/') }}" class="nav-link">
                         <i class="nav-icon fas fa-home"></i>
                         <p>
                             Home
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ url('/candidate') }}" class="nav-link">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             Candidate
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
