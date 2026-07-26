# ASIALAB OEM

## Mission

Create implementation-ready, token-driven UI guidance for ASIALAB OEM that is optimized for consistency, accessibility, and fast delivery across e-commerce storefront.

## Brand

- Product/brand: ASIALAB OEM
- URL: https://asialaboem.vn/
- Audience: online shoppers and consumers
- Product surface: e-commerce storefront

## Style Foundations

- Visual style: clean, functional, implementation-oriented
- Main font style: `font.family.primary=Montserrat_r`, `font.family.stack=Montserrat_r`, `font.size.base=15px`, `font.weight.base=400`, `font.lineHeight.base=22.5px`
- Typography scale: `font.size.xs=12px`, `font.size.sm=13px`, `font.size.md=14px`, `font.size.lg=15px`, `font.size.xl=18px`, `font.size.2xl=20px`, `font.size.3xl=38px`
- Color palette: `color.surface.base=#000000`, `color.text.secondary=#0d6efd`, `color.text.tertiary=#3f3f3f`, `color.text.inverse=#ffffff`, `color.surface.muted=#064584`, `color.surface.strong=#f4a512`
- Spacing scale: `space.1=5px`, `space.2=8px`, `space.3=10px`, `space.4=15px`, `space.5=16px`, `space.6=20px`, `space.7=25px`, `space.8=35px`
- Radius/shadow/motion tokens: `radius.xs=5px`, `radius.sm=10px`, `radius.md=30px`, `radius.lg=50px` | `motion.duration.instant=300ms`

## Accessibility

- Target: WCAG 2.2 AA
- Keyboard-first interactions required.
- Focus-visible rules required.
- Contrast constraints required.

## Writing Tone

Concise, confident, implementation-focused.

## Rules: Do

- Use semantic tokens, not raw hex values, in component guidance.
- Every component must define states for default, hover, focus-visible, active, disabled, loading, and error.
- Component behavior should specify responsive and edge-case handling.
- Interactive components must document keyboard, pointer, and touch behavior.
- Accessibility acceptance criteria must be testable in implementation.

## Rules: Don't

- Do not allow low-contrast text or hidden focus indicators.
- Do not introduce one-off spacing or typography exceptions.
- Do not use ambiguous labels or non-descriptive actions.
- Do not ship component guidance without explicit state rules.

## Guideline Authoring Workflow

1. Restate design intent in one sentence.
2. Define foundations and semantic tokens.
3. Define component anatomy, variants, interactions, and state behavior.
4. Add accessibility acceptance criteria with pass/fail checks.
5. Add anti-patterns, migration notes, and edge-case handling.
6. End with a QA checklist.

## Required Output Structure

- Context and goals.
- Design tokens and foundations.
- Component-level rules (anatomy, variants, states, responsive behavior).
- Accessibility requirements and testable acceptance criteria.
- Content and tone standards with examples.
- Anti-patterns and prohibited implementations.
- QA checklist.

## Component Rule Expectations

- Include keyboard, pointer, and touch behavior.
- Include spacing and typography token requirements.
- Include long-content, overflow, and empty-state handling.
- Include known page component density: links (375), lists (14), inputs (8), buttons (6), navigation (3), cards (1).

## Quality Gates

- Every non-negotiable rule must use "must".
- Every recommendation should use "should".
- Every accessibility rule must be testable in implementation.
- Teams should prefer system consistency over local visual exceptions.
