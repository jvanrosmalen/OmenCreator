@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: {{$title}}</h3>
			</div>
		</div>

		<form action="spark_submit/{{$sparkIndex}}" method="POST">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<input type='hidden' name='resource_string' value="">
			<input type="hidden" name="charId" value="{{$charId}}">
			<input type="hidden" name="sparkIndex" value="{{$sparkIndex}}">
            <input type="hidden" name="max_resources" value="{{$max_resources}}">

            <div class="row">
                <div class="row well">
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-10">
                        Ook al ben je geen handelaar (of net wel), je hebt ergens 
                        in het verleden wat grondstoffen (D3) kunnen ruilen en/of kopen 
                        die je nog bijhebt.<br>
                        Je ontvangt grondstoffen van het type: <span id='resourceString'></span> 		
                    </div>
                    <div class="col-xs-1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                    </div>
                    <div id="selectionDiv" class="col-xs-10">
                        <p>Selecteer hieronder maximaal 3 grondstoffen (in totaal) van het juiste type:</p>
                        @foreach($resources as $resource)
                        <input class='resourceInput' type='number' name='{{$resource}}' min='0' max='3' value='0'>
                            &nbsp;<span id="{{$resource}}">{{$resource}}</span><br>
                        @endforeach
                    </div>
                    <div class="col-xs-1">
                    </div>
                </div>
            </div>

			<div class="row">
				<div class="col-xs-7">
				</div>
				<div class="col-xs-2">
					<button type='submit' class="btn btn-default" style="width: 120px; font-size: 18px;">
						Ga door
					</button>
				</div>
				<div class="col-xs-3">
				</div>
			</div>
			
		</form>
 	</div>

    <script>
		SparkChoice.setEventHandlersSelection23();
	</script>
@endsection