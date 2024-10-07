<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\View\Components\Layouts\App;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $users = User::when($this->search, function ($query) {
            return $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        })->paginate(15);

        return view('livewire.users.user-list', [
            'users' => $users,
        ])->layout(App::class);
    }

    public function delete($userId){
        User::destroy($userId);
    }

}
