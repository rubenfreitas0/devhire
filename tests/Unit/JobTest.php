<?php

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('it belongs to a employer', function () {
    // AAA
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);

    // Act and Assert
    expect($job->employer)->is($employer)->toBeTrue();

});

it('can have tags', function () {
    // AAA
    $job = Job::factory()->create();

    // Act
    $job->tag('Frontend');

    // Assert
    expect($job->tags)->toHaveCount(1);
});
