<form method="post" class="ajax-submit" autocomplete="off" action="{{action('RegionController@update', $id)}}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">				
	
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Region Name') }}</label>						
					<input type="text" class="form-control" name="region_city" value="{{ $region->region_city }}" required>
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Region Address') }}</label>						
					<input type="text" class="form-control" name="region_address" value="{{ $region->region_address }}" required>
				  </div>
				</div>

				
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
	  </div>
	</div>
</form>

