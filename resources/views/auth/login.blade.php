<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login – Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen flex items-center justify-center">

    <div class="absolute inset-x-0 top-0 border-b border-neutral-900/80 bg-neutral-950/80 backdrop-blur">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between text-xs text-neutral-500">
            <a href="{{ route('products.index') }}" class="flex items-center gap-2 hover:text-neutral-100 transition">
                <span class="px-2 py-1 rounded-full border border-neutral-700 uppercase tracking-[0.25em] text-[10px]">SHOP</span>
                <span>Back to products</span>
            </a>
            <span>Sign in</span>
        </div>
    </div>

    <main class="w-full max-w-md px-4">
        <div class="border border-neutral-800/80 bg-neutral-950/90 rounded-2xl shadow-[0_0_0_1px_rgba(255,255,255,0.03)] p-8 space-y-6">
            <header class="space-y-1">
                <p class="text-xs uppercase tracking-[0.25em] text-neutral-500">Account</p>
                <h1 class="text-2xl font-semibold tracking-tight">Sign in</h1>
                <p class="text-xs text-neutral-500">
                    Use your email and password to access your account.
                </p>
            </header>

            @if ($errors->any())
                <div class="rounded-xl border border-red-500/40 bg-red-500/5 px-3 py-2 text-xs text-red-300 space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="space-y-1 text-sm">
                    <label for="email" class="text-neutral-300">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm outline-none focus:border-neutral-200"
                    >
                </div>

                <div class="space-y-1 text-sm">
                    <label for="password" class="text-neutral-300">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm outline-none focus:border-neutral-200"
                    >
                </div>

                <div class="flex items-center justify-between text-xs text-neutral-500">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="remember" class="h-3 w-3 rounded border-neutral-700 bg-neutral-950">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="hover:text-neutral-200 transition">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="w-full mt-2 inline-flex items-center justify-center rounded-xl border border-neutral-700 bg-neutral-100 text-neutral-950 text-xs font-semibold tracking-[0.12em] uppercase px-4 py-2 hover:bg-white hover:border-neutral-100 active:scale-[0.98] transition-transform">
                    Sign in
                </button>
            </form>

            <p class="text-xs text-neutral-500 text-center">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-neutral-200 hover:underline">
                    Create one
                </a>
            </p>
        </div>
    </main>
</body>
</html>
