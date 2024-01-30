@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('Data Region') }}</span>
				<button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add Region') }}" data-href="{{route('region.create')}}">{{ _lang('Add New') }}</button>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Name') }}</th>
					<th>{{ _lang('Address') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($region as $region)
				  <tr id="row_{{ $region->id }}">
					<td class='region_name'>{{ $region->region_city }}</td>
					<td class='region_address'>{{ $region->region_address }}</td>
					<td class="text-center">
					  <form action="{{ action('RegionController@destroy', $region['id']) }}" method="post">
						<button data-href="{{ action('RegionController@edit', $region['id']) }}" data-title="{{ _lang('Update Region') }}" class="btn btn-warning btn-xs ajax-modal">{{ _lang('Edit') }}</button>
						{{ csrf_field() }}
						<input region_name="_method" type="hidden" value="DELETE">
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


