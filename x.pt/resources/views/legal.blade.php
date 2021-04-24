
@extends($isAjax == false ? 'layout.master' : 'layout.empty')


@section('content')
    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-38">
        <div class="container">
            <div class="row">
                {!! $sobre->texto !!}
            </div>
        </div>
    </section>
@endsection
