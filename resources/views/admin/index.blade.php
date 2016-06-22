@extends('_layout.admin')
@section('header_js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <link rel="stylesheet" href="/css/calendar.css">
@endsection
@section('content')
<div class="row">
	<div class="col-md-4">
		<form action="#" method="GET" id="form_team" class="form">
			<div class="col-md-4">
				<label for="">Equipe : </label>
			</div>
			<div class="col-md-8">
				<select name="team_id" id="team_id" class="form-control">
			@foreach ($listeTeam as $team)
					<option value="{{$team->id}}" @if ($teamId == $team->id) selected="selected" @endif >{{$team->name}}</option>
			@endforeach
				</select>
			</div>
		</form>
	</div>
	<div class="col-md-4 col-md-offset-4" >
		<a href="{{ URL('admin/colorinfo/create') }}" class="btn btn-primary ">couleurer un jour</a>
	</div>
</div>
<br />
<div class="row" >
	<div>
	<p><label>Mois {{ date('M', $time_actuel) }}</label></p>
	</div>
	<div class="col-md-8">
		<p>
		    <a href="{{ url('/admin/' . $teamId . "?time_actuel=" . $time_previous) }}" class="btn btn-primary btn-sm navbar-left col-md-3"> << mois precédent ({{ date('m', $time_previous) }})</a>
		    <a href="{{ url('/admin/' . $teamId. "?time_actuel=" . $time_next) }}" class="btn btn-primary btn-sm navbar-right col-md-3"> mois suivant ({{ date('m', $time_next) }}) >> </a>
		</p>
	</div>

	<div class="col-md-8">
		{!!$calendar !!}
	</div>
</div>

<div id="dialog-form" title="Liste Couleur">
	<div><p id="modif_error"></p></div>
	<form class="form" id="form_new_color">
	<fieldset>
		<input type="hidden" name="id_c_i" id="id_c_i" value="">
		<label for="color">Date : </label>
		<input type="text" name="date" value="" id="date_c_i" readonly>
		<input name="_method" type="hidden" value="PATCH" id="method_formulaire">
		<input name="team" type='hidden' value="<?=$teamId;?>">
		<input name="_token" type="hidden" value="{{ csrf_token() }}">
		<label for="color">Couleur : </label>
		<select name="color" id="new_couleur">
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
				"Valider" : function() {
					url = '/admin/colorinfo';
					if ($.trim($("#id_c_i").val()) != "") {
						url = url + '/' + $("#id_c_i").val();
					}
					$.ajax({
						type: "POST",
						url: url,
						data: $("#form_new_color").serialize(),
						success:function(data) {
							if (data !== "echoue") {
								obj = jQuery.parseJSON(data);
								if (typeof obj.date != 'undefined') {
									$("td[data-date*='" + obj.date + "']").attr('id', obj.id);
								}
								$("#" + obj.id).css("background-color" , obj.color_code);
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
		$( ".calendar-day" ).button().on( "click", function() {

			if ($.trim($(this).attr('id')) != "") {
				$('#id_c_i').val($(this).attr('id'));
				$("#method_formulaire").val('PATCH');
			} else {
				$('#id_c_i').val("");
				$("#method_formulaire").val('POST');
			}
			$('#date_c_i').val($(this).data("date"));
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

		$("#team_id").on("change", function(){

			$("#form_team").attr('action', "/admin/" + $("#team_id").val()).submit();
		});
	});
</script>

@endsection

