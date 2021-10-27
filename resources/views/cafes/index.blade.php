@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Profile Cafe</span>
                    <div class="btn-group float-end">
                        <button class="btn btn-sm btn-light" id="addBtnCafe"><i class="fas fa-plus-square me-1"></i> Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" id="dataCafe">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tagline</th>
                                <th>Alamat</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
