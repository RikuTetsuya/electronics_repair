
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice {{ $invoice->order_id }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                {{-- <img src="https://sparksuite.github.io/simple-html-invoice-template/images/logo.png"
                                    style="width: 100%; max-width: 300px" /> --}}
                                <img src="{{ asset('userpage/assets/img/VolTech_crop.png') }}" style="width: 30%; max-width: 300px" >
                            </td>

                            <td>
                                Invoice #: {{ $invoice->order_id }}<br />
                                Order Created:
                                {{ \Carbon\Carbon::parse($invoice->tanggal_masuk)->translatedFormat('d F Y') }}<br />
                                {{-- Due: February 1, 2023 --}}
                                @if ($invoice->status_payment === 'Unpaid')
                                    <span style="color: red;">Unpaid</span>
                                @else
                                    <span style="color: green;">Paid</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                VolTech, Inc.<br />
                                Baker Street Cluster Boston - 64, Puri Surya Jaya<br />
                                Sidoarjo, 61254
                            </td>

                            <td>
                                {{-- Acme Corp.<br /> --}}
                                {{ $invoice->name }}<br />
                                {{ $invoice->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Payment Method</td>
                <td>Service</td>
            </tr>

            <tr class="details">
                <td>
                    @if ($invoice->status_payment === 'Unpaid')
                        <span style="color: red;">Unpaid</span>
                    @elseif ($invoice->status_payment === 'Paid')
                        <span style="color: green;">e-Payment</span>
                    @elseif ($invoice->status_payment === 'Paid in Cash')
                        <span style="color: green;">Cash</span>
                    @endif
                </td>
                <td>{{ $invoice->nama_layanan }}</td>
            </tr>

            <tr class="heading">
                <td>Type of Service</td>

                <td>Cost</td>
            </tr>

            <tr class="item">
                <td>Service In</td>

                <td>Rp. {{ number_format($invoice->harga, 0, ',', '.') }},-</td>
            </tr>

            <tr class="item">
                <td>
                    Service Out
                    <br>
                    Details :
                    <li>Vendor Name : {{ $invoice->nama_mitra }}</li>
                    <li>Vendor Address : {{ $invoice->alamat_mitra }}</li>
                </td>

                <td>
                    @if ($invoice->perbaikan_pihak_ketiga == 1)
                        Rp. {{ number_format($invoice->biaya, 0, ',', '.') }},-
                    @elseif ($invoice->perbaikan_pihak_ketiga == 2)
                        -
                    @elseif ($invoice->perbaikan_pihak_ketiga == 0)
                        (waiting...)
                    @endif
                </td>
            </tr>

            {{-- <tr class="item last">
                <td>Domain name (1 year)</td>

                <td>$10.00</td>
            </tr> --}}

            <tr class="total">
                <td></td>

                <td>Total: Rp. {{ number_format($invoice->harga + $invoice->biaya, 0, ',', '.') }},-</td>
            </tr>
        </table>

        <a href="{{ url()->current() . '?output=pdf' }}">Download PDF</a>
        <a href="#" onclick="window.print()">Print</a>
    </div>
</body>

</html>
