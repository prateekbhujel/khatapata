<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }} </title>

    <link rel="stylesheet" href="{{ url('public/css/admin.css') }}">
    
    @routes
    
    @if (!empty($settings->favico))
      <link rel="icon" href="{{ asset($settings->favico) }}" type="image/x-icon">
    @endif
    
</head>

<body class="bg-body-secondary">
      @auth('cms')
        @include('admin.templates.navbar')
      @endauth

    @yield('content')

    <div class="mx-3 my-5 position-fixed bottom-0 start-0">
      @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="toast align-items-center text-bg-danger border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                  <div class="toast-body">
                    {{ $error }}
                  </div>
                  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>
            @endforeach
        @endif

        @if (session()->has('success'))
          <div class="toast align-items-center text-bg-success border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                {{ session()->get('success') }}
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        @endif
    </div>

    <script src="{{ url('public/js/admin.js?123') }}"></script>


    @stack('scripts')
</body>
</html>