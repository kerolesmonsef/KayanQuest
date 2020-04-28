<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('images/bg-01.jpg') }}" type="image/x-icon"/>

@include('layouts.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <div id="app">
        @include('layouts.navbar')

        @include('layouts.aside')
        <div class="content-wrapper" style="min-height: 216px;">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 text-right">
                        <div class="col-md-6">

                        </div>
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark text-right">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                @yield('content')
            </section>

        </div>
    </div>
    @include('layouts.footer')

</div>

</body>
</html>
@include('layouts.flash_message')

