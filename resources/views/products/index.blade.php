<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen">

    {{-- HEADER --}}
    <header class="border-b border-neutral-800/80 bg-neutral-950/90 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="h-9 w-9 rounded-xl border border-neutral-700 bg-neutral-900 flex items-center justify-center text-[10px] font-semibold tracking-[0.2em] uppercase text-neutral-300 group-hover:border-neutral-100 group-hover:text-neutral-100 transition">
                    BN
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-sm font-semibold tracking-tight text-neutral-50">
                        BazzarNow
                    </span>
                    <span class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                        Monochrome Market
                    </span>
                </div>
            </a>

            <div class="flex items-center gap-4 text-xs font-medium text-neutral-400">
                {{-- Cart --}}
                <a
                    href="{{ auth()->check() ? route('cart.index') : route('login') }}"
                    class="relative inline-flex items-center gap-2 rounded-full border border-neutral-800 bg-neutral-950/80 px-3 py-1 hover:border-neutral-200 hover:text-neutral-100 transition"
                >
                    {{-- change this icon (cart) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M2.997 3.496a.5.5 0 0 1 .5-.5h.438c.727 0 1.145.473 1.387.945c.165.323.284.717.383 1.059H16a1 1 0 0 1 .962 1.272l-1.496 5.275A2 2 0 0 1 13.542 13H8.463a2 2 0 0 1-1.93-1.473l-.642-2.355l-.01-.032l-1.03-3.498l-.1-.337c-.1-.346-.188-.652-.32-.909c-.159-.31-.305-.4-.496-.4h-.438a.5.5 0 0 1-.5-.5M8.5 17a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3"/></svg>
                    <span>Cart</span>
                    @if (!empty($cartCount) && $cartCount > 0)
                        <span class="inline-flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-neutral-100 text-neutral-900 text-[10px] font-semibold px-1">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Auth --}}
                @auth
                    @php
                        $user           = auth()->user();
                        $initial        = mb_strtoupper(mb_substr($user->name, 0, 1));
                        $avatar         = $user->profile_image_path ? asset('storage/' . $user->profile_image_path) : null;
                        $dashboardRoute = $user->is_admin ? route('admin.dashboard') : route('dashboard');
                        $purchasedCount = $purchasedCount ?? 0;
                    @endphp

                    <div class="relative">
                        <button
                            type="button"
                            data-dropdown-toggle="user-menu"
                            class="inline-flex items-center gap-2 rounded-full border border-neutral-800 bg-neutral-950/80 px-3 py-1.5 hover:border-neutral-200 hover:text-neutral-100 transition"
                        >
                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-neutral-100 text-neutral-900 text-xs font-semibold overflow-hidden">
                                @if ($avatar)
                                    <img src="{{ $avatar }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                @else
                                    {{ $initial }}
                                @endif
                            </span>
                            <div class="hidden sm:flex flex-col items-start leading-tight">
                                <span class="text-[11px] text-neutral-300 truncate max-w-[120px]">
                                    {{ $user->name }}
                                </span>
                                <span class="text-[10px] text-neutral-500">
                                    {{ $user->is_admin ? 'Admin' : 'Customer' }}
                                </span>
                            </div>
                            {{-- change this icon (chevron) --}}
                            <span class="text-[10px] text-neutral-500">▾</span>
                        </button>

                        <div
                            data-dropdown-panel="user-menu"
                            class="absolute right-0 mt-2 w-64 rounded-2xl border border-neutral-800 bg-neutral-950/95 shadow-[0_0_30px_rgba(0,0,0,0.8)] p-4 z-20 hidden"
                        >
                            <div class="flex items-start gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-neutral-100 text-neutral-900 text-sm font-semibold overflow-hidden">
                                    @if ($avatar)
                                        <img src="{{ $avatar }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                    @else
                                        {{ $initial }}
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm text-neutral-50 font-medium">
                                            {{ $user->name }}
                                        </p>
                                        @if ($user->is_admin)
                                            <span class="rounded-full border border-neutral-700 px-2 py-[2px] text-[10px] uppercase tracking-[0.16em] text-neutral-300">
                                                Admin
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] text-neutral-500 truncate">
                                        {{ $user->email }}
                                    </p>
                                    <p class="mt-1 text-[10px] text-neutral-600">
                                        Member since {{ $user->created_at->format('M Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3 text-[11px] text-neutral-400">
                                <div class="rounded-xl border border-neutral-800 bg-neutral-950/80 px-3 py-2">
                                    <p class="text-[10px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                                        In cart
                                    </p>
                                    <p class="text-sm text-neutral-50 font-semibold">
                                        {{ $cartCount ?? 0 }}
                                    </p>
                                </div>
                                <div class="rounded-xl border border-neutral-800 bg-neutral-950/80 px-3 py-2">
                                    <p class="text-[10px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                                        Purchased
                                    </p>
                                    <p class="text-sm text-neutral-50 font-semibold">
                                        {{ $purchasedCount }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 border-t border-neutral-900 pt-3 flex items-center justify-between text-[11px]">
                                <div class="flex flex-col gap-1">
                                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                                        {{-- change this icon (profile) --}}
                                        <span>⚙️</span>
                                        <span>Profile</span>
                                    </a>

                                    <a href="{{ $dashboardRoute }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                                        {{-- change this icon (dashboard) --}}
                                        <span>📂</span>
                                        <span>Dashboard</span>
                                    </a>
                                </div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 text-neutral-500 hover:text-neutral-100 transition">
                                        {{-- change this icon (logout) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M12 4.354v6.65h7.442L17.72 9.28a.75.75 0 0 1-.073-.977l.073-.084a.75.75 0 0 1 .976-.072l.084.072l2.997 2.998a.75.75 0 0 1 .073.976l-.073.084l-2.996 3.003a.75.75 0 0 1-1.134-.975l.072-.084l1.713-1.717h-7.431L12 19.25a.75.75 0 0 1-.88.738l-8.5-1.501a.75.75 0 0 1-.62-.739V5.75a.75.75 0 0 1 .628-.74l8.5-1.396a.75.75 0 0 1 .872.74m-3.498 7.145a1.002 1.002 0 1 0 0 2.005a1.002 1.002 0 0 0 0-2.005M13 18.502h.765l.102-.007a.75.75 0 0 0 .648-.744l-.007-4.25H13zM13.002 10L13 8.725V5h.745a.75.75 0 0 1 .743.647l.007.101l.007 4.252z"/></svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                        {{-- change this icon (login) --}}
                        <span>🔐</span>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                        {{-- change this icon (register) --}}
                        <span>🧾</span>
                        <span>Register</span>
                    </a>
                @endguest
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="max-w-6xl mx-auto px-4 py-10">
        {{-- Header + stats --}}
        <section class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-neutral-500 mb-2">Catalog</p>
                <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-neutral-50">
                    Products
                </h1>
                <p class="mt-2 text-sm text-neutral-400 max-w-md">
                    Monochrome beauty across skincare, fragrance, eyes, lips, and body.
                </p>
            </div>

            @if ($products->count())
                <div class="text-xs text-neutral-500 text-right">
                    <div>
                        Showing
                        <span class="text-neutral-100">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
                        of
                        <span class="text-neutral-100">{{ $products->total() }}</span>
                    </div>
                    <div class="mt-1">
                        Page
                        <span class="text-neutral-100">{{ $products->currentPage() }}</span>
                        of
                        <span class="text-neutral-100">{{ $products->lastPage() }}</span>
                    </div>
                </div>
            @endif
        </section>

        {{-- CATEGORY FILTERS --}}
        <section class="mb-8">
            @php
                $activeCategory = request('category');
                $labels = [
                    'skincare'  => 'Skincare',
                    'fragrance' => 'Fragrance',
                    'eyes'      => 'Eyes',
                    'lips'      => 'Lips',
                    'body'      => 'Body',
                ];
            @endphp
            <div class="flex flex-wrap gap-3 text-[11px]">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 rounded-full border {{ $activeCategory ? 'border-neutral-800 text-neutral-400' : 'border-neutral-100 text-neutral-950 bg-neutral-100' }} bg-neutral-950/80 px-4 py-2 hover:border-neutral-100 hover:text-neutral-100 hover:bg-neutral-900 transition"
                >
                    <span class="uppercase tracking-[0.2em]">All</span>
                </a>

                @foreach ($labels as $key => $label)
                    @php $isActive = $activeCategory === $key; @endphp
                    <a
                        href="{{ route('products.index', ['category' => $key]) }}"
                        class="inline-flex items-center gap-2 rounded-full border {{ $isActive ? 'border-neutral-100 text-neutral-950 bg-neutral-100' : 'border-neutral-800 text-neutral-300 bg-neutral-950/80' }} px-4 py-2 hover:border-neutral-100 hover:text-neutral-100 hover:bg-neutral-900 transition"
                    >
                        <span class="h-1.5 w-1.5 rounded-full {{ $isActive ? 'bg-neutral-900' : 'bg-neutral-500' }}"></span>
                        <span class="uppercase tracking-[0.2em]">{{ $label }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- PRODUCTS GRID --}}
        @if ($products->count())
            <section class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($products as $product)
                    @php
                        $img = $product->image_path
                            ? asset('storage/' . $product->image_path)
                            : $product->image_url;
                    @endphp

                    <article class="group rounded-2xl border border-neutral-800/80 bg-neutral-950/80 overflow-hidden shadow-[0_0_0_1px_rgba(255,255,255,0.02)] hover:border-neutral-100/40 hover:shadow-[0_0_30px_rgba(255,255,255,0.06)] transition-all duration-200">
                        <div class="aspect-square overflow-hidden bg-neutral-900">
                            <img
                                src="{{ $img }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                        </div>

                        <div class="p-4 flex flex-col gap-3">
                            <div class="flex items-center justify-between gap-2">
                                <h2 class="text-sm font-medium text-neutral-50 line-clamp-2">
                                    {{ $product->name }}
                                </h2>
                                <span class="text-[10px] uppercase tracking-[0.18em] text-neutral-500">
                                    {{ $labels[$product->category] ?? $product->category }}
                                </span>
                            </div>

                            {{-- Rating display --}}
                            <div class="flex items-center justify-between text-[11px] text-neutral-400">
                                <div class="flex items-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= (int)$product->rating)
                                            <span class="text-neutral-50">★</span>
                                        @else
                                            <span class="text-neutral-700">★</span>
                                        @endif
                                    @endfor
                                    <span class="ml-1 text-neutral-500">
                                        {{ $product->rating }}/5
                                    </span>
                                </div>
                            </div>

                            {{-- (Optional) Rating form for users --}}
                            @auth
                                <form
                                    method="POST"
                                    action="{{ route('products.rate', $product) }}"
                                    class="flex items-center gap-1 text-[10px] text-neutral-500"
                                >
                                    @csrf
                                    <span class="mr-1">Rate:</span>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button
                                            type="submit"
                                            name="rating"
                                            value="{{ $i }}"
                                            class="px-[5px] py-[1px] rounded-full border border-transparent hover:border-neutral-500 hover:bg-neutral-900 text-xs {{ (int)$product->rating === $i ? 'text-neutral-50' : 'text-neutral-500' }}"
                                        >
                                            ★
                                        </button>
                                    @endfor
                                </form>
                            @endauth

                            <div class="flex items-center justify-between gap-2 mt-2">
                                <div class="text-sm font-semibold text-neutral-50">
                                    ${{ number_format($product->price / 100, 2) }}
                                </div>
                            </div>

                            <form method="POST" action="{{ route('cart.store') }}" class="mt-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <button
                                    type="submit"
                                    class="w-full inline-flex items-center justify-center rounded-xl border border-neutral-700 bg-neutral-900 px-3 py-2 text-xs font-medium tracking-[0.16em] uppercase text-neutral-100 hover:bg-neutral-50 hover:text-neutral-950 hover:border-neutral-50 active:scale-[0.98] transition-transform duration-150">
                                    {{-- change this icon (add to cart) --}}
                                    🛒 Add to cart
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </section>

            {{-- PAGINATION (inline monochrome, no view) --}}
            @if ($products->hasPages())
                <div class="mt-10 flex justify-center">
                    <nav class="inline-flex items-center gap-3 text-xs text-neutral-400" aria-label="Pagination">
                        <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full border border-neutral-800 bg-neutral-950/80">
                            Page
                            <span class="mx-1 text-neutral-100">{{ $products->currentPage() }}</span>
                            of
                            <span class="ml-1 text-neutral-100">{{ $products->lastPage() }}</span>
                        </span>

                        <div class="inline-flex items-center gap-2">
                            {{-- Prev --}}
                            @if ($products->onFirstPage())
                                <span class="px-3 py-1 rounded-full border border-neutral-900 bg-neutral-950/60 text-neutral-600 cursor-not-allowed">
                                    Prev
                                </span>
                            @else
                                <a
                                    href="{{ $products->previousPageUrl() }}"
                                    class="px-3 py-1 rounded-full border border-neutral-700 bg-neutral-950/80 hover:bg-neutral-100 hover:text-neutral-950 hover:border-neutral-100 transition"
                                >
                                    Prev
                                </a>
                            @endif

                            {{-- Next --}}
                            @if ($products->hasMorePages())
                                <a
                                    href="{{ $products->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-full border border-neutral-700 bg-neutral-950/80 hover:bg-neutral-100 hover:text-neutral-950 hover:border-neutral-100 transition"
                                >
                                    Next
                                </a>
                            @else
                                <span class="px-3 py-1 rounded-full border border-neutral-900 bg-neutral-950/60 text-neutral-600 cursor-not-allowed">
                                    Next
                                </span>
                            @endif
                        </div>
                    </nav>
                </div>
            @endif
        @else
            <p class="text-neutral-500 text-sm">No products yet.</p>
        @endif
    </main>

    {{-- DROPDOWN JS --}}
    <script>
        document.addEventListener('click', (event) => {
            const toggle = event.target.closest('[data-dropdown-toggle]');
            const panels = document.querySelectorAll('[data-dropdown-panel]');

            if (toggle) {
                const id = toggle.getAttribute('data-dropdown-toggle');
                panels.forEach(panel => {
                    if (panel.getAttribute('data-dropdown-panel') === id) {
                        panel.classList.toggle('hidden');
                    } else {
                        panel.classList.add('hidden');
                    }
                });
            } else {
                panels.forEach(panel => panel.classList.add('hidden'));
            }
        });
    </script>
</body>
</html>
