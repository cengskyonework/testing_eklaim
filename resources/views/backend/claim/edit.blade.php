@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title panel-title">{{ _lang('Update Data Klaim') }}</h4>
                    <form method="post" class="validate" autocomplete="off"
                        action="{{ action('ClaimController@update', $id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nomor Verifikasi') }}</label>
                                    @if (empty($spr->nomor))
                                        <input type="text" class="form-control" name="nomor" value="Automatic"
                                            Readonly="readonly">
                                    @else
                                        <input type="text" class="form-control" name="nomor"
                                            value="{{ $spr->nomor }}" Readonly="readonly">
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nama Distributor') }}</label>
                                    <select class="form-control select2" name="distributor_id" required>
                                        <option value="">== Pilih Distributor ==</option>
                                        {{ create_option('distributor', 'id', 'name', $spr->distributor_id) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('No Telp / HP') }}</label>
                                    <input type="text" class="form-control" name="hp" readonly="readonly"
                                        value="{{ $spr->distributor_name->name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Email') }}</label>
                                    <input type="text" class="form-control" name="email" readonly="readonly"
                                        value="{{ $spr->distributor_name->email }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('NPWP') }}</label>
                                    <input type="text" class="form-control" name="npwp" readonly="readonly"
                                        value="{{ $spr->distributor_name->npwp }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Periode Awal Surat Program') }}</label>
                                    <input type="text" class="form-control datepicker" style="background-color:white"
                                        readonly="readonly" name="periode_start" value="{{ $spr->periode_start }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Periode Akhir Surat Program') }}</label>
                                    <input type="text" class="form-control datepicker" style="background-color:white"
                                        readonly="readonly" name="periode_end" value="{{ $spr->periode_end }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('No Surat Claim Distributor') }}</label>
                                    <input type="text" class="form-control" name="surat_jalan"
                                        value="{{ $spr->surat_jalan }}">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Alamat Distributor') }}</label>
                                    <textarea class="form-control" readonly="readonly" id="txtArea" name="address">{{ $spr->distributor_name->address }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Jenis Klaim') }}</label>
                                    <select class="form-control select2" name="category_id" required>
                                        <option value="">== Pilih Kategori ==</option>
                                        {{ create_option('category', 'id', 'name', $spr->category_id) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nama Program') }}</label>
                                    <select class="form-control select2" name="promo_idx" required>
                                        <option value="">== Pilih Program ==</option>
                                        {{ create_option('promo', 'id', 'name', $spr->promo_idx) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Wilayah Program') }}</label>
                                    <input type="text" class="form-control" name="wilayah" readonly="readonly"
                                        value="{{ $spr->promox['description'] }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Region / Area') }}</label>
                                    <select class="form-control select2" id="region_id" name="region_id" required>
                                        <option value="">== Pilih Area ==</option>
                                        {{ create_option('region', 'id', 'region_city', $spr->region_id) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nama Bank Distributor') }}</label>
                                    <select class="form-control select" name="bank_id" required>
                                        <option value="">== Pilih Bank ==</option>
                                        {{ create_option('bank', 'id', 'nama_bank', $spr->bank_id) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('No Rekening') }}</label>
                                    <input type="text" class="form-control norek" name="no_rek"
                                        value="{{ $spr->no_rek }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nama Rekening') }}</label>
                                    <input type="text" class="form-control" name="nama_rek"
                                        value="{{ $spr->nama_rek }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Metode Klaim') }}</label>
                                    <select class="form-control select2" name="payment_method" disabled>
                                        <option value=""></option>
                                        <option value="0" {{ $spr->payment_method == 0 ? 'selected' : '' }}>
                                            {{ _lang('Detail') }}</option>
                                        <option value="1" {{ $spr->payment_method == 1 ? 'selected' : '' }}>
                                            {{ _lang('Gabungan') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Cost Center') }}</label>
                                    <select class="form-control select2" name="cost_id" id="cost_id">
                                        <option value="">== Pilih Cost Center ==</option>
                                        {{ create_option('v_costcenter2', 'id', 'name', $spr->cost_id) }}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="field_wrapper" id="formdp">

                                        <table class="display table-head-bg-primary datatables" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="60%">Nama Produk</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="10%">Satuan</th>
                                                    <th width="20%">Nilai Klaim (Rp)</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produk as $item)
                                                    <tr>
                                                        <td>
                                                            <select name="produk_id[]" class="form-control select2"
                                                                autofocus required>
                                                                {{ create_option('produk', 'id', 'nama', $item->produk_id) }}
                                                            </select>
                                                        </td>
                                                        <td><input type="text" class="form-control qty" name="qty[]"
                                                                value="{{ $item->qty }}"></td>
                                                        <td><input type="text" class="form-control" name="satuan[]"
                                                                value="{{ $item->satuan }}" readonly></td>
                                                        <td><input type="text" class="form-control float-nominal"
                                                                name="nilai[]"
                                                                value="{{ number_format($item->nilai, 2) }}"></td>
                                                        <td><a href="javascript:void(0);"
                                                                class="remove_button btn btn-danger"><i
                                                                    class="mdi mdi-minus"></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="btn btn-success btn-md" id="add_button"><i
                                                class="mdi mdi-plus"></i></a>
                                    </div>
                                </div>
                            </div><br>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label
                                        class="control-label">{{ _lang('Total Claim') . ' (' . currency() . ')' }}</label>
                                    <input type="text" class="form-control total" data-mask="000,000,000.00"
                                        name="nominal" value="{{ number_format($spr->nominal, 2) }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Subject / Judul Email') }}</label>
                                    <input type="text" class="form-control" name="judul_email"
                                        value="{{ $spr->judul_email }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nomor Surat Program') }}</label>
                                    <input type="text" class="form-control" name="no_surat"
                                        value="{{ $spr->no_surat }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Note Perubahan Admin') }}</label>
                                    <textarea class="form-control" id="txtArea" name="claim_admin_note">{{ $spr->note_admin_lagi }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">History Note Perubahan Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        <ol class="activity-feed">
                                            @foreach ($notes as $note)
                                                <li class="feed-item feed-item-success">
                                                    <table>
                                                        <tr>
                                                            <td width="5%">
                                                                @if (!empty($note->admin->profile_picture))
                                                                    <span>
                                                                        <img class="rounded-circle"
                                                                            src="{{ asset('public/uploads/profile/' . $note->admin->profile_picture) }}"
                                                                            width="40" height="40">
                                                                    </span>
                                                                @else
                                                                    <span>
                                                                        <img class="rounded-circle"
                                                                            src="{{ asset('public/images/avatar.png') }}"
                                                                            width="40" height="40">
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="text"><b
                                                                        style="color:blue">{{ $note->admin->name }}</b>&nbsp;<i>{{ date('d-m-Y H:i:s', strtotime($note->created_at)) }}</i></span><br>
                                                                <span class="text">{{ $note->claim_admin_note }}</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Nama Dokumen Yang Dikirim') }}</label>
                                    <input type="text" class="form-control" name="nama_document"
                                        value="{{ $spr->nama_document }}"
                                        placeholder="Silahkan Diisi sesuai Nama File yang dikirim">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="card-title ">{{ _lang('Data Kelengkapan Dokumen') }}</h4>

                                    <table class="display table-head-bg-primary datatables" width="100%">

                                        @foreach ($dokumen as $item)
                                            <tr>
                                                <td width="30%"> <input type="checkbox" name="document_id[]"
                                                        value="{{ $item->id }}"
                                                        {{ $inserted_fac->contains('document_id', $item->id) ? 'checked' : '' }}>{{ $item->name }}
                                                </td>
                                                <td width="70%"></td>
                                            </tr>
                                        @endforeach
                                        @php
                                            $unset_fac = $inserted_fac->whereNotIn('document_id', $dokumen->pluck('id'));
                                        @endphp
                                        @if ($unset_fac)
                                            @foreach ($unset_fac as $item)
                                                @if ($item->document_id)
                                                    <tr>
                                                        <td width="30%"><input type="checkbox" name="document_id[]"
                                                                value="{{ $item->document_id }}"
                                                                checked>{{ $item->nama->name }}}}</td>
                                                        <td width="70%"></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </table>

                                </div>
                            </div><br>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
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
        $('.qty').mask('000,000', {
            reverse: true
        });
        $('.float-field').mask('000,000,000.00', {
            reverse: true
        });
        $('.total').mask('000,000,000.00', {
            reverse: true
        });
        $('.float-nominal').mask('000,000,000.00', {
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

            $('select[name=promo_id]').change(function() {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('claim.get_data_chanel') }}',
                    method: 'GET',
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        $('#cost_id').empty();
                        $.each(response, function(id, name) {
                            $('#cost_id').append('<option value="' + id + '">' + name +
                                '</option>');
                        })
                    }
                })
            });
        });
        $(document).ready(function() {
            var payment = $('select[name=payment_method]').val();
            var maxField = 1000; //Input fields increment limitation
            var addButton = $('#add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper\

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
            $('.select2').select2();
        };

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
