<div class="container mt-4">
    <h2 class="text-center mb-4">Manage Users</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-center mb-3">
        <input type="text" wire:model.live="search" class="form-control-sm" placeholder="Search">
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr wire:key="item-{{ $user->id }}">
                <td>{{ $users->firstItem() + $loop->index }}</td>
                <td>
                    {{ $user->name }}
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button wire:confirm="Are you sure you want to delete?" wire:click="delete({{ $user->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No users found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
