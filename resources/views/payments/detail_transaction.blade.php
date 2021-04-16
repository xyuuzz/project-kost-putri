@extends("template.master", ["title" => "Transaksi", "header" => "Detail Transaksi Mbak {$order->user->profile->name}"])

@section("content")

    <div class="card">
        <div class="card-header">
            <h5>Deskripsi Pembayaran</h5>
        </div>
        <div class="card-body text-center">
            <div>
                <b>Tipe Pembayaran : {{$payment->type ?? Midtrans\Transaction::status($order->order_id)->payment_type}}</b>
            </div>
            <div>
            Nama : {{$order->user->profile->name}}
            </div>
            <div>
            Order ID : {{$order->order_id}}
            </div>
            <div>
                Tipe Pembayaran : {{$order->type}}
            </div>
            <div>
                Status Transaksi : {{
                    $payment
                    ->transaction_status === "settlement" ? "Sukses"
                    :
                    $payment->transaction_status
                    }}
            </div>
            <div>
                Waktu Transaksi :
                {{Midtrans\Transaction::status($order->order_id)->transaction_time}}
            </div>
            <div>
                Jumlah :
                {{"Rp " . number_format( intval($payment->gross_amount),2,',','.')}}
            </div>

            {{-- Tombol Transaksi User --}}
            @if(Auth::user()->role === "user")
                <br>
                <button class="btn btn-warning" id="pay-button" name="pay_button">
                    Cek Transaksi
                </button>
            @endif

            <br><br>
            <small class="float-right">
                {{ \Carbon\Carbon::parse($payment->transaction_time)->diffForHumans() }}
                {{-- jadi transaksi time yang semula berbentuk string, kita ubah menjadi date dan kita ubah lagi menjadi data diffForHumans --}}
            </small>
        </div>
    </div>


<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="SB-Mid-client-yxUFqFL9pQ8W29V2"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    // For example trigger on button clicked, or any time you need
    var click = payButton.addEventListener('click', function () {
        snap.pay("{{$order->snap_token}}"); // Replace it with your transaction token
    });
</script>

@stop
