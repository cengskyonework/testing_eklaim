@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('Products') }}</span>
				<a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#importExcel">Import</a>
				<button class="btn btn-success btn-sm float-right ajax-modal" data-title="{{ _lang('Add Products') }}" data-href="{{ route('produk.create') }}">{{ _lang('Add New') }}</button>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Kode') }}</th>
					<th>{{ _lang('Nama') }}</th>
					<th>{{ _lang('Category') }}</th>
					<th>{{ _lang('Status') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($produk as $produk)
				  <tr id="row_{{ $produk->id }}">
					<td class='name'>{{ $produk->kode }}</td>
					<td class='name'>{{ $produk->nama }}</td>
					<td class='name'>{{ $produk->category }}</td>
					<td class='status'>@if ($produk->status == 1) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">InActive</span> @endif</td>
					<td class="text-center">
					  <form action="{{ action('ProdukController@destroy', $produk['id']) }}" method="post">
						<button data-href="{{ action('ProdukController@edit', $produk['id']) }}" data-title="{{ _lang('Update Products') }}" class="btn btn-warning btn-xs ajax-modal">{{ _lang('Edit') }}</button>
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

<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<form method="post" action="import" enctype="multipart/form-data">
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


