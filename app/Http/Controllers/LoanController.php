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
        $period = $request->input('period');
        $unit = $request->input('period_unit', 'months');
        $monthly = (float) $request->input('monthly_payment');

        // Normalize period to months if given
        $months = $period ? ($unit === 'years' ? $period * 12 : $period) : null;

        $bankList = Bank::where('min_amount', '<=', $amount)
            ->where(function ($q) use ($amount) {
                $q->whereNull('max_amount')
                ->orWhere('max_amount', '>=', $amount);
            })
            ->get();

        $bankResults = [];
        $saccoResults = [];

        foreach ($bankList as $bank) {
            $rate = $bank->annual_rate / 100 / 12; // monthly interest rate

            if ($months && $months > 0) {
                $n = $months;

                $emi = ($rate > 0)
                    ? ($amount * $rate * pow(1 + $rate, $n)) / (pow(1 + $rate, $n) - 1)
                    : $amount / $n;

                $total = $emi * $n;
                $interest = $total - $amount;

            } elseif ($monthly > 0 && $rate > 0) {
                // Calculate months using reverse EMI formula
                $denominator = $monthly - $rate * $amount;

                if ($denominator <= 0) {
                    continue; // Invalid scenario, skip this bank
                }

                $n = log($monthly / $denominator) / log(1 + $rate);

                if ($n <= 0 || !is_finite($n)) {
                    continue; // Calculation failed
                }

                $emi = $monthly;
                $total = $emi * $n;
                $interest = $total - $amount;

            } else {
                continue; // Not enough input to calculate
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

        return view('results', [
            'amount' => $amount,
            'months' => $months, // this may be null if reverse calculated
            'monthly' => $monthly,
            'bankResults' => $bankResults,
            'saccoResults' => $saccoResults,
        ]);
    }


    /**
     * Display the repayment schedule for a specific bank.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
 
    public function schedule(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);

        $amount = $request->input('amount', 100000); // default amount
        $months = $request->input('months', 12);     // default period

        $schedule = $this->generateSchedule($bank, $amount, $months);

        return view('schedule', compact('bank', 'schedule', 'amount', 'months'));
    }




    /**
     * Generate the repayment schedule for a given bank.
     *
     * @param \App\Models\Bank $bank
     * @param float $amount
     * @param int $months
     * @return array
     */
    protected function generateSchedule(Bank $bank, float $amount = 100000, int $months = 12)
    {
        $rate = $bank->annual_rate / 100 / 12; // monthly interest rate
        $n = $months;

        if ($rate > 0) {
            // Calculate EMI (monthly payment)
            $emi = ($amount * $rate * pow(1 + $rate, $n)) / (pow(1 + $rate, $n) - 1);
        } else {
            $emi = $amount / $n;
        }

        $balance = $amount;
        $schedule = [];

        for ($i = 1; $i <= $n; $i++) {
            $interestPayment = $balance * $rate;
            $principalPayment = $emi - $interestPayment;
            $balance -= $principalPayment;

            $schedule[] = [
                'month' => $i,
                'principal' => round($principalPayment, 2),
                'interest' => round($interestPayment, 2),
                'total' => round($emi, 2),
                'balance' => round(max($balance, 0), 2),
            ];
        }

        return $schedule;
    }


}

