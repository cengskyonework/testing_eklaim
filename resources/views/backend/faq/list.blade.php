@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card no-export">
			<div class="card-body">
			 <h4 class="card-title"><span class="panel-title">{{ _lang('List FAQ') }}</span>
				<button class="btn btn-primary btn-sm float-right ajax-modal" data-title="{{ _lang('Add FAQ') }}" data-href="{{route('faqs.create')}}">{{ _lang('Add New') }}</button>
			 </h4>
			 <table class="table table-bordered data-table">
				<thead>
				  <tr>
					<th style="width:250px">{{ _lang('Question') }}</th>
					<th>{{ _lang('Answer') }}</th>
					<th class="text-center" style="width:180px">{{ _lang('Action') }}</th>
				  </tr>
				</thead>
				<tbody>
				  
				  @foreach($faqs as $faq)
				  <tr id="row_{{ $faq->id }}">
					<td class='question'>{{ $faq->question }}</td>
					<td class='answer'>{{ substr($faq->answer,0,50).' . . .' }}</td>

					<td class="text-center">
					  <form action="{{ action('FaqController@destroy', $faq['id']) }}" method="post">
						<button data-href="{{ action('FaqController@edit', $faq['id']) }}" data-title="{{ _lang('Update FAQ') }}" class="btn btn-warning btn-xs ajax-modal">{{ _lang('Edit') }}</button>
						<button data-href="{{ action('FaqController@show', $faq['id']) }}" data-title="{{ _lang('View FAQ') }}" class="btn btn-info btn-xs ajax-modal">{{ _lang('View') }}</button>
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


