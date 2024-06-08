<?php

// src/GoogleSheetServiceProvider.php
namespace RedaElfillali\GoogleSheetIntegration;

use Illuminate\Support\ServiceProvider;

class GoogleSheetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publier les fichiers de configuration
        $this->publishes([
          __DIR__.'/config/googlesheet.php' => config_path('googlesheet.php'),
      ], 'config');
    }

    public function register()
    {
        // Enregistrer les bindings
        $this->mergeConfigFrom(
            __DIR__.'/config/googlesheet.php', 'googlesheet'
        );
    }
}
