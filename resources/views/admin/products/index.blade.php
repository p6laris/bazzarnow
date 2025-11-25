<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Admin Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen">

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
                        Products
                    </span>
                </div>
            </a>

            <div class="flex items-center gap-3 text-xs text-neutral-400">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M6 4.5V6H5a1 1 0 0 0-1 1v8q0 .625.235 1.172q.234.539.648.953A3 3 0 0 0 7 18h4.764A3 3 0 0 1 11 16V4.5a2.5 2.5 0 0 0-.328-1.242Q11.039 3 11.5 3q.312 0 .586.117a1.48 1.48 0 0 1 .797.797Q13 4.187 13 4.5V6h-1v10a2 2 0 1 0 4 0V7a1 1 0 0 0-1-1h-1V4.5q0-.516-.195-.969A2.48 2.48 0 0 0 11.5 2a2.44 2.44 0 0 0-1.492.508a2.5 2.5 0 0 0-.703-.375A2.4 2.4 0 0 0 8.5 2q-.516 0-.969.195q-.46.195-.797.539q-.344.336-.539.797Q6 3.984 6 4.5m1 0q0-.312.117-.586a1.48 1.48 0 0 1 .797-.797Q8.188 3 8.5 3t.586.117a1.48 1.48 0 0 1 .797.797Q10 4.187 10 4.5V6H7z"/></svg>
                    <span>Shop</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M12.92 2.873a2.975 2.975 0 0 1 4.207 4.207l-.669.669l-4.207-4.207zM11.544 4.25l-7.999 7.999a2.44 2.44 0 0 0-.655 1.194l-.878 3.95a.5.5 0 0 0 .597.597l3.926-.873a2.5 2.5 0 0 0 1.234-.678l4.064-4.063a3 3 0 0 1 3.615-4.222zM16.5 11a2 2 0 1 1-4 0a2 2 0 0 1 4 0m1.5 4.5c0 1.245-1 2.5-3.5 2.5S11 16.75 11 15.5a1.5 1.5 0 0 1 1.5-1.5h4a1.5 1.5 0 0 1 1.5 1.5"/></svg>
                <span>Users</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                    <svg class="items-center" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M12 4.354v6.65h7.442L17.72 9.28a.75.75 0 0 1-.073-.977l.073-.084a.75.75 0 0 1 .976-.072l.084.072l2.997 2.998a.75.75 0 0 1 .073.976l-.073.084l-2.996 3.003a.75.75 0 0 1-1.134-.975l.072-.084l1.713-1.717h-7.431L12 19.25a.75.75 0 0 1-.88.738l-8.5-1.501a.75.75 0 0 1-.62-.739V5.75a.75.75 0 0 1 .628-.74l8.5-1.396a.75.75 0 0 1 .872.74m-3.498 7.145a1.002 1.002 0 1 0 0 2.005a1.002 1.002 0 0 0 0-2.005M13 18.502h.765l.102-.007a.75.75 0 0 0 .648-.744l-.007-4.25H13zM13.002 10L13 8.725V5h.745a.75.75 0 0 1 .743.647l.007.101l.007 4.252z"/></svg>
                    <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10 space-y-6">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-neutral-500 mb-2">
                    Catalog
                </p>
                <h1 class="text-2xl font-semibold tracking-tight">Manage products</h1>
                <p class="text-xs text-neutral-500 mt-1">
                    Add, update, or remove items from the BazzarNow catalog.
                </p>
            </div>

            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center rounded-full border border-neutral-700 bg-neutral-100 text-neutral-900 text-xs font-semibold tracking-[0.16em] uppercase px-4 py-2 hover:bg-white hover:border-neutral-100 active:scale-[0.98] transition-transform"
            >
                <span>＋</span>
                <span class="ml-1">Add product</span>
            </a>
        </div>

        @if (session('status'))
            <div class="rounded-xl border border-neutral-700 bg-neutral-900 px-4 py-3 text-xs text-neutral-200">
                {{ session('status') }}
            </div>
        @endif

        @if ($products->isEmpty())
            <p class="text-sm text-neutral-500">No products found.</p>
        @else
            <div class="space-y-3">
                @php
                    $labels = [
                        'skincare'  => 'Skincare',
                        'fragrance' => 'Fragrance',
                        'eyes'      => 'Eyes',
                        'lips'      => 'Lips',
                        'body'      => 'Body',
                    ];
                @endphp

                @foreach ($products as $product)
                    <div class="flex gap-3 rounded-2xl border border-neutral-800 bg-neutral-950/80 p-3">
                        <div class="h-16 w-16 rounded-xl overflow-hidden bg-neutral-900 flex-shrink-0">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        </div>
                        <div class="flex-1 flex flex-col justify-between">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm text-neutral-100">{{ $product->name }}</p>
                                    <p class="text-[11px] text-neutral-500 line-clamp-1">
                                        {{ $product->description }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center gap-2 rounded-full border border-neutral-800 px-2 py-1 text-[10px] uppercase tracking-[0.16em] text-neutral-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-neutral-500"></span>
                                    {{ $labels[$product->category] ?? ucfirst($product->category) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between mt-2 text-xs text-neutral-400">
                                <span>${{ number_format($product->price / 100, 2) }}</span>
                                <span>Rating: {{ $product->rating }}/5</span>
                            </div>
                        </div>

                        <div class="flex flex-col items-end justify-between text-[11px] text-neutral-400">
                            <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-1 hover:text-neutral-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M12.92 2.873a2.975 2.975 0 0 1 4.207 4.207l-.669.669l-4.207-4.207zM11.544 4.25l-7.999 7.999a2.44 2.44 0 0 0-.655 1.194l-.878 3.95a.5.5 0 0 0 .597.597l3.926-.873a2.5 2.5 0 0 0 1.234-.678l7.982-7.982z"/></svg>
                            <span>Edit</span>
                            </a>

                            <form
                                id="delete-form-{{ $product->id }}"
                                method="POST"
                                action="{{ route('admin.products.destroy', $product) }}"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="button"
                                    data-delete-target="delete-form-{{ $product->id }}"
                                    class="inline-flex items-center gap-1 text-red-300 hover:text-red-200 transition"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20"><!-- Icon from Fluent UI System Icons by Microsoft Corporation - https://github.com/microsoft/fluentui-system-icons/blob/main/LICENSE --><path fill="currentColor" d="M8.5 4h3a1.5 1.5 0 0 0-3 0m-1 0a2.5 2.5 0 0 1 5 0h5a.5.5 0 0 1 0 1h-1.054l-1.194 10.344A3 3 0 0 1 12.272 18H7.728a3 3 0 0 1-2.98-2.656L3.554 5H2.5a.5.5 0 0 1 0-1zM9 8a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0zm2.5-.5a.5.5 0 0 0-.5.5v6a.5.5 0 0 0 1 0V8a.5.5 0 0 0-.5-.5"/></svg>
                                <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Monochrome pagination --}}
            @if ($products->hasPages())
                <div class="mt-6 flex justify-center">
                    <nav class="inline-flex items-center gap-4 text-xs text-neutral-400" aria-label="Pagination">
                        <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full border border-neutral-800 bg-neutral-950/80">
                            Page
                            <span class="mx-1 text-neutral-100">{{ $products->currentPage() }}</span>
                            of
                            <span class="ml-1 text-neutral-100">{{ $products->lastPage() }}</span>
                        </span>
                        <div class="inline-flex items-center gap-2">
                            @if ($products->onFirstPage())
                                <span class="px-3 py-1 rounded-full border border-neutral-800 bg-neutral-950/60 text-neutral-600 cursor-not-allowed">
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

                            @if ($products->hasMorePages())
                                <a
                                    href="{{ $products->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-full border border-neutral-700 bg-neutral-950/80 hover:bg-neutral-100 hover:text-neutral-950 hover:border-neutral-100 transition"
                                >
                                    Next
                                </a>
                            @else
                                <span class="px-3 py-1 rounded-full border border-neutral-800 bg-neutral-950/60 text-neutral-600 cursor-not-allowed">
                                    Next
                                </span>
                            @endif
                        </div>
                    </nav>
                </div>
            @endif
        @endif
    </main>

    {{-- Delete confirmation modal --}}
    <div
        id="delete-modal"
        class="hidden fixed inset-0 z-40 flex items-center justify-center bg-black/70 backdrop-blur-sm"
    >
        <div class="w-full max-w-sm rounded-2xl border border-neutral-800 bg-neutral-950 px-5 py-4 text-sm">
            <h2 class="text-neutral-50 font-semibold text-base">
                Delete product
            </h2>
            <p class="mt-2 text-xs text-neutral-400">
                Are you sure you want to delete this product? This action cannot be undone.
            </p>

            <div class="mt-4 flex items-center justify-end gap-2 text-xs">
                <button
                    type="button"
                    id="delete-cancel"
                    class="rounded-full border border-neutral-800 bg-neutral-950 px-3 py-1.5 text-neutral-300 hover:border-neutral-200 hover:text-neutral-50 transition"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    id="delete-confirm"
                    class="rounded-full border border-red-500/70 bg-red-500 text-neutral-950 px-3 py-1.5 font-semibold hover:bg-red-400 hover:border-red-400 transition"
                >
                    Delete anyway
                </button>
            </div>
        </div>
    </div>

    <script>
        let deleteFormId = null;

        document.addEventListener('click', (event) => {
            const deleteBtn = event.target.closest('[data-delete-target]');
            if (deleteBtn) {
                deleteFormId = deleteBtn.getAttribute('data-delete-target');
                document.getElementById('delete-modal').classList.remove('hidden');
                return;
            }

            const modal = document.getElementById('delete-modal');
            if (!modal.classList.contains('hidden') && event.target === modal) {
                modal.classList.add('hidden');
                deleteFormId = null;
            }
        });

        document.getElementById('delete-cancel').addEventListener('click', () => {
            document.getElementById('delete-modal').classList.add('hidden');
            deleteFormId = null;
        });

        document.getElementById('delete-confirm').addEventListener('click', () => {
            if (deleteFormId) {
                const form = document.getElementById(deleteFormId);
                if (form) form.submit();
            }
        });
    </script>
</body>
</html>
