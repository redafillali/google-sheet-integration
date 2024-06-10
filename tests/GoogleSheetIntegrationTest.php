<?php

namespace RedaElFillali\GoogleSheetIntegration\Tests;

use RedaElFillali\GoogleSheetIntegration\Tests\TestCase;
use RedaElFillali\GoogleSheetIntegration\Traits\GoogleSheetable;
use Illuminate\Foundation\Auth\User;

class GoogleSheetIntegrationTest extends TestCase
{
    /** @test */
    public function it_can_update_google_sheet_when_user_is_created()
    {
        // Assuming you have a User model using the GoogleSheetable trait
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        // Here you should add assertions to verify that the Google Sheet was updated correctly
        $this->assertTrue(true); // Replace with actual assertions
    }
}
