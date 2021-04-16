@extends("template.master", ["title" => "Harga Kamar", "header" => "Berikut adalah Harga Kamar Kost di Kost Putri Pak Kaji"])

@section("content")

@foreach ($data as $kamar)
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div>
        No Kamar : {{$kamar->no_kamar}}
        </div>
    </div>
    <div class="card-body">
        Harga : {{ $kamar->harga }}
    </div>
    <br>
</div>
@endforeach

@stop


