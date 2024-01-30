@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card no-export">
                <div class="card-body">
                    <form action="{{ route('claim.cetak_bulk') }}" target="_blank" method="post" id="formOpname">
                        @csrf
                        <h4 class="card-title">
                            <span class="panel-title">{{ _lang('Bulk Pembayaran Klaim') }}</span>
                            <a class="btn btn-success btn-sm float-right"
                                href="{{ route('bulkpembayaran.create') }}">{{ _lang('Create Bulk') }}</a>
                            </table>
                        </h4>
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('ID Bulk') }}</th>
                                    <th>{{ _lang('Tanggal Bulk') }}</th>
                                    <th class="text-center">{{ _lang('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $currency = currency() @endphp
                                @foreach ($claim as $claim)
                                    <tr id="row_{{ $claim->id }}">
                                        <td class='nomor'>{{ $claim->id }}</td>
                                        <td class='price'>{{ date('d-m-Y', strtotime($claim->created_at)) }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    {{ _lang('Action') }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ action('BulkPembayaranController@show', $claim['id']) }}"
                                                        class="dropdown-item"><i class="mdi mdi-eye"></i>
                                                        {{ _lang('View') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-script')
    <script type="text/javascript">
        $('input[name=all_check]').on('change', function() {
            if ($(this).attr('checked')) {
                $(this).attr('checked', false);
                $("input[name='ids[]']").attr("checked", false);
            } else {
                $(this).attr("checked", true);
                $("input[name='ids[]']").attr("checked", true);
            }
        });
    </script>
@endsection
