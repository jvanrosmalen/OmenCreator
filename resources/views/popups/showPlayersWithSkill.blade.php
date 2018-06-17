<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="showPlayersWithSkill" class="popup2">
		<div class="wrapper">
			<div class="container playersWithSkill well">
				<div class="row">
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "ShowAll.closePlayersWithSkill();">x</button>
				</div>

				<div class="row">
                    <div id="playersWithSkillTitle" class="col-xs-6">
                        Spelers met vaardigheid <span id="skill_name"></span>
                    </div>
				</div>

				<hr>
                
                <div class="row">
                    <div class="col-xs-12">
                        <table id="playerWithSkill_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
                            <thead>
                                <tr>
                                    <th class="col-xs-3">
                                        Karakternaam
                                    </th>
                                    <th class="col-xs-3">
                                        Deelnemernaam
                                    </th>
                                    <th class="col-xs-3">
                                        Klasse
                                    </th>
                                    <th class="col-xs-2">
                                        Ras
                                    </th>
                                    <th class="col-xs-1">
                                        Actie
                                    </th>
                                </tr>
                            </thead>
                    
                            <tbody id="playerWithSkill_data">
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</div>
	

