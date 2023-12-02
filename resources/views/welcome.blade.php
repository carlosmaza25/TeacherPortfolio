<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    @vite('resources/css/app.css') 
</head>
 <body class="flex justify-center items-center h-screen">
    @if (session('alert'))
    <div class="container absolute top-2 left-0 right-0">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{session('alert')}}</span>
          </div>      
    </div>
    @endif
    <div class="container grid grid-cols-1 lg:grid-cols-2 w-full h-screen lg:h-3/5 bg-red-800 rounded-md">
        <div class="flex flex-col items-center border-r-2 h-4/5 my-14">
            <h1 class="text-3xl text-yellow-300 py-16">Portafolio Pedagógico</h1>
            <h1 class="text-white py-32">¿Ha extraviado la contraseña?</h1>
        </div>
        <div class="flex flex-col items-center">
            <h1 class="text-white my-16">Ingresar con</h1>
            <a href="{{route('google.redirect')}}">
                <button class="bg-yellow-300 px-2 h-8 rounded-md my-6"><i class="fab fa-google mx-2"></i>Correo Institucional</button>
            </a>
            <button class="bg-yellow-300 px-2 h-8 rounded-md">Credenciales</button>
        </div>
    </div>
 </body>
</html>
