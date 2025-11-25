<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Luxury Beauty</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen">
<header class="border-b border-neutral-800/80 bg-neutral-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="h-9 w-9 rounded-xl border border-neutral-700 bg-neutral-900 flex items-center justify-center text-[10px] font-semibold tracking-[0.2em] uppercase text-neutral-300 group-hover:border-neutral-100 group-hover:text-neutral-100 transition">
                BN
            </div>
            <div class="flex flex-col leading-tight">
                <span class="text-sm font-semibold tracking-tight text-neutral-50">
                    BazzarNow
                </span>
                <span class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                    Luxury Beauty
                </span>
            </div>
        </a>

        <div class="flex items-center gap-4 text-xs font-medium text-neutral-400">
            <a href="{{ route('products.index') }}" class="hover:text-neutral-100 transition">
                Shop
            </a>

            @auth
                <a href="{{ route('cart.index') }}" class="hover:text-neutral-100 transition">
                    Cart
                </a>
                <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard') }}" class="hover:text-neutral-100 transition">
                    Dashboard
                </a>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="hover:text-neutral-100 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="hover:text-neutral-100 transition">
                    Register
                </a>
            @endguest
        </div>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-12 space-y-12">
    {{-- HERO --}}
    <section class="grid gap-10 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)] items-center">
        <div class="space-y-6">
            <p class="text-xs uppercase tracking-[0.28em] text-neutral-500">
                Monochrome beauty • Calm shopping
            </p>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-neutral-50">
                Luxury beauty, <span class="font-light text-neutral-300">in black & white.</span>
            </h1>
            <p class="text-sm text-neutral-400 max-w-lg">
                Skincare, fragrance, and color products curated for a grayscale aesthetic.
                Neutral packaging, focused formulas, and a minimal interface.
            </p>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-neutral-100 bg-neutral-100 text-neutral-900 text-xs font-semibold tracking-[0.16em] uppercase px-5 py-2 hover:bg-white hover:border-white active:scale-[0.98] transition-transform"
                >
                    Browse collection
                </a>
                <a
                    href="#categories"
                    class="inline-flex items-center justify-center rounded-full border border-neutral-700 bg-neutral-950 text-neutral-100 text-xs font-medium px-5 py-2 hover:border-neutral-200 hover:text-neutral-50 transition"
                >
                    Shop by category
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="aspect-[3/4] rounded-[2rem] border border-neutral-800 bg-gradient-to-b from-neutral-900 via-neutral-950 to-black overflow-hidden flex items-center justify-center">
                <div class="w-[70%] h-[70%] rounded-[2.5rem] border border-neutral-700/60 bg-neutral-950 flex items-center justify-center">
                    <div class="w-[65%] h-[65%] rounded-[2rem] border border-neutral-700/40 bg-neutral-900 flex flex-col items-center justify-center gap-3">
                        <span class="text-[10px] uppercase tracking-[0.28em] text-neutral-500">
                            BazzarNow
                        </span>
                        <span class="text-sm text-neutral-100 text-center px-2">
                            Monochrome beauty essentials
                        </span>
                        <span class="text-[11px] text-neutral-400 text-center px-4">
                            Thoughtful textures, quiet packaging.
                        </span>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-5 left-6 rounded-full border border-neutral-800 bg-neutral-950/90 px-4 py-2 text-[11px] text-neutral-300 backdrop-blur">
                Free shipping on orders over $80
            </div>
        </div>
    </section>

    {{-- CATEGORY CHIPS (REAL FILTER LINKS) --}}
    <section id="categories" class="space-y-4">
        <h2 class="text-sm font-semibold tracking-tight text-neutral-50">
            Shop by category
        </h2>

        @php
            $categories = [
                'skincare'  => 'Skincare',
                'fragrance' => 'Fragrance',
                'eyes'      => 'Eyes',
                'lips'      => 'Lips',
                'body'      => 'Body',
            ];
        @endphp

        <div class="flex flex-wrap gap-3 text-[11px]">
            @foreach ($categories as $key => $label)
                <a
                    href="{{ route('products.index', ['category' => $key]) }}"
                    class="inline-flex items-center gap-2 rounded-full border border-neutral-800 bg-neutral-950/80 px-4 py-2 text-neutral-300 hover:border-neutral-100 hover:text-neutral-100 hover:bg-neutral-900 transition"
                >
                    <span class="h-1.5 w-1.5 rounded-full bg-neutral-500"></span>
                    <span class="uppercase tracking-[0.2em]">{{ $label }}</span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- HIGHLIGHTS --}}
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold tracking-tight text-neutral-50">
                Why BazzarNow
            </h2>
            <a href="{{ route('products.index') }}" class="text-[11px] text-neutral-400 hover:text-neutral-100 transition">
                View all products →
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <article class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4 space-y-2">
                <p class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                    Monochrome aesthetic
                </p>
                <p class="text-sm text-neutral-100">
                    Products that sit quietly on the shelf, in neutral packaging and focused tones.
                </p>
            </article>
            <article class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4 space-y-2">
                <p class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                    Curated catalog
                </p>
                <p class="text-sm text-neutral-100">
                    A smaller, edited selection instead of infinite scrolling through noise.
                </p>
            </article>
            <article class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4 space-y-2">
                <p class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                    Calm interface
                </p>
                <p class="text-sm text-neutral-100">
                    A dark, minimal interface built for focus — not aggressive banners.
                </p>
            </article>
        </div>
    </section>

    {{-- EDITORIAL + NEWSLETTER --}}
    <section class="grid gap-6 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
        <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-5 space-y-3">
            <p class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                Night routines
            </p>
            <p class="text-sm text-neutral-100">
                Build a quiet evening ritual.
            </p>
            <p class="text-xs text-neutral-400">
                Combine skincare, fragrance, and body care to create a routine that feels
                consistent every night: same colors, same textures, same calm.
            </p>
        </div>

        <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-5 space-y-3">
            <p class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                Stay in the loop
            </p>
            <p class="text-sm text-neutral-100">
                Sign up for low-noise updates.
            </p>
            <p class="text-xs text-neutral-400">
                Occasional emails about new arrivals and quiet promotions. No constant campaigns.
            </p>
            <form class="mt-3 flex flex-col gap-2 text-xs">
                <input
                    type="email"
                    placeholder="your@email.com"
                    class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-xs text-neutral-100 outline-none focus:border-neutral-200"
                >
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl border border-neutral-700 bg-neutral-100 text-neutral-900 text-[11px] font-semibold tracking-[0.16em] uppercase px-4 py-2 hover:bg-white hover:border-neutral-100 active:scale-[0.98] transition-transform"
                >
                    Subscribe (mock)
                </button>
                <p class="text-[10px] text-neutral-500">
                    This is a demo; no real emails will be sent.
                </p>
            </form>
        </div>
    </section>
</main>
</body>
</html>
