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
<!--    				<div id="playerSelectorSearch"> -->
   				<div>
   					<div class="input-group col-md-12">
                    	<input id="playerSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken" onchange="ShowAllPlayerChar.playerSearch();"/>
                        <span class="input-group-btn">
                           	<button class="btn btn-danger" type="button">
                               	<span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
            	    </div>
                </div>					
			</div>
		</div>
		
	<div class='row'>
				<div class="col-xs-12">
			    <table id="char_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
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
				            @foreach ($characters as $character)
				                <tr id="{{$character->id}}">
				                    <td id="{{$character->name}}" class="charname col-xs-3">{{$character->name}}</td>
				                    <td class="col-xs-3">{{$character->char_user->name}}</td>
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
				                    	<a href="/show_character/{{$character->id}}" class="btn btn-success btn-xs show-char-btn">
          									<span class="glyphicon glyphicon-eye-open"></span> 
        								</a>
				                    	<a href="/create_skill/test" class="btn btn-info btn-xs edit-char-btn">
          									<span class="glyphicon glyphicon-pencil"></span> 
        								</a>
				                    	<a href="/show_delete_skill/test" class="btn btn-danger btn-xs kill-char-btn">
          									<span class="glyphicon glyphicon-thumbs-down"></span> 
        								</a>
				                    	<a href="/show_delete_skill/test" class="btn btn-danger btn-xs remove-char-btn">
          									<span class="glyphicon glyphicon-minus"></span> 
        								</a>
        							</td>
				                </tr>
				            @endforeach
			        </tbody>
			    </table>
		    </div>
	</div>
@stop
</html>