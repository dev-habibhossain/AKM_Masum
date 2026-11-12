# Product Requirements Document (PRD)

## Gaming Brand & Community Platform

**Document Version:** 1.1  
**Status:** Draft — Pending Review  
**Primary Language:** Bangla  
**Secondary Language:** English  
**Backend:** Laravel  
**Frontend:** Blade, Tailwind CSS, Alpine.js  
**Database:** MySQL

---

## 1. Project Overview

The project is a professional gaming brand and community website for a Free Fire gaming creator.

The platform will provide visitors with a central place to explore the gaming brand, view moderator profiles, discover permitted gaming content, and contact moderators for general inquiries.

The website will also include a secure administration system where the owner can manage moderators, content, announcements, platform settings, and activity.

The website will be publicly accessible without requiring visitors to register or log in.

### 1.1 Branding

The website will use the existing branding supplied by the owner.

The owner will provide:
- Gaming name / brand name
- Logo
- Brand identity and visual references
- Profile and promotional assets

The design must be built around the supplied branding rather than introducing an unrelated visual identity.

---

## 2. Project Goals

- Establish a professional online presence for the gaming brand.
- Provide an organized public gaming content directory.
- Display moderator profiles and their current activity status.
- Allow visitors to discover moderators and their published content.
- Provide a secure dashboard for administrators and moderators.
- Make content management simple and organized.
- Support Bangla and English.
- Build a responsive, fast, secure, and maintainable platform.

---

## 3. Target Users

### 3.1 Public Visitor

Visitors can:
- Browse the homepage.
- View public gaming content.
- Browse all moderators.
- View individual moderator profiles.
- See moderator online/offline and available/busy status.
- View the number of available published items associated with each moderator.
- Switch between Bangla and English.
- Contact the brand through permitted contact channels.

Visitors do not need an account.

### 3.2 Moderator

Moderators can:
- Log in to their dashboard.
- View their own dashboard statistics.
- Create and manage permitted content.
- Edit their own content.
- Update their availability status.
- View their own activity history.
- Manage their profile information within permitted fields.
- Log out securely.

Moderators must not access another moderator's private dashboard data or manage another moderator's content.

### 3.3 Admin

The administrator has full platform management access.

Admin can:
- Manage moderators.
- Create, edit, suspend, and deactivate moderator accounts.
- Manage public content.
- Manage homepage content and announcements.
- Publish and manage scam-awareness alerts.
- View platform statistics.
- Monitor moderator activity.
- View activity logs.
- Manage website settings.
- Manage language and content settings.

---

## 4. Website Structure

### Public Website

1. Home Page
2. IDs / Content Page
3. Content Details Page
4. Moderators Page
5. Moderator Details Page
6. About / Brand Information Page
7. Contact Page
8. Scam Awareness / Safety Information

### Admin & Moderator Panel

1. Login
2. Dashboard
3. Content Management
4. Moderator Management (Admin only)
5. Profile Management
6. Activity Logs
7. Announcements / Scam Alerts
8. Website Settings (Admin only)

---

## 5. Functional Requirements

### 5.1 Homepage

The homepage will introduce the gaming brand and provide quick access to important website sections.

Required sections:
- Hero section with gaming branding.
- Brand introduction.
- Featured public content.
- Featured moderators.
- Moderator availability overview.
- Scam-awareness notice.
- YouTube or social media links.
- Contact section.
- Footer with navigation and social links.

The homepage must prioritize clear navigation and strong visual presentation.

### 5.2 IDs / Public Content Page

A dedicated page will display the public content published by moderators.

The page should support:
- Grid-based content listing.
- Content thumbnails or screenshots.
- Content title.
- Relevant descriptions.
- Associated moderator.
- Published status.
- Search and filtering where applicable.
- Responsive layout.

**Important compliance restriction:**

The proposed Free Fire account/ID marketplace, including account-sale listings, prices intended for account transfers, purchase buttons, and contact flows designed to arrange account transfers, is not approved for implementation at this stage.

These features must remain documented as pending compliance approval. They must not be activated in the MVP without confirmation that the proposed activity is permitted under applicable platform rules and has the required authorization.

The public content architecture may support other permitted gaming-related content.

### 5.3 Content Details Page

Each permitted public content item may have an individual details page.

It can include:
- Main image or screenshot.
- Title.
- Description.
- Additional images.
- Associated moderator.
- Publication information.
- Related content.

Account-transfer details and purchase/contact functionality remain excluded pending compliance approval.

### 5.4 Moderators Page

This page will display all active public moderator profiles.

Each moderator card must display:

