# Walkthrough — ICL ITATS Fase 5 (Remediation Closure)

This document provides complete, transparent records of Phase 5 remediation tasks and the changelog for previous rounds.

---

## Historical Disclosure: Evidence File Upload & Download Feature

In the previous round, file upload and download capabilities were added to `EvidenceController` but omitted from previous documentation:
- **`EvidenceController::store()`**: Accepts `evidence_file` (PDF, PNG, JPG, JPEG, ZIP up to 10MB) via `StoreEvidenceRequest`, securely stored on the `local` private disk under `storage/app/evidence/`, with automatic cleanup on transaction failure.
- **`EvidenceController::download(string $id)`**: Authorizes only the evidence owner, reviewers, or admins to download the stored private file with slugified filename and extension.
- **Routes & Views**: Route `evidence.download` (`GET /evidence/{id}/download`) and upload input field in `resources/views/pages/evidence/create.blade.php` and `index.blade.php`.

---

## Phase 5 Completed Tasks

### Task 1 — Permanent Student Target Career Persistence (`target_career_id`)
- Added database migration `database/migrations/2026_08_17_000001_add_target_career_id_to_users_table.php` adding nullable UUID `target_career_id` referencing `careers.id` with `nullOnDelete()`.
- Updated `app/Models/User.php` fillable attributes and added `targetCareer()` relationship.
- Updated `CareerController::show()` to persist `$user->update(['target_career_id' => $career->id])` when a logged-in student visits a career.
- Updated `app/Traits/ResolvesCareer.php` with 4-level resolution priority:
  1. Explicit query parameter `?career=slug` (transient browsing).
  2. Authenticated user's `target_career_id`.
  3. Session `selected_career_slug` (guest/fallback).
  4. First published career in database.

### Task 2 — Snapshot Isolation in Reviewer Evidence Approval
- Updated `ReviewerController::reviewEvidence()` to resolve career strictly from the evidence owner:
  `$latestReassessment?->career ?? ($evidence->user->target_career_id ? Career::find($evidence->user->target_career_id) : null)`.
- If `$career` is null (student has not chosen a target career), snapshot creation is explicitly skipped and logged.
- Added tests in `tests/Feature/AuthorizationTest.php` proving reviewer session context does not bleed into the student's reassessment snapshot.

### Task 3 — Dynamic Navigation Links via View Composer
- Updated `AppServiceProvider::boot()` to share `$currentCareer` globally to all views via View Composer.
- Replaced hardcoded `'fullstack-web-developer'` in `resources/views/layouts/app.blade.php` (mobile & desktop navigation) with dynamic `{{ $currentCareer ? route('careers.show', $currentCareer->slug) : route('careers.index') }}`.

### Task 4 & 5 — Verification and Test Execution
- Total test count: 47 tests, 148 assertions, 0 failures, 0 regressions.
