@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Produk') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('ProdukController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-6">
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Kode') }}</label>						
							<input type="text" class="form-control" name="kode" value="{{ old('kode') }}" required>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Nama') }}</label>						
							<input type="text" class="form-control" name="nama" value="{{ old('kode') }}" required>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Ketegori') }}</label>						
							<input type="text" class="form-control" name="category" value="{{ old('category') }}" required>
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


