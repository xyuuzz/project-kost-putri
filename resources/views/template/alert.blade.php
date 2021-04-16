{{-- Menampilkan alert --}}
@if ( session("success") )
    <div class="container">
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
    </div>
@endif

@if ( session("warning") )
    <div class="container">
        <div class="alert alert-warning">
            {{ session("warning") }}
        </div>
    </div>
@endif

@if ( session("error") )
    <div class="container">
        <div class="alert alert-error">
            {{ session("error") }}
        </div>
    </div>
@endif

