# Usage

## Example Controller

This example demonstrates how to use the Google Sheet Integration package in a Laravel controller.

### Step 1: Add the `GoogleSheet` Trait to you Model
  
  ```php
  use RedaElfillali\GoogleSheetIntegration\Traits\GoogleSheetTrait;

  class YourModel extends Model
  {
      use GoogleSheetTrait;
  }
  ```
  
### Step 2: Define the google sheet ID, the Range and the columns mapping in the model

  ```php
  protected $googleSheetId = 'your_spreadsheet_id';
  protected $googleSheetRange = 'Sheet1!A1';
  protected $googleSheetColumns = [
      'column_name' => 'attribute_name',
  ];
  ```
