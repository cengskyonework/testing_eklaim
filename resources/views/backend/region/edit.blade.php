@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Region') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('RegionController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-12">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Region Name') }}</label>						
									<input type="text" class="form-control" name="region_name" value="{{ $region->region_name }}" required>
								  </div>
								</div>
								
								<div class="col-md-12">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Region Address') }}</label>						
									<input type="text" class="form-control" name="region_address" value="{{ $region->region_address }}" required>
								  </div>
								</div>

				
							<div class="col-md-12">
							  <div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
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


