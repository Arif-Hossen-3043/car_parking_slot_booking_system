@extends('layouts.admin')

@section('content')
<style>
    /* Dashboard Container */
    .dashboard-container {
        width: 100%;
        padding: 10px;
    }

    /* Card Grid */
    .stats-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .stats-card {
        flex: 1 1 calc(33.333% - 15px);
        background: #007bff;
        color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        min-width: 200px;
        text-align: center;
    }

    .stats-card.success { background: #28a745; }
    .stats-card.warning { background: #ffc107; }

    /* Make responsive */
    @media (max-width: 768px) {
        .stats-card {
            flex: 1 1 100%;
        }
    }

    /* ===== Responsive Table ===== */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    table th {
        background: #343a40;
        color: white;
    }

    table tr:nth-child(even) {
        background: #f9f9f9;
    }

    /* Mobile card view */
    @media (max-width: 768px) {
        table thead {
            display: none; /* Hide table headers */
        }

        table, table tbody, table tr, table td {
            display: block;
            width: 100%;
        }

        table tr {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            background: #fff;
        }

        table td {
            text-align: left;
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        table td:last-child {
            border-bottom: none;
        }

        table td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            top: 10px;
            font-weight: bold;
            color: #333;
        }
    }
</style>

<div class="dashboard-container">
    <h1 class="mb-4">📊 Admin Dashboard</h1>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stats-card">
            <h5>👥 Total Users</h5>
            <h2>{{ $userCount }}</h2>
        </div>

        <div class="stats-card success">
            <h5>📅 Total Bookings</h5>
            <h2>{{ $bookingCount }}</h2>
        </div>

        <div class="stats-card warning">
            <h5>💰 Total Transactions</h5>
            <h2>{{ $transactionCount }}</h2>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card shadow mt-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">🧾 Recent Transactions for Booking</h5>
        </div>
        <div class="card-body p-0">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Booking ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td data-label="#"> {{ $transaction->id }} </td>
                            <td data-label="User"> {{ $transaction->user->name ?? 'N/A' }} </td>
                            <td data-label="Booking ID"> {{ $transaction->booking_id }} </td>
                            <td data-label="Amount"> ৳ {{ number_format($transaction->amount, 2) }} </td>
                            <td data-label="Status">
                                @if($transaction->is_approved)
                                    <span style="color: green; font-weight: bold;">Approved</span>
                                @else
                                    <span style="color: red; font-weight: bold;">Pending</span>
                                @endif
                            </td>
                            <td data-label="Date"> {{ $transaction->created_at->format('d M Y') }} </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:gray; padding:15px;">
                                No transactions yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
