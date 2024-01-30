@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('List Property') }}</span>
			    <a class="btn btn-success btn-sm float-right" href="{{ route('property.create') }}">{{ _lang('Add New') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Name') }}</th>
					<th>{{ _lang('Property Type') }}</th>
					<th>{{ _lang('Price') }}</th>
					<th>{{ _lang('Status') }}</th>
					<th class="text-center">{{ _lang('Featured') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($propertys as $property)
				  <tr id="row_{{ $property->id }}">
					<td class='name'>{{ $property->name }}</td>
					<td class='property_type_id'>{{ isset($property->property_type) ? $property->property_type->type : '' }}</td>
					<td class='price'>{{ $currency.' '.decimalPlace($property->price) }}</td>
					<td class='status'>@if ($property->status == 'Active') <span class="badge badge-success">{{ $property->status }}</span> @else <span class="badge badge-danger">{{ $property->status }}</span> @endif</td>
					<td class='is_featured text-center'>@if ($property->is_featured == 1) <span class="badge badge-success">{{ _lang('Yes') }}</span> @else <span class="badge badge-danger">{{ _lang('No') }}</span> @endif</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
						  <form action="{{ action('PropertyController@destroy', $property['id']) }}" method="post">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="DELETE">
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('PropertyController@edit', $property['id']) }}" class="dropdown-item"><i class="mdi mdi-pencil"></i> {{ _lang('Edit') }}</a>
								<a href="{{ action('PropertyController@show', $property['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>
								<a href="{{ action('PropertyController@gallery', $property['id']) }}" class="dropdown-item"><i class="mdi mdi-image-filter"></i> {{ _lang('Gallery') }}</a>
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


