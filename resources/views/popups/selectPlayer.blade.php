<!DOCTYPE html>
<!-- Partial view. No HTML tags -->
	<div id="selectPlayer" class="popup">
		<div class="wrapper">
			<div class="container selectPlayer well">
				<div class="row">
					<button type="button" class="btn btn-border btn-danger close-button" name="close" onclick = "PlayerSelector.closePlayerSelector(event);">x</button>
				</div>
			
				<div class="row">
					<div class="col-xs-7">
						<h3>Selecteer een Speler</h3>
					</div>
					
					<div class="col-xs-5">
           				<div id="playerSelectorSearch">
                            <div class="input-group col-md-12">
                                <input id="playerSelectorSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (onderdeel van naam of email)" onchange="PlayerSelector.searchPlayer();"/>
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
					    <table id="player_select_table" class="table table-condensed table-fixedheader table-hover">
					        <thead>
					            <tr>
					                <th class="col-xs-6">
					                    Naam
					                </th>
					                <th class="col-xs-6">
					                	E-mail
					                </th>
					            </tr>
					        </thead>
					 
					        <tbody id="users">
					            @foreach ($users as $user)
					                <tr id="{{ $user->id }}" onclick="PlayerSelector.selectPlayer(event);">
					                    <td id="{{$user->name}}" class="username col-xs-6">
					                    	{{ $user->name }}
					                    </td>
					                    <td id="{{$user->email}}" class="user_email col-xs-6">
					                    	{{ $user->email }}
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
							<button id="btnPlayerSelector" type="button" class="btn btn-success btn-lg btn-block submitPlayerSelected" onclick="{{$submitMethod}}">Selecteer Speler</button>
						</div>
						<div class='col-xs-1'></div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	

