<form method="post" class="ajax-submit" autocomplete="off" action="{{action('UserController@update', $id)}}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">				
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Name') }}</label>						
		<input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Email') }}</label>						
		<input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
	 </div>
	</div>

	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Password') }}</label>						
		<input type="password" class="form-control" name="password">
	 </div>
	</div>
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Confirm Password') }}</label>						
		<input type="password" class="form-control" name="password_confirmation">
	 </div>
	</div>

	<div class="col-md-12">
	  <div class="form-group">
		<label class="control-label">{{ _lang('User Type') }}</label>						
		<select class="form-control select2" name="user_type" id="user_type" required>
		  <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>{{ _lang('User') }}</option>
		  <option value="accounting" {{ $user->user_type == 'accounting' ? 'selected' : '' }}>{{ _lang('Accounting') }}</option>
		  <option value="finance" {{ $user->user_type == 'finance' ? 'selected' : '' }}>{{ _lang('Finance') }}</option>
		  <option value="manager" {{ $user->user_type == 'manager' ? 'selected' : '' }}>{{ _lang('Manager') }}</option>
		  <option value="administrator" {{ $user->user_type == 'administrator' ? 'selected' : '' }}>{{ _lang('Administrator') }}</option>
		  @if(Auth::user()->user_type == 'admin')
			<option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>{{ _lang('Super Admin') }}</option>
		  @endif
		</select>
	  </div>
	</div>
	
	<div class="col-md-12">
	  <div class="form-group">
		<label class="control-label">{{ _lang('Status') }}</label>						
		<select class="form-control select2" id="status" name="status" required>
		  <option value="1">{{ _lang('Active') }}</option>
		  <option value="0">{{ _lang('Inactive') }}</option>
		</select>
	  </div>
	</div>
	
	<div class="col-md-12">
	 <div class="form-group">
		<label class="control-label">{{ _lang('Profile Picture') }} ( 300 X 300 {{ _lang('for better view') }} )</label>						
		<input type="file" class="dropify" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ $user->profile_picture != "" ? asset('public/uploads/profile/'.$user->profile_picture) : '' }}" >
	 </div>
	</div>

				
	<div class="form-group">
	  <div class="col-md-12">
		<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
	  </div>
	</div>
</form>

<script>
$("#user_type").val("{{ $user->user_type }}");
</script>
