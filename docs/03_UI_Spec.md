# 03 — UI/UX Design Specification

**Project:** Gaming Brand & Community Website  
**Document:** `docs/03_UI_Spec.md`  
**Version:** 3.0  
**Status:** Approved Visual Direction — Pending Final Implementation Review  
**Primary Language:** Bangla  
**Secondary Language:** English  
**Frontend:** Laravel Blade + Tailwind CSS + Alpine.js (lightweight interactions only)

---

# 1. Document Overview

This document defines the visual design system, user experience principles, page layouts, reusable UI components, responsive behavior, and frontend implementation guidelines for the Gaming Brand & Community Website.

It serves as the primary UI/UX reference for frontend development.

The design must follow the confirmed dark editorial gaming aesthetic inspired by the supplied DROPZONE visual reference and Gemini's design proposal.

**Important:** DROPZONE is a visual reference only. It is not the website's brand identity.

The website is a gaming community platform, not an account marketplace.

All public-facing features must follow the approved Product Requirements Document and application workflows.

# 2. Design Direction

## 2.1 Design Concept

**Dark Editorial Gaming Experience**

The interface should feel like a premium gaming and esports community platform.

The visual direction combines:

- Deep obsidian backgrounds.
- Charcoal content surfaces.
- Vibrant coral accents.
- Strong condensed display typography.
- Clean editorial content layouts.
- Large gaming imagery.
- Clear content hierarchy.
- Minimal decorative effects.
- Sharp, confident UI elements.

## 2.2 Design Principles

1. **Gaming Identity:** The website should immediately communicate gaming culture.
2. **Editorial Layout:** Content should be organized with strong visual hierarchy rather than excessive cards.
3. **Bold Typography:** Large headings and condensed English display typography should create visual character.
4. **Brand Consistency:** Coral should be used consistently for important actions and highlights.
5. **Trust and Safety:** Safety information must be clearly visible.
6. **Mobile First:** The interface must work well on commonly used mobile devices in Bangladesh.
7. **Content Focus:** Real community content should remain the visual focus.
8. **Performance:** Avoid unnecessary animations, heavy effects, and oversized assets.

# 3. Brand Identity

## 3.1 Brand Name

**Temporary Brand Name:** AKM MASUM

**Bangla Brand Description:** রকমারি গেমিং মার্কেটপ্লেস ও কমিউনিটি must not be used. The approved product identity is a gaming community platform.

The temporary brand name should be replaced if the creator supplies a different final gaming name.

## 3.2 Logo

Temporary logo direction:

- Skewed square container.
- Coral background.
- Dark-colored letter or custom glyph.
- Simple and recognizable shape.
- Suitable for header, footer, favicon, and mobile navigation.

The actual creator-provided logo must replace the temporary mark when available.

## 3.3 Branding Configuration

Brand details should be easy to replace without modifying individual page layouts.

Recommended configuration:

- Brand name.
- Logo.
- Favicon.
- Brand description.
- Social media links.
- Copyright text.

Avoid hardcoding temporary branding in every Blade template.

# 4. Color System

Use the following color palette consistently.

| Design Token | Color | HEX / Value | Usage |
|---|---|---|---|
| Primary Background | Dark Obsidian | `#101114` | Main page background |
| Surface | Charcoal Panel | `#1c1e23` | Cards, panels, modals |
| Soft Surface | Dark Muted | `#17191d` | Alternate sections, drawers |
| Primary Accent | Coral Orange | `#ff593d` | Primary buttons, highlights |
| Accent Hover | Bright Coral | `#ff795f` | Hover and active interactions |
| Primary Text | Off White | `#f5f2ed` | Headings and body text |
| Muted Text | Ash Grey | `#a2a3a6` | Secondary text and metadata |
| Border | Subtle Line | `rgba(255,255,255,0.11)` | Borders and separators |
| Success | Soft Green | `#9de26c` | Online and success indicators |
| Warning | Amber | `#eab85b` | Warnings and pending states |
| Danger | Red | `#ef6464` | Errors and destructive actions |

## 4.1 Color Usage Rules

