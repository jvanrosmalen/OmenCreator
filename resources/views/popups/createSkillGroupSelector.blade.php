<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="createSkillGroupSelector" class="popup">
		<div class="wrapper">
			<div class="container skillGroupSelector well">
				<div class="row">
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "Create.closeSkillGroupSelector();">x</button>
				</div>
			
				<div class="row">
					<div class="col-xs-7">
						<h3>Selecteer &eacute;&eacute;n of meer vaardigheidgroepen</h3>
					</div>
					
					<div class="col-xs-5">
           				<div id="skillGroupSelectorSearch">
                            <div class="input-group col-md-12">
                                <input id="skillGroupSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (Geselecteerde items blijven getoond)" onchange="Create.skillGroupSearch();"/>
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
					<div class="col-xs-1"></div>
					<div class="col-xs-10">
					    <table id="skillgroup_select_table" class="table table-condensed table-fixedheader table-hover">
					        <thead>
					            <tr>
					                <th class="col-xs-5">
					                    Naam
					                </th>
					                <th class="col-xs-7">
					                	Korte beschrijving
					                </th>
					            </tr>
					        </thead>
					 
					        <tbody id="skillgroups">
					            @foreach ($skill_groups as $skillgroup)
					                <tr id="{{ $skillgroup->id }}" onclick="Create.selectSkillGroup(event);">
					                    <td id="{{$skillgroup->name}}" class="skillgroupname col-xs-5">
					                    	{{ $skillgroup->name }}
					                    </td>
					                    <td class="col-xs-7">
					                    	{{ $skillgroup->desc_short }}
				               			</td>
					                </tr>
					            @endforeach
					        </tbody>
					    </table>
					</div>
			    </div>
			    
				<div class="row">
					<div>
						<button id="btnSkillGroupSelector" type="button" class="btn btn-success btn-lg btn-block submitSkillGroupSelected" onclick="{{$submitMethod}}">Selecteer Vaardigheidgroep</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	

