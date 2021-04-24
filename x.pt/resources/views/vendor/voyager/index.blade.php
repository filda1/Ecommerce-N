@extends('voyager::master')

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <div class="row">
            @if (showStartSetup())

                <div class="col-md-12">
                    <div class="panel panel-border">
                        <div class="panel-body">
                            <div>
                                <h4>Obrigado pela sua confiança em nós!</h4>
                                <p style="margin:0; color:#999;">
                                    Está a poucos passos de ter a sua loja online, preencha as informações necessárias para podermos avançar!
                                </p>
                                <p style="margin:0; color:#999;">
                                    Se surgir alguma dúvida verifique a documentação, caso não fique esclarecido contacte-nos.
                                </p>
                                <button style="width: auto; margin-top: 15px;" type="text" class="form-control btn btn-info" id="save-button">Documentação</button>
                                <a href="http://www.ncommerce.pt#contact" target="_blank"><button style="width: auto; margin-top: 15px;" type="text" class="form-control btn btn-warning" id="save-button">Contactos</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">

                    <div class="col-md-4">
                        <div class="panel panel panel-bordered panel-success" style="border: 0;">
                            <div class="panel-heading" style="border: 0;">
                                <h3 class="panel-title"> Informações Necessárias</h3>
                                <div class="panel-actions">
                                    <a class="panel-action panel-collapsed voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body" style="display: none;">
                                <div class="form-group">
                                    <label for="status">Nome da Loja</label>
                                    <input type="text" class="form-control" id="store-name" name="store_name" placeholder="Ex: NCommerce" value="{{ setting('site.title') }}">
                                </div>
                                <div class="form-group">
                                    <button style="width: auto; float: right;" type="text" class="form-control w-auto" onclick="saveInformation()" id="save-button-information">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel panel-bordered panel-success" style="border: 0;">
                            <div class="panel-heading" style="border: 0;">
                                <h3 class="panel-title"> Aparência (Opcional)</h3>
                                <div class="panel-actions">
                                    <a class="panel-action panel-collapsed voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body" style="display: none;">
                                <div class="form-group">
                                    <label for="slug">Logótipo</label>
                                    <img id="logo-img" width="100%" src="{!!url('storage/'.setting('site.logo'))!!}">
                                    <input class="form-control" type="text" name="logo_img" value="{{ setting('site.logo') }}" style="display: none;">
                                    <button onclick="chooseLogoImage()" class="btn btn-sm btn-info form-control">Escolher Imagem</button>
                                </div>
                                <div class="form-group">
                                    <label for="status">Cor da Barra de Navegação</label>
                                    <input class="form-control" type="color" name="nav_color" value="{{ setting('site.barra_navegacao') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Cor do Texto da Barra de Navegação</label>
                                    <input class="form-control" type="color" name="nav_text_color" value="{{ setting('site.texto_barra_navegacao') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Cor do Fundo do Website</label>
                                    <input class="form-control" type="color" name="website_background_color" value="{{ setting('site.fundo_website') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Cor dos Títulos</label>
                                    <input class="form-control" type="color" name="titles_color" value="{{ setting('site.cor_titulos') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Cor dos Textos</label>
                                    <input class="form-control" type="color" name="text_color" value="{{ setting('site.cor_textos') }}">
                                </div>
                                <div class="form-group">
                                    <button style="width: auto; float: right;" type="text" class="form-control w-auto" onclick="saveAppearance()" id="save-button">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        
                        *::-webkit-input-placeholder { /* WebKit, Blink, Edge */
                            color: #76838f!important;
                        }
                        *:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
                           color: #76838f!important;
                           opacity: 1!important;
                        }
                        *::-moz-placeholder { /* Mozilla Firefox 19+ */
                           color: #76838f!important;
                           opacity: 1!important;
                        }
                        *:-ms-input-placeholder { /* Internet Explorer 10-11 */
                           color: #76838f!important;
                        }
                        *::-ms-input-placeholder { /* Microsoft Edge */
                           color: #76838f!important;
                        }

                        *::placeholder { /* Most modern browsers support this now. */
                           color: #76838f!important;
                        }

                    </style>

                    <div class="col-md-4">
                        <div class="panel panel panel-bordered panel-success" style="border: 0;">
                            <div class="panel-heading" style="border: 0;">
                                <h3 class="panel-title"> Outras Informações (Opcional)</h3>
                                <div class="panel-actions">
                                    <a class="panel-action panel-collapsed voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body" style="display: none;">
                                <div class="form-group">
                                    <label for="slug">Nome da Empresa</label>
                                    <input type="text" class="form-control" id="company-name" name="company_name" placeholder="Ex: NCommerce Loja Online" value="{{ setting('site.company_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Email da Empresa</label>
                                    <input type="email" class="form-control" id="company-email" name="company_email" placeholder="Ex: geral@ncommerce.pt" onkeyup="validaEmail()" value="{{ setting('site.company_email') }}">
                                    <p id='email_invalido' style='color: red; display: none;'>Email inválido</p>
                                </div>
                                <div class="form-group">
                                    <label for="status">Contacto da Empresa</label>
                                    <input type="text" class="form-control" id="company-contact" name="company_contact" placeholder="9xxxxxxxx" minlength="9" maxlength="9" value="{{ setting('site.company_contact') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">NIF da Empresa</label>
                                    <input type="text" class="form-control" id="company-vat" name="company_vat" placeholder="xxxxxxxxx" value="{{ setting('site.company_vat') }}" maxlength="9" onkeyup="validaContribuinte()">
                                    <p id='nif_invalido' style='color: red; display: none;'>NIF inválido</p>
                                </div>
                                <div class="form-group">
                                    <button style="width: auto; float: right;" type="text" class="form-control w-auto" onclick="saveAddicionalInformation()" id="save-button">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="panel panel panel-bordered panel-success" style="border: 0;">
                            <div class="panel-heading" style="border: 0;">
                                <h3 class="panel-title"> Informações de Pagamentos <br>Transferência Bancária</h3>
                                <div class="panel-actions">
                                    <a class="panel-action panel-collapsed voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body" style="display: none;">
                                <div class="form-group">
                                    <label for="status">Nome do Banco</label>
                                    <input type="text" class="form-control" id="n_banco" name="n_banco" placeholder="Ex: Montepio" value="{{ setting('site.n_banco') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">Nº de Conta</label>
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "13" class="form-control" id="n_account" name="n_account" placeholder="xxxxxxxxxxxxx" value="{{ setting('site.n_account') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">IBAN</label>
                                    <div style="display: flex;">
                                        <input type="text" style="width: 25%;" class="form-control" id="pt50" name="pt50" placeholder="PT50" value="PT50" disabled="">
                                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "21" style="width: 75%;" class="form-control" id="nib" name="nib" placeholder="xxxxxxxxxxxxxxxxxxxxx" value="{{ setting('site.nib') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">BIC/SWIFT</label>
                                    <input type="text" class="form-control" minlength="8" maxlength="11" id="bic" name="bic" placeholder="xxxxxxxx" value="{{ setting('site.bic') }}">
                                </div>
                                <div class="form-group">
                                    <button style="width: auto; float: right;" type="text" class="form-control w-auto" onclick="saveInformationPayTB()" id="save-button-information">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel panel-bordered panel-success" style="border: 0;">
                            <div class="panel-heading" style="border: 0;">
                                <h3 class="panel-title"> Informações de Pagamentos <br>PayPal</h3>
                                <div class="panel-actions">
                                    <a class="panel-action panel-collapsed voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body" style="display: none;">
                                <h5><a onclick="$('#modalPaypal').modal('show');" class="video-btn" data-toggle="modal" style="cursor: pointer;">Como posso obter estes dados?</a></h5>
                                <div class="form-group">
                                    <label for="status">PAYPAL USERNAME</label>
                                    <input type="text" class="form-control" id="paypal_username" name="paypal_username" placeholder="xxxxxxxxxxxxxxxxxxx" value="{{ setting('site.paypal_username') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">PAYPAL PASSWORD</label>
                                    <input type="text" class="form-control" id="paypal_password" name="paypal_password" placeholder="xxxxxxxxxxxxxxxxxxx" value="{{ setting('site.paypal_password') }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">PAYPAL SIGNATURE</label>
                                    <input type="text" class="form-control" id="paypal_signature" name="paypal_signature" placeholder="xxxxxxxxxxxxxxxxxxx" value="{{ setting('site.paypal_signature') }}">
                                </div>
                                <div class="form-group">
                                    <button style="width: auto; float: right;" type="text" class="form-control w-auto" onclick="saveInformationPayPayPal()" id="save-button-information">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modal-logo-choose" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Logotipo</h4>
                      </div>
                      <div class="modal-body">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>

                  </div>
                </div>
            @else
                            
            @endif
        </div>
    </div>

    <style>
        
        .modal-dialog-paypal {
            margin: 30px auto;
        }
        .modal-body-paypal {
            position:relative;
            padding:0px;
        }
        .closepaypal {
            position:absolute;
            right:-30px;
            top:0;
            z-index:999;
            font-size:2rem;
            font-weight: normal;
            color:#fff;
            opacity:1;
        }

    </style>

    <div class="modal fade" id="modalPaypal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-paypal modal-lg " role="document">
            <div class="modal-content">
              
                <div class="modal-body modal-body-paypal">

                    <button type="button" class="close closepaypal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        

                    <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item" width="320" height="240" controls>
                            <source id="video" src="http://ncommerce.pt/video/paypal.mp4" type="video/mp4">
                        </video>
                    </div>
                        
                </div>

            </div>
        </div>
    </div> 

    <div class="modal fade" id="documentation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-paypal modal-lg " role="document">
            <div class="modal-content">
              
                <div class="modal-body modal-body-paypal">

                    <button type="button" class="close closepaypal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>        

                    <div style="display: table; width: 100%; height: 200px; text-align: center;">
                        <div style="display: table-cell; vertical-align: middle; font-size: 3rem;">Brevemente</div>
                    </div>
                        
                </div>

            </div>
        </div>
    </div> 

