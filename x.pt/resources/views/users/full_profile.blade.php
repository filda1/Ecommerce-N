@extends($isAjax == false ? 'layout.master' : 'layout.empty')

@section('content')




<div class="container">
    
    <div class="row">
        
        <div class="form-group col-md-12" style="margin: 20px 0; display: table;">

            <div class="form-group col-md-12 text-center">
                
                <img src="@if(Auth::check()) {{ url('storage').'/'.Auth::user()->avatar}} @else {{asset('assets/images/icons/icon-header-01.png')}} @endif" class="js-show-header-dropdown-user" alt="ICON" style="border-radius: 100%; width: 15%;">

            </div>

            <div class="form-group col-md-12">

                <label for="name">Nome:</label>

                <input type="text" class="form-control-website" name="name" placeholder="Nome" value="{{ Auth::user()->name }}" readonly>

            </div>

            <div class="form-group col-md-12">

                <label for="name">Email:</label>

                <input type="email" class="form-control-website" name="email_original" placeholder="Email" value="{{ Auth::user()->email }}" style="display: none;" readonly>

                <input type="email" class="form-control-website" name="email" placeholder="Email" value="{{ Auth::user()->email }}" readonly>

            </div>

            <div class="form-group col-md-12" id="password_old" style="display: none;">

                <label for="name">Password Antiga:</label>

                <input type="password" class="form-control-website" name="password_old" placeholder="Password Antiga" value=""></br>

                <p id="password_incorrect_edit" style="color: red; white-space: nowrap; display: none; ">Password Incorreta</p>

            </div>

            <div class="form-group col-md-12" id="password_new" style="display: none;">

                <label for="name">Password Nova:</label>

                <input type="password" class="form-control-website" name="password_new" placeholder="Password Nova" value=""></br>

                <p id="password_different1" style="color: red; white-space: nowrap; display: none;">As passwords não coincidem</p>

            </div>

            <div class="form-group col-md-12" id="confirm_password" style="display: none;">

                <label for="name">Confirmar Password:</label>

                <input type="password" class="form-control-website" name="confirm_password" placeholder="Confirmar Password" value=""></br>

                <p id="password_different2" style="color: red; white-space: nowrap; display: none;">As passwords não coincidem</p>

            </div>

            <div class="panel-footer col-md-12">

                <button id="button-edit" type="submit" onclick="showEdit()" class="flex-c-m bg1 bo-rad-20 hov1 s-text1 trans-0-4 size-button-edit">Editar</button>

                <button id="button-cancel-edit" type="submit" onclick="hideEdit()" class="flex-c-m bg1 bo-rad-20 hov1 s-text1 trans-0-4 size-button-edit" style="background-color: #dc3545; display: none;">Cancelar</button>

            </div>

        </div>

        <!--ADDRESS -->
        <div class="form-group col-md-12" style="margin: 20px 0; display: table;">

            <div class="form-group col-md-12">
                
                <h3 style="display: inline-block;">Endereços</h3><button data-toggle="modal" data-target="#exampleModal" style="font-size: 20px; margin: 0 20px;"><i class="fa fa-plus"></i></button>

            </div>

       
            <div class="form-group col-md-12 adress">

                @foreach($adresses as $adress)
                
                    <div class="col-md-4 border border-dark p-2 mt-1">
                        <h6>{{ $adress->street }}, {{ $adress->locality }}, {{ $adress->zip_code }} - {{ $adress->country }}</h6>
                        <h6>{{ $adress->number }}</h6>
                        <label><input name="endereco" onchange="adressMain(this)" @if($adress->is_main == 1) checked @endif type="radio" value="{{ $adress->id }}"> Tornar Endereço Principal</label></br>
                        <button type="button" data-toggle="modal" onclick="changeButtonDeleteAdress('{{ $adress->id }}')" data-target="#exampleModal1" class="btn btn-danger">Remover Endereço</button>
                    </div>

                @endforeach

            </div>

        </div>
        
    </div>

</div>

<!-- Modal Apagar Endereço -->
<div class="modal" tabindex="-1" id="exampleModal1" role="dialog" style="background-color: #00000096;">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content1">
      <div class="modal-header">
        <h5 class="modal-title">Tem a certeza que deseja eliminar este Endereço?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" id="button-delete-adress" onclick="">Sim</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Novo Endereço -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: #00000096;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Novo Endereço</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group col-md-12">

            <label for="name">Telemóvel:</label>

            <input type="number" maxlength="9" class="form-control-website" name="number" placeholder="Telemóvel" value="" required>

            <input type="number" class="form-control-website" name="user_id" placeholder="User Id" value="{{ Auth::user()->id }}" style="display: none;">

        </div>

        <div class="form-group col-md-12">

            <label for="name">País:</label>

            <select class="form-control user-mini-window-border" id="country" name="country" style="width: 80%; float: right;" required>

                @include('country.countries')
                
            </select>

        </div>

        <div class="form-group col-md-12">

            <label for="name">Localidade:</label>

            <input type="text" class="form-control-website" name="locality" placeholder="Localidade" value=""></br>

        </div>

        <div class="form-group col-md-12">

            <label for="name">Código Postal:</label>

            <input type="text" class="form-control-website" name="zip_code" placeholder="Código Postal" value=""></br>

        </div>

        <div class="form-group col-md-12">

            <label for="name">Rua:</label>

            <input type="text" class="form-control-website" name="street" placeholder="Rua" value=""></br>

            <p id="adresses_required" style="color: red; white-space: nowrap; display: none;">Todos os campos são obrigatórios!</p>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="saveAdress()" class="flex-c-m bg1 bo-rad-20 hov1 s-text1 trans-0-4 size-button-add">Guardar Endereço</button>
      </div>
    </div>
  </div>
</div>

@endsection

