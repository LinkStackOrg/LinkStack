<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        $assetUrl = url('');
        config(['livewire.asset_url' => $assetUrl]);
    }
}