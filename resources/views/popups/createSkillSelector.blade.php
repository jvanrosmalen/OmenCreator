<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="createSkillSelector" class="popup">
		<div class="wrapper">
			<div class="container skillSelector well">
				<h3>Selecteer Vaardigheid</h3>
				
				<div class="row">
				<div class="col-xs-10">
			    <table class="table table-condensed table-hover">
			        <thead>
			            <tr>
			                <th>
			                    Naam
			                </th>
			                <th>
			                	Korte Beschrijving
			                </th>
			                <th>
			                	EP Kosten
			                </th>
			                <th>
			                	Niveau
			                </th>
			            </tr>
			        </thead>
			 
			        <tbody>
			            @foreach ($skills as $skill)
			                <tr>
			                    <td class="col-xs-2">{{ $skill->name }}</td>
			                    <td class="col-xs-3">{{ $skill->descriptionSmall }}</td>
			                    <td class="col-xs-2">{{ $skill->ep_cost }}</td>
			                    <td class="col-xs-2">{{ $skilllevels[$skill->level]->skill_level }}</td>
			                </tr>
			            @endforeach
			        </tbody>
			    </table>
				</div>
			</div>
		</div>
	</div>
	

