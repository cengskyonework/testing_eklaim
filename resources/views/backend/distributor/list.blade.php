@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Data Distributor') }}</span>
			    <a class="btn btn-success btn-sm float-right" href="{{ route('distributor.create') }}">{{ _lang('Tambah') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('No Distributor') }}</th>
					<th>{{ _lang('Nama') }}</th>
					<th>{{ _lang('Telp') }}</th>
					<th>{{ _lang('Email') }}</th>
					<th>{{ _lang('Alamat') }}</th>
					<th>{{ _lang('Di Buat') }}</th>
					<th class="text-center">{{ _lang('Menu') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($distributor as $distributor)
				  <tr id="row_{{ $distributor->id }}">
				    <td class='no'>{{ $distributor->no_distributor }}</td>
					<td class='name'>{{ $distributor->name }}</td>
					<td class='hp'>{{ $distributor->hp }}</td>
					<td class='email'>{{ $distributor->email }}</td>	
					<td class='address'>{{ $distributor->address }}</td>
					<td class='profession'>{{ $distributor->created_nams->name }}</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
						  <form action="{{ action('DistributorController@destroy', $distributor['id']) }}" method="post">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="DELETE">
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('DistributorController@edit', $distributor['id']) }}" class="dropdown-item"><i class="mdi mdi-pencil"></i> {{ _lang('Edit') }}</a>
								<a href="{{ action('DistributorController@show', $distributor['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>
								<button class="btn-remove dropdown-item" type="submit"><i class="mdi mdi-delete"></i> {{ _lang('Delete') }}</button>
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


