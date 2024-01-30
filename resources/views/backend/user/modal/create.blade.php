<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('users.store') }}"
    enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">{{ _lang('Name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">{{ _lang('Email') }}</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
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
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">{{ _lang('User Type') }}</label>
            <select class="form-control select2" name="user_type" id="user-type" required>
                <option value="user">{{ _lang('User') }}</option>
                <option value="accounting">{{ _lang('Accounting') }}</option>
                <option value="finance">{{ _lang('Finance') }}</option>
                <option value="manager">{{ _lang('Manager') }}</option>
                <option value="administrator">{{ _lang('Administrator') }}</option>
                @if (Auth::user()->user_type == 'admin')
                    <option value="admin">{{ _lang('Super Admin') }}</option>
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
            <label class="control-label">{{ _lang('Profile Picture') }} ( 300 X 300 {{ _lang('for better view') }}
                )</label>
            <input type="file" class="dropify" name="profile_picture"
                data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
            <button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
        </div>
    </div>
</form>

<script>
    $("#user_type").val("{{ old('user_type') }}");
</script>
