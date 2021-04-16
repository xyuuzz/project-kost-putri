@extends("template.master", ["header" => "Form Pembayaran Cicilan", "title" => "cicilan"])

@section("content")

<div class="card">
    <div class="card-body">
        <form action="{{route("bayar")}}" method="get">

            <div class="form-group">
                <label for="jumlah">Jumlah Cicilan Yang ingin dibayar : </label>
                <input id="jumlah" class="form-control" type="number" name="jumlah" value="{{old("jumlah")}}" required>
            </div>

            <button type="submit" class="btn btn-warning">Confirm</button>
        </form>
    </div>
</div>


@stop

