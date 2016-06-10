@extends('_layout.admin')

@section('header_js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <link rel="stylesheet" href="/css/calendar.css">
@endsection
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4" >
		<a href="{{ URL('admin/user/create') }}" class="btn btn-primary ">Ajouter un joueur</a>
	</div>
</div>
<div class="row">
	<div>
		<div class="col-md-5"> 
			<h2>Utilisateurs : </h2>
			
			@if (isset($users))
				<table class="table">
					<tr>
						<th>Nom</th>
						<th>Email</th>
						<th>Téléphone</th>
						<th>Action</th>
					</tr>
					@foreach ($users as $user)
						<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->telephone}}</td>
							<td><a href="{{ URL('admin/user/' . $user->id . '/edit') }}"> modifier</a></td>
						</tr>	
					@endforeach
				</table>
			@endif
			
		</div>
	</div>
</div>
@endsection