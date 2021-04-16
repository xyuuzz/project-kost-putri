@extends("template.master_admin", ["title" => "List Kritik dan Saran", "header" => "Daftar Kritik dan Saran"])
@section("content")


@include("template.alert")

<div class="row">
    <div class="col-12">
        @if ( !count($list) )
            {{-- Jika tidak ada kritik dan saran maka hanya akan muncul tulisan --}}
            <div class="card">
                <h5 class="card-header text-center">Tidak ada Kritik dan Saran</h5>
            </div>
        @else

            @foreach ($list as $data)
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                        Nama : {{$data->nama}}
                        </div>
                        <div>
                            <small class="">{{$data->created_at->diffForHumans()}}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        Deskripsi Kritik dan Saran : {{ $data->saran_kritik }}
                    </div>
                    <br>
                    <div>
                        <form action="{{route("delete_saran_kritik", ["saran" => $data->id])}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger float-right mb-3 mr-4">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div>
                {{$list->links("pagination::bootstrap-4")}}
            </div>
        @endif
        </div>
    </div>
</div>

@stop
