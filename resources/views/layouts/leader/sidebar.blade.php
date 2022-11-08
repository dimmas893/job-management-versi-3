        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Job Management</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            @php
                $anggota = \App\Models\User::where('id', Auth::User()->id)->where('jabatan', 'anggota')->first(); 
                $leader = \App\Models\User::where('id', Auth::User()->id)->where('jabatan', 'leader')->first(); 
            @endphp

            @if ($anggota)
                <li class="nav-item">
                    <a class="nav-link" href="/anggota">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Management Pekerjaan</span></a>
                </li>
            @endif
            
            @if ($leader)
                <li class="nav-item">
                    <a class="nav-link" href="/leader">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Management Pekerjaan</span></a>
                </li>   
            @endif

            

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>