@extends('_layout.admin')

@section('content')
<a href="{{ URL('admin/colorinfo/create') }}" class="btn btn-lg btn-primary">couleurer un jour</a>

<table class="table">
	<tr>
		<td>Date</td>
		<td>Jour</td>
		<td>Team</td>
		<td>Couleur</td>
	</tr>
@foreach($listeColorInfo as $colorInfo)
	<tr>
		<td>{{ $colorInfo->date }}</td>
		<td>{{ date_format(date_create($colorInfo->date), 'l') }}</td>
		<td>{{ $colorInfo->team_id }}</td>
		<td style="background-color:{{$colorInfo->hasOneColor->color_code}}"> <label style="color:#ffffff">{{$colorInfo->hasOneColor->name}}</label></td>
	</tr>
@endforeach

</table>

<div>
	
	<p>Admin</p>
</div>

@endsection