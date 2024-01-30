@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('List Feature') }}</span>
				<button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add Feature') }}" data-href="{{route('benefits.create')}}">{{ _lang('Add New') }}</button>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th>{{ _lang('Name') }}</th>
					<th class="text-center">{{ _lang('Action') }}</th>			
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($benefits as $benefit)
				  <tr id="row_{{ $benefit->id }}">
					<td class='name'>{{ $benefit->name }}</td>
					<td class="text-center">
					  <form action="{{ action('BenefitController@destroy', $benefit['id']) }}" method="post">
						<button data-href="{{ action('BenefitController@edit', $benefit['id']) }}" data-title="{{ _lang('Update Feature') }}" class="btn btn-warning btn-xs ajax-modal">{{ _lang('Edit') }}</button>
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


