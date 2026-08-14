---
name: ICL ITATS Career Intelligence
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#434655'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#737686'
  outline-variant: '#c3c6d7'
  surface-tint: '#0053db'
  primary: '#004ac6'
  on-primary: '#ffffff'
  primary-container: '#2563eb'
  on-primary-container: '#eeefff'
  inverse-primary: '#b4c5ff'
  secondary: '#006a63'
  on-secondary: '#ffffff'
  secondary-container: '#99efe5'
  on-secondary-container: '#006f67'
  tertiary: '#8c3d00'
  on-tertiary: '#ffffff'
  tertiary-container: '#b15106'
  on-tertiary-container: '#ffece4'
  error: '#B42318'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dbe1ff'
  primary-fixed-dim: '#b4c5ff'
  on-primary-fixed: '#00174b'
  on-primary-fixed-variant: '#003ea8'
  secondary-fixed: '#9cf2e8'
  secondary-fixed-dim: '#80d5cb'
  on-secondary-fixed: '#00201d'
  on-secondary-fixed-variant: '#00504a'
  tertiary-fixed: '#ffdbca'
  tertiary-fixed-dim: '#ffb68e'
  on-tertiary-fixed: '#331200'
  on-tertiary-fixed-variant: '#763300'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
  ai-accent: '#6D28D9'
  ink: '#17202A'
  canvas: '#F8FAFC'
  line: '#D9E0E8'
typography:
  display:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  h1:
    fontFamily: Inter
    fontSize: 26px
    fontWeight: '700'
    lineHeight: '1.3'
  h2:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '700'
    lineHeight: '1.4'
  h3:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '600'
    lineHeight: '1.5'
  body:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: '1.6'
  small:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '400'
    lineHeight: '1.5'
  label:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: '1'
    letterSpacing: 0.01em
  h1-mobile:
    fontFamily: Inter
    fontSize: 22px
    fontWeight: '700'
    lineHeight: '1.3'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 32px
  xxl: 48px
  container-max: 1200px
  gutter: 24px
---

## Brand & Style

The design system for the Career Intelligence Platform embodies a **Corporate / Modern** aesthetic with a sophisticated "Enterprise SaaS" finish. The brand personality is professional, technical, and trustworthy, aimed at university students and career advisors. It balances the rigor of academic assessment with the forward-thinking energy of modern technology.

The visual direction prioritizes clarity and action. It utilizes a high-fidelity approach with generous white space, subtle depth, and a focus on data visualization that feels "masa kini" (contemporary). The interface avoids visual clutter to ensure students can focus on the core loop: mapping competencies, providing evidence, and closing skill gaps. AI elements are integrated as a supportive, transparent layer rather than an opaque decision-maker.

## Colors

This design system uses a restrained, professional palette designed for high legibility and WCAG AA compliance.

- **Primary (Blue #2563EB):** Used for primary actions, navigation links, and brand identification.
- **Secondary (Teal #0F766E):** Reserved for "Success" states, verified evidence, and positive competency outcomes.
- **Tertiary (Amber #B45309):** Used for attention, in-progress activities, and warnings that require student intervention.
- **AI Accent (Violet #6D28D9):** A specific, high-contrast violet used exclusively for AI-assisted panels and labels to distinguish machine-generated content from human-verified data.
- **Neutral:** A slate-gray scale is used for typography and structural borders to maintain a grounded, technical feel.

The default mode is **Light**, utilizing a "Canvas" background (`#F8FAFC`) to separate the page from white "Surface" containers.

## Typography

**Inter** is the exclusive typeface for this design system, chosen for its exceptional legibility in data-heavy SaaS environments and its neutral, technical character.

- **Headlines:** Use tighter letter spacing and bold weights to create a strong hierarchy.
- **Body Text:** Set at 14px for optimal readability of long-form career descriptions and AI summaries.
- **Labels:** Use semi-bold or bold weights at a smaller scale (12px) for form headers and status badges.
- **Responsive adjustment:** Display and H1 sizes scale down on mobile devices to prevent excessive line-breaking while maintaining the bold, authoritative feel.

## Layout & Spacing

The layout follows a **Fixed Grid** philosophy for the main content area, centered with a maximum width of 1200px to ensure line lengths remain readable for assessments.

- **System Model:** A 12-column grid is used for desktop, 6-columns for tablet, and a single-column fluid layout for mobile.
- **Spacing Rhythm:** Based on a 4px scale. 16px (`md`) is the standard padding for cards and components, while 24px (`lg`) is used for page margins and section gaps.
- **Mobile Adaptivity:** On mobile, page margins reduce to 16px. Sidebar navigation collapses into a bottom-sheet or a top-bar hamburger menu.
- **Vertical Rhythm:** Generous whitespace is used between major sections to prevent cognitive overload during complex competency assessments.

## Elevation & Depth

This design system uses **Tonal Layers** combined with **Ambient Shadows** to create a structured hierarchy without appearing cluttered.

- **Surface Levels:** The background `canvas` is the lowest level. White "Surface" containers sit on top of this.
- **Shadows:** Use extremely soft, low-opacity shadows (e.g., `0px 4px 12px rgba(0,0,0,0.05)`) to lift cards and panels. Shadows should feel ambient and natural, not sharp.
- **Borders:** Low-contrast outlines (`line` token) are used for secondary containers and inputs to maintain a clean, grid-like structure.
- **AI Panels:** These utilize a subtle `ai-accent` tinted background or border to visually "lift" them from standard human-input sections, signaling their distinct nature.

## Shapes

The shape language is **Rounded**, reflecting a modern and approachable enterprise feel.

- **Standard Elements:** 0.5rem (8px) is the default for panels, evidence cards, and AI panels.
- **Interactive Elements:** Buttons and form inputs use a slightly tighter 6px radius to appear more precise and functional.
- **Progress Bars:** Use fully rounded (pill-shaped) ends for the outer container and the inner fill to create a smooth, non-threatening visual for competency tracking.

## Components

### Buttons
- **Primary:** Solid `primary_color`, white text. Used for the main "Next Action" (e.g., "Add Evidence").
- **Secondary:** Outlined with `line` color or subtle `primary_color` tint.
- **AI Actions:** Specific buttons within AI panels should use the `ai-accent` color sparingly for "Accept Suggestion" actions.

### Status Badges & Chips
Small, high-contrast labels with clear icons. Use `teal` for "Terverifikasi," `amber` for "Berjalan," and `neutral` for "Belum dinilai." 

### Competency Progress Bars
A dual-layer bar. The background is a light gray; the fill uses `primary_color`. If a "Skill Gap" is being visualized, use a secondary color marker to show the "Target Level" vs. the "Current Level."

### AI-Assisted Panels
These panels must be distinct. They use a light violet background wash, a `Dibantu AI` badge in the top right, and clear "Accept," "Edit," or "Reject" buttons at the footer.

### Evidence Cards
Rich cards containing: Evidence title, Type icon (e.g., file, link), Status badge, and a Reviewer feedback section. Use a `line` border to define the card edge.

### Inputs
Clean, 14px text, 6px border-radius, with focus states using a 2px `primary_color` ring. Labels are always visible above the field using the `label` typography token.