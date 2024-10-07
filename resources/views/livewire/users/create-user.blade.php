<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $userId ? 'Edit User' : 'Create User' }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-center align-items-center">
        <form wire:submit.prevent="createUser" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">{{ $userId ? 'Edit User' : 'Create User' }}</h2>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" wire:model.live.debounce.1000ms="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" wire:model.live.debounce.1000ms="email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" wire:model="password">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" wire:model="image">
            </div>
            @if ($image)
            <div class="mb-3">
                <img width="40%" src="{{ $image->temporaryUrl() }}">
            </div>
            @endif

            <div wire:loading="createUser">
                Saving...
            </div>


            <button type="submit" class="btn btn-primary">{{ $userId ? 'Update User' : 'Create User' }}</button>
        </form>
    </div>
</div>
