@extends("template.master", ["title" => "Transaksi", "header" => "Daftar Transaksi Mbak Kost"])


@section("content")

@include("template.alert")

{{-- Tampilkan search bar & table jika ada data, dan sembunyikan jika tidak ada data --}}

@if (count($payments))
<form action="" method="get" class=" float-left">
  <div class="d-flex">
    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
    <input type="search" class="form-control" name="query" placeholder="Search With Name" value="{{ request("query") ?? "" }}">
  </div>
</form>
<br><br><br>
@endif

<div class="card">
    <div class="card-header">
        <h4>Transaksi Pembayaran</h4>
    </div>
    <div class="card-body">
    {{-- Jika ada transaksi pembayaran tampilkan table nya --}}
        @if (count($payments))
        <div class="table-responsive table-invoice">
            <table class="table table-striped">
              <tr>
                  <th scope="col">Order ID</th>
                  @if (Auth::id() === 1)
                    <th scope="col">Nama</th>
                  @endif
                  <th scope="col">Status Transaksi</th>
                  <th scope="col">Bulan</th>
                  <th scope="col">Tipe Pembayaran</th>
                  <th scope="col">Total Pembayaran</th>
                  <th scope="col">Action</th>
                </tr>
                @php $id = 1; @endphp
                  @foreach ($payments as $data)
                      <tr>
                      <th scope="row">{{$data->order_id}}</th>
                        @if (Auth::id() === 1)
                            <td>{{$data->user->profile->name}}</td>
                        @endif
                        <td>
                            <div class="badge {{\Midtrans\Transaction::status($data->order_id)
                                ->transaction_status === "settlement" ? "badge-success" : "badge-warning"}}">
                                {{
                                    \Midtrans\Transaction::status($data->order_id)
                                    ->transaction_status === "settlement" ? "Sukses"
                                    :
                                    \Midtrans\Transaction::status($data->order_id)->transaction_status
                                }}
                            </div
                        ></td>
                        <td>
                            {{-- F untuk format string bulan lengkap(April), dan strtotime untuk mengubah string menjadi type date/time --}}
                            {{date("F", strtotime(\Midtrans\Transaction::status($data->order_id)->transaction_time))}}
                        </td>
                        <td>{{$data->type}}</td>
                        <td>
                            {{"Rp " . number_format( intval( \Midtrans\Transaction::status($data->order_id)->gross_amount),2,',','.')}}
                        </td>

                        <td><a href="{{route("detail_transaksi", ["payment_result" => $data->order_id])}}" class="btn btn-warning">Detail</a></td>
                      </tr>
                      @php $id++ @endphp
                  @endforeach
            </table>
          </div>
            <br>
            <div>
            {{$payments->links("pagination::bootstrap-4")}}
            </div>
        @else
            <h5 class="text-center">Tidak ada data</h5>
        @endif



    </div>
  </div>
</div>
<br><br><br>

@stop
