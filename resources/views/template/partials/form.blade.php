
{{-- Template Form --}}

@csrf
<div class="form-group">
    <label for="name">Nama</label>
    <input id="name" class="form-control" type="text" name="name" 
    value="{{ $user->profile->name ??  old("name")}}" required>
    @error('name')
        <div class="text-danger m-3">
            {{$message}}
        </div>
    @enderror
</div>
{{--  --}}
<div class="form-group">
    <label for="username">Username</label>
    <input id="username" class="form-control" type="text" name="username" 
    value="{{$user->username ?? old("username")}}" required>
    @error('username')
        <div class="text-danger m-3">
            {{$message}}
        </div>
    @enderror
</div>
{{--  --}}
<div class="form-group">
    <label for="email">Email</label>
    <input id="email" class="form-control" type="email" name="email" 
    value="{{$user->email ?? old("email")}}" required>
    @error('email')
        <div class="text-danger m-3">
            {{$message}}
        </div>
    @enderror
</div>
{{--  --}}
<div class="form-group">
    <label for="no_kamar">No Kamar</label><br>
    @if (request()->is("admin/buat-akun-mbak-kost"))
        @foreach ($list_kamar as $item)
            <input class="m-2" type="radio" name="kamar_id" id="no_kamar" value="{{$item->no_kamar}}" 
            @foreach ($profile as $data)
                {{$data->kamar_id === $item->no_kamar ? "disabled" : ""}}
            @endforeach
            >
            {{$item->no_kamar}}
        @endforeach
    @else
        <input class="m-2" type="radio" name="kamar_id" id="no_kamar" value="{{$user->profile->kamar_id}}" disabled> 
        {{$user->profile->kamar_id}} 
    @endif
</div>
{{--  --}}
<div class="form-group">
    <label for="password">Password Akun</label>
    <input id="password" class="form-control" type="password" name="password" 
    value="{{ $user->password ?? old("password")}}" required>
    @error('password')
        <div class="text-danger m-3">
            {{$message}}
        </div>
    @enderror
</div>
{{--  --}}
<div class="form-group">
    <label for="nomor_hp">Nomor HP</label>
    <input id="nomor_hp" class="form-control" type="number" name="nomor_hp" value="{{$user->profile->nomor_hp ?? old("nomor_hp") }}" required>
    @error('nomor_hp')
        <div class="text-danger m-3">
            {{$message}}
        </div>
    @enderror
</div>
{{--  --}}
<div class="form-group">
    <label for="universitas">Universitas</label>
    <input id="universitas" class="form-control" type="string" name="universitas" value="{{$user->profile->universitas ?? old("universitas") }}" required>
    @error('universitas')
        <div class="text-danger m-3">
            {{$message}}
        </div>
    @enderror
</div>