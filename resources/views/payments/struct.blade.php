<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('struct/style.css') }}">
        <title>Receipt example</title>
    </head>
    <body onload=" window.print();">
        <div class="ticket">
            <img src="{{ asset('struct/logo.png') }}" alt="Logo"  width="50%">
            <p class="centered">
                <br>Taman Banten Lestari e2d No.55
                <br>Serang Banten</p>
            <table>
                <thead>
                    <tr>
                        <th colspan="4" style="text-align: left !important;">TNumber: {{ $order->tnumber }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: left !important;" class="quantity">Q.</th>
                        <th style="text-align: left !important;" class="description">Description</th>
                        <th style="text-align: right !important;" class="price">Price</th>
                        <th style="text-align: right !important;" class="price">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0
                    @endphp
                    @foreach ($order->detail as $item)
                        @php

                        @endphp
                        <tr>
                            <td class="quantity">{{ $item->qty }}</td>
                            <td class="description">{{ $item->menu }}</td>
                            <td style="text-align: right !important;"  class="price">{{ number_format($item->price) }}</td>
                            <td style="text-align: right !important;"  class="price">{{ number_format($item->price * $item->qty) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align: right;">Total: </td>
                        <td style="text-align: right;">Rp. {{ number_format($order->total_price) }}</td>
                    </tr>
                </tbody>
            </table>
            <p class="centered">Thanks for your purchase!
                <br>selaicoding.com made with &#10084;</p>
        </div>
        <script src="{{ asset('struct/script.js') }}"></script>
    </body>
</html>
