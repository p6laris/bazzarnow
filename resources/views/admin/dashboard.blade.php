<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen">

    {{-- HEADER --}}
    <header class="border-b border-neutral-800/80 bg-neutral-950/90 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="h-9 w-9 rounded-xl border border-neutral-700 bg-neutral-900 flex items-center justify-center text-[10px] font-semibold tracking-[0.2em] uppercase text-neutral-300 group-hover:border-neutral-100 group-hover:text-neutral-100 transition">
                    BN
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-sm font-semibold tracking-tight text-neutral-50">
                        BazzarNow
                    </span>
                    <span class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                        Admin Console
                    </span>
                </div>
            </a>

            <div class="flex items-center gap-4 text-xs text-neutral-400">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                    {{-- change this icon (view shop) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M6 4.5V6H5a1 1 0 0 0-1 1v8q0 .625.235 1.172q.234.539.648.953A3 3 0 0 0 7 18h4.764A3 3 0 0 1 11 16V4.5a2.5 2.5 0 0 0-.328-1.242Q11.039 3 11.5 3q.312 0 .586.117a1.48 1.48 0 0 1 .797.797Q13 4.187 13 4.5V6h-1v10a2 2 0 1 0 4 0V7a1 1 0 0 0-1-1h-1V4.5q0-.516-.195-.969A2.48 2.48 0 0 0 11.5 2a2.44 2.44 0 0 0-1.492.508a2.5 2.5 0 0 0-.703-.375A2.4 2.4 0 0 0 8.5 2q-.516 0-.969.195q-.46.195-.797.539q-.344.336-.539.797Q6 3.984 6 4.5m1 0q0-.312.117-.586a1.48 1.48 0 0 1 .797-.797Q8.188 3 8.5 3t.586.117a1.48 1.48 0 0 1 .797.797Q10 4.187 10 4.5V6H7z"/></svg>
                    <span>View shop</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                    {{-- change this icon (manage products) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M6 3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3zM4 6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2.5-1A1.5 1.5 0 0 0 5 6.5v7A1.5 1.5 0 0 0 6.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 13.5 5z"/></svg>
                    <span>Products</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                    {{-- change this icon (users) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M12.92 2.873a2.975 2.975 0 0 1 4.207 4.207l-.669.669l-4.207-4.207zM11.544 4.25l-7.999 7.999a2.44 2.44 0 0 0-.655 1.194l-.878 3.95a.5.5 0 0 0 .597.597l3.926-.873a2.5 2.5 0 0 0 1.234-.678l4.064-4.063a3 3 0 0 1 3.615-4.222zM16.5 11a2 2 0 1 1-4 0a2 2 0 0 1 4 0m1.5 4.5c0 1.245-1 2.5-3.5 2.5S11 16.75 11 15.5a1.5 1.5 0 0 1 1.5-1.5h4a1.5 1.5 0 0 1 1.5 1.5"/></svg>
                    <span>Users</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                        {{-- change this icon (logout) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M12 4.354v6.65h7.442L17.72 9.28a.75.75 0 0 1-.073-.977l.073-.084a.75.75 0 0 1 .976-.072l.084.072l2.997 2.998a.75.75 0 0 1 .073.976l-.073.084l-2.996 3.003a.75.75 0 0 1-1.134-.975l.072-.084l1.713-1.717h-7.431L12 19.25a.75.75 0 0 1-.88.738l-8.5-1.501a.75.75 0 0 1-.62-.739V5.75a.75.75 0 0 1 .628-.74l8.5-1.396a.75.75 0 0 1 .872.74m-3.498 7.145a1.002 1.002 0 1 0 0 2.005a1.002 1.002 0 0 0 0-2.005M13 18.502h.765l.102-.007a.75.75 0 0 0 .648-.744l-.007-4.25H13zM13.002 10L13 8.725V5h.745a.75.75 0 0 1 .743.647l.007.101l.007 4.252z"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="max-w-6xl mx-auto px-4 py-10 space-y-8">
        {{-- TOP STATS --}}
        <section class="grid gap-4 md:grid-cols-4">
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4">
                <p class="text-[11px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                    Users
                </p>
                <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
                <p class="text-[11px] text-neutral-500 mt-1">Total registered customers.</p>
            </div>
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4">
                <p class="text-[11px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                    Admins
                </p>
                <p class="text-2xl font-semibold">{{ $totalAdmins }}</p>
                <p class="text-[11px] text-neutral-500 mt-1">Accounts with admin access.</p>
            </div>
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4">
                <p class="text-[11px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                    Products
                </p>
                <p class="text-2xl font-semibold">{{ $totalProducts }}</p>
                <p class="text-[11px] text-neutral-500 mt-1">Active products in catalog.</p>
            </div>
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4">
                <p class="text-[11px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                    Items in carts
                </p>
                <p class="text-2xl font-semibold">{{ $totalCartItems }}</p>
                <p class="text-[11px] text-neutral-500 mt-1">Total items across all carts.</p>
            </div>
        </section>

        {{-- REVENUE + PURCHASED --}}
        <section class="grid gap-4 md:grid-cols-2">
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4">
                <p class="text-[11px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                    Benefits (revenue, demo)
                </p>
                <p class="text-2xl font-semibold">
                    ${{ number_format(($totalRevenue ?? 0) / 100, 2) }}
                </p>
                <p class="text-[11px] text-neutral-500 mt-1">
                    Sum of all demo purchases (orders).
                </p>
            </div>
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-4">
                <p class="text-[11px] uppercase tracking-[0.18em] text-neutral-500 mb-1">
                    Items purchased
                </p>
                <p class="text-2xl font-semibold">
                    {{ $totalPurchased ?? 0 }}
                </p>
                <p class="text-[11px] text-neutral-500 mt-1">
                    Total quantity purchased across all orders.
                </p>
            </div>
        </section>

        {{-- CHARTS --}}
        <section class="grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-5">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h2 class="text-sm font-semibold tracking-tight text-neutral-50">
                            New users (last 7 days)
                        </h2>
                        <p class="text-[11px] text-neutral-500 mt-1">
                            Customer growth overview.
                        </p>
                    </div>
                </div>
                <div class="w-full" style="height: 200px;">
                    <canvas id="userChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-5">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h2 class="text-sm font-semibold tracking-tight text-neutral-50">
                            New products (last 7 days)
                        </h2>
                        <p class="text-[11px] text-neutral-500 mt-1">
                            Catalog activity.
                        </p>
                    </div>
                </div>
                <div class="w-full" style="height: 200px;">
                    <canvas id="productChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </section>

        {{-- RECENT ORDERS --}}
        <section class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold tracking-tight text-neutral-50">
                    Recent orders
                </h2>
                <p class="text-[11px] text-neutral-500">
                    Latest demo purchases and who placed them.
                </p>
            </div>

            @if ($recentOrders->isEmpty())
                <p class="text-xs text-neutral-500">No orders yet.</p>
            @else
                <div class="space-y-2 text-xs">
                    @foreach ($recentOrders as $order)
                        <div class="flex items-center justify-between rounded-xl border border-neutral-800 bg-neutral-950/80 px-3 py-2">
                            <div class="flex flex-col">
                                <span class="text-neutral-50">
                                    {{ $order->user->name ?? 'Unknown user' }}
                                </span>
                                <span class="text-[11px] text-neutral-500">
                                    {{ $order->created_at->format('M d, H:i') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-neutral-100">
                                    ${{ number_format($order->total_amount / 100, 2) }}
                                </div>
                                <div class="text-[11px] text-neutral-500">
                                    {{ $order->items_count }} item{{ $order->items_count === 1 ? '' : 's' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

    <script>
        const userStats = @json($userStats);
        const productStats = @json($productStats);

        const userLabels = userStats.map(s => s.label);
        const userCounts = userStats.map(s => s.count);

        const productLabels = productStats.map(s => s.label);
        const productCounts = productStats.map(s => s.count);

        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
            },
            scales: {
                x: {
                    grid: { color: 'rgba(255,255,255,0.03)' },
                    ticks: { color: 'rgba(229,229,229,0.8)', font: { size: 10 } },
                },
                y: {
                    grid: { color: 'rgba(255,255,255,0.05)' },
                    ticks: { color: 'rgba(148,163,184,0.9)', font: { size: 10 }, precision: 0 },
                    beginAtZero: true,
                    suggestedMax: 5,
                },
            },
            animation: false,
        };

        window.addEventListener('load', () => {
            const userCtx = document.getElementById('userChart').getContext('2d');
            const productCtx = document.getElementById('productChart').getContext('2d');

            new Chart(userCtx, {
                type: 'line',
                data: {
                    labels: userLabels,
                    datasets: [{
                        data: userCounts,
                        borderColor: 'rgba(248,250,252,0.9)',
                        backgroundColor: 'rgba(248,250,252,0.08)',
                        tension: 0.35,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 4,
                    }],
                },
                options: baseOptions,
            });

            new Chart(productCtx, {
                type: 'line',
                data: {
                    labels: productLabels,
                    datasets: [{
                        data: productCounts,
                        borderColor: 'rgba(148,163,184,1)',
                        backgroundColor: 'rgba(148,163,184,0.15)',
                        tension: 0.35,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 4,
                    }],
                },
                options: baseOptions,
            });
        });
    </script>
</body>
</html>
