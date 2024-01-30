@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('List Post') }}</span>
				<a href="{{ route('blog_posts.create') }}" class="btn btn-primary btn-sm float-right" data-title="{{ _lang('Add New Post') }}">{{ _lang('Add New') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th style="width:200px">{{ _lang('Title') }}</th>
					<th>{{ _lang('Category') }}</th>
					<th>{{ _lang('Status') }}</th>
					<th>{{ _lang('Author') }}</th>
					<th>{{ _lang('Created') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($blogs as $blog)
				  <tr id="row_{{ $blog->id }}">
					<td class='title'>{{ $blog->title }}</td>
					<td class='cat_id'>{{ isset($blog->category) ? $blog->category->name : _lang('N/A') }}</td>
					<td class='status'>{{ $blog->status == 'published' ? ucwords($blog->status) : '' }}</td>
					<td class='status'>{{ isset($blog->author) ? $blog->author->name : _lang('N/A') }}</td>
					<td class='status'>{{ date('d/m/Y',strtotime($blog->created_at)) }}</td>
					<td class="text-center">
					  <form action="{{ action('BlogController@destroy', $blog['id']) }}" method="post">
						<a href="{{ action('BlogController@edit', $blog['id']) }}" class="btn btn-warning btn-xs">{{ _lang('Edit') }}</a>
						<button data-href="{{ action('BlogController@show', $blog['id']) }}" data-title="{{ _lang('View Post') }}" data-fullscreen="true" class="btn btn-info btn-xs ajax-modal">{{ _lang('View') }}</button>
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="DELETE">
						<button class="btn btn-danger btn-xs btn-remove" type="submit">{{ _lang('Delete') }}</button>
					  </form>
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


