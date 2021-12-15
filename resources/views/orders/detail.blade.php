@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Order d</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" id="dataOrders">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Qty</th>
                                <th>Price</th>

                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td>{{ $item->menu }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->price }}</td>

                                    <td><button class="btn btn-primary">Selesai</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
