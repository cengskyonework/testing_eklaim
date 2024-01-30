@extends('layouts.app')

<style>
    .table-container {
        max-height: 70vh;
        overflow-y: auto;
        margin-top: 10px;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="validate" autocomplete="off" action="{{ url('bulkpembayaran') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <h5 class="card-title panel-title">DATA KLAIM</h5>

                                <input type="text" class="ml-auto inline form-control" id="inputss"
                                    onkeyup='searchTable()' placeholder=" Search" title="Type in a name"
                                    style="font-size: 17px; margin-top: -15px;">
                                <div class="table-responsive table-container">
                                    <table class="table table-bordered" id="tabless" width="100%">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="all_check"></th>
                                                <th>ID Claim</th>
                                                <th>No Verifikasi</th>
                                                <th>Distributor</th>
                                                <th>No Surat Claim Distributor</th>
                                                <th>No Rekening Distributor</th>
                                                <th>Cost Center</th>
                                                <th>No AP</th>
                                                <th>Nilai Klaim</th>
                                                <th>Total Realisasi</th>
                                                <th>Note Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($claim as $claim)
                                                @if (($claim->flag_acc > 4 && $claim->status == 'B') || ($claim->flag_acc > 4 && $claim->status == 'P'))
                                                    <?php $nomer = 1; ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="ids[]"
                                                                value="{{ $claim->id }}" id="ceklisitem">
                                                        </td>
                                                        <td>{{ $claim->id }}
                                                            <input type="hidden" class="form-control" name="idd"
                                                                value="{{ $claim->distributor_id }}">
                                                        </td>
                                                        <td class="nomer">{{ $claim->nomor }}</td>
                                                        <td>{{ $claim->distributor_name->name }}
                                                        </td>
                                                        <td>{{ $claim->surat_jalan }}</td>
                                                        <td>{{ $claim->bank_name->nama_bank }} <br>
                                                            {{ $claim->no_rek . ' (' . $claim->nama_rek . ')' }}</td>
                                                        <td>{{ $claim->cost_name->cost_number }}
                                                        </td>
                                                        <td>{{ $claim->no_ap }}
                                                        </td>
                                                        <td>{{ 'Rp. ' . decimalPlace($claim->nominal) }}
                                                        </td>
                                                        <td>{{ 'Rp. ' . decimalPlace($claim->dpp + $claim->ppn - $claim->pph) }}
                                                        </td>
                                                        <td>
                                                            <textarea name="ApprovalNote[]" rows="2" class="form-control" style="width: 300px"></textarea>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><br>
                            <div class="col-md-12 mt-2">
                                <div id="results">

                                    <br>
                                    <h5 class="card-title panel-title">CHECK LIST</h5>
                                    <hr>
                                    <div class="table-responsive table-container">
                                        <table class="table table-bordered" id="tabless2">
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for=""> Note Approval Bulk</label>
                                    <textarea name="ApprovalNotes" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for=""> Tanggal Pembayaran</label>
                                    <input type="date" class="form-control" name="pay_date">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Status </label>
                                    <select name="ApprovalSts" class="form-control select2" required>
                                        <option></option>
                                        <option value="1">Dibayarkan</option>
                                        <option value="2">Tidak Dibayarkan</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>
@endsection
<style>
    table {
        width: 100%
    }

    .field_wrapper {
        width: 100%
    }
</style>
@section('js-script')
    <script type="text/javascript">
        $('.float-nominal').mask('000,000,000.00', {
            reverse: true
        });
        $('.total').mask('000,000,000.00', {
            reverse: true
        });
        $('.qty').mask('000,000', {
            reverse: true
        });
        $('.norek').mask('000.000.000.000.000.000', {
            reverse: true
        });

        $('input[name=all_check]').on('change', function() {
            if ($(this).attr('checked')) {
                $(this).attr('checked', false);
                $("input[name='ids[]']").attr("checked", false);
            } else {
                $(this).attr("checked", true);
                $("input[name='ids[]']").attr("checked", true);
            }
        });


        $(document).ready(function() {

            $(document).on("blur", ".float-nominal", function() {
                var sum = 0;
                $(".float-nominal").each(function() {
                    var num = $(this).val();
                    sum += +num.replace(/,/g, '');
                });
                $(".total").val(sum);
            })
        });

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
            tbody = document.getElementsByTagName("tbody")[0];;
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
                var isChecked = row.cells[0].querySelector('#ceklisitem')
                    .checked;
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
                    var key = keys[i];
                    var cell = newRow.insertCell();
                    cell.textContent = result[key];
                }
            });



        }
    </script>
@endsection
