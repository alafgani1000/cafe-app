@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Orders</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8" style="border:1px solid silver; padding:10px 10px 10px 10px !important; box-shadow: 2px 1px 1px 1px silver;">
                            <form class="row g-3">
                                <div class="col-6">
                                    <label for="tnumber" class="visually-hidden">TNumber</label>
                                    <input type="text" class="form-control" id="tnumber" name="tnumber">
                                </div>
                                <div class="col-auto">
                                    <button id="searchBtn" type="button" class="btn btn-secondary mb-3">Search</button>
                                </div>

                                <div id="dataOrder">

                                </div>
                            </form>
                        </div>
                        <div class="col-md-4" style="border:1px solid silver; padding:10px 10px 10px 10px !important; box-shadow: 2px 1px 1px 1px silver;">
                            <div class="row mb-3">
                                <label for="bill" class="col-sm-3 col-form-label">Bill</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="bill" name="bill">
                                    <label id="billNumberFormat" style="padding-left: 12px;">

                                    </label>
                                </div>
                                <label>

                            </div>
                            <div class="row mb-3">
                                <label for="pay" class="col-sm-3 col-form-label">Pay</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="pay" name="pay">
                                    <label id="payNumberFormat" style="padding-left: 12px;">

                                    </label>
                                </div>
                                <label>

                            </div>
                            <div class="row mb-3">
                                <label for="change" class="col-sm-3 col-form-label">Change</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="change" name="change">
                                    <label id="changeNumberFormat" style="padding-left: 12px;"">

                                    </label>
                                </div>

                            </div>
                            <div class="row mb-3" style="padding: 10px 10px 10px 10px;">
                                <button type="button" class="btn btn-primary" id="paymentBtn">Bayar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('#searchBtn').on('click', function(){
                resetForm();

                let tnumber = $("#tnumber").val();
                let url = '{{ route("payment.detail", ":tnumber") }}';
                url = url.replace(':tnumber', tnumber);
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'html'
                }).done(function(response){
                    $('#dataOrder').html(response);
                });

                let rupiah = Intl.NumberFormat('en-ID');
                let url1 = '{{ route("payment.order", ":tnumber") }}';
                url1 = url1.replace(':tnumber', tnumber);
                $.ajax({
                    type: 'GET',
                    url: url1,
                    dataType: 'html'
                }).done(function(response){
                    $('#bill').val(response);
                    $('#billNumberFormat').text(rupiah.format(response));
                });
            });

            function resetForm()
            {
                $('#bill').val('');
                $('#pay').val('');
                $('#change').val('');
                $('#billNumberFormat').text('');
                $('#payNumberFormat').text('');
                $('#changeNumberFormat').text('');
            }

            $('#pay').on('input', function(){
                let rupiah = Intl.NumberFormat('en-ID');
                let valData = $(this).val();
                $('#payNumberFormat').text(rupiah.format(valData))
            });

            $('#paymentBtn').on('click', function(){

            });

            $('#pay').keypress(function(event){
                var keyCode = (event.keyCode ? event.keyCode : event.which);
                let rupiah = Intl.NumberFormat('en-ID');
                let pay = Number($(this).val());
                let bill = Number($('#bill').val());
                if(keyCode == 13){
                    if(bill === ''){
                        $('#payNumberFormat').text('bill not found');
                    } else if(bill > pay) {
                        $('#payNumberFormat').text('Uang kurang');
                    } else {
                        $('#change').val(pay-bill);
                        $('#changeNumberFormat').text(rupiah.format(pay-bill));
                    }
                }
            });
        });
    </script>
@endsection

