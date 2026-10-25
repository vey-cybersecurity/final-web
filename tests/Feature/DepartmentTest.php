<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_department_list(): void
    {
        $user = User::factory()->create();
        $department = Department::factory()->create(['name' => 'Architecture']);

        $response = $this->actingAs($user)->get(route('departments.index'));

        $response->assertStatus(200);
        $response->assertSee('Architecture');
    }

    public function test_authenticated_user_can_create_department(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('departments.store'), [
            'name' => 'Data Science',
            'description' => 'Machine learning and big data analytics',
        ]);

        $response->assertRedirect(route('departments.index'));
        $this->assertDatabaseHas('departments', ['name' => 'Data Science']);
    }

    public function test_department_name_must_be_unique(): void
    {
        $user = User::factory()->create();
        Department::factory()->create(['name' => 'IT']);

        $response = $this->actingAs($user)->from(route('departments.create'))->post(route('departments.store'), [
            'name' => 'IT',
            'description' => 'Duplicate department name',
        ]);

        $response->assertRedirect(route('departments.create'));
        $response->assertSessionHasErrors('name');
    }

    public function test_empty_department_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $department = Department::factory()->create();

        $response = $this->actingAs($user)->delete(route('departments.destroy', $department));

        $response->assertRedirect(route('departments.index'));
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

    public function test_cannot_delete_department_with_students(): void
    {
        $user = User::factory()->create();
        $department = Department::factory()->create(['name' => 'Engineering']);
        Student::factory()->create(['department_id' => $department->id]);

        $response = $this->actingAs($user)->delete(route('departments.destroy', $department));

        $response->assertRedirect(route('departments.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('departments', ['id' => $department->id]);
    }
}
