@extends('_layout.admin')

@section('header_js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <link rel="stylesheet" href="/css/calendar.css">
@endsection
@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
	<form action="{{ URL('admin/user/' . $user->id) }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div>
			<label for="nom">Nom : </label>
			<input type="text" name="nom" class="form-control" required="required" value="{{ $user->name }}">
		</div>
		<div>
			<label for="email">Email : </label>
			<input type="text" name="email" class="form-control" required="required" value="{{ $user->email }}">
		</div>
		<div>
			<label for="telephone">Téléphone : </label>
			<input type="text" name="telephone" class="form-control" required="required" value="{{ $user->telephone }}">
		</div>
		<div>
			<label for="team">Equipe : </label>
			<select name="team" class="form-control" required="required">
				@foreach ($teams as $team)
				<option value="{{ $team->id }}" <?=$team->id == $user->team_id ? "selected" : "" ?>>{{ $team->name }}</option>
				@endforeach
			</select>
		</div>
		<br />
		<div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<button class="btn btn-lg btn-info">Valider</button>
		</div>
	</form>
</div>
@endsection