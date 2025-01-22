<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduCourse</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        :root {
            --primary-color: #a3d9a5; /* Light Green */
            --primary-hover: #8cc89d; /* Darker Light Green */
            --primary-dark: #6db381; /* Dark Green */
        }
        body {
            background-color: var(--primary-color);
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="text-gray-800">
    <header class="bg-white py-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div>
                <a href="#" class="text-3xl font-bold text-gray-800">EduCourse</a>
            </div>
            <nav class="space-x-6">
                <a href="#features" class="hover:underline text-gray-700">Features</a>
                <a href="#about" class="hover:underline text-gray-700">About</a>
                <a href="#contact" class="hover:underline text-gray-700">Contact</a>
                <a href="/login" class="bg-gray-800 text-white px-4 py-2 rounded-full hover:bg-gray-600">Login</a>
            </nav>
        </div>
    </header>

    <section id="hero" class="min-h-screen flex items-center text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-extrabold mb-6 text-gray-800">Welcome to EduCourse</h1>
            <p class="text-xl mb-8 text-gray-700">A modern platform to simplify your data management with advanced features and intuitive interface.</p>
            <a href="/register" class="bg-gray-800 text-white px-6 py-3 text-xl rounded-lg hover:bg-gray-600">Get Started</a>
        </div>
    </section>

    <section id="features" class="py-16 bg-white text-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg text-center">
                    <img src="/img/raul.jpg" alt="Feature 1" class="mx-auto mb-4 h-24">
                    <h3 class="text-2xl font-semibold mb-2">Data Management</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio rem amet dolorem nisi! Consequuntur ab similique vel ratione, minus culpa iure maxime placeat doloremque corporis illum beatae assumenda perspiciatis earum!</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg text-center">
                    <img src="/img/raul.jpg" alt="Feature 2" class="mx-auto mb-4 h-24">
                    <h3 class="text-2xl font-semibold mb-2">Real-time Reports</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla, soluta! Adipisci obcaecati cum alias vel reprehenderit corrupti iste facilis a minima accusantium, similique laboriosam, fugiat, sint aut deleniti ullam unde.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg text-center">
                    <img src="/img/raul.jpg" alt="Feature 3" class="mx-auto mb-4 h-24">
                    <h3 class="text-2xl font-semibold mb-2">Data Security</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem asperiores consequuntur culpa quia quod est laborum! Eos at nihil enim autem fugit provident expedita. Accusamus modi ea id non placeat..</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-16 bg-[#a3d9a5] text-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">About the Platform</h2>
            <p class="text-xl max-w-3xl mx-auto">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi obcaecati consequuntur eveniet minima dolorem repellat cumque maiores et laborum deleniti tempore nihil, repellendus modi dolorum id, assumenda odit veniam rerum?
            </p>
        </div>
    </section>

    <section id="contact" class="py-16 bg-white text-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-6">Contact Us</h2>
            <form class="max-w-lg mx-auto bg-gray-100 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required></textarea>
                </div>
                <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Submit</button>
            </form>
        </div>
    </section>

    <footer class="bg-gray-900 text-center py-6 text-white">
        <p>&copy; {{ date('Y') }} EduCourse. All rights reserved.</p>
    </footer>
</body>
</html>

