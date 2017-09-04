<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			@if($class == null)
			<h3>Cre&euml;er Nieuw Klasse</h3>
			@else
			<h3>Aanpassen Klasse</h3>
			@endif
		</div>
	</div>

	@if ($class == null)
		<form id="{{ ($class!=null?$class->id:-1) }}" action="create_class_submit" method="POST">
	@else
		<form id="{{ ($class!=null?$class->id:-1) }}" action="create_class_update/{{ $class->id }}" method="POST">
	@endif

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->

			<ul class="nav nav-tabs">
				<li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis Info</a></li>
			</ul>

			<div class="tab-content">
				<div id="base_info" class="tab-pane fade in active">
					<h3>Basis Informatie</h3>
					<div class='row well'>
						<div class='col-xs-2'>Naam:</div>
						<div class='col-xs-2'>
							<input onfocus="PlayerClass.hideNameWarning()"
								onfocusout="PlayerClass.checkName()" id="class_name" type="text"
								name="class_name" style="width: 100%;"
								value="{{ ($class!=null?$class->class_name:'') }}">
						</div>
						<div class='col-xs-2'>
							@if( $class!=null && $class->is_player_class)
								<input type='checkbox' name='isPlayerClass' value='isPlayerClass' checked="checked"><span class="checkbox_text">Spelerklasse</span>
							@else
								<input type='checkbox' name='isPlayerClass' value='isPlayerClass'><span class="checkbox_text">Spelerklasse</span>
							@endif
						</div>
						<div class='col-xs-3'>
							Welvaart:
							<select name='class_wealth'>
								@foreach ( $wealth_types as $wealth_type )
									@if($class != null)
										@if( $wealth_type->id == $class->wealth_type_id)
											<option value='{{$wealth_type->id}}' selected>{{$wealth_type->wealth_type}}</option>
										@else
											<option value='{{$wealth_type->id}}'>{{$wealth_type->wealth_type}}</option>
										@endif
									@else
										<option value='{{$wealth_type->id}}'>{{$wealth_type->wealth_type}}</option>
									@endif
								@endforeach
							</select> 
						</div>
						<div class='col-xs-3 name_warning hidden'>Deze naam bestaat al.
							Kies een andere.</div>
					</div>
					
					<div class="row well">
						<div class="col-xs-2">Beschrijving:</div>
						<div class="col-xs-7">
							<script type="text/javascript"
								src="{{ URL::asset('js/nicedit/nicEdit.js') }}"></script>
							<script type="text/javascript">
								bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
							</script>

							<textarea name="class_desc" class="class_desc">{{ ($class!=null?$class->description:'') }}</textarea>
						</div>
					</div>

					@include('layouts.tab_buttons', array('tab'=>'tab1',
					'previous'=>null, 'save'=>true, 'next'=>null))
				</div>
		</form>
	</div>

	<script>
		CreateClassTabControl.addTabButtonListeners();
	</script>
@stop
</html>