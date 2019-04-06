<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="selectParticipant" class="popup">
		<div class="wrapper">
			<div class="container selectParticipant well">
				<div class="row">
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "ParticipantSelector.closeParticipantSelector(event);">x</button>
				</div>
			
				<div class="row">
					<div class="col-xs-7">
						<h3>Selecteer een Speler</h3>
					</div>
					
					<div class="col-xs-5">
           				<div id="participantSelectorSearch">
                            <div class="input-group col-md-12">
                                <input id="participantSelectorSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (onderdeel van naam of email)" onchange="ParticipantSelector.searchParticipant();"/>
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
					    <table id="participant_select_table" class="table table-condensed table-fixedheader table-hover">
					        <thead>
					            <tr>
					                <th class="col-xs-6">
					                    Naam
					                </th>
					                <th class="col-xs-6">
					                	Karakter
					                </th>
					            </tr>
					        </thead>
					 
					        <tbody id="participants">
					            @foreach ($characters as $character)
					                <tr id="{{ $character->id }}" onclick="ParticipantSelector.selectParticipant(event);">
					                    <td id="{{$character->char_user->name}}" class="col-xs-6">
					                    	{{ $character->char_user->name }}
					                    </td>
					                    <td id="{{$character->name}}" class="col-xs-6">
					                    	{{ $character->name }}
				               			</td>
					                </tr>
					            @endforeach
					        </tbody>
					    </table>
					</div>
			    </div>
			    
				<div class="row">
					<div>
						<div class='col-xs-1'></div>
						<div class='col-xs-10'>
							<button id="btnParticipantSelector" type="button" class="btn btn-success btn-lg btn-block submitParticipantSelected" onclick="{{$submitMethod}}">Selecteer Speler</button>
						</div>
						<div class='col-xs-1'></div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	

