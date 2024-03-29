<form method="post" class="ajax-submit" autocomplete="off" action="{{route('region.store')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
	
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Region Name') }}</label>						
					<input type="text" class="form-control" name="region_city" value="{{ old('region_city') }}" required>
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Region Address') }}</label>						
					<input type="text" class="form-control" name="region_address" value="{{ old('region_address') }}" required>
				  </div>
				</div>

				
	<div class="col-md-12">
	  <div class="form-group">
	    <button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
		<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
	  </div>
	</div>
</form>
