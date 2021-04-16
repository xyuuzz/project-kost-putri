@extends("template.master", ["title" => "Table Keuangan", "header" => "Table List Tabungan Keuangan"])


{{-- Content --}}
@section('content')
<br>
{{-- Alert pemberitahun tambah hapus dan update data --}}
@include("template.alert")

<?php $id = 1; ?>

@include("template.partials.total_tabungan")
<br><hr>

{{-- Tombol tambah Data --}}
<a type="button" class="btn btn-primary m-3 ml-md-3 float-left" href="{{ route('saving.create')}}"> <i class="far fa-plus-square pr-2"></i> Tambah Data </a>
<br><br><br>
    @if ( count($Table) ) {{-- Jika isi table ada , maka tampilkan table, jika tidak maka tampilkan tulisan --}}
        <h3 class="mb-3">Daftar Data</h3>
        @foreach ($Table as $data)
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ date("d-F-Y" ,strtotime($data->tanggal)) }}</h4>
                    <div class="d-flex">
                        <a class="btn btn-warning" href="{{ route('saving.edit', ['saving' => $data->id]) }}">Edit</a>
                        <form action="{{ route('saving.destroy', ['saving' => $data->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger ml-2">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <b>Pemasukan</b> : {{$data->pemasukan}}
                    </div>
                    <div>
                        <b>Pengeluaran</b> : {{$data->pengeluaran}}
                    </div>
                    <div>
                        <b>Deskripsi</b> : {!! nl2br($data->deskripsi) !!}
                    </div>
                </div>
            </div>
        @endforeach
        {{$Table->links("pagination::bootstrap-4")}}
    @else
        <h4 class="text-center mt-5">Tidak Ada Data</h4>
    @endif


@endsection
