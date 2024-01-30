@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
	  <div class="card">
		<div class="card-body">
		  <h4 class="card-title panel-title">{{ _lang('Add User') }}</h4>
		  <form method="post" class="validate" autocomplete="off" action="{{url('users')}}" enctype="multipart/form-data">
		    <div class="row">
				<div class="col-md-6">
					{{ csrf_field() }}
					  <div class="form-group">
						<label class="control-label">{{ _lang('Name') }}</label>						
						<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
					  </div>

					  <div class="form-group">
						<label class="control-label">{{ _lang('Email') }}</label>						
						<input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
					  </div>

					  <div class="form-group">
						<label class="control-label">{{ _lang('Password') }}</label>						
						<input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
					  </div>
					
					 <div class="form-group">
						<label class="control-label">{{ _lang('Confirm Password') }}</label>						
						<input type="password" class="form-control" name="password_confirmation" required>
					 </div>

					  <div class="form-group">
						<label class="control-label">{{ _lang('User Type') }}</label>						
						<select class="form-control select2" id="user-type" name="user_type" required>
						  <option value="user">{{ _lang('User') }}</option>
						  <option value="accounting">{{ _lang('Accounting') }}</option>
						  <option value="finance">{{ _lang('Finance') }}</option>
						  <option value="finance">{{ _lang('Manager') }}</option>
						  @if(Auth::user()->user_type == 'admin')
							<option value="admin">{{ _lang('Super Admin') }}</option>
						  @endif
						</select>
					  </div>
					
					  <div class="form-group">
						<label class="control-label">{{ _lang('Status') }}</label>						
						<select class="form-control select2" id="status" name="status" required>
						  <option value="1">{{ _lang('Active') }}</option>
						  <option value="0">{{ _lang('Inactive') }}</option>
						</select>
					  </div>
					  
					  <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">User Access Cost Center</label>
                                    </div>
                                        <div class="col-md-4">
                                            @foreach ($level as $item)
                                                @if ($loop->index%4 == 0 && $loop->index != 0)
                                                 </div>
                                                    <div class="col-md-4">
                                                @endif
                                                <input type="checkbox" name="level_id[]" value="{{ $item->id }}">{{ $item->cost_number.' - '.$item->cost_name }}<br>
                                                @if ($loop->last)
                                                    </div>
                                                @endif
                                            @endforeach
                                           
                                </div>
                    </div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-success">{{ _lang('Save') }}</button>
						<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>	
					</div>
					
				</div>
				
				<div class="col-md-6">		
				 <div class="form-group">
					<label class="control-label">{{ _lang('Profile Picture') }} ( 300 X 300 {{ _lang('for better view') }} )</label>						
					<input type="file" class="dropify" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="">
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
<script>
$("#user_type").val("{{ old('user_type') }}");
</script>
@endsection


