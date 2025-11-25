<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen">
<header class="border-b border-neutral-800/80 bg-neutral-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 group">
            <div class="h-9 w-9 rounded-xl border border-neutral-700 bg-neutral-900 flex items-center justify-center text-[10px] font-semibold tracking-[0.2em] uppercase text-neutral-300 group-hover:border-neutral-100 group-hover:text-neutral-100 transition">
                BN
            </div>
            <div class="flex flex-col leading-tight">
                <span class="text-sm font-semibold tracking-tight text-neutral-50">BazzarNow</span>
                <span class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">New product</span>
            </div>
        </a>
    </div>
</header>

<main class="max-w-3xl mx-auto px-4 py-10 space-y-6">
    <h1 class="text-2xl font-semibold tracking-tight mb-2">Add product</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-xl border border-red-500/40 bg-red-500/5 px-3 py-2 text-xs text-red-300 space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="space-y-1 text-sm">
            <label class="text-neutral-300">Name</label>
            <input name="name" value="{{ old('name') }}" class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm focus:border-neutral-200 outline-none">
        </div>

        <div class="space-y-1 text-sm">
            <label class="text-neutral-300">Description</label>
            <textarea name="description" rows="3" class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm focus:border-neutral-200 outline-none">{{ old('description') }}</textarea>
        </div>

        <div class="grid gap-4 sm:grid-cols-3 text-sm">
            <div class="space-y-1">
                <label class="text-neutral-300">Price (USD)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm focus:border-neutral-200 outline-none">
            </div>
            <div class="space-y-1">
                <label class="text-neutral-300">Category</label>
                <select name="category" class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm focus:border-neutral-200 outline-none">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" @selected(old('category') === $cat)>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-neutral-300">Product image</label>
                <input type="file" name="image" accept="image/*" class="block w-full text-xs text-neutral-300 file:mr-2 file:rounded-md file:border-0 file:bg-neutral-800 file:px-2 file:py-1 file:text-xs file:text-neutral-100 hover:file:bg-neutral-700">
                <p class="text-[11px] text-neutral-500 mt-1">
                    Optional. JPG / PNG / WEBP, up to 2MB.
                </p>
            </div>
        </div>

        <div class="pt-2 flex items-center gap-3">
            <button type="submit" class="inline-flex items-center justify-center rounded-xl border border-neutral-700 bg-neutral-100 text-neutral-900 text-xs font-semibold tracking-[0.12em] uppercase px-4 py-2 hover:bg-white hover:border-neutral-100 active:scale-[0.98] transition-transform">
                Save product
            </button>
            <a href="{{ route('admin.products.index') }}" class="text-xs text-neutral-400 hover:text-neutral-200 transition">
                Cancel
            </a>
        </div>
    </form>
</main>
</body>
</html>
