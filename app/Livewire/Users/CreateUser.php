<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\View\Components\Layouts\App;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $image;

    public $userId = null;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|' . ($this->userId ? 'unique:users,email,' . $this->userId : 'unique:users,email'),
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function mount($userId = null)
    {
        if ($userId) {
            $this->userId = $userId;
            $this->loadUserData();
        }
    }

    protected function loadUserData()
    {
        $user = User::findOrFail($this->userId);
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function createUser()
    {
        $this->validate();

        $this->saveUser();
        session()->flash('message', $this->userId ? 'User updated successfully.' : 'User created successfully.');
        $this->resetFields();
    }

    protected function saveUser()
    {
        if ($this->userId) {
            $this->updateUser();
        } else {
            $this->createNewUser();
        }
    }

    protected function createNewUser()
    {
        try {
            $filename = null;
            if ($this->image) {
                $filename = $this->image->store('images');
            }
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'image' => $filename ? basename($filename) : null,
            ]);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }


    protected function updateUser()
    {
        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $user->password,
        ]);
    }

    protected function resetFields()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.users.create-user')->layout(App::class);
    }
}
