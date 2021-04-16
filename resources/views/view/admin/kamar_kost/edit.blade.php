@extends("template.master", ["title" => "Edit", "header" => "Edit Info Kamar Kost"])

@section("content")

<div class="col-md-10 container mt-5">
   <div class="card">
        <div class="card-body">
            <form action="{{route("update.kamar_kost", ["kamar_kost" => $kamar->no_kamar])}}" method="post">
                @csrf
                @method("PATCH")
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_kamar">Nomor Kamar</label>
                        <input id="no_kamar" class="form-control" type="number" name="no_kamar" value="{{old("no_kamar") ?? $kamar->no_kamar}}">
                        @error('no_kamar')
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <label for="harga">Universitas</label>
                        <input id="harga" class="form-control" type="string" name="harga" value="{{old("harga") ?? $kamar->harga}}">
                        @error('harga')
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    {{--  --}}

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
   </div>
</div>

@stop