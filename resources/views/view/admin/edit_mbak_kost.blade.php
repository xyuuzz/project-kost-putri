@extends("template.master_admin", ["title" => "Edit User Account", "header" => ""])


@section("content")

<div class="col-md-10 container mt-5">
   <div class="card">
       <div class="card-header border-bottom">
           <h4>Edit Akun Mbak Kost</h4>
       </div>

        <div class="card-body">
            <form action="{{ route("update_akun_kost", ["user" => $user->slug]) }}" method="POST">
                @method("PATCH")

                @include("template.partials.form")

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>

@stop