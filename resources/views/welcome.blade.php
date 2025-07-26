<x-custom-layout>

    @push('styles')
    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
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

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }
    </style>
    @endpush
    </head>

    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left side: Enhanced Info section -->
        <div
            class="lg:w-1/2 flex flex-col justify-center px-6 sm:px-10 py-16 bg-gradient-to-br from-white to-blue-50/50">
            <div class="max-w-xl mx-auto animate-fade-in">
                <div class="mb-8">
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-6">
                        🇰🇪 Trusted by 10,000+ Kenyans
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-bold mb-6 leading-tight text-gray-900">
                        Compare Loan Offers
                        <span
                            class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Instantly</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Find the best loan option from top banks and SACCOs in Kenya — without visiting a single branch.
                        Know your monthly payments, total cost, and time to repay instantly.
                    </p>
                </div>

                <!-- Enhanced Features Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="feature-card bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Updated rates</span>
                        </div>
                    </div>
                    <div class="feature-card bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Fast estimates</span>
                        </div>
                    </div>
                    <div class="feature-card bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Bank vs SACCO</span>
                        </div>
                    </div>
                    <div class="feature-card bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">No signup</span>
                        </div>
                    </div>
                </div>

                <!-- Trust indicators -->
                <div class="flex items-center space-x-6 text-sm text-gray-500">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <span>4.8/5 rating</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        <span>Verified secure</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side: Enhanced Form -->
        <div
            class="lg:w-1/2 flex flex-col justify-center px-6 sm:px-8 py-16 bg-gradient-to-br from-gray-50 to-blue-50/30">
            <div class="max-w-md w-full mx-auto animate-fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-3 text-gray-900">Start Your Comparison</h2>
                    <p class="text-gray-600">Get personalized loan offers in under 30 seconds</p>
                </div>

                <form method="POST" action="{{ route('loan.compare') }}"
                    class="space-y-6 glass-effect p-8 rounded-2xl shadow-xl">

                    @csrf

                    <!-- Progress indicator -->
                    <div class="flex items-center justify-center space-x-2 mb-6">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div class="w-8 h-1 bg-blue-500 rounded"></div>
                        <div class="w-2 h-2 bg-blue-300 rounded-full"></div>
                        <div class="w-8 h-1 bg-gray-200 rounded"></div>
                        <div class="w-2 h-2 bg-gray-200 rounded-full"></div>
                    </div>


                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <strong class="font-bold">Error:</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <!-- Loan Amount -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Loan Amount
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">KES</span>
                            <input type="text" name="amount" required placeholder="100,000"
                                class="w-full pl-14 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 input-focus text-lg font-medium"
                                min="10000" max="10000000">
                        </div>
                        <p class="text-xs text-gray-500">Minimum KES 10,000 - Maximum KES 10,000,000</p>
                    </div>

                    <!-- Enhanced Period/Payment Section -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-gray-700">Choose one option:</label>
                            <div class="flex bg-gray-100 rounded-lg p-1">
                                <button type="button" id="period-tab"
                                    class="px-3 py-1 text-xs font-medium rounded-md bg-white text-gray-700 shadow-sm">Period</button>
                                <button type="button" id="payment-tab"
                                    class="px-3 py-1 text-xs font-medium rounded-md text-gray-500">Payment</button>
                            </div>
                        </div>

                        <!-- Period Section -->
                        <div id="period-section" class="space-y-3">
                            <div class="grid grid-cols-3 gap-3">
                                <div class="col-span-2">
                                    <input type="number" name="period" placeholder="12"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 input-focus text-center font-medium"
                                        min="1" max="360" />
                                </div>
                                <div>
                                    <select name="period_unit"
                                        class="w-full px-3 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 input-focus font-medium">
                                        <option value="months">Months</option>
                                        <option value="years">Years</option>
                                    </select>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 text-center">Typical range: 6 months to 30 years</p>
                        </div>

                        <!-- Monthly Payment Section -->
                        <div id="payment-section" class="space-y-3 hidden">
                            <div class="relative">
                                <span
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">KES</span>
                                <input type="text" name="monthly_payment" placeholder="10,000"
                                    class="w-full pl-14 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 input-focus font-medium"
                                    min="1000" />
                            </div>
                            <p class="text-xs text-gray-500 text-center">How much can you afford monthly?</p>
                        </div>
                    </div>

                    <!-- Enhanced Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-lg">
                        <span class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span>Compare Offers Now</span>
                        </span>
                    </button>

                    <!-- Trust footer -->
                    <div class="text-center space-y-3 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600 font-medium">
                            🔒 100% secure • No impact on credit score
                        </p>
                        <div class="flex items-center justify-center space-x-4 text-xs text-gray-500">
                            <span class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full pulse-animation"></div>
                                <span>25+ lenders</span>
                            </span>
                            <span>•</span>
                            <span>Updated daily</span>
                            <span>•</span>
                            <span>Free forever</span>
                        </div>
                    </div>
                </form>

                <!-- Social proof -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500 mb-3">Join thousands of satisfied customers</p>
                    <div class="flex justify-center space-x-1">
                        <div class="flex space-x-1">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-600 ml-2">4.8/5 (2,450+ reviews)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        // Tab switching functionality
        const periodTab = document.getElementById('period-tab');
        const paymentTab = document.getElementById('payment-tab');
        const periodSection = document.getElementById('period-section');
        const paymentSection = document.getElementById('payment-section');

        periodTab.addEventListener('click', () => {
            periodTab.classList.add('bg-white', 'text-gray-700', 'shadow-sm');
            periodTab.classList.remove('text-gray-500');
            paymentTab.classList.remove('bg-white', 'text-gray-700', 'shadow-sm');
            paymentTab.classList.add('text-gray-500');
            
            periodSection.classList.remove('hidden');
            paymentSection.classList.add('hidden');
        });

        paymentTab.addEventListener('click', () => {
            paymentTab.classList.add('bg-white', 'text-gray-700', 'shadow-sm');
            paymentTab.classList.remove('text-gray-500');
            periodTab.classList.remove('bg-white', 'text-gray-700', 'shadow-sm');
            periodTab.classList.add('text-gray-500');
            
            paymentSection.classList.remove('hidden');
            periodSection.classList.add('hidden');
        });

        // Utility function to remove commas from string
        function removeCommas(str) {
            return str.replace(/,/g, '');
        }

        // Format number with commas on blur, remove commas on focus
        function addNumberFormatting(input) {
            input.addEventListener('focus', function(e) {
                e.target.value = removeCommas(e.target.value);
            });

            input.addEventListener('blur', function(e) {
                let value = removeCommas(e.target.value);
                if (value && !isNaN(value)) {
                    e.target.value = Number(value).toLocaleString();
                }
            });

            // Optional: prevent commas while typing, only allow numbers and dot
            input.addEventListener('input', function(e) {
                // Remove all characters except digits and decimal point
                let cleaned = e.target.value.replace(/[^0-9.]/g, '');

                // Allow only one decimal point
                let parts = cleaned.split('.');
                if (parts.length > 2) {
                    cleaned = parts[0] + '.' + parts.slice(1).join('');
                }
                e.target.value = cleaned;
            });
        }

        const amountInput = document.querySelector('input[name="amount"]');
        const monthlyPaymentInput = document.querySelector('input[name="monthly_payment"]');

        if (amountInput) addNumberFormatting(amountInput);
        if (monthlyPaymentInput) addNumberFormatting(monthlyPaymentInput);

        // Form validation and enhancement
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Remove commas before submission so backend gets clean numbers
            if (amountInput) amountInput.value = removeCommas(amountInput.value);
            if (monthlyPaymentInput) monthlyPaymentInput.value = removeCommas(monthlyPaymentInput.value);
        });

        const periodInput = document.querySelector('input[name="period"]');
        form.addEventListener('submit', function(e) {
            if (periodInput && monthlyPaymentInput) {
                const periodFilled = periodInput.value.trim() !== '';
                const paymentFilled = monthlyPaymentInput.value.trim() !== '';
                if (periodFilled && paymentFilled) {
                    e.preventDefault();
                    alert('Please fill in either Loan Period or Monthly Payment — not both.');
                }
            }
        });
    </script>
    @endpush

</x-custom-layout>