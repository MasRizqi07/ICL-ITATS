# PRD - ICL ITATS

## Career Intelligence Platform for University

**Product:** ICL ITATS  
**Competition:** GEMASTIK XIX 2026 - Software Development  
**Status:** MVP/prototype build specification  
**Stack:** PHP, Laravel, PostgreSQL

## 1. Product Summary

ICL ITATS helps university students connect a target career with required competencies, multi-evidence assessment, skill-gap analysis, personalized development plans, and reassessment.

The core product loop is:

```text
Career Target -> Competency Map -> Evidence -> Skill Gap
-> Development Plan -> New Evidence -> Reassessment
```

AI is a supporting layer for summaries, explanations, and activity suggestions. AI must not silently change scores or make absolute career decisions.

## 2. Problem Statement

Students have scattered learning experiences, projects, certificates, organizational activities, and portfolios but lack a structured way to understand how those experiences relate to a specific career. ICL connects required competencies, current evidence, gaps, and next actions in one explainable workflow.

## 3. Goals

- Help students select a target career.
- Show a career-specific competency map.
- Collect evidence from multiple sources.
- Produce an explainable competency profile.
- Show prioritized skill gaps.
- Produce a personalized development plan.
- Reassess after new evidence is added.
- Provide a usable and demonstrable web prototype.

## 4. Non-Goals

- Not a recruitment marketplace.
- Not a replacement for career counseling.
- Does not guarantee employment.
- Not a national competency certification system.
- Does not automatically verify every certificate or portfolio.
- Does not use AI as the sole scoring or decision engine.
- Does not integrate with every campus or learning platform in the MVP.

## 5. Users and Roles

| Role | Main needs |
|---|---|
| Student | Select career, assess competency, add evidence, understand gaps, follow a plan, reassess |
| Career advisor/reviewer | Review evidence, provide feedback, inspect progress |
| Administrator | Manage careers, competencies, evidence rules, activities, and access |
| University stakeholder | View aggregated insight in a later phase |

## 6. MVP Scope

### 6.1 Must Have

1. Authentication and role-based access.
2. Student profile.
3. Career profile selection.
4. Career-specific competency map.
5. Assessment and evidence submission.
6. Competency profile.
7. Explainable skill-gap analysis.
8. Personalized development plan.
9. Activity progress tracking.
10. Reassessment history.
11. Admin management for career and competency data.
12. Demo seed data.

### 6.2 Should Have

- Reviewer feedback.
- Evidence validation status.
- AI-generated evidence summary and gap explanation.
- AI-generated activity alternatives.
- Exportable student progress summary.

### 6.3 Deferred

- University-level aggregate dashboard.
- Notifications and external learning links.
- Portfolio import.
- Live employer recruitment.
- Payment or course checkout.
- Automated credential verification.
- Predictive employment scoring.
- Microservices deployment.

## 7. Core User Journey

1. Student signs in and completes a profile.
2. Student selects a target career.
3. System displays required competencies.
4. Student completes assessment and adds evidence.
5. System calculates a competency profile.
6. System shows prioritized gaps and explanations.
7. Student accepts or edits a development plan.
8. Student completes an activity and adds new evidence.
9. System runs reassessment and shows before/after progress.

## 8. Functional Requirements

| ID | Requirement |
|---|---|
| FR-01 | Support login, logout, password hashing, session protection, and role authorization. |
| FR-02 | Allow students to manage identity, program, semester, interests, experience, and portfolio links. |
| FR-03 | Allow administrators to create, edit, publish, archive, and version career profiles. |
| FR-04 | Connect careers to competencies, required levels, priorities, evidence examples, and activities. |
| FR-05 | Provide assessment items and allow answers, reflection, and linked evidence. |
| FR-06 | Store evidence metadata, a link/file reference, related competencies, status, and reviewer notes. |
| FR-07 | Calculate current competency level from configured rules and store the rule version. |
| FR-08 | Compare current and required levels and show priority, evidence, and explanation. |
| FR-09 | Create development activities with target dates, expected evidence, status, and reflection. |
| FR-10 | Create a new reassessment snapshot without overwriting the previous snapshot. |
| FR-11 | Let authorized reviewers validate evidence and add feedback. |
| FR-12 | Let users review, edit, accept, or reject AI-assisted summaries and suggestions. |

## 9. Non-Functional Requirements

- Usability: the next action is clear on every core screen.
- Explainability: scores and recommendations expose source data and rule version.
- Security: authorization is enforced server-side.
- Privacy: evidence access is restricted by role and data is minimized.
- Reliability: assessment and reassessment snapshots are preserved.
- Maintainability: scoring rules are isolated from controllers and views.
- Accessibility: semantic HTML, keyboard access, readable contrast, and non-color status indicators.
- Compatibility: current Chrome, Firefox, and Edge versions for the demo.

## 10. Success Metrics

Values are filled only after real testing.

| Metric | Definition | Target |
|---|---|---|
| Core task success | Students completing the end-to-end journey | [TO FILL] |
| Skill-gap comprehension | Students correctly explaining their top gap | [TO FILL] |
| Reassessment completion | Students completing a second snapshot | [TO FILL] |
| Usability score | Agreed instrument, e.g. SUS | [TO FILL] |
| Functional pass rate | Passed acceptance tests / total tests | [TO FILL] |

## 11. Release Acceptance Criteria

- A seeded student can complete the full journey without database edits.
- A seeded career has at least four competencies and activities.
- Every skill gap shows current level, required level, evidence, and explanation.
- New evidence creates a new reassessment snapshot.
- Student, reviewer, and admin permissions are enforced.
- AI failures do not block the core product flow.
- The application can be deployed using the technical runbook.
- Demo URL, source code, library licenses, and screenshots are documented.

## 12. Open Decisions

- Final career profiles: `[TO FILL FROM SURVEY/REVIEW]`.
- Competency scale and weights: `[TO VALIDATE]`.
- AI provider and data retention: `[TO DECIDE]`.
- Hosting and URL: `[TO FILL]`.
- Survey sample and test participants: `[TO FILL]`.
