@extends('_layout.default')

@section('content')

<div class="row">
	<div>
		<form action="/" id="form_team">
			<h1>Equipe : </h1>

			<select name="team" class="form-control" class="col-md-4" id="team">
			@foreach ($listeTeam as $team )

				<option value="{{$team->id}}" <?=$team->id == $team_defaut ? "selected" : ""?>>{{ $team->name }}</option>
			@endforeach
			</select>
		</form>
	</div>
	<div>
		<div class="col-md-5"> 
			<h2>Semaine Actuelle </h2>
			
			@if (isset($colorInfos1))
				<table class="table">
					<tr>
						<th>Date</th>
						<th>Jour</th>
						<th>Couleur</th>
					</tr>
					@foreach ($colorInfos1 as $colorInfo)
						<?php $color = $colorInfo->hasOneColor ;?>
						<tr>
							<td>{{$colorInfo['date']}}</td>
							<td>{{date_format(date_create($colorInfo['date']), 'l')}}</td>
							<td style="background-color:{{$color['color_code']}}">  <label style="color:#ffffff">{{$color['name']}}</label></td>
						</tr>	
					@endforeach
				</table>
			@endif
			
		</div>
		<div class="col-md-5">
			<h2>Semaine prochaine </h2>

			@if (isset($colorInfos2))
			<table class="table">		
				<tr>
					<th>Date</th>
					<th>Jour</th>
					<th>Couleur</th>
				</tr>
				@foreach ($colorInfos2 as $colorInfo)
					<?php $color = $colorInfo->hasOneColor ?>
					<tr>
						<td>{{$colorInfo['date']}}</td>
						<td>{{date_format(date_create($colorInfo['date']), 'l')}}</td>
						<td style="background-color:{{$color['color_code']}}"> <label style="color:#ffffff">{{$color['name']}}</label> </td>
					</tr>	
				@endforeach
			</table>
			@endif
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#team").change(function(event) {
		$("#form_team").attr('action', '/' + $("#team").val()); 
		$("#form_team").submit();
	});
</script>
@endsection

