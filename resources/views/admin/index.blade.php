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
	<tr id="ligne_{{ $colorInfo->id }}">
		<td>{{ $colorInfo->date }}</td>
		<td>{{ date_format(date_create($colorInfo->date), 'l') }}</td>
		<td>{{ $colorInfo->team_id }}</td>
		<td style="background-color:{{$colorInfo->hasOneColor->color_code}}" id="color_info_{{ $colorInfo->id }}" class="show_color"> 
			<label style="color:@if ($colorInfo->hasOneColor->color_code != '#ffffff') #000000 @else #000000 @endif">{{$colorInfo->hasOneColor->name}}</label></td>
		<td> 
			<a href="#" class="glyphicon glyphicon-pencil modifier_color" id="{{ $colorInfo->id }}">&nbsp;</a>
			<a href="#" class="glyphicon glyphicon-trash delete_color" data-id="{{ $colorInfo->id }}">&nbsp;</a>
		</td>
	</tr>
	@endforeach

</table>
<div id="dialog-form" title="Liste Couleur">
	<div><p id="modif_error"></p></div>
	<form class="form" id="form_new_color">
	<fieldset>
		<label for="color">Couleur : </label>
		<input type="hidden" name="id_c_i" id="id_c_i" value="">
		<input name="_method" type="hidden" value="PATCH">
		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<select name="couleur" id="new_couleur">
			@foreach($listeColor as $color)
			<option value="{{ $color->id }}">{{ $color->name }}</option>
			@endforeach
		</select>
		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
	</fieldset>
	</form>
</div>
<div>
	<form id="form_delete_color">
		{{ csrf_field() }}
        {{ method_field('DELETE') }}
		<input type="hidden" name="delete_id" id="delete_id" value="">
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
					$.ajax({
						type: "POST",
						url: '/admin/colorinfo/' + $("#id_c_i").val(),
						data: $("#form_new_color").serialize(),
						success:function(data) {
							if (data !== "echoue") {
								obj = jQuery.parseJSON(data);
								$("#color_info_" + obj.id).css("background-color" , obj.color_code);
								$("#color_info_" + obj.id).html("<label style=\"color:#ffffff\">" + obj.name + "</label></td>");
								dialog.dialog( "close" );
							} else {
								$("#modif_error").html("La modification est echoué !");
							}
						}
					});
				},
				Cancel: function() {
					dialog.dialog( "close" );
				}
			},
		});
		$( ".modifier_color" ).button().on( "click", function() {
			$('#id_c_i').val(this.id);
			dialog.dialog("open");
		});

		$(".delete_color").button().on("click", function(){
			if (!confirm("Vous voulez supprimer cette couleur ? ")) {
				return false;
			}
			id = $(this).data("id");
			$("#delete_id").val(id);
			$.ajax({
				url: '/admin/colorinfo/' + id,
				type: "POST",
				data: $("#form_delete_color").serialize(),
				success:function(data) {
					if (data != 'echoue') {
						$("#ligne_" + id).hide();
					} else {

					}
				}
			});
		});
	});
</script>

@endsection

