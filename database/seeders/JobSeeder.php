<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employers = Employer::query()->get();

        if ($employers->isEmpty()) {
            $employers = Employer::factory(8)->create();
        }

        $tags = collect([
            'Laravel',
            'PHP',
            'JavaScript',
            'TypeScript',
            'Node.js',
            'React',
            'API',
            'Docker',
            'SQL',
            'Python',
            'Backend',
            'Frontend',
            'Fullstack',
        ])->map(function (string $name) {
            return Tag::query()->firstOrCreate(['name' => $name]);
        });

        for ($i = 0; $i < 12; $i++) {
            $job = Job::factory()
                ->for($employers->random())
                ->create([
                    'feature' => fake()->boolean(30),
                ]);

            $job->tags()->sync(
                $tags->random(random_int(1, 4))->pluck('id')->all(),
            );
        }
    }
}
