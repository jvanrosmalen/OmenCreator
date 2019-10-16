<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class="row">
		<div class="col-xs-7">
			<h1>Overzicht Spelerkarakters</h1>
		</div>
					
		<div class="col-xs-5">
			<div>
				<div class="input-group col-md-12">
                   	<input id="playerSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (zoekt in karakternaam en spelernaam)" onchange="ShowAllPlayerChar.playerSearch();"/>
                    <span class="input-group-btn">
                       	<button class="btn btn-danger" type="button">
                           	<span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </span>
           	    </div>
            </div>					
		</div>
	</div>

	<ul class="nav nav-tabs">
		<li class="active"><a id="tab1" data-toggle="tab" href="#all_chars">Alle</a></li>
		<li><a id="tab2" data-toggle="tab" href="#active_chars">Actief</a></li>
		<li><a id="tab3" data-toggle="tab" href="#inactive_chars">Niet-actief</a></li>
		<li><a id="tab4" data-toggle="tab" href="#dead_chars">Gestorven</a></li>
	</ul>
				
	<div id="all_characters" class="tab-content">
		<div id="all_chars" class="tab-pane fade in active">
			<div class='row'>
				<div class="col-xs-12">
				    <table id="active_char_table" class="char_table table table-fixedheader table-responsive table-condensed table-hover sortable">
				        <thead>
				            <tr>
				                <th class="col-xs-3">
				                    Karakternaam
				                </th>
				                <th class="col-xs-3">
				                	Spelernaam
				                </th>
				                <th class="col-xs-2">
				                	Klasse
				                </th>
				                <th class="col-xs-1">
				                	Ras
				                </th>
				                <th class="col-xs-1">
				                	Niveau
				                </th>
				                <th class="col-xs-2">
				                	Actie
				                </th>
				            </tr>
				        </thead>
					 
				        <tbody id="chars">
				            @foreach ($all_chars as $character)
				                <tr id="{{$character->id}}">
				                    <td id="{{$character->name}}" class="col-xs-3 charname">
				                    	{{$character->name}}
				                    </td>
				                    <td id="{{$character->char_user->name}}" class="col-xs-3 playername">
				                    	{{$character->char_user->name}}
				                    </td>
				               		<td class="col-xs-2">
				               			{{$character->getPlayerClassesListString()}}
				               		</td>
				               		<td class="col-xs-1">
										{{$character->char_race->race_name}}				               		
				               		</td>
				               		<td class="col-xs-1">
				               			{{$character->char_level}}
				               		</td>
				                    <td class="col-xs-2">
				                    	<a href="show_character/{{$character->id}}" class="btn btn-success btn-xs show-char-btn" data-toggle="tooltip" title="Bekijk Karakter">
		   									<span class="glyphicon glyphicon-eye-open"></span> 
		   								</a>
				                    	<a href="show_character_ep/{{$character->id}}" class="btn btn-success btn-xs show-add-ep-btn" data-toggle="tooltip" title="Bekijk EP">
		   									<span class="glyphicon glyphicon-arrow-up"></span> 
										</a>
				                    	<a href="manage_trauma/{{$character->id}}/" class="btn btn-success btn-xs show-manage-trauma-btn" data-toggle="tooltip" title="Bekijk Trauma">
		   									<span class="glyphicon glyphicon-exclamation-sign"></span> 
										</a>
				                    	<a href="show_edit_character/{{$character->id}}" class="btn btn-info btn-xs edit-char-btn" data-toggle="tooltip" title="Pas Karakter Aan" onclick="ShowAllPlayerChar.doUpdateCharacter()">
		   									<span class="glyphicon glyphicon-pencil"></span> 
		   								</a>
				                    	<a href="show_kill_character/{{$character->id}}" class="btn btn-danger btn-xs kill-char-btn" data-toggle="tooltip" title="Dood Karakter">
		   									<span class="glyphicon glyphicon-thumbs-down"></span> 
		   								</a>
				                    	<a href="show_delete_character/{{$character->id}}" class="btn btn-danger btn-xs remove-char-btn" data-toggle="tooltip" title="Verwijder Karakter">
		   									<span class="glyphicon glyphicon-minus"></span> 
		   								</a>
		   							</td>
				                </tr>
				            @endforeach
				        </tbody>
				    </table>
			    </div>
			</div>
		</div>
		<div id="active_chars" class="tab-pane fade">
			<div class='row'>
				<div class="col-xs-12">
				    <table id="active_char_table" class="char_table table table-fixedheader table-responsive table-condensed table-hover sortable">
				        <thead>
				            <tr>
				                <th class="col-xs-3">
				                    Karakternaam
				                </th>
				                <th class="col-xs-3">
				                	Spelernaam
				                </th>
				                <th class="col-xs-2">
				                	Klasse
				                </th>
				                <th class="col-xs-1">
				                	Ras
				                </th>
				                <th class="col-xs-1">
				                	Niveau
				                </th>
				                <th class="col-xs-2">
				                	Actie
				                </th>
				            </tr>
				        </thead>
					 
				        <tbody id="chars">
				            @foreach ($active_chars as $character)
				                <tr id="{{$character->id}}">
				                    <td id="{{$character->name}}" class="col-xs-3 charname">
				                    	{{$character->name}}
				                    </td>
				                    <td id="{{$character->char_user->name}}" class="col-xs-3 playername">
				                    	{{$character->char_user->name}}
				                    </td>
				               		<td class="col-xs-2">
				               			{{$character->getPlayerClassesListString()}}
				               		</td>
				               		<td class="col-xs-1">
										{{$character->char_race->race_name}}				               		
				               		</td>
				               		<td class="col-xs-1">
				               			{{$character->char_level}}
				               		</td>
				                    <td class="col-xs-2">
				                    	<a href="show_character/{{$character->id}}" class="btn btn-success btn-xs show-char-btn" data-toggle="tooltip" title="Bekijk Karakter">
		   									<span class="glyphicon glyphicon-eye-open"></span> 
		   								</a>
				                    	<a href="show_character_ep/{{$character->id}}" class="btn btn-success btn-xs show-add-ep-btn" data-toggle="tooltip" title="Bekijk EP">
		   									<span class="glyphicon glyphicon-arrow-up"></span> 
		   								</a>
				                    	<a href="show_edit_character/{{$character->id}}" class="btn btn-info btn-xs edit-char-btn" data-toggle="tooltip" title="Pas Karakter Aan" onclick="ShowAllPlayerChar.doUpdateCharacter()">
		   									<span class="glyphicon glyphicon-pencil"></span> 
		   								</a>
				                    	<a href="show_kill_character/{{$character->id}}" class="btn btn-danger btn-xs kill-char-btn" data-toggle="tooltip" title="Dood Karakter">
		   									<span class="glyphicon glyphicon-thumbs-down"></span> 
		   								</a>
				                    	<a href="show_delete_character/{{$character->id}}" class="btn btn-danger btn-xs remove-char-btn" data-toggle="tooltip" title="Verwijder Karakter">
		   									<span class="glyphicon glyphicon-minus"></span> 
		   								</a>
		   							</td>
				                </tr>
				            @endforeach
				        </tbody>
				    </table>
			    </div>
			</div>
		</div>
		<div id="inactive_chars" class="tab-pane fade">
			<div class='row'>
				<div class="col-xs-12">
				    <table id="inactive_char_table" class="char_table table table-fixedheader table-responsive table-condensed table-hover sortable">
				        <thead>
				            <tr>
				                <th class="col-xs-3">
				                    Karakternaam
				                </th>
				                <th class="col-xs-3">
				                	Spelernaam
				                </th>
				                <th class="col-xs-2">
				                	Klasse
				                </th>
				                <th class="col-xs-1">
				                	Ras
				                </th>
				                <th class="col-xs-1">
				                	Niveau
				                </th>
				                <th class="col-xs-2">
				                	Actie
				                </th>
				            </tr>
				        </thead>
					 
				        <tbody id="chars">
				            @foreach ($inactive_chars as $character)
				                <tr id="{{$character->id}}">
				                    <td id="{{$character->name}}" class="col-xs-3 charname">
				                    	{{$character->name}}
				                    </td>
				                    <td id="{{$character->char_user->name}}" class="col-xs-3 playername">
				                    	{{$character->char_user->name}}
				                    </td>
				               		<td class="col-xs-2">
				               			{{$character->getPlayerClassesListString()}}
				               		</td>
				               		<td class="col-xs-1">
										{{$character->char_race->race_name}}				               		
				               		</td>
				               		<td class="col-xs-1">
				               			{{$character->char_level}}
				               		</td>
				                    <td class="col-xs-2">
				                    	<a href="show_character/{{$character->id}}" class="btn btn-success btn-xs show-char-btn" data-toggle="tooltip" title="Bekijk Karakter">
		   									<span class="glyphicon glyphicon-eye-open"></span> 
		   								</a>
				                    	<a href="show_edit_character/{{$character->id}}" class="btn btn-info btn-xs edit-char-btn" data-toggle="tooltip" title="Pas Karakter Aan">
		   									<span class="glyphicon glyphicon-pencil"></span> 
		   								</a>
				                    	<a href="show_kill_character/{{$character->id}}" class="btn btn-danger btn-xs kill-char-btn" data-toggle="tooltip" title="Dood Karakter">
		   									<span class="glyphicon glyphicon-thumbs-down"></span> 
		   								</a>
				                    	<a href="show_delete_character/{{$character->id}}" class="btn btn-danger btn-xs remove-char-btn" data-toggle="tooltip" title="Verwijder Karakter">
		   									<span class="glyphicon glyphicon-minus"></span> 
		   								</a>
		   							</td>
				                </tr>
				            @endforeach
				        </tbody>
				    </table>
			    </div>
			</div>
		</div>
		<div id="dead_chars" class="tab-pane fade">
			<div class='row'>
				<div class="col-xs-12">
				    <table id="dead_char_table" class="char_table table table-fixedheader table-responsive table-condensed table-hover sortable">
				        <thead>
				            <tr>
				                <th class="col-xs-3">
				                    Karakternaam
				                </th>
				                <th class="col-xs-3">
				                	Spelernaam
				                </th>
				                <th class="col-xs-2">
				                	Klasse
				                </th>
				                <th class="col-xs-1">
				                	Ras
				                </th>
				                <th class="col-xs-1">
				                	Niveau
				                </th>
				                <th class="col-xs-2">
				                	Actie
				                </th>
				            </tr>
				        </thead>
					 
				        <tbody id="chars">
				            @foreach ($dead_chars as $character)
				                <tr id="{{$character->id}}">
				                    <td id="{{$character->name}}" class="col-xs-3 charname">
				                    	{{$character->name}}
				                    </td>
				                    <td id="{{$character->char_user->name}}" class="col-xs-3 playername">
				                    	{{$character->char_user->name}}
				                    </td>
				               		<td class="col-xs-2">
				               			{{$character->getPlayerClassesListString()}}
				               		</td>
				               		<td class="col-xs-1">
										{{$character->char_race->race_name}}				               		
				               		</td>
				               		<td class="col-xs-1">
				               			{{$character->char_level}}
				               		</td>
				                    <td class="col-xs-2">
										<a href="show_character/{{$character->id}}" class="btn btn-success btn-xs show-char-btn" data-toggle="tooltip" title="Bekijk Karakter">
		   									<span class="glyphicon glyphicon-eye-open"></span> 
		   								</a>
				                    	@if($user->is_admin)
				                    	<a href="show_raise_character/{{$character->id}}" class="btn btn-danger btn-xs raise-char-btn" data-toggle="tooltip" title="Herrijs Karakter">
		   									<span class="glyphicon glyphicon-certificate"></span> 
		   								</a>
		   								@else
		   								<em>Enkel admin</em>
		   								@endif
		   							</td>
				                </tr>
				            @endforeach
				        </tbody>
				    </table>
			    </div>
			</div>
		</div>
	</div>

	@include('popups.showLoaderMessage')

@stop
</html>