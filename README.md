# Google Sheet Integration for Laravel

A Laravel 10 package to integrate Google Sheets, allowing you to link a model to a Google Sheet, update the Google Sheet, and add new rows for each new value of the selected model. Customize the mapping of Google Sheet columns to model values.

<p align="center">
<a href="https://packagist.org/packages/redaelfillali/google-sheet-integration"><img src="https://img.shields.io/packagist/v/redaelfillali/google-sheet-integration.svg?style=flat" alt="Latest Stable Version"></a>
<a href="https://img.shields.io/packagist/dt/redaelfillali/google-sheet-integration.svg?style=flat" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/redaelfillali/google-sheet-integration"><img src="https://img.shields.io/badge/License-MIT-brightgreen.svg" alt="License"></a>
</p>


## Features

- Link a Laravel model to a Google Sheet
- Update Google Sheets with model data
- Add new rows to Google Sheets when new model values are added
- Customize the column mapping between the Google Sheet and model attributes

## Requirements

- PHP >= 8.0
- Laravel 10
- Google API Client Library

# Installation

## Prerequisites

1. Ensure you have [Composer](https://getcomposer.org/) installed.
2. Set up a Google Cloud project with the Sheets API enabled and create a service account with JSON credentials. [Follow this guide](docs/google-cloud-service.md) to set up the Google Sheets API and create a service account.

## Step-by-Step Guide

1. **Install the package via Composer:**

```bash
composer require redaelfillali/google-sheet-integration
```

2. **Publish the package configuration file:**

```bash
php artisan vendor:publish --provider="RedaElfillali\\GoogleSheetIntegration\\GoogleSheetServiceProvider" --tag=config
```
3. **Add the following environment variables to your `.env` file:**

```env
GOOGLE_SHEET_CREDENTIALS_PATH=/path/to/credentials.json
```

# Usage

The usage documentation can be found in the [Usage](docs/usage.md).

