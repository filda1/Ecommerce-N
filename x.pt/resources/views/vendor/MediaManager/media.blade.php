<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('MediaManager::messages.title') }}</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
</head>
<body>
    <section id="app" v-cloak>
        {{-- notifications --}}
        <div class="notif-container">
            <my-notification></my-notification>
        </div>

        <div class="container is-fluid">
            <div class="columns">
                {{-- media manager --}}
                <div class="column">
                    @include('MediaManager::_manager', ['restrict' => [
                        'path' => 'user_disk', 
                    ]])
                </div>
            </div>
        </div>
    </section>

    {{-- footer --}}
    @stack('styles')
    @stack('scripts')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

    //Single Image Choosing
    function ImageChoosed() {
        var img = $(".__file-box.selected img").attr('src').split('user_disk');
        window.opener.setImage(img[1]);
        window.close();
    }
    </script>
</body>
</html>
