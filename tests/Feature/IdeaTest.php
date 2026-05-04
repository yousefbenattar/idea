<?php
use App\Models\User;
use App\Models\Idea;

test('it Belongs to a user', function () {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(User::class);
});
