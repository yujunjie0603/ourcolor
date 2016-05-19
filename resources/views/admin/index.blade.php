@extends('_layout.admin')
@section('header_js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
<a href="{{ URL('admin/colorinfo/create') }}" class="btn btn-lg btn-primary">couleurer un jour</a>

<table class="table">
	<tr>
		<td>Date</td>
		<td>Jour</td>
		<td>Team</td>
		<td>Couleur</td>
		<td>Action</td>
	</tr>
@foreach($listeColorInfo as $colorInfo)
	<tr>
		<td>{{ $colorInfo->date }}</td>
		<td>{{ date_format(date_create($colorInfo->date), 'l') }}</td>
		<td>{{ $colorInfo->team_id }}</td>
		<td style="background-color:{{$colorInfo->hasOneColor->color_code}}" id="color_info_{{ $colorInfo->id }}" class="show_color"> 
			<label style="color:@if ($colorInfo->hasOneColor->color_code != '#ffffff') #ffffff @else #000000 @endif">{{$colorInfo->hasOneColor->name}}</label></td>
		<td > 
			<a href="#" class="glyphicon glyphicon-pencil modifier_color">&nbsp;</a>
			<a href="#" class="glyphicon glyphicon-trash">&nbsp;</a>
		</td>
	</tr>
@endforeach

</table>
<div id="dialog-form" title="Liste Couleur">
	<form class="form" id="form_new_color">
	<fieldset>
		<label for="color">Couleur : </label>
		<select name="couleur" id="new_couleur">
			@foreach($listeColor) as $color
			<option value="{{ $color->id }}">{{ $color->name }}</option>
			@endforeach
		</select>
		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	</fieldset>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {

	    dialog = $( "#dialog-form" ).dialog({
	      autoOpen: false,
	      height: 300,
	      width: 350,
	      modal: true,
	      buttons: {
	      	"Changer la couleur" : function() {
	      		$.post('Admin/changecolor', 
	      			{new_color: }
	      			function(data) {

	      		});
	      		
	      	},
	        Cancel: function() {
	          dialog.dialog( "close" );
	        }
	      },
	    });
	    $( ".modifier_color" ).button().on( "click", function() {
	      dialog.dialog("open");
	    });

	});
</script>
@endsection