- Coral is the primary brand accent.
- Do not use coral for every element.
- Large backgrounds must remain dark and restrained.
- Use green only for online/success indicators.
- Use amber for pending review and warning states.
- Use red for destructive or error states.
- Maintain sufficient contrast for text and controls.
- Avoid unnecessary gradients, glow effects, and neon borders.

# 5. Typography System

## 5.1 Font Families

### English Display Headings

**Font:** Barlow Condensed

Weights:
- 600
- 700
- 800
- 900

Usage:
- Hero headings.
- Section titles.
- English labels.
- Large numerical highlights.
- Editorial display text.

### English Body Text

**Font:** DM Sans

Weights:
- 400
- 500
- 600
- 700

Usage:
- Descriptions.
- Navigation.
- Buttons.
- Form fields.
- Metadata.
- Dashboard content.

### Bangla Text

**Font:** Hind Siliguri

Weights:
- 400
- 500
- 600
- 700

Usage:
- Bangla headings.
- Descriptions.
- Navigation.
- Content titles.
- Safety messages.
- Forms and dashboard labels.

## 5.2 Typography Rules

- Bangla must be the default public-facing language.
- English is the secondary language.
- Do not force English uppercase typography onto Bangla text.
- Use suitable line heights for Bengali characters.
- Use Barlow Condensed for English display headings only.
- Use Hind Siliguri for Bangla display and body content.
- Avoid excessively small text on mobile.
- Use consistent font weights throughout the application.

# 6. Layout and Container System

## 6.1 Main Container

- Maximum width: `1240px`.
- Center horizontally.
- Desktop horizontal padding: `24px`.
- Mobile horizontal padding: `16px`.

## 6.2 Grid System

Use CSS Grid and Flexbox.

Recommended layouts:

- Homepage editorial sections: 2–3 columns depending on content.
- Community content: 3-column desktop grid.
- Moderator directory: 2-column desktop layout where appropriate.
- Admin dashboard: sidebar + main content.
- Mobile: single-column layouts.

## 6.3 Spacing Scale

Use a consistent 4px-based spacing system.

| Token | Value |
|---|---:|
| 1 | 4px |
| 2 | 8px |
| 3 | 12px |
| 4 | 16px |
| 5 | 20px |
| 6 | 24px |
| 8 | 32px |
| 10 | 40px |
| 12 | 48px |
| 16 | 64px |
| 20 | 80px |
| 24 | 96px |

Large homepage sections should generally use 80–100px vertical spacing on desktop and 48–64px on mobile.

# 7. Responsive Breakpoints

| Device | Width |
|---|---|
| Small Mobile | Below 560px |
| Tablet | 560px–1023px |
| Desktop | 1024px and above |

## 7.1 Mobile Requirements

- Header navigation collapses into a mobile menu.
- Buttons must be touch-friendly.
- Cards stack vertically.
- Images must maintain appropriate aspect ratios.
- Typography scales down naturally.
- Tables must have a usable mobile presentation.
- No horizontal overflow.
- Dashboard sidebar becomes a drawer or collapsible navigation.
- Forms must fit narrow screens.

# 8. Navigation Design

## 8.1 Public Header

The header should include:

- Brand logo.
- Brand name.
- Home.
- Community.
- Moderators.
- About.
- Safety.
- Language switcher.
- Contact action.

Suggested Bangla navigation:

| English Meaning | Bangla Label |
|---|---|
| Home | হোম |
| Community | কমিউনিটি |
| Moderators | মডারেটর |
| About | আমাদের সম্পর্কে |
| Safety | নিরাপত্তা |
| Contact | যোগাযোগ |

Do not include Marketplace, Post Listing, Buy Account, or Sell Account navigation.

## 8.2 Header Appearance

- Approximate desktop height: 78px.
- Mobile height: 68px.
- Dark translucent background.
- Subtle bottom border.
- Logo and brand aligned left.
- Navigation aligned centrally or right.
- Primary contact action aligned right.
- Mobile menu uses a dark slide-down panel.

## 8.3 Management Header

Management pages may use a separate compact header and sidebar.

The public website's visual identity should still remain recognizable.

# 9. Homepage Design

The homepage is the primary public entry point.

It should introduce the creator, explain the community, highlight current content, introduce moderators, and communicate safety information.

