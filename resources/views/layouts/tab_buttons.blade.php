<!-- Partial view. No HTML tags -->
<div class="row">
	<div class="col-xs-1">
	</div>
	<div class="col-xs-2">
		@if($previous != null)
			<button id="{{$tab}}_previous" class="btn btn-default" style="width:100%">Vorige</button>
		@endif
	</div>
	
	<div class="col-xs-2">
	</div>
	<div class="col-xs-2">
		@if($save)
			<input id="save" class="btn btn-default" style="width:100%" type="submit" value="Opslaan">
		@endif
	</div>
	<div class="col-xs-2">
	</div>
	
	<div class="col-xs-2">
		@if($next != null)
			<button id="{{$tab}}_next" class="btn btn-default" style="width:100%">Volgende</button>
		@endif
	</div>
	<div class="col-xs-2">
	</div>	
</div>