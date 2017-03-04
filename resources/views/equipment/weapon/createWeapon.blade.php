@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class='row'>
			<div class='col-xs-12'>
				@if($weapon == null)
					<h3>Cre&euml;er Nieuw Wapen</h3>
				@else
					<h3>Aanpassen Wapen</h3>
				@endif
			</div>
		</div>
	
		@if ($weapon == null)
		<form id="{{ ($weapon!=null?$weapon->id:-1) }}" action="/create_weapon_submit" method="POST">
		@else
		<form id="{{ ($weapon!=null?$weapon->id:-1) }}" action="/create_weapon_update/{{ $weapon->id }}" method="POST">
		@endif

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<div class='row well'>
				<div class='col-xs-2'>Naam:</div>
				<div class='col-xs-3'>
					<input onfocus= "Weapon.hideNameWarning()" onfocusout="Weapon.checkName()" id="weapon_name" type="text" name="weapon_name" style="width: 100%;" value="{{ ($weapon!=null?$weapon->name:'') }}">
				</div>
				<div class='col-xs-4 name_warning hidden'>Deze naam bestaat al. Kies een andere.</div>
			</div>
	
			<div class="row well">
				<div class="col-xs-2">Beschrijving:</div>
				<div class="col-xs-7">
					<script type="text/javascript" src="{{ URL::asset('js/nicedit/nicEdit.js') }}"></script>
					<script type="text/javascript">
						bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
					</script>
				
					<textarea name="weapon_desc" class="equipment_desc">{{ ($weapon!=null?$weapon->description:'') }}</textarea>
				</div>
			</div>
	
			<div class="row well">
				<div class="col-xs-2">Prijs (in koperstukken)</div>
				<div class="col-xs-4">
					<table class="table borderless">
				        <thead>
				            <tr>
				                <th>
				                    Normaal
				                </th>
				                <th>
				                	Goed
				                </th>
				                <th>
				                	Meesterlijk
				                </th>
				            </tr>
				        </thead>
				        
				        <tbody>
				        	<tr>
				        		<td>
				        			<input type="text" name="price_normal" style="width: 100%;" value="{{ ($weapon!=null?$weapon->price_normal:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="price_good" style="width: 100%;" value="{{ ($weapon!=null?$weapon->price_good:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="price_master" style="width: 100%;" value="{{ ($weapon!=null?$weapon->price_master:'') }}">
				        		</td>
				        	</tr>
				        </tbody>					
					</table>
					
				</div>
			</div>
	
			<div class="row button-row">
				<div class="col-xs-3"></div>
				<div class="col-xs-2">
					<input class="btn btn-default" id="submit_button" type="submit" value="{{ ($weapon==null?'Cre&euml;er':'Aanpassen') }}"
						style="width: 120px; font-size: 18px;">
				</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2">
					<a href="/showall_weapon" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Cancel
					</a>
				</div>
			</div>
		
		</form>
	</div>
@endsection