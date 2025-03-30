<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Lending Lounge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f9f5eb;
        }

        .libre {
            font-family: 'Libre Baskerville', serif;
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        .slide-in {
            animation: slideIn 0.6s ease-out;
        }

        .pop-in {
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .book-hover {
            transition: all 0.3s ease;
        }

        .book-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes popIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .search-expand {
            transition: all 0.3s ease;
        }

        .search-expand:focus {
            transform: scale(1.02);
        }

        .bookmark-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            animation: bounce 1s ease infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .page-turn {
            position: relative;
            overflow: hidden;
        }

        .page-turn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 98%, #d1c4a1 100%);
        }

        .rotate-book {
            transition: transform 0.5s ease;
        }

        .rotate-book:hover {
            transform: rotate3d(0, 1, 0, 15deg);
        }

        /* Additional styles for logout dropdown */
        #logout-menu {
            min-width: 120px;
        }

        #logout-menu button {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-amber-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <i class="fas fa-book-open text-2xl"></i>
                <h1 class="text-2xl font-bold libre tracking-wide">BookBridge</h1>
            </div>

            <div class="relative w-1/3">
                <input type="text" placeholder="Search books..."
                    class="w-full py-2 px-4 rounded-full bg-amber-700 text-white placeholder-amber-200 border border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-400 search-expand">
                <i class="fas fa-search absolute right-4 top-3 text-amber-300"></i>
            </div>

            <div class="flex items-center space-x-6">
                <a href="/mybooks" class="flex items-center space-x-2 hover:text-amber-200 transition duration-300">
                    <i class="fas fa-book-bookmark"></i>
                    <span>My Books</span>
                </a>
                <!-- User Icon with Logout Dropdown -->
                <div class="relative">
                    <div id="user-profile"
                        class="w-10 h-10 bg-amber-600 rounded-full flex items-center justify-center cursor-pointer hover:bg-amber-500 transition duration-300">
                        <i class="fas fa-user"></i>
                    </div>
                    <!-- Hidden logout menu -->
                    <div id="logout-menu"
                        class="absolute right-0 mt-2 bg-white text-gray-800 rounded shadow-lg py-2 hidden animate__animated animate__fadeIn">
                        <form action="/logout" method="post">
                            @csrf
                            <button id="logout-button"
                                class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <!-- Back Button -->
        <a href="/home"
            class="inline-flex items-center px-4 py-2 bg-white rounded-lg shadow-sm hover:bg-gray-100 transition duration-300 mb-6 slide-in">
            <i class="fas fa-arrow-left mr-2"></i>
            <span>Back to Library</span>
        </a>

        <!-- Dashboard Header -->
        <div class="bg-amber-50 rounded-xl shadow-md p-6 mb-8 border border-amber-100 fade-in">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold libre text-amber-900">My Library Dashboard</h2>
                    <p class="text-amber-800 mt-1">Manage your borrowed books and library account</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4 relative overflow-hidden pop-in group">
                    <div
                        class="absolute -right-10 -top-10 w-20 h-20 bg-amber-500 rotate-45 group-hover:bg-amber-600 transition-colors duration-300">
                    </div>
                    <div class="relative flex items-center space-x-3">
                        <i class="fas fa-id-card text-2xl text-amber-700"></i>
                        <div>
                            <p class="text-gray-500 text-sm">Member Card</p>
                            <p class="font-medium">LIB-4749626226</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrowed Books -->
        <h3 class="text-2xl font-bold libre text-amber-900 mb-4 slide-in">My Borrowed Books</h3>
        @forelse ($books as $book)
            <div class="bg-amber-50 rounded-xl overflow-hidden shadow-md border border-amber-100 fade-in"
                id="borrowed-books-container">
                <div class="p-6 flex items-center space-x-6 book-hover">
                    <div class="w-32 rotate-book relative">
                        <img src="{{ $book->book['image'] }}" alt="The Lord of the Rings"
                            class="w-full rounded shadow-md page-turn">
                        <div
                            class="absolute top-0 right-0 bg-amber-600 text-white text-xs font-bold px-2 py-1 rounded-bl">
                            {{ $book->book->category['name'] }}</div>
                    </div>

                    <div class="flex-1">
                        <h4 class="text-xl font-bold libre text-amber-900">{{ $book->book['title'] }}</h4>
                        <p class="text-gray-600">by {{ $book->book['author'] }}</p>

                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div>
                                <p class="text-gray-500 text-sm">Borrowed Date:</p>
                                <p class="font-medium flex items-center"><i
                                        class="far fa-calendar-alt mr-2 text-amber-700"></i> {{ $book['borrowed_at'] }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Return Date:</p>
                                <p class="font-medium flex items-center"><i
                                        class="far fa-calendar-check mr-2 text-amber-700"></i>{{ $book['returned_at'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-end space-y-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 font-medium text-sm">
                            <i class="far fa-clock mr-1"></i>
                            @php
                                $now = \Carbon\Carbon::now();
                                $futureDate = \Carbon\Carbon::parse($book['returned_at']);
                                $daysLeft = (int) $now->diffInDays($futureDate);
                            @endphp
                            {{ $daysLeft }} days remaining
                        </span>
                        <form action="/returnBook/{{ $book->id }}" method="POST">
                            @csrf
                            <button
                                class="flex items-center px-4 py-2 bg-amber-700 text-white rounded-md hover:bg-amber-800 transition duration-300">
                                <i class="fas fa-undo-alt mr-2"></i>
                                <span>Return Book</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-6 text-center">
                <i class="fas fa-book-open text-amber-300 text-5xl mb-3"></i>
                <h4 class="text-xl font-bold libre text-amber-900">No books currently borrowed</h4>
                <p class="text-gray-600 mt-2">Visit the library to discover your next great read!</p>
                <a href="#"
                    class="inline-block mt-4 px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition duration-300">
                    <i class="fas fa-search mr-1"></i> Browse Books
                </a>
            </div>
        @endforelse
    </main>

    <!-- Footer -->
    <footer class="bg-amber-900 text-white py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold">BookBridge</h3>
                    <p class="mt-2 text-amber-200">Your gateway to literary adventures</p>
                </div>

                <div class="flex gap-6">
                    <a href="#" class="hover:text-amber-200 transition"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="hover:text-amber-200 transition"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="hover:text-amber-200 transition"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="hover:text-amber-200 transition"><i class="fab fa-pinterest fa-lg"></i></a>
                </div>
            </div>

            <div class="border-t border-amber-800 mt-6 pt-6 text-center text-sm text-amber-200">
                &copy; 2025 BookBridge. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Return Confirmation Modal (hidden by default) -->
    <div id="return-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full pop-in">
            <h3 class="text-xl font-bold mb-3 libre text-amber-900">Return Confirmation</h3>
            <p class="text-gray-700 mb-4">Are you sure you want to return "The Lord of the Rings" by J.R.R. Tolkien?
            </p>

            <div class="flex space-x-3 justify-end">
                <button id="cancel-return"
                    class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100 transition duration-300">Cancel</button>
                <button id="confirm-return"
                    class="px-4 py-2 bg-amber-700 text-white rounded-md hover:bg-amber-800 transition duration-300">Confirm
                    Return</button>
            </div>
        </div>
    </div>

    <!-- Return Success Notification (hidden by default) -->
    <div id="success-notification"
        class="fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md hidden slide-in">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
            <div>
                <p class="font-bold">Success!</p>
                <p>Book has been returned successfully.</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Modal functionality for book return
        const returnButton = document.getElementById('return-button');
        const returnModal = document.getElementById('return-modal');
        const cancelReturn = document.getElementById('cancel-return');
        const confirmReturn = document.getElementById('confirm-return');
        const borrowedBooksContainer = document.getElementById('borrowed-books-container');
        const successNotification = document.getElementById('success-notification');

        if (returnButton) {
            returnButton.addEventListener('click', () => {
                returnModal.classList.remove('hidden');
            });
        }

        cancelReturn.addEventListener('click', () => {
            returnModal.classList.add('hidden');
        });

        confirmReturn.addEventListener('click', () => {
            returnModal.classList.add('hidden');

            // Show return success message
            successNotification.classList.remove('hidden');

            // Add animation to the borrowed book
            borrowedBooksContainer.style.animation = 'fadeOut 0.5s forwards';

            // Hide notification after 3 seconds
            setTimeout(() => {
                successNotification.classList.add('hidden');
            }, 3000);

            // Optional: Remove the book from display
            setTimeout(() => {
                borrowedBooksContainer.innerHTML = `
          <div class="p-6 text-center">
            <i class="fas fa-book-open text-amber-300 text-5xl mb-3"></i>
            <h4 class="text-xl font-bold libre text-amber-900">No books currently borrowed</h4>
            <p class="text-gray-600 mt-2">Visit the library to discover your next great read!</p>
            <a href="#"
              class="inline-block mt-4 px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition duration-300">
              <i class="fas fa-search mr-1"></i> Browse Books
            </a>
          </div>
        `;
                borrowedBooksContainer.style.animation = 'fadeIn 0.5s forwards';
            }, 500);
        });

        // Close modal if clicking outside
        returnModal.addEventListener('click', (e) => {
            if (e.target === returnModal) {
                returnModal.classList.add('hidden');
            }
        });

        // Add some animations for search input
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('focus', () => {
            searchInput.classList.add('ring-2');
        });

        searchInput.addEventListener('blur', () => {
            searchInput.classList.remove('ring-2');
        });

        // Logout dropdown functionality
        const userProfile = document.getElementById('user-profile');
        const logoutMenu = document.getElementById('logout-menu');

        // Toggle the visibility of the logout menu when clicking on the user profile icon
        userProfile.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent click event bubbling to the document
            logoutMenu.classList.toggle('hidden');
        });

        // Optional: Click outside to close the logout menu
        document.addEventListener('click', () => {
            if (!logoutMenu.classList.contains('hidden')) {
                logoutMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
