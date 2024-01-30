@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Data Deskripsi Cost Center') }}</span>
			    <a class="btn btn-success btn-sm float-right" href="{{ route('channel.create') }}">{{ _lang('Tambah') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Id') }}</th>
					<th>{{ _lang('Name') }}</th>
					<th>{{ _lang('Status') }}</th>
					<th class="text-center">{{ _lang('Menu') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($channel as $channel)
				  <tr id="row_{{ $channel->id }}">
				    <td class='id'>{{ $channel->id }}</td>
					<td class='cost_number'>{{ $channel->chanel_name }}</td>
					<td class='cost_number'>
							@if($channel->status != 'A')
								<span class="badge badge-danger">Non Aktif</span>
							@else
								<span class="badge badge-success">Aktif</span>
							@endif
					</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
						  <form action="{{ action('ChannelController@destroy', $channel['id']) }}" method="post">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="DELETE">
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('ChannelController@edit', $channel['id']) }}" class="dropdown-item"><i class="mdi mdi-pencil"></i> {{ _lang('Edit') }}</a>
								<a href="{{ action('ChannelController@show', $channel['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>
								@if(Auth::user()->user_type == 'admin')
									<button class="btn-remove dropdown-item" type="submit"><i class="mdi mdi-delete"></i> {{ _lang('Delete') }}</button>
								@endif
							</div>
						  </form>
						</div>
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


