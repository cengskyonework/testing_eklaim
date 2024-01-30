<form method="post" class="ajax-submit" autocomplete="off" action="{{route('faqs.store')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
	
	<div class="col-md-12">
	  <div class="form-group">
		<label class="control-label">{{ _lang('Question') }}</label>						
		<input type="text" class="form-control" name="question" value="{{ old('question') }}" required>
	  </div>
	</div>

	<div class="col-md-12">
	  <div class="form-group">
		<label class="control-label">{{ _lang('Answer') }}</label>						
		<textarea class="form-control" rows="8" name="answer" required>{{ old('answer') }}</textarea>
	  </div>
	</div>

				
	<div class="col-md-12">
	  <div class="form-group">
	    <button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
		<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
	  </div>
	</div>
</form>
