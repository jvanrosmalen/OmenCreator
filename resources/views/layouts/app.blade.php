<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Omen Creator</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

	<!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

	<link href="{{ URL::asset('css/create.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/equipment.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/showall.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/mainstyle.css') }}" rel='stylesheet' type='text/css'>
    <script src="{{ URL::asset('js/skill/Skill.js') }}"></script>
	<script src="{{ URL::asset('js/skill/create.js') }}"></script>
    <script src="{{ URL::asset('js/ajax/ajaxInterface.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/armor/armor.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/shield/shield.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/weapon/weapon.js') }}"></script>
  
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="{{ url('/home') }}"><img src="{{ URL::asset('img/omen.png') }}" alt="Omen Creator"></a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Vaardigheden<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/create') }}">Cre&euml;er Vaardigheid</a></li>
                                <li><a href="{{ url('/skillshowall') }}">Overzicht Vaardigheden</a></li>
                            </ul>
                    </li>

                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Uitrusting<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/showall_armor') }}">Pantsers</a></li>
                                <li><a href="{{ url('/showall_shield') }}">Schilden</a></li>
                                <li><a href="{{ url('/showall_weapon') }}">Wapens</a></li>
                                <li><a href="{{ url('/showall_craft_equipment') }}">Ambachtsuitrusting</a></li>
                                <li><a href="{{ url('/showall_general_equipment') }}">Overzicht Algemene Uitrusting</a></li>
                            </ul>

<!-- Example in case of submenu <ul class="dropdown-menu" role="menu"> -->
<!--                                 <li class="menu-item dropdown dropdown-submenu"> -->
<!--                                 	<a href="{{ url('/showall_equipment') }}" class="dropdown-toggle" data-toggle="dropdown">Overzicht Uitrusting</a> -->
<!-- 		                            <ul class="dropdown-menu"> -->
<!-- 		                                <li class="menu-item "> -->
<!-- 		                                    <a href="{{ url('/showall_armor') }}">Overzicht Pantsers</a> -->
<!-- 		                                </li> -->
<!-- 		                                <li class="menu-item "> -->
<!-- 		                                    <a href="{{ url('/showall_shield') }}">Overzicht Schilden</a> -->
<!-- 		                                </li> -->
<!-- 		                                <li class="menu-item "> -->
<!-- 		                                    <a href="{{ url('/showall_weapon') }}">Overzicht Wapens</a> -->
<!-- 		                                </li> -->
<!-- 		                                <li class="menu-item "> -->
<!-- 		                                    <a href="{{ url('/showall_craft_equipment') }}">Overzicht Ambachtsuitrusting</a> -->
<!-- 		                                </li> -->
<!-- 		                                <li class="menu-item "> -->
<!-- 		                                    <a href="{{ url('/showall_general_equipment') }}">Overzicht Algemene Uitrusting</a> -->
<!-- 		                                </li> -->
<!-- 		                            </ul> -->
<!--                                 </li> -->
<!--                             </ul> -->
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
