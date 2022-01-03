@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-sm-12">
            <div class="card" style="box-shadow:2px 2px 2px 2px silver;">
                <div class="card-body">
                    <div>
                        <div class="col-sm-4 mb-4">
                            <div class="btn-group">
                                <a href="{{ route('order.index') }}" class="btn btn-primary btn-lg"><i class="fas fa-chevron-circle-left me-1"></i>Back</a>
                                @if($order->status == 1)
                                    <a href="{{ route('order.index') }}" class="btn btn-secondary btn-lg"><i class="fas fa-check-circle me-1"></i>Check</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header header-color text-white" style="padding-left: 8px !important; font-weight:bold;">
                                Nomor Order : <span class="header-data">{{ $order->id }}</span><br/>
                                Tanggal Order : <span class="header-data">{{ $order->created_at->isoFormat('YYYY-MM-DD hh:mm:ss') }}</span><br/>
                                {{ $order->statusMaster->name }}
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header card-header-color text-white">
                                <span class="header-data">Table or Room</span>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" width="100%" id="dataOrders">
                                    <tbody>
                                        @foreach ($order->table as $item)
                                            <tr>
                                                <td>{{ $item->table->nomor_meja }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header card-header-color text-white">
                                <span class="header-data">Detail order</span>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" width="100%" id="dataOrders">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($order->detail as $item)
                                            @php
                                                $total = ($item->qty * $item->price) + $total;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->menu }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>Rp. {{ number_format($item->price) }}</td>
                                                <td>Rp. {{ number_format(($item->qty * $item->price)) }}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan="2"></td>
                                                <td style="background-color:silver;">Total : </td>
                                                <td style="background-color:silver;">Rp. {{ number_format($total) }}</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
