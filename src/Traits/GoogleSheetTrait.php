<?php

namespace RedaElfillali\GoogleSheetIntegration\Traits;

use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

trait GoogleSheetTrait
{
    protected static function bootGoogleSheetTrait()
    {
        static::created(function ($model) {
            $model->appendValuesToSheet();
        });
    }

    protected function initializeGoogleSheet()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path(config('googlesheet.credentials_path')));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS);

        return new Google_Service_Sheets($client);
    }

    public function appendValuesToSheet()
    {
        $service = $this->initializeGoogleSheet();

        $values = [
            $this->mapModelToSheetColumns()
        ];

        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $spreadsheetId = $this->getGoogleSheetId();
        $range = $this->getGoogleSheetRange();

        return $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    }

    protected function getGoogleSheetId()
    {
        return property_exists($this, 'googleSheetId') ? $this->googleSheetId : config('googlesheet.spreadsheet_id');
    }

    protected function getGoogleSheetRange()
    {
        return property_exists($this, 'googleSheetRange') ? $this->googleSheetRange : 'Sheet1!A1';
    }

    protected function mapModelToSheetColumns()
    {
        return array_map(function ($column) {
            return $this->{$column};
        }, array_values($this->getGoogleSheetColumns()));
    }

    protected function getGoogleSheetColumns()
    {
        return property_exists($this, 'googleSheetColumns') ? $this->googleSheetColumns : [];
    }
}
