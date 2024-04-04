<header class="header">
    <div class="page-brand">
        <a class="link" href="index.html">
            <span class="brand">SI NILAI</span>
            <span class="brand-mini">SN</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">

            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="/assets/img/admin-avatar.png" />
                    <span></span><i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                Swal.fire({
                                    title: 'Konfirmasi Keluar',
                                    text: 'Apakah Anda yakin ingin keluar?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Keluar!'
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                      document.getElementById('logout-form').submit();
                                    }
                                  });">
                        <i class="fa fa-power-off"></i> {{ __('Keluar') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </a>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
