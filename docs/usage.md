# Usage

## Step 1: Add the `GoogleSheetTrait` to your Model

```php
use RedaElfillali\GoogleSheetIntegration\Traits\GoogleSheetTrait;

class YourModel extends Model
{
    use GoogleSheetTrait;
}
```

## Step 2: Define the spreadsheet ID, range and column mapping

```php
protected $googleSheetId = 'your_spreadsheet_id';
protected $googleSheetRange = 'Sheet1!A1';
protected $googleSheetColumns = [
    'Column A Header' => 'model_attribute',
    'Column B Header' => 'another_attribute',
];
```

A new row is automatically appended to the sheet every time a model record is created.

## Notes

- `$googleSheetId` and `$googleSheetRange` fall back to `config('googlesheet.spreadsheet_id')` and `Sheet1!A1` if not declared on the model.
- `$googleSheetColumns` maps sheet column values to model attributes. If empty, no data is sent.
