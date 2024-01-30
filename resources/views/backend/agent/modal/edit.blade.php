<form method="post" class="ajax-submit" autocomplete="off" action="{{action('AgentController@update', $id)}}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">				
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Name') }}</label>						
		<input type="text" class="form-control" name="name" value="{{ $agent->name }}" required>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Email') }}</label>						
		<input type="text" class="form-control" name="email" value="{{ $agent->email }}" required>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Phone') }}</label>						
		<input type="text" class="form-control" name="phone" value="{{ $agent->phone }}">
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Address') }}</label>						
		<textarea class="form-control" name="address">{{ $agent->address }}</textarea>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Description') }}</label>						
		<textarea class="form-control" rows="8" name="description">{{ $agent->description }}</textarea>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Image') }} 400px X 400px</label>						
		<input type="file" class="form-control dropify" name="image" data-default-file="{{ asset('public/uploads/media/'.$agent->image) }}">
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Facebook') }}</label>						
		<input type="text" class="form-control" name="facebook" value="{{ $agent->facebook }}">
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Twitter') }}</label>						
		<input type="text" class="form-control" name="twitter" value="{{ $agent->twitter }}">
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Linkedin') }}</label>						
		<input type="text" class="form-control" name="linkedin" value="{{ $agent->linkedin }}">
	 </div>
	</div>

				
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
	  </div>
	</div>
</form>