## 9.1 Homepage Section Order

1. Header.
2. Hero section.
3. Community announcement / safety notice.
4. Featured community content.
5. Latest gaming updates.
6. Moderator introduction.
7. About the community.
8. Safety information.
9. Contact call-to-action.
10. Footer.

## 9.2 Hero Section

Purpose: Immediately communicate the gaming brand and community identity.

Elements:

- Large gaming background artwork.
- Brand or community introduction.
- Strong display heading.
- Short Bangla description.
- Primary community CTA.
- Secondary About CTA.
- Optional small English editorial label.

Suggested Bangla heading:

"গেমিং শুধু খেলা নয়, এটি একটি কমিউনিটি।"

Suggested supporting text:

"গেমিংয়ের নতুন অভিজ্ঞতা, মজার মুহূর্ত, টিপস এবং গেমারদের সঙ্গে সংযুক্ত থাকার একটি নিজস্ব প্ল্যাটফর্ম।"

Design:

- Large image area.
- Dark overlay for readability.
- Left-aligned content on desktop.
- Bottom-aligned hero content where appropriate.
- Stack content naturally on mobile.

## 9.3 Safety Announcement

A prominent warning or information banner should appear near the top of the homepage.

Example:

"অনলাইনে অপরিচিত কাউকে ব্যক্তিগত তথ্য, পাসওয়ার্ড বা OTP দেবেন না। যেকোনো সন্দেহজনক কার্যক্রম সম্পর্কে সতর্ক থাকুন।"

Design:

- Charcoal surface.
- Coral or amber accent border.
- Clear heading.
- Short description.
- Link to the safety page.

## 9.4 Featured Community Content

Display selected published community content.

Examples:

- Gameplay highlights.
- Gaming tips.
- Community videos.
- Tournament updates.
- Creator announcements.
- Community guides.

Card elements:

- Thumbnail.
- Content category.
- Title.
- Short description.
- Publication date.
- Read more link.

Only approved and published content can appear.

## 9.5 Latest Gaming Updates

Display the newest approved community content.

Use a consistent editorial grid with image-led cards.

Desktop:
- Three-column grid where appropriate.

Tablet:
- Two-column grid.

Mobile:
- Single-column list or compact card layout.

## 9.6 Moderator Introduction

Display selected Moderator profiles.

Each profile preview may include:

- Avatar.
- Display name.
- Role.
- Online/offline indicator.
- Available/Busy status.
- Public content count.
- Profile link.

Online/offline and Available/Busy must be visually distinct.

## 9.7 About Section

Introduce the community's purpose and identity.

Use:

- Large supporting image.
- Editorial heading.
- Bangla description.
- CTA to About page.

## 9.8 Safety Information

Show clear safety principles.

Suggested subjects:

- Protect passwords and OTPs.
- Avoid suspicious links.
- Never share confidential login details.
- Report suspicious activity.
- Follow official platform guidance.

## 9.9 Contact Section

Provide permitted community contact channels.

Use a clear CTA without introducing account-sale or transaction functionality.

# 10. Public Page Designs

## 10.1 Community Content Index

Purpose: Browse published community content.

Elements:

- Page heading.
- Category filters.
- Search field if approved.
- Featured content.
- Content grid.
- Pagination.
- Empty state.

Only approved and published content is displayed.

## 10.2 Content Detail Page

Elements:

- Content title.
- Category.
- Author / Moderator information.
- Publication date.
- Featured image or media.
- Full content.
- Related community content.
- Moderator profile link where appropriate.

Do not show private content, unpublished revisions, internal review notes, or administrative information.

## 10.3 Moderator Directory

Elements:

- Page heading.
- Moderator introduction.
- Moderator profile cards or rows.
- Online/offline status.
- Available/Busy status.
- Public content count.
- Profile link.

## 10.4 Moderator Detail Page

Elements:

- Profile image.
- Display name.
- Moderator role.
- Online/offline status.
- Available/Busy status.
- Biography.
- Permitted public contact details.
- Published community content.

## 10.5 About Page

Elements:

- Community introduction.
- Brand story.
- Mission.
- Community principles.
- Relevant creator imagery.

## 10.6 Safety Page

Elements:

