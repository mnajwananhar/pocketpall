<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('PocketPal', 'PocketPal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            /* background-color: #121212; */
            color: #ffffff;
        }

        nav.scrolled {
            background-color: rgba(30, 33, 37, 1) !important;
        }

        .scroll-container {
            scroll-snap-type: y mandatory;
            overflow-y: hidden;
            height: 100vh;
            scroll-behavior: smooth;
        }

        .scroll-section {
            scroll-snap-align: start;
            height: 100vh;
        }
    </style>
</head>

<body class="font-sans bg-[#181A20] text-white">
    <!-- Navbar -->
    <nav id="navbar"
        class="bg-white/10 backdrop-filter backdrop-blur-lg shadow-xl border border-gray-700 rounded-xl shadow-lg fixed top-4 left-1/2 transform -translate-x-1/2 w-[90%] md:w-[80%] lg:w-[60%] z-50 transition-all duration-300">
        <div class="flex justify-between items-center px-6 py-3">
            <h1 class="text-xl font-bold text-[#FCD535]">PocketPal</h1>
            <div>
                <a href="/login" class="text-gray-200 hover:bg-[#FCD535]/20 px-4 py-3 rounded-lg transition"><i
                        class="fas fa-sign-in-alt"></i> Login</a>
                <a href="/register" class="text-gray-200 hover:bg-[#FCD535]/20 px-4 py-3 rounded-lg transition"><i
                        class="fas fa-user-plus"></i> Register</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 scroll-container">
        <!-- Jumbotron -->
        <div
            class="scroll-section p-8 flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-6 h-screen">
            <div class="md:w-1/2">
                <h1 class="text-5xl font-bold text-[#FCD535]">Manage Your Finances</h1>
                <p class="text-gray-400 mt-4">Track your income, expenses, and savings with ease. PocketPal helps you
                    stay on top of your financial goals.</p>
                <a href="/register"
                    class="mt-6 inline-block bg-[#FCD535] text-gray-900 px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-yellow-500 transition"><i
                        class="fas fa-user-plus"></i> Get Started</a>
            </div>
            <div class="md:w-1/2 relative">
                <img src="images/desktop.png" alt="Financial Management Desktop" class="w-full rounded-lg">
                <img src="images/mobile.png" alt="Financial Management Mobile"
                    class="absolute bottom-0 right-4 w-1/4 rounded-lg shadow-lg">
            </div>
        </div>

        <!-- Features Section -->
        <div class="scroll-section h-screen">
            <div class="flex justify-center items-center h-full">
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white/10 rounded-lg shadow-lg p-6 text-center">
                        <i class="fas fa-chart-line text-4xl text-[#FCD535]"></i>
                        <h3 class="mt-4 text-xl font-bold">Track Spending</h3>
                        <p class="mt-2 text-gray-400">Monitor your spending habits and identify areas where you can save
                            more.</p>
                    </div>
                    <div class="bg-white/10 rounded-lg shadow-lg p-6 text-center">
                        <i class="fas fa-wallet text-4xl text-[#FCD535]"></i>
                        <h3 class="mt-4 text-xl font-bold">Manage Wallets</h3>
                        <p class="mt-2 text-gray-400">Keep track of multiple wallets and their balances in one place.
                        </p>
                    </div>
                    <div class="bg-white/10 rounded-lg shadow-lg p-6 text-center">
                        <i class="fas fa-piggy-bank text-4xl text-[#FCD535]"></i>
                        <h3 class="mt-4 text-xl font-bold">Save More</h3>
                        <p class="mt-2 text-gray-400">Create savings wallet and watch your progress as you save more
                            money.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customize Your Wallet Section -->
        <div
            class="scroll-section mt-12 flex flex-col md:flex-row items-center justify-between text-center md:text-left h-screen">
            <!-- Wallet Section -->
            <div class="md:w-1/3 grid grid-cols-2 gap-2 md:gap-4 md:mr-6 justify-end items-right">
                <div onclick="#"
                    class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200"
                    style="background-color: #198876;" data-color="#FCD535">
                    <div class="p-3 sm:p-4 flex flex-col justify-end h-full w-full aspect-square">
                        <div class="text-content">
                            <p class="text-3xl sm:text-4xl mb-2">🏖️</p>
                            <h3 class="text-md sm:text-lg font-semibold">Holiday</h3>
                            <p class="text-sm">Rp1.500.000</p>
                        </div>
                    </div>
                </div>
                <div onclick="#"
                    class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200"
                    style="background-color: #3498DB;" data-color="#FCD535">
                    <div class="p-3 sm:p-4 flex flex-col justify-end h-full w-full aspect-square">
                        <div class="text-content">
                            <p class="text-3xl sm:text-4xl mb-2">🚗</p>
                            <h3 class="text-md sm:text-lg font-semibold">New Car</h3>
                            <p class="text-sm">Rp90.330.000</p>
                        </div>
                    </div>
                </div>
                <div onclick="#"
                    class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200"
                    style="background-color: #FF5733;" data-color="#FCD535">
                    <div class="p-3 sm:p-4 flex flex-col justify-end h-full w-full aspect-square">
                        <div class="text-content">
                            <p class="text-3xl sm:text-4xl mb-2">🎉</p>
                            <h3 class="text-md sm:text-lg font-semibold">Party</h3>
                            <p class="text-sm">Rp4.500.000</p>
                        </div>
                    </div>
                </div>
                <div onclick="#"
                    class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200"
                    style="background-color: #2ECC71;" data-color="#FCD535">
                    <div class="p-3 sm:p-4 flex flex-col justify-end h-full w-full aspect-square">
                        <div class="text-content">
                            <p class="text-3xl sm:text-4xl mb-2">🏠</p>
                            <h3 class="text-md sm:text-lg font-semibold">Rent</h3>
                            <p class="text-sm">Rp2.500.000</p>
                        </div>
                    </div>
                </div>
                <div onclick="#"
                    class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200"
                    style="background-color: #8E44AD;" data-color="#FCD535">
                    <div class="p-3 sm:p-4 flex flex-col justify-end h-full w-full aspect-square">
                        <div class="text-content">
                            <p class="text-3xl sm:text-4xl mb-2">📚</p>
                            <h3 class="text-md sm:text-lg font-semibold">Education</h3>
                            <p class="text-sm">Rp10.000.000</p>
                        </div>
                    </div>
                </div>
                <div onclick="#"
                    class="border border-gray-700 shadow-xl rounded-lg cursor-pointer hover:bg-opacity-80 transition-all duration-200"
                    style="background-color: #E74C3C;" data-color="#FCD535">
                    <div class="p-3 sm:p-4 flex flex-col justify-end h-full w-full aspect-square">
                        <div class="text-content">
                            <p class="text-3xl sm:text-4xl mb-2">🍽️</p>
                            <h3 class="text-md sm:text-lg font-semibold">Dining</h3>
                            <p class="text-sm">Rp2.000.000</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text Section -->
            <div class="md:w-1/2 px-6 mt-6 md:mt-0">
                <h2 class="text-3xl font-bold text-[#FCD535]">Customize Your Wallet</h2>
                <p class="mt-4 text-gray-400">
                    Whether you want to save for a big purchase, or just want to keep track of your spending, we've got
                    you covered. Create wallets tailored to your financial goals.
                </p>
                <a href="/wallets"
                    class="mt-6 inline-block bg-[#FCD535] text-gray-900 px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-yellow-500 transition">
                    Start Customizing
                </a>
            </div>
        </div>

        <!-- Income vs Expenses Section -->
        <div
            class="scroll-section mt-12 flex flex-col md:flex-row items-center justify-between text-center md:text-left h-screen">
            <!-- Text Section -->
            <div class="md:w-1/2 px-6">
                <h2 class="text-3xl font-bold text-[#FCD535]">Income vs Expenses</h2>
                <p class="mt-4 text-gray-400">
                    Gain insights into your financial health. Compare your income and expenses easily, and make smarter
                    decisions to achieve your financial goals.
                </p>
                <a href="/dashboard"
                    class="mt-6 inline-block bg-[#FCD535] text-gray-900 px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-yellow-500 transition">
                    Learn More
                </a>
            </div>

            <!-- Image Section -->
            <div class="md:w-1/2 mt-6 md:mt-0 px-6">
                <div class="relative">
                    <img src="images/ive.png" alt="Income vs Expenses" class="w-full rounded-lg shadow-lg">
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class=" text-white py-6 mt-12">
            <div class="container mx-auto text-center">
                <p class="text-sm">&copy; {{ date('Y') }} Brotherhood's. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        document.addEventListener("DOMContentLoaded", () => {
            const sections = document.querySelectorAll(".scroll-section");
            const scrollContainer = document.querySelector(".scroll-container");

            let isScrolling = false;

            scrollContainer.addEventListener("wheel", (event) => {
                event.preventDefault();
                if (isScrolling) return;

                isScrolling = true;

                const scrollDirection = event.deltaY > 0 ? 1 : -1;
                const currentSectionIndex = [...sections].findIndex(section =>
                    Math.abs(section.getBoundingClientRect().top) < window.innerHeight / 2
                );

                const nextSectionIndex = currentSectionIndex + scrollDirection;

                if (nextSectionIndex >= 0 && nextSectionIndex < sections.length) {
                    const targetSection = sections[nextSectionIndex];
                    targetSection.scrollIntoView({
                        behavior: "smooth"
                    });
                }

                setTimeout(() => {
                    isScrolling = false;
                }, 1000);
            });
        });
    </script>

</body>

</html>
