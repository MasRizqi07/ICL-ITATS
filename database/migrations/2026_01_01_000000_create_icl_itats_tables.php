<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop standard users table if exists to recreate with UUID and custom fields
        Schema::dropIfExists('users');

        // 1. users
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('student'); // student, reviewer, admin
            $table->string('program')->nullable(); // e.g. Teknik Informatika
            $table->smallInteger('semester')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar_url')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. careers
        Schema::create('careers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('status')->default('published'); // draft, published, archived
            $table->integer('version')->default(1);
            $table->text('source_notes')->nullable();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 3. competencies
        Schema::create('competencies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('domain')->default('Technical'); // Technical, SoftSkill, Management, Tooling
            $table->timestamps();
        });

        // 4. career_competencies
        Schema::create('career_competencies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('career_id')->constrained('careers')->onDelete('cascade');
            $table->foreignUuid('competency_id')->constrained('competencies')->onDelete('cascade');
            $table->decimal('required_level', 4, 2)->default(4.0);
            $table->string('priority')->default('high'); // high, medium, low
            $table->decimal('weight', 4, 2)->default(1.0);
            $table->string('rule_version')->default('v1.0');
            $table->text('source_notes')->nullable();
            $table->timestamps();

            $table->unique(['career_id', 'competency_id', 'rule_version']);
        });

        // 5. evidence
        Schema::create('evidence', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('type')->default('project'); // project, portfolio, test, certificate, reflection, other
            $table->text('description');
            $table->string('source_url')->nullable();
            $table->string('storage_key')->nullable();
            $table->date('obtained_at')->nullable();
            $table->string('validation_status')->default('pending'); // draft, pending, verified, needs_revision
            $table->foreignUuid('reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('reviewer_note')->nullable();
            $table->timestamps();
        });

        // 6. evidence_competencies
        Schema::create('evidence_competencies', function (Blueprint $table) {
            $table->foreignUuid('evidence_id')->constrained('evidence')->onDelete('cascade');
            $table->foreignUuid('competency_id')->constrained('competencies')->onDelete('cascade');
            $table->decimal('relevance', 3, 2)->default(1.0);
            $table->text('note')->nullable();

            $table->primary(['evidence_id', 'competency_id']);
        });

        // 7. assessments
        Schema::create('assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('career_id')->constrained('careers')->onDelete('cascade');
            $table->string('title');
            $table->string('version')->default('v1.0');
            $table->string('status')->default('published');
            $table->timestamps();
        });

        // 8. assessment_items
        Schema::create('assessment_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('assessment_id')->constrained('assessments')->onDelete('cascade');
            $table->foreignUuid('competency_id')->constrained('competencies')->onDelete('cascade');
            $table->text('prompt');
            $table->string('item_type')->default('scale');
            $table->decimal('max_score', 4, 2)->default(5.0);
            $table->integer('position')->default(1);
            $table->timestamps();
        });

        // 9. assessment_attempts
        Schema::create('assessment_attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('assessment_id')->constrained('assessments')->onDelete('cascade');
            $table->foreignUuid('career_id')->constrained('careers')->onDelete('cascade');
            $table->string('status')->default('completed');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });

        // 10. assessment_results
        Schema::create('assessment_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('attempt_id')->constrained('assessment_attempts')->onDelete('cascade');
            $table->foreignUuid('competency_id')->constrained('competencies')->onDelete('cascade');
            $table->decimal('score', 4, 2);
            $table->decimal('max_score', 4, 2)->default(5.0);
            $table->text('explanation')->nullable();
            $table->timestamps();
        });

        // 11. development_plans
        Schema::create('development_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('career_id')->constrained('careers')->onDelete('cascade');
            $table->string('status')->default('active'); // active, paused, completed, archived
            $table->timestamps();
        });

        // 12. development_activities
        Schema::create('development_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('plan_id')->constrained('development_plans')->onDelete('cascade');
            $table->foreignUuid('competency_id')->constrained('competencies')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('expected_evidence')->nullable();
            $table->string('priority')->default('high');
            $table->string('status')->default('in_progress'); // not_started, in_progress, blocked, completed
            $table->date('target_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('reflection')->nullable();
            $table->timestamps();
        });

        // 13. activity_evidence
        Schema::create('activity_evidence', function (Blueprint $table) {
            $table->foreignUuid('activity_id')->constrained('development_activities')->onDelete('cascade');
            $table->foreignUuid('evidence_id')->constrained('evidence')->onDelete('cascade');

            $table->primary(['activity_id', 'evidence_id']);
        });

        // 14. reassessments
        Schema::create('reassessments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('career_id')->constrained('careers')->onDelete('cascade');
            $table->uuid('previous_id')->nullable();
            $table->string('rule_version')->default('v1.0');
            $table->string('status')->default('completed');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // 15. competency_snapshots
        Schema::create('competency_snapshots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('reassessment_id')->constrained('reassessments')->onDelete('cascade');
            $table->foreignUuid('competency_id')->constrained('competencies')->onDelete('cascade');
            $table->decimal('required_level', 4, 2);
            $table->decimal('current_level', 4, 2);
            $table->decimal('gap', 4, 2);
            $table->string('status')->default('perlu_ditingkatkan'); // belum_dinilai, perlu_ditingkatkan, memenuhi, terverifikasi
            $table->text('evidence_summary')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
        });

        // 16. feedback
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('evidence_id')->nullable()->constrained('evidence')->nullOnDelete();
            $table->foreignUuid('competency_id')->nullable()->constrained('competencies')->nullOnDelete();
            $table->text('body');
            $table->timestamps();
        });

        // 17. ai_generations
        Schema::create('ai_generations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('purpose');
            $table->json('input_reference')->nullable();
            $table->text('output_text');
            $table->string('provider')->default('fallback');
            $table->string('model')->nullable();
            $table->string('status')->default('generated'); // generated, accepted, edited, rejected, failed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_generations');
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('competency_snapshots');
        Schema::dropIfExists('reassessments');
        Schema::dropIfExists('activity_evidence');
        Schema::dropIfExists('development_activities');
        Schema::dropIfExists('development_plans');
        Schema::dropIfExists('assessment_results');
        Schema::dropIfExists('assessment_attempts');
        Schema::dropIfExists('assessment_items');
        Schema::dropIfExists('assessments');
        Schema::dropIfExists('evidence_competencies');
        Schema::dropIfExists('evidence');
        Schema::dropIfExists('career_competencies');
        Schema::dropIfExists('competencies');
        Schema::dropIfExists('careers');
        Schema::dropIfExists('users');
    }
};
