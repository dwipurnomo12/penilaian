<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="/assets/img/admin-avatar.png" width="45px" />
            </div>
            @if (auth()->check())
                <div class="admin-info">
                    @if (auth()->user()->IsAdmin())
                        <div class="font-strong">{{ auth()->user()->admin->name }}</div><small>Admin</small>
                    @elseif (auth()->user()->IsGuru())
                        <div class="font-strong">{{ auth()->user()->guru->nm_guru }}</div><small>Guru</small>
                    @elseif (auth()->user()->IsSiswa())
                        <div class="font-strong">{{ auth()->user()->siswa->nm_siswa }}</div><small>Siswa</small>
                    @endif
                </div>
            @endif

        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="heading">DATA MASTER</li>
                <li>
                    <a class="active" href="/siswa"><i class="sidebar-item-icon fa fa-solid fa-users"></i>
                        <span class="nav-label">Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/guru"><i class="sidebar-item-icon fa fa-solid fa-user-tie"></i>
                        <span class="nav-label">Data Guru</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/kelas"><i class="sidebar-item-icon fa fa-solid fa-landmark"></i>
                        <span class="nav-label">Kelas</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/mata-pelajaran"><i class="sidebar-item-icon fa fa-book"></i>
                        <span class="nav-label">Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/tahun-ajaran"><i class="sidebar-item-icon fa fa-calendar-day"></i>
                        <span class="nav-label">Tahun Ajaran</span>
                    </a>
                </li>
            @elseif (auth()->user()->isGuru())
                <li class="heading">PENGOLAHAN DATA</li>
                <li>
                    <a class="active" href="/penilaian"><i class="sidebar-item-icon fa fa-solid fa-arrow-up-9-1"></i>
                        <span class="nav-label">Penilaian</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/absensi"><i class="sidebar-item-icon fa fa-address-book"></i>
                        <span class="nav-label">Absensi</span>
                    </a>
                </li>

                <li class="heading">LAPORAN</li>
                <li>
                    <a class="active" href="/laporan-nilai"><i class="sidebar-item-icon fa fa-file-signature"></i>
                        <span class="nav-label">Laporan Nilai</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/laporan-absensi"><i class="sidebar-item-icon fa fa-file-import"></i>
                        <span class="nav-label">Laporan Absensi</span>
                    </a>
                </li>
            @elseif (auth()->user()->isSiswa())
                <li class="heading">LAPORAN</li>
                <li>
                    <a class="active" href="/cek-nilai"><i class="sidebar-item-icon fa fa-file-signature"></i>
                        <span class="nav-label">Cek Nilai</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/cek-absensi"><i class="sidebar-item-icon fa fa-file-import"></i>
                        <span class="nav-label">Cek Absensi</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</nav>
