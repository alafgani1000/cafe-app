@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-sm-12 mb-3">
            <form id="fMonthly" method="post" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-12">
                    <label class="visually-hidden" for="startDate">Start Date</label>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                </div>
                <div class="col-12">
                    <label class="visually-hidden" for="endDate">End Date</label>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="date" class="form-control" id="endDate" name="startDate">
                    </div>
                </div>
                <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row isi">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Orders</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive" width="100%" id="dataOrders">
                        <thead>
                            <tr>
                                <th>TNumber</th>
                                <th>Total Price</th>
                                <th>Menu</th>
                                <th>Date</th>
                                <th width="15%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('#fMonthly').on('submit', function(event){
                event.preventDefault();
                event.stopPropagation();
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                $("#dataOrders").DataTable().destroy()
                dataOrder = $('#dataOrders').DataTable({
                    'processing':true,
                    'serverSide':true,
                    'ajax':{
                        'url':'{{ route("report.view.data") }}',
                        'data':{
                            'startDate':startDate,
                            'endDate':endDate
                        }
                    },
                    'dom':'Bfrtip',
                    'buttons': [
                        'copy', 'csv', 'excel', 'pdf', 'print','pageLength'
                    ],
                    lengthMenu: [
                        [10, 25, 50, -1], [10, 25, 50, 'All']
                    ],
                    'columns':[
                        {'data':'tnumber'},
                        {'data':'total_price'},
                        {'data':'menu' },
                        {'data':'created_at'},
                        {'data':'id', render:function(data){
                            return '<div class="btn-group"><button class="btn btn-primary">Detail</button></div>'
                        }}
                    ]
                })
                console.log(dataOrder);

            $("#dataOrders_filter").addClass('float-end mb-2');
            $(".dt-buttons").css("margin-bottom","0 !important")
            $(".dt-buttons").addClass('float-start mb-0 pb-0');
            });
        })

    </script>
@endsection

