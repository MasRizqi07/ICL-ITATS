---
name: ICL ITATS Obsidian
colors:
  surface: '#0F172A'
  surface-dim: '#0b1326'
  surface-bright: '#31394d'
  surface-container-lowest: '#060e20'
  surface-container-low: '#131b2e'
  surface-container: '#1E293B'
  surface-container-high: '#334155'
  surface-container-highest: '#2d3449'
  on-surface: '#dae2fd'
  on-surface-variant: '#c1c7d3'
  inverse-surface: '#dae2fd'
  inverse-on-surface: '#283044'
  outline: '#8b919d'
  outline-variant: '#414751'
  surface-tint: '#a4c9ff'
  primary: '#a4c9ff'
  on-primary: '#00315d'
  primary-container: '#60a5fa'
  on-primary-container: '#003a6b'
  inverse-primary: '#0060ac'
  secondary: '#44e2cd'
  on-secondary: '#003731'
  secondary-container: '#03c6b2'
  on-secondary-container: '#004d44'
  tertiary: '#f9bd22'
  on-tertiary: '#402d00'
  tertiary-container: '#ce9a00'
  on-tertiary-container: '#4a3500'
  error: '#F87171'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#d4e3ff'
  primary-fixed-dim: '#a4c9ff'
  on-primary-fixed: '#001c39'
  on-primary-fixed-variant: '#004883'
  secondary-fixed: '#62fae3'
  secondary-fixed-dim: '#3cddc7'
  on-secondary-fixed: '#00201c'
  on-secondary-fixed-variant: '#005047'
  tertiary-fixed: '#ffdf9f'
  tertiary-fixed-dim: '#f9bd22'
  on-tertiary-fixed: '#261a00'
  on-tertiary-fixed-variant: '#5c4300'
  background: '#0b1326'
  on-background: '#dae2fd'
  surface-variant: '#2d3449'
  ai-accent: '#A78BFA'
  text-primary: '#F8FAFC'
  text-secondary: '#94A3B8'
  border-subtle: rgba(255, 255, 255, 0.08)
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
  h1-mobile:
    fontFamily: Inter
    fontSize: 22px
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
  container-max: 1200px
  gutter: 24px
---

## Brand & Style
The design system for the Career Intelligence Platform transitions into a **Sophisticated Dark Mode** that maintains a professional, grounded, and encouraging personality. The brand identity is re-centered around a "Command Center" aesthetic—clear, technical, and high-performance—tailored for focused career assessment and skill mapping.

The visual direction follows a **Corporate / Modern** style adapted for low-light environments. It utilizes deep navy and charcoal surfaces to reduce eye strain during long-form documentation, while employing vibrant, luminescent accents to guide the eye toward action. The UI evokes a sense of "Expertise" and "Clarity," transforming the university student’s career journey into a high-fidelity dashboard experience. AI elements are presented as "glow" layers, signifying intelligent assistance that illuminates the path forward.

## Colors
The color palette is optimized for dark-mode legibility and WCAG AA compliance on deep backgrounds.

- **Primary (Blue #60A5FA):** A lightened, more vibrant cerulean that "pops" against navy surfaces without causing vibration. Used for critical CTAs and active states.
- **Secondary (Teal #2DD4BF):** Used for "Success" states and verified competency markers. This minty teal provides high contrast against the dark base.
- **Tertiary (Amber #FBBF24):** A warm, sun-gold reserved for "In-Progress" activities and warnings requiring intervention.
- **AI Accent (Violet #A78BFA):** A desaturated lavender used exclusively for AI-generated insights, providing a distinct "mystical but technical" feel.
- **Neutral (Slate/Navy):** The core background uses `#0F172A` (Deep Navy), with higher levels of the interface using progressively lighter slate tones to indicate elevation.

## Typography
**Inter** remains the cornerstone of the system for its high x-height and readability in dark interfaces.

- **Hierarchy through Contrast:** Headings are rendered in pure high-contrast white (`#F8FAFC`) to command attention. Body text is shifted to a silver-gray (`#94A3B8`) to reduce glare and improve the reading experience for long-form content.
- **Labels:** Use the high-contrast white to ensure form headers and small indicators are immediately scannable.
- **Scaling:** On mobile, large display titles scale down to avoid awkward breaks, ensuring the interface remains "grounded" on smaller viewports.

## Layout & Spacing
The layout follows a **Fixed Grid** philosophy for desktop, centered to keep career data within a comfortable ocular range.

- **Grid Model:** 12-column system for desktop (max 1200px), 6-column for tablet, and a single-column fluid grid for mobile.
- **Spacing Rhythm:** Based on a 4px geometric scale. `md` (16px) is the standard for internal card padding, while `lg` (24px) creates necessary breathing room between major modules.
- **Mobile Adaptivity:** Sidebars collapse into persistent bottom bars or top-level navigation to maximize vertical space for competency lists.

## Elevation & Depth
In this dark-mode system, depth is conveyed through **Tonal Layers** and **Translucent Overlays** rather than traditional shadows.

- **Surface Tiers:** The `surface` (#0F172A) acts as the base canvas. Components like cards and panels use `surface-container` (#1E293B) to appear "closer" to the user.
- **Subtle Overlays:** Instead of heavy drop shadows, "raised" elements use a 1px inner border of `rgba(255,255,255,0.08)` to catch the light.
- **AI Elevation:** AI panels use a subtle background tint of the `ai-accent` color at 5-8% opacity and a thin violet border to indicate their unique status.
- **Borders:** Use low-contrast outlines to define structure without creating visual noise.

## Shapes
The shape language is **Rounded**, maintaining a balance between professional rigor and modern approachability.

- **Core Components:** 0.5rem (8px) is the default for cards, containers, and AI sections.
- **Precision Elements:** Buttons and input fields use a slightly tighter radius (6px) to signify "tools" and "actions."
- **Full Rounding:** Used for progress bar tracks and status chips to create a friendly, "active" visual language for growth tracking.

## Components

### Buttons
- **Primary:** Solid `primary_color` (#60A5FA) with dark text (`#0F172A`) for maximum contrast and "glow" effect.
- **Secondary:** Outlined with a 1px border of `primary_color` and primary-colored text.
- **AI Actions:** Buttons within AI modules use the `ai-accent` lavender for distinction.

### Status Badges & Chips
Small, capsule-shaped indicators.
- **Verified:** Dark teal background with vibrant teal text.
- **In-Progress:** Dark amber background with vibrant amber text.
- **Neutral:** Slate-gray background with white text.

### Competency Progress Bars
The track uses a deep slate-gray. The fill uses a horizontal gradient of the `primary_color`. For "Skill Gaps," the target level is marked with a vertical secondary-colored line.

### AI-Assisted Panels
These sections are clearly demarcated with a soft violet glow. They must include a "Generated by AI" label in the corner and use the `label-font` for disclaimer text.

### Inputs
Fields use `surface-container-high` as a background with a subtle border. On focus, the border transitions to the vibrant `primary_color` with a soft glow effect (2px outer ring).

### Evidence Cards
Rich cards utilize the `surface-container` color. They feature a 1px `border-subtle` to define their boundaries against the dark background, ensuring data density doesn't lead to visual confusion.