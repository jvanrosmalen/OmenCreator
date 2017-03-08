<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="createSkillSelector" class="popup">
		<div class="wrapper">
			<div class="container skillSelector well">
				<div class="row">
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "Create.closeSkillSelector();">x</button>
				</div>
			
				<div class="row">
					<div class="col-xs-7">
						<h3>Selecteer &eacute;&eacute;n of meer vaardigheden</h3>
					</div>
					
					<div class="col-xs-5">
           				<div id="skillSelectorSearch">
                            <div class="input-group col-md-12">
                                <input id="skillSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (Geselecteerde items blijven getoond)" onchange="Create.skillSearch();"/>
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
					    <table id="skill_select_table" class="table table-condensed table-fixedheader table-hover">
					        <thead>
					            <tr>
					                <th class="col-xs-5">
					                    Naam
					                </th>
					                <th class="col-xs-4">
					                	Klasse
					                </th>
					                <th class="col-xs-2">
					                	Niveau
					                </th>
					                <th class="col-xs-1 skill_ep_cost">
					                	EP
					                </th>
					            </tr>
					        </thead>
					 
					        <tbody id="skills">
					            @foreach ($skills as $skill)
					                <tr id="{{ $skill->id }}" onclick="Create.selectSkill(event);">
					                    <td id="{{$skill->name}}" class="skillname col-xs-5">
					                    	{{ $skill->name }}
					                    </td>
					                    <td class="col-xs-4">
											@foreach ($skill->player_classes as $player_class)
				               					{{ $player_class }}
				               				@endforeach
				               			</td>
					           			<td class="col-xs-2">{{ $skill->skill_level }}</td>
					                    <td class="col-xs-1 skill_ep_cost">{{ $skill->ep_cost }}</td>
					                </tr>
					            @endforeach
					        </tbody>
					    </table>
					</div>
					
					<div class="col-xs-2 well">
				    	<form id="filterSkillsForm" content="{{ csrf_token() }}">
				    		@foreach($skilllevels as $skilllevel)
								<input type="checkbox" class="level_filter" value={{$skilllevel->id}} checked> {{$skilllevel->skill_level}}<br>
		  					@endforeach
		  					<br>
				    		@foreach($playerclasses as $playerclass)
								<input type="checkbox" class="class_filter" value={{$playerclass->id}} checked> {{$playerclass->class_name}}<br>
		  					@endforeach
						</form>
						<br>
						<button id="filterSkillsBtn" type="button" class="btn btn-success btn-large btn-block" onclick="Create.filterPrereqSkills(event);">Filter</button>
						
			    	</div>
			    </div>
			    
				<div class="row">
					<div>
						<button id="" type="button" class="btn btn-success btn-lg btn-block submitSkillSelected" onclick="{{$submitMethod}}">Selecteer Vaardigheid</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	

