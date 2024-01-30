@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Add Documents') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('dokumen')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Documents Name') }}</label>						
					<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Status') }}</label>						
					<select class="form-control select2" name="status_data" required>
					   <option value="1">{{ _lang('Active') }}</option>
					   <option value="0">{{ _lang('InActive') }}</option>		   
					</select>
				  </div>
				</div>

				
				<div class="col-md-12">
				  <div class="form-group">
					<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
					<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
				  </div>
				</div>
			</div>
        </div>			
	  </form>
	</div>
  </div>
 </div>
</div>
@endsection


