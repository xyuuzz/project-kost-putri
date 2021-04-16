<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title ?? "Kost Putri Pak Kaji" }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset("assets/css/style.css")}}"> {{-- Tulisan ini sudah benar --}}
  <link rel="stylesheet" href="{{asset("assets/css/components.css")}}">
</head>

<body>

  @if (Auth::user()->role === "admin")
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      {{-- Navbar --}}
      <nav class="navbar navbar-expand-lg main-navbar">
        @include("template.navbar")
      </nav>

      {{-- Sidebar --}}
      <div class="main-sidebar">
        @include("template.sidebar")
      </div>


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{$header ?? "Selamat Datang Di Website Kost Putri Pak Kaji"}}</h1>
          </div>

          <div class="section-body">
            @yield("content")
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Kost Putri Pak Kaji &middot; Template By <a href="https://github.com/stisla/stisla" class="text-primary">Template Stisla</a>
        </div>
        <div class="footer-right">
          2021
        </div>
      </footer>
    </div>
  </div>


  @else

  {{-- include halaman error 404 --}}
  @include("template.error_404")

  @endif

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset("assets/js/stisla.js")}}"></script>

  <!-- JS Libraies -->
  {{-- <script src="node_modules/prismjs/prism.js"></script> --}}

  <!-- Template JS File -->
  <script src="{{asset("assets/js/scripts.js")}}"></script>
  <script src="{{asset("assets/js/custom.js")}}"></script>

  <!-- Page Specific JS File -->
  
  @stack("js_spesifik")

</body>
</html>

