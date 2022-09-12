<?php

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test("greets the user if they are signed out", function () {
    $this->get("/")
        ->assertSee("Bookfriends")
        ->assertSee("Sign up to get started.");
});

test("shows authenticated menu items if the user is signed in", function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get("/")
        ->assertSeeText([
            "Feed", "My Books", "Add a Book",
            "Friends", $user->name,
        ]);
});

test("shows unauthenticated menu items if the user is not signed in", function () {
    $this->get("/")
        ->assertSeeText([
            "Login", "Register",
        ]);
});
