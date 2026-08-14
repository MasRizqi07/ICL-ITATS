# ICL ITATS Design System

## 1. Purpose

This document defines the visual and interaction language for ICL ITATS. The interface should feel clear, calm, trustworthy, and useful for repeated student work. It prioritizes scanning, comparison, evidence, and next actions.

## 2. Product Personality

- Clear: explain competency language in plain Indonesian.
- Grounded: show evidence and sources beside results.
- Encouraging: make progress visible without judging the student.
- Focused: keep the next useful action obvious.
- Responsible: label AI assistance and preserve user control.

## 3. Visual Tokens

### 3.1 Colors

Use a restrained multi-hue palette. Do not use gradients for core UI.

| Token | Value | Use |
|---|---|---|
| `color.ink` | `#17202A` | Main text |
| `color.muted` | `#667085` | Secondary text |
| `color.canvas` | `#F8FAFC` | Page background |
| `color.surface` | `#FFFFFF` | Panels and inputs |
| `color.line` | `#D9E0E8` | Borders and dividers |
| `color.blue` | `#2563EB` | Primary action and links |
| `color.teal` | `#0F766E` | Evidence and verified states |
| `color.amber` | `#B45309` | Attention and in-progress states |
| `color.red` | `#B42318` | Error and destructive states |
| `color.violet` | `#6D28D9` | AI-assisted label only |

Status must always include text or an icon label; color alone is insufficient.

### 3.2 Typography

Recommended font stack: `Inter, ui-sans-serif, system-ui, sans-serif`.

| Token | Size | Weight | Use |
|---|---:|---:|---|
| `type.display` | 32px | 700 | Page title only |
| `type.h1` | 26px | 700 | Major section |
| `type.h2` | 20px | 700 | Panel section |
| `type.h3` | 16px | 700 | Card or group title |
| `type.body` | 14px | 400 | Main content |
| `type.small` | 12px | 400 | Metadata and hints |
| `type.label` | 12px | 600 | Form labels and status |

### 3.3 Spacing and Shape

Use a 4px base scale: `4, 8, 12, 16, 24, 32, 40`.

- Default panel radius: 8px.
- Input and button radius: 6px.
- Icon button size: 36px minimum.
- Content max width: 1200px.
- Main page padding: 24px desktop, 16px mobile.
- Use borders and spacing for hierarchy; avoid nested cards.

## 4. Layout

```text
+------------------------------------------------------+
| Top bar: logo | context | notifications | profile    |
+-------------------+----------------------------------+
| Sidebar           | Page header + primary action     |
| navigation        |----------------------------------|
|                   | Main content                     |
+-------------------+----------------------------------+
```

On mobile, use a top bar and collapsible navigation. Core content must remain usable without horizontal scrolling.

## 5. Components

### 5.1 Buttons

- Primary: one clear action per section.
- Secondary: lower-emphasis follow-up action.
- Destructive: only for deletion or irreversible action.
- Icon-only: use familiar Lucide icons and tooltips.
- Loading buttons preserve width and show progress.

### 5.2 Status Badge

Allowed statuses: `Belum dinilai`, `Perlu ditingkatkan`, `Memenuhi`, `Berjalan`, `Selesai`, `Menunggu review`, `Terverifikasi`, `AI-assisted`.

### 5.3 Competency Row

Each row includes competency name, description, required level, current level, evidence count, status label, and a next action. Never show an unexplained score by itself.

### 5.4 Evidence Card

Include evidence title, type, linked competency, date, source/link, verification status, reviewer note, and actions.

### 5.5 Progress Indicator

Use a labeled stepper or progress bar with text such as `3 dari 5 aktivitas selesai`. Avoid implying scientific precision from decorative percentages.

### 5.6 Data Table

Use tables for comparisons: competencies, evidence, activities, and reassessment history. Provide loading, empty, error, and pagination states.

### 5.7 AI Assistance Panel

AI output appears in a clearly labeled panel with:

- `Dibantu AI` label;
- input context summary;
- generated text;
- source/evidence references;
- `Terima`, `Edit`, and `Tolak` actions;
- review disclaimer.

## 6. Interaction Rules

- Show the next action after every major result.
- Preserve unsaved form data when validation fails.
- Explain why a field is required.
- Confirm destructive actions.
- Do not hide important scoring rules in a tooltip only.
- Keep filters and selected career context visible.
- Show a visible error when AI fails; the core workflow must continue.

## 7. Accessibility

- Use semantic headings and landmarks.
- Every input has a visible label.
- Every icon-only button has an accessible name.
- Keyboard focus must be visible.
- Target WCAG 2.2 AA contrast.
- Associate error messages with fields.
- Communicate status with text and not color alone.
- Dialogs trap focus and close predictably.

## 8. Content Style

Use Indonesian as the default interface language. Explain domain terms on first use:

- `Target karier`
- `Peta kompetensi`
- `Bukti kemampuan (evidence)`
- `Kesenjangan kompetensi (skill gap)`
- `Rencana pengembangan`
- `Penilaian ulang (reassessment)`

Prefer `Perlu ditingkatkan` over `Lemah` and `Belum ada bukti` over `Tidak mampu`.

## 9. Required States

Every core screen must implement loading, empty, validation, error, success, permission-denied, mobile, and keyboard-focus states.

## 10. Design QA Checklist

- Does the screen show target career context?
- Can the user tell what to do next?
- Is every score explainable?
- Can the user distinguish evidence status from competency status?
- Are AI outputs labeled and editable?
- Does the layout work at 375px and desktop width?
- Are text, icons, and controls free from overlap?
