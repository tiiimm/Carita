<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Carita</title>

        <link href="css/app.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <v-app id=app>
            <router-view class="fullscreen"></router-view>
            <vue-progress-bar></vue-progress-bar>
        </v-app>
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/superfish/hoverIntent.js"></script>
        <script src="lib/superfish/superfish.min.js"></script>
        <script src="lib/morphext/morphext.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/stickyjs/sticky.js"></script>
        <script src="lib/easing/easing.js"></script>
        <script src="js/custom.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
