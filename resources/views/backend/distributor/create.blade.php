@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('Form Distributor') }}</h4>
	  <form method="post" class="validate" autocomplete="off" action="{{url('distributor')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('No Distributor') }}</label>						
				<input type="text" class="form-control" name="no_distributor" value="{{ old('no_distributor') }}" required>
			  </div>
			</div>
			
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Nama Distributor') }}</label>						
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			  </div>
			</div>

			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Jenis Usaha') }}</label>						
				<select class="form-control select2" name="jenis_usaha">
					<option value="">{{ _lang('-- Pilih --') }}</option>
					<option value="PT">PT</option>
					<option value="CV">CV</option>
					<option value="LN">Lain Nya</option>
				</select>
			  </div>
			</div>

			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('No Identitas') }}</label>						
				<input type="text" class="form-control float-field" name="id_no" value="{{ old('id_no') }}" >
			  </div>
			</div>

			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Telp / Hp') }}</label>						
				<input type="text" class="form-control float-field" name="hp" value="{{ old('hp') }}" required>
			  </div>
			</div>

			<div class="col-md-3">
			  <div class="form-group">
				<label class="control-label">{{ _lang('NPWP') }}</label>						
				<input type="text" class="form-control npwp" name="npwp" value="{{ old('npwp') }}" placeholder="00.000.000.0-000.000">
			  </div>
			</div>

			<div class="col-md-9">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Keterangan') }}</label>						
				<input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" >
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Nama Bank Distributor') }}</label>						
				<select class="form-control select2" name="bank_id">
					<option value="">== Pilih ==</option>
					{{ create_option('bank','id','nama_bank',old('bank')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('No Rekening Distributor') }}</label>						
				<input type="text" class="form-control" name="no_rek" value="{{ old('no_rek') }}" >
			  </div>
			</div>
			
			<div class="col-md-4">
			  <div class="form-group">
				<label class="control-label">{{ _lang('A/N Rekening') }}</label>						
				<input type="text" class="form-control" name="nama_rek" value="{{ old('nama_rek') }}" >
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Alamat Distributor') }}</label>						
				<textarea class="form-control" name="address" >{{ old('address') }}</textarea>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Region Distributor') }}</label>						
				<select class="form-control select2" name="region_id" required>
					<option value="">== Pilih ==</option>
					{{ create_option('region','id','region_city',old('info')) }}
				</select>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Foto Distributor') }} 800px X 500px</label>						
				<input type="file" class="dropify" name="image">
			  </div>
			</div>
		</div>
			
			<h4 class="card-title panel-title">{{ _lang('Data User') }}</h4><br>
			<div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('User Email') }}</label>						
				<input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label">{{ _lang('Password') }}</label>						
				<input type="text" class="form-control" name="password" value="{{ old('password') }}" required>
			  </div>
			</div>
			</div>
		
			<div class="col-md-12">
			  <div class="form-group">
				<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
				<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
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
$('.gaji').mask('000.000.000', {reverse: true});
$('.norek').mask('0000.0000.0000.0000.0000', {reverse: true});
$('.npwp').mask('00.000.000.0-000.000' , {reverse: true});
</script>
@endsection