- Security guidance.
- Scam-awareness information.
- Account protection guidance.
- Reporting instructions.
- Official platform resource links when appropriate.

## 10.7 Contact Page

Elements:

- Community contact information.
- Permitted social media links.
- Contact instructions.
- Contact form only if approved in the requirements.

# 11. Management Panel Design

The management interface should share the public brand's dark visual identity but prioritize usability and information clarity.

## 11.1 Management Login

Elements:

- Brand logo.
- Login heading.
- Email or username field.
- Password field.
- Show/hide password.
- Submit button.
- Validation errors.

The login page must be clean and focused.

## 11.2 Admin Dashboard

Recommended elements:

- Total Moderators.
- Active Moderators.
- Total Community Content.
- Published Content.
- Pending Review Count.
- Recent Activity.
- Pending Review Queue.
- Quick management actions.

Dashboard numbers must be calculated from actual application data.

## 11.3 Moderator Dashboard

Recommended elements:

- Welcome message.
- Profile summary.
- Online/offline status.
- Available/Busy control.
- Total owned content.
- Draft count.
- Pending Review count.
- Changes Requested count.
- Published content count.
- Recent content activity.

Moderators must not see administrative controls.

## 11.4 Sidebar Navigation

Admin:

- Dashboard.
- Content Management.
- Content Review.
- Moderator Management.
- Announcements.
- Scam Alerts.
- Activity Logs.
- Settings.

Moderator:

- Dashboard.
- My Content.
- Create Content.
- Profile.
- Availability.

## 11.5 Content Management

Content table/list should include:

- Thumbnail.
- Title.
- Category.
- Owner.
- Publication status.
- Updated date.
- Actions.

Use readable status badges.

## 11.6 Admin Content Review

Admin must have a dedicated review interface.

Elements:

- Pending content list.
- Content preview.
- Submitted by.
- Submission date.
- Full content review.
- Approve and Publish action.
- Request Changes action.
- Feedback field.
- Review history where available.

Admin review actions must be explicit and require confirmation when appropriate.

## 11.7 Moderator Content Editor

Elements:

- Title.
- Category.
- Short description.
- Main content.
- Featured image.
- Save Draft.
- Submit for Review.
- Current review status.
- Admin feedback when changes are requested.

Moderators must not have a direct Publish button.

## 11.8 Moderator Management

Admin can:

- Create Moderator accounts.
- Edit Moderator profiles.
- Suspend accounts.
- Reactivate accounts.
- Deactivate accounts.
- View permitted Moderator information.

## 11.9 Profile and Availability

Moderator profile management should support:

- Profile image.
- Display name.
- Biography.
- Permitted contact information.
- Available/Busy setting.

Online/offline status is system-generated and must not be manually editable.

## 11.10 Activity Logs

Admin can view important system activities.

Examples:

- Login and logout.
- Content creation.
- Content edits.
- Content submission.
- Content approval.
- Change requests.
- Moderator account actions.
- Availability changes.

Never display passwords, tokens, or other secrets in activity logs.

# 12. Content Publishing States

The UI must support the following content states:

| State | Visual Meaning | Visibility |
|---|---|---|
| Draft | Neutral grey | Private |
| Pending Review | Amber | Private |
| Changes Requested | Red/orange | Private |
| Published | Green or coral-accented | Public |
| Unpublished | Grey | Private |
| Archived | Muted grey | Private |

Soft deletion is a separate data-management concern.

## 12.1 Moderator Workflow

1. Create content.
2. Save as Draft or submit for review.
3. View Pending Review status.
4. Receive Admin feedback if changes are requested.
5. Update and resubmit content.
6. Wait for approval before public publication.

Editing published Moderator content must trigger the review process again.

## 12.2 Admin Workflow

1. Open Content Review.
2. Select a pending submission.
3. Preview content.
4. Approve and Publish or Request Changes.
5. Provide feedback when changes are requested.
6. Record the action in activity logs.

# 13. Reusable UI Components

Build reusable Blade components for consistency.

Recommended components:

- Header.
- Footer.
- Logo.
- Navigation link.
- Primary button.
- Outline button.
- Status badge.
- Content card.
- Featured content card.
- Moderator card.
- Moderator row.
- Announcement banner.
- Safety notice.
- Pagination.
- Form input.
- Textarea.
- Empty state.
- Loading skeleton.
- Confirmation dialog.

