<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
            @if (isset($event))
                <!-- It is an update. Not a create -->
                <h3>Aanpassen Event</h3>
            @else
                <!-- It is a new create -->
			    <h3>Cre&euml;er Nieuw Event</h3>
            @endif
		</div>
	</div>

	<form action="/create_larp_event_submit" method="POST">
		<!-- ******************* -->
		<!-- For Laravel CSRF administration -->
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
        @if (isset($event))
            <!-- It is an update. Not a create -->
            <input type="hidden" name="larp_event_id" value="{{$event->id}}">    
        @endif

		<!-- ******************* -->

		<div class='row well'>
			<div class='col-xs-1'>Eventnaam:</div>
			<div class='col-xs-3'>
                @if (isset($event))
                    <!-- It is an update. Not a create -->
		    		<input id='larp_event_name' name='larp_event_name' type='text' style='width:100%' value='{{$event->name}}'>
                @else
                    <!-- It is a new create -->
		    		<input id='larp_event_name' name='larp_event_name' type='text' style='width:100%' placeholder='Event naam'>
                @endif
			</div>
		</div>
		
		<div class='row well'>
            <div class='row'>
                <div class='col-xs-1'></div>
                <div class='col-xs-1'>Begindatum:</div>
                <div class='col-xs-2'>
                    <div class="form-group">
                        <div class="input-group date" id="eventBeginDate">
                            @if (isset($event))
                                <!-- It is an update. Not a create -->
		    	            	<input type="text" name='larp_event_begin_date' class="form-control" value="{{\Carbon\Carbon::parse($event->begin_date)->format('d-m-Y')}}"/>
                            @else
                                <!-- It is a new create -->
                                <input type="text" name='larp_event_begin_date' class="form-control" />
                            @endif
                            <span class="input-group-addon">
                                <span class="glyphicon-calendar glyphicon">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class='col-xs-1'></div>
                <div class='col-xs-1'>Einddatum:</div>
                <div class='col-xs-2'>
                    <div class="form-group">
                        <div class="input-group date" id="eventEndDate">
                            @if (isset($event))
                                <!-- It is an update. Not a create -->
		    	            	<input type="text" name='larp_event_end_date' class="form-control" value="{{\Carbon\Carbon::parse($event->end_date)->format('d-m-Y')}}"/>
                            @else
                                <!-- It is a new create -->
                                <input type="text" name='larp_event_end_date' class="form-control" />
                            @endif
                            <span class="input-group-addon">
                                <span class="glyphicon-calendar glyphicon">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class='col-xs-1'></div>
            </div>

            <div class='row'>
			<div class='col-xs-1'></div>
			<div class='col-xs-1'>Beschrijving:</div>
			<div class='col-xs-9'>
                @if (isset($event))
                    <!-- It is an update. Not a create -->
                    <input id='larp_event_description' name='larp_event_description' type='text' style='width:100%' value="{{$event->description}}">
                @else
                    <!-- It is a new create -->
                    <input id='larp_event_description' name='larp_event_description' type='text' style='width:100%' placeholder='Korte beschrijving'>
                @endif            
				
			</div>
            </div>
		</div>

        <div class="row">
            <div class='col-xs-5'></div>
			<div class='col-xs-2'>
			    <input type="submit" class='btn btn-default' style='width:100%' value='opslaan'>
            </div>
            <div class='col-xs-5'></div>
        </div>
	</form>

	@include('popups.showErrorMessage')

	<script>
		LarpEvent.initialize();
	</script>
@stop
</html>