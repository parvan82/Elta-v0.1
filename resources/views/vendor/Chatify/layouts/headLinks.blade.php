<title>{{ config('chatify.name') }}</title>

{{-- Meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="user-id" content="{{ auth()->id() }}">
<meta name="id" content="{{ $id }}">
<meta name="messenger-color" content="{{ $messengerColor }}">
<meta name="messenger-theme" content="{{ $dark_mode }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">

{{-- scripts --}}
<script src="{{ asset('/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
@vite(['resources/js/app.js'])
<script src="{{ asset('js/nprogress.js') }}"></script>
<script src="{{ asset('js/pusher.min.js') }}"></script>
<script src="{{ asset('js/echo.iife.js') }}"></script>
<script>
    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '12498396a9482f327dfc',
        cluster: 'mt1',
        encrypted: true,
        forceTLS: true,
    });
</script>


{{-- styles --}}
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />

{{-- Setting messenger primary color to css --}}
<style>
    :root {
        --primary-color: {{ $messengerColor }};
    }
    
    /* Pinned Project Card Styles - Light Mode (default) */
    .pinned-project-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .pinned-project-title {
        color: #2c3e50;
    }
    
    .pinned-project-description {
        color: #6c757d;
    }
    
    .pinned-project-card:hover {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    }
</style>
