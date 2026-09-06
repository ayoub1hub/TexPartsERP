<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            width: 100%;
            margin-bottom: 30px;
        }

        .company {
            float: left;
        }

        .invoice-info {
            float: right;
            text-align: right;
        }

        .clear {
            clear: both;
        }

        h1 {
            margin: 0;
            font-size: 26px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #eeeeee;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .text-right {
            text-align: right;
        }

        .totals {
            width: 40%;
            margin-left: auto;
            margin-top: 20px;
        }

        .totals td {
            padding: 8px;
        }

        .total {
            font-weight: bold;
            font-size: 15px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="header">

        <div class="company">
            <h1>TexPartsERP</h1>
            <p>Gestion commerciale</p>
        </div>

        <div class="invoice-info">
            <h1>FACTURE</h1>

            <p>
                <strong>N° :</strong>
                {{ $invoice->invoice_number }}
            </p>

            <p>
                <strong>Date :</strong>
                {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}
            </p>

            <p>
                <strong>Statut :</strong>
                {{ $invoice->status }}
            </p>
        </div>

        <div class="clear"></div>
    </div>


    <h3>Client</h3>

    <p>
        <strong>{{ $invoice->client->name }}</strong>
    </p>

    @if($invoice->client->email)
        <p>Email : {{ $invoice->client->email }}</p>
    @endif

    @if($invoice->client->phone)
        <p>Téléphone : {{ $invoice->client->phone }}</p>
    @endif

    @if($invoice->client->address)
        <p>Adresse : {{ $invoice->client->address }}</p>
    @endif


    <table>

        <thead>
            <tr>
                <th>Produit</th>
                <th>Référence</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

            @foreach($invoice->items as $item)

                <tr>

                    <td>
                        {{ $item->product->name }}
                    </td>

                    <td>
                        {{ $item->product->reference }}
                    </td>

                    <td>
                        {{ $item->quantity }}
                    </td>

                    <td>
                        {{ number_format($item->unit_price, 2, ',', ' ') }} DH
                    </td>

                    <td>
                        {{ number_format($item->total, 2, ',', ' ') }} DH
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>


    <table class="totals">

        <tr>
            <td>Sous-total HT</td>
            <td class="text-right">
                {{ number_format($invoice->amount / 1.20, 2, ',', ' ') }} DH
            </td>
        </tr>

        <tr>
            <td>TVA (20%)</td>
            <td class="text-right">
                {{ number_format($invoice->amount - ($invoice->amount / 1.20), 2, ',', ' ') }} DH
            </td>
        </tr>

        <tr class="total">
            <td>Total TTC</td>
            <td class="text-right">
                {{ number_format($invoice->amount, 2, ',', ' ') }} DH
            </td>
        </tr>

    </table>


    <div class="footer">
        <p>Merci pour votre confiance.</p>
        <p>TexPartsERP — Gestion commerciale</p>
    </div>

</body>
</html>