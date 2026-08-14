<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentItem;
use App\Models\AssessmentResult;
use App\Models\Career;
use App\Models\CareerCompetency;
use App\Models\Competency;
use App\Models\CompetencySnapshot;
use App\Models\DevelopmentActivity;
use App\Models\DevelopmentPlan;
use App\Models\Evidence;
use App\Models\Feedback;
use App\Models\Reassessment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Users
        $student = User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Budi Santoso (Mahasiswa ITATS)',
            'email' => 'student@itats.ac.id',
            'password' => Hash::make('password'),
            'role' => 'student',
            'program' => 'Teknik Informatika',
            'semester' => 6,
            'bio' => 'Mahasiswa tingkat akhir yang berfokus pada pengembangan aplikasi web dan arsitektur perangkat lunak.',
        ]);

        $reviewer = User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Dr. Ahmad Rizal, M.T. (Reviewer Dosen)',
            'email' => 'reviewer@itats.ac.id',
            'password' => Hash::make('password'),
            'role' => 'reviewer',
            'program' => 'Teknik Informatika',
            'bio' => 'Dosen Pembimbing Karier & Assessor Sertifikasi Kompetensi Perangkat Lunak.',
        ]);

        $admin = User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Administrator ICL ITATS',
            'email' => 'admin@itats.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'bio' => 'Pengelola Kurikulum & Manajemen Karier Institusi ITATS.',
        ]);

        // 2. Seed Competencies
        $comp1 = Competency::create([
            'name' => 'PHP & Laravel Framework',
            'slug' => 'php-laravel-framework',
            'description' => 'Menguasai arsitektur MVC, Eloquent ORM, routing, middleware, dan pengujian otomatis di Laravel.',
            'domain' => 'Technical',
        ]);

        $comp2 = Competency::create([
            'name' => 'PostgreSQL & Database Design',
            'slug' => 'postgresql-database-design',
            'description' => 'Desain ERD relasional, indeksasi query, transaksi ACID, dan manajemen migrasi basis data.',
            'domain' => 'Technical',
        ]);

        $comp3 = Competency::create([
            'name' => 'Frontend UI & SaaS Design Tokens',
            'slug' => 'frontend-ui-saas-design-tokens',
            'description' => 'Penerapan HTML5 semantik, CSS3 responsif, Tailwind CSS, dan aksesibilitas standar WCAG AA.',
            'domain' => 'Technical',
        ]);

        $comp4 = Competency::create([
            'name' => 'RESTful API & Security Standard',
            'slug' => 'restful-api-security-standard',
            'description' => 'Pengembangan endpoint API aman, autentikasi berbasis token/session, sanitasi input, dan validasi CSRF.',
            'domain' => 'Technical',
        ]);

        $comp5 = Competency::create([
            'name' => 'Git & Version Control Workflow',
            'slug' => 'git-version-control-workflow',
            'description' => 'Manajemen repositori Git, branching strategy, pull request code review, dan CI/CD pipeline dasar.',
            'domain' => 'Management',
        ]);

        // 3. Seed Careers
        $career1 = Career::create([
            'name' => 'Fullstack Web Developer',
            'slug' => 'fullstack-web-developer',
            'description' => 'Mengembangkan aplikasi web end-to-end dari perancangan basis data backend hingga antarmuka pengguna frontend.',
            'status' => 'published',
            'version' => 1,
            'source_notes' => 'Disusun berdasarkan standar standar industri Software Engineering 2026.',
            'created_by' => $admin->id,
        ]);

        $career2 = Career::create([
            'name' => 'DevOps & Cloud Engineer',
            'slug' => 'devops-cloud-engineer',
            'description' => 'Mengelola infrastruktur cloud, kontainerisasi Docker, deployment otomatis, dan pemantauan performa server.',
            'status' => 'published',
            'version' => 1,
            'source_notes' => 'Profil karier bidang infrastruktur sistem.',
            'created_by' => $admin->id,
        ]);

        // 4. Map Career Competencies
        CareerCompetency::create([
            'career_id' => $career1->id,
            'competency_id' => $comp1->id,
            'required_level' => 4.5,
            'priority' => 'high',
            'weight' => 1.5,
            'rule_version' => 'v1.0',
        ]);

        CareerCompetency::create([
            'career_id' => $career1->id,
            'competency_id' => $comp2->id,
            'required_level' => 4.0,
            'priority' => 'high',
            'weight' => 1.2,
            'rule_version' => 'v1.0',
        ]);

        CareerCompetency::create([
            'career_id' => $career1->id,
            'competency_id' => $comp3->id,
            'required_level' => 4.0,
            'priority' => 'medium',
            'weight' => 1.0,
            'rule_version' => 'v1.0',
        ]);

        CareerCompetency::create([
            'career_id' => $career1->id,
            'competency_id' => $comp4->id,
            'required_level' => 4.5,
            'priority' => 'high',
            'weight' => 1.3,
            'rule_version' => 'v1.0',
        ]);

        // 5. Seed Assessment & Items
        $assessment = Assessment::create([
            'career_id' => $career1->id,
            'title' => 'Asesmen Mandiri Fullstack Web Developer',
            'version' => 'v1.0',
            'status' => 'published',
        ]);

        $item1 = AssessmentItem::create([
            'assessment_id' => $assessment->id,
            'competency_id' => $comp1->id,
            'prompt' => 'Sejauh mana kemampuan Anda dalam membuat aplikasi Laravel modular dengan Eloquent ORM dan pengujian otomatis?',
            'max_score' => 5.0,
            'position' => 1,
        ]);

        $item2 = AssessmentItem::create([
            'assessment_id' => $assessment->id,
            'competency_id' => $comp2->id,
            'prompt' => 'Sejauh mana Anda memahami perancangan skema relasional PostgreSQL, migrasi, dan pengindeksan query?',
            'max_score' => 5.0,
            'position' => 2,
        ]);

        $item3 = AssessmentItem::create([
            'assessment_id' => $assessment->id,
            'competency_id' => $comp3->id,
            'prompt' => 'Sejauh mana Anda mampu mengimplementasikan sistem desain UI berbasis Tailwind CSS dan desain responsif?',
            'max_score' => 5.0,
            'position' => 3,
        ]);

        $item4 = AssessmentItem::create([
            'assessment_id' => $assessment->id,
            'competency_id' => $comp4->id,
            'prompt' => 'Sejauh mana Anda memahami pembuatan REST API aman dengan validasi input dan penanganan eror yang tepat?',
            'max_score' => 5.0,
            'position' => 4,
        ]);

        // 6. Seed Student Attempt & Results
        $attempt = AssessmentAttempt::create([
            'user_id' => $student->id,
            'assessment_id' => $assessment->id,
            'career_id' => $career1->id,
            'status' => 'completed',
            'submitted_at' => now()->subDays(5),
        ]);

        AssessmentResult::create([
            'attempt_id' => $attempt->id,
            'competency_id' => $comp1->id,
            'score' => 3.0,
            'max_score' => 5.0,
            'explanation' => 'Memahami dasar MVC dan pembuatan CRUD di Laravel.',
        ]);

        AssessmentResult::create([
            'attempt_id' => $attempt->id,
            'competency_id' => $comp2->id,
            'score' => 3.5,
            'max_score' => 5.0,
            'explanation' => 'Mampu merancang skema relasional dan penulisan SQL join.',
        ]);

        AssessmentResult::create([
            'attempt_id' => $attempt->id,
            'competency_id' => $comp3->id,
            'score' => 3.0,
            'max_score' => 5.0,
            'explanation' => 'Mampu membuat tampilan web dasar dengan HTML/CSS.',
        ]);

        AssessmentResult::create([
            'attempt_id' => $attempt->id,
            'competency_id' => $comp4->id,
            'score' => 2.5,
            'max_score' => 5.0,
            'explanation' => 'Perlu memperdalam autentikasi token dan enkripsi keamanan.',
        ]);

        // 7. Seed Student Evidence
        $evidence1 = Evidence::create([
            'user_id' => $student->id,
            'title' => 'Sertifikat Pemrograman Laravel Advanced - Dicoding',
            'type' => 'certificate',
            'description' => 'Sertifikat kelulusan kelas Menjadi Laravel Web Developer Expert dengan predikat Sangat Memuaskan.',
            'source_url' => 'https://dicoding.com/certificates/EXAMPLE123',
            'obtained_at' => now()->subMonths(2),
            'validation_status' => 'verified',
            'reviewer_id' => $reviewer->id,
            'reviewer_note' => 'Sertifikat terverifikasi keabsahannya. Memenuhi kriteria standar kompetensi backend Laravel.',
        ]);
        $evidence1->competencies()->attach($comp1->id, ['relevance' => 1.0, 'note' => 'Bukti penguasaan Laravel']);

        $evidence2 = Evidence::create([
            'user_id' => $student->id,
            'title' => 'Portofolio Project Aplikasi E-Commerce Kampus',
            'type' => 'project',
            'description' => 'Aplikasi web e-commerce berbasis Laravel dan PostgreSQL dengan integrasi payment gateway sandbox.',
            'source_url' => 'https://github.com/budisantoso/kampus-store',
            'obtained_at' => now()->subMonth(),
            'validation_status' => 'pending',
        ]);
        $evidence2->competencies()->attach($comp2->id, ['relevance' => 0.9, 'note' => 'Implemetasi PostgreSQL riil']);

        // 8. Seed Feedback
        Feedback::create([
            'reviewer_id' => $reviewer->id,
            'student_id' => $student->id,
            'evidence_id' => $evidence1->id,
            'competency_id' => $comp1->id,
            'body' => 'Kerja bagus Budi! Bukti sertifikat Laravel sudah kami verifikasi. Pertahankan progres belajar Anda.',
        ]);

        // 9. Seed Development Plan & Activities
        $plan = DevelopmentPlan::create([
            'user_id' => $student->id,
            'career_id' => $career1->id,
            'status' => 'active',
        ]);

        $act1 = DevelopmentActivity::create([
            'plan_id' => $plan->id,
            'competency_id' => $comp4->id,
            'title' => 'Pelatihan REST API Security & OAuth2 Sanitization',
            'description' => 'Mempelajari proteksi endpoint REST API, validasi token JWT/Sanctum, serta penanganan rate-limiting.',
            'expected_evidence' => 'Repository GitHub mini-project API Security dan sertifikat pelatihan online.',
            'priority' => 'high',
            'status' => 'in_progress',
            'target_date' => now()->addWeeks(2),
        ]);

        $act2 = DevelopmentActivity::create([
            'plan_id' => $plan->id,
            'competency_id' => $comp3->id,
            'title' => 'Penerapan Design Tokens Tailwind CSS responsif pada Web Kampus',
            'description' => 'Mengimplementasikan komponen UI presisi dengan WCAG AA contrast pada aplikasi web kampus.',
            'expected_evidence' => 'Link demo website dan screenshot bukti responsivitas.',
            'priority' => 'medium',
            'status' => 'completed',
            'completed_at' => now()->subDay(),
            'reflection' => 'Saya berhasil memahami penggunaan token warna dan tipografi Inter pada tampilan SaaS.',
        ]);

        // 10. Seed Initial Reassessment Snapshot
        $reassessment = Reassessment::create([
            'user_id' => $student->id,
            'career_id' => $career1->id,
            'rule_version' => 'v1.0',
            'status' => 'completed',
            'completed_at' => now()->subDays(1),
            'created_at' => now()->subDays(1),
        ]);

        CompetencySnapshot::create([
            'reassessment_id' => $reassessment->id,
            'competency_id' => $comp1->id,
            'required_level' => 4.5,
            'current_level' => 4.0,
            'gap' => 0.5,
            'status' => 'perlu_ditingkatkan',
            'evidence_summary' => '1 Bukti Terverifikasi (Sertifikat Dicoding)',
            'explanation' => 'Tingkat kompetensi saat ini 4.0 dari target 4.5. Memerlukan sedikit dorongan proyek backend.',
        ]);

        CompetencySnapshot::create([
            'reassessment_id' => $reassessment->id,
            'competency_id' => $comp2->id,
            'required_level' => 4.0,
            'current_level' => 4.0,
            'gap' => 0.0,
            'status' => 'memenuhi',
            'evidence_summary' => '1 Bukti Menunggu Review (Portofolio E-Commerce)',
            'explanation' => 'Memenuhi target level 4.0. Menunggu hasil verifikasi resmi dari reviewer.',
        ]);

        CompetencySnapshot::create([
            'reassessment_id' => $reassessment->id,
            'competency_id' => $comp3->id,
            'required_level' => 4.0,
            'current_level' => 4.0,
            'gap' => 0.0,
            'status' => 'memenuhi',
            'evidence_summary' => '1 Aktivitas Selesai',
            'explanation' => 'Berhasil menyelesaikan aktivitas penerapan Tailwind CSS.',
        ]);

        CompetencySnapshot::create([
            'reassessment_id' => $reassessment->id,
            'competency_id' => $comp4->id,
            'required_level' => 4.5,
            'current_level' => 2.5,
            'gap' => 2.0,
            'status' => 'perlu_ditingkatkan',
            'evidence_summary' => 'Belum ada bukti terverifikasi',
            'explanation' => 'Kesenjangan 2.0 tingkat. Disarankan menuntaskan aktivitas pelatihan REST API Security.',
        ]);
    }
}
