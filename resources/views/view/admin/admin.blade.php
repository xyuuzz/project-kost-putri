@extends("template.master_admin", ["title" => "Admin Page", "header" => "Halaman Admin Website Kost Putri Pak Kaji"])

@section("content")

@include("template.alert")

{{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="text-dark">Daftar User Mbak Kost</h4>
                <a href="{{route("buat_akun_mbak_kost")}}" class="btn btn-info">Tambah User</a>
            </div>


            <div class="card-body">
                @if ($users->total() !== 0)
                <div >
                    <form action="" method="get" class=" float-left">
                        <div class="d-flex mb-3">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        <input type="search" class="form-control" name="query" placeholder="Search With Username" value="{{ request("query") ?? "" }}">
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr class="bg-primary">
                            <th class="text-center">
                            No
                            </th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>Foto</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $id = 1 @endphp
                            @foreach ($users as $data)
                                <tr>
                                    <td>
                                    {{$id}}
                                    </td>
                                    <td>{{$data->profile->name}}</td>
                                    <td class="align-middle">{{$data->profile->nomor_hp}}</td>
                                    <td>
                                    <img alt="image" src="{{asset("storage/images/profile/" . $data->profile->foto_profil)}}" class="rounded-circle" width="35" data-toggle="tooltip" title="{{$data->profile->name}}">
                                    </td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>
                                        <a href="{{route("edit_akun_kost", ["user" => $data->slug])}}" class="btn btn-warning mr-2 mb-2 mt-2">Edit</a>

                                        <form action="{{route("delete_account", ["user" => $data->slug])}}" method="post">
                                            @csrf @method("DELETE")
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @php $id++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                <h5 class="text-center">Tidak Ada Data</h5>

                @endif

            </div>
            </div>
        </div>
    </div>

@stop