@stop

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js" integrity="sha256-1fEPhSsRKlFKGfK3eO710tEweHh1fwokU5wFGDHO+vg=" crossorigin="anonymous"></script>
    <script>

    var chooseLogoWindow;
    $( document ).ready(function() {
        $.ajaxSetup({
          headers : { "X-CSRF-TOKEN": token},
          timeout: 10000
        });
    });

    $("#save-button").click(function() {
        $("#documentation").modal("show");
    });

    function saveInformation(){
        var value = $("input[name=store_name]").val();
        var nib = $("input[name=store_nib]").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        var values = { value : value , nib : nib };
        $.ajax({
            url: "{{url('/save-information')}}",
            type: "POST", 
            data: values,
            success: function(result){
                if(result["result"] == "success")
                    location.reload();
        }});
    }

    function chooseLogoImage(){
        chooseLogoWindow = window.open('{{ url('media') }}','chooseLogoWindow','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=1300,height=900');
    }

    var user_disk = "{{ url('storage/user_disk') }}";
    function setImage(img) {
        $("#logo-img").attr('src', user_disk+img).css('display', 'block');
        $("input[name=logo_img]").attr('value', "user_disk"+img);
    }

    function saveAppearance(){
        $.ajax({
            url: "{{url('/save-appearance')}}",
            type: "post",
            tryCount : 0,
            retryLimit : 3, 
            data: {
                logo: $("input[name=logo_img]").attr('value'),
                nav_color: $('input[name="nav_color"]').val(),
                nav_text_color: $('input[name="nav_text_color"]').val(),
                website_background_color: $('input[name="website_background_color"]').val(),
                titles_color: $('input[name="titles_color"]').val(),
                texts_color: $('input[name="text_color"]').val(),
            },
            success: function(result){
                console.log(result);
                if(result["result"] == "success")
                    location.reload();
                },
            error: function(jqXHR, textStatus, errorThrown) {
                if (textStatus == 'timeout') {
                  this.tryCount++;
                  if (this.tryCount <= this.retryLimit) {
                      //try again
                      $.ajax(this);
                      return;
                  }            
                  return;
                }
            }
        });
    }

    function saveInformationPayTB(){
        var n_banco = $("input[name=n_banco]").val();
        var n_account = $("input[name=n_account]").val();
        var nib = $("input[name=nib]").val();
        var bic = $("input[name=bic]").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        var values = { n_account : n_account , nib : nib , bic : bic , n_banco : n_banco };
        $.ajax({
            url: "{{url('/save-information-pay-tb')}}",
            type: "POST", 
            data: values,
            success: function(result){
                if(result["result"] == "success")
                    location.reload();
        }});
    }

    function saveInformationPayPayPal(){
        var paypal_username = $("input[name=paypal_username]").val();
        var paypal_password = $("input[name=paypal_password]").val();
        var paypal_signature = $("input[name=paypal_signature]").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        var values = { paypal_username : paypal_username , paypal_password : paypal_password , paypal_signature : paypal_signature };
        $.ajax({
            url: "{{url('/save-information-pay-paypal')}}",
            type: "POST", 
            data: values,
            success: function(result){
                if(result["result"] == "success")
                    location.reload();
        }});
    }

    function saveAddicionalInformation(){
        $("#email_invalido").hide();
        $("#nif_invalido").hide();
        var company_name = $("input[name=company_name]").val();
        var company_email = $("input[name=company_email]").val();
        var company_contact = $("input[name=company_contact]").val();
        var company_vat = $("input[name=company_vat]").val();

        var checkcontribuinte = validaContribuinte();
        if(checkcontribuinte == "error"){
            return;
        }

        var test_email = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (test_email.test(company_email)){
            // Do whatever if it passes.
        }else{
            $("#email_invalido").show();
            return;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        var values = { company_name : company_name , company_email : company_email , company_contact : company_contact , company_vat : company_vat };
        $.ajax({
            url: "{{url('/save-addicional-information')}}",
            type: "POST", 
            data: values,
            success: function(result){
                if(result["result"] == "success")
                    location.reload();
        }});
    }

    function validaEmail(){
        $("#email_invalido").hide();
        var company_email = $("input[name=company_email]").val();

        var test_email = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (test_email.test(company_email)){
            $("#email_invalido").hide();
        }else{
            $("#email_invalido").show();
        }
    }

    /*
    Source: http://www.portugal-a-programar.pt/topic/58852-algoritmo-de-validacao-de-nif-pt/
    */

    function validaContribuinte(){
        $("#nif_invalido").hide();
        var contribuinte = $("input[name=company_vat]").val();
        // algoritmo de validação do NIF de acordo com
        // http://pt.wikipedia.org/wiki/N%C3%BAmero_de_identifica%C3%A7%C3%A3o_fiscal

        var temErro=0;

        if (
        contribuinte.substr(0,1) != '1' && // pessoa singular
        contribuinte.substr(0,1) != '2' && // pessoa singular
        contribuinte.substr(0,1) != '3' && // pessoa singular
        contribuinte.substr(0,2) != '45' && // pessoa singular não residente
        contribuinte.substr(0,1) != '5' && // pessoa colectiva
        contribuinte.substr(0,1) != '6' && // administração pública
        contribuinte.substr(0,2) != '70' && // herança indivisa
        contribuinte.substr(0,2) != '71' && // pessoa colectiva não residente
        contribuinte.substr(0,2) != '72' && // fundos de investimento
        contribuinte.substr(0,2) != '77' && // atribuição oficiosa
        contribuinte.substr(0,2) != '79' && // regime excepcional
        contribuinte.substr(0,1) != '8' && // empresário em nome individual (extinto)
        contribuinte.substr(0,2) != '90' && // condominios e sociedades irregulares
        contribuinte.substr(0,2) != '91' && // condominios e sociedades irregulares
        contribuinte.substr(0,2) != '98' && // não residentes
        contribuinte.substr(0,2) != '99' // sociedades civis

        ) { temErro=1;}
        var check1 = contribuinte.substr(0,1)*9;
        var check2 = contribuinte.substr(1,1)*8;
        var check3 = contribuinte.substr(2,1)*7;
        var check4 = contribuinte.substr(3,1)*6;
        var check5 = contribuinte.substr(4,1)*5;
        var check6 = contribuinte.substr(5,1)*4;
        var check7 = contribuinte.substr(6,1)*3;
        var check8 = contribuinte.substr(7,1)*2;

        var total= check1 + check2 + check3 + check4 + check5 + check6 + check7 + check8;
        var divisao= total / 11;
        var modulo11=total - parseInt(divisao)*11;
        if ( modulo11==1 || modulo11==0){ comparador=0; } // excepção
        else { comparador= 11-modulo11;}


        var ultimoDigito=contribuinte.substr(8,1)*1;
        if ( ultimoDigito != comparador ){ temErro=1;}

        if (temErro==1){ 
            $("#nif_invalido").show();
            return "error";
        }
    }
        
    </script>
@stop
