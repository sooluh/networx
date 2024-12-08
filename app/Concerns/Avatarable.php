<?php

namespace App\Concerns;

use Awcodes\FilamentGravatar\Gravatar;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait Avatarable
{
    public function updateAvatar(UploadedFile $photo): void
    {
        tap($this->avatar, function ($prev) use ($photo) {
            $avatar = $photo->storePublicly('users', ['disk' => 'public']);
            $this->forceFill(['avatar' => $avatar])->save();

            if ($prev) {
                Storage::disk('public')->delete($prev);
            }
        });
    }

    public function deleteAvatar(): void
    {
        Storage::disk('public')->delete($this->avatar);
        $this->forceFill(['avatar' => null])->save();
    }

    public function avatarUrl(): Attribute
    {
        /** @var \Illuminate\Filesystem\FilesystemManager $disk */
        $disk = Storage::disk('public');

        return Attribute::get(function () use ($disk) {
            return $this->avatar ? $disk->url($this->avatar) : $this->defaultAvatarUrl();
        });
    }

    protected function defaultAvatarUrl(): string
    {
        return Gravatar::get(email: $this->email);
    }
}
