@extends("template.master", ["title" => "Buat Tabungan", "header" => "Form Tabungan"])


{{-- Content --}}
@section('content')
<div class="card card-warning  m-3">
    <br>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{route("saving.store")}}" method="post" class="ml-3 mr-3">
            @csrf
            @include("template.partials.form_tabungan")
            
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>

@endsection
