<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preload" as="image" href="{{ asset('img/menu.png') }}">
    <link rel="preload" as="image" href="{{ asset('img/logo.png') }}">
    <link rel="preload" as="image" href="{{ asset('img/unicaes.jpg') }}">
    <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
/>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')

    <nav class="bg-red-800 py-6 relative">
        <div class="container h-2 flex items-start">
         <div class="-my-4 flex lg:hidden px-8">
             <img src="{{ asset('img/menu.png') }}" class="h-10 w-10" onclick="openMenu();">
         </div>
            <div class="-my-9 lg:flex hidden">
             <img src="{{ asset('img/logo.png') }}" class="w-16 h-16">
            </div>
            <div class="-my-4 lg:flex hidden">
             <img src="{{ asset('img/unicaes.jpg') }}" class="w-25 h-7">
            </div>
            <div id= "menu" class="lg:flex hidden px-20 absolute lg:relative lg:top-0 top-20 -my-2">
                <div class="flex flex-col lg:flex-row bg-red-800 text-white absolute lg:relative left-0 -mt-6 lg:mt-0">
                 <a href="{{route('home.index' , ['cycleid' => session('cycleid')])}}" class="px-5 lg:text-white mb-8 lg:mb-0">Docentes</a>
                 <a href="{{route('subject.admin' , ['cycleid' => session('cycleid')])}}" class="px-5 lg:text-white mb-8 lg:mb-0">Materias</a>
                 <a href="{{route('libro.index')}}" class="px-5 lg:text-white mb-8 lg:mb-0">Libros</a>
                 <a href="{{route('admin.cycle')}}" class="px-5 lg:text-white mb-8 lg:mb-0">Ciclos</a>
                 <a href="{{route('file')}}" class="px-5 lg:text-white mb-8 lg:mb-0">Documentos</a>
                </div>
             </div>
        </div>
        <div class="container h-2 flex items-start">
         </div>
            <div class="-my-4 px-5 flex justify-end">
             <div class="-my-8">
                <a href="{{route('teacher.index' , ['id' => session('id')])}}"><img src="{{$socialProfile->socialavatar}}" class="w-12 h-12 rounded-full mx-2 my-2"></a>
             </div>
                <select name="" id="information" class="bg-color bg-blue-200 h-9 w-60 rounded-xl -my-5">
                    <option value="user" class="">{{$name}}</option>
                    <option value="profile" class="my-12">Mi perfil</option>
                    <option value="settings" class="my-12">Configuración</option>
                    <option value="{{route('login')}}">Cerrar Sesión</option>
                </select>
             </div>  
         </nav>
</head>
<body class="flex flex-col min-h-screen">
    <div class="flex flex-grow">
        @yield('content')
    </div>
    @livewireScripts

    <script>
            function openMenu() {
            let menu = document.getElementById('menu');
            if (menu) { 
                if (menu.classList.contains('hidden')) {
                        menu.classList.remove('hidden');
                } else {
                        menu.classList.add('hidden');
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
    
            var hijo = document.querySelector(".container .hijo");
            if (hijo) { 
                hijo.classList.remove("container");
            }
        });
    </script>

    <script>
        document.getElementById("information").addEventListener("change", function() {
          var selectedOption = this.options[this.selectedIndex];
          if (selectedOption.value !== "") {
            window.location.href = selectedOption.value;
          }
        });
      </script>
      
</body>

<footer class="h-52 bg-blue-200">
    <div class="container">
        <h1 class="text-white text-2xl">Mantenerse en Contacto</h1>
        <h1 class="text-black text-2xl">Universidad Católica de el salvador</h1>
        <div class="px-5 flex flex-row">
           <img src="{{ asset('img/web.png') }}" class="w-4 h-4 mx-4 my-2">
           <a href="https://catolica.edu.sv" class="text-white text-xl">https://catolica.edu.sv</a>
        </div>
        <div class="px-5 flex flex-row">
            <img src="{{ asset('img/cel.png') }}" class="w-4 h-4 mx-4 my-2">
            <h1 class="text-white text-xl">2484-0660 | 2484-0642</h1>
         </div>
         <div class="px-5 flex flex-row">
            <img src="{{ asset('img/email.png') }}" class="w-4 h-4 mx-4 my-2">
            <h1 class="text-white text-xl">soporte@catolica.edu.sv</h1>
         </div>
         <div class="flex lg:justify-end absolute lg:relative">
             <div class="flex flex-row py-36 lg:py-0">
                <a href="https://www.facebook.com/UNICAES/" class="mx-2">
                    <img src="{{ asset('img/facebook.png') }}" class="w-6 h-6 -my-32">
                </a>
                <a href="https://twitter.com/i/flow/login?redirect_after_login=%2Funicaes_sv">
                    <img src="{{ asset('img/twitter.png') }}" class="w-6 h-6 -my-32">
                </a>
                <a href="https://www.linkedin.com/school/universidad-catolica-de-el-salvador/" class="mx-2">
                    <img src="{{ asset('img/linkedin.png') }}" class="w-6 h-6 -my-32">
                </a>
                <a href="https://www.youtube.com/channel/UCXDsbngj7qUa2wVlm9ogPvw">
                    <img src="{{ asset('img/youtube.png') }}" class="w-6 h-6 -my-32">
                </a>
                <a href="https://www.instagram.com/unicaes_sv/?hl=es-la">
                    <img src="{{ asset('img/instagram.png') }}" class="w-6 h-6 -my-32 mx-2">
                </a>
             </div>
         </div>
    </div>
</footer>

</html>