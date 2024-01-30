<form method="post" class="ajax-submit" autocomplete="off" action="{{action('ProdukController@update', $id)}}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">				
		<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Kode') }}</label>						
					<input type="text" class="form-control" name="kode" value="{{ $produk->kode }}" required>
				  </div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Nama') }}</label>						
				<input type="text" class="form-control" name="nama" value="{{ $produk->nama }}" required>
			</div>
		</div>
		<div class="col-md-12">
				  <div class="form-group">
					<label class="control-label">{{ _lang('Kategori') }}</label>						
					<input type="text" class="form-control" name="category" value="{{ $produk->category }}" required>
				  </div>
		</div>

	    <div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>						
				<select class="form-control select2" name="status" required>
					<option value="1" {{ $produk->status == 1 ? 'selected' : '' }}>{{ _lang('Active') }}</option>
					<option value="0" {{ $produk->status == 0 ? 'selected' : '' }}>{{ _lang('InActive') }}</option>		   
				</select>
			</div>
		</div>
				
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
	  </div>
	</div>
</form>

