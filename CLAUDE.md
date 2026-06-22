# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Tests
vendor/bin/phpunit

# Test single file
vendor/bin/phpunit tests/GoogleSheetIntegrationTest.php

# Install dependencies
composer install
```

## Architecture

Package Laravel publié sur Packagist. Aucune app Laravel ici — c'est une bibliothèque.

**Seul point d'entrée public :** `src/Traits/GoogleSheetTrait.php`

Le trait s'attache au hook Eloquent `created` via `bootGoogleSheetTrait()` et appelle `appendValuesToSheet()` automatiquement. Le modèle consommateur doit déclarer trois propriétés :

```php
protected $googleSheetId    = 'spreadsheet_id';
protected $googleSheetRange = 'Sheet1!A1';
protected $googleSheetColumns = ['ColA' => 'model_attribute', ...];
```

Si ces propriétés sont absentes, le trait se replie sur `config('googlesheet.spreadsheet_id')` (pour l'ID) et `'Sheet1!A1'` (pour le range). Les colonnes tombent sur un tableau vide — aucune donnée n'est envoyée.

**Authentification Google :** `storage_path(config('googlesheet.credentials_path'))` — le fichier JSON de service account doit être dans `storage/` de l'app hôte. Variable d'env : `GOOGLE_SHEET_CREDENTIALS_PATH`.

**Service provider** (`src/GoogleSheetServiceProvider.php`) : publie `src/config/googlesheet.php` vers `config/googlesheet.php` de l'app hôte (tag `config`), et fusionne la config par défaut.

**Tests** : utilisent Orchestra Testbench (`tests/TestCase.php`). PHPUnit 11 requis en dev.

## Namespace

`RedaElfillali\GoogleSheetIntegration` (autoload PSR-4 depuis `src/`).

> Attention : `tests/TestCase.php` et `tests/GoogleSheetIntegrationTest.php` utilisent `RedaElFillali` (casse différente) — incohérence connue, à corriger si les tests doivent réellement tourner.
