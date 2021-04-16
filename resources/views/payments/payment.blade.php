@extends("template.master", ["title" => "Konfirmasi Pembayaran", "header" => "Konfirmasi Pembayaran"])

@section("content")

{{-- Kepentingan info pembayaran --}}
{{-- {{dd( \Midtrans\Transaction::status(1864090699) )}} --}}
{{-- {{dd( \Midtrans\Transaction::status(87640755)->gross_amount )}} --}}
{{-- {{dd( \Midtrans\Transaction::status(87640755)->settlement_time )}} --}}
{{-- {{dd( \Midtrans\Transaction::status(87640755)->transaction_status )}} --}}
{{-- {{dd($order)}} --}}
{{-- {{dd(substr($order->transaction_time, "5", "2"))}} --}}

{{-- Jika ada $order yang dikirim, maka sistem menyatakan bahwa user telah melakukan transaksi dan user tidak dapat melakukan transaksi dan menunggu 1 bulan --}}
@if ( isset($order) )
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Deskripsi Pembayaran Bulan Ini</h5>
            </div>
            <div class="card-body">
                <div>
                    <b>Tipe Pembayaran : {{$result_payment->type}}</b>
                </div>
                <div>
                Nama : {{Auth::user()->profile->name}}
                </div>
                <div>
                Order ID : {{$order->order_id}}
                </div>
                <div>
                    Status Transaksi : {{ $order->transaction_status === "settlement" ? "Sukses" : $order->transaction_status }}
                </div>
                <div>
                    Waktu Transaksi : {{$order->transaction_time}}
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        Jumlah : {{"Rp " . number_format( intval($order->gross_amount),2,',','.')}}
                    </div>
                    <div>
                        <small>{{ \Carbon\Carbon::parse($order->transaction_time)->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else

    <div class="card">
        <div class="card-header">
            <h5>Deskripsi Pembayaran</h5>
        </div>
        <div class="card-body">
            <div>
            Nama : {{Auth::user()->profile->name}}
            </div>
            <div>
                No Kamar : {{Auth::user()->profile->kamar_id}}
            </div>
            <div>
                Jumlah Pembayaran : {{ "Rp " . number_format( $harga, 2,',','.') }}
            </div>
        </div>
        <button class="btn btn-primary mt-2" id="pay-button" name="pay_button">Bayar</button>
    </div>
@endif

<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="SB-Mid-client-yxUFqFL9pQ8W29V2"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    // For example trigger on button clicked, or any time you need
    var click = payButton.addEventListener('click', function () {
        snap.pay("{{$snapToken}}"); // Replace it with your transaction token
    });
</script>


@stop

