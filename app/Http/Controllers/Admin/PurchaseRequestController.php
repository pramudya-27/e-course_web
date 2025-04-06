<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $requests = PurchaseRequest::with(['user', 'course'])->get();
        return view('admin.purchase_requests.index', compact('requests'));
    }

    public function approve(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Permintaan pembelian disetujui.');
    }

    public function reject(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Permintaan pembelian ditolak.');
    }
}