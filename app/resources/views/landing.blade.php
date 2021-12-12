<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Cheems Store</title>
        <link  rel="stylesheet" href=" {{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
    <!-- Script font awesome tạm thời -->
    <script src="https://kit.fontawesome.com/21dc83aae1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    <script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>

        <script src="{{ mix('js/bootstrap.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
