<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class="row">
		<div class="col-xs-7">
			<h1>Overzicht Events</h1>
		</div>
					
		<div class="col-xs-5">
			<div>
				<div class="input-group col-md-12">
                   	<input id="eventSearchInput"  type="text" class="search-query form-control" placeholder="Zoeken (zoekt event naam)" onchange="ShowAllLarpEvents.larpEventSearch();"/>
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
		<li class="active"><a id="tab1" data-toggle="tab" href="#coming_larp_events">Komende/Huidige Events</a></li>
		<li><a id="tab2" data-toggle="tab" href="#past_larp_events">Afgelopen Events</a></li>
	</ul>
				
	<div id="larp_events" class="tab-content">
		<div id="coming_larp_events" class="tab-pane fade in active">
			<div class='row'>
				<div class="col-xs-12">
				    <table id="coming_larp_events_table" class="event_table table table-fixedheader table-responsive table-condensed table-hover sortable">
				        <thead>
				            <tr>
				                <th class="col-xs-6">
				                    Naam
				                </th>
				                <th class="col-xs-2">
				                	Begin Datum
				                </th>
				                <th class="col-xs-2">
				                	Eind Datum
				                </th>
				                <th class="col-xs-2">
				                	Actie
				                </th>                                
				            </tr>
				        </thead>
					 
				        <tbody id="coming_omens">
				            @foreach ($coming_events as $event)
				                <tr id="{{$event->id}}">
				                    <td id="{{$event->name}}" class="col-xs-6 eventname">
				                    	{{$event->name}}
				                    </td>
				                    <td class="col-xs-2">
										{{\Carbon\Carbon::parse($event->begin_date)->format('d-m-Y')}}
				                    </td>
				               		<td class="col-xs-2">
									   {{\Carbon\Carbon::parse($event->end_date)->format('d-m-Y')}}
				               		</td>
				                    <td class="col-xs-2">
										<a href="/larpeventsshow/{{ $event->id }}" class="btn btn-success btn-xs show-char-btn" data-toggle="tooltip" title="Bekijk Event">
		   									<span class="glyphicon glyphicon-eye-open"></span>
		   								</a>
										<a href="/larpeventaddplayer/{{ $event->id }}" class="btn btn-warning btn-xs show-char-btn" data-toggle="tooltip" title="Voeg Speler Toe">
		   									<span class="glyphicon glyphicon-user"></span>
		   								</a>
										<a href="/editlarpevent/{{ $event->id }}" class="btn btn-info btn-xs edit-char-btn" data-toggle="tooltip" title="Pas Event Aan" onclick="ShowAllPlayerChar.doUpdateCharacter()">
		   									<span class="glyphicon glyphicon-pencil"></span> 
		   								</a>
									   <a href="/larpeventdeletewarning/{{ $event->id }}" class="btn btn-danger btn-xs show-char-btn" data-toggle="tooltip" title="Voeg Speler Toe">
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
		<div id="past_larp_events" class="tab-pane fade">
			<div class='row'>
				<div class="col-xs-12">
				    <table id="past_larp_events_table" class="event_table table table-fixedheader table-responsive table-condensed table-hover sortable">
                    	<thead>
				            <tr>
				                <th class="col-xs-6">
				                    Naam
				                </th>
				                <th class="col-xs-2">
				                	Begin Datum
				                </th>
				                <th class="col-xs-2">
				                	Eind Datum
				                </th>
				                <th class="col-xs-2">
				                	Actie
				                </th>                                
				            </tr>
				        </thead>
					 
				        <tbody id="past_omens">
                            @foreach ($past_events as $event)
				                <tr id="{{$event->id}}">
				                    <td id="{{$event->name}}" class="col-xs-6 eventname">
				                    	{{$event->name}}
				                    </td>
				                    <td class="col-xs-2">
										{{\Carbon\Carbon::parse($event->begin_date)->format('d-m-Y')}}
				                    </td>
				               		<td class="col-xs-2">
									   {{\Carbon\Carbon::parse($event->end_date)->format('d-m-Y')}}
				               		</td>
				                    <td class="col-xs-2">
										<a href="/larpeventsshow/{{ $event->id }}" class="btn btn-success btn-xs show-char-btn" data-toggle="tooltip" title="Bekijk Event">
		   									<span class="glyphicon glyphicon-eye-open"></span>
		   								</a>
										<a href="/larpeventaddplayer/{{ $event->id }}" class="btn btn-warning btn-xs show-char-btn" data-toggle="tooltip" title="Voeg Speler Toe">
		   									<span class="glyphicon glyphicon-user"></span>
		   								</a>
										<a href="/editlarpevent/{{ $event->id }}" class="btn btn-info btn-xs edit-char-btn" data-toggle="tooltip" title="Pas Event Aan" onclick="ShowAllPlayerChar.doUpdateCharacter()">
		   									<span class="glyphicon glyphicon-pencil"></span> 
		   								</a>
										<a href="/larpeventdeletewarning/{{ $event->id }}" class="btn btn-danger btn-xs show-char-btn" data-toggle="tooltip" title="Voeg Speler Toe">
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
	</div>
@stop
</html>