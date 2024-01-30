<form method="post" class="ajax-submit" autocomplete="off" action="{{route('produk.store')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
				
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
					<select class="form-control select2" name="status" required>
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
</form>
