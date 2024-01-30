@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('List Agent') }}</span>
				<button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add Agent') }}" data-href="{{route('agents.create')}}">{{ _lang('Add New') }}</button>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
				    <th>{{ _lang('Image') }}</th>
					<th>{{ _lang('Name') }}</th>
					<th>{{ _lang('Email') }}</th>
					<th>{{ _lang('Phone') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($agents as $agent)
				  <tr id="row_{{ $agent->id }}">
				    <td class='image'><img src="{{ asset('public/uploads/media/'.$agent->image) }}" class="img-md"></td>
					<td class='name'>{{ $agent->name }}</td>
					<td class='email'>{{ $agent->email }}</td>
					<td class='phone'>{{ $agent->phone }}</td>
					<td class="text-center">
					  <form action="{{ action('AgentController@destroy', $agent['id']) }}" method="post">
						<button data-href="{{ action('AgentController@edit', $agent['id']) }}" data-title="{{ _lang('Update Agent') }}" class="btn btn-warning btn-xs ajax-modal">{{ _lang('Edit') }}</button>
						<button data-href="{{ action('AgentController@show', $agent['id']) }}" data-title="{{ _lang('View Agent') }}" class="btn btn-info btn-xs ajax-modal">{{ _lang('View') }}</button>
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="DELETE">
						<button class="btn btn-danger btn-xs btn-remove" type="submit">{{ _lang('Delete') }}</button>
					  </form>
					</td>
				  </tr>
				  @endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection


