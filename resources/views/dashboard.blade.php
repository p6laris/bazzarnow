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
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M6 4.5V6H5a1 1 0 0 0-1 1v8q0 .625.235 1.172q.234.539.648.953A3 3 0 0 0 7 18h4.764A3 3 0 0 1 11 16V4.5a2.5 2.5 0 0 0-.328-1.242Q11.039 3 11.5 3q.312 0 .586.117a1.48 1.48 0 0 1 .797.797Q13 4.187 13 4.5V6h-1v10a2 2 0 1 0 4 0V7a1 1 0 0 0-1-1h-1V4.5q0-.516-.195-.969A2.48 2.48 0 0 0 11.5 2a2.44 2.44 0 0 0-1.492.508a2.5 2.5 0 0 0-.703-.375A2.4 2.4 0 0 0 8.5 2q-.516 0-.969.195q-.46.195-.797.539q-.344.336-.539.797Q6 3.984 6 4.5m1 0q0-.312.117-.586a1.48 1.48 0 0 1 .797-.797Q8.188 3 8.5 3t.586.117a1.48 1.48 0 0 1 .797.797Q10 4.187 10 4.5V6H7z"/></svg>
                    <span>Shop</span>
                </a>

                <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                    {{-- change this icon (cart) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M2.997 3.496a.5.5 0 0 1 .5-.5h.438c.727 0 1.145.473 1.387.945c.165.323.284.717.383 1.059H16a1 1 0 0 1 .962 1.272l-1.496 5.275A2 2 0 0 1 13.542 13H8.463a2 2 0 0 1-1.93-1.473l-.642-2.355l-.01-.032l-1.03-3.498l-.1-.337c-.1-.346-.188-.652-.32-.909c-.159-.31-.305-.4-.496-.4h-.438a.5.5 0 0 1-.5-.5M8.5 17a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3"/></svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M9 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-4.991 9A2 2 0 0 0 2 13c0 1.691.833 2.966 2.135 3.797C5.417 17.614 7.145 18 9 18q.617 0 1.21-.057A5.48 5.48 0 0 1 9 14.5c0-1.33.472-2.55 1.257-3.5zm6.626 2.92a2 2 0 0 0 1.43-2.478l-.155-.557q.382-.293.821-.497l.338.358a2 2 0 0 0 2.91.001l.324-.344q.448.212.835.518l-.126.423a2 2 0 0 0 1.456 2.519l.349.082a4.7 4.7 0 0 1 .01 1.017l-.46.117a2 2 0 0 0-1.431 2.479l.156.556q-.383.294-.822.498l-.338-.358a2 2 0 0 0-2.909-.002l-.325.344a4.3 4.3 0 0 1-.835-.518l.127-.422a2 2 0 0 0-1.456-2.52l-.35-.082a4.7 4.7 0 0 1-.01-1.016zm4.865.58a1 1 0 1 0-2 0a1 1 0 0 0 2 0"/></svg>
                                    <span>Profile</span>
                                </a>

                                @if ($user->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                                        {{-- change this icon (admin dashboard) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M17 8.537a.473.473 0 0 1-.482.463H10.5a.5.5 0 0 1-.5-.5V2.482c0-.261.201-.48.463-.482h.037A6.5 6.5 0 0 1 17 8.5zM9 4.5a.47.47 0 0 0-.5-.48A6 6 0 0 0 9 16v-1a2 2 0 0 1 3-1.732V13a2 2 0 0 1 2-2h.917q.042-.247.063-.5a.47.47 0 0 0-.48-.5H10a1 1 0 0 1-1-1zm8 5.5a1 1 0 0 0-1 1v7a1 1 0 1 0 2 0v-7a1 1 0 0 0-1-1m-3 2a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-5a1 1 0 0 0-1-1m-4 3a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0z"/></svg>
                                        <span>Admin dashboard</span>
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                                        {{-- change this icon (user dashboard) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M5 6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm0 6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm6-6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm0 6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zM2 5a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3zm3-2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2z"/></svg>
                                        <span>Dashboard</span>
                                    </a>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1 text-neutral-500 hover:text-neutral-100 transition">
                                    {{-- change this icon (logout) --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M12 4.354v6.65h7.442L17.72 9.28a.75.75 0 0 1-.073-.977l.073-.084a.75.75 0 0 1 .976-.072l.084.072l2.997 2.998a.75.75 0 0 1 .073.976l-.073.084l-2.996 3.003a.75.75 0 0 1-1.134-.975l.072-.084l1.713-1.717h-7.431L12 19.25a.75.75 0 0 1-.88.738l-8.5-1.501a.75.75 0 0 1-.62-.739V5.75a.75.75 0 0 1 .628-.74l8.5-1.396a.75.75 0 0 1 .872.74m-3.498 7.145a1.002 1.002 0 1 0 0 2.005a1.002 1.002 0 0 0 0-2.005M13 18.502h.765l.102-.007a.75.75 0 0 0 .648-.744l-.007-4.25H13zM13.002 10L13 8.725V5h.745a.75.75 0 0 1 .743.647l.007.101l.007 4.252z"/></svg>
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