- Profile image.
- Gaming name.
- Online / Offline status.
- Available / Busy status.
- Available published content count.
- View Profile button.

**Status definitions:**

- Online: Moderator is currently active in the authenticated system.
- Offline: Moderator is not currently active.
- Available: Moderator has manually indicated that they are available.
- Busy: Moderator has manually indicated that they are busy.

Online status and availability status are separate values and must not be treated as interchangeable.

The available content count must be calculated from the moderator's published content that is currently marked as available. It must not be hardcoded.

### 5.5 Moderator Details Page

Each moderator will have a public profile details page.

The page will have two main sections.

**A. Moderator Profile Section — Top**

- Profile image.
- Gaming name.
- Online / Offline status.
- Available / Busy status.
- Short biography.
- Public contact information, where permitted.
- Message Moderator button for permitted general inquiries.

**B. Moderator Content Section — Below**

Display all permitted public content belonging to that moderator.

Each content card may show:
- Thumbnail or screenshot.
- Title.
- Short description.
- Publication status.
- View Details button.

The page must only display public content assigned to the selected moderator.

### 5.6 Moderator Profile and Content Relationship

- Every content item must be associated with its responsible moderator.
- A moderator can manage their own permitted content.
- Admin can manage all content.
- Content must not appear publicly unless it is approved/published.
- Deactivated moderators must not appear as active public moderators.
- The system must correctly update content counts when content is published, archived, deleted, or its availability changes.

### 5.7 Contact and Communication

The website may provide permitted general inquiry channels.

Potential contact options:
- Brand WhatsApp contact.
- General contact page.
- Moderator contact information for permitted inquiries.

Any WhatsApp button or communication flow designed to facilitate prohibited account transfers is excluded pending compliance approval.

### 5.8 Scam Awareness and Safety

The homepage and relevant public pages should include safety information.

Admin can:
- Create scam-awareness notices.
- Edit notices.
- Publish or unpublish notices.
- Mark important notices as featured.

The design should make important warnings noticeable without overwhelming the rest of the website.

---

## 6. Moderator Dashboard Requirements

### 6.1 Dashboard Overview

Each moderator should see:
- Total content created.
- Published content count.
- Available content count.
- Archived content count.
- Current online/offline status.
- Current availability status.
- Recent activity.

### 6.2 Content Management

Moderators can:
- Create permitted content.
- Upload images.
- Edit their own content.
- Publish or unpublish content where authorized.
- Change permitted content status.
- Archive or delete their own content.

All uploaded files must be validated for file type and size.

### 6.3 Availability Management

Moderators can manually update their status:

- Available
- Busy

This status must update on the public website.

The online/offline status is system-controlled and must not be manually set by moderators.

### 6.4 Access Restrictions

Moderators must only access their own assigned records.

All permissions must be enforced on the server side using Laravel authorization, policies, and middleware where appropriate.

---

## 7. Admin Dashboard Requirements

### 7.1 Dashboard Overview

Admin dashboard should display:
- Total moderators.
- Active moderators.
- Online moderators.
- Offline moderators.
- Total published content.
- Available content count.
- Archived content count.
- Recent moderator activities.

### 7.2 Moderator Management

Admin can:
- Create moderator accounts.
- Edit moderator information.
- Suspend accounts.
- Reactivate accounts.
- Deactivate accounts.
- View individual moderator profiles.
- View moderator content.
- Monitor moderator activity.

### 7.3 Content Management

Admin can:
- View all content.
- Create content.
- Edit content.
- Publish or unpublish content.
- Archive content.
- Delete content.
- Assign content to moderators.
- Review content before publication, if moderation approval is enabled.

### 7.4 Website Management

Admin can manage:
- Homepage sections.
- Brand information.
- Social links.
- Scam-awareness notices.
- Public announcements.
- Contact information.
- Website settings.

### 7.5 Activity Monitoring

Admin can view:
- Moderator login/logout events.
- Content creation.
- Content updates.
- Content publication changes.
- Content deletion or archival.
- Availability status changes.
- Administrative actions.

Sensitive information such as passwords, authentication tokens, and private credentials must never be recorded in activity logs.

---

## 8. Real-Time Status System

The website should provide accurate moderator presence information.

### Online / Offline

The system should determine presence from authenticated activity and a heartbeat or presence mechanism.

A moderator should become offline after the configured inactivity timeout or when the authenticated session is no longer considered active.

### Available / Busy

This is a manually controlled status.

Moderators can change it from their dashboard.

### Public Updates

The following information should update without requiring a full page refresh where practical:
- Online/offline status.
- Available/busy status.
- Available published content count.

Laravel Reverb and Laravel broadcasting may be used for real-time updates, subject to technical evaluation.

