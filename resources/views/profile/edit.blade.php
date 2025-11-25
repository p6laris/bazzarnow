<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-950 text-neutral-100 antialiased min-h-screen">

    {{-- HEADER --}}
    <header class="border-b border-neutral-800/80 bg-neutral-950/90 backdrop-blur">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
            <a href="{{ route('products.index') }}" class="flex items-center gap-3 group">
                <div class="h-9 w-9 rounded-xl border border-neutral-700 bg-neutral-900 flex items-center justify-center text-[10px] font-semibold tracking-[0.2em] uppercase text-neutral-300 group-hover:border-neutral-100 group-hover:text-neutral-100 transition">
                    BN
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-sm font-semibold tracking-tight text-neutral-50">
                        BazzarNow
                    </span>
                    <span class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">
                        Profile
                    </span>
                </div>
            </a>

            <div class="flex items-center gap-3 text-xs text-neutral-400">
                <a href="{{ route('dashboard') }}" class="hover:text-neutral-100 transition">
                    Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="hover:text-neutral-100 transition">
                    Products
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-neutral-100 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="max-w-5xl mx-auto px-4 py-10 space-y-8">

        @if (session('status') === 'profile-updated')
            <div class="mb-6 rounded-xl border border-neutral-700 bg-neutral-900 px-4 py-3 text-xs text-neutral-200">
                Profile updated successfully.
            </div>
        @endif

        <section class="grid gap-6 md:grid-cols-[minmax(0,2fr)_minmax(0,3fr)]">
            {{-- AVATAR + ROLE --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-6 flex gap-4 items-center">
                @php
                    $initial = mb_strtoupper(mb_substr($user->name, 0, 1));
                    $avatar = $user->profile_image_path ? asset('storage/' . $user->profile_image_path) : null;
                @endphp

                <div class="h-16 w-16 rounded-full bg-neutral-900 flex items-center justify-center text-xl font-semibold overflow-hidden">
                    @if ($avatar)
                        <img src="{{ $avatar }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                    @else
                        {{ $initial }}
                    @endif
                </div>

                <div class="flex-1 space-y-1">
                    <h1 class="text-lg font-semibold tracking-tight">
                        {{ $user->name }}
                    </h1>
                    <p class="text-xs text-neutral-400">{{ $user->email }}</p>
                    <p class="text-[11px] text-neutral-500">
                        Member since {{ $user->created_at->format('M Y') }}
                    </p>

                    <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-neutral-800 px-3 py-1 text-[11px] uppercase tracking-[0.18em] text-neutral-400">
                        <span class="h-1.5 w-1.5 rounded-full {{ $user->is_admin ? 'bg-neutral-50' : 'bg-neutral-500' }}"></span>
                        <span>{{ $user->is_admin ? 'Admin' : 'Customer' }}</span>
                    </div>
                </div>
            </div>

            {{-- PROFILE FORM --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-950/80 p-6">
                <h2 class="text-sm font-semibold tracking-tight mb-4">Profile details</h2>

                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-500/40 bg-red-500/5 px-3 py-2 text-xs text-red-300 space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-1 text-sm">
                        <label for="name" class="text-neutral-300">Name</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm outline-none focus:border-neutral-200"
                        >
                    </div>

                    <div class="space-y-1 text-sm">
                        <label for="email" class="text-neutral-300">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm outline-none focus:border-neutral-200"
                        >
                    </div>

                    <div class="space-y-1 text-sm">
                        <label class="text-neutral-300" for="avatar">Profile image</label>
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full overflow-hidden bg-neutral-800 flex items-center justify-center text-sm font-semibold">
                                @if ($avatar)
                                    <img src="{{ $avatar }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                @else
                                    {{ $initial }}
                                @endif
                            </div>
                            <input
                                id="avatar"
                                type="file"
                                name="avatar"
                                accept="image/*"
                                class="block w-full text-xs text-neutral-300 file:mr-3 file:rounded-md file:border-0 file:bg-neutral-100 file:px-3 file:py-1 file:text-xs file:font-medium file:text-neutral-900 hover:file:bg-white"
                            >
                        </div>
                        <p class="mt-1 text-[11px] text-neutral-500">
                            JPG, PNG, max 2MB.
                        </p>
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl border border-neutral-700 bg-neutral-100 text-neutral-950 text-xs font-semibold tracking-[0.12em] uppercase px-4 py-2 hover:bg-white hover:border-neutral-100 active:scale-[0.98] transition-transform">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- DELETE ACCOUNT --}}
        <section class="rounded-2xl border border-neutral-900 bg-neutral-950/80 p-6">
            <h2 class="text-sm font-semibold tracking-tight text-red-300 mb-2">Danger zone</h2>
            <p class="text-xs text-neutral-500 mb-4">
                Once your account is deleted, all of its data will be permanently removed. This action cannot be undone.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-2">
                @csrf
                @method('DELETE')

                <div class="space-y-1 text-sm max-w-xs">
                    <label for="delete_password" class="text-neutral-300">Confirm password</label>
                    <input
                        id="delete_password"
                        type="password"
                        name="password"
                        class="w-full rounded-lg bg-neutral-950 border border-neutral-800 px-3 py-2 text-sm outline-none focus:border-neutral-200"
                    >
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl border border-red-500/60 bg-red-500/10 text-red-200 text-xs font-semibold tracking-[0.12em] uppercase px-4 py-2 hover:bg-red-500/20 active:scale-[0.98] transition-transform">
                    Delete account
                </button>
            </form>
        </section>

    </main>
</body>
</html>
