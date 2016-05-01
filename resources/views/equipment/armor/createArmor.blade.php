@extends('layouts.app') @section('content')
<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>Cre&euml;er Nieuw Pantser</h3>
		</div>
	</div>

	<form action="/create_armor_submit" method="POST">
		<div class='row well'>
			<div class='col-xs-2'>Naam:</div>
			<div class='col-xs-3'>
				<input type="text" name="armor_name" style="width: 100%;">
			</div>
		</div>

		<div class="row well">
			<div class="col-xs-2">Beschrijving:</div>
			<div class="col-xs-7">
				<script type="text/javascript" src="js/nicedit/nicEdit.js"></script>
				<script type="text/javascript">
					bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
				</script>
			
				<textarea name="armor_desc" class="armor_desc"></textarea>
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
			        			<input type="text" name="price_normal" style="width: 100%;">
			        		</td>
			        		<td>
			        			<input type="text" name="price_good" style="width: 100%;">
			        		</td>
			        		<td>
			        			<input type="text" name="price_master" style="width: 100%;">
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
			        			<input type="text" name="armor_normal" style="width: 100%;">
			        		</td>
			        		<td>
			        			<input type="text" name="armor_good" style="width: 100%;">
			        		</td>
			        		<td>
			        			<input type="text" name="armor_master" style="width: 100%;">
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
			        			<input type="text" name="structure_normal" style="width: 100%;">
			        		</td>
			        		<td>
			        			<input type="text" name="structure_good" style="width: 100%;">
			        		</td>
			        		<td>
			        			<input type="text" name="structure_master" style="width: 100%;">
			        		</td>
			        	</tr>
			        </tbody>					
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-2"></div>
			<div class="col-xs-1">
				<input type="submit" value="Cre&euml;er"
					style="width: 80px; font-size: 18px;">
			</div>
		</div>
	
	</form>
</div>
@endsection