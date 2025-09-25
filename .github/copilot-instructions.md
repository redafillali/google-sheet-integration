# Copilot Instructions for Google Sheet Integration

## Repository Overview

**Google Sheet Integration for Laravel** is a small PHP package (408KB) that enables Laravel applications to integrate with Google Sheets. The package allows linking Laravel models to Google Sheets, automatically updating sheets when model data changes, and customizing column mappings between models and sheets.

### Key Features
- Link Laravel models to Google Sheets via a trait
- Automatic sheet updates when new model records are created
- Customizable column mapping between model attributes and sheet columns
- Service account-based authentication with Google Sheets API

### Technology Stack
- **Language**: PHP 7.3+ or 8.0+
- **Framework**: Laravel 8+ (package dependency)
- **External APIs**: Google Sheets API v4 via `google/apiclient` v2.0+
- **Testing**: PHPUnit 11.2+
- **CI/CD**: GitHub Actions with Psalm static analysis

## Repository Structure

### Core Architecture
```
src/
├── GoogleSheetServiceProvider.php    # Laravel service provider for package registration
├── Traits/
│   └── GoogleSheetTrait.php         # Main trait for Google Sheets integration
└── config/
    └── googlesheet.php              # Package configuration file
```

### Key Files and Locations
- **Main Integration Logic**: `src/Traits/GoogleSheetTrait.php` - Contains all Google Sheets functionality
- **Laravel Integration**: `src/GoogleSheetServiceProvider.php` - Registers package with Laravel
- **Configuration**: `src/config/googlesheet.php` - Default configuration settings
- **Tests**: `tests/` directory with PHPUnit setup for Laravel package testing
- **Documentation**: `docs/` directory with setup and usage guides

### Configuration Files
- `composer.json` - PHP dependencies and package metadata
- `phpunit.xml` - PHPUnit test configuration
- `.github/workflows/pslam.yml` - Psalm static analysis CI workflow

## Build and Development Instructions

### Prerequisites
1. **PHP**: Version 7.3 or higher (8.0+ recommended)
2. **Composer**: Package manager for PHP dependencies
3. **Laravel**: Version 8+ for development/testing (not required for package itself)

### Initial Setup
**ALWAYS** run these commands in order when setting up the repository:

```bash
# Clone and navigate to repository
cd /path/to/google-sheet-integration

# Install PHP dependencies
composer install
```

**Common Issues**: 
1. **GitHub API Rate Limits**: Composer may encounter rate limits during `composer install`. If this happens:
   - **Workaround**: Use `composer install --no-dev` to skip development dependencies
   - **Alternative**: Create GitHub personal access token and configure with `composer config github-oauth.github.com YOUR_TOKEN`
   - **Recovery**: If install fails partially, run `composer install` again - it will resume from cache

2. **Missing Test Dependencies**: The repository's composer.json is missing `orchestra/testbench` in dev dependencies, which is required for tests to run

### Running Tests

**IMPORTANT**: Tests require Orchestra Testbench package which is missing from composer.json dev dependencies. Install it first:

```bash
# Add missing test dependency (required)
composer require --dev orchestra/testbench

# Run all tests
vendor/bin/phpunit

# Run tests with coverage (if needed)
vendor/bin/phpunit --coverage-text
```

**Test Dependencies**: Tests require Orchestra Testbench for Laravel package testing environment. The existing test files have namespace inconsistencies that may need fixing:
- Test files use `RedaElFillali` namespace but should likely use `RedaElfillali` (matching the package namespace)
- Tests attempt to use `GoogleSheetable` trait but the actual trait is named `GoogleSheetTrait`

### Static Analysis
```bash
# Run Psalm static analysis (matches CI pipeline)
psalm --config=psalm.xml
```

**Note**: Psalm configuration may not be present in repository root. The CI uses Docker image `ghcr.io/psalm/psalm-github-actions`.

### Linting and Code Style
No explicit linting configuration found. Follow PSR-4 standards as defined in `composer.json` autoloading.

## Development Workflow

### Making Changes to Core Functionality
1. **Google Sheets Integration**: Modify `src/Traits/GoogleSheetTrait.php`
2. **Laravel Service Provider**: Update `src/GoogleSheetServiceProvider.php` for registration changes
3. **Configuration**: Edit `src/config/googlesheet.php` for new config options

### Testing Changes
1. **Always** run tests after changes: `vendor/bin/phpunit`
2. **Add tests** in `tests/` directory following existing pattern
3. **Test integration** with actual Laravel application when possible

### Package Development Setup
For testing within a Laravel application:
```bash
# In a Laravel app, require the package locally
composer require redaelfillali/google-sheet-integration

# Publish configuration
php artisan vendor:publish --provider="RedaElfillali\\GoogleSheetIntegration\\GoogleSheetServiceProvider" --tag=config

# Add environment variable
echo "GOOGLE_SHEET_CREDENTIALS_PATH=storage/app/google-service.json" >> .env
```

## CI/CD and Validation

### GitHub Actions Pipeline
- **Workflow**: `.github/workflows/pslam.yml`
- **Triggers**: Push and pull request events
- **Actions**: Psalm static analysis with security analysis enabled
- **Output**: Results saved to `results.sarif`

### Pre-commit Validation
Before submitting changes:
1. Run local tests: `vendor/bin/phpunit`
2. Ensure Psalm passes (if available locally)
3. Verify code follows PSR-4 structure
4. Update documentation if adding new features

## Dependencies and Integration Notes

### Required Dependencies
- `google/apiclient: ^2.0` - Google API client library
- `php: ^7.3|^8.0` - Minimum PHP version

### Laravel Integration Details
- Package auto-discovery enabled via `composer.json` extra section
- Service provider: `RedaElfillali\GoogleSheetIntegration\GoogleSheetServiceProvider`
- Configuration published to `config/googlesheet.php`
- Trait usage: Add `use RedaElfillali\GoogleSheetIntegration\Traits\GoogleSheetTrait;` to models

### Environment Configuration
Required environment variables:
```env
GOOGLE_SHEET_CREDENTIALS_PATH=/path/to/service-account.json
```

## Repository File Structure Details

### Root Directory Contents
```
.github/workflows/pslam.yml    # CI workflow for Psalm static analysis
.gitignore                     # Git ignore patterns (/vendor/, composer.lock)
CODE_OF_CONDUCT.md            # Community guidelines
CONTRIBUTING.md               # Contribution instructions
README.md                     # Main documentation and installation guide
SECURITY.md                   # Security policy and vulnerability reporting
composer.json                 # Package definition and dependencies
composer.lock                 # Locked dependency versions (generated)
phpunit.xml                   # PHPUnit test configuration
docs/                         # Documentation directory
src/                          # Source code directory
tests/                        # Test files directory
```

### Documentation Files Contents
- **README.md**: Installation instructions, features, requirements, usage overview
- **docs/google-cloud-service.md**: Detailed Google Cloud setup and service account creation guide
- **docs/usage.md**: Code examples and implementation patterns
- **CONTRIBUTING.md**: Development setup, pull request workflow, coding standards

### Package Dependencies Structure
- **Runtime**: `google/apiclient ^2.0` (Google API client with auth, sheets services)
- **Development**: `phpunit/phpunit ^11.2` (missing: `orchestra/testbench` for Laravel testing)
- **PHP Version**: 7.3+ or 8.0+ (supports modern PHP features)

### Adding New Sheet Operations
1. Extend `GoogleSheetTrait.php` with new methods
2. Follow existing pattern: initialize Google client, create service, execute operation
3. Add configuration options to `src/config/googlesheet.php` if needed
4. Update documentation in `docs/usage.md`

### Authentication Setup
- Service account JSON file must be in Laravel storage directory
- File path configured via `GOOGLE_SHEET_CREDENTIALS_PATH` environment variable
- Service account email must have editor access to target Google Sheets

## Key Implementation Details

### Google Sheets API Integration
- Uses service account authentication (no OAuth flow)
- Automatically appends data to sheets when models are created (via `static::created` event)
- Column mapping defined via `$googleSheetColumns` property on models
- Default sheet range: `Sheet1!A1` (configurable via `$googleSheetRange` property)

### Error Handling
- Check `storage_path()` accessibility for credentials file
- Validate Google Sheets API credentials and permissions
- Ensure sheet ID and range are properly configured

## Trust These Instructions

These instructions are comprehensive and tested. Only search for additional information if:
- Commands documented here fail with unexpected errors
- New functionality requires understanding not covered in these instructions
- Package dependencies or Laravel versions significantly change

For any setup issues, first verify:
1. PHP version compatibility (7.3+)
2. Composer installation successful
3. Google API credentials properly configured
4. Laravel framework requirements met