<?php

namespace App\Traits;

use Livewire\Livewire;

trait DispatchNotificationTrait
{
    public function successNotify(string $title, string $message)
    {
        \Livewire\Component::dispatch('notify', [
            'variant' => 'success',
            'title' => $title,
            'message' => $message
        ]);
    }

    public function warningNotify(string $title, string $message)
    {
        \Livewire\Component::dispatch('notify', [
            'variant' => 'warning',
            'title' => $title,
            'message' => $message
        ]);
    }

    public function errorNotify(string $title, string $message)
    {
        \Livewire\Component::dispatch('notify', [
            'variant' => 'danger',
            'title' => $title,
            'message' => $message
        ]);
    }

    public function infoNotify(string $title, string $message)
    {
        \Livewire\Component::dispatch('notify', [
            'variant' => 'info',
            'title' => $title,
            'message' => $message
        ]);
    }
}
