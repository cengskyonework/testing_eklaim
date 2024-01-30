@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-6">
	  <div class="card">
	  <div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Add New Language') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{ url('languages') }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Language Name') }}</label>						
				<input type="text" class="form-control" name="language_name" value="{{ old('language_name') }}" required>
			  </div>
			</div>

			
			<div class="col-md-12">
			  <div class="form-group">
				<button type="submit" class="btn btn-primary">{{ _lang('Create Language') }}</button>
			  </div>
			</div>
		</div>
	  </form>
	</div>
  </div>
 </div>
</div>
@endsection


