# ICL ITATS Implementation Plan

## 1. Build Objective

Build a deployable Laravel/PostgreSQL MVP that demonstrates:

```text
Login -> Career -> Competencies -> Assessment/Evidence
-> Skill Gap -> Development Plan -> New Evidence -> Reassessment
```

## 2. Working Assumptions

- Small student team.
- MVP scale below 1,000 users.
- One Laravel modular monolith.
- One PostgreSQL database.
- Web-first demo.
- AI is optional and must not block the core flow.
- Survey results, scoring weights, participants, and URLs remain placeholders until verified.

## 3. Agent Working Rules

1. Read all five project documents before changing code.
2. Work in small vertical slices.
3. Do not invent survey results or completed feature status.
4. Record every new dependency and its license.
5. Keep scoring server-authoritative and versioned.
6. Add tests for every completed core workflow.
7. Preserve existing user changes.
8. Keep AI optional with a deterministic fallback.
9. Use clearly labeled demo seed data.
10. Update the feature status table after each slice.

## 4. Suggested Repository Structure

Create domain folders for Identity, Career, Competency, Assessment, Evidence, GapAnalysis, DevelopmentPlan, Reassessment, Review, and AiSupport under `app/Domain/`. Keep HTTP concerns in `app/Http/`, persistence models in `app/Models/`, authorization in `app/Policies/`, background work in `app/Jobs/`, and reusable operations in `app/Services/`. Use `database/migrations`, `database/seeders`, `resources/views`, `resources/css`, `resources/js`, `routes`, `tests/Feature`, `tests/Unit`, and `docs` for their standard purposes.

## 5. Phase 0 - Bootstrap

### Tasks

- Create the Laravel project.
- Configure environment variables.
- Connect PostgreSQL.
- Configure authentication.
- Establish code style and test commands.
- Establish domain folders.
- Add a health check route.

### Acceptance Criteria

- App boots locally.
- Database connection succeeds.
- Authentication page loads.
- Test suite runs.
- No secrets are committed.

## 6. Phase 1 - Identity and Profile

### Tasks

- Create users and roles.
- Implement login/logout.
- Add student profile screen.
- Add server-side policies.
- Add demo accounts through seeders.

### Acceptance Criteria

- Student, reviewer, and admin have different permissions.
- Unauthorized users cannot access private pages.
- Profile changes persist.
- Feature tests cover login and role access.

## 7. Phase 2 - Career and Competency Foundation

### Tasks

- Create careers, competencies, and career mappings.
- Add admin CRUD for career profiles.
- Add required level, priority, weight, version, and source notes.
- Publish one seeded career with at least four competencies.
- Build student career selection and competency map screens.

### Acceptance Criteria

- Admin can publish a career.
- Student can select a published career.
- The map shows competency, required level, priority, evidence example, and source note.
- Draft and archived careers are not selectable.

## 8. Phase 3 - Assessment and Evidence

### Tasks

- Create assessment definitions and items.
- Build assessment attempt flow.
- Create evidence submission form.
- Link evidence to competencies.
- Add validation statuses.
- Store submitted results.

### Acceptance Criteria

- A student can complete a seeded assessment.
- A student can add project or portfolio evidence.
- Evidence ownership is enforced.
- Submitted results cannot be overwritten without a new attempt.

## 9. Phase 4 - Scoring and Skill Gap

### Tasks

- Implement a dedicated scoring service.
- Configure the initial scoring rule.
- Store the rule version with every result.
- Calculate current level, gap, status, and priority.
- Build explanation output from evidence and rule metadata.

### Acceptance Criteria

- Same inputs produce the same score.
- Score calculation has unit tests.
- User sees required level, current level, gap, evidence, and explanation.
- Missing evidence has a useful empty state.
- UI does not imply formal certification.

## 10. Phase 5 - Development Plan

### Tasks

- Create plans and activities.
- Map activities to competencies.
- Add priority, target date, expected evidence, status, and reflection.
- Generate an initial plan from prioritized gaps.
- Allow the student to edit and track activities.

### Acceptance Criteria

