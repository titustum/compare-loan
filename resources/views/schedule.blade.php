<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Repayment Schedule for {{ $bank->name }}</h1>

    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-xl font-semibold mb-4">Loan Details</h2>
        <ul class="mb-8 text-gray-700 space-y-2">
            <li><strong>Loan Amount:</strong> KES {{ number_format($amount, 2) }}</li>
            <li><strong>Annual Interest Rate:</strong> {{ $bank->annual_rate }}%</li>
            <li><strong>Loan Term:</strong> {{ $months }} months</li>

            @php
            $monthlyPayment = $schedule[0]['total'] ?? 0;
            $totalPayment = $monthlyPayment * $months;
            $totalInterest = $totalPayment - $amount;
            @endphp

            <li><strong>Monthly Payment:</strong> KES {{ number_format($monthlyPayment, 2) }}</li>
            <li><strong>Total Interest:</strong> KES {{ number_format($totalInterest, 2) }}</li>
            <li><strong>Total Payment:</strong> KES {{ number_format($totalPayment, 2) }}</li>
        </ul>

        <h2 class="text-xl font-semibold mb-4">Amortization Schedule</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Month</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Principal</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Interest</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Total Payment</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Remaining Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedule as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ $payment['month'] }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">KES {{
                            number_format($payment['principal'], 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">KES {{
                            number_format($payment['interest'], 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">KES {{ number_format($payment['total'],
                            2) }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">KES {{
                            number_format($payment['balance'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('home') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Back to Comparison
            </a>
        </div>
    </div>
</div>