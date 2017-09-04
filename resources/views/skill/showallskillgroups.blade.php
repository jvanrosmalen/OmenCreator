<!DOCTYPE html>
<html>
	@extends('layouts.app')

<body>
	@section('content')
	
	<div class='container'>
		<div class="row">
			<div class="col-xs-7">
				<h1>Overzicht Vaardigheidgroepen</h1>
			</div>
					
			<div class="col-xs-5">
<!--    				<div id="skillSelectorSearch"> -->
   				<div>
   					<div class="input-group col-md-12">
                    	<input id="skillGroupSearchInput"  type="text" class="search-query form-control" placeholder="Zoek op naam of onderdeel van naam" onchange="Create.skillGroupSearch();"/>
                        <span class="input-group-btn">
                           	<button class="btn btn-danger" type="button">
                               	<span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
            	    </div>
                </div>					
			</div>
		</div>

		<div class="row">
			<div class="col-xs-10">
			    <table id="skill_group_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
			        <thead>
			            <tr>
			                <th class="col-xs-3">
			                    Naam
			                </th>
			                <th class="col-xs-5">
			                	Korte Beschrijving
			                </th>
			                <th class="col-xs-1">
			                	Actie
			                </th>
			            </tr>
			        </thead>
			 
			        <tbody id="skillgroups">
				            @foreach ($skillgroups as $skillgroup)
				                <tr id="{{ $skillgroup->id }}" onclick="ShowAllSkillgroups.showSkillGroupDetails(event);">
				                    <td id="{{$skillgroup->name}}" class="skillgroupname col-xs-3">{{ $skillgroup->name }}</td>
				                    <td class="col-xs-5">{{ $skillgroup->desc_short }}</td>
				                    <td class="col-xs-1">
				                    	<a href="create_skillgroup/{{$skillgroup->id}}" class="btn btn-info btn-xs edit-skillgroup-btn">
          									<span class="glyphicon glyphicon-pencil"></span> 
        								</a>
				                    	<a href="show_delete_skillgroup/{{$skillgroup->id}}" class="btn btn-danger btn-xs remove-skillgroup-btn">
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
	
	@include('popups.showSkillGroupDetails');

	@endsection
</body>

</html>
