@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('List Category') }}</span>
				<button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add New Category') }}" data-href="{{route('blog_categories.create')}}">{{ _lang('Add New') }}</button>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Name') }}</th>
					<th>{{ _lang('Description') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($blogcategorys as $blogcategory)
				  <tr id="row_{{ $blogcategory->id }}">
					<td class='name'>{{ $blogcategory->name }}</td>
					<td class='description'>{{ $blogcategory->description }}</td>
					<td class="text-center">
					  <form action="{{ action('BlogCategoryController@destroy', $blogcategory['id']) }}" method="post">
						<button data-href="{{ action('BlogCategoryController@edit', $blogcategory['id']) }}" data-title="{{ _lang('Update Category') }}" class="btn btn-warning btn-xs ajax-modal">{{ _lang('Edit') }}</button>
						<button data-href="{{ action('BlogCategoryController@show', $blogcategory['id']) }}" data-title="{{ _lang('View Category') }}" class="btn btn-info btn-xs ajax-modal">{{ _lang('View') }}</button>
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