---

## 9. Language Requirements

The website will support two languages.

**Primary:** Bangla  
**Secondary:** English

Requirements:
- Bangla is the default language.
- Visitors can switch to English.
- Public pages must support both languages.
- Admin-managed content should support translated fields where needed.
- Navigation, labels, buttons, validation messages, and system notifications should be translatable.
- The selected language should persist during navigation.

---

## 10. Non-Functional Requirements

### Performance
- Fast page loading.
- Optimized images.
- Efficient database queries.
- Pagination for large content lists.
- Caching where appropriate.

### Security
- Secure authentication.
- Server-side authorization.
- CSRF protection.
- Input validation.
- Secure file uploads.
- Rate limiting for sensitive endpoints.
- Protection against common web vulnerabilities.
- Secure session management.

### Responsive Design
The website must work correctly on:
- Mobile phones.
- Tablets.
- Laptops.
- Desktop screens.

### Maintainability
- Clean Laravel architecture.
- Reusable Blade components.
- Organized controllers and services.
- Consistent naming conventions.
- Proper validation and error handling.

### Accessibility
- Readable typography.
- Sufficient color contrast.
- Keyboard-accessible controls.
- Clear status indicators that do not rely on color alone.

---

## 11. Scope Definition

### MVP Scope

The first release should include:

- Public homepage.
- Bangla and English language support.
- IDs / permitted public content directory.
- Content details pages for permitted content.
- Moderators directory.
- Moderator cards with online/offline status.
- Moderator cards with available/busy status.
- Available published content counts.
- Moderator details pages.
- Moderator dashboard.
- Admin dashboard.
- Moderator account management.
- Content management.
- Scam-awareness notices.
- Activity logs.
- Responsive design.
- Secure authentication and authorization.

### Pending Compliance Approval

The following proposed features must remain disabled until their legality and authorization are verified:

- Free Fire account/ID marketplace.
- Listings intended to sell or transfer game accounts.
- Account prices and purchase workflows.
- Buy buttons for account transfers.
- WhatsApp redirects intended to arrange account transfers.
- Any payment, escrow, or transaction workflow for account transfers.

### Future Enhancements

Possible future additions:
- Advanced analytics.
- More detailed moderator performance reports.
- Notification system.
- Featured content management.
- Advanced search and filtering.
- Public content reporting.
- More detailed audit and moderation tools.

---

## 12. Business Rules

1. Public visitors do not need an account.
2. Only Admin and Moderator roles can authenticate.
3. Admin has full management permissions.
4. Moderators can manage only their own assigned content.
5. Only published and permitted content is visible publicly.
6. Online/offline status is system-controlled.
7. Available/busy status is moderator-controlled.
8. Available content counts must be calculated dynamically.
9. Every content item must have an associated moderator.
10. Deactivated moderators cannot access the dashboard.
11. Important administrative and moderator actions must be logged.
12. Account-trading functionality cannot be enabled without compliance approval.

---

## 13. Acceptance Criteria

The MVP will be considered ready for release when:

- Visitors can browse the public website without logging in.
- Visitors can view the public content directory.
- Visitors can open individual permitted content details.
- Visitors can view all active public moderators.
- Moderator cards show accurate online/offline status.
- Moderator cards show available/busy status.
- Moderator cards display dynamically calculated available content counts.
- Visitors can open individual moderator details pages.
- Moderator details pages show profile information at the top and that moderator's public content below.
- Moderators can securely log in.
- Moderators can manage only their own content.
- Admin can manage moderators and all public content.
- Activity logs record important actions.
- Bangla and English work correctly.
- The website is responsive across supported screen sizes.
- Security and authorization tests pass.
- Compliance-restricted account-trading functionality remains disabled.

---

## 14. Assumptions and Open Questions

The following details will be confirmed before implementation:

- Final gaming brand name.
- Logo and brand assets.
- Brand color palette.
- Moderator profile information.
- Moderator WhatsApp/contact information for permitted inquiries.
- Social media and YouTube links.
- Final public content categories.
- Whether content publication requires Admin approval.
- Online status timeout duration.
- Image upload limits.
- Hosting and deployment environment.

---

## 15. Documentation and Change Management

This PRD is the primary source of product requirements.

Any changes to features, permissions, business rules, or scope must be reflected in the documentation before implementation.

The remaining project documents will define:

1. Application Flow.
2. UI/UX Specification.
3. Technical Requirements.
4. Database Schema.
5. Implementation Plan.
6. Testing Plan.
7. Decision Log.

No development should begin until the core requirements and design direction have been reviewed and approved.

**End of Document — PRD v1.1**