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
                                <td class="border border-gray-300 px-4 py-2 text-right">KES {{
                                    number_format($payment['total'],
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




        <!-- Next Steps -->
        <section class="mt-12 animate-fade-in">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white text-center">
                <h3 class="text-2xl font-bold mb-4">Ready to Apply?</h3>
                <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
                    Contact your preferred lender directly to start the application process. Most banks and SACCOs offer
                    online applications.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#{{ $bank->id }}"
                        class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors inline-block">
                        Contact {{ $bank->name }}
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
                        Kenya's trusted loan comparison platform. Find the best rates from banks and SACCOs
                        nationwide.
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