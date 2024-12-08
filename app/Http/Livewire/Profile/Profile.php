<?php

namespace App\Http\Livewire\Profile;

use App\Filament\Pages\Profile as ProfilePage;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    public ?array $state = [];

    public $photo;

    /** @var \App\Model\User */
    public $user;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->state = $this->user?->withoutRelations()->toArray();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('login')
                ->label('Nama pengguna')
                ->regex('/^[a-z0-9_-]{3,15}$/i')
                ->unique(User::class, 'login', modifyRuleUsing: function (Unique $rule) {
                    return $rule->whereNot('id', auth('web')->id());
                })
                ->required()
                ->disabledOn('edit'),

            Forms\Components\TextInput::make('email')
                ->label('Alamat surel')
                ->email()
                ->unique(User::class, 'email', modifyRuleUsing: function (Unique $rule) {
                    return $rule->whereNot('id', auth('web')->id());
                })
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('name')
                ->label('Nama lengkap')
                ->required()
                ->maxLength(255),
        ])->statePath('state');
    }

    public function save(): void
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->photo)) {
            $this->user->updateAvatar($this->photo);
        }

        $this->user->forceFill([
            'login' => $this->state['login'],
            'email' => $this->state['email'],
            'name' => $this->state['name'],
        ])->save();

        if (isset($this->photo)) {
            redirect(ProfilePage::getUrl());
        }

        Notification::make()->success()->title('Detail profil berhasil diperbarui.')->send();
    }

    public function deleteAvatar(): void
    {
        $this->user?->deleteAvatar();
        redirect(ProfilePage::getUrl());
    }

    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }

    public function render()
    {
        return view('livewire.profile.profile');
    }
}
