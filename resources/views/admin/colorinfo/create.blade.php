@extends('_layout.admin')

@section('header_js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
$(function() {
	$( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>
@endsection

@section('content')
<div class="row">
	<div class="col-md-4">
		<h3>Créer un color </h3>
		<div>
			<form action="{{ URL('admin/colorinfo') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<label for="date">Date : </label>
				<input type="text" name="date" class="form-control" required="required" id="datepicker" placeholder="YYYY-mm-dd">
				<br>
				<label for="color">Color : </label>
				<select name="color" class="form-control">
					<option value="">--- Sélectionnez un couleur ---</option>
					@foreach ($colors as $color)
					<option value="{{ $color->id }}" style="background-color: {{$color->color_code}}">{{ $color->name }}</option>
					@endforeach
				</select>
				<br>
				<div style="border:2px;border-color:#000000;border-style:solid;padding: 5px;">
					<p> Nouvelle couleur </p>
					<label for="date">Name : </label>
					<input type="text" name="name" class="form-control">
					<label for="new_color" >New color</label>
					<input type="color" name="new_color" value="" class="form-control"/>

				</div>
				<label for="date">Team : </label>
				<select name="team" class="form-control" required="required">
					@foreach ($teams as $team)
					<option value="{{ $team->id }}">{{ $team->name }}</option>
					@endforeach
				</select>
				<br>
				<button class="btn btn-lg btn-info">Add Color</button>
			</form>
		</div>
	</div>
</div>
@endsection

