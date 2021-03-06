@extends('_layout.admin')

@section('header_js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <link rel="stylesheet" href="/css/calendar.css">
@endsection
@section('content')
<div class="row">
	<form action="{{ URL('admin/user') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div>
			<label for="nom">Nom : </label>
			<input type="text" name="nom" class="form-control" required="required" >
		</div>
		<div>
			<label for="email">Email : </label>
			<input type="text" name="email" class="form-control" required="required" >
		</div>
		<div>
			<label for="telephone">Téléphone : </label>
			<input type="text" name="telephone" class="form-control" required="required" >
		</div>
		<div>
			<label for="team">Equipe : </label>
			<select name="team" class="form-control" required="required">
				@foreach ($teams as $team)
				<option value="{{ $team->id }}" >{{ $team->name }}</option>
				@endforeach
			</select>
		</div>
		<br />
		<button class="btn btn-lg btn-info">Add User</button>
	</form>
</div>
@endsection