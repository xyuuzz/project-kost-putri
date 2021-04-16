@extends("template.master", ["title" => "Profile", "header" => "Halaman Profile"])

@section("content")

<div class="col-md-10 container mt-5">
   <div class="card">
       <div class="card-header border-bottom">
           <h4>Profile</h4>
       </div>

        <div class="card-body">
            <form action="{{route("update.profile", ["profile" => $user->profile->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div class="card-body">
                    <div class="form-group text-center">
                        <img class="rounded-circle container" src="{{asset("storage/images/profile/" . $user->profile->foto_profil)}}" ><br>
                        <label class="d-block m-3" for="foto_profile">Foto Profile</label>
                        <input class="ml-5" id="foto_profile" type="file" name="foto_profile" value="{{old("foto_profile")}}">
                        @error('foto_profile')
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" class="form-control" type="text" name="username" value="{{old("username") ?? $user->username}}">
                        @error('username')
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{old("email") ?? $user->email}}">
                        @error('email')
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    @if (Auth::user()->role === "user")
                        <div class="form-group">
                            <label for="no_kamar">No Kamar</label>
                            <input type="text" class="form-control" value="{{Auth::user()->profile->kamar_id}}" disabled>
                        </div>
                    @endif
                    {{--  --}}
                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP</label>
                        <input id="nomor_hp" class="form-control" type="number" name="nomor_hp" value="{{old("nomor_hp") ??$user->profile->nomor_hp}}">
                        @error('nomor_hp')
                            <div class="text-danger m-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    {{--  --}}
                    <div class="form-group">
                        <label for="universitas">Universitas</label>
                        <input id="universitas" class="form-control" type="string" name="universitas" value="{{old("universitas") ?? $user->profile->universitas}}">
                        @error('universitas')
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