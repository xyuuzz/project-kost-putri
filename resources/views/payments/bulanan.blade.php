@extends("template.master", ["header" => "Form Pembayaran Bulanan", "title" => "Bulanan"])

@section("content")

<div class="card">
    <div class="card-body">
        <form action="{{route("bayar")}}" method="get">

            <div class="form-group">
                <label for="no_kamar">Nomor Kamar</label>
                <input id="no_kamar" class="form-control" type="number" name="no_kamar" value="{{old("no_kamar")}}" required>
            </div>

            <input type="hidden" name="type" value="bulanan">

            <button type="submit" class="btn btn-warning">Confirm</button>
        </form>
    </div>
</div>



@stop

