@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <h4 class="card-title"><span class="panel-title">{{ _lang('User List') }}</span>
                        <button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add User') }}"
                            data-href="{{ route('users.create') }}">{{ _lang('Add New') }}</button>
                    </h4>

                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>{{ _lang('Name') }}</th>
                                <th>{{ _lang('Email') }}</th>
                                <th>{{ _lang('User Type') }}</th>
                                <th>{{ _lang('Status') }}</th>
                                <th class="text-center">{{ _lang('User Akses') }}<br>{{ _lang('Cost Center') }}</th>
                                <th class="text-center">{{ _lang('Action') }}</th>
                                <th>{{ _lang('Login Terakhir') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr id="row_{{ $user->id }}">
                                    <td class='name'>{{ $user->name }}</td>
                                    <td class='email'>{{ $user->email }}</td>
                                    @if ($user->user_type == 'admin')
                                        <td class='user_type'>Super Admin</td>
                                    @else
                                        <td class='user_type'>{{ ucwords($user->user_type) }}</td>
                                    @endif
                                    <td class='status'>{{ $user->status == 1 ? _lang('Active') : _lang('In-Active') }}</td>
                                    @if ($user->user_type == 'user')
                                        <td class='status'></td>
                                    @else
                                        @if ($user->akses == 1)
                                            <td class='user_type'><a
                                                    href="{{ action('UserController@buat_akses', $user['id']) }}"
                                                    class="dropdown-item"><i class="mdi mdi-pencil"></i>
                                                    {{ _lang('Beri Akses') }}</a></td>
                                        @else
                                            <td class='user_type'><a
                                                    href="{{ action('UserController@edit_akses', $user['id']) }}"
                                                    class="dropdown-item"><i class="mdi mdi-pencil"></i>
                                                    {{ _lang('Edit Akses') }}</a></td>
                                        @endif
                                    @endif
                                    <td class="text-center">
                                        <form action="{{ action('UserController@destroy', $user['id']) }}" method="post">
                                            <button data-href="{{ action('UserController@edit', $user['id']) }}"
                                                data-title="{{ _lang('Update User') }}"
                                                class="btn btn-warning btn-sm ajax-modal">{{ _lang('Edit') }}</button>
                                            <button data-href="{{ action('UserController@show', $user['id']) }}"
                                                data-title="{{ _lang('View User') }}"
                                                class="btn btn-info btn-sm ajax-modal">{{ _lang('View') }}</button>
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">
                                            @if (Auth::user()->user_type == 'admin')
                                                <button class="btn btn-danger btn-sm btn-remove"
                                                    type="submit">{{ _lang('Delete') }}</button>
                                            @endif
                                        </form>
                                    </td>
                                    <td class='last'>
                                        @if (!empty($user->last_login_at))
                                            IP : <span class="badge badge-primary">{{ $user->last_login_ip }}</span><br>
                                            Date : <span
                                                class="badge badge-dark">{{ date('d-m-Y H:i:s', strtotime($user->last_login_at)) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
