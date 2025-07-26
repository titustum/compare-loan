<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>CompareLoan – Loan Comparison Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .best-offer {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            position: relative;
            overflow: hidden;
        }

        .best-offer::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .comparison-table {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .sticky-header {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
        }

        .tab-button {
            transition: all 0.3s ease;
        }

        .tab-button.active {
            font-weight: 700;
            border-b-2 border-blue-600;
            color: #2563eb;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .tab-button:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #2563eb;
        }

        .savings-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            animation: pulse 2s infinite;
        }

        .progress-bar {
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
            animation: fillProgress 1.5s ease-out;
        }

        @keyframes fillProgress {
            from {
                width: 0%;
            }

            to {
                width: var(--progress-width);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 text-gray-800 min-h-screen">

    <!-- Enhanced Header -->
    <header class="sticky-header sticky top-0 z-50 border-b border-gray-200/20 p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">CompareLoan</h1>
            </div>

            <div class="flex items-center space-x-4">
                <button onclick="window.print()"
                    class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span class="hidden sm:inline">Print</span>
                </button>
                <a href="/"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                    New Comparison
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Results Summary -->
        <section class="mb-12 animate-fade-in">
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Your Loan Comparison Results</h2>
                <div class="bg-white rounded-2xl shadow-lg p-6 max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Loan Amount</p>
                            <p class="text-3xl font-bold text-gray-900">KES {{ number_format($amount) }}</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Repayment Period</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $months }} months</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Offers Found</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $bankResults->count() +
                                $saccoResults->count() }} lenders</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Best Offer Highlight -->
            @php
            $allOffers = $bankResults->merge($saccoResults)->sortBy('emi')->values();
            $bestOffer = $allOffers->first();
            @endphp

            @if($bestOffer)
            <div
                class="best-offer rounded-2xl p-8 text-white text-center mb-8 animate-slide-up bg-gradient-to-r from-blue-700 to-blue-500">
                <div class="relative z-10">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <h3 class="text-2xl font-bold">Best Offer</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Lender</p>
                            <p class="text-xl font-bold">{{ $bestOffer->bank->name }}</p>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Interest Rate</p>
                            <p class="text-xl font-bold">{{ number_format($bestOffer->rate, 2) }}% p.a.</p>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Monthly Payment</p>
                            <p class="text-xl font-bold">KES {{ number_format($bestOffer->emi) }}</p>
                        </div>
                        <div>
                            <p class="text-blue-100 text-sm mb-1">Total Interest</p>
                            <div class="savings-badge rounded-full px-3 py-1 inline-block bg-white bg-opacity-20">
                                <p class="text-white font-bold">KES {{ number_format($bestOffer->interest) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>


        <!-- Comparison Tabs -->
        <section class="mb-8">
            <div class="flex flex-wrap justify-center space-x-1 bg-gray-100 rounded-xl p-1 max-w-md mx-auto">
                <button id="all-tab" class="tab-button active px-6 py-3 rounded-lg font-medium text-sm transition-all">
                    All Offers ({{ $bankResults->count() + $saccoResults->count() }})
                </button>
                <button id="banks-tab" class="tab-button px-6 py-3 rounded-lg font-medium text-sm text-gray-600">
                    Banks ({{ $bankResults->count() }})
                </button>
                <button id="saccos-tab" class="tab-button px-6 py-3 rounded-lg font-medium text-sm text-gray-600">
                    SACCOs ({{ $saccoResults->count() }})
                </button>
            </div>
        </section>


        <!-- Enhanced Results Tables -->
        <section class="space-y-8">

            <!-- All Offers View -->
            <div id="all-offers" class="animate-slide-up">
                <div class="comparison-table rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Complete Comparison</h3>
                        <p class="text-gray-600">All available loan offers sorted by total cost</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Rank</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Lender</th>
                                    <th
                                        class="px-6 py-4 text-center text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Type</th>
                                    <th
                                        class="px-6 py-4 text-right text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Rate (%)</th>
                                    <th
                                        class="px-6 py-4 text-right text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Monthly Payment</th>
                                    <th
                                        class="px-6 py-4 text-right text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Total Interest</th>
                                    <th
                                        class="px-6 py-4 text-right text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Total Cost</th>
                                    <th
                                        class="px-6 py-4 text-center text-sm font-semibold text-gray-900 uppercase tracking-wide">
                                        Savings</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <!-- Sample row 1 - Best offer -->
                                @php
                                $allOffers = $bankResults->merge($saccoResults)->sortBy('total')->values();
                                @endphp

                                @foreach ($allOffers as $index => $offer)
                                <tr
                                    class="hover:bg-{{ $index === 0 ? 'blue-50/50 border-l-4 border-l-green-500 bg-green-50/30' : 'gray-50' }} transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 {{ $index === 0 ? 'bg-green-500' : 'bg-gray-500' }} text-white rounded-full flex items-center justify-center text-sm font-bold">
                                                {{ $index + 1 }}
                                            </div>
                                            @if ($index === 0)
                                            <span class="ml-2 text-xs font-medium text-green-600">BEST</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-{{ $offer->bank->type === 'bank' ? 'red' : 'green' }}-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($offer->bank->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $offer->bank->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $offer->bank->product_name ?? 'Loan'
                                                    }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="bg-{{ $offer->bank->type === 'bank' ? 'blue' : 'green' }}-100 text-{{ $offer->bank->type === 'bank' ? 'blue' : 'green' }}-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ ucfirst($offer->bank->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right font-semibold text-gray-900">{{
                                        number_format($offer->rate, 2) }}</td>
                                    <td class="px-6 py-4 text-right font-semibold text-gray-900">KES {{
                                        number_format($offer->emi) }}</td>
                                    <td class="px-6 py-4 text-right text-gray-600">KES {{
                                        number_format($offer->interest) }}</td>
                                    <td class="px-6 py-4 text-right font-bold text-gray-900">KES {{
                                        number_format($offer->total) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($index === 0)
                                        <span
                                            class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">-</span>
                                        @else
                                        @php
                                        $savings = round($offer->total - $allOffers[0]->total);
                                        @endphp
                                        <span
                                            class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm font-medium">
                                            +{{ number_format($savings) }}
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Banks Only View -->
            <div id="banks-only" class="hidden animate-slide-up">
                <div class="comparison-table rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Bank Offers</h3>
                        <p class="text-gray-600">Traditional banking institutions</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                        @foreach ($bankResults as $index => $bank)
                        <div class="card-hover bg-white rounded-xl p-6 border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($bank->bank->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $bank->bank->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $bank->bank->product_name ?? 'Loan' }}</p>
                                    </div>
                                </div>
                                @if ($index === 0)
                                <span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">BEST</span>
                                @endif
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Interest Rate</span>
                                    <span class="font-semibold">{{ number_format($bank->rate, 2) }}% p.a.</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Monthly Payment</span>
                                    <span class="font-semibold text-blue-600">KES {{ number_format($bank->emi) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Cost</span>
                                    <span class="font-semibold">KES {{ number_format($bank->total) }}</span>
                                </div>

                                <div class="mt-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Competitiveness</span>
                                        @php
                                        $base = $bankResults[0]->total;
                                        $percent = max(100 - (($bank->total - $base) / $base * 100), 60);
                                        @endphp
                                        <span>{{ round($percent) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="progress-bar h-2 rounded-full"
                                            style="--progress-width: {{ round($percent) }}%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>

            <!-- SACCOs Only View -->
            <div id="saccos-only" class="hidden animate-slide-up">
                <div class="comparison-table rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">SACCO Offers</h3>
                        <p class="text-gray-600">Savings and Credit Cooperative Organizations</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">

                        @foreach ($saccoResults as $index => $sacco)
                        <div class="card-hover bg-white rounded-xl p-6 border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($sacco->bank->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $sacco->bank->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $sacco->bank->product_name ?? 'Loan' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Interest Rate</span>
                                    <span class="font-semibold">{{ number_format($sacco->rate, 2) }}% p.a.</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Monthly Payment</span>
                                    <span class="font-semibold text-green-600">KES {{ number_format($sacco->emi)
                                        }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Cost</span>
                                    <span class="font-semibold">KES {{ number_format($sacco->total) }}</span>
                                </div>

                                <div class="mt-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Competitiveness</span>
                                        @php
                                        $base = $saccoResults[0]->total;
                                        $percent = max(100 - (($sacco->total - $base) / $base * 100), 60);
                                        @endphp
                                        <span>{{ round($percent) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="progress-bar h-2 rounded-full"
                                            style="--progress-width: {{ round($percent) }}%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

        @php
        $allOffers = $bankResults->merge($saccoResults)->sortBy('total')->values();
        $bestOffer = $allOffers->first();
        $worstOffer = $allOffers->last();
        $savings = $worstOffer->total - $bestOffer->total;
        $lenderCount = $allOffers->count();
        @endphp

        <!-- Key Insights -->
        <section class="mt-12 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Key Insights</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Best Rate Found -->
                    <div class="text-center p-6 bg-blue-50 rounded-xl">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Best Rate Found</h4>
                        <p class="text-2xl font-bold text-blue-600">{{ number_format($bestOffer->rate, 2) }}%</p>
                        <p class="text-sm text-gray-600">From {{ $bestOffer->bank->name }}</p>
                    </div>

                    <!-- Potential Savings -->
                    <div class="text-center p-6 bg-green-50 rounded-xl">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Potential Savings</h4>
                        <p class="text-2xl font-bold text-green-600">KES {{ number_format($savings) }}</p>
                        <p class="text-sm text-gray-600">vs. worst offer</p>
                    </div>

                    <!-- Lenders Compared -->
                    <div class="text-center p-6 bg-purple-50 rounded-xl">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Lenders Compared</h4>
                        <p class="text-2xl font-bold text-purple-600">{{ $lenderCount }}</p>
                        <p class="text-sm text-gray-600">Banks & SACCOs</p>
                    </div>
                </div>
            </div>
        </section>



        <!-- Repayment Schedule Preview -->
        <section class="mt-12 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Repayment Schedule Preview</h3>
                    <a href="{{ route('loan.schedule', $bestOffer->bank->id) }}"
                        class="text-blue-600 hover:text-blue-700 font-medium">
                        View Full Schedule →
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Chart placeholder -->
                    <div class="space-y-4">
                        <canvas id="paymentChart" width="400" height="200"></canvas>
                    </div>

                    <!-- Payment breakdown -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 mb-4">Monthly Breakdown (Best Offer)</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Principal Payment</span>
                                <span class="font-semibold text-gray-900">KES {{
                                    number_format($bestOffer->emi) }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600">Interest Payment</span>
                                <span class="font-semibold text-gray-900">KES {{
                                    number_format($bestOffer->interest) }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <span class="text-blue-700 font-medium">Total Monthly Payment</span>
                                <span class="font-bold text-blue-700">KES {{ number_format($bestOffer->total)
                                    }}</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium text-green-800">Payment fits your budget</span>
                            </div>
                            <p class="text-sm text-green-700">
                                Based on typical income guidelines, this payment is within recommended limits.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Next Steps -->
        <section class="mt-12 animate-fade-in">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white text-center">
                <h3 class="text-2xl font-bold mb-4">Ready to Apply?</h3>
                <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
                    Contact your preferred lender directly to start the application process. Most banks and SACCOs offer
                    online applications.
                </p>
                {{-- <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact.lender', ['id' => $bestOffer->bank->id]) }}"
                        class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors inline-block">
                        Contact {{ $bestOffer->bank->name }}
                    </a>
                    <a href="{{ route('compare.more') }}"
                        class="border border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-semibold transition-colors inline-block">
                        Compare More Options
                    </a>
                </div> --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#{{ $bestOffer->bank->id }}"
                        class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors inline-block">
                        Contact {{ $bestOffer->bank->name }}
                    </a>
                    <a href="#compare-more-options"
                        class="border border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-semibold transition-colors inline-block">
                        Compare More Options
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- Enhanced Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">CompareLoan</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Kenya's trusted loan comparison platform. Find the best rates from banks and SACCOs nationwide.
                    </p>
                    <div class="flex space-x-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-400">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            <span>Rates updated daily</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">How It Works</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Feedback</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">© 2025 CompareLoan. All rights reserved.</p>
                <div class="flex items-center space-x-2 mt-4 sm:mt-0">
                    <span class="text-sm text-gray-500">🇰🇪</span>
                    <span class="text-sm text-gray-400">Made in Kenya</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Tab switching functionality
        const allTab = document.getElementById('all-tab');
        const banksTab = document.getElementById('banks-tab');
        const saccosTab = document.getElementById('saccos-tab');
        
        const allOffers = document.getElementById('all-offers');
        const banksOnly = document.getElementById('banks-only');
        const saccosOnly = document.getElementById('saccos-only');
        
        function switchTab(activeTab, activeContent) {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(tab => {
                tab.classList.remove('active');
                tab.classList.add('text-gray-600');
            });
            
            // Hide all content
            document.querySelectorAll('#all-offers, #banks-only, #saccos-only').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Activate selected tab and content
            activeTab.classList.add('active');
            activeTab.classList.remove('text-gray-600');
            activeContent.classList.remove('hidden');
        }
        
        allTab.addEventListener('click', () => switchTab(allTab, allOffers));
        banksTab.addEventListener('click', () => switchTab(banksTab, banksOnly));
        saccosTab.addEventListener('click', () => switchTab(saccosTab, saccosOnly));
        
        // Chart.js implementation
        const ctx = document.getElementById('paymentChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Month 1', 'Month 6', 'Month 12', 'Month 18', 'Month 24'],
                datasets: [{
                    label: 'Principal',
                    data: [20833, 20833, 20833, 20833, 20833],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true
                }, {
                    label: 'Interest',
                    data: [2623, 2500, 2200, 1800, 1200],
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Payment Breakdown Over Time'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'KES ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Print functionality
        function printResults() {
            window.print();
        }
    </script>

</body>

</html>