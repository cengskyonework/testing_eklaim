@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('View Property') }}</h4>

			  <table class="table table-bordered">
				<tr><td style="width:150px;">{{ _lang('Name') }}</td><td>{{ $property->name }}</td></tr>
				<tr><td>{{ _lang('Property Type') }}</td><td>{{ isset($property->property_type) ? $property->property_type->type : '' }}</td></tr>
				<tr><td>{{ _lang('Year Built') }}</td><td>{{ $property->year_built }}</td></tr>
				<tr><td>{{ _lang('Bed') }}</td><td>{{ $property->bed }}</td></tr>
				<tr><td>{{ _lang('Bath') }}</td><td>{{ $property->bath }}</td></tr>
				<tr><td>{{ _lang('Square Feet') }}</td><td>{{ $property->sq_ft }}</td></tr>
				<tr><td>{{ _lang('Price') }}</td><td>{{ currency().' '.$property->price }}</td></tr>
				<tr><td>{{ _lang('Price Per Square Feet') }}</td><td>{{ currency().' '.$property->price_per_sq_ft }}</td></tr>
				<tr><td>{{ _lang('Status') }}</td><td>@if ($property->status == 'Active') <span class="badge badge-success">{{ $property->status }}</span> @else <span class="badge badge-danger">{{ $property->status }}</span> @endif</td></tr>
				<tr><td>{{ _lang('Is Featured') }}</td><td>@if ($property->is_featured == 1) <span class="badge badge-success">{{ _lang('Yes') }}</span> @else <span class="badge badge-danger">{{ _lang('No') }}</span> @endif</td></tr>	
				<tr><td>{{ _lang('Offer Type') }}</td><td>{{ $property->offer_type }}</td></tr>
				<tr><td>{{ _lang('Description') }}</td><td>{{ strip_tags($property->description) }}</td></tr>
				<tr><td>{{ _lang('City') }}</td><td>{{ isset($property->city) ? $property->city->name : '' }}</td></tr>
				<tr><td>{{ _lang('Agent') }}</td><td>@if (isset($property->agent))  <button data-href="{{ url('agents/'.$property->agent->id) }}" data-title="{{ _lang('View Agent') }}" class="link-btn ajax-modal">{{ $property->agent->name }}</button> @endif</td></tr>
				<tr><td>{{ _lang('Location') }}</td><td>{{ $property->location }}</td></tr>
				<tr><td>{{ _lang('Map Latitude') }}</td><td>{{ $property->map_latitude }}</td></tr>
				<tr><td>{{ _lang('Map Longitude') }}</td><td>{{ $property->map_longitude }}</td></tr>
			  </table>
			</div>
	    </div>
	</div>
</div>
@endsection


