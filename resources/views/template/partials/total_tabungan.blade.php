<div class="container-fluid" >
    <!-- Small boxes (Stat box) -->
    <div class="row">
        {{-- Pemasukan --}}
        <div class="container mt-3 col-md-3">
            <!-- small box -->
            <div class="bg-success">
                <div class="p-3 text-white">
                    <div class="d-flex justify-content-between">
                    <h3>{{"Rp " . number_format($T_pemasukan,0,',','.')}}</h3>
                    <i class="fas fa-arrow-alt-circle-up"></i>
                    </div>
                    <h5>Total Pemasukan</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        {{-- Pengeluaran --}}
        <div class="container mt-3 col-md-3">
            <!-- small box -->
            <div class="bg-warning">
            <div class="p-3 text-white">
                <div class="d-flex justify-content-between">
                <h3>{{"Rp " . number_format($T_pengeluaran,0,',','.')}}</h3>
                <i class="fas fa-arrow-alt-circle-down"></i>
                </div>

                <h5>Total Pengeluaran</h5>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            </div>
        </div>
        {{-- Total --}}
        <div class="container mt-3 col-md-3">
            <!-- small box -->
            <div class="{{ $T_pemasukan - $T_pengeluaran < 0 ? "bg-danger" : "bg-dark" }}">
            <div class="p-3 text-white">
                <div class="d-flex justify-content-between">
                <h3>{{"Rp " . number_format($T_pemasukan - $T_pengeluaran,0,',','.')}}</h3>
                <i class="fas fa-coins"></i>
                </div>
                <h5>Total Uang</h5>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            </div>
        </div>
    </div>
</div>