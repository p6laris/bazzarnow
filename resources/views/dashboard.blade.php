<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Dashboard</title>
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
                        Your Dashboard
                    </span>
                </div>
            </a>

            @php
                $user           = $user ?? auth()->user();
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

                <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                    {{-- change this icon (cart) --}}
                    <span>🛒</span>
                    <span>Cart</span>
                </a>

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
                                <p class="text-sm text-neutral-50 font-medium">
                                    {{ $user->name }}
                                </p>
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

                                @if ($user->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                                        {{-- change this icon (admin dashboard) --}}
                                        <span>📊</span>
                                        <span>Admin dashboard</span>
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                                        {{-- change this icon (user dashboard) --}}
                                        <span>📂</span>
                                        <span>Dashboard</span>
                                    </a>
                                @endif
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
    <main class="max-w-6xl mx-auto px-4 py-10 space-y-8">
        {{-- Greeting + summary --}}
        <section class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-neutral-500 mb-2">
                    Welcome back
                </p>
                <h1 class="text-3xl font-semibold tracking-tight text-neutral-50">
                    {{ $user->name }}
                </h1>
                <p class="mt-2 text-sm text-neutral-400">
                    This is your personal space for orders and activity.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="rounded-xl border border-neutral-800 bg-neutral-950/80 px-3 py-2">
                    <p class="text-[10px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                        Total spent
                    </p>
                    <p class="text-base text-neutral-50 font-semibold">
                        ${{ number_format(($totalSpent ?? 0) / 100, 2) }}
                    </p>
                </div>
                <div class="rounded-xl border border-neutral-800 bg-neutral-950/80 px-3 py-2">
                    <p class="text-[10px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                        Items purchased
                    </p>
                    <p class="text-base text-neutral-50 font-semibold">
                        {{ $totalItems ?? 0 }}
                    </p>
                </div>
                <div class="rounded-xl border border-neutral-800 bg-neutral-950/80 px-3 py-2 col-span-2">
                    <p class="text-[10px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                        Last purchase
                    </p>
                    <p class="text-sm text-neutral-50">
                        @if ($lastOrder)
                            {{ $lastOrder->created_at->format('M d, Y • H:i') }}
                        @else
                            <span class="text-neutral-500">No purchases yet</span>
                        @endif
                    </p>
                </div>
            </div>
        </section>

        {{-- Purchase history --}}
        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold tracking-tight text-neutral-50">
                    Purchase history
                </h2>
                <p class="text-[11px] text-neutral-500">
                    Your latest orders and items.
                </p>
            </div>

            @if ($orders->isEmpty())
                <p class="text-sm text-neutral-500">
                    You haven’t completed any purchases yet. Visit the
                    <a href="{{ route('products.index') }}" class="underline hover:text-neutral-200">shop</a>
                    to start exploring.
                </p>
            @else
                <div class="space-y-3">
                    @foreach ($orders as $order)
                        <article class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4 space-y-3">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.18em] text-neutral-500">
                                        Order #{{ $order->id }}
                                    </p>
                                    <p class="text-sm text-neutral-100">
                                        {{ $order->created_at->format('M d, Y • H:i') }}
                                    </p>
                                </div>
                                <div class="text-right text-xs">
                                    <p class="text-neutral-100 font-semibold">
                                        ${{ number_format($order->total_amount / 100, 2) }}
                                    </p>
                                    <p class="text-neutral-500">
                                        {{ $order->items_count }} item{{ $order->items_count === 1 ? '' : 's' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Items inside order --}}
                            <div class="border-t border-neutral-900 pt-3 space-y-2">
                                @foreach ($order->items as $item)
                                    <div class="flex items-center gap-3">
                                        <div class="h-12 w-12 rounded-xl overflow-hidden bg-neutral-900 flex-shrink-0">
                                            @php
                                                $img = $item->product?->image_url ?? '';
                                            @endphp
                                            @if ($img)
                                                <img
                                                    src="{{ $img }}"
                                                    alt="{{ $item->product?->name }}"
                                                    class="h-full w-full object-cover"
                                                >
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-neutral-100">
                                                {{ $item->product?->name ?? 'Deleted product' }}
                                            </p>
                                            <p class="text-[11px] text-neutral-500">
                                                {{ $item->quantity }} × ${{ number_format(($item->unit_price ?? 0) / 100, 2) }}
                                            </p>
                                        </div>
                                        <div class="text-right text-xs text-neutral-300">
                                            ${{ number_format(($item->line_total ?? 0) / 100, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

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
