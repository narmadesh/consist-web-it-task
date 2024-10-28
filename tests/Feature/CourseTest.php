<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_course(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('courses.create'));

        $response->assertSee('Title');
        $instructor = Instructor::factory()->create();
        $title = fake()->name();
        $description = fake()->text();
        $response = $this->actingAs($user)->post(route('courses.store'), [
            'title' => $title,
            'description' => $description,
            'instructor' => $instructor->id
        ]);

        $this->assertDatabaseHas('courses', [
            'title' => $title,
        ]);
        $this->assertDatabaseHas('course_instructors', [
            'instructor_id' => $instructor->id,
        ]);
    }

    public function test_list_course(): void
    {
        $user = User::factory()->create();
        $instructor = Instructor::factory()->create();
        $title = fake()->name();
        $description = fake()->text();
        $response = $this->actingAs($user)->post(route('courses.store'), [
            'title' => $title,
            'description' => $description,
            'instructor' => $instructor->id
        ]);
        $response = $this
            ->actingAs($user)
            ->get(route('courses.index'));

        $response->assertSee($title);
        $response->assertSee($description);
        $response->assertSee($instructor->name);
    }

    public function test_update_course(): void
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('courses.edit', ['course' => $course]));

        $response->assertSee($course->title);
        $response->assertSee($course->description);
        $title = fake()->name();
        $description = fake()->text();
        $instructor = Instructor::factory()->create();
        $response = $this->actingAs($user)->put(route('courses.update', ['course' => $course]), [
            'title' => $title,
            'description' => $description,
            'instructor' => $instructor->id
        ]);
        $this->assertDatabaseHas('courses', [
            'title' => $title,
            'description' => $description,
        ]);
    }

    public function test_delete_course(): void
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $response = $this->actingAs($user)->delete( route('courses.destroy',['course' => $course ]));
        $this->assertDatabaseMissing('courses', [
            'title' => $course->title,
        ]);
    }
}
