@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Data Calon Konsumen') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('DistributorController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label">{{ _lang('No Distributor') }}</label>						
							<input type="text" class="form-control" name="no_distributor" value="{{ $distributor->no_distributor }}" required>
						  </div>
						</div>
						
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Nama Distributor') }}</label>						
							<input type="text" class="form-control" name="name" value="{{ $distributor->name }}" required>
						  </div>
						</div>

						<div class="col-md-3">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Jenis Usaha') }}</label>						
							<select class="form-control select2" name="jenis_usaha" required>
								<option value="">{{ _lang('-- Pilih --') }}</option>
								<option value="PT" {{ $distributor->jenis_usaha =='PT' ? 'selected' : '' }}>{{ _lang('PT') }}</option>
								<option value="CV" {{ $distributor->jenis_usaha =='CV' ? 'selected' : '' }}>{{ _lang('CV') }}</option>
								<option value="LN" {{ $distributor->jenis_usaha =='LN' ? 'selected' : '' }}>{{ _lang('Lain nya') }}</option>
							</select>
						  </div>
						</div>

						<div class="col-md-3">
						  <div class="form-group">
							<label class="control-label">{{ _lang('No Identitas') }}</label>						
							<input type="text" class="form-control float-field" name="id_no" value="{{ $distributor->id_no }}" required>
						  </div>
						</div>

						<div class="col-md-3">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Telp / Hp') }}</label>						
							<input type="text" class="form-control" name="hp" value="{{ $distributor->hp }}" required>
						  </div>
						</div>

						<div class="col-md-3">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Email') }}</label>						
							<input type="text" class="form-control" name="email" value="{{ $distributor->email }}" required>
						  </div>
						</div>

						<div class="col-md-3">
						  <div class="form-group">
							<label class="control-label">{{ _lang('NPWP') }}</label>						
							<input type="text" class="form-control float-field" id="NPWP" name="npwp" value="{{ $distributor->npwp }}">
						  </div>
						</div>

						<div class="col-md-9">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Keterangan') }}</label>						
							<input type="text" class="form-control" name="keterangan" value="{{ $distributor->keterangan }}">
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Nama Bank Konsumen') }}</label>						
							<select class="form-control select2" name="bank_id">
								<option value="">== Pilih ==</option>
								{{ create_option('bank','id','nama_bank', $distributor->bank_id) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="control-label">{{ _lang('No Rekening Konsumen') }}</label>						
							<input type="text" class="form-control norek" name="no_rek" value="{{ $distributor->no_rek }}" >
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="control-label">{{ _lang('A/N Rekening') }}</label>						
							<input type="text" class="form-control" name="nama_rek" value="{{ $distributor->nama_rek }}" >
						  </div>
						</div>
									
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Alamat') }}</label>						
							<textarea class="form-control" name="address">{{ $distributor->address }}</textarea>
						  </div>
						</div>

						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Region Distributor') }}</label>						
							<select class="form-control select2" name="region_id" required>
								<option value="">== Pilih ==</option>
								{{ create_option('region','id','region_city',$distributor->region_id) }}
							</select>
						  </div>
						</div>
						
						<div class="col-md-12">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Foto Distributor') }} 800px X 500px</label>						
							<input type="file" class="dropify" name="image" data-default-file="{{ asset('public/uploads/ktp/'.$distributor->image) }}">
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
@section('js-script')
<script type="text/javascript">
$('.norek').mask('0000.0000.0000.0000.0000', {reverse: true});
$('#GAJI').mask('000.000.000', {reverse: true});
$('#NPWP').mask('00.000.000.0-000.000');
</script>
@endsection


