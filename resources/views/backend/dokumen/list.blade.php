@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('Documents') }}</span>
				<button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add Documents') }}" data-href="{{ route('dokumen.create') }}">{{ _lang('Add New') }}</button>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Documents Name') }}</th>
					<th>{{ _lang('Status') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($dokumen as $dokumen)
				  <tr id="row_{{ $dokumen->id }}">
					<td class='name'>{{ $dokumen->name }}</td>
					<td class='status'>@if ($dokumen->status == '1') <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">InActive</span> @endif</td>
					<td class="text-center">
					  <form action="{{ action('DokumenController@destroy', $dokumen['id']) }}" method="post">
						<button data-href="{{ action('DokumenController@edit', $dokumen['id']) }}" data-title="{{ _lang('Update Documents') }}" class="btn btn-warning btn-xs ajax-modal">{{ _lang('Edit') }}</button>
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


