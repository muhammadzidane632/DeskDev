---
name: Kinetic Paper
colors:
  surface: '#fef7ff'
  surface-dim: '#dfd7e6'
  surface-bright: '#fef7ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f9f1ff'
  surface-container: '#f3ebfa'
  surface-container-high: '#ede5f4'
  surface-container-highest: '#e8dfee'
  on-surface: '#1d1a24'
  on-surface-variant: '#4a4455'
  inverse-surface: '#332f39'
  inverse-on-surface: '#f6eefc'
  outline: '#7b7487'
  outline-variant: '#ccc3d8'
  surface-tint: '#732ee4'
  primary: '#630ed4'
  on-primary: '#ffffff'
  primary-container: '#7c3aed'
  on-primary-container: '#ede0ff'
  inverse-primary: '#d2bbff'
  secondary: '#735c00'
  on-secondary: '#ffffff'
  secondary-container: '#fed01b'
  on-secondary-container: '#6f5900'
  tertiary: '#005b3d'
  on-tertiary: '#ffffff'
  tertiary-container: '#007650'
  on-tertiary-container: '#76ffc2'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#eaddff'
  primary-fixed-dim: '#d2bbff'
  on-primary-fixed: '#25005a'
  on-primary-fixed-variant: '#5a00c6'
  secondary-fixed: '#ffe083'
  secondary-fixed-dim: '#eec200'
  on-secondary-fixed: '#231b00'
  on-secondary-fixed-variant: '#574500'
  tertiary-fixed: '#6ffbbe'
  tertiary-fixed-dim: '#4edea3'
  on-tertiary-fixed: '#002113'
  on-tertiary-fixed-variant: '#005236'
  background: '#fef7ff'
  on-background: '#1d1a24'
  surface-variant: '#e8dfee'
typography:
  display:
    fontFamily: Space Grotesk
    fontSize: 64px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.04em
  h1:
    fontFamily: Space Grotesk
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.03em
  h2:
    fontFamily: Space Grotesk
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
    letterSpacing: -0.02em
  h3:
    fontFamily: Space Grotesk
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.4'
    letterSpacing: -0.01em
  body-lg:
    fontFamily: Space Grotesk
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
    letterSpacing: 0em
  body-md:
    fontFamily: Space Grotesk
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
    letterSpacing: 0em
  label-bold:
    fontFamily: Space Grotesk
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Space Grotesk
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1.2'
    letterSpacing: 0.04em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 8px
  sm: 16px
  md: 24px
  lg: 40px
  xl: 64px
  gutter: 24px
  margin: 32px
---

## Brand & Style

This design system expresses a "Playful Neobrutalism" aesthetic, balancing the raw, structural honesty of brutalism with the refined precision of high-end SaaS. The brand personality is intellectually curious, energetic, and meticulously organized. It targets creative professionals who require a workspace that feels both like a blank canvas and a powerful engine.

The visual style utilizes a "soft paper" foundation to reduce eye strain, contrasted against aggressive, pitch-black structural elements. It avoids the coldness of traditional corporate UI by injecting vibrant pops of color and tactile physics. The emotional goal is to evoke the feeling of high-quality stationery brought to life through digital motion.

## Colors

The palette is anchored by **Vibrant Violet**, used for primary actions and brand emphasis. **Sunny Yellow** serves as a high-energy secondary color for warnings, highlights, or secondary calls to action. **Mint** (#10B981) provides a fresh tertiary balance for success states and creative tools, while **Soft Lavender** acts as a subtle background tint for grouped elements or active states.

The background uses a "Soft Paper" neutral (#FAFAFA) to maintain a premium, breathable feel. All structural elements—borders and hard shadows—must use absolute black (#000000) to maintain the neobrutalist edge.

## Typography

This design system relies exclusively on **Space Grotesk** to bridge the gap between technical utility and artistic expression. 

Key typographic principles:
- **Kinetic Layouts:** Use extreme scale shifts between display heads and body copy to create a sense of movement.
- **Tight Kerning:** Headlines should use negative letter spacing to feel like "blocks" of text.
- **Lowercase Emphasis:** For labels and small UI elements, consider using sentence case or all-lowercase to lean into the approachable "Notion-like" vibe.

## Layout & Spacing

The layout philosophy follows a **Modular Grid System** that feels structured yet flexible. It uses a 12-column fluid grid for page-level layouts, but switches to a 4px-baseline "freeform" grid for internal canvas elements (similar to Miro).

Spacing is intentionally generous ("breathable") to prevent the heavy borders from feeling claustrophobic. Use 32px or 40px margins for containers to allow the "soft paper" background to act as a frame for the content.

## Elevation & Depth

In this design system, depth is communicated through **Physical Offsets** rather than light-source simulation. 

- **Hard Shadows:** Use pitch-black (#000000) shadows with 0px blur. 
- **Offsets:** A standard element sits at a 4px x 4px offset. High-priority elements (hover states or modals) increase to an 8px x 8px offset.
- **The "Pressed" State:** When an element is clicked, the offset returns to 0px, mimicking a physical button being pushed into the paper.
- **Dot Grid:** Use a 24px-interval dot grid in #E5E5E5 on the #FAFAFA background to provide a sense of scale and ground the floating elements.

## Shapes

The "Superellipse" is the core geometric motif. While the `roundedness` is set to 2 (0.5rem base), the corners should be rendered using a high-curvature continuity (Squircle) where possible to achieve an "Ultra-premium" feel.

All containers must have a solid black border. Use **2px** for standard components (cards, inputs) and **3px** for primary structural blocks or emphasized buttons.

## Components

### Buttons
Primary buttons use a **Vibrant Violet** fill, white text, and a 3px black border with a 4px hard shadow. On hover, the shadow increases to 6px; on active, the button moves to (0,0) and the shadow disappears.

### Cards
Cards are white (#FFFFFF) with 2px black borders. They should utilize the soft lavender accent for internal headers or metadata chips to keep the layout feeling "organized" but "fun."

### Input Fields
Inputs are rectangular with superellipse corners, 2px borders, and use a 2px hard shadow even in their resting state. The focus state swaps the shadow color from black to Vibrant Violet.

### Chips & Tags
Use Sunny Yellow or Mint fills with black borders. These should have a smaller corner radius than cards (0.25rem) to differentiate them as metadata.

### Canvas Elements
To mimic "Miro," creative canvas items should be draggable and use "Active-Handle" styling: small 8px black circles at the corners of the superellipse border during selection.