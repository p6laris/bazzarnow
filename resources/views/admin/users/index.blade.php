<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>BazzarNow – Admin Users</title>
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
                <span class="text-sm font-semibold tracking-tight text-neutral-50">BazzarNow</span>
                <span class="text-[11px] uppercase tracking-[0.22em] text-neutral-500">Users</span>
            </div>
        </a>

        <div class="flex items-center gap-3 text-xs text-neutral-400">
            <a href="{{ route('admin.products.index') }}" class="hover:text-neutral-100 transition">
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

<main class="max-w-6xl mx-auto px-4 py-10 space-y-6">
    <div class="flex items-center justify-between gap-3">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] text-neutral-500 mb-2">
                Customers
            </p>
            <h1 class="text-2xl font-semibold tracking-tight">Manage users</h1>
            <p class="text-xs text-neutral-500 mt-1">
                Review registrations and remove users if necessary.
            </p>
        </div>
    </div>

    @if (session('status'))
        <div class="rounded-xl border border-neutral-700 bg-neutral-900 px-4 py-3 text-xs text-neutral-200">
            {{ session('status') }}
        </div>
    @endif

    @if ($users->isEmpty())
        <p class="text-sm text-neutral-500">No users found.</p>
    @else
        <div class="overflow-x-auto rounded-2xl border border-neutral-800 bg-neutral-950/80">
            <table class="min-w-full text-xs">
                <thead class="border-b border-neutral-800 bg-neutral-950/90 text-neutral-400">
                    <tr>
                        <th class="text-left px-4 py-2">Name</th>
                        <th class="text-left px-4 py-2">Email</th>
                        <th class="text-left px-4 py-2">Role</th>
                        <th class="text-left px-4 py-2">Joined</th>
                        <th class="px-4 py-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b border-neutral-900/60 hover:bg-neutral-900/60">
                            <td class="px-4 py-2">
                                <span class="text-neutral-100">{{ $user->name }}</span>
                            </td>
                            <td class="px-4 py-2 text-neutral-400">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-2">
                                <span class="inline-flex items-center gap-2 rounded-full border border-neutral-800 px-2 py-1 text-[10px] uppercase tracking-[0.16em] {{ $user->is_admin ? 'text-neutral-100' : 'text-neutral-500' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $user->is_admin ? 'bg-neutral-50' : 'bg-neutral-500' }}"></span>
                                    {{ $user->is_admin ? 'Admin' : 'Customer' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-neutral-500">
                                {{ $user->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                @if ($user->is_admin)
                                    <span class="text-[11px] text-neutral-500">Cannot delete admin</span>
                                @else
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[11px] text-red-300 hover:text-red-200 transition">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    @endif
</main>
</body>
</html>
