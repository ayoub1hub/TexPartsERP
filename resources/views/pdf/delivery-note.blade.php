<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de livraison {{ $documentNumber }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #17211b; font-size: 12px; }
        h1 { color: #b42318; margin-bottom: 4px; }
        .muted { color: #65736b; }
        .box { border: 1px solid #cbd5cf; padding: 12px; margin: 18px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 22px; }
        th, td { border: 1px solid #cbd5cf; padding: 9px; text-align: left; }
        th { background: #fff1f0; }
        .total { text-align: right; font-size: 15px; font-weight: bold; margin-top: 18px; }
    </style>
</head>
<body>
    <h1>Bon de livraison</h1>
    <div class="muted">Document {{ $documentNumber }} | Date : {{ $exit->exit_date }}</div>

    <div class="box">
        <strong>Client / destination</strong><br>
        {{ $exit->reason ?? 'Sortie de stock' }}<br>
        Référence : {{ $exit->reference ?? '-' }}
    </div>

    <table>
        <thead><tr><th>Produit</th><th>Référence</th><th>Quantité</th><th>Prix unitaire</th><th>Total</th></tr></thead>
        <tbody><tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->reference }}</td>
            <td>{{ $exit->quantity }}</td>
            <td>{{ number_format($product->selling_price, 2, ',', ' ') }} DH</td>
            <td>{{ number_format($exit->quantity * $product->selling_price, 2, ',', ' ') }} DH</td>
        </tr></tbody>
    </table>

    <p><strong>Quantité totale livrée :</strong> {{ $exit->quantity }}</p>
    <p class="total">
        Total livraison : {{ number_format($exit->quantity * $product->selling_price, 2, ',', ' ') }} DH
    </p>
    <p class="muted">Document généré par : {{ $user->name }}</p>
</body>
</html>