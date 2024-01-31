<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ًApplication</title>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xw5dSDCoUtz5fi3hVcGpMVtG9C00YtL7Vp4+5EJtCMbbt1I78FYPf8keAHD6BdQxK3uCQG6O5ddgrKpx+QbAOw==" crossorigin="anonymous" />
    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>