<table class="table table-bordered">
    @if($blog->featured_image != '')
		<tr><td colspan="2" class="text-center"><img class="img-fluid img-thumbnail" src="{{ asset('public/uploads/media/'.$blog->featured_image) }}"></td></tr>
	@endif
	<tr><td>{{ _lang('Title') }}</td><td>{{ $blog->title }}</td></tr>
	<tr><td>{{ _lang('Content') }}</td><td>{{ strip_tags($blog->content) }}</td></tr>
	<tr><td>{{ _lang('Category') }}</td><td>{{ isset($blog->category) ? $blog->category->name : _lang('N/A') }}</td></tr>
	<tr><td>{{ _lang('Status') }}</td><td>{{ ucwords($blog->status) }}</td></tr>
	<tr><td>{{ _lang('Author') }}</td><td>{{ isset($blog->author) ? $blog->author->name : _lang('N/A') }}</td></tr>
	<tr><td>{{ _lang('Created At') }}</td><td>{{ date('d/m/Y',strtotime($blog->created_at)) }}</td></tr>
	<tr><td>{{ _lang('Updated At') }}</td><td>{{ date('d/m/Y',strtotime($blog->updated_at)) }}</td></tr>
</table>

