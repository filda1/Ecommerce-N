<!-- Footer -->
    <footer class="p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="flex-w p-b-90">
            <div class="w-size5 p-t-30 p-l-15 p-r-15 respon3">
            
                <h4 class="s-text12 p-b-30">
          
                    Entre em contacto!
                </h4>

                @php
                    $contacto = getContactDetails();
                @endphp

                <div>
                    <p class="s-text7 w-size27">
                        Alguma questão? Informe-se na nossa loja 
                        {{ $contacto->morada }}
                        {{ $contacto->codigo_postal }}, {{ $contacto->localidade }}
                        ou ligue para {{ $contacto->numero }}
                    </p>

                    <div class="flex-m p-t-30">
                        @if($contacto->facebook != NULL)
                            <a href="@if(strpos($contacto->facebook, 'http') !== false){{ $contacto->facebook }} @else //{{ $contacto->facebook }} @endif" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                        @endif
                        @if($contacto->instagram != NULL)
                            <a href="@if(strpos($contacto->instagram, 'http') !== false){{ $contacto->instagram }} @else //{{ $contacto->instagram }} @endif" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                        @endif
                        @if($contacto->twitter != NULL)
                            <a href="@if(strpos($contacto->twitter, 'http') !== false){{ $contacto->twitter }} @else //{{ $contacto->twitter }} @endif" target="_blank" class="fs-18 color1 p-r-20 fa fa-twitter"></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-size5 p-t-30 p-l-15 p-r-15 respon4">
                @if(json_decode(getAllTypesOfItems()) != [])
                    <h4 class="s-text12 p-b-30">
                        Categorias
                    </h4>

                    <ul>
                        @foreach(getAllTypesOfItems() as $familia)
                        <li class="p-b-9">
                            <a href="#!" class="s-text7">
                                {{ $familia->titulo }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            

            <div class="w-size5 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Ligações
                </h4>

                <ul>

                    <li class="p-b-9">
                        <a class="s-text7 content-to-load" href="{{url('/about-us-ajax')}}">
                            Sobre
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a class="s-text7 content-to-load" href="{{url('/about-us-ajax')}}#contactos">
                            Contactos
                        </a>
                    </li>

                </ul>
            </div>

        </div>

        <div class="t-center p-l-15 p-r-15">
            <!--<a href="#">
                <img class="h-size2" src="{{asset('assets/images/icons/paypal.png')}}" alt="IMG-PAYPAL">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('assets/images/icons/visa.png')}}" alt="IMG-VISA">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('assets/images/icons/mastercard.png')}}" alt="IMG-MASTERCARD">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('assets/images/icons/express.png')}}" alt="IMG-EXPRESS">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('assets/images/icons/discover.png')}}" alt="IMG-DISCOVER">
            </a>-->

            <div class="t-center s-text8 p-t-20">
                Copyright &copy; {{date("Y")}} by <a href="{{ url('') }}" target="_blank">NCommerce</a>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <form style="display: none;" id="formToRegister" method="post" action="{{ url('save-register') }}">
        @csrf
        <input type="text" name="rname">
        <input type="text" name="remail">
        <input type="text" name="rpassword">
    </form>

    <!-- Container Selection -->
    <div id="dropDownSelect1"></div>
    <div id="dropDownSelect2"></div>

    @if(Session::has('info'))
    <div class="modal fade" id="info-modal" style="background-color: #000000ba;">
      <div class="modal-dialog">
        <div class="modal-content" style="bottom: auto;">
            <ul class="nav nav-tabs p-4 mx-auto border-0">
              <li class="mr-1">Informação</li>
            </ul>
            <div class="col-8 mx-auto separator user-mini-window-separator"></div>
            <div class="modal-body row pt-0 p-4" style="position: unset; top: 0; bottom: 0; font-size: 0; margin-bottom: 0; padding: 0; width: 100%; top: 0; transform: none;">
              <p>{{ Session::get('info') }}</p>
              <div class="text-right">
                <button data-dismiss="modal" class="btn btn-outline-dark">Fechar</button>
              </div>
            </div>
        </div>
      </div>
    </div>
    @endif


    <!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/popper.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/nprogress.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/noui/nouislider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/cart.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/slick/slick.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/slick-custom.js')}}"></script>
    


    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });

        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect2')
        });
    </script>
