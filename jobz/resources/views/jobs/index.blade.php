<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jobilla testing</title>

        <!-- Fonts -->
        <script src="{{ asset('js/tether.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        
        <script>
            globals = {
                assetRoot: "{{ asset('js/') }}"
            }
        </script>
    </head>
    <body>
    
        <div id="job-app">
            <job-list></job-list>
        </div>
        
        <script src="{{ asset('js/vue.js') }}"></script>
        <script src="{{ asset('js/httpVueLoader.js') }}"></script>
        <script src="{{ asset('js/views/job-app.js') }}"></script>
        
    </body>
</html>
