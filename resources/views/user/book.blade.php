<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Lending Lounge - The Lord of the Rings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f5f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .book-cover {
            transition: transform 0.6s ease-in-out;
        }

        .book-cover:hover {
            transform: translateY(-10px) rotateY(10deg);
            box-shadow: 10px 15px 25px rgba(0, 0, 0, 0.3);
        }

        .page-turn {
            position: relative;
            overflow: hidden;
        }

        .page-turn::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            background: linear-gradient(135deg, transparent 50%, rgba(255, 255, 255, 0.2) 50%);
            border-radius: 0 0 0 20px;
            transition: all 0.3s ease-out;
        }

        .page-turn:hover::after {
            width: 60px;
            height: 60px;
        }

        .sparkle {
            animation: sparkle 2s infinite;
            transform-origin: center;
        }

        @keyframes sparkle {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.8;
            }
        }

        .float-effect {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .magic-text {
            background: linear-gradient(45deg, #7e5926, #d4af37, #7e5926);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 3s linear infinite;
        }

        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }

        .btn-borrow {
            transition: all 0.3s ease;
        }

        .btn-borrow:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .popup-notification {
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.5s ease-out;
        }

        .popup-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .ring-animation {
            animation: ring-rotate 20s linear infinite;
        }

        @keyframes ring-rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
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

        .hover-shadow:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
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
    <main class="container mx-auto p-4 my-8">
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
        <div class="mb-6">
            <a href="/home">
                <button id="backBtn"
                    class="flex items-center gap-2 px-4 py-2 border border-amber-800 rounded-lg hover:bg-amber-100 transition fade-in">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Library</span>
                </button>
            </a>
        </div>

        <div class="bg-amber-50 rounded-xl shadow-lg p-6 flex flex-col md:flex-row fade-in">
            <!-- Book Cover -->
            <div class="md:w-1/3 flex justify-center items-start md:p-6">
                <div class="relative">
                    <img src="{{ asset('storage/' . $book['image']) }}" alt="The Lord of the Rings book cover"
                        class="book-cover rounded-lg shadow-md hover-shadow">
                    <div class="absolute top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 opacity-0 ring-animation"
                        id="magicRing">
                        <svg viewBox="0 0 100 100" class="w-full h-full">
                            <circle cx="50" cy="50" r="30" fill="none" stroke="#d4af37"
                                stroke-width="3" />
                            <text x="50" y="53" text-anchor="middle" fill="#d4af37"
                                font-size="4">{{ $book['subtitle'] }}</text>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Book Details -->
            <div class="md:w-2/3 md:pl-8 mt-6 md:mt-0">
                <h2 class="text-3xl font-bold text-amber-900 magic-text">{{ $book['title'] }}</h2>
                <h3 class="text-xl text-gray-700 mt-2">by {{ $book['author'] }}</h3>

                <div class="flex items-center gap-4 mt-4">
                    <span
                        class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">{{ $book->category['name'] }}</span>
                </div>

                <div class="mt-8">
                    <h4 class="text-xl font-semibold text-amber-900 mb-3">Description</h4>
                    <p class="text-gray-700 leading-relaxed page-turn">
                        {{ $book['subtitle'] }}
                    </p>
                    <p class="text-gray-700 leading-relaxed mt-4 page-turn">
                        {{ $book['description'] }}
                    </p>
                </div>

                <div class="mt-8 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        @if ($book['status'] == 'available')
                            <span class="w-4 h-4 bg-green-500 rounded-full sparkle"></span>
                            <span>Available to borrow</span>
                        @else
                            <span class="w-4 h-4 bg-red-500 rounded-full sparkle"></span>
                            <span>not available</span>
                        @endif
                    </div>
                    @if ($book['status'] == 'available')
                        <form action="/borrow/{{ $book['id'] }}" method="post">
                            @csrf
                            <button
                                class="bg-amber-800 text-white px-6 py-3 rounded-lg font-semibold btn-borrow hover:bg-amber-700">
                                Borrow Book
                            </button>
                    @endif
                </div>


            </div>
        </div>

        <!-- Related Books -->
        <div class="mt-12 fade-in" style="animation-delay: 0.2s;">
            <h3 class="text-2xl font-bold text-amber-900 mb-6">You might also enjoy</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($lastFourBooks as $book)
                    <!-- Book 1 -->
                    <a href="/book/{{ $book['id'] }}">
                        <div class="bg-white rounded-lg shadow-md p-4 hover-shadow transition float-effect">
                            <img src="{{ asset('storage/' . $book['image']) }}" alt="The Hobbit"
                                class="w-full h-64 object-cover rounded mb-4">
                            <h4 class="font-semibold text-amber-900">{{ $book['title'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $book['author'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
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
                    <a href="#" class="hover:text-amber-200 transition"><i
                            class="fab fa-pinterest fa-lg"></i></a>
                </div>
            </div>

            <div class="border-t border-amber-800 mt-6 pt-6 text-center text-sm text-amber-200">
                &copy; 2025 BookBridge. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Book cover hover effect with magical ring
            const bookCover = document.querySelector('.book-cover');
            const magicRing = document.getElementById('magicRing');

            bookCover.addEventListener('mouseenter', function() {
                magicRing.style.opacity = '0.7';
            });

            bookCover.addEventListener('mouseleave', function() {
                magicRing.style.opacity = '0';
            });

            // Borrow button functionality
            const borrowBtn = document.getElementById('borrowBtn');
            const notification = document.getElementById('notification');

            borrowBtn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-check mr-2"></i> Borrowed';
                this.classList.add('bg-green-600');
                this.classList.remove('bg-amber-800', 'hover:bg-amber-700');

                // Show notification
                notification.classList.add('show');

                // Hide notification after 3 seconds
                setTimeout(function() {
                    notification.classList.remove('show');
                }, 3000);

                // Add a small page flip animation
                const pageFlipSound = new Audio(
                    'data:audio/wav;base64,UklGRigAAABXQVZFZm10IBAAAAABAAEARKwAAIhYAQACABAAZGF0YQQAAAAnAA=='
                );
                pageFlipSound.play().catch(e => console.log('Audio play prevented by browser policy'));
            });

            // Implement page turn effect on description paragraphs
            const paragraphs = document.querySelectorAll('.page-turn');
            paragraphs.forEach(p => {
                p.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'rgba(253, 230, 203, 0.3)';
                });

                p.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'transparent';
                });
            });

            // Back button animation
            const backBtn = document.getElementById('backBtn');
            backBtn.addEventListener('mouseenter', function() {
                this.querySelector('i').style.transform = 'translateX(-3px)';
            });

            backBtn.addEventListener('mouseleave', function() {
                this.querySelector('i').style.transform = 'translateX(0)';
            });

            // Book rating interaction
            const stars = document.querySelectorAll('.fa-star, .fa-star-half-alt');
            stars.forEach((star, index) => {
                star.addEventListener('mouseenter', function() {
                    for (let i = 0; i <= index; i++) {
                        stars[i].classList.add('text-yellow-300');
                        stars[i].classList.add('scale-110');
                        stars[i].style.transform = 'scale(1.2)';
                    }
                });

                star.addEventListener('mouseleave', function() {
                    stars.forEach(s => {
                        s.classList.remove('text-yellow-300');
                        s.style.transform = 'scale(1)';
                    });
                });
            });

            // Add scroll-triggered animations
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.float-effect').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                observer.observe(el);
            });

            // Add dynamic book cover tilt effect based on mouse position
            const containerRect = document.querySelector('main').getBoundingClientRect();
            document.addEventListener('mousemove', function(e) {
                if (window.innerWidth >= 768) { // Only on desktop
                    const mouseX = e.clientX;
                    const mouseY = e.clientY;

                    const centerX = containerRect.left + containerRect.width / 2;
                    const centerY = containerRect.top + containerRect.height / 2;

                    const percentX = (mouseX - centerX) / (containerRect.width / 2);
                    const percentY = (mouseY - centerY) / (containerRect.height / 2);

                    const tiltAmount = 5;
                    bookCover.style.transform =
                        `rotateY(${percentX * tiltAmount}deg) rotateX(${-percentY * tiltAmount}deg)`;
                }
            });

            // Reset tilt when mouse leaves
            document.addEventListener('mouseleave', function() {
                bookCover.style.transform = 'rotateY(0deg) rotateX(0deg)';
            });

            // Add typing effect to book description
            const typeDescription = () => {
                const descriptions = document.querySelectorAll('.page-turn');
                const originalTexts = Array.from(descriptions).map(desc => desc.textContent);

                descriptions.forEach((desc, index) => {
                    const text = originalTexts[index];
                    desc.textContent = '';
                    let i = 0;

                    setTimeout(() => {
                        const typing = setInterval(() => {
                            if (i < text.length) {
                                desc.textContent += text.charAt(i);
                                i++;
                            } else {
                                clearInterval(typing);
                            }
                        }, 5);
                    }, index * 100);
                });
            };

            // Run typing effect on page load
            setTimeout(typeDescription, 1000);


        });
        const successMessage = document.getElementById("successMessage");
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }
    </script>
</body>

</html>
