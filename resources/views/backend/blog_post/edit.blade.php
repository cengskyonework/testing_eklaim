@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h4 class="card-title panel-title">{{ _lang('Update Post') }}</h4>
				<form method="post" class="validate" autocomplete="off" action="{{action('BlogController@update', $id)}}" enctype="multipart/form-data">
					{{ csrf_field()}}
					<input name="_method" type="hidden" value="PATCH">				
					<div class="row">
						<div class="col-md-12">
						 <div class="form-group">
							<label class="control-label">{{ _lang('Title') }}</label>						
							<input type="text" class="form-control" name="title" value="{{ $blog->title }}" required>
						 </div>
						</div>
						
						<div class="col-md-12">
						 <div class="form-group">
							<label class="control-label">{{ _lang('Excerpt') }}</label>						
							<textarea class="form-control" rows="4" name="excerpt">{{ $blog->excerpt }}</textarea>
						 </div>
						</div>

						<div class="col-md-12">
						 <div class="form-group">
							<label class="control-label">{{ _lang('Content') }}</label>						
							<textarea class="form-control summernote" name="content">{{ $blog->content }}</textarea>
						 </div>
						</div>

						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Category') }}</label>						
							<select class="form-control select2" name="cat_id" required>
								{{ create_option("blog_categories","id","name",$blog->cat_id) }}
							</select>
						  </div>
						</div>
					
						<input type="hidden" name="post_type" value="post">

						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label">{{ _lang('Status') }}</label>						
							<select class="form-control" name="status" required>
							   <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>{{ _lang('Published') }}</option>
							   <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>{{ _lang('Draft') }}</option>
							   <option value="pending" {{ $blog->status == 'pending' ? 'selected' : '' }}>{{ _lang('Pending') }}</option>
							</select>
						  </div>
						</div>

						<div class="col-md-12">
						 <div class="form-group">
							<label class="control-label">{{ _lang('Featured Image') }}</label>						
							<input type="file" class="form-control dropify" name="featured_image" data-default-file="{{ $blog->featured_image != '' ? asset('public/uploads/media/'.$blog->featured_image) : '' }}">
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


