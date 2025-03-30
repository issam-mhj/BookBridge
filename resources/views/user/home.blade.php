<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ancient Library Lounge</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

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
    <nav class="bg-amber-900 bg-opacity-90 py-4 px-8 flex items-center justify-between">
        <div class="text-white text-2xl font-bold">
            <a href="#" class="hover:opacity-80 transition-opacity">
                BookBridge
            </a>
        </div>
        <div class="space-x-4">
            <button class="text-white bg-amber-700 hover:bg-amber-800 px-4 py-2 rounded">
                My Borrowed Books
            </button>
            <button class="text-white bg-amber-700 hover:bg-amber-800 px-4 py-2 rounded">
                My profile
            </button>
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
            <h2 class="text-2xl text-white font-bold mb-4">Search Results</h2>
            <!-- Book Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <!-- Single Book Item -->
                <div
                    class="bg-white bg-opacity-80 rounded shadow-lg p-4 transition transform hover:-translate-y-1 hover:shadow-xl">
                    <img src="https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/PrideAndPrejudice.jpg"
                        alt="Pride and Prejudice cover" class="w-full h-64 object-cover mb-4 rounded" />
                    <h3 class="text-xl font-semibold text-amber-900 text-center">Pride and Prejudice</h3>
                </div>

                <div
                    class="bg-white bg-opacity-80 rounded shadow-lg p-4 transition transform hover:-translate-y-1 hover:shadow-xl">
                    <img src="https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/ToKillAMockingBird.jpg"
                        alt="To Kill a Mockingbird cover" class="w-full h-64 object-cover mb-4 rounded" />
                    <h3 class="text-xl font-semibold text-amber-900 text-center">To Kill a Mockingbird</h3>
                </div>

                <div
                    class="bg-white bg-opacity-80 rounded shadow-lg p-4 transition transform hover:-translate-y-1 hover:shadow-xl">
                    <img src="https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/TheGreatGatsby.jpg"
                        alt="The Great Gatsby cover" class="w-full h-64 object-cover mb-4 rounded" />
                    <h3 class="text-xl font-semibold text-amber-900 text-center">The Great Gatsby</h3>
                </div>

                <div
                    class="bg-white bg-opacity-80 rounded shadow-lg p-4 transition transform hover:-translate-y-1 hover:shadow-xl">
                    <img src="https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/TheCatcherInTheRye.jpg"
                        alt="The Catcher in the Rye cover" class="w-full h-64 object-cover mb-4 rounded" />
                    <h3 class="text-xl font-semibold text-amber-900 text-center">The Catcher in the Rye</h3>
                </div>

                <div
                    class="bg-white bg-opacity-80 rounded shadow-lg p-4 transition transform hover:-translate-y-1 hover:shadow-xl">
                    <img src="https://raw.githubusercontent.com/benoitvallon/100-best-books/master/static/MobyDick.jpg"
                        alt="Moby-Dick cover" class="w-full h-64 object-cover mb-4 rounded" />
                    <h3 class="text-xl font-semibold text-amber-900 text-center">Moby-Dick</h3>
                </div>
                <!-- Repeat more books as needed... -->
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-amber-900 bg-opacity-90 text-white p-4 text-center">
        <p class="mb-2">© 2025 BookBridge</p>
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
