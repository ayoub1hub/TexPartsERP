<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon d'achat {{ $documentNumber }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #17211b; font-size: 12px; }
        h1 { color: #176b45; margin-bottom: 4px; }
        .muted { color: #65736b; }
        .box { border: 1px solid #cbd5cf; padding: 12px; margin: 18px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 22px; }
        th, td { border: 1px solid #cbd5cf; padding: 9px; text-align: left; }
        th { background: #eaf5ee; }
        .total { text-align: right; font-size: 15px; font-weight: bold; margin-top: 18px; }
    </style>
</head>
<body>
    <h1>Bon d'achat</h1>
    <div class="muted">Document {{ $documentNumber }} | Date : {{ $entry->entry_date }}</div>

    <div class="box">
        <strong>Fournisseur</strong><br>
        {{ $supplier->name }}<br>
        {{ $supplier->email ?? '' }}<br>
        {{ $supplier->phone ?? '' }}<br>
        {{ $supplier->address ?? '' }}
    </div>

    <table>
        <thead><tr><th>Produit</th><th>Référence</th><th>Quantité</th><th>Prix unitaire</th><th>Total</th></tr></thead>
        <tbody><tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->reference }}</td>
            <td>{{ $entry->quantity }}</td>
            <td>{{ number_format($entry->purchase_price, 2, ',', ' ') }} DH</td>
            <td>{{ number_format($entry->quantity * $entry->purchase_price, 2, ',', ' ') }} DH</td>
        </tr></tbody>
    </table>

    <p>Référence achat : {{ $entry->reference ?? '-' }}</p>
    <p><strong>Quantité totale reçue :</strong> {{ $entry->quantity }}</p>
    <p class="total">
        Total achat : {{ number_format($entry->quantity * $entry->purchase_price, 2, ',', ' ') }} DH
    </p>
    <p class="muted">Enregistré par : {{ $user->name }}</p>
</body>
</html>