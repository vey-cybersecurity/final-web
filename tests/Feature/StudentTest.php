<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_student_list(): void
    {
        $user = User::factory()->create();
        $student = Student::factory()->create(['name' => 'Vannak Heng']);

        $response = $this->actingAs($user)->get(route('students.index'));

        $response->assertStatus(200);
        $response->assertSee('Vannak Heng');
        $response->assertSee($student->department->name);
    }

    public function test_authenticated_user_can_create_student(): void
    {
        $user = User::factory()->create();
        $department = Department::factory()->create();

        $response = $this->actingAs($user)->post(route('students.store'), [
            'department_id' => $department->id,
            'student_code' => 'STU-TEST-999',
            'name' => 'Channara Sim',
            'gender' => 'Male',
            'dob' => '2004-05-20',
            'phone' => '+855 12 333 444',
        ]);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'student_code' => 'STU-TEST-999',
            'name' => 'Channara Sim',
        ]);
    }

    public function test_student_dob_cannot_be_in_the_future(): void
    {
        $user = User::factory()->create();
        $department = Department::factory()->create();

        $tomorrow = now()->addDay()->format('Y-m-d');

        $response = $this->actingAs($user)->from(route('students.create'))->post(route('students.store'), [
            'department_id' => $department->id,
            'student_code' => 'STU-FUTURE-001',
            'name' => 'Future Student',
            'gender' => 'Female',
            'dob' => $tomorrow,
            'phone' => '+855 12 111 222',
        ]);

        $response->assertRedirect(route('students.create'));
        $response->assertSessionHasErrors('dob');
    }

    public function test_student_code_must_be_unique(): void
    {
        $user = User::factory()->create();
        $existing = Student::factory()->create(['student_code' => 'STU-DUPLICATE']);

        $response = $this->actingAs($user)->from(route('students.create'))->post(route('students.store'), [
            'department_id' => $existing->department_id,
            'student_code' => 'STU-DUPLICATE',
            'name' => 'Duplicate Candidate',
            'gender' => 'Male',
            'dob' => '2004-01-01',
        ]);

        $response->assertRedirect(route('students.create'));
        $response->assertSessionHasErrors('student_code');
    }

    public function test_student_search_and_filter(): void
    {
        $user = User::factory()->create();
        $deptA = Department::factory()->create(['name' => 'Alpha']);
        $deptB = Department::factory()->create(['name' => 'Beta']);

        $studentA = Student::factory()->create([
            'name' => 'Sophal Nguon',
            'student_code' => 'STU-A-001',
            'department_id' => $deptA->id,
        ]);

        $studentB = Student::factory()->create([
            'name' => 'Sophal Kong',
            'student_code' => 'STU-B-002',
            'department_id' => $deptB->id,
        ]);

        // Filter by department Alpha
        $response = $this->actingAs($user)->get(route('students.index', [
            'search' => 'Sophal',
            'department_id' => $deptA->id,
        ]));

        $response->assertStatus(200);
        $response->assertSee('STU-A-001');
        $response->assertDontSee('STU-B-002');
    }

    public function test_student_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $student = Student::factory()->create();

        $response = $this->actingAs($user)->delete(route('students.destroy', $student));

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_student_can_be_created_with_profile_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $department = Department::factory()->create();
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post(route('students.store'), [
            'department_id' => $department->id,
            'student_code' => 'STU-PHOTO-001',
            'name' => 'Photo Student',
            'gender' => 'Male',
            'dob' => '2004-01-01',
            'photo' => $file,
        ]);

        $response->assertRedirect(route('students.index'));
        $student = Student::where('student_code', 'STU-PHOTO-001')->first();
        $this->assertNotNull($student->photo);
        Storage::disk('public')->assertExists($student->photo);
    }
}
