
<!DOCTYPE html>
<html  class="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/input.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .action_btn:disabled{
          background: #00a87da8;
          cursor: not-allowed;
        }
      </style>
    @yield('head')
</head>

<body style="background: url('{{asset('images/bg.png')}}');" class="bg-no-repeat bg-cover bg-center ">
@yield('main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>