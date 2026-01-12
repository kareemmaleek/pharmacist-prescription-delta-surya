<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-xl {
            font-size: 20px;
        }

        .text-sm {
            font-size: 12px;
        }

        .text-xs {
            font-size: 10px;
        }

        .font-bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .tracking-widest {
            letter-spacing: 0.1em;
        }

        hr {
            margin: 10px 0;
            border: none;
            border-top: 1px solid #000;
        }

        .my-3 {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .py-2 {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }

        .table-bordered {
            border: 1px solid #000;
        }

        .border-b {
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center text-xl font-bold uppercase tracking-widest">RECEIPT</h1>
        <h3 class="text-center">{{ $tx->tx_code }}</h3>
        <h3 class="text-center text-xs">{{ $tx->created_at->format('d-m-Y h:i:s A') }}</h3>
        <hr>

        <div class="my-3">
            <table>
                <tbody>
                    <tr class="text-xs">
                        <th class="text-left">Patient</th>
                        <td class="text-left">
                            {{ $tx->examination->patient->patient_code . ' | ' . $tx->examination->patient->fullname }}
                        </td>
                    </tr>
                    <tr class="text-xs">
                        <th class="text-left">Examination Code</th>
                        <td class="text-left">{{ $tx->examination->examination_code }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-bordered my-3">
            <table>
                <thead>
                    <tr class="border-b">
                        <th class="text-left">Item</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Unit Price</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($tx->examination->medicine_prescription_data['data'] as $medicine)
                        <tr class="text-xs">
                            <td>{{ $medicine['name'] }}</td>
                            <td class="text-center">{{ $medicine['qty'] }}</td>
                            <td class="text-right">{{ Number::currency($medicine['unit_price'], precision: 0) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="table-bordered my-3">
            <table>
                <tbody>
                    <tr class="text-right text-xs">
                        <th>Subtotal: </th>
                        <td>{{ Number::currency($tx->payment_total, precision: 0) }}</td>
                    </tr>
                    <tr class="text-right text-xs">
                        <th>Pay Method: </th>
                        <td class="uppercase">{{ $tx->payment_method }}</td>
                    </tr>
                    <tr class="text-right text-xs">
                        <th>Pay Amount: </th>
                        <td>{{ Number::currency($tx->payment_amount, precision: 0) }}</td>
                    </tr>

                    <tr class="text-right text-xs">
                        <th>Change: </th>
                        <td>{{ Number::currency($tx->payment_change, precision: 0) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="py-2 text-center text-xl uppercase tracking-widest">
            <span>Thank you</span>
        </div>

        <div class="text-center text-sm uppercase">
            <span>have a nice day!</span>
        </div>
    </div>
</body>

</html>
