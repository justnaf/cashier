<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order > Detail ' . $data->created_at->locale('id')->translatedFormat('l, d F Y')) }}
        </h2>
    </x-slot>
    <style>
        body {
            font-family: 'PT Sans', sans-serif;
        }

        @page {
            size: 2.8in 11in;
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
        }

        table {
            width: 100%;
        }

        tr {
            width: 100%;

        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        #logo {
            width: 60%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            padding: 5px;
            margin: 2px;
            display: block;
            margin: 0 auto;
        }

        header {
            width: 100%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            vertical-align: middle;
        }

        .items thead {
            text-align: center;
        }

        .center-align {
            text-align: center;
        }

        .bill-details td {
            font-size: 12px;
        }

        .receipt {
            font-size: medium;
        }

        .items .heading {
            font-size: 12.5px;
            text-transform: uppercase;
            border-top: 1px solid black;
            margin-bottom: 4px;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 47%;
            min-width: 47%;
            max-width: 47%;
            word-break: break-all;
            text-align: left;
        }

        .items td {
            font-size: 12px;
            text-align: right;
            vertical-align: bottom;
        }

        .price::before {
            font-family: Arial;
            text-align: right;
            font-size: 4px;
        }

        .sum-up {
            text-align: right !important;
        }

        .total {
            font-size: 13px;
            border-top: 1px dashed black !important;
            border-bottom: 1px dashed black !important;
        }

        .total.text,
        .total.price {
            text-align: right;
        }


        .line {
            border-top: 1px solid black !important;
        }

        .heading.rate {
            width: 20%;
        }

        .heading.amount {
            width: 25%;
        }

        .heading.qty {
            width: 5%
        }

        p {
            padding: 1px;
            margin: 0;
        }

        section,
        footer {
            font-size: 12px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg items-center">
                <div class="px-2 py-4">
                    <a href="{{ route('order.print', ['id' => $data->id]) }}"
                        class="bg-orange-500 text-white font-bold p-3 text-center rounded-md">Export PDF</a>
                    <div class="p-6" style="width: 80mm">
                        <header>
                            <div id="logo" class="media" data-src="logo.png" src="./logo.png"></div>

                        </header>
                        <p>Inv Number : INV-{{ $data->created_at->toDateString() . '-' . $data->id }}</p>
                        <table class="bill-details">
                            <tbody>
                                <tr>
                                    <td>Date : <span>{{ $data->created_at }}</span></td>
                                </tr>
                                <tr>
                                    <td>Buyer : <span>{{ $data->buyer }}</span></td>
                                    <td>Seller : <span>{{ $data->seller }}</span></td>
                                </tr>
                                <tr>
                                    <th class="center-align" colspan="2"><span class="receipt">Original
                                            Receipt</span>
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="items">
                            <thead>
                                <tr>
                                    <th class="heading name">Item</th>
                                    <th class="heading qty">Qty</th>
                                    <th class="heading amount">Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($data->orderdetail as $items)
                                    <tr>
                                        <td>{{ $items->produk }}</td>
                                        <td>{{ $items->qty }}</td>
                                        <td class="price">{{ number_format($items->subtotal, 0, 0, '.') }}</td>
                                    </tr>
                                    @php
                                        $total += $items->subtotal;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2" class="sum-up line">Subtotal</td>
                                    <td class="line price">{{ number_format($total, 0, 0, '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="sum-up">PPN</td>
                                    <td class="price">0.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="sum-up">Service</td>
                                    <td class="price">0.00</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="total text">Total</th>
                                    <th class="total price">{{ number_format($total, 0, 0, '.') }}</th>
                                </tr>
                            </tbody>
                        </table>
                        <section>
                            <p>
                                Paid by : <span>CASH</span>
                            </p>
                            <p style="text-align:center">
                                Thank you for your order!
                            </p>
                        </section>
                        <footer style="text-align:center">
                            <p>PPMT UNIMMA</p>
                            <p>www.kopigedhong.com</p>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
