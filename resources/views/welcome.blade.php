<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Terpy</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <style>
            /*! tailwindcss v4.0.14 | MIT License | https://tailwindcss.com */
            @layer theme{:root,:host{--font-sans:ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-gray-900:oklch(.21 .034 264.665);--color-zinc-50:oklch(.985 0 0);--color-zinc-200:oklch(.92 .004 286.32);--color-zinc-400:oklch(.705 .015 286.067);--color-zinc-500:oklch(.552 .016 285.938);--color-zinc-600:oklch(.442 .017 285.786);--color-zinc-700:oklch(.37 .013 285.805);--color-zinc-800:oklch(.274 .006 286.033);--color-zinc-900:oklch(.21 .006 285.885);--color-neutral-100:oklch(.97 0 0);--color-neutral-200:oklch(.922 0 0);--color-neutral-700:oklch(.371 0 0);--color-neutral-800:oklch(.269 0 0);--color-neutral-900:oklch(.205 0 0);--color-neutral-950:oklch(.145 0 0);--color-stone-800:oklch(.268 .007 34.298);--color-stone-950:oklch(.147 .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--default-font-family:var(--font-sans);--default-mono-font-family:var(--font-mono);}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji");}body{line-height:inherit}a{color:inherit;text-decoration:inherit}}@layer utilities{.absolute{position:absolute}.relative{position:relative}.top-0{top:calc(var(--spacing)*0)}.right-0{right:calc(var(--spacing)*0)}.flex{display:flex}.flex-col{flex-direction:column}.items-center{align-items:center}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.gap-4{gap:calc(var(--spacing)*4)}.gap-6{gap:calc(var(--spacing)*6)}.p-6{padding:calc(var(--spacing)*6)}.px-5{padding-inline:calc(var(--spacing)*5)}.py-2{padding-block:calc(var(--spacing)*2)}.py-3{padding-block:calc(var(--spacing)*3)}.min-h-screen{min-height:100vh}.w-full{width:100%}.max-w-xl{max-width:36rem}.text-center{text-align:center}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.text-4xl{font-size:2.25rem}.text-6xl{font-size:3.75rem}.font-bold{font-weight:700}.font-medium{font-weight:500}.text-white{color:#fff}.text-gray-600{color:oklch(.446 .03 256.802)}.text-black{color:#000}.rounded-md{border-radius:var(--radius-md)}.rounded-full{border-radius:9999px}.border{border-width:1px}.bg-white{background-color:#fff}.bg-transparent{background-color:transparent}.bg-black{background-color:#000}.transition{transition-property:all;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}.hover\:bg-gray-100:hover{background-color:oklch(.967 .001 286.375)}.hover\:text-black:hover{color:#000}.focus\:outline-none{outline:2px solid transparent}.focus\:ring-2{box-shadow:0 0 0 2px #fff}.dark\:bg-black{background-color:#000}.dark\:text-white{color:#fff}.dark\:border-white{border-color:#fff}.dark\:hover\:bg-white{background-color:#fff}.dark\:hover\:text-black{color:#000}}
            /* Custom Animation for Gradient Text */
            .text-gradient {
                background: linear-gradient(to right, #FF2D20, #FF750F);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen flex flex-col font-sans antialiased selection:bg-[#FF2D20] selection:text-white">

        <header class="w-full flex justify-end p-6">
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-5 py-2 text-sm font-medium border border-transparent rounded-full hover:bg-gray-100 dark:hover:bg-white/10 transition"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2 text-sm font-medium border border-transparent rounded-full hover:bg-gray-100 dark:hover:bg-white/10 transition"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-5 py-2 text-sm font-medium text-white bg-black dark:bg-white dark:text-black rounded-full hover:opacity-80 transition"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-grow flex flex-col items-center justify-center text-center px-6">
            <div class="max-w-xl">
                <h1 class="text-6xl font-bold tracking-tight mb-2">
                    <span class="text-gradient">Terpy</span>
                </h1>
                
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                    Modern Laravel Application. <br class="hidden sm:block"> 
                    Simple, Secure, and Scalable.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 rounded-full bg-[#FF2D20] hover:bg-[#e0261a] text-white font-bold transition shadow-lg hover:shadow-xl">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-3 rounded-full bg-[#FF2D20] hover:bg-[#e0261a] text-white font-bold transition shadow-lg hover:shadow-xl">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-3 rounded-full border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition font-medium">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </main>

        <footer class="py-6 text-center text-sm text-gray-500 dark:text-gray-500">
            &copy; {{ date('Y') }} Terpy. Built with Laravel 12.
        </footer>
    </body>
</html>