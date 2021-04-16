@extends("template.master", ["title" => "Edit Data Keuangan", "header" => "Form Edit Keuangan"])

@section("content")
<br>
<div class="card card-warning  m-3">
    <div class="card-header">
      <h3 class="card-title"> --- Edit Data Tabungan ---</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{route("saving.update", ['saving' => $data->id]) }}" method="post" class="ml-3 mr-3">
            @csrf
            @method("PUT")
            @include("template.partials.form_tabungan")

            <button type="submit" class="btn btn-warning">Edit</button>
        </form>
    </div>

@endsection
