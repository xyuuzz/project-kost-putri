<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
    <a href="index.html">Website KP &middot; PK</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Kost Putri Pak Kaji</li>

        {{-- Jika user belum login tampilkan sidebar home --}}
        @if(!Auth::check())
            <li class="nav-item {{request()->is("/") ? 'active' : ''}}">
            <a href="{{route("home")}}" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
            </li>
            {{-- <li class="nav-item {{request()->is("harga/kamar-kost") ? 'active' : ''}}">
            <a href="{{route("harga_kost")}}" class="nav-link"><i class="fas fa-person-booth"></i><span>Daftar Harga Kamar Kost</span></a>
            </li> --}}
        @endif

        {{-- Jika user sudah login maka menu ini akan terlihat, jika belum akan disembunyikan --}}
        @auth

            {{-- Menu yang akan dilihat oleh user --}}
            @if( Auth::id() !== 1 )
                {{-- Pembayaran --}}
                <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-dollar-sign"></i> <span>Pembayaran</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route("cicilan")}}">Cicilan</a></li>
                    <li><a class="nav-link" href="{{route("bulanan")}}">Bulanan</a></li>
                </ul>
                </li>

                {{-- Mengelola Keuangan --}}
                <li class="nav-item dropdown {{request()->is("saving") ? "active" : ""}}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-receipt"></i> <span>Keuangan</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{route("daftar_transaksi")}}">Daftar Transaksi</a>
                    </li>
                    <li><a class="nav-link" href="{{route("saving.index")}}">Diary Pemasukan</a></li>
                </ul>
                </li>
            @endif


            {{-- Mengelola Akun Mbak Kost / Menu yang akan dilihat oleh admin--}}
            @if( Auth::user()->role === "admin" )
                <li class="nav-item dropdown  ? {{Auth::user()->role === "admin" ? 'active' : ''}} ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-home"></i> <span>Kelola Akun Kost</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route("home_admin")}}">Halaman Admin</a></li>
                    <li><a class="nav-link" href="{{route("list_kritik_saran")}}">Daftar Saran dan Kritik</a></li>
                    <li><a class="nav-link" href="{{route("index.kamar_kost")}}">Kelola Kamar Kost</a></li>
                </ul>
                </li>
            @endif
            @if (Auth::user()->role === "admin")
                <li class="nav-item ">
                    <a href="{{route("daftar_transaksi")}}" class="nav-link"><i class="fas fa-receipt"></i> <span>Daftar Transaksi</span></a>
                </li>
            @endif
        @endauth

    </ul>
</aside>
