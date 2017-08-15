@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk</h3>
			</div>
		</div>
		
		<div class="row well">
			<div class="col-xs-4 col-xs-offset-1">
			Kies hieronder de Levensvonk voor {{$char->name}}.
			</div>
			<div id="no_spark_selected_warning" class="col-xs-4 warning_not_entered hidden">
			Selecteer een levensvonk voordat je verder gaat.
			</div>
		</div>
		
		<div class='row col-xs-10 col-xs-offset-1'>
		    <table id="spark_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
		        <thead>
		            <tr>
		                <th class="col-xs-2">
		                    Worp
		                </th>
		                <th class="col-xs-3">
		                	Titel
		                </th>
		                <th class="col-xs-7">
		                	Korte beschrijving
		                </th>
		            </tr>
		        </thead>
			 
		        <tbody>
		            @foreach($sparkTable as $sparkEntry)
		                <tr id="{{$sparkEntry['start']}}" onclick="SparkChoice.selectSparkChoice(event, {{$sparkEntry['start']}})">
		                    <td class="col-xs-2">
		                    	@if($sparkEntry['start'] === $sparkEntry['end'])
		                    	{{$sparkEntry['start']}}
		                    	@else
		                    	{{$sparkEntry['start']}} - {{$sparkEntry['end']}}
		                    	@endif
		                    </td>
		                    <td class="col-xs-3">{{$sparkEntry['title']}}</td>
		               		<td class="col-xs-7">
		               			{{$sparkEntry['shortText']}}
		               		</td>
		                </tr>
		            @endforeach
		        </tbody>
		    </table>		
		</div>
		
		<div class="row">
			<form action='/handle_spark_choice' method='POST'>
				<!-- ******************* -->
				<!-- For Laravel CSRF administration -->
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<!-- ******************* -->
				<input type='hidden' name='charId' value='{{$char->id}}'>
				<input id='selectedSpark' name='selectedSpark' type='hidden' value='0'>
				
				<div class="col-xs-2 col-xs-offset-5">
					<input class="btn btn-default" id="submit_button" type="submit" value="Ga verder"
						onClick="SparkChoice.checkSparkChoice(event)" style="width: 120px; font-size: 18px;">
				</div>
			</form>
		</div>
 	</div>
@endsection