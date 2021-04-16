@extends("template.master_admin", ["title" => "Kelola Kamar Kost", "header" => "Daftar Kamar Kost beserta Harga"])

@section("content")

@include("template.alert")
{{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="text-dark">Kelola Kamar Kost</h4>
                <a href="{{route("tambah.kamar_kost")}}" class="btn btn-info">Tambah Kamar</a>
            </div>
            
            <div class="card-body">
                @if ( count($kamar) ?? $kamar->total() !== 0)
                    <table class="table table-hover " id="table-1">
                        <thead>
                        <tr class="bg-primary">
                            
                            <th class="text-center">No Kamar</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $id = 1 @endphp
                            @foreach ($kamar as $data)
                                <tr class="text-center">
                                    <td>{{$data->no_kamar}}</td>
                                    <td>{{$data->harga}}</td>
                                    <td>
                                        <a href="{{route("edit.kamar_kost", ["kamar_kost" => $data->no_kamar])}}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr class="text-center">
                                @php $id++ @endphp
                            @endforeach
                        </tbody>
                    </table>
                <br> 

                {{ $kamar->links("pagination::bootstrap-4")}}
                @else 
                <h5 class="text-center">Tidak Ada Data</h5>

                @endif

            </div>
            </div>
        </div>
    </div>

@stop