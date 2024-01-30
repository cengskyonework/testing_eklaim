@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Data Cost Center') }}</span>
				<a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#importExcel">Import</a>
			    <a class="btn btn-success btn-sm float-right" href="{{ route('costcenter.create') }}">{{ _lang('Tambah') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Cost Center') }}</th>
					<th>{{ _lang('Name') }}</th>
					<th>{{ _lang('Kode') }}</th>
					<th>{{ _lang('Deskripsi Cost Center') }}</th>
					<th class="text-center">{{ _lang('Menu') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($costcenter as $costcenter)
				  <tr id="row_{{ $costcenter->id }}">
					<td class='cost_number'>{{ $costcenter->cost_number }}</td>
					<td class='hp'>{{ $costcenter->cost_name  }}</td>	
					<td class='hp'>{{ $costcenter->cost_code  }}</td>
					<td class='hp'>{{ $costcenter->chanel->chanel_name  }}</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
						  <form action="{{ action('CostCenterController@destroy', $costcenter['id']) }}" method="post">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="DELETE">
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('CostCenterController@edit', $costcenter['id']) }}" class="dropdown-item"><i class="mdi mdi-pencil"></i> {{ _lang('Edit') }}</a>
								<a href="{{ action('CostCenterController@show', $costcenter['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>
								@if(Auth::user()->user_type == 'admin')
									<button class="btn-remove dropdown-item" type="submit"><i class="mdi mdi-delete"></i> {{ _lang('Delete') }}</button>
								@endif
							</div>
						  </form>
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

<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<form method="post" action="import_excel" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Import Data Cost Center</h5>
				</div>
			<div class="modal-body">
			{{ csrf_field() }}
			<label>Pilih file excel</label>
				<div class="form-group">
					<input type="file" name="file" required="required">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			    <button type="submit" class="btn btn-primary">Import</button>
			</div>
			</div>
		</form>
    </div>
</div>
@endsection


