@extends('layouts.app')
@section('title', 'Expenses - SU30+')
@section('content')
<div class="content">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="row">
        <div class="col-sm-4 col-3"><h4 class="page-title">Expenses</h4></div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="#" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Expense</a>
        </div>
    </div>
    <div class="row"><div class="col-md-12"><div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead><tr><th>#</th><th>Category</th><th>Description</th><th>Amount</th><th>Date</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($expenses as $exp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $exp->category }}</td>
                    <td>{{ Str::limit($exp->description, 40) }}</td>
                    <td>${{ number_format($exp->amount, 2) }}</td>
                    <td>{{ $exp->expense_date?->format('M d, Y') }}</td>
                    <td><span class="badge badge-{{ $exp->status=='approved'?'success':($exp->status=='rejected'?'danger':'warning') }}">{{ ucfirst($exp->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">No expenses found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div></div></div>
</div>

<div class="modal fade" id="addModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form action="{{ route('accounts.expenses.store') }}" method="POST">@csrf
        <div class="modal-header"><h5>Add Expense</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
            <div class="form-group"><label>Category *</label><input class="form-control" name="category" required></div>
            <div class="form-group"><label>Description</label><textarea class="form-control" name="description" rows="2"></textarea></div>
            <div class="form-group"><label>Amount *</label><input class="form-control" type="number" step="0.01" name="amount" required></div>
            <div class="form-group"><label>Date *</label><input class="form-control" type="date" name="expense_date" required></div>
            <div class="form-group"><label>Status *</label><select class="form-control" name="status" required><option value="pending">Pending</option><option value="approved">Approved</option><option value="rejected">Rejected</option></select></div>
            <div class="form-group"><label>Notes</label><textarea class="form-control" name="notes" rows="2"></textarea></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Add</button></div>
    </form>
</div></div></div>
@endsection
