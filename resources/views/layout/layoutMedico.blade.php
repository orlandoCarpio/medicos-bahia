<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Médicos Bahia Blanca</title>
    <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/style.css">
<!-- JS, Popper.js, and jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/functionEffects.js"></script>
<script src="../js/functionsData.js"></script>
<script src="../js/script.js"></script>
</head>
<body>
        @include('navigation')  
        <div class="container" id="cont-medico">    
            <div class="row">  
                <div class="col-sm-3">
                    @include('template.menu-lateral')
                </div>
                {{-- @include('menu-top'); --}}
                <div class="col-sm-9">
                    @yield('contenido')
                </div>        
            </div>
        </div>
   
    
</body>
</html>