<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Expense;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display invoices listing.
     */
    public function invoices()
    {
        $invoices = Invoice::with('patient.user')->orderBy('invoice_date', 'desc')->get();
        return view('accounts.invoices', compact('invoices'));
    }

    /**
     * Store a new invoice.
     */
    public function storeInvoice(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'invoice_number' => 'required|string|unique:invoices',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Invoice::create($request->all());

        return redirect()->route('accounts.invoices')->with('success', 'Invoice created successfully!');
    }

    /**
     * Display payments listing.
     */
    public function payments()
    {
        $payments = Payment::with('invoice.patient.user')->orderBy('payment_date', 'desc')->get();
        return view('accounts.payments', compact('payments'));
    }

    /**
     * Store a new payment.
     */
    public function storePayment(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|string',
            'reference_number' => 'nullable|string',
        ]);

        Payment::create($request->all());

        return redirect()->route('accounts.payments')->with('success', 'Payment recorded successfully!');
    }

    /**
     * Display expenses listing.
     */
    public function expenses()
    {
        $expenses = Expense::orderBy('expense_date', 'desc')->get();
        return view('accounts.expenses', compact('expenses'));
    }

    /**
     * Store a new expense.
     */
    public function storeExpense(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Expense::create($request->all());

        return redirect()->route('accounts.expenses')->with('success', 'Expense added successfully!');
    }
}
