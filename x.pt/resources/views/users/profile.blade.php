<div class="form-group col-md-12">

    <h2>{{ Auth::user()->name }}</h2>

    <p>{{ Auth::user()->email }}</p>

    <div class="header-cart-buttons" style="margin: 20px 0;">
        <div id="button_register" class="w-100" style="margin-bottom: 10px;">
            <!-- Button -->
            <a href="{{url('/full/profile-ajax')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4 content-to-load">
                <i class="fa fa-user"></i>Perfil
            </a>
        </div>

        <div id="button_orders" class="w-100" style="margin-bottom: 10px;">
            <!-- Button -->
            <a href="{{url('/orders-ajax')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4 content-to-load">
                Encomendas
            </a>
        </div>

        <div id="button_log" class="w-100">
            <!-- Button -->
            <a href="{{url('/logout-ajax')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                Logout
            </a>
        </div>
    </div>

</div>