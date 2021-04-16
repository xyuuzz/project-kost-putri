@extends("template.master_admin", ["title" => "Create new User", "header" => "Buat Akun Mbak Kost"])
@section("content")

<div class="col-md-10 container mt-5">
   <div class="card">
       <div class="card-header border-bottom">
           <h4>Buat Akun Mbak Kost</h4>
       </div>

        <div class="card-body">
            <form action="{{ route("store_account") }}" method="POST">

                @include("template.partials.form")

                <button type="submit" class="btn btn-primary">Buat User</button>
            </form>
        </div>
    </div>
</div>

@stop