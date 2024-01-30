@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
	<div class="card">
	
	<div class="card-body">
	  <h4 class="card-title panel-title">{{ _lang('View User Akses') }}</h4>

	  <table class="table table-bordered">
		<tr><td colspan="2"><img style="margin: auto;" class="img-lg thumbnail mx-auto d-block" src="{{ $user->profile_picture != "" ? asset('public/uploads/profile/'.$user->profile_picture) : asset('public/images/avatar.png') }}"></td></tr>
		<tr><td>{{ _lang('Name') }}</td><td>{{ $user->name }}</td></tr>
		<tr><td>{{ _lang('Email') }}</td><td>{{ $user->email }}</td></tr>
		<tr><td>{{ _lang('User Type') }}</td><td>{{ $user->user_type }}</td></tr>
	  </table>
	  
	  <table class="table table-bordered">
		<tr><td colspan="2">{{ _lang('User Akses Cost Center') }}</td></tr>
		<tr><td colspan="2">
		<form action="{{action('UserController@simpan_akses', $id)}}" method="post" onsubmit="return confirm('Anda Yakin ?')">
		@csrf
		<div class="form-group">
        <div class="row">
            <div class="col-md-12">
                    </div>
                    <div class="col-md-4">
                    @foreach ($level as $item)
                            @if ($loop->index%4 == 0 && $loop->index != 0)
                    </div>
                    <div class="col-md-4">
                    @endif
                    <input type="checkbox" name="cost_id[]" value="{{ $item->id }}">{{ $item->cost_number.' - '.$item->cost_name }}<br>
                    @if ($loop->last)
                    </div>
                    @endif
					@endforeach                               
        </div>
		</div>
		</td></tr>
		<tr><td colspan="2">
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Submit</button>
			</div>
		</td></tr>
		</form>
	  </table>
	  
	</div>
  </div>
 </div>
</div>
@endsection


