@extends("template.master")

@section("content")

@include("template.alert")

{{-- Ini untuk Card foto corausel dan peraturan kost  --}}
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h4>Foto Lingkungan Kost Putri Pak Kaji</h4>
            </div>
            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset("images/pict 1.jpeg")}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset("images/pict 2.jpeg")}}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset("images/pict 3.jpeg")}}" alt="Third slide">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h4 class="text-danger">Contoh Bagian Dalam Kamar Kost</h4>
            </div>
            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block" width="380px" height="500px" src="{{asset("images/contoh1.jpeg")}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block" width="380px" height="500px" src="{{asset("images/contoh2.jpeg")}}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block" width="380px" height="500px" src="{{asset("images/contoh3.jpeg")}}" alt="Third slide">
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>


{{-- Card untuk Deskripsi Tentang Kost Putri Pak Kaji --}}
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Deskripsi Tentang KPu . Pak Kaji</h3>
            </div>
            <div class="card-body">
                <p>Kost Putri Pak Kaji terletak di dalam Gang Tambak Boyo Lor no.2 RT 08 RW 07 . Tepat Di depan Kampus STIE BPD Jateng JL . Soekarno Hatta 99. Kost Putri Pak Kaji menawarkan fasilitas Kost dengan Kamar Mandi dalam berjumlah ... Kamar dan Kamar Mandi Luar berjumlah ... kamar . </p>
                <p>Kost Putri Pak Kaji memiliki halaman yang luas serta lingkungan yang asri sehingga penghuni nyaman dan betah di dalam kost. Disini Penghuni juga di fasilitasi oleh WIFI dengan kecepatan ... sehingga penghuni tidak perlu takut boros uang karena penggunaan paket data yang boros. </p>
                <p>Disini Kami Menawarkan Paket 10 bulan bagi mahasiswa yang ingin nge-kost di sini, dengan benefit pembayaran selanjutnya akan mendapat diskon 10% selama 1 tahun. Dan Bagi mahasiswa yang Membeli Paket 10 Bulan akan mendapat keuntungan jika mengajak temanya untuk kost disini, Mahasiswa yang diajak nya tersebut akan mendapat diskon sebesar 10% selama 6 bulan. </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info">
            <div class="card-title align-self-center">
                <h5 class=" mt-3 pt-2 pb-2 pl-4 pr-4 bg-success rounded-pill">Saran Dan Kritik</h5>
            </div>
            <form action="{{ route('store_saran_kritik' )}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="my-input">Nama</label>
                        <input id="my-input" class="form-control " type="text" name="nama" required >
                        @error("name")
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="my-textarea">Kritik dan Saran</label>
                        <textarea id="my-textarea" class="form-control h-auto" name="saran_kritik" rows="10" required></textarea>
                        @error("deskripsi")
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>




@stop
