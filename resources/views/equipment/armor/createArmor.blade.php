@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class='row'>
			<div class='col-xs-12'>
				@if($armor == null)
					<h3>Cre&euml;er Nieuw Pantser</h3>
				@else
					<h3>Aanpassen Pantser</h3>
				@endif
			</div>
		</div>
	
		@if ($armor == null)
		<form id="{{ ($armor!=null?$armor->id:-1) }}" action="/create_armor_submit" method="POST">
		@else
		<form id="{{ ($armor!=null?$armor->id:-1) }}" action="/create_armor_update/{{ $armor->id }}" method="POST">
		@endif
			<div class='row well'>
				<div class='col-xs-2'>Naam:</div>
				<div class='col-xs-3'>
					<input onfocus= "Armor.hideNameWarning()" onfocusout="Armor.checkName()" id="armor_name" type="text" name="armor_name" style="width: 100%;" value="{{ ($armor!=null?$armor->name:'') }}">
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
				
					<textarea name="armor_desc" class="equipment_desc">{{ ($armor!=null?$armor->description:'') }}</textarea>
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
				        			<input type="text" name="price_normal" style="width: 100%;" value="{{ ($armor!=null?$armor->price_normal:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="price_good" style="width: 100%;" value="{{ ($armor!=null?$armor->price_good:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="price_master" style="width: 100%;" value="{{ ($armor!=null?$armor->price_master:'') }}">
				        		</td>
				        	</tr>
				        </tbody>					
					</table>
					
				</div>
			</div>
	
			<div class="row well">
				<div class="col-xs-2">Pantserpunten</div>
				
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
				        			<input type="text" name="armor_normal" style="width: 100%;" value="{{ ($armor!=null?$armor->armor_normal:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="armor_good" style="width: 100%;" value="{{ ($armor!=null?$armor->armor_good:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="armor_master" style="width: 100%;" value="{{ ($armor!=null?$armor->armor_master:'') }}">
				        		</td>
				        	</tr>
				        </tbody>					
					</table>
				</div>
				
				<div class="col-xs-2">Structuurpunten</div>
				
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
				        			<input type="text" name="structure_normal" style="width: 100%;" value="{{ ($armor!=null?$armor->structure_normal:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="structure_good" style="width: 100%;" value="{{ ($armor!=null?$armor->structure_good:'') }}">
				        		</td>
				        		<td>
				        			<input type="text" name="structure_master" style="width: 100%;" value="{{ ($armor!=null?$armor->structure_master:'') }}">
				        		</td>
				        	</tr>
				        </tbody>					
					</table>
				</div>
			</div>
	
			<div class="row button-row">
				<div class="col-xs-3"></div>
				<div class="col-xs-2">
					<input class="btn btn-default" id="submit_button" type="submit" value="{{ ($armor==null?'Cre&euml;er':'Aanpassen') }}"
						style="width: 120px; font-size: 18px;">
				</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2">
					<a href="/showall_armor" class="btn btn-default" id="cancel_button" type="button"	style="width: 120px; font-size: 18px;">
					Cancel
					</a>
				</div>
			</div>
		
		</form>
	</div>
@endsection