<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Open Account') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lang.css') }}">
    @yield('custom-style')
</head>
<body>
    <div id="app">
        <nav id="header" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/images/logo_cnb.png') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">                       
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" data-toggle="modal" data-target="#looking_for_account_or_manual">Test</a>
                        </li>
                    </ul>
                    <menu-component locale="{{ app()->getLocale() }}"></menu-component>
                    <ul class="navbar-nav" id="lang">
                        @foreach (config('app.available_locales') as $locale => $value)
                            <li class="nav-item" id="{{ $locale }}">
                                <a class="nav-link"
                                   href="{{ route('set-local-lang',$locale) }}"
                                    @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>
                                    <img src="{{ $value }}">
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <section>
            <footer-component>{{ app()->getLocale() }}</footer-component>
        </section>
        <movetop-component></movetop-component>
    </div>

<!-- Modal -->
<div class="modal fade" id="looking_for_account_or_manual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Your phone number ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        {!! Form::open([
            'route'=>['account.frontend.print.info',app()->getLocale()],
            'method'=>'post'
            ]) !!}

            <div class="form-row">
                <div class="col-md-12 form-group">
                    {!! Form::text('phone_number', null, ['class'=>'form-control']) !!}
                    <small>Note : Keep it blank for field the form</small>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 form-group">
                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                </div>
            </div>

        {!! Form::close() !!}

      </div>
      
    </div>
  </div>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <script type="text/javascript">
        jQuery(document).ready(function($){
            let lang = document.documentElement.lang;
            let langes = document.getElementById('lang');
            let llist = langes.getElementsByTagName('li');
            for(i=0; i<llist.length; i++){
                if(llist[i].id == lang){
                    document.getElementById(llist[i].id).style.display = "none";
                }               
            }
        });
    </script>
    <script>
        window.onscroll = function() {myFunction()};

        var header = document.getElementById("header");
        var sticky = header.offsetTop;

        function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
        }
    </script>
</body>
</html>
