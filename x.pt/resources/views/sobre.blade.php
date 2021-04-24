
@extends($isAjax == false ? 'layout.master' : 'layout.empty')


@section('content')
    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-38">
        <div class="container">
            <div class="row">
                <div class="col-md-4 p-b-30">
                    <div class="hov-img-zoom">
                        <img src="{!! url('storage/'.$sobre->imagem) !!}" alt="IMG-ABOUT">
                    </div>
                </div>

                <div class="col-md-8 p-b-30">
                    <h3 class="m-text26 p-t-15 p-b-16">
                        Sobre2
                    </h3>
                    {!! $sobre->texto !!}
                </div>
            </div>
        </div>
    </section>

    <section class="bgwhite p-t-66 p-b-60" id="contactos">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-b-30">
                    <div class="p-r-20 p-r-0-lg">
                        <div class="mapouter">
                          <div class="gmap_canvas">
                            <iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $contacto->lat }}%2C%20{{ $contacto->lng }}&t=k&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 p-b-30">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <form class="leave-comment" action="{{ route('contactus.store') }}" method="post">
                        {{ csrf_field() }}
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Entre em contacto connosco.
                        </h4>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="nome" placeholder="Nome">
                        </div>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="contacto" placeholder="Nº Telemóvel">
                        </div>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email">
                        </div>

                        <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="mensagem" placeholder="Mensagem"></textarea>

                        <div class="w-size25">
                            <!-- Button -->
                            <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