Components should accept appropriate data through properties rather than hardcoding content.

# 14. Buttons and Interaction States

## 14.1 Primary Button

- Coral background.
- Dark text.
- Strong readable weight.
- Sharp or slightly rounded geometry.
- Clear hover state.

## 14.2 Secondary Button

- Transparent or dark surface.
- Subtle border.
- Light text.
- Coral border or text on hover.

## 14.3 Interaction

- Hover transitions: approximately 0.2s–0.3s.
- Focus: visible 2px coral outline with sufficient offset.
- Disabled controls must look disabled.
- Loading controls must communicate progress.
- Destructive actions require confirmation where appropriate.

Avoid excessive transforms or animations.

# 15. Forms and Validation

Forms should use:

- Dark charcoal backgrounds.
- Subtle borders.
- Off-white text.
- Coral focus border.
- Clear field labels.
- Helpful descriptions.
- Inline validation errors.
- Required-field indicators.

Error states should use red borders and readable error messages.

Success states should be clearly communicated.

# 16. Loading, Empty, and Error States

## 16.1 Loading

Use subtle skeleton placeholders for:

- Community content.
- Moderator lists.
- Dashboard statistics.
- Profile information.

## 16.2 Empty State

Example:

"এখনো কোনো কনটেন্ট প্রকাশিত হয়নি।"

Use a short explanation and a relevant navigation link.

## 16.3 Error State

Display helpful messages for:

- Page not found.
- Network or server errors.
- Unauthorized access.
- Validation failures.
- Missing content.

Do not expose technical exceptions or sensitive details to visitors.

# 17. Moderator Status Design

Two independent status concepts must be displayed.

## 17.1 Online / Offline

System-derived.

- Online: soft green indicator.
- Offline: muted grey indicator.

## 17.2 Available / Busy

Manually controlled by the Moderator.

- Available: green or clearly labeled positive state.
- Busy: amber or muted warning state.

Never rely on color alone. Always include readable labels.

Example:

- Online · Available
- Online · Busy
- Offline · Available
- Offline · Busy

# 18. Accessibility

Follow WCAG 2.2 AA principles where applicable.

Requirements:

- Sufficient text contrast.
- Semantic HTML.
- Keyboard navigation.
- Visible focus indicators.
- Accessible mobile navigation.
- Proper form labels.
- Descriptive image alt text.
- Clear error messages.
- Buttons and links with understandable labels.
- Status indicators that do not rely on color alone.
- Respect reduced-motion preferences.

Do not claim that all color combinations automatically meet WCAG AA. Verify actual text and background combinations during implementation.

# 19. Image and Asset Guidelines

Use:

- Actual creator-provided branding assets.
- Original gaming artwork where available.
- Community-provided images with permission.
- Optimized image formats such as WebP or AVIF.
- Responsive image sizes.
- Lazy loading for below-the-fold images.

Temporary placeholders may use appropriate royalty-free or licensed images.

Every meaningful image must include descriptive alt text.

Avoid:

- Repeated generic stock gaming images.
- Watermarked assets.
- Unlicensed creator artwork.
- Oversized hero images.
- Images that reduce text readability.

# 20. Animation and Motion

Use restrained interactions.

Recommended:

- 0.2s–0.4s hover transitions.
- Subtle card image scaling.
- Smooth mobile navigation.
- Skeleton loading animations.
- Small button interaction feedback.

Avoid:

- Excessive glowing effects.
- Large animated gradients.
- Constant movement.
- Unnecessary parallax.
- Heavy video backgrounds.

Respect `prefers-reduced-motion`.

# 21. Bangla and English Language Rules

Bangla is the primary language.

English is the secondary language.

Requirements:

- Use Bangla for default navigation and public descriptions.
- Use Hind Siliguri for Bangla.
- Use DM Sans for English body text.
- Use Barlow Condensed for English display headings.
- Keep numerical values readable.
- Do not mix languages unnecessarily.
- Ensure both language versions maintain consistent layouts.
- Provide a clear language switcher.

