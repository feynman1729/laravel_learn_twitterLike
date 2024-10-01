<?php

use App\Models\User;
use App\Models\Tweet;

it('can follow a user', function () {
  $user = User::factory()->create();
  $this->actingAs($user);

  $followedUser = User::factory()->create();
  $this->post(route('follow.store', $followedUser));

  $this->assertDatabaseHas('follows', [
    'follow_id' => $user->id,
    'follower_id' => $followedUser->id,
  ]);
});

it('can unFollow a user', function () {
  $user = User::factory()->create();
  $this->actingAs($user);

  $followedUser = User::factory()->create();
  $user->follows()->attach($followedUser);
  $this->delete(route('follow.destroy', $followedUser));

  $this->assertDatabaseMissing('follows', [
    'follow_id' => $user->id,
    'follower_id' => $followedUser->id,
  ]);
});

it('displays the user and followings tweet at current user page', function () {
  $user = User::factory()->create();
  $this->actingAs($user);

  $followedUser = User::factory()->create();
  $user->follows()->attach($followedUser);

  $tweet = Tweet::factory()->create(['user_id' => $followedUser->id]);

  $response = $this->get(route('profile.show', $user));

  $response->assertStatus(200);
  $response->assertSee($tweet->tweet);
  $response->assertSee($tweet->user->name);
});

it('displays the another user tweet at user show page', function () {
  $user = User::factory()->create();
  $this->actingAs($user);

  $anotherUser = User::factory()->create();

  $tweet = Tweet::factory()->create(['user_id' => $anotherUser->id]);

  $response = $this->get(route('profile.show', $anotherUser));

  $response->assertStatus(200);
  $response->assertSee($tweet->tweet);
  $response->assertSee($tweet->user->name);
});
