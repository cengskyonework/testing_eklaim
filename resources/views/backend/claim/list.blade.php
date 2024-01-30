@extends('layouts.app')

<style>
    .table-container {
        max-height: 60vh;
        overflow-y: auto;
        margin-top: 10px;
    }
</style>

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card no-export">
                <div class="card-body">
                    <form action="{{ route('claim.cetak_bulk') }}" target="_blank" method="post" id="formOpname">
                        @csrf
                        <h4 class="card-title">
                            <span class="panel-title">DATA KLAIM</span>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="80%"></td>
                                    @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'administrator')
                                        <td width="10%"><a class="btn btn-success btn-sm float-right"
                                                href="{{ route('claim.create') }}">Form Claim</a></td>
                                    @endif

                                    @if (Auth::user()->user_type != 'manager')
                                        <td width="10%"><button type="submit"
                                                class="btn btn-sm btn-primary float-right"><i class="fa fa-print"></i>Print
                                                Multiple</button></td>
                                    @endif
                                </tr>
                            </table>
                        </h4>
                        <div class="row">
                            <div class="col-2"><button type="button" class="btn btn-secondary mt-2"
                                    onclick="sortTable(0)"><i class="fa fa-arrows-v"></i>Ganti Urutan</button></div>
                            <div class="col-10">
                                <input type="text" class="ml-auto inline form-control" id="inputss"
                                    onkeyup='searchTable()' placeholder=" Search" title="Type in a name"
                                    style="font-size: 17px;">

                            </div>
                        </div>

                        <div class="table-responsive table-container data-table">
                            <table class="table table-bordered" data-page-length='-1' id="tabless">
                                <thead>
                                    <tr>
                                        </th>
                                        @if (Auth::user()->user_type != 'manager')
                                            <th><input type="checkbox" name="all_check"></th>
                                        @endif
                                        <th>Id Claim
                                        <th>No Verifikasi</th>
                                        <th>Distributor</th>
                                        <th>Kategori Klaim</th>
                                        <th>Nama Program</th>
                                        <th>Deskripsi Cost Center</th>
                                        <th>Region</th>
                                        <th>Cost Center</th>
                                        <th>No AP</th>
                                        <th>No Surat Claim Distributor</th>
                                        <th>Nilai Klaim</th>
                                        <th>Total Realisasi</th>
                                        <th>Status Klaim</th>
                                        <th>Tanggal Klaim</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $currency = currency() @endphp
                                    @foreach ($claim as $claim)
                                        <tr id="row_{{ $claim->id }}">
                                            @if (Auth::user()->user_type != 'manager')
                                                <td><input type="checkbox" name="ids[]" value="{{ $claim->id }}"
                                                        id="ceklisitem"></td>
                                            @endif
                                            <td>{{ $claim->id }}</td>


                                            <td>{{ $claim->nomor }}</td>
                                            <td>{{ $claim->distributor_name['name'] }}</td>
                                            <td>{{ $claim->cat_name['name'] }}</td>
                                            <td>{{ $claim->promox['name'] }}</td>
                                            <td>{{ $claim->promo->chanel_name }}</td>
                                            <td>{{ $claim->region_name->region_city }}</td>
                                            <td>{{ $claim->cost_name->cost_number }}</td>
                                            <td>

                                                @if (empty($claim->no_ap) && !empty($claim->nomor) && $claim->status != 'D')
                                                    @if (Auth::user()->user_type == 'accounting' || Auth::user()->user_type == 'admin')
                                                        <button class="btn btn-warning btn-sm float-center ajax-modal"
                                                            data-title="Input Nomor AP"
                                                            data-href="{{ action('ClaimController@input_ap', $claim->id) }}">Input
                                                            Nomor AP</button>
                                                    @endif
                                                @else
                                                    {{ $claim->no_ap }}
                                                    @if (auth::user()->user_type == 'admin')
                                                        <button class="btn btn-secondary btn-sm float-center ajax-modal"
                                                            data-title="Revisi Nomer AP"
                                                            data-href="{{ action('ClaimController@input_ap', $claim->id) }}">Revisi
                                                            Nomer AP</button>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $claim->surat_jalan }}</td>
                                            <td>{{ $currency . ' ' . decimalPlace($claim->nominal) }}</td>
                                            <td>{{ $currency . ' ' . decimalPlace($claim->dpp + $claim->ppn - $claim->pph) }}
                                            </td>
                                            @php
                                                $idx = $claim->id;
                                                $apprv = $app->where('claim_id', $idx);
                                            @endphp
                                            @if ($claim->internal_pend == 1)
                                                @if (Auth::user()->user_type != 'user')
                                                    <td class='status'><span class="badge badge-dark">Klaim
                                                            DiPending
                                                            Internal</span></td>
                                                @else
                                                    <td class='status'><span class="badge badge-primary">Menunggu
                                                            Konfirmasi /
                                                            Approval</span></td>
                                                @endif
                                            @else
                                                <td class='status'>{!! klaim_status($claim->status) !!}</td>
                                            @endif
                                            <td class='price'>
                                                {{ date('d-m-Y', strtotime($claim->created_at)) }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <form
                                                            action="{{ action('ClaimController@deleted', $claim['id']) }}"
                                                            method="post">
                                                            {{ csrf_field() }}
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            @if (Auth::user()->user_type != 'user')
                                                                @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'administrator')
                                                                    @if (empty($claim->nomor))
                                                                        <a href="{{ action('ClaimController@edit', $claim['id']) }}"
                                                                            class="dropdown-item"><i
                                                                                class="mdi mdi-pencil"></i>
                                                                            Edit</a>
                                                                    @endif
                                                                @endif
                                                                @if (!empty($claim->nomor))
                                                                    <a href="{{ action('ClaimController@cetak', $claim['id']) }}"
                                                                        target="_blank" class="dropdown-item"><i
                                                                            class="mdi mdi-printer"></i>Form
                                                                        Verifikasi</a>
                                                                    @if (Auth::user()->user_type == 'admin' ||
                                                                            Auth::user()->user_type == 'administrator' ||
                                                                            Auth::user()->user_type == 'accounting')
                                                                        <a href="{{ action('ClaimController@cetak_tt', $claim['id']) }}"
                                                                            target="_blank" class="dropdown-item"><i
                                                                                class="mdi mdi-printer"></i>Tanda
                                                                            Terima</a>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                            <a href="{{ action('ClaimController@show', $claim['id']) }}"
                                                                class="dropdown-item"><i class="mdi mdi-eye"></i>View</a>
                                                            @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'administrator')
                                                                <button class="btn-remove dropdown-item" type="submit"><i
                                                                        class="mdi mdi-delete"></i>Delete</button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div id="results">
                            <br>
                            <h5 class="card-title panel-title">CHECK LIST</h5>

                            <hr>
                            <div class="table-responsive table-container">
                                <table class="table table-bordered" id="tabless2" width="100%">
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <hr>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js-script')
    <script type="text/javascript">
        var selectedRows = [];

        $('input[name=all_check]').on('change', function() {
            if ($(this).attr('checked')) {
                $(this).attr('checked', false);
                $("input[name='ids[]']").attr("checked", false);
            } else {
                $(this).attr("checked", true);
                $("input[name='ids[]']").attr("checked", true);
            }
        });

        var checklistItems = document.querySelectorAll('#ceklisitem');
        checklistItems.forEach(function(item, index) {
            item.addEventListener('change', function() {
                showChecklistResults();
            });
        });

        function showChecklistResults() {
            var rows = document.getElementById('tabless').rows;
            var results = [];
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var isChecked = row.cells[0].querySelector('#ceklisitem').checked;
                if (isChecked) {
                    var result = {};
                    for (var j = 1; j < row.cells.length; j++) {
                        var content = row.cells[j].innerText.trim();
                        var cellHeader = document.getElementById('tabless').rows[0].cells[j].innerText.trim();
                        result[cellHeader] = content;
                    }
                    results.push(result);
                }
            }

            // Simpan hasil pemilihan ke variabel global
            selectedRows = results;

            var resultsContainer = document.getElementById('results');
            var tableBody = resultsContainer.querySelector('#tabless2 tbody');
            tableBody.innerHTML = '';
            var index = 1;
            results.forEach(function(result) {
                var newRow = tableBody.insertRow();
                var indexCell = newRow.insertCell();
                indexCell.textContent = index++;
                var keys = Object.keys(result);
                for (var i = 0; i < keys.length - 1; i++) {
                    if (i === 1) {
                        continue;
                    }

                    var key = keys[i];
                    var cell = newRow.insertCell();
                    cell.textContent = result[key];
                }
            });
        }


        function searchTable() {
            var input;
            var saring;
            var status;
            var tbody;
            var tr;
            var td;
            var i;
            var j;
            input = document.getElementById("inputss");
            saring = input.value.toUpperCase();
            tbody = document.getElementsByTagName("tbody")[1];;
            tr = tbody.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
                        status = true;
                    }
                }
                if (status) {
                    tr[i].style.display = "";
                    status = false;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("tabless");
            switching = true;
            dir = "asc"; // Setel arah default ke ascending

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < rows.length - 1; i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    if (dir === "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir === "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount === 0 && dir === "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
@endsection
