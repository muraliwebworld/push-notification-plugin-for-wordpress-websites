# assets/images

This directory contains static image assets for the **PNFPB (Push Notification for Post and BuddyPress)** WordPress plugin.

---

## hero-banner.svg

### What it is
A self-contained SVG hero banner designed for use on the plugin's README, WordPress.org plugin page, documentation site, or any marketing page. It visually communicates the plugin's flexible push-notification delivery options — Firebase, WebPush, OneSignal, Progressier, Mobile App, and Instant Delivery — in a professional, SaaS-style layout.

### Dimensions & Format
| Property  | Value                  |
|-----------|------------------------|
| Width     | 1200 px                |
| Height    | 500 px                 |
| Format    | SVG (scalable vector)  |
| File size | ~14 KB (no raster data)|

The SVG is fully scalable; it renders crisply at any size from a 600 × 250 thumbnail up to a full-resolution 2400 × 1000 display.

### Layout

| Zone         | Content                                                                 |
|--------------|-------------------------------------------------------------------------|
| **Left**     | Plugin badge, bold headline, subheading, decorative glow rule           |
| **Center**   | 2 × 3 icon card grid — Firebase, WebPush, OneSignal, Progressier, Mobile App, Instant Delivery |
| **Right**    | Stylised analytics dashboard panel with activity bars, notification feed, and floating bell badge |

### How to use

**In a Markdown README (GitHub / WordPress.org)**

```markdown
![PNFPB Hero Banner](assets/images/hero-banner.svg)
```

**Inline in HTML**

```html
<img src="assets/images/hero-banner.svg"
     alt="PNFPB Plugin — Flexible Push Notification Delivery"
     width="1200" height="500">
```

**Direct SVG embed (preserves glow filters)**

```html
<!-- paste the full contents of hero-banner.svg here -->
```

### Color Palette Reference

| Element                  | Color / Value                |
|--------------------------|------------------------------|
| Background gradient start | `#0f0c29`                   |
| Background gradient mid   | `#302b63`                   |
| Background gradient end   | `#24243e`                   |
| Headline text             | `#ffffff`                   |
| Subheading text           | `rgba(255,255,255,0.72)`     |
| Icon card background      | `rgba(255,255,255,0.07)`     |
| Icon card border          | `rgba(255,255,255,0.15)`     |
| Firebase accent           | `#FF6D00`                   |
| WebPush accent            | `#2196F3`                   |
| OneSignal accent          | `#E0284F`                   |
| Progressier accent        | `#00BFA5`                   |
| Mobile App accent         | `#7C4DFF`                   |
| Instant Delivery accent   | `#FFD600`                   |
| Glow accent               | `rgba(100,120,255,0.35)`    |
| Dashboard panel           | `rgba(255,255,255,0.05)`    |

### Implementation notes
- All gradients, glow filters, and shapes are defined in `<defs>` for clean reusability.
- `<feGaussianBlur>` filters are used for icon glows and background blobs — no external assets.
- The file is valid, well-commented SVG and requires no build step.
