@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title">
				<span class="panel-title">{{ _lang('Data Program') }}</span>
			    <a class="btn btn-success btn-sm float-right" href="{{ route('promo.create') }}">{{ _lang('Tambah') }}</a>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Nama Program') }}</th>
					<th>{{ _lang('Masa Berlaku') }}</th>
					<th>{{ _lang('Wilayah Program') }}</th>
					<th class="text-center">{{ _lang('Menu') }}</th>
				  </tr>
				</thead>
				<tbody>
				  @php $currency = currency() @endphp
				  @foreach($promo as $promo)
				  <tr id="row_{{ $promo->id }}">
					<td class='name'>{{ $promo->name }}</td>
					<td class='hp'>{{ $promo->start_date .' S/D '. $promo->end_date  }}</td>	
					<td class='wilayah'>{{ $promo->wilayah }}</td>
					<td class="text-center">
					    <div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  {{ _lang('Action') }}
						  </button>
						  <form action="{{ action('PromoController@destroy', $promo['id']) }}" method="post">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="DELETE">
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a href="{{ action('PromoController@edit', $promo['id']) }}" class="dropdown-item"><i class="mdi mdi-pencil"></i> {{ _lang('Edit') }}</a>
								<a href="{{ action('PromoController@show', $promo['id']) }}" class="dropdown-item"><i class="mdi mdi-eye"></i> {{ _lang('View') }}</a>
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

@endsection


