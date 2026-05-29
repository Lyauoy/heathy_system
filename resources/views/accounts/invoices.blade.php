@extends('layouts.app')
@section('title', 'Invoices - SU30+')
@section('content')
<div class="content">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="row">
        <div class="col-sm-4 col-3"><h4 class="page-title">Invoices</h4></div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="#" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Create Invoice</a>
        </div>
    </div>
    <div class="row"><div class="col-md-12"><div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead><tr><th>#</th><th>Invoice No</th><th>Patient</th><th>Date</th><th>Total</th><th>Paid</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($invoices as $inv)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inv->invoice_number }}</td>
                    <td>{{ $inv->patient->user->name ?? 'N/A' }}</td>
                    <td>{{ $inv->invoice_date?->format('M d, Y') }}</td>
                    <td>${{ number_format($inv->total_amount, 2) }}</td>
                    <td>${{ number_format($inv->paid_amount, 2) }}</td>
                    <td><span class="badge badge-{{ $inv->status=='paid'?'success':($inv->status=='overdue'?'danger':'warning') }}">{{ ucfirst($inv->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">No invoices found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div></div></div>
</div>

<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('accounts.invoices.store') }}" method="POST">@csrf
        <div class="modal-header"><h5>Create Invoice</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
            <div class="form-group"><label>Patient ID *</label><input class="form-control" name="patient_id" required></div>
            <div class="form-group"><label>Invoice Number *</label><input class="form-control" name="invoice_number" required></div>
            <div class="form-group"><label>Date *</label><input class="form-control" type="date" name="invoice_date" required></div>
            <div class="form-group"><label>Total Amount *</label><input class="form-control" type="number" step="0.01" name="total_amount" required></div>
            <div class="form-group"><label>Paid Amount</label><input class="form-control" type="number" step="0.01" name="paid_amount" value="0"></div>
            <div class="form-group"><label>Due Date</label><input class="form-control" type="date" name="due_date"></div>
            <div class="form-group"><label>Status *</label><select class="form-control" name="status" required><option value="pending">Pending</option><option value="paid">Paid</option><option value="overdue">Overdue</option></select></div>
            <div class="form-group"><label>Description</label><textarea class="form-control" name="description" rows="2"></textarea></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Create</button></div>
    </form>
</div></div></div>
@endsection
