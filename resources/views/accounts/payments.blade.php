@extends('layouts.app')
@section('title', 'Payments - SU30+')
@section('content')
<div class="content">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="row">
        <div class="col-sm-4 col-3"><h4 class="page-title">Payments</h4></div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="#" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Payment</a>
        </div>
    </div>
    <div class="row"><div class="col-md-12"><div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead><tr><th>#</th><th>Invoice</th><th>Method</th><th>Amount</th><th>Date</th><th>Reference</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($payments as $pay)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pay->invoice->invoice_number ?? 'N/A' }}</td>
                    <td>{{ ucfirst($pay->payment_method) }}</td>
                    <td>${{ number_format($pay->amount, 2) }}</td>
                    <td>{{ $pay->payment_date?->format('M d, Y') }}</td>
                    <td>{{ $pay->reference_number ?? '-' }}</td>
                    <td><span class="badge badge-{{ $pay->status=='completed'?'success':'warning' }}">{{ ucfirst($pay->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">No payments found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div></div></div>
</div>

<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('accounts.payments.store') }}" method="POST">@csrf
        <div class="modal-header"><h5>Add Payment</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
            <div class="form-group"><label>Invoice ID *</label><input class="form-control" name="invoice_id" required></div>
            <div class="form-group"><label>Method *</label><select class="form-control" name="payment_method" required><option value="cash">Cash</option><option value="card">Card</option><option value="transfer">Transfer</option></select></div>
            <div class="form-group"><label>Amount *</label><input class="form-control" type="number" step="0.01" name="amount" required></div>
            <div class="form-group"><label>Date *</label><input class="form-control" type="date" name="payment_date" required></div>
            <div class="form-group"><label>Reference Number</label><input class="form-control" name="reference_number"></div>
            <div class="form-group"><label>Status *</label><select class="form-control" name="status" required><option value="pending">Pending</option><option value="completed">Completed</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Add</button></div>
    </form>
</div></div></div>
@endsection
