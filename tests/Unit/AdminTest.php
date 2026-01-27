<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminTest extends TestCase
{
    private $controller;
    private $userMock;

    /**
     * Set up the test environment before each test
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock User model
        // This fake User won't touch the database
        $this->userMock = Mockery::mock(User::class);

        // Inject the mock into controller
        $this->controller = new AdminController($this->userMock);
    }

    /**
     * Clean up after each test
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test that dashboard method returns the correct view
     */
    public function test_dashboard_returns_correct_view(): void
    {
        // ACT: Call the dashboard method
        $response = $this->controller->dashboard();

        // ASSERT: Check it returns a View instance
        $this->assertIsObject($response);
        // Verify the view name
        $this->assertEquals('administrator.dashboard', $response->getName());
    }

    /**
     * Test that manageUserRoles gets users and returns correct view with data
     */
    public function test_manage_user_roles_gets_users_and_returns_view(): void
    {
        // ARRANGE: Set up test data
        $fakeUserId = 1;
        $fakeUsers = collect([
            ['id' => 2, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 3, 'name' => 'Jane Smith', 'email' => 'jane@example.com']
        ]);

        // Mock Auth::id() to return our fake authenticated user ID
        Auth::shouldReceive('id')
            ->once()                    // Expect it to be called exactly once
            ->andReturn($fakeUserId);   // Return our fake ID

        // Mock the User model's getAllUsers method
        $this->userMock
            ->shouldReceive('getAllUsers')
            ->once()                           // Expect it to be called once
            ->with($fakeUserId)                // Expect it to receive the authenticated user ID
            ->andReturn($fakeUsers);           // Return our fake users collection

        // ACT: Call the manageUserRoles method
        $response = $this->controller->manageUserRoles();

        // ASSERT: Verify the response is a View instance
        $this->assertIsObject($response);
        // Verify it's the correct view
        $this->assertEquals('administrator.dashboard', $response->getName());

        // Verify the view has the correct data
        $viewData = $response->getData();
        $this->assertEquals('Role management', $viewData['title']);
        $this->assertEquals($fakeUsers, $viewData['users']);
    }
}
