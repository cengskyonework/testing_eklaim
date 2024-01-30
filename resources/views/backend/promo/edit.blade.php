@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Data Program') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('PromoController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Nama Program') }}</label>						
							<input type="text" class="form-control" name="name" value="{{ $promo->name }}" required>
						  </div>
						</div>

						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Tanggal Mulai Pada Sistem') }}</label>						
							<input type="text" class="form-control datepicker" name="start_date" value="{{ $promo->start_date }}" required>
						  </div>
						</div>

						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Tanggal Akhir Pada Sistem') }}</label>						
							<input type="text" class="form-control datepicker" name="end_date" value="{{ $promo->end_date }}" required>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Wilayah Program') }}</label>						
							<input type="text" class="form-control" name="wilayah" value="{{ $promo->wilayah }}" required>
						  </div>
						</div>

						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Deskripsi Program') }}</label>						
							<textarea class="form-control summernote" name="description">{{ $promo->description }}</textarea>
						  </div>
						</div>
						

						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Foto') }} 800px X 500px</label>						
							<input type="file" class="dropify" name="image" data-default-file="{{ asset('public/uploads/promo/'.$promo->image) }}">
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



