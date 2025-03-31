<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ancient Library Lounge</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        /* Old paper background for the body */
        body {
            background: url('https://images.unsplash.com/photo-1561894820-7f73ccf44431?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Georgia', serif;
        }

        /* Optional custom scrollbar (just a nice detail) */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #a27c67;
            border-radius: 4px;
        }

        /* A "wooden shelf" effect behind the books */
        .shelf {
            background: url('https://images.unsplash.com/photo-1580327332881-1c79619aee13?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') center/cover;
            border-radius: 0.5rem;
        }

        /* Optional subtle fade-in for the shelf container */
        .fade-in {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .fade-in.visible {
            opacity: 1;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
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
                <div
                    class="w-10 h-10 bg-amber-600 rounded-full flex items-center justify-center cursor-pointer hover:bg-amber-500 transition duration-300">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </nav>




    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <header class="text-center mb-8">
            <h1 class="text-4xl text-amber-900 font-bold mb-2">Welcome to the Library</h1>
            <p class="text-amber-800 text-lg">
                Browse our extensive collection of books across various genres.
            </p>
            <p class="text-amber-800 text-lg">
                Click on any book to view details and borrow if available.
            </p>
        </header>

        <!-- Search Bar -->
        <div class="flex justify-center mb-8">
            <input type="text" placeholder="Search for a book..."
                class="w-1/2 p-2 rounded border border-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500" />
        </div>

        <!-- Bookshelf Section -->
        <section id="bookShelf" class="fade-in shelf p-6">
            <!-- Book Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <!-- Single Book Item -->
                @forelse ($books as $book)
                    <a href="/book/{{ $book['id'] }}"
                        class="bg-white bg-opacity-80 rounded shadow-lg p-4 transition transform hover:-translate-y-1 hover:shadow-xl">
                        <img src="{{ asset('storage/' . $book['image']) }}" alt="Pride and Prejudice cover"
                            class="w-full h-64 object-cover mb-4 rounded" />
                        <h3 class="text-xl font-semibold text-amber-900 text-center">{{ $book['title'] }}</h3>
                        <h3 class="text-xs text-amber-700 text-center">by {{ $book['author'] }}</h3>
                    </a>
                @empty
                    no books available
                @endforelse
            </div>
        </section>
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


    <!-- JavaScript for fade-in effect -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const shelf = document.getElementById('bookShelf');
            setTimeout(() => {
                shelf.classList.add('visible');
            }, 200);
        });
    </script>
</body>

</html>
