<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen">

    {{-- HEADER --}}
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
                        Cart
                    </span>
                </div>
            </a>

            @php
                $user           = auth()->user();
                $initial        = mb_strtoupper(mb_substr($user->name, 0, 1));
                $avatar         = $user->profile_image_path ? asset('storage/' . $user->profile_image_path) : null;
                $dashboardRoute = $user->is_admin ? route('admin.dashboard') : route('dashboard');
            @endphp

            <div class="flex items-center gap-4 text-xs font-medium text-neutral-400">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                    {{-- change this icon (shop) --}}
                    <span>🛍️</span>
                    <span>Shop</span>
                </a>

                <span class="inline-flex items-center gap-2 rounded-full border border-neutral-800 bg-neutral-950/80 px-3 py-1">
                    {{-- change this icon (cart) --}}
                    <span>🛒</span>
                    <span>{{ $cartCount }} item{{ $cartCount === 1 ? '' : 's' }}</span>
                </span>

                {{-- Profile dropdown --}}
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
                        {{-- change this icon (chevron / dropdown) --}}
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
                                    <span>⟲</span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="max-w-6xl mx-auto px-4 py-10 space-y-6">
        <div class="flex items-center justify-between gap-4 mb-2">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-neutral-500 mb-2">Cart</p>
                <h1 class="text-2xl font-semibold tracking-tight text-neutral-50">
                    Your bag
                </h1>
                <p class="text-sm text-neutral-400">
                    Review your selection before checkout.
                </p>
            </div>

            <div class="text-xs text-neutral-500 text-right">
                <div>Total items: <span class="text-neutral-100">{{ $cartCount }}</span></div>
                <div>Total amount:
                    <span class="text-neutral-100">${{ number_format($total / 100, 2) }}</span>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div class="rounded-xl border border-neutral-700 bg-neutral-900 px-4 py-3 text-xs text-neutral-200">
                {{ session('status') }}
            </div>
        @endif

        @if ($items->isEmpty())
            <p class="text-sm text-neutral-500">
                Your cart is empty. Visit the
                <a href="{{ route('products.index') }}" class="underline hover:text-neutral-200">products</a>
                page to start shopping.
            </p>
        @else
            <section class="grid gap-6 md:grid-cols-[minmax(0,3fr)_minmax(0,2fr)]">
                {{-- ITEMS --}}
                <div class="space-y-3">
                    @foreach ($items as $item)
                        <div class="flex gap-3 rounded-2xl border border-neutral-800 bg-neutral-950/80 p-3">
                            <div class="h-20 w-20 rounded-xl overflow-hidden bg-neutral-900 flex-shrink-0">
                                <img
                                    src="{{ $item->product->image_url }}"
                                    alt="{{ $item->product->name }}"
                                    class="h-full w-full object-cover"
                                >
                            </div>

                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-sm text-neutral-100">
                                        {{ $item->product->name }}
                                    </p>
                                    <p class="text-[11px] text-neutral-500">
                                        ${{ number_format($item->product->price / 100, 2) }} each
                                    </p>
                                </div>

                                <div class="flex items-center justify-between gap-3 mt-2">
                                    <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input
                                            type="number"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            class="w-16 rounded-md bg-neutral-900 border border-neutral-700 px-2 py-1 text-xs text-neutral-100"
                                        />
                                        <button type="submit" class="text-[11px] text-neutral-300 hover:text-neutral-50 transition">
                                            Update
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[11px] text-red-300 hover:text-red-200 transition">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- SUMMARY --}}
                <aside class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-5 space-y-4">
                    <div>
                        <h2 class="text-sm font-semibold tracking-tight text-neutral-50">
                            Order summary
                        </h2>
                        <p class="text-[11px] text-neutral-500 mt-1">
                            Taxes and shipping calculated at checkout.
                        </p>
                    </div>

                    <div class="space-y-2 text-xs text-neutral-400">
                        <div class="flex items-center justify-between">
                            <span>Subtotal</span>
                            <span>${{ number_format($total / 100, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Shipping</span>
                            <span class="text-neutral-500">Calculated at checkout</span>
                        </div>
                    </div>

                    <div class="border-t border-neutral-800 pt-3 flex items-center justify-between text-sm">
                        <span class="text-neutral-300">Total</span>
                        <span class="text-neutral-50 font-semibold">
                            ${{ number_format($total / 100, 2) }}
                        </span>
                    </div>

                    <button
                        type="button"
                        id="checkout-button"
                        class="w-full inline-flex items-center justify-center rounded-xl border border-neutral-700 bg-neutral-100 text-neutral-900 text-xs font-semibold tracking-[0.16em] uppercase px-4 py-2 hover:bg-white hover:border-neutral-100 active:scale-[0.98] transition-transform"
                    >
                        Checkout (demo)
                    </button>
                </aside>
            </section>
        @endif
    </main>

    {{-- Checkout modal --}}
    <div
        id="checkout-modal"
        class="hidden fixed inset-0 z-40 flex items-center justify-center bg-black/70 backdrop-blur-sm"
    >
        <div class="w-full max-w-sm rounded-2xl border border-neutral-800 bg-neutral-950 px-5 py-4 text-sm">
            <h2 class="text-neutral-50 font-semibold text-base">
                Checkout (demo)
            </h2>
            <p class="mt-2 text-xs text-neutral-400">
                In a real store, this step would collect your shipping address and payment details, then securely charge your card.
            </p>
            <p class="mt-1 text-xs text-neutral-400">
                Here we’re only simulating checkout: your cart will be cleared and this order will be saved to your personal history.
            </p>

            <form method="POST" action="{{ route('cart.checkout') }}" class="mt-4 flex items-center justify-end gap-2 text-xs">
                @csrf
                <button
                    type="button"
                    id="checkout-cancel"
                    class="rounded-full border border-neutral-800 bg-neutral-950 px-3 py-1.5 text-neutral-300 hover:border-neutral-200 hover:text-neutral-50 transition"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="rounded-full border border-neutral-700 bg-neutral-100 text-neutral-900 px-3 py-1.5 font-semibold hover:bg-white hover:border-neutral-100 transition"
                >
                    Purchase anyway
                </button>
            </form>
        </div>
    </div>

    <script>
        // dropdown
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

        // checkout modal
        const checkoutButton = document.getElementById('checkout-button');
        const checkoutModal  = document.getElementById('checkout-modal');
        const checkoutCancel = document.getElementById('checkout-cancel');

        if (checkoutButton) {
            checkoutButton.addEventListener('click', () => {
                checkoutModal.classList.remove('hidden');
            });
        }

        if (checkoutCancel) {
            checkoutCancel.addEventListener('click', () => {
                checkoutModal.classList.add('hidden');
            });
        }
    </script>
</body>
</html>
