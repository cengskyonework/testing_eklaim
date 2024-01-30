@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Jenis Klaim') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('CategoryController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Category Name') }}</label>						
							<input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
						  </div>
						</div>
						
					    <div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Status') }}</label>						
							<select class="form-control select2" name="status" required>
								<option value="">== Pilih Status ==</option>
								<option value="A" {{ $category->status =='A' ? 'selected' : '' }}>Aktif</option>
								<option value="C" {{ $category->status =='C' ? 'selected' : '' }}>Non Aktif</option>
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
						  </div>
						</div>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>

@endsection



