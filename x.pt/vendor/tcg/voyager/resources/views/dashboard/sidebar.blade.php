<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
                    <div class="logo-icon-container">
                        <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                        @if($admin_logo_img == '')
                            <img src="{{ voyager_asset('images/logo-icon-light.png') }}" alt="Logo Icon">
                        @else
                            <img src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">
                        @endif
                    </div>
                    <div class="title">{{Voyager::setting('admin.title', 'VOYAGER')}}</div>
                </a>
            </div><!-- .navbar-header -->

            <div class="panel widget center bgimage"
                 style="background-image:url({{ Voyager::image( Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg') ) }}); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                    <h4>{{ ucwords(Auth::user()->name) }}</h4>
                    <p>{{ Auth::user()->email }}</p>

                    <a href="{{ route('voyager.profile') }}" class="btn btn-primary">{{ __('voyager::generic.profile') }}</a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        <div id="adminmenu">
            {{--<admin-menu :items="{{ menu('admin', '_json') }}"></admin-menu>--}}

            @if(Auth::user()->role_id == 1)
                <ul class="nav navbar-nav">
                    <li class="dropdown @if(\Request::is('admin/menus') || \Request::is('admin/database') || \Request::is('admin/compass') || \Request::is('admin/bread') || \Request::is('admin/hooks') || \Request::is('admin/settings')) active @endif">
                        <a target="_self" href="#5-dropdown-element" data-toggle="collapse" aria-expanded="true">
                            <span class="icon voyager-tools"></span>
                            <span class="title">Administração</span>
                        </a>
                        <div id="5-dropdown-element" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li @if(\Request::is('admin/menus')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/menus')}}">
                                            <span class="icon voyager-list"></span>
                                            <span class="title">Construtor de Menus</span>
                                        </a>
                                    </li>
                                    <li @if(\Request::is('admin/database')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/database')}}">
                                            <span class="icon voyager-data"></span>
                                            <span class="title">Base de Dados</span>
                                        </a>
                                    </li>
                                    <li @if(\Request::is('admin/compass')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/compass')}}">
                                            <span class="icon voyager-compass"></span>
                                            <span class="title">Compass</span>
                                        </a>
                                    </li>
                                    <li @if(\Request::is('admin/bread')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/bread')}}">
                                            <span class="icon voyager-bread"></span>
                                            <span class="title">BREAD</span>
                                        </a>
                                    </li>
                                    <li @if(\Request::is('admin/hooks')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/hooks')}}">
                                            <span class="icon voyager-hook"></span>
                                            <span class="title">Hooks</span></a>
                                        </li>
                                    <li @if(\Request::is('admin/settings')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/settings')}}">
                                            <span class="icon voyager-settings"></span>
                                            <span class="title">Definições</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li @if(\Request::is('admin')) class="active" @endif>
                        <a target="_self" href="{{url('/admin')}}">
                            <span class="icon voyager-boat"></span>
                            <span class="title">Painel de Controlo</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/roles')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/roles')}}">
                            <span class="icon voyager-lock"></span>
                            <span class="title">Permissões</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/users')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/users')}}" style="color: rgb(118, 214, 255);">
                            <span class="icon voyager-person"></span>
                            <span class="title">Utilizadores</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/countries')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/countries')}}">
                            <span class="icon fa fa-flag"></span>
                            <span class="title">Países de Entrega</span>
                        </a>
                    </li>
                    <li class="dropdown @if(\Request::is('admin/transport-categories') || \Request::is('admin/transport-costs')) active @endif">
                        <a target="_self" href="#21-dropdown-element" data-toggle="collapse" aria-expanded="false" style="color: rgb(34, 255, 0);">
                            <span class="icon voyager-truck"></span>
                            <span class="title">Def. Transportes</span>
                        </a>
                        <div id="21-dropdown-element" class="panel-collapse collapse ">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li @if(\Request::is('admin/transport-categories')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/transport-categories')}}">
                                            <span class="icon fa fa-book"></span>
                                            <span class="title">Categorias</span>
                                        </a>
                                    </li>
                                    <li @if(\Request::is('admin/transport-costs')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/transport-costs')}}">
                                            <span class="icon fa fa-book"></span>
                                            <span class="title">Custos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li @if(\Request::is('admin/familias')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/familias')}}">
                            <span class="icon voyager-categories"></span>
                            <span class="title">Familias de Artigos</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/items')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/items')}}">
                            <span class="icon voyager-bread"></span>
                            <span class="title">Artigos</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/banner-publicitario')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/banner-publicitario')}}">
                            <span class="icon voyager-images"></span>
                            <span class="title">Banners/Campanhas</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/sobres')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/sobres')}}">
                            <span class="icon voyager-file-text"></span>
                            <span class="title">Sobre</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/contactos')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/contactos')}}">
                            <span class="icon voyager-telephone"></span>
                            <span class="title">Contactos</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/orders')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/orders')}}">
                            <span class="icon voyager-data">
                                @if(getOrder() != "[]")
                                    <span style="color: red; background-color: red; border-radius: 50em; position: absolute; width: 10px; height: 10px; top: 22%;"></span>
                                @endif
                            </span>
                            <span class="title">Encomendas</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/adresses-users')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/adresses-users')}}">
                            <span class="icon voyager-location"></span>
                            <span class="title">Endereços dos Clientes</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/stocks')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/stocks')}}">
                            <span class="icon voyager-archive"></span>
                            <span class="title">Stocks</span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="{{url('')}}" style="color: #00e6ff;">
                            <span class="icon voyager-home"></span>
                            <span class="title">Minha Loja</span>
                        </a>
                    </li>
                    <!-- 
                    @if(checkPlanIsFree() == "Sim")
                        <li class="">
                            <a target="_self" href="//ncommerce.pt/subscrive-now/{{getUserTwo()->domain_token}}" style="color: white; background-color: red;">
                                <span class="icon voyager-medal-rank-star"></span>
                                <span class="title">Subscrever Já</span>
                            </a>
                        </li>
                    @endif-->
                </ul>
            @else
                <ul class="nav navbar-nav">
                    <li @if(\Request::is('admin')) class="active" @endif>
                        <a target="_self" href="{{url('/admin')}}">
                            <span class="icon voyager-boat"></span>
                            <span class="title">Painel de Controlo</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/countries')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/countries')}}">
                            <span class="icon fa fa-flag"></span>
                            <span class="title">Países de Entrega</span>
                        </a>
                    </li>
                    <li class="dropdown @if(\Request::is('admin/transport-categories') || \Request::is('admin/transport-costs')) active @endif">
                        <a target="_self" href="#21-dropdown-element" data-toggle="collapse" aria-expanded="false" style="color: rgb(34, 255, 0);">
                            <span class="icon voyager-truck"></span>
                            <span class="title">Def. Transportes</span>
                        </a>
                        <div id="21-dropdown-element" class="panel-collapse collapse ">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li @if(\Request::is('admin/transport-categories')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/transport-categories')}}">
                                            <span class="icon fa fa-book"></span>
                                            <span class="title">Categorias</span>
                                        </a>
                                    </li>
                                    <li @if(\Request::is('admin/transport-costs')) class="active" @endif>
                                        <a target="_self" href="{{url('/admin/transport-costs')}}">
                                            <span class="icon fa fa-book"></span>
                                            <span class="title">Custos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li @if(\Request::is('admin/familias')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/familias')}}">
                            <span class="icon voyager-categories"></span>
                            <span class="title">Familias de Artigos</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/items')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/items')}}">
                            <span class="icon voyager-bread"></span>
                            <span class="title">Artigos</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/banner-publicitario')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/banner-publicitario')}}">
                            <span class="icon voyager-images"></span>
                            <span class="title">Banners/Campanhas</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/sobres')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/sobres')}}">
                            <span class="icon voyager-file-text"></span>
                            <span class="title">Sobre</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/contactos')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/contactos')}}">
                            <span class="icon voyager-telephone"></span>
                            <span class="title">Contactos</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/orders')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/orders')}}">
                            <span class="icon voyager-data">
                                @if(getOrder() != "[]")
                                    <span style="color: red; background-color: red; border-radius: 50em; position: absolute; width: 10px; height: 10px; top: 22%;"></span>
                                @endif
                            </span>
                            <span class="title">Encomendas</span>
                        </a>
                    </li>
                    <li @if(\Request::is('admin/adresses-users')) class="active" @endif>
                        <a target="_self" href="{{url('/admin/adresses-users')}}">
                            <span class="icon voyager-location"></span>
                            <span class="title">Endereços dos Clientes</span>
                        </a>
                    </li>
                    @if(checkPlan() != "Básico")
                        <li @if(\Request::is('admin/stocks')) class="active" @endif>
                            <a target="_self" href="{{url('/admin/stocks')}}">
                                <span class="icon voyager-archive"></span>
                                <span class="title">Stocks</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a target="_blank" href="{{url('')}}" style="color: #00e6ff;">
                            <span class="icon voyager-home"></span>
                            <span class="title">Minha Loja</span>
                        </a>
                    </li>
                    <!--
                    @if(checkPlanIsFree() == "Sim")
                        <li class="">
                            <a target="_self" href="//ncommerce.pt/subscrive-now/{{getUserTwo()->domain_token}}" style="color: white; background-color: red;">
                                <span class="icon voyager-medal-rank-star"></span>
                                <span class="title">Subscrever Já</span>
                            </a>
                        </li>
                    @endif 
                    -->
                </ul>
            @endif
        </div>
    </nav>
</div>