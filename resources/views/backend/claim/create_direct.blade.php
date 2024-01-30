@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title panel-title">{{ _lang('Form Klaim PT. NIRAMAS UTAMA') }}</h4>
                    <form method="post" class="validate" autocomplete="off" action="{{ url('claim') }}"
                        onsubmit="return confirm('Anda Yakin ?')" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nomor Verifikasi') }}</label>
                                    <input type="text" class="form-control" name="nomor" value="Automatic"
                                        Readonly="readonly">
                                </div>
                            </div>
                            @foreach ($ditributor as $distri)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Nama Distributor') }}</label>
                                        <input type="text" class="form-control" name="distributor_id"
                                            value="{{ $distri->id }}" hidden>
                                        <input type="text" class="form-control" name="namex" readonly="readonly"
                                            value="{{ $distri->name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('No Telp / HP') }}</label>
                                        <input type="text" class="form-control" name="hp"
                                            value="{{ $distri->hp }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Email') }}</label>
                                        <input type="text" class="form-control" name="email" readonly="readonly"
                                            value="{{ $distri->email }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('NPWP') }}</label>
                                        <input type="text" class="form-control" name="npwp" readonly="readonly"
                                            value="{{ $distri->npwp }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Periode Awal Surat Program') }}</label>
                                        <input type="text" class="form-control datepicker" style="background-color:white"
                                            readonly="readonly" name="periode_start" value="{{ old('periode_start') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Periode Akhir Surat Program') }}</label>
                                        <input type="text" class="form-control datepicker" style="background-color:white"
                                            readonly="readonly" name="periode_end" value="{{ old('periode_end') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('No Surat Claim Distributor') }}</label>
                                        <input type="text" class="form-control" name="surat_jalan"
                                            value="{{ old('surat_jalan') }}" required>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Alamat Distributor') }}</label>
                                        <textarea class="form-control" readonly="readonly" id="txtArea" name="address">{{ $distri->address }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Jenis Klaim') }}</label>
                                        <select class="form-control select2" name="category_id" required>
                                            <option value="">== Pilih Kategori ==</option>
                                            {{ create_option('v_category', 'id', 'name', old('category_id')) }}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Nama Program') }}</label> <select
                                            class="form-control select2" name="promo_idx" required>
                                            <option value="">== Pilih Program==</option>
                                            {{ create_option('v_promo', 'id', 'name', old('promo_idx')) }}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Wilayah Program') }}</label>
                                        <input type="text" class="form-control" name="wilayah" readonly="readonly"
                                            value="{{ old('wilayah') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Area (Kota)') }}</label>
                                        <select class="form-control select2" id="region_id" name="region_id" required>
                                            <option value="">== Pilih Area ==</option>
                                            {{ create_option('region', 'id', 'region_city', old('region_id')) }}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Nama Bank Distributor') }}</label>
                                        <select class="form-control select2" name="bank_id" required>
                                            <option value="">== Pilih Bank ==</option>
                                            {{ create_option('bank', 'id', 'nama_bank', $distri->bank_id) }}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('No Rekening') }}</label>
                                        <input type="text" class="form-control norek" name="no_rek"
                                            value="{{ $distri->no_rek }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Nama Rekening') }}</label>
                                        <input type="text" class="form-control" name="nama_rek"
                                            value="{{ $distri->nama_rek }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Metode Klaim') }}</label>
                                        <select class="form-control select2" name="payment_method" required>
                                            <option value=""></option>
                                            <option value="0">{{ _lang('Detail') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Cost Center') }}</label>
                                        <input type="text" class="form-control" name="xxxxxxx" readonly>
                                    </div>
                                </div>
                            @endforeach



                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="field_wrapper" id="formdp" style="display:none;">

                                        <table class="display table-head-bg-primary datatables" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="60%">Nama Produk</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="10%">Satuan</th>
                                                    <th width="20%">Nilai Klaim (Rp) (Exclude Ppn)</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="produk_id[]" class="form-control select2" autofocus
                                                            required>
                                                            <option value="">--Choose Products--
                                                                @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->nama }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control qty" name="qty[]"
                                                            value="0"></td>
                                                    <td><input type="text" class="form-control" name="satuan[]"
                                                            value="PCS" readonly></td>
                                                    <td><input type="text" class="form-control float-nominal"
                                                            name="nilai[]" value="0"></td>
                                                    <td><a href="javascript:void(0);" class="btn btn-success btn-md"
                                                            id="add_button"><i class="mdi mdi-plus"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><br>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        class="control-label">{{ _lang('Total Claim') . ' (' . currency() . ') Exclude Ppn' }}</label>
                                    <input type="text" class="form-control total" name="nominal"
                                        value="{{ old('nominal') }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Subject / Judul Email') }}</label>
                                    <input type="text" class="form-control" name="judul_email" value=""
                                        required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nomor Surat Program') }}</label>
                                    <input type="text" class="form-control" name="no_surat" value="" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nama Dokumen Yang Dikirim') }}</label>
                                    <input type="text" class="form-control" name="nama_document" value=""
                                        placeholder="Silahkan Diisi sesuai Nama File yang dikirim">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="card-title ">{{ _lang('Data Kelengkapan Dokumen') }}</h4>
                                    @foreach ($dokumen as $item)
                                        <table class="display table-head-bg-primary datatables" width="100%">
                                            <tr>
                                                <td width="30%"><input type="checkbox" name="document_id[]"
                                                        value="{{ $item->id }}">{{ $item->name }}</td>
                                            </tr>
                                        </table>
                                    @endforeach
                                </div>
                            </div><br>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
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
        $('.float-field').mask('000,000,000.00', {
            reverse: true
        });
        $('.total').mask('000,000,000.00', {
            reverse: true
        });
        $('.float-nominal').mask('000,000,000.00', {
            reverse: true
        });
        $('.qty').mask('000,000', {
            reverse: true
        });
        $('.norek').mask('000.000.000.000.000.000', {
            reverse: true
        });
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('select[name=promo_idx]').change(function() {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('claim.get_data_promo') }}',
                    method: 'GET',
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        $('input[name=wilayah]').val(response.wilayah);
                    },
                    error: function(err) {
                        showNotification('error', err.error.toString);
                    }
                })
            });
        });
        $(document).ready(function() {
            $('select[name=payment_method]').change(function() {

                var payment = $(this).val();
                var maxField = 1000;
                var addButton = $('#add_button');
                var wrapper = $('.field_wrapper');

                $("#formdp").show();
                var fieldHTML = '<tr>';
                fieldHTML = fieldHTML +
                    '<td width=60%><select name="produk_id[]" class="form-control select2" autofocus required> <option value="">--Choose Products-- @foreach ($products as $product) <option value="{{ $product->id }}">{{ $product->nama }}</option>@endforeach</select></td>';
                fieldHTML = fieldHTML +
                    '<td width=10%><input type="text" class="form-control qty"  name="qty[]" value="0"></td>';
                fieldHTML = fieldHTML +
                    '<td width=10%><input type="text" class="form-control" name="satuan[]" value="PCS" readonly></td>';
                if (payment == 0) {
                    fieldHTML = fieldHTML +
                        '<td width=20%><input type="text" class="form-control float-nominal"  name="nilai[]" value="0"></td>';
                } else {

                    fieldHTML = fieldHTML +
                        '<td width=20%><input type="text" class="form-control float-nominal"  name="nilai[]" value="0" readonly></td>';
                }
                fieldHTML = fieldHTML +
                    '<td width=10%><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="mdi mdi-minus"></i></a></td>';
                fieldHTML = fieldHTML + '</tr>';

                var x = 1;
                $(addButton).click(function() {
                    if (x < maxField) {
                        x++;
                        $(wrapper).append(fieldHTML);
                        initializeDatePicker();
                    }
                });
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('').parent('').remove();
                    x--;
                });

            });
        });
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('select[name=distributor_id]').change(function() {
                var id = $(this).val();
                //alert(id);

                $.ajax({
                    url: '{{ route('claim.get_data_customer') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        $('#txtArea').val(response.address);
                        $('input[name=id_no]').val(response.id_no);
                        $('input[name=npwp]').val(response.npwp);
                        $('input[name=hp]').val(response.hp);
                        $('input[name=email]').val(response.email);
                        $('select[name=bank_id]').val(response.bank_id);
                        $('input[name=no_rek]').val(response.no_rek);
                        $('input[name=nama_rek]').val(response.nama_rek);
                    },
                    error: function(err) {
                        showNotification('error', err.error.toString);
                    }
                })
            });

        });

        function initializeDatePicker() {
            $('.float-nominal').mask('000,000,000.00', {
                reverse: true
            });
            $('.float-angsuran').mask('000', {
                reverse: true
            });
            $('.qty').mask('000,000', {
                reverse: true
            });
            $('.select2').select2();
        };
        option value = "{{ $product->id }}" > {{ $product->nama }} < /option>/ ** * script_placeholder ** * /} / *
            ___directives_script_3___ * /</select > < /td>';
        fieldHTML = fieldHTML +
            '<td width=30%><input type="text" class="form-control float-nominal"  name="nominal[]" value="0"></td>';
        fieldHTML = fieldHTML +
            '<td width=10%><a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="mdi mdi-minus"></i></a></td>';
        fieldHTML = fieldHTML + '</tr>';
        var x = 1;
        $(addButton).click(function() {

            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML);
                initializeDatePicker();
            }
        });
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('').parent('').remove(); //Remove field html
            x--; //Decrement field counter
        });
        $(document).on("blur", ".float-nominal", function() {
            var sum = 0;
            $(".float-nominal").each(function() {
                var num = $(this).val();
                sum += +num.replace(/,/g, '');
            });
            var formattedSum = sum.toFixed(2);
            $(".total").val(formattedSum);
        });
    </script>
@endsection
