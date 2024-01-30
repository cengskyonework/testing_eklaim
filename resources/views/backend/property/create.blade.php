@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Add Property') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('property')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>						
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Property Type') }}</label>						
				<select class="form-control select2" name="property_type_id" required>
					{{ create_option('property_types','id','type',old('property_type_id')) }}
				</select>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Year Built') }}</label>						
				<input type="text" class="form-control int-field" name="year_built" value="{{ old('year_built') }}" required>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Bed') }}</label>						
				<input type="text" class="form-control" name="bed" value="{{ old('bed') }}" required>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Bath') }}</label>						
				<input type="text" class="form-control" name="bath" value="{{ old('bath') }}" required>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Square Feet') }}</label>						
				<input type="text" class="form-control" name="sq_ft" value="{{ old('sq_ft') }}" required>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Price').' '.currency() }}</label>						
				<input type="text" class="form-control float-field" name="price" value="{{ old('price') }}" required>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Price Per Square Feet').' '.currency() }}</label>						
				<input type="text" class="form-control float-field" name="price_per_sq_ft" value="{{ old('price_per_sq_ft') }}" required>
			  </div>
			</div>
			
			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>						
				<select class="form-control" name="status" required>
				   <option value="Active">{{ _lang('Active') }}</option>
				   <option value="InActive">{{ _lang('InActive') }}</option>
				   <option value="Sold">{{ _lang('Sold') }}</option>
				</select>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Description') }}</label>						
				<textarea class="form-control summernote" name="description">{{ old('description') }}</textarea>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('City') }}</label>						
				<select class="form-control select2" name="city_id" required>
					{{ create_option('locations','id','name',old('city_id')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Map Latitude') }}</label>						
				<input type="text" class="form-control" name="map_latitude" value="{{ old('map_latitude') }}" required>
			  </div>
			</div>

			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Map Longitude') }}</label>						
				<input type="text" class="form-control" name="map_longitude" value="{{ old('map_longitude') }}" required>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Featured') }}</label>						
				<select class="form-control" name="is_featured" required>
				   <option value="0">{{ _lang('No') }}</option>
				   <option value="1">{{ _lang('Yes') }}</option>
				</select>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Agent') }}</label>						
				<select class="form-control select2" name="agent_id" required>
				   <option value="">{{ _lang('Select One') }}</option>
				   {{ create_option('agents','id','name',old('agent_id')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Offer Type') }}</label>						
				<select class="form-control" name="offer_type" required>
				   <option value="Sale">{{ _lang('Sale') }}</option>
				   <option value="Rent">{{ _lang('Rent') }}</option>
				   <option value="Lease">{{ _lang('Lease') }}</option>
				</select>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Features') }}</label>						
				<select class="form-control select2" name="benefits[]" multiple="true" required>
					{{ create_option('benefits','id','name') }}
				</select>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Location') }}</label>						
				<textarea class="form-control" name="location" required>{{ old('location') }}</textarea>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Featured Image') }} 800px X 500px</label>						
				<input type="file" class="dropify" name="image" required>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
				<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
			  </div>
			</div>
        </div>			
	  </form>
	</div>
  </div>
 </div>
</div>
@endsection


