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
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- All other stuff -->
	<link href="{{ URL::asset('css/create.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/equipment.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/showall.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/showalluser.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/mainstyle.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/rule.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/race.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/playerClass.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/character.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/popup.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/errorMessage.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/promptMessage.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/loaderMessage.css') }}" rel='stylesheet' type='text/css'>
    <script src="{{ URL::asset('js/ajax/ajaxInterface.js') }}"></script>
    <script src="{{ URL::asset('js/character/createCharacter.js') }}"></script>
    <script src="{{ URL::asset('js/character/createPlayerCharBasicInfo.js') }}"></script>
    <script src="{{ URL::asset('js/character/createPlayerCharTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/character/createPlayerCharSkills.js') }}"></script>
    <script src="{{ URL::asset('js/character/createCharacterTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/character/editPlayerChar.js') }}"></script>
    <script src="{{ URL::asset('js/class/playerClass.js') }}"></script>
    <script src="{{ URL::asset('js/class/createClassTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/skill/createSkillTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/skill/createSkillControl.js') }}"></script>
    <script src="{{ URL::asset('js/skill/Skill.js') }}"></script>
	<script src="{{ URL::asset('js/skill/create.js') }}"></script>
	<script src="{{ URL::asset('js/skill/createSkillgroup.js') }}"></script>
	<script src="{{ URL::asset('js/skill/createSkillGroupControl.js') }}"></script>
	<script src="{{ URL::asset('js/skill/showall.js') }}"></script>
    <script src="{{ URL::asset('js/class/createClassTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/armor/armor.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/shield/shield.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/weapon/weapon.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/craft_equipment/craftEquipmentTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/craft_equipment/craftEquipment.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/generic_equipment/genericEquipmentTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/equipment/generic_equipment/genericEquipment.js') }}"></script>
    <script src="{{ URL::asset('js/race/createRaceControl.js') }}"></script>
    <script src="{{ URL::asset('js/race/createRaceTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/race/race.js') }}"></script>
    <script src="{{ URL::asset('js/rule/rulesInclude.js') }}"></script>
    <script src="{{ URL::asset('js/rule/rule.js') }}"></script>
    <script src="{{ URL::asset('js/layouts/tabController.js') }}"></script>
    <script src="{{ URL::asset('js/character/createCharacter.js') }}"></script>
    <script src="{{ URL::asset('js/character/createCharacterControl.js') }}"></script>
    <script src="{{ URL::asset('js/character/createCharacterTabControl.js') }}"></script>
    <script src="{{ URL::asset('js/popups/playerSelector.js') }}"></script>
    <script src="{{ URL::asset('js/popups/errorMessage.js') }}"></script>
    <script src="{{ URL::asset('js/popups/promptMessage.js') }}"></script>
    <script src="{{ URL::asset('js/popups/loaderMessage.js') }}"></script>
    <script src="{{ URL::asset('js/libraries/sorttable.js') }}"></script>
    <script src="{{ URL::asset('js/nicedit/nicEdit.js') }}"></script>
  
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
                <a href="{{ url('/home') }}"><img class="nav_bar_png" src="{{ URL::asset('img/omen.png') }}" alt="Omen Creator"></a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                	<li class="dropdown">
                		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        	Karakters<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                        	<li><a href="{{ url('create_player_character_basic_info') }}">Cre&euml;er Spelerkarakter</a></li>
                            <li><a href="{{ url('/showall_character') }}">Overzicht Karakters</a></li>
                        </ul>
                    </li>
                
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Vaardigheden<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/create_skill') }}">Cre&euml;er Vaardigheid</a></li>
                                <li><a href="{{ url('/create_skillgroup') }}">Cre&euml;er Vaardigheidgroep</a></li>
                                <li><a href="{{ url('/skillshowall') }}">Overzicht Vaardigheden</a></li>
                                <li><a href="{{ url('/skillgroupshowall') }}">Overzicht Vaardigheidgroepen</a></li>
                            </ul>
                    </li>

<!--                     <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Spelersrassen<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/showall_races') }}">Overzicht Spelersrassen</a></li>
                            </ul>
                    </li> -->

                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Uitrusting<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/showall_armor') }}">Pantsers</a></li>
                                <li><a href="{{ url('/showall_shield') }}">Schilden</a></li>
                                <li><a href="{{ url('/showall_weapon') }}">Wapens</a></li>
                                <li><a href="{{ url('/showall_craft_equipment') }}">Ambachtsuitrusting</a></li>
                                <li><a href="{{ url('/showall_generic_equipment') }}">Algemene Uitrusting</a></li>
                            </ul>
                    </li>

                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Rassen<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/showall_race') }}">Overzicht Rassen</a></li>
                            </ul>
                    </li>

                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Klassen<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/showall_class') }}">Overzicht Klassen</a></li>
                            </ul>
                    </li>
                                        
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Bonusregels<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/showall_rule') }}">Overzicht Bonusregels</a></li>
                            </ul>
                    </li>
                    
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                 Gebruikers<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/showall_user') }}">Overzicht Gebruikers</a></li>
                            </ul>
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
