@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Upload New Images') }}</span>
			 </h4>
			 <div class="border border-primary rounded">
			    <form method="POST" action="{{ url('property/upload_gallery_images') }}" class="validate mt-4" enctype="multipart/form-data">
				  {{ csrf_field()}}
				  <div class="col-12">
				    <div class="row">
					   <div class="col-md-9">
						 <div class="form-group">
							<input type="file" class="form-control" name="images[]" required="true" multiple>
						 </div>
					   </div>
					   <input type="hidden" name="property_id" value="{{ $property->id }}">
					   <div class="col-md-3">
						 <div class="form-group">
							<button type="submit" class="form-control btn btn-secondary"><i class="mdi mdi-cloud-upload"></i> {{ _lang('Upload') }}</button>
						 </div>
					   </div> 
                    </div>
                  </div>				   
				</form>
			 </div>
			 
			 <h4 class="card-title mt-4">
				<span class="panel-title">{{ _lang('Gallery Images for').' '.$property->name }}</span>
			 </h4>

			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th class='text-center'>{{ _lang('Image') }}</th>
					<th>{{ _lang('Created At') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @foreach($property->gallery as $gallery)
				  <tr id="row_{{ $property->id }}">
					<td class='image text-center'><img src="{{ asset('public/uploads/media/'.$gallery->image) }}" class="img-gallery"></td>
					<td class='created_at'>{{ $gallery->created_at }}</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a target="_blank" href="{{ asset('public/uploads/media/'.$gallery->image) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>
								<a href="{{ url('property/delete_gallery_image/'.$gallery->id) }}" class="btn-remove-2 dropdown-item"><i class="mdi mdi-delete"></i> {{ _lang('Delete') }}</a>
							</div>
						</div> 
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


