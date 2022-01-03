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
