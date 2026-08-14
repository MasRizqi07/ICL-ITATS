<?php

namespace Tests\Feature;

use App\Models\Competency;
use App\Models\Evidence;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EvidenceValidationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_student_can_submit_evidence_with_url_only(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();

        $response = $this->post('/evidence', [
            'title' => 'Repository Github Project',
            'type' => 'project',
            'description' => 'Tautan ke repositori github proyek mandiri',
            'source_url' => 'https://github.com/student/my-project',
            'competency_ids' => [$comp->id],
        ]);

        $response->assertRedirect('/evidence');
        $this->assertDatabaseHas('evidence', [
            'user_id' => $student->id,
            'title' => 'Repository Github Project',
            'source_url' => 'https://github.com/student/my-project',
            'validation_status' => 'pending',
        ]);
    }

    public function test_student_can_submit_evidence_with_pdf_file_only(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('sertifikat.pdf', 1000, 'application/pdf');

        $response = $this->post('/evidence', [
            'title' => 'Sertifikat Kelulusan Ujian',
            'type' => 'certificate',
            'description' => 'Berkas sertifikat resmi kelulusan',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $response->assertRedirect('/evidence');
        $evidence = Evidence::where('title', 'Sertifikat Kelulusan Ujian')->firstOrFail();

        $this->assertNotNull($evidence->storage_key);
        Storage::disk('local')->assertExists($evidence->storage_key);
    }

    public function test_student_can_submit_evidence_with_jpg_png_file(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->image('screenshot.png');

        $response = $this->post('/evidence', [
            'title' => 'Tangkapan Layar Portofolio',
            'type' => 'portfolio',
            'description' => 'Tangkapan layar desain antarmuka',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $response->assertRedirect('/evidence');
        $evidence = Evidence::where('title', 'Tangkapan Layar Portofolio')->firstOrFail();
        $this->assertNotNull($evidence->storage_key);
    }

    public function test_student_can_submit_evidence_with_zip_file(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('source_code.zip', 2000, 'application/zip');

        $response = $this->post('/evidence', [
            'title' => 'Arsip Kode Sumber',
            'type' => 'project',
            'description' => 'Berkas zip repositori proyek',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $response->assertRedirect('/evidence');
        $evidence = Evidence::where('title', 'Arsip Kode Sumber')->firstOrFail();
        $this->assertNotNull($evidence->storage_key);
    }

    public function test_evidence_file_exceeding_10mb_rejected(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        // 11MB file exceeds max 10240 KB limit
        $file = UploadedFile::fake()->create('large_file.pdf', 11264, 'application/pdf');

        $response = $this->post('/evidence', [
            'title' => 'Berkas Ukuran Terlalu Besar',
            'type' => 'certificate',
            'description' => 'File 11MB yang harus ditolak',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $response->assertSessionHasErrors(['evidence_file']);
    }

    public function test_unsupported_file_extension_rejected(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('script.exe', 500, 'application/octet-stream');

        $response = $this->post('/evidence', [
            'title' => 'Executable File Attack',
            'type' => 'project',
            'description' => 'Format file yang dilarang',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $response->assertSessionHasErrors(['evidence_file']);
    }

    public function test_evidence_without_url_and_without_file_rejected(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();

        $response = $this->post('/evidence', [
            'title' => 'Bukti Kosong Tanpa URL dan File',
            'type' => 'project',
            'description' => 'Tidak ada URL dan file',
            'competency_ids' => [$comp->id],
        ]);

        $response->assertSessionHasErrors(['source_url', 'evidence_file']);
    }

    public function test_evidence_with_both_url_and_file_accepted(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('doc.pdf', 500, 'application/pdf');

        $response = $this->post('/evidence', [
            'title' => 'Bukti Lengkap URL dan Berkas',
            'type' => 'project',
            'description' => 'Memiliki URL dan file sekaligus',
            'source_url' => 'https://github.com/student/repo',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $response->assertRedirect('/evidence');
        $evidence = Evidence::where('title', 'Bukti Lengkap URL dan Berkas')->firstOrFail();
        $this->assertNotNull($evidence->storage_key);
        $this->assertEquals('https://github.com/student/repo', $evidence->source_url);
    }

    public function test_evidence_without_competencies_rejected(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $response = $this->post('/evidence', [
            'title' => 'Bukti Tanpa Kompetensi',
            'type' => 'project',
            'description' => 'Tidak memilih kompetensi sama sekali',
            'source_url' => 'https://github.com/student/repo',
            'competency_ids' => [],
        ]);

        $response->assertSessionHasErrors(['competency_ids']);
    }

    public function test_owner_can_download_private_file(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('owner_cert.pdf', 500, 'application/pdf');

        $this->post('/evidence', [
            'title' => 'Owner Private Cert',
            'type' => 'certificate',
            'description' => 'Deskripsi sertifikat',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $evidence = Evidence::where('title', 'Owner Private Cert')->firstOrFail();

        $response = $this->get("/evidence/{$evidence->id}/download");
        $response->assertStatus(200);
    }

    public function test_other_student_cannot_download_private_file(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $otherStudent = User::create([
            'name' => 'Other Student User',
            'email' => 'otherstudent2@itats.ac.id',
            'password' => 'password',
            'role' => 'student',
        ]);

        $this->actingAs($student);
        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('private_doc.pdf', 500, 'application/pdf');

        $this->post('/evidence', [
            'title' => 'Private Student Document',
            'type' => 'certificate',
            'description' => 'Private document',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $evidence = Evidence::where('title', 'Private Student Document')->firstOrFail();

        // Other student attempting download -> 403 Forbidden
        $this->actingAs($otherStudent);
        $response = $this->get("/evidence/{$evidence->id}/download");
        $response->assertStatus(403);
    }

    public function test_reviewer_can_download_private_file(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $reviewer = User::where('email', 'reviewer@itats.ac.id')->firstOrFail();

        $this->actingAs($student);
        $comp = Competency::firstOrFail();
        $file = UploadedFile::fake()->create('reviewer_view.pdf', 500, 'application/pdf');

        $this->post('/evidence', [
            'title' => 'Reviewer Viewable Doc',
            'type' => 'certificate',
            'description' => 'Doc for review',
            'evidence_file' => $file,
            'competency_ids' => [$comp->id],
        ]);

        $evidence = Evidence::where('title', 'Reviewer Viewable Doc')->firstOrFail();

        $this->actingAs($reviewer);
        $response = $this->get("/evidence/{$evidence->id}/download");
        $response->assertStatus(200);
    }

    public function test_missing_file_returns_404(): void
    {
        $student = User::where('email', 'student@itats.ac.id')->firstOrFail();
        $this->actingAs($student);

        $evidence = Evidence::create([
            'user_id' => $student->id,
            'title' => 'Missing File Evidence',
            'type' => 'project',
            'description' => 'File missing from storage',
            'storage_key' => 'evidence/non_existent_file.pdf',
            'validation_status' => 'pending',
        ]);

        $response = $this->get("/evidence/{$evidence->id}/download");
        $response->assertStatus(404);
    }

    public function test_unauthenticated_user_cannot_download_evidence(): void
    {
        $evidence = Evidence::firstOrFail();

        $response = $this->get("/evidence/{$evidence->id}/download");
        $response->assertRedirect('/login');
    }
}
