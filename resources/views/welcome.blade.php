<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel School Management') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            github: '#333',
                            linkedin: '#0077B5',
                            portfolio: '#6366F1'
                        }
                    },
                },
            }
        </script>

        <!-- Additional Styles -->
        <style type="text/tailwindcss">
            @layer utilities {
                .content-auto {
                    content-visibility: auto;
                }
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <h1 class="text-xl font-bold text-gray-900">School Management System</h1>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ url('/admin') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 bg-gray-100 px-3 py-2 rounded-md">Admin Panel</a>
                            <a href="{{ url('/teacher') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 bg-gray-100 px-3 py-2 rounded-md">Teacher Panel</a>
                            <a href="{{ url('/student') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 bg-gray-100 px-3 py-2 rounded-md">Student Panel</a>
                            @if (Route::has('login'))
                                <div class="space-x-4">
                                    @auth
                                        <a href="{{ url('/admin') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md">Log in</a>
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                            Welcome to the School Management System
                        </h2>
                        <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                            My entry for the Empire Technologies Challenge. Hope you like it.
                        </p>
                    </div>

                    <!-- Developer Info -->
                    <div class="mt-16">
                        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                            <div class="px-6 py-12">
                                <div class="text-center">
                                    <h3 class="text-3xl font-bold text-gray-900">Developed by Dawit Getachew</h3>
                                    <p class="mt-3 text-xl text-gray-600">Full Stack Software Engineer</p>
                                    
                                    <div class="mt-8 flex justify-center space-x-8">
                                        <a href="https://github.com/DawitGWeldu" target="_blank" 
                                           class="group flex flex-col items-center transition-transform transform hover:scale-110">
                                            <div class="bg-github text-white p-4 rounded-full shadow-lg group-hover:shadow-xl">
                                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="mt-2 text-sm font-medium text-gray-900">GitHub</span>
                                        </a>
                                        <a href="https://www.linkedin.com/in/dawit-g-woldu/" target="_blank" 
                                           class="group flex flex-col items-center transition-transform transform hover:scale-110">
                                            <div class="bg-linkedin text-white p-4 rounded-full shadow-lg group-hover:shadow-xl">
                                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                                </svg>
                                            </div>
                                            <span class="mt-2 text-sm font-medium text-gray-900">LinkedIn</span>
                                        </a>
                                        <a href="https://daves-personal-site.vercel.app/" target="_blank" 
                                           class="group flex flex-col items-center transition-transform transform hover:scale-110">
                                            <div class="bg-portfolio text-white p-4 rounded-full shadow-lg group-hover:shadow-xl">
                                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                </svg>
                                            </div>
                                            <span class="mt-2 text-sm font-medium text-gray-900">Portfolio</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="mt-16">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium text-gray-900">Student Management</h3>
                                    <p class="mt-2 text-sm text-gray-500">Efficiently manage student records, attendance, and academic progress.</p>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium text-gray-900">Teacher Management</h3>
                                    <p class="mt-2 text-sm text-gray-500">Handle teacher profiles, assignments, and performance tracking.</p>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg font-medium text-gray-900">Grade Management</h3>
                                    <p class="mt-2 text-sm text-gray-500">Record and track student grades, generate reports, and analyze performance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

           
        </div>
    </body>
</html>
