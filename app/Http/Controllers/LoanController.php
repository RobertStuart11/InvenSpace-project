<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnLoanRequest;
use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct(private LoanService $loans)
    {
    }

    public function store(StoreLoanRequest $request)
    {
        $this->loans->ajukan($request->user(), $request->validated());

        return redirect()->route('preview.loans')->with('status', 'Pengajuan peminjaman berhasil dikirim.');
    }

    public function approve(Request $request, Loan $loan)
    {
        $request->validate(['catatan_validator' => ['nullable', 'string', 'max:500']]);

        $this->loans->setujui($loan, $request->user(), $request->input('catatan_validator'));

        return back()->with('status', 'Peminjaman disetujui.');
    }

    public function reject(Request $request, Loan $loan)
    {
        $data = $request->validate(['catatan_validator' => ['required', 'string', 'max:500']]);

        $this->loans->tolak($loan, $request->user(), $data['catatan_validator']);

        return back()->with('status', 'Peminjaman ditolak.');
    }

    public function handover(Request $request, Loan $loan)
    {
        $this->loans->serahkan($loan, $request->user());

        return back()->with('status', 'Barang diserahkan kepada peminjam.');
    }

    public function receiveReturn(ReturnLoanRequest $request, Loan $loan)
    {
        $this->loans->kembalikan($loan, $request->user(), $request->validated('laporan', []));

        return back()->with('status', 'Pengembalian barang dicatat.');
    }
}