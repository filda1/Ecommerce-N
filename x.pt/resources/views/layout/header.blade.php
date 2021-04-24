<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Icon Website -->
        <link rel="shortcut icon" type="image/png" href="{!!url('storage/'.setting('site.icon'))!!}"/>

        <title>{!!setting('site.title')!!}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/themify/themify-icons.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/elegant-font/html-css/style.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animate/animate.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/css-hamburgers/hamburgers.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animsition/css/animsition.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/select2/select2.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/slick/slick.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/noui/nouislider.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/util.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/nprogress.css')}}">
        <!--===============================================================================================-->
        <script type="text/javascript" src="{{asset('assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>

        @include("styles")

    </head>
    <body id="body">

    <!-- Header -->
    <header class="header1 fixed-top">
        <!-- Header desktop -->
        <div class="container-menu-header">

            <div class="wrap_header" style="background-color: {{ setting('site.barra_navegacao') }};">
                <!-- Logo -->
                <a href="{{ url('') }}" class="logo">
                    <img src="{!!url('storage/'.setting('site.logo'))!!}" alt="IMG-LOGO">
                </a>

                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a class="content-to-load" href="{{url('/shop-ajax')}}">Loja</a>
                            </li>
                            
                            <li>
                                <a class="content-to-load" href="{{url('about-us-ajax')}}">Sobre</a>
                            </li>

                            <li>
                                <a class="content-to-load" href="{{url('about-us-ajax')}}#contactos">Contactos</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Header Icon -->
                <div class="header-icons">
                    <img src="@if(Auth::check()) {{ url('storage').'/'.Auth::user()->avatar}} @else {{asset('assets/images/icons/icon-header-01.png')}} @endif" class="header-icon1 js-show-header-dropdown-user" alt="ICON" style="@if(Auth::check()) border-radius: 100%; width: 30px; @endif">
                    
                    <!-- Header User -->
                    <div class="header-user header-dropdown-user header-cart header-dropdown" style="">
                    @if(Auth::check())
                        @include('users.profile')
                    @else
                        
                        <div id="profile" class="header-cart-wrapitem">

                            <div id="email" class="form-group col-md-12">

                                <label class="control-label" for="name">Email</label>
                                
                                <input type="email" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="email" placeholder="Email" required>

                                <p id="email_incorrect" style="color: red; display: none;">Email Incorreto</p>

                            </div>

                            <div id="password" class="form-group col-md-12">

                                <label class="control-label" for="name">Password</label>

                                <input type="password" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="password" placeholder="Password" required>

                                <p id="password_incorrect" style="color: red; display: none;">Password Incorreta</p>

                                <p id="confirm-acc" style="color: red; display: none;">Verifique o seu email para confirmar a conta.</p>

                            </div>

                        </div>


                        <div class="header-cart-buttons">

                            <div id="button_log" class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="#!" onclick="submitLogin()" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Entrar
                                </a>
                            </div>

                            <div id="button_log" class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="#!" onclick="$('#modalregister').modal('show');" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Registar
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>


                    <span class="linedivide1"></span>

                    <div class="header-wrapicon2">
                        <img src="{{asset('assets/images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti cart-items-count">0</span>

                        <!-- Header cart -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem cart-line-items">
                                
                            </ul>

                            <div class="header-cart-total">
                                Total: 
                                <span class="cart-subtotal"></span>
                            </div>

                            <div class="header-cart-buttons cart-items-actions">
                                <div class="w-100">
                                    <!-- Button -->
                                    <a href="{{url('cart-ajax')}}" class="content-to-load flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Ver Carrinho
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Logo moblie -->
            <a href="{{ url('') }}" class="logo-mobile">
                <img src="{!!url('storage/'.setting('site.logo'))!!}" alt="IMG-LOGO">
            </a>

            <!-- Button show menu -->
            <div class="btn-show-menu">
                <!-- Header Icon mobile -->
                <div class="header-icons-mobile">
                    <img src="@if(Auth::check()) {{ url('storage').'/'.Auth::user()->avatar}} @else {{asset('assets/images/icons/icon-header-01.png')}} @endif" class="header-icon1 js-show-header-dropdown-user" alt="ICON" style="@if(Auth::check()) border-radius: 100%; width: 30px; @endif">
                    <!-- Header User -->
                    
                    <div class="header-user header-dropdown-user header-cart header-dropdown" style="">

                        @if(Auth::check())
                            @include('users.profile')
                        @else
                        <div id="profile" class="header-cart-wrapitem">

                            <div id="email" class="form-group col-md-12">

                                <label class="control-label" for="name">Email</label>
                                
                                <input type="email" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="email_mobile" placeholder="Email" required>

                                <p id="email_incorrect" style="color: red; display: none;">Email Incorreto</p>

                            </div>

                            <div id="password" class="form-group col-md-12">

                                <label class="control-label" for="name">Password</label>

                                <input type="password" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="password_mobile" placeholder="Password" required>

                                <p id="password_incorrect" style="color: red; display: none;">Password Incorreto</p>

                            </div>

                        </div>

                        <div class="header-cart-buttons">
                            <div id="button_register" class="w-100" style="margin-bottom: 10px;">
                                <!-- Button -->
                                <a href="#!" onclick="$('#modalregister').modal('show');" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Registar
                                </a>
                            </div>

                            <div id="button_log" class="w-100">
                                <!-- Button -->
                                <a href="#!" onclick="submitLoginMobile()" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Entrar
                                </a>
                            </div>
                        </div>
                    @endif

                    </div>

                    <span class="linedivide2"></span>

                    <div class="header-wrapicon2">
                        <img src="{{asset('assets/images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti cart-items-count">0</span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem cart-line-items">
                            
                            </ul>

                            <div class="header-cart-total">
                                Total: 
                                <span class="cart-subtotal"></span>
                            </div>

                            <div class="header-cart-buttons cart-items-actions">
                                <div class="w-100">
                                    <!-- Button -->
                                    <a href="{{url('cart-ajax')}}" class="content-to-load flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Ver Carrinho
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="wrap-side-menu" >
            <nav class="side-menu">
                <ul class="main-menu">
                     <li class="item-menu-mobile">
                        <a class="content-to-load" href="{{url('/shop-ajax')}}">Loja</a>
                    </li>

                    <li class="item-menu-mobile">
                        <a class="content-to-load" href="{{url('about-us-ajax')}}">Sobre</a>
                    </li>

                    {{-- <li class="item-menu-mobile">
                        <a class="content-to-load" href="{{url('404')}}">Informações Legais</a>
                    </li> --}}

                    <li class="item-menu-mobile">
                        <a class="content-to-load" href="{{url('about-us-ajax')}}#contactos">Contactos</a>
                    </li>
                    
                </ul>
            </nav>
        </div>
        <div id="progress-bar-container"></div>
    </header>


    <!-- Title Page -->
    <section class="bg-title-page flex-col-c-m" style="padding: 0 0!important; margin-top: 80px;">
        <div class="carousel slide w-100" data-ride="carousel">
          <div class="carousel-inner">

            @foreach(getBanners() as $banner)

                <div class="carousel-item @if($loop->first) active @endif">
                    
                    <img class="d-block w-100" style="height: 300px; object-fit: cover;" src="{!!url('storage/'.$banner->imagem)!!}">

                </div>

            @endforeach

          </div>
        </div>
    </section>

    <div class="modal fade" id="modalregister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: #000000ba;">
        <div class="modal-dialog" role="document">
            <div class="modal-content content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="position: absolute; font-size: 1.5em;">Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="margin-bottom: 0; padding: 0; top: 44%;">

                    <div id="nome" class="form-group col-md-12">

                        <label class="control-label" for="name">Nome</label>
                        
                        <input type="text" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="nome" placeholder="Nome" required>

                    </div>


                    <div id="email" class="form-group col-md-12">

                        <label class="control-label" for="name">Email</label>
                        
                        <input type="email" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="remail" placeholder="Email" required>

                        <p id="email_incorrect" style="color: red; display: none;">Email Incorreto</p>
                        <p id="error_email" style="color: red; display: none;">Email Existente</p>
                    </div>

                    <div id="password" class="form-group col-md-12">

                        <label class="control-label" for="name">Password</label>

                        <input type="password" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="rpassword" placeholder="Password" required>

                    </div>

                    <div id="confirmarpassword" class="form-group col-md-12">

                        <label class="control-label" for="name">Confirmar Password</label>

                        <input type="password" class="form-control" style="border: 1px solid rgba(0,0,0,.15)!important;" name="confirmpassword" placeholder="Confirmar Password" onchange="confirmPassword()" onkeyup="confirmPassword()" required>

                        <p id="confirmpassword" style="color: red; display: none;">Passwords não coincidem</p>

                    </div>

                    <div class="col-md-12" id="registerSuccess" style="display: none;">
                        <div class="alert alert-success text-center">
                            <h4 style="font-size: 14px;">Por Favor verifique o seu email para confirmar a conta.</h4>
                        </div>
                    </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success" onclick="submitRegist()">Registar</button>
              </div>
            </div>
        </div>
    </div>

    <div id="page-content">
        @yield('content')
    </div>