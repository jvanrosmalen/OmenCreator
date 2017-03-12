<!DOCTYPE html>
<html>
	@extends('layouts.app')

<body>
	@section('content')
	
	<div class='container'>
		<div class="row">
		
			<div class="col-xs-7">
				<h1>Overzicht Gebruikers</h1>
			</div>
				
			<div class="col-xs-5">
   				<div>
   					<div class="input-group col-md-12">
                    	<input id="userSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (controleer beide tabs op resultaten)" onchange="User.userSearch();"/>
                        <span class="input-group-btn">
                           	<button class="btn btn-danger" type="button">
                               	<span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
            	    </div>
                </div>					
			</div>
		</div>
					
		<div class="row">							
			<ul class="nav nav-tabs">
				<li class="active"><a id="tab1" data-toggle="tab" href="#users">Gebruikers</a></li>
				<li><a id="tab2" data-toggle="tab" href="#requests">
					@if(count($requests)>0)
<!-- 						<span>Verzoeken<span class='numberCircle'>{{count($requests)}}</span></span> -->
						<b><em>Nieuwe Verzoeken</em></b>
					@else
						Geen Verzoeken
					@endif
				</a></li>
			</ul>

			<div class="tab-content">
				<div id="users" class="tab-pane fade in active">		
		

	
					<div class="row">
						<div class="col-xs-12">
						    <table id="user_table" class="table table-fixedheader table-responsive table-condensed sortable">
						        <thead>
						            <tr>
						                <th class="col-xs-4">
						                    Naam
						                </th>
						                <th class="col-xs-4">
						                	e-Mail
						                </th>
						                <th class="col-xs-1">
						                	Spelleiding
						                </th>
						                <th class="col-xs-1">
						                	Systeem Rep
						                </th>
						                <th class="col-xs-1">
						                	Admin
						                </th>
						                <th class="col-xs-1">
						                	Actie
						                </th>
						            </tr>
						        </thead>
						 
						        <tbody id="users">
							            @forelse ($users as $user)
					                		<form action="/submit_user/{{$user->id}}" method="POST">
											<!-- ******************* -->
											<!-- For Laravel CSRF administration -->
											<input type="hidden" name="_token" value="{!! csrf_token() !!}">
											<!-- ******************* -->
											
											<tr id="{{ $user->id }}">
		
							                    <td id="{{$user->name}}" class="username col-xs-4">{{ $user->name }}</td>
							                    <td class="col-xs-4">{{ $user->email }}</td>
							               		<td class="col-xs-1">
							               			@if($user->is_story_telling)
							               				<input type='checkbox' name='isStoryTelling' value='isStoryTelling' checked='checked'>
							               			@else
							               				<input type='checkbox' name='isStoryTelling' value='isStoryTelling'>
							               			@endif
							               		</td>
							               		<td class="col-xs-1">
							               			@if($user->is_system_rep)
							               				<input type='checkbox' name='isSystemRep' value='isSystemRep' checked='checked'>
							               			@else
							               				<input type='checkbox' name='isSystemRep' value='isSystemRep'>
							               			@endif
							               		</td>
							                    <td class="col-xs-1">
							               			@if($user->is_admin)
							               				<input type='checkbox' name='isAdmin' value='isAdmin' checked='checked'>
							               			@else
							               				<input type='checkbox' name='isAdmin' value='isAdmin'>
							               			@endif
												</td>
							                    <td class="col-xs-1">
							                    	<button type='submit' class="btn btn-default btn-xs save-user-btn-{{$user->id}}">
			          									<span class="glyphicon glyphicon-floppy-disk"></span> 
			        								</button>
							                    	<a href="/show_delete_user/{{$user->id}}" class="btn btn-danger btn-xs remove-user-btn">
			          									<span class="glyphicon glyphicon-minus"></span> 
			        								</a>
			        							</td>
							                </tr>
		        							</form>
							            @empty
							            	<tr>
							                    <td class="col-xs-12">Geen gebruikers</td>
							                </tr>
							            @endforelse
						        </tbody>
						    </table>
					    </div>
				    </div>
	   			 </div>
	   			 
				<div id="requests" class="tab-pane fade">
					<div class="row">
						<div class="col-xs-12">
						    <table id="request_table" class="table table-fixedheader table-responsive table-condensed sortable">
						        <thead>
						            <tr>
						                <th class="col-xs-4">
						                    Naam
						                </th>
						                <th class="col-xs-4">
						                	e-Mail
						                </th>
						                <th class="col-xs-1">
						                	Spelleiding
						                </th>
						                <th class="col-xs-1">
						                	Systeem Rep
						                </th>
						                <th class="col-xs-1">
						                	Admin
						                </th>
						                <th class="col-xs-1">
						                	Actie
						                </th>
						            </tr>
						        </thead>
						 
						        <tbody id="users">
							            @forelse ($requests as $request)
						                	<form action="/submit_user/{{$request->id}}" method="POST">
											<!-- ******************* -->
											<!-- For Laravel CSRF administration -->
											<input type="hidden" name="_token" value="{!! csrf_token() !!}">
											<!-- ******************* -->
							                <tr id="{{ $request->id }}">
							                    <td id="{{$request->name}}" class="requestname col-xs-4">{{ $request->name }}</td>
							                    <td class="col-xs-4">{{ $request->email }}</td>
							               		<td class="col-xs-1">
						               				<input type='checkbox' name='isStoryTelling' value='isStoryTelling'>
							               		</td>
							               		<td class="col-xs-1">
						               				<input type='checkbox' name='isSystemRep' value='isSystemRep'>
							               		</td>
							                    <td class="col-xs-1">
						               				<input type='checkbox' name='isAdmin' value='isAdmin'>
												</td>
							                    <td class="col-xs-1">
							                    	<button type='submit' class="btn btn-info btn-xs submit-user-btn">
			          									<span class="glyphicon glyphicon-thumbs-up"></span> 
			        								</button>
			        								
							                    	<a href="/show_delete_user/{{$request->id}}" class="btn btn-danger btn-xs remove-user-btn">
			          									<span class="glyphicon glyphicon-thumbs-down"></span> 
			        								</a>
			        							</td>
							                </tr>
		        							</form>
							            @empty
							            	<tr>
							                    <td class="col-xs-12">Geen Verzoeken</td>
							                </tr>
							            @endforelse
						        </tbody>
						    </table>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>

	@endsection
</body>

</html>
