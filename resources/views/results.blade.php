<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>CompareLoan – Loan Comparison Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-white shadow p-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">CompareLoan</h1>
        <a href="{{ url('/') }}" class="text-blue-600 hover:underline">New Comparison</a>
    </header>

    <main class="flex-grow container mx-auto px-6 py-10">

        <section class="mb-8 text-center">
            <h2 class="text-3xl font-semibold mb-2">Comparison Results</h2>
            <p class="text-gray-600">
                Loan Amount: <span class="font-medium">KES {{ number_format($amount) }}</span> &mdash;
                @if($months)
                Repayment Period: <span class="font-medium">{{ $months }} months</span>
                @elseif($monthly)
                Monthly Payment: <span class="font-medium">KES {{ number_format($monthly) }}</span>
                @endif
            </p>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Banks Table -->
            <div class="bg-white rounded shadow p-6 overflow-x-auto">
                <h3 class="text-xl font-semibold mb-4 border-b pb-2">Bank Offers</h3>

                @if(count($bankResults))
                <table class="w-full text-left text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-300">
                            <th class="py-2">Bank</th>
                            <th class="py-2">Rate (%)</th>
                            <th class="py-2">Monthly Payment</th>
                            <th class="py-2">Total Interest</th>
                            <th class="py-2">Total Repayment</th>
                            <th class="py-2">Months</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bankResults as $result)
                        @php $bank = $result->bank; @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 font-medium flex items-center space-x-3">
                                @if($bank->logo)
                                <img src="{{ asset('storage/logos/' . $bank->logo) }}" alt="{{ $bank->name }} logo"
                                    class="w-8 h-8 rounded-full object-contain" />
                                @else
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold uppercase">
                                    {{ $bank->initials }}
                                </div>
                                @endif
                                <span>{{ $bank->name }}</span>
                            </td>
                            <td class="py-2">{{ number_format($result->rate, 2) }}</td>
                            <td class="py-2">KES {{ number_format($result->emi) }}</td>
                            <td class="py-2">KES {{ number_format($result->interest) }}</td>
                            <td class="py-2">KES {{ number_format($result->total) }}</td>
                            <td class="py-2">{{ $result->months }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-gray-500">No bank offers matched your criteria.</p>
                @endif
            </div>

            <!-- SACCOs Table -->
            <div class="bg-white rounded shadow p-6 overflow-x-auto">
                <h3 class="text-xl font-semibold mb-4 border-b pb-2">SACCO Offers</h3>

                @if(count($saccoResults))
                <table class="w-full text-left text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-300">
                            <th class="py-2">SACCO</th>
                            <th class="py-2">Rate (%)</th>
                            <th class="py-2">Monthly Payment</th>
                            <th class="py-2">Total Interest</th>
                            <th class="py-2">Total Repayment</th>
                            <th class="py-2">Months</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($saccoResults as $result)
                        @php $sacco = $result->bank; @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-2 font-medium flex items-center space-x-3">
                                @if($sacco->logo)
                                <img src="{{ asset('storage/logos/' . $sacco->logo) }}" alt="{{ $sacco->name }} logo"
                                    class="w-8 h-8 rounded-full object-contain" />
                                @else
                                <div
                                    class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-semibold uppercase">
                                    {{ $sacco->initials }}
                                </div>
                                @endif
                                <span>{{ $sacco->name }}</span>
                            </td>
                            <td class="py-2">{{ number_format($result->rate, 2) }}</td>
                            <td class="py-2">KES {{ number_format($result->emi) }}</td>
                            <td class="py-2">KES {{ number_format($result->interest) }}</td>
                            <td class="py-2">KES {{ number_format($result->total) }}</td>
                            <td class="py-2">{{ $result->months }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-gray-500">No SACCO offers matched your criteria.</p>
                @endif
            </div>
        </section>


    </main>

    <footer class="bg-white border-t text-center py-4 text-gray-500 text-sm">
        &copy; {{ date('Y') }} CompareLoan. All rights reserved.
    </footer>

</body>

</html>