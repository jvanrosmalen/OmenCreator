<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>Cre&euml;er Nieuw Event</h3>
		</div>
	</div>

	<form action="create_larp_event_submit" method="POST">
		<!-- ******************* -->
		<!-- For Laravel CSRF administration -->
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<!-- ******************* -->

		<div class='row well'>
			<div class='col-xs-1'>Eventnaam:</div>
			<div class='col-xs-3'>
				<input id='larp_event_name' name='larp_event_name' type='text' style='width:100%' placeholder='Event naam'>
			</div>
		</div>
		
		<div class='row well'>
            <div class='row'>
                <div class='col-xs-1'></div>
                <div class='col-xs-1'>Begindatum:</div>
                <div class='col-xs-2'>
                    <div class="form-group">
                        <div class="input-group date" id="eventBeginDate">
                            <input type="text" class="form-control" />
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
                            <input type="text" class="form-control" />
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
				<input id='larp_event_description' name='larp_event_description' type='text' style='width:100%' placeholder='Korte beschrijving'>
			</div>
            </div>
		</div>
	</form>

	@include('popups.showErrorMessage')

	<script>
		LarpEvent.init();
	</script>
@stop
</html>