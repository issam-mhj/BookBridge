<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Lending Lounge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .book {
            position: absolute;
            width: 30px;
            height: 120px;
            background-color: rgba(165, 42, 42, 0.7);
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            transform-origin: bottom left;
            transition: transform 0.5s ease;
            pointer-events: auto;
            /* Allow pointer events on books */
        }

        .book:hover {
            transform: rotate(-5deg) translateY(-10px);
        }

        .book-title {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            color: rgba(255, 255, 255, 0.7);
            font-size: 8px;
            padding: 5px 2px;
            height: 100%;
            overflow: hidden;
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .dust-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            opacity: 0;
            animation: float-dust 5s linear infinite;
        }

        @keyframes float-dust {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }

            25% {
                opacity: 0.8;
            }

            75% {
                opacity: 0.6;
            }

            100% {
                transform: translateY(-100px) translateX(20px);
                opacity: 0;
            }
        }

        .form-container {
            perspective: 1000px;
        }

        .form-content {
            transform-style: preserve-3d;
            transition: transform 0.6s;
            position: relative;
        }

        .form-flip .front-form {
            opacity: 0;
            pointer-events: none;
        }

        .form-flip .back-form {
            opacity: 1;
            pointer-events: auto;
        }

        .front-form {
            backface-visibility: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .back-form {
            /* backface-visibility: hidden; */
            position: absolute;
            width: 100%;
            height: 100%;
            /* transform: rotateY(180deg); */
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .back-form {
            /* transform: rotateY(180deg); */
            opacity: 0;
            pointer-events: none;
        }

        .special-book {
            right: 20px;
            top: 12%;
            transform: translateY(-50%);
            /* z-index: 30; */
            cursor: pointer;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-amber-900 to-amber-700 relative">
    @if (session('done'))
        <div class="fixed top-0 left-0 right-0 bg-green-500/90 text-white p-4 text-center z-50 backdrop-blur-sm"
            id="successMessage">
            <div class="flex items-center justify-center space-x-2 animate-slideIn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('done') }}</span>
            </div>
        </div>
    @endif
    <!-- Book Shelves Background -->
    <div id="bookshelf" class="fixed top-0 left-0 w-full h-full opacity-20 pointer-events-none z-0"></div>

    <!-- Dust Particles -->
    <div id="dust-container" class="fixed top-0 left-0 w-full h-full pointer-events-none z-0"></div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-10 relative z-10 overflow-y-auto">
        <header class="text-white text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-2">Book Bridge</h1>
            <p class="text-xl text-amber-100">Your digital gateway to knowledge</p>
        </header>

        <!-- Main Content Area -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-10">
            <!-- Left Column - Benefits -->
            <div
                class="bg-amber-900/30 p-8 rounded-lg backdrop-blur-sm border border-amber-500/20 text-white w-full md:w-1/2">
                <h2 class="text-3xl font-serif font-bold mb-6">Join Our Library</h2>
                <p class="text-lg mb-6">Discover thousands of books across multiple genres. Borrow your
                    favorites and enjoy reading from the comfort of your home.</p>

                <ul class="space-y-4">
                    <li class="flex items-start">
                        <span class="bg-amber-500 text-amber-900 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span>Access to thousands of titles</span>
                    </li>
                    <li class="flex items-start">
                        <span class="bg-amber-500 text-amber-900 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span>Easy reservation system</span>
                    </li>
                    <li class="flex items-start">
                        <span class="bg-amber-500 text-amber-900 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span>Track your borrowing history</span>
                    </li>
                    <li class="flex items-start">
                        <span class="bg-amber-500 text-amber-900 p-1 rounded-full mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span>Get personalized recommendations</span>
                    </li>
                </ul>
            </div>

            <!-- Right Column - Form -->
            <div class="bg-amber-50 p-8 rounded-lg shadow-lg w-full md:w-1/2 form-container min-h-[600px]">
                <!-- Special Sign In Book -->
                <div id="signin-book" class="special-book book"
                    style="background-color: rgba(25, 25, 112, 0.7); width: 35px; height: 130px;">
                    <div class="book-title font-bold text-white">Sign In</div>
                </div>
                <div class="form-content">
                    <!-- Sign Up Form (Front) -->
                    <div class="front-form">
                        <div class="flex justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-800" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-center text-amber-900 mb-2">Get Your Library Card</h2>
                        <p class="text-amber-700 text-center mb-6">Register to access our extensive collection of
                            books</p>

                        <form id="signup-form" action="/register" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="fullname" class="block text-amber-700 mb-1">Full Name</label>
                                <input type="text" name="name" id="fullname" placeholder="Issam mahtaj"
                                    class="w-full px-4 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('name')
                                    <div class="mt-1 flex items-center text-red-500 text-sm animate-slideIn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 flex-shrink-0"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-amber-700 mb-1">Email</label>
                                <input type="email" name="email" id="email"
                                    placeholder="your.email@example.com"
                                    class="w-full px-4 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('email')
                                    <div class="mt-1 flex items-center text-red-500 text-sm animate-slideIn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 flex-shrink-0"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-amber-700 mb-1">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="w-full px-4 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('password')
                                    <div class="mt-1 flex items-center text-red-500 text-sm animate-slideIn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 flex-shrink-0"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="confirm-password" class="block text-amber-700 mb-1">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation" id="confirm-password"
                                    placeholder="••••••••"
                                    class="w-full px-4 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('password_confirmation')
                                    <div class="mt-1 flex items-center text-red-500 text-sm animate-slideIn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 flex-shrink-0"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full py-3 px-4 bg-amber-800 hover:bg-amber-900 text-white font-bold rounded-md transition duration-200 transform hover:scale-[1.02]">Create
                                Library Card</button>
                        </form>
                    </div>

                    <!-- Sign In Form (Back) -->
                    <div class="back-form">
                        <div class="flex justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-800" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-center text-amber-900 mb-2">Sign In</h2>
                        <p class="text-amber-700 text-center mb-6">Access your library account</p>

                        <form action="{{ route('login') }}" method="POST" id="signin-form" class="space-y-4">
                            @csrf
                            <div>
                                <label for="signin-email" class="block text-amber-700 mb-1">Email</label>
                                <input type="email" name="email" id="signin-email" placeholder="your.email@example.com"
                                    class="w-full px-4 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
                            </div>

                            <div>
                                <label for="signin-password" class="block text-amber-700 mb-1">Password</label>
                                <input type="password" name="password" id="signin-password" placeholder="••••••••"
                                    class="w-full px-4 py-2 border border-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500">
                            </div>

                            <button type="submit"
                                class="w-full py-3 px-4 bg-amber-800 hover:bg-amber-900 text-white font-bold rounded-md transition duration-200 transform hover:scale-[1.02]">
                                Sign In
                            </button>

                            <button type="button" id="back-to-signup"
                                class="w-full py-3 px-4 bg-amber-200 hover:bg-amber-300 text-amber-800 font-bold rounded-md transition duration-200">
                                Back to Sign Up
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-16 text-center text-amber-200">
            <p>&copy; 2025 BookBridge. All rights reserved.</p>
        </footer>
    </div>

    <!-- Floating Book Animation -->
    <div id="floating-book" class="fixed bottom-10 right-10 z-20 opacity-70 floating hidden md:block">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="80" viewBox="0 0 100 80" fill="none"
            class="drop-shadow-lg">
            <path
                d="M10 10C10 5.58172 13.5817 2 18 2H90C94.4183 2 98 5.58172 98 10V70C98 74.4183 94.4183 78 90 78H18C13.5817 78 10 74.4183 10 70V10Z"
                fill="#8B4513" />
            <path
                d="M12 12C12 7.58172 15.5817 4 20 4H92C96.4183 4 100 7.58172 100 12V72C100 76.4183 96.4183 80 92 80H20C15.5817 80 12 76.4183 12 72V12Z"
                fill="#A0522D" />
            <rect x="18" y="10" width="70" height="60" fill="#D2B48C" />
            <rect x="25" y="20" width="55" height="2" fill="#8B4513" />
            <rect x="25" y="30" width="55" height="2" fill="#8B4513" />
            <rect x="25" y="40" width="55" height="2" fill="#8B4513" />
            <rect x="25" y="50" width="40" height="2" fill="#8B4513" />
        </svg>
    </div>

    <script>
        // Generate Books for Bookshelf
        const bookshelf = document.getElementById('bookshelf');
        const bookColors = [
            'rgba(139, 69, 19, 0.7)', // Brown
            'rgba(128, 0, 0, 0.7)', // Maroon
            'rgba(0, 100, 0, 0.7)', // Dark Green
            'rgba(25, 25, 112, 0.7)', // Midnight Blue
            'rgba(72, 61, 139, 0.7)', // Dark Slate Blue
            'rgba(0, 0, 128, 0.7)', // Navy
            'rgba(85, 107, 47, 0.7)' // Dark Olive Green
        ];

        const bookTitles = [
            'The Great Adventure',
            'Mystery of the Lost Key',
            'Brave New World',
            'The Art of Programming',
            'History Unveiled',
            'Poetry Collection',
            'Scientific Discoveries',
            'Fantasy Realms',
            'Philosophical Thoughts',
            'Mathematical Wonders',
            'Cooking Masterclass',
            'Travel Explorations',
            'Modern Architecture',
            'Music Theory',
            'Classic Literature'
        ];

        // Create books with random properties
        for (let i = 0; i < 100; i++) {
            const book = document.createElement('div');
            book.className = 'book';

            // Random book properties
            const color = bookColors[Math.floor(Math.random() * bookColors.length)];
            const width = Math.floor(Math.random() * 20) + 20; // 20-40px
            const height = Math.floor(Math.random() * 40) + 100; // 100-140px
            const left = Math.floor(Math.random() * window.innerWidth);
            const top = Math.floor(Math.random() * window.innerHeight);
            const rotation = Math.floor(Math.random() * 10) - 5; // -5 to 5 degrees
            const title = bookTitles[Math.floor(Math.random() * bookTitles.length)];

            // Apply styles
            book.style.backgroundColor = color;
            book.style.width = `${width}px`;
            book.style.height = `${height}px`;
            book.style.left = `${left}px`;
            book.style.top = `${top}px`;
            book.style.transform = `rotate(${rotation}deg)`;

            // Add title
            const titleSpan = document.createElement('div');
            titleSpan.className = 'book-title';
            titleSpan.textContent = title;
            book.appendChild(titleSpan);

            bookshelf.appendChild(book);
        }

        // Create dust particles animation
        const dustContainer = document.getElementById('dust-container');

        function createDustParticle() {
            const dust = document.createElement('div');
            dust.className = 'dust-particle';

            // Random position
            const left = Math.floor(Math.random() * window.innerWidth);
            const top = Math.floor(Math.random() * window.innerHeight);

            // Apply styles
            dust.style.left = `${left}px`;
            dust.style.top = `${top}px`;
            dust.style.animationDuration = `${Math.random() * 7 + 3}s`; // 3-10s

            dustContainer.appendChild(dust);

            // Remove particle after animation
            setTimeout(() => {
                dust.remove();
            }, 10000);
        }

        // Create dust particles periodically
        setInterval(createDustParticle, 300);

        // Make books interactive on hover
        const books = document.querySelectorAll('.book');
        books.forEach(book => {
            book.addEventListener('mouseover', () => {
                book.style.zIndex = '20';
            });

            book.addEventListener('mouseout', () => {
                book.style.zIndex = '0';
            });
        });

        function flipForm() {
            const formContent = document.querySelector('.form-content');
            formContent.classList.add('form-flip');
        }

        function flipFormBack() {
            const formContent = document.querySelector('.form-content');
            formContent.classList.remove('form-flip');
        }
        document.getElementById('signin-book').addEventListener('click', function() {
            this.style.transition = 'transform 0.3s ease';
            this.style.transform = 'rotate(-15deg) translate(-10px, -20px)';
            this.style.zIndex = '100';

            setTimeout(() => {
                this.style.transform = 'translateY(-50%) rotate(-5deg)';
                this.style.zIndex = '30';
                flipForm();
            }, 300);
        });

        // Back to signup button
        document.getElementById('back-to-signup').addEventListener('click', flipFormBack);

        const successMessage = document.getElementById("successMessage");
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }
    </script>
</body>

</html>