- A gap can create a development activity.
- Activity status changes persist.
- Completion requires expected evidence or an explicit override reason.
- The next action is visible on the dashboard.

## 11. Phase 6 - Reassessment

### Tasks

- Create reassessment records.
- Create immutable competency snapshots.
- Compare previous and new snapshots.
- Update gap status after new evidence.
- Display progress history.

### Acceptance Criteria

- New evidence creates a new snapshot, not an overwrite.
- Previous values remain visible.
- Comparison shows before, after, and change.
- Development plan shows unresolved work.

## 12. Phase 7 - Review and Feedback

### Tasks

- Add reviewer access.
- Add evidence review screen.
- Add comments and validation statuses.
- Display reviewer feedback to the student.

### Acceptance Criteria

- Reviewer access is restricted.
- Feedback is timestamped and attributable.
- Student cannot edit reviewer feedback.

## 13. Phase 8 - AI Supporting Layer

### Tasks

- Define an `AiProvider` interface.
- Implement a fake provider for tests and local fallback.
- Configure provider settings through environment variables.
- Add summary, explanation, and activity suggestion actions.
- Store generation metadata and review status.
- Add failure and timeout handling.

### Acceptance Criteria

- Core score and reassessment work when AI is unavailable.
- AI output is labeled.
- User can edit, accept, or reject output.
- No unnecessary personal data is sent.
- Tests never call a real provider.

## 14. Phase 9 - UI and Design QA

### Tasks

- Apply design tokens.
- Build responsive application shell.
- Add loading, empty, error, success, and permission states.
- Verify keyboard focus and semantic labels.
- Test mobile and desktop widths.
- Capture screenshots for the proposal.

### Acceptance Criteria

- The core journey is understandable without a walkthrough.
- Status is not communicated by color alone.
- No text or controls overlap.
- Core forms show validation errors clearly.

## 15. Phase 10 - Testing and Deployment

### Tests

- Unit tests for scoring and prioritization.
- Feature tests for authentication and role access.
- Feature tests for career and competency mapping.
- Feature tests for evidence and assessment.
- Feature tests for development plan and reassessment.
- Regression test for the complete student journey.
- Manual usability sessions with documented participants.

### Deployment Checklist

- Production environment configured.
- HTTPS enabled.
- Database migrations run.
- Seed/demo data loaded separately.
- Storage permissions verified.
- Queue/cron configured only if needed.
- Backup and restore tested.
- Error pages configured.
- Demo accounts documented.
- URL verified on a clean browser.

## 16. Definition of Done

A feature is done only when:

1. User story behavior is implemented.
2. Authorization is enforced.
3. Validation and error states exist.
4. Migration and seed needs are handled.
5. Automated tests pass.
6. Manual happy path works.
7. Mobile and desktop layout are checked.
8. Documentation is updated.
9. No fabricated data is included.
10. Evidence of completion is recorded.

## 17. Suggested Agent Prompts

### Prompt A - Start a Slice

```text
Read PRD.md, Design Systems.md, Architecture.md, Database Architecture.md,
and Implementation Plan.md. Implement only the next incomplete phase.
First inspect existing code. Preserve user changes. State files to change,
implement the smallest vertical slice, add tests, and report acceptance
criteria and risks. Do not invent survey results.
```

### Prompt B - Review a Slice

```text
Review the last implementation against the project documents. Find
authorization bugs, data integrity issues, missing empty/error states,
scoring explainability problems, accessibility issues, and missing tests.
Report severity with file and line references, then fix confirmed issues.
```

### Prompt C - Demo Readiness

```text
Run the complete student demo journey from login through reassessment.
Verify seeded data, screenshots, stable URL, error states, permissions,
and AI fallback. Do not claim a feature is complete without evidence.
Produce a concise demo checklist with pass/fail status.
```

## 18. Delivery Artifacts

- Source code.
- Database migrations and seeders.
- Technical installation and usage guide.
- Library and license list.
- Demo URL or executable as applicable.
- Demo video URL.
- Screenshots and proposal sections.
- Test report.
- Originality and license documents.