<!--===============================================================================================-->

    <script>

        $( document ).ready(function() {
            @if(Session::has('login_error'))
                $("#login-error").modal('show');
            @endif

            @if(Session::has('info'))
                $("#info-modal").modal('show');
            @endif
        });


        var xd_isActive = "{{setting('site.xd_software')}}";

        var isLoadingPage = false;
        
        /*function changeCurrentPage(pagina, focusElementID = null){
            if(isLoadingPage){
                return;
            }
            isLoadingPage = true;
            NProgress.configure({ parent: '#progress-bar-container' });
            NProgress.set(0.0);
            NProgress.start();

            $.ajax({
                url: "{{url('/page')}}"+ '/' + pagina, 
                success: function(result){
                    $("#page-content").empty();
                    $("#page-content").html(result);
                    NProgress.done();
                    NProgress.set(1.0);
                    isLoadingPage = false;

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#"+focusElementID).offset().top
                    }, 500);
                }
            });

        }*/

        var trigger = $('.content-to-load'),
                container = $('#page-content');
                    
        @if(isset($itemsPrices) && !empty($itemsPrices))
            var minItemPrice = {{min($itemsPrices)}};
            var maxItemPrice = {{max($itemsPrices)}};
        @endif

        $(document).ready(function(){
            NProgress.configure({ parent: '#progress-bar-container', easing: 'ease', speed: 500, trickleSpeed: 500 });

            trigger.on('click', function(){
                loadContentAjax(this);
                return false;
            });

            $(function() {
                Cart.initJQuery();
            });
        });

        

        function loadContentAjax(el, updateURL = true){
            if(isLoadingPage){
                return;
            }
            isLoadingPage = true;

            NProgress.start();

            var $this = $(el),
                target = $this.attr('href');       
          
            container.load(target, function() {
                NProgress.done();
                isLoadingPage = false;

                //UPDATE URL BAR
                if(updateURL){
                    cleanTarget = (target.replace('-ajax', '')).replace('type=ajax', '');
                    window.history.pushState('N\'Commerce', 'N\'Commerce', cleanTarget);
                }

                //UPDATE AJAX LINKS
                trigger = $('.content-to-load');
                trigger.on('click', function(){
                    loadContentAjax(this);
                    return false;
                });

                if(target.includes("#")){
                    var elementToFocus = target.split("#");

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#"+elementToFocus[1]).offset().top
                    }, 500);
                }
            });
        }

        function filterPrices(){
            var slider = $('#filter-bar')[0];
            var values = slider.noUiSlider.get();

            $(".item").hide();
            $(".item").filter( function(){ 
                var price = parseFloat($(this).data("price"));

                if(price >= values[0] && price <= values[1]){
                    return true;
                }else{
                    return false;
                }

            } ).show();
        }

        var urlToSearch = "{{ url('shop-ajax') }}?search=";
        function searchByName(){
            var el = $("#search-input");
            $(el).attr("href", urlToSearch+$(el).val());
            loadContentAjax(el, false);
        }

        function allItems(){
            $.ajax({url: "{{url('/get/artigos/all')}}", success: function(result){
                /*$("#body").empty();
                $("#body").html(result);*/
            }});
        }

        function selectItemByFamily(familia){
            $.ajax({url: "{{url('/get/artigos')}}"+ '/' + familia, success: function(result){
                /*$("#body").empty();
                $("#body").html(result);*/
            }});
        }

        function submitLogin(){
            $("#confirm-acc").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            var email = $("input[name=email]").val();
            var password = $("input[name=password]").val();
            var origin   = "{{ env('APP_URL') }}";
            var values = { email : email, password : password };
            $.ajax({
                url: "{{url('/login')}}",
                type: "POST", 
                data: values, 
                success: function(result){
                if(result["result"] != "incorrect"){
                    if(result["result"] == "blocked"){
                        $("#confirm-acc").show();
                        return;
                    }
                    location.reload();
                    /*$.ajax({
                        url: "{{url('/profile')}}",
                        type: "POST", 
                        data: values,
                        success: function(result){
                            $("#profile").html(result);
                    }});
                    $("div#email").hide();
                    $("div#password").hide();
                    $("div#button_register").hide();
                    $("div#button_log").hide();
                    $(".js-show-header-dropdown-user").css("border-radius", "100%");
                    $(".js-show-header-dropdown-user").css("width", "30px");
                    $(".js-show-header-dropdown-user").attr("src",""+ origin +"/storage/"+ result["avatar"] +"");
                    $("#email_incorrect").hide();
                    $("#password_incorrect").hide();*/
                }else{
                    $("#email_incorrect").show();
                    $("#password_incorrect").show();
                }
            }});
        }

        function submitLoginMobile(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            var email = $("input[name=email_mobile]").val();
            var password = $("input[name=password_mobile]").val();
            var origin   = "{{ env('APP_URL') }}";
            var values = { email : email, password : password };
            $.ajax({
                url: "{{url('/login')}}",
                type: "POST", 
                data: values,
                success: function(result){
                if(result["result"] != "incorrect"){
                    location.reload();
                    /*$.ajax({
                        url: "{{url('/profile')}}",
                        type: "POST", 
                        data: values,
                        success: function(result){
                            $("#profile").html(result);
                    }});
                    $("div#email").hide();
                    $("div#password").hide();
                    $("div#button_register").hide();
                    $("div#button_log").hide();
                    $(".js-show-header-dropdown-user").css("border-radius", "100%");
                    $(".js-show-header-dropdown-user").css("width", "30px");
                    $(".js-show-header-dropdown-user").attr("src",""+ origin +"/storage/"+ result["avatar"] +"");
                    $("#email_incorrect").hide();
                    $("#password_incorrect").hide();*/
                }else{
                    $("#email_incorrect").show();
                    $("#password_incorrect").show();
                }
            }});
        }

        function showEdit(){
            $("#password_incorrect_edit").hide();
            $("#password_different1").hide();
            $("#password_different2").hide();
            $("#button-cancel-edit").show();
            $("#password_old").show();
            $("#password_new").show();
            $("#confirm_password").show();
            $("input[name=name]").attr('readonly', false);
            $("input[name=email]").attr('readonly', false);
            $("#button-edit").html('Guardar');
            $("#button-edit").attr('onclick', 'saveProfile()');
        }

        function hideEdit(){
            $("#password_incorrect_edit").hide();
            $("#password_different1").hide();
            $("#password_different2").hide();
            $("#button-cancel-edit").hide();
            $("#password_old").hide();
            $("#password_new").hide();
            $("#confirm_password").hide();
            $("input[name=name]").attr('readonly', true);
            $("input[name=email]").attr('readonly', true);
            $("#button-edit").html('Editar');
            $("#button-edit").attr('onclick', 'showEdit()');
        }

        function saveProfile(){
            $("#password_incorrect_edit").hide();
            var name = $("input[name=name]").val();
            var email = $("input[name=email]").val();
            var email_original = $("input[name=email_original]").val();
            var password = $("input[name=password_old]").val();
            var password_new = $("input[name=password_new]").val();
            var confirm_password = $("input[name=confirm_password]").val();
            if(name == "" || email == "" || password == "" || password_new == "" || confirm_password == ""){
                return;
            }
            if(password_new != confirm_password){
                $("#password_different1").show();
                $("#password_different2").show();
                return;
            }
            var values = { name : name, email : email, password : password, password_new : password_new, email_original : email_original };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{url('/profile/edit/save')}}",
                type: "POST", 
                data: values,
                success: function(result){
                    if(result["result"] == "incorrect_password"){
                        $("#password_different1").hide();
                        $("#password_different2").hide();
                        $("#password_incorrect_edit").show();
                    }else{
                        $("#password_old").hide();
                        $("#password_new").hide();
                        $("#confirm_password").hide();
                        $("#password_incorrect_edit").hide();
                        $("#password_different1").hide();
                        $("#password_different2").hide();
                        $("#button-edit").html('Editar');
                        $("#button-edit").attr('onclick', 'showEdit()');
                        $("input[name=name]").attr('readonly', true);
                        $("input[name=email]").attr('readonly', true);
                        $("input[name=password_old]").val("");
                        $("input[name=password_new]").val("");
                        $("input[name=confirm_password]").val("");
                    }
            }});
        }

        function saveAdress(){
            var number = $("input[name=number]").val();
            var country = $("#country").val();
            var locality = $("input[name=locality]").val();
            var zip_code = $("input[name=zip_code]").val();
            var street = $("input[name=street]").val();
            var user_id = $("input[name=user_id]").val();
            if(number == "" || locality == "" || zip_code == "" || street == ""){
                $("#adresses_required").show();
                return;
            }
            var values = { number : number, country : country, locality : locality, zip_code : zip_code, street : street, user_id };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{url('/adress/save')}}",
                type: "POST", 
                data: values,
                success: function(result){
                    if(result["result"] == "success"){
                        location.reload();
                    }
            }});
        }

        function confirmPassword(){
            var password = $("input[name=rpassword]").val();
            var confirmpassword = $("input[name=confirmpassword]").val();

            if(password != confirmpassword){
                $("#confirmpassword").show();
            }else{
                $("#confirmpassword").hide();
            }
        }

        function submitRegist(){
            $("#registerSuccess").hide();
            $("#confirmpassword").hide();
            var nome = $("input[name=nome]").val();
            var email = $("input[name=remail]").val();
            var password = $("input[name=rpassword]").val();
            var confirmpassword = $("input[name=confirmpassword]").val();

            if(nome == "" || email == "" || password == "" || confirmpassword == ""){
                return;
            }

            $.ajax({url: "{{url('/check-email')}}"+ '/' + email, success: function(result){
                if(result == "error"){
                    $("#error_email").show();
                    return;
                }else{
                    if(password != confirmpassword){
                        $("#confirmpassword").show();
                        return;
                    }
                     
                    $("[name=rname]").val(nome);
                    $("[name=remail]").val(email);
                    $("[name=rpassword]").val(password);
                    $("#formToRegister").submit();
                }
            }});

            
        }

        /* function adressMain(el){
            var id = $(el).val();
            $.ajax({
            url: "{{url('/adress/update')}}", 
            type: "POST",
            data: '{"id":"' + id+'"}',
            success: function(result){
                 location.reload();
            },
            error: function(data){
             alert("fail");
             }
                
            });
        }*/

        
       function adressMain(el){
           var id = $(el).val();
             var id = $(el).val();
            $.ajax({url: "{{url('/adress/update')}}"+ '/' + id, success: function(result){
            }});
        }

        function changeButtonDeleteAdress($id){
            $("#button-delete-adress").attr("onclick", "adressRemove("+ $id +")");
          
        }

        function adressRemove(id){
            $.ajax({url: "{{url('/adress/remove')}}"+ '/' + id, success: function(result){
                if(result["result"] == "success"){
                }
            }});
        }
        

    </script>
    @yield('js')
</body>
</html>