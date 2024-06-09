# Create 

To create a credentials file for the Google Sheets API and use it in your Laravel application, follow these steps:

1. **Go to the Google Cloud Console:**

    - Go to the [Google Cloud Console](https://console.cloud.google.com/).
    - Create a new project or select an existing project.

2. **Enable the Google Sheets API:**
  
      - In the Google Cloud Console, navigate to the "APIs & Services" > "Library" section.
      - Search for "Google Sheets API" and enable it for your project.

3. **Create a Service Account:**

    - In the Google Cloud Console, navigate to the "APIs & Services" > "Credentials" section.
    - Click on "Create credentials" and select "Service account".
    - Fill in the required information and click "Create".
    - Assign the "Editor" role to the service account.

4. **Generate a JSON Key File:**

    - After creating the service account, click on the service account email.
    - Go to the "Keys" tab and click on "Add Key" > "Create new key".
    - Select "JSON" as the key type and click "Create".
    - Save the JSON key file to your local machine.

5. **Add the Service Account Email to the Google Sheet:**

    - Open the Google Sheet you want to access.
    - Click on "Share" and add the service account email as an editor.

6. **Move the JSON Key File to a Secure Location:**

    - Move the JSON key file to a secure location on your server.
    - Make sure the file is not accessible to the public.

7. **Set the Environment Variables:**

    - Add the path to the JSON key file to your Laravel application's `.env` file.
    - Add the Google Sheet ID to the `.env` file.

8. **Add the Environment Variables to the `.env` File:**

    - Add the following environment variables to your `.env` file:

```env
GOOGLE_SHEET_CREDENTIALS_PATH=/path/to/credentials.json
```

9. **Use the Google Sheets API in Your Laravel Application:**

    - You can now use the Google Sheets API in your Laravel application to read, write, and update Google Sheets.
    
# Usage

Find the usage documentation in the [Usage](docs/usage.md) guide.
