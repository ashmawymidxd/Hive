<!DOCTYPE html>
<html>

<head>
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-header {
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h2>Hotel Name</h2>
        <p>123 Hotel Street<br>City, Country<br>Phone: (123) 456-7890</p>
    </div>

    <div class="invoice-details">
        <h3>Invoice #{{ $invoice->invoice_number }}</h3>
        <p>Issue Date: {{ $invoice->issue_date }}<br>
            Due Date: {{ $invoice->due_date }}<br>
            Status: {{ ucfirst($invoice->status) }}</p>
    </div>

    <div class="bill-to">
        <h4>Bill To:</h4>
        <p>{{ $invoice->guest->getFullNameAttribute() }}<br>
            Room {{ $invoice->room->room_number }}<br>
            {{ $invoice->guest->email }}<br>
            {{ $invoice->guest->phone }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Room {{ $invoice->room->room_number }} ({{ $invoice->room->type }})</td>
                <td>${{ number_format($invoice->amount, 2) }}</td>
            </tr>
            <tr>
                <td class="text-end"><strong>Total</strong></td>
                <td><strong>${{ number_format($invoice->amount, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    @if ($invoice->notes)
        <div class="notes">
            <h4>Notes:</h4>
            <p>{{ $invoice->notes }}</p>
        </div>
    @endif
</body>

</html>
