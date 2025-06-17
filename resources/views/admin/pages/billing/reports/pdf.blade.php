<!DOCTYPE html>
<html>
<head>
    <title>Financial Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .period { font-size: 16px; color: #555; }
        .summary-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .summary-table th, .summary-table td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        .summary-table th { background-color: #f5f5f5; }
        .positive { color: green; }
        .negative { color: red; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Financial Report</h1>
        <div class="period">
            {{ $start_date }} to {{ $end_date }}
        </div>
    </div>
    
    <table class="summary-table">
        <thead>
            <tr>
                <th>Metric</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Revenue</td>
                <td>${{ number_format($total_revenue, 2) }}</td>
            </tr>
            <tr>
                <td>Total Expenses</td>
                <td>${{ number_format($total_expenses, 2) }}</td>
            </tr>
            <tr>
                <td>Net Profit</td>
                <td class="{{ $net_profit >= 0 ? 'positive' : 'negative' }}">
                    ${{ number_format($net_profit, 2) }}
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Generated on {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>
</body>
</html>