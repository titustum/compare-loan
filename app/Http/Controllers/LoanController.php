<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class LoanController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

     public function compare(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'period' => 'nullable|numeric|min:1',
            'period_unit' => 'nullable|in:months,years',
            'monthly_payment' => 'nullable|numeric|min:500',
        ]);

        $amount = (float) $request->input('amount');
        $period = (int) $request->input('period');
        $unit = $request->input('period_unit', 'months');
        $monthly = (float) $request->input('monthly_payment');

        // Normalize period to months
        $months = $unit === 'years' ? $period * 12 : $period;

        $bankList = Bank::where('min_amount', '<=', $amount)
            ->where(function ($q) use ($amount) {
                $q->whereNull('max_amount')
                ->orWhere('max_amount', '>=', $amount);
            })
            ->get();

        $bankResults = [];
        $saccoResults = [];

        foreach ($bankList as $bank) {
            $rate = $bank->annual_rate / 100 / 12;
            $n = $months ?? 0;

            if ($n > 0) {
                // Calculate EMI
                $emi = ($rate > 0)
                    ? ($amount * $rate * pow(1 + $rate, $n)) / (pow(1 + $rate, $n) - 1)
                    : $amount / $n;

                $total = $emi * $n;
                $interest = $total - $amount;

            } elseif ($monthly > 0 && $rate > 0) {
                // Reverse calculate months from EMI
                $n = log($monthly / ($monthly - $rate * $amount)) / log(1 + $rate);
                $emi = $monthly;
                $total = $emi * $n;
                $interest = $total - $amount;
            } else {
                continue;
            }

            $entry = (object)[
                'bank' => $bank,
                'rate' => $bank->annual_rate,
                'emi' => round($emi),
                'interest' => round($interest),
                'total' => round($total),
                'months' => round($n),
            ];

            if ($bank->type === 'bank') {
                $bankResults[] = $entry;
            } else {
                $saccoResults[] = $entry;
            }
        }

        $bankResults = collect($bankResults)->sortBy('emi')->values();
        $saccoResults = collect($saccoResults)->sortBy('emi')->values();

        return view('results2', [
            'amount' => $amount,
            'months' => $months,
            'monthly' => $monthly,
            'bankResults' => $bankResults,
            'saccoResults' => $saccoResults,
        ]);
    }

}