The management panel should also support the agreed language strategy where practical.

# 22. Laravel Blade Implementation Guidelines

Use Laravel Blade and Tailwind CSS.

Alpine.js may be used for lightweight client-side interactions.

Recommended structure:

```text
resources/
└── views/
    ├── layouts/
    │   ├── public.blade.php
    │   └── admin.blade.php
    ├── components/
    │   ├── header.blade.php
    │   ├── footer.blade.php
    │   ├── logo.blade.php
    │   ├── content-card.blade.php
    │   ├── moderator-card.blade.php
    │   ├── status-badge.blade.php
    │   ├── announcement.blade.php
    │   └── pagination.blade.php
    ├── public/
    │   ├── home.blade.php
    │   ├── content/
    │   ├── moderators/
    │   ├── about.blade.php
    │   ├── safety.blade.php
    │   └── contact.blade.php
    └── admin/
        ├── dashboard.blade.php
        ├── content/
        ├── moderators/
        ├── announcements/
        ├── activity-logs/
        └── settings/
```

Actual folder structure may be adjusted to match the final application architecture.

## 22.1 Implementation Rules

- Use Blade layouts for shared structure.
- Use reusable Blade components.
- Keep application logic out of presentation templates.
- Use named routes.
- Use Tailwind utility classes consistently.
- Use Alpine.js only when necessary.
- Do not introduce React or Vue without explicit approval.
- Do not hardcode dynamic database content.
- Use server-side authorization for all protected actions.
- Do not expose private content in public templates.

# 23. Performance Requirements

- Optimize images.
- Use lazy loading below the fold.
- Avoid unnecessary JavaScript.
- Keep CSS and JS assets organized.
- Use pagination for large content lists.
- Avoid unnecessary database requests.
- Prevent N+1 queries through appropriate eager loading.
- Use caching for appropriate public data.
- Avoid heavy animations on low-end devices.

# 24. UI Acceptance Criteria

The interface is accepted when:

1. The visual design follows the approved dark editorial gaming direction.
2. The color palette matches the defined Obsidian and Coral system.
3. Barlow Condensed, DM Sans, and Hind Siliguri are applied appropriately.
4. Bangla is the default public-facing language.
5. English language switching works.
6. Homepage sections follow the approved content hierarchy.
7. Public pages use consistent layouts and reusable components.
8. Moderator status indicators are clear and distinct.
9. Admin review workflow is represented correctly.
10. Moderators cannot see publishing controls they are not authorized to use.
11. All public content is approved and published.
12. Marketplace and transaction functionality is absent.
13. Mobile, tablet, and desktop layouts work correctly.
14. Keyboard focus and accessible interaction states are present.
15. No major console errors or broken navigation remain.
16. Temporary branding can be replaced without redesigning the application.

# 25. Explicitly Excluded UI Features

The following are not part of the approved project scope:

- Free Fire account marketplace.
- Account sale or purchase listings.
- Account-transfer detail pages.
- Account prices or seller information.
- Buy Account or Sell Account actions.
- Escrow or transaction interfaces.
- Payment gateway interfaces for account transfers.
- bKash, Nagad, or Rocket transaction integration.
- Trade history and successful trade counters.
- Account-sale WhatsApp contact actions.

The public content system is for legitimate community and gaming-related publishing only.

# 26. Final Design Reference

The approved design direction is:

**Dark Editorial Gaming — Obsidian + Coral**

Visual reference principles:

- Deep dark surfaces.
- Coral accents.
- Condensed English headings.
- Clean Bangla typography.
- Strong editorial image layouts.
- Bold but restrained visual identity.
- Responsive mobile-first navigation.
- Minimal decorative effects.

The DROPZONE framework is only a visual inspiration reference. It must never appear as the project's brand.

The temporary AKM MASUM identity must be replaced if the creator supplies a different final name or logo.

---

# 27. Document Status

**Version:** 3.0  
**Visual Direction:** Approved  
**Product Scope:** Community-only  
**Primary Language:** Bangla  
**Frontend Direction:** Laravel Blade + Tailwind CSS + Alpine.js (lightweight interactions only)  
**Next Step:** Implement the approved homepage HTML and obtain final visual approval before building the remaining public pages.