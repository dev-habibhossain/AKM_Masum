# 04 — Technical Requirements Document (TRD)

**Project:** Gaming Creator Community Website  
**Document:** Technical Requirements Document  
**Version:** 1.0  
**Status:** Draft — Pending Technical Review  
**Related Documents:** `01_PRD.md`, `02_App_Flow.md`, `03_UI_Spec.md`

---

## 1. Purpose

This document defines the technical architecture, technology stack, application structure, backend responsibilities, security requirements, database approach, and deployment strategy for the gaming creator community website.

The implementation must follow the approved PRD, App Flow, and UI/UX Design Specification v2.0.

The application should be maintainable, secure, responsive, and straightforward to extend without introducing unnecessary complexity.

### 1.1 Technical objectives

- Build the application using Laravel.
- Use server-rendered pages for the public website and management panel.
- Keep the architecture modular and maintainable.
- Enforce authentication and authorization on the server.
- Support Bangla as the primary language and English as the secondary language.
- Provide reliable moderator presence and availability indicators.
- Support secure content publishing and moderation.
- Maintain an activity history for important management actions.
- Keep the application ready for future features without overengineering the MVP.

---

## 2. Technology Stack

The following stack is proposed for the MVP. Exact framework and package versions must be checked for compatibility when development begins.

| Area | Technology | Purpose |
|---|---|---|
| Backend | PHP 8.3+ | Server-side programming |
| Framework | Latest compatible stable Laravel release | Application foundation |
| Frontend | Blade | Server-rendered views |
| Styling | Tailwind CSS | UI styling and responsive layouts |
| Lightweight interaction | Alpine.js | Menus, toggles, dialogs, and small interactions |
| Database | MySQL 8.0+ | Persistent application data |
| Authentication | Laravel authentication | Admin and moderator login |
| Authorization | Laravel Policies and Gates | Role and resource permissions |
| Build tooling | Vite | Asset compilation |
| Realtime (optional) | Laravel Reverb and Laravel Echo | Live presence updates |
| Cache | Laravel Cache | Frequently accessed data |
| Queue | Laravel Queue | Background jobs when needed |
| File storage | Laravel Filesystem | Uploaded images and media |
| Testing | Pest or PHPUnit | Automated testing |
| Version control | Git | Source control |
| Deployment | Linux server with Nginx and PHP-FPM | Production hosting |

### 2.1 Frontend restrictions

- Use Blade, HTML, Tailwind CSS, and Alpine.js for the initial implementation.
- Do not introduce React, Vue, Inertia.js, or a separate frontend application unless the project requirements change and the decision is approved.
- Do not use JavaScript for security-sensitive authorization.
- Keep JavaScript limited to interface interactions and necessary asynchronous updates.

### 2.2 Package policy

Before installing a third-party package:

1. Confirm that Laravel does not already provide the required functionality.
2. Check package maintenance, compatibility, documentation, and security history.
3. Avoid packages that introduce unnecessary dependencies.
4. Record important package decisions in `08_Decision_Log.md`.

---

## 3. Application Architecture

### 3.1 Architecture style

Use a **modular monolithic architecture**.

The application will be one Laravel project with clearly separated responsibilities. A microservice architecture is not required for this project.

Main application areas:

1. Public Website
2. Authentication
3. Admin Management
4. Moderator Management
5. Content Management
6. Scam Awareness and Announcements
7. Presence and Availability
8. Activity Logging
9. Localization
10. Application Settings

### 3.2 Request lifecycle

A typical request should follow this flow:

1. Browser sends an HTTP request.
2. Laravel routes the request.
3. Middleware handles authentication, session, and access restrictions.
4. Controller validates the request and coordinates the operation.
5. Policies and authorization checks verify permissions.
6. Service classes handle business operations when the logic is sufficiently complex.
7. Models interact with the database.
8. Laravel returns a Blade view or an appropriate response.

Controllers must not become large collections of business logic. Keep validation, authorization, data access, and business operations clearly organized.

### 3.3 Architecture principles

- Prefer Laravel conventions over custom frameworks.
- Use dependency injection where appropriate.
- Use Form Request classes for complex or reusable validation.
- Use Eloquent relationships instead of unnecessary raw SQL.
- Use database transactions for operations that require multiple related database changes.
- Use pagination for potentially large public and management lists.
- Avoid duplicated business logic across controllers.
- Do not create unnecessary repositories, interfaces, or service classes for simple CRUD operations.

---

## 4. Application Modules

### 4.1 Public Website

Responsibilities:

- Render the homepage.
- Display published public content.
- Display public content details.
- Display the moderator directory.
- Display moderator profile pages.
- Display announcements and scam-awareness information.
- Support language switching.
- Display public contact and social links.

Public visitors must not need an account to browse permitted public pages.

### 4.2 Authentication

Only Admin and Moderator accounts can authenticate.

Requirements:

- Login and logout.
- Secure password hashing.
- Session regeneration after successful login.
- Session invalidation on logout.
- Rate limiting for login attempts.
- Password reset flow for authorized management accounts, if enabled.
- Account status checks on authenticated requests.

There must be no public registration page.

### 4.3 Admin Management

Admin responsibilities:

- View dashboard statistics.
- Create and manage moderator accounts.
- Suspend, deactivate, or reactivate moderator accounts.
- View and manage all permitted content.
- Review and publish submitted content.
- Manage scam-awareness notices and announcements.
- View activity logs.
- Manage general website settings.

Admin access must be enforced through server-side authorization.

### 4.4 Moderator Management

Moderator responsibilities:

- View their own dashboard.
- Create and manage their own permitted content.
- Edit or remove their own content according to the content workflow.
- Update their profile information.
- Set their availability to Available or Busy.
- View relevant content status and activity information.

A moderator must not access another moderator's private management data or modify another moderator's content unless an explicit permission is granted by an authorized Admin.

### 4.5 Content Management

The content module manages legitimate gaming-related public material.

Potential content fields:

- Title
- Slug
- Description
- Thumbnail or cover image
- Content category
- Owner moderator
- Publication status
- Visibility
- Featured flag
- Creation date
- Updated date
- Publication date

Suggested content statuses:

| Status | Meaning |
|---|---|
| Draft | Saved but not submitted or published |
| Pending Review | Waiting for Admin review |
| Published | Approved and publicly visible |
| Unpublished | Removed from public display |
| Archived | Retained for historical reference |
| Deleted | Removed or soft-deleted according to retention rules |

Only content that is approved, published, and public should appear on public pages.

**Compliance restriction:** Do not implement Free Fire account or ID sale listings, account-transfer purchase actions, transfer pricing, payment or escrow features, or WhatsApp flows that facilitate account transfers unless the required platform authorization and legal compliance have been verified. The content module must initially be used for permitted gaming-related content only.

### 4.6 Scam Awareness and Announcements

Admin should be able to:

- Create notices.
- Edit existing notices.
- Publish or unpublish notices.
- Set notice priority.
- Set optional start and end dates.
- Display important notices on the homepage.

The public website should clearly distinguish general announcements from urgent safety warnings.

### 4.7 Presence and Availability

Presence and availability are separate concepts.

**Online / Offline**
- Derived from authenticated moderator activity.
- Not manually selected by moderators.
- A moderator is considered online while their valid activity heartbeat is recent.
- A configurable timeout determines when the moderator becomes offline.

**Available / Busy**
- Manually selected by the moderator.
- Stored in the database.
- Does not automatically change when the moderator goes offline.

Suggested initial rule:

- Heartbeat interval: approximately 60 seconds.
- Online timeout: approximately 2–3 minutes.
- Exact values should be configurable and tested.

The system must not display a moderator as online indefinitely after closing the browser or losing connectivity.

#### Initial implementation approach

Start with a lightweight heartbeat mechanism:

1. Authenticated moderator pages periodically send a heartbeat.
2. Laravel records the latest activity timestamp.
3. The presence service determines online/offline status using the configured timeout.
4. Public pages display the derived status.

Laravel Reverb and broadcasting may be introduced if genuine real-time updates are required. Do not add WebSockets before validating that polling is insufficient for the MVP.

### 4.8 Activity Logging

Record important actions, including:

- Successful login and logout.
- Content creation, update, publication, unpublishing, and deletion.
- Moderator profile changes.
- Availability changes.
- Moderator suspension and reactivation.
- Admin setting changes.
- Scam notice creation and publication.

Each activity record should contain, where applicable:

- Actor ID.
- Action name.
- Target entity type and ID.
- Short description.
- Timestamp.
- IP address, subject to the site's privacy policy.
- Relevant non-sensitive metadata.

Never store passwords, session tokens, API secrets, or other authentication credentials in activity logs.

---

## 5. Database Requirements

### 5.1 Database engine

Use MySQL as the primary relational database.

Use InnoDB tables and appropriate foreign keys and indexes.

All timestamps should be stored consistently, preferably in UTC, and displayed using the configured application timezone.

### 5.2 Proposed database entities

The following is an initial logical entity list. The final columns, constraints, indexes, and relationships will be defined in `05_Database_Schema.md`.

| Entity | Responsibility |
|---|---|
| users | Admin and moderator authentication |
| moderator_profiles | Public moderator information |
| content_categories | Content classification |
| contents | Permitted gaming-related content |
| content_media | Content images and media metadata |
| announcements | Public announcements and safety notices |
| activity_logs | Management audit history |
| settings | Application configuration |
| password_reset_tokens | Password reset support, if enabled |
| sessions | Database-backed sessions, if selected |

### 5.3 Database rules

- Use primary keys and foreign keys consistently.
- Add indexes to frequently filtered and joined columns.
- Use unique constraints for usernames, emails, and slugs where appropriate.
- Use soft deletes only where recovery or historical retention is required.
- Prevent orphaned records.
- Use transactions for multi-step database operations.
- Avoid storing values that can be safely derived from existing data.

### 5.4 Moderator content count

The public moderator directory should show each moderator's public content count.

Count only records that meet all of these conditions:

- The content belongs to that moderator.
- The content is published.
- The content is public.
- The content is permitted under the platform's compliance requirements.

Do not count drafts, pending reviews, unpublished items, archived items, or deleted items.

---

## 6. Routing and Controller Structure

Use named routes and organize public and management routes separately.

Proposed route groups:

| Route group | Access |
|---|---|
| `/` | Public |
| `/content` | Public |
| `/content/{slug}` | Public |
| `/moderators` | Public |
| `/moderators/{username}` | Public |
| `/about` | Public |
| `/contact` | Public |
| `/login` | Guest management users |
| `/admin/*` | Admin |
| `/moderator/*` | Moderator |

The exact route names and URL structure may be adjusted during implementation.

### 6.1 Suggested controller organization

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Public/
│   │   ├── Auth/
│   │   ├── Admin/
│   │   └── Moderator/
│   ├── Middleware/
│   └── Requests/
├── Models/
├── Policies/
├── Services/
└── Support/
```

Controllers should be grouped by application responsibility. Avoid placing all public, admin, and moderator actions in one controller.

---

## 7. Authorization and Access Control

### 7.1 Roles

The MVP has two management roles:

- Admin
- Moderator

A role must be stored and verified on the server.

### 7.2 Authorization rules

| Action | Visitor | Moderator | Admin |
|---|---:|---:|---:|
| Browse public pages | Yes | Yes | Yes |
| View published public content | Yes | Yes | Yes |
| Log in to management panel | No | Yes | Yes |
| Manage own content | No | Yes | Yes |
| Manage another moderator's content | No | No | Yes |
| Change own availability | No | Yes | Yes |
| Manage moderator accounts | No | No | Yes |
| Manage announcements | No | No | Yes |
| View all activity logs | No | No | Yes |
| Manage application settings | No | No | Yes |

### 7.3 Account status

Moderator accounts should support at least:

- Active
- Suspended
- Deactivated

Suspended and deactivated accounts must be denied management access even if an old authenticated session still exists.

Account status must be checked on protected requests, not only during login.

### 7.4 Ownership enforcement

A moderator must only modify content they own.

Use Laravel Policies or equivalent server-side authorization checks for view, update, delete, and publication-related actions.

Never trust a moderator ID supplied by the browser without checking ownership.

---

## 8. Validation and Error Handling

### 8.1 Validation

Validate all user-submitted data on the server.

Validation should cover:

- Required fields.
- Text length.
- Slug uniqueness.
- Allowed file types.
- File size.
- Image dimensions where appropriate.
- Valid status values.
- Valid language values.
- Ownership and authorization.
- Safe URL formats for permitted external links.

### 8.2 Error handling

Provide clear and user-friendly error responses for:

- Validation failures.
- Unauthorized access.
- Unauthenticated requests.
- Missing content.
- Suspended accounts.
- Upload failures.
- Unexpected server errors.

Production errors must not expose stack traces, SQL queries, file paths, credentials, or other internal implementation details.

---

## 9. File and Media Management

Use Laravel Filesystem for uploads.

Requirements:

- Store uploaded files outside executable application code.
- Validate file type and size on the server.
- Generate safe filenames rather than trusting original filenames.
- Restrict uploads to approved image formats for the MVP.
- Prevent executable file uploads.
- Use controlled storage paths.
- Provide a clear fallback when an image is missing.
- Delete unused files when their associated content is permanently removed, according to retention rules.

Use the configured storage disk consistently so local development and production can use different storage providers without changing business logic.

---

## 10. Localization

The primary language is Bangla. English is the secondary language.

Requirements:

- Use Laravel localization files for interface text.
- Provide a language switcher.
- Store the selected language in session or an appropriate user preference.
- Use Bengali-capable fonts in the frontend.
- Ensure both languages fit the approved UI layouts.
- Avoid hardcoding interface text inside controllers.
- Keep user-generated content language handling separate from interface localization.

The default language should be Bangla unless the project owner approves a different default.

---

## 11. Security Requirements

Security is a core requirement.

### 11.1 Authentication security

- Hash passwords using Laravel's supported password hashing.
- Apply login rate limiting.
- Regenerate sessions after authentication.
- Invalidate sessions on logout.
- Protect management routes with authentication middleware.
- Apply CSRF protection to state-changing web forms.
- Never expose password hashes or sensitive account fields in public responses.

### 11.2 Application security

- Use Laravel's query builder and Eloquent safely.
- Escape user-generated content in Blade by default.
- Avoid rendering untrusted HTML.
- Validate and authorize every state-changing request.
- Protect file uploads.
- Use secure production cookies and HTTPS.
- Keep application secrets in environment variables.
- Do not commit `.env` or production credentials to Git.
- Keep dependencies updated.
- Use least-privilege database credentials.

### 11.3 Operational security

- Set `APP_DEBUG=false` in production.
- Restrict access to logs and backups.
- Back up the database regularly.
- Keep Laravel and PHP security updates current.
- Review dependencies before production deployment.

---

## 12. Performance and Scalability

The MVP should be optimized for a small-to-medium community website.

Requirements:

- Use pagination for public content and management lists.
- Avoid N+1 database queries through appropriate eager loading.
- Index frequently queried columns.
- Cache stable public data where beneficial.
- Optimize uploaded images.
- Use lazy loading for below-the-fold images.
- Compile and minify production assets.
- Avoid loading unnecessary JavaScript libraries.
- Use queues for operations that become slow or resource-intensive.

Do not introduce Redis, complex search infrastructure, or distributed services unless measured requirements justify them.

---

## 13. UI Implementation Requirements

The implementation must follow `03_UI_Spec.md` v2.0.

Key rules:

- Preserve the approved Brand-led Gaming Editorial direction.
- Use the creator's real logo, name, colors, and supplied artwork when available.
- Avoid generic neon gaming templates and excessive glow effects.
- Maintain consistent typography, spacing, and layout.
- Use responsive layouts for mobile, tablet, and desktop.
- Provide visible keyboard focus states.
- Use semantic HTML.
- Ensure accessible form labels and error messages.
- Use appropriate contrast for text and controls.
- Keep loading, empty, success, and error states consistent.

The current homepage prototype is a design baseline, not a reason to hardcode the final branding or content.

UI changes remain allowed when required by actual content, usability, accessibility, or implementation findings. Record significant design changes in the decision log.

---

## 14. Testing Requirements

Testing must cover both expected behavior and access restrictions.

### 14.1 Feature tests

- Public visitors can access permitted public pages.
- Public visitors cannot access management routes.
- Admin can manage moderator accounts.
- Moderator can manage their own content.
- Moderator cannot modify another moderator's content.
- Suspended and deactivated accounts cannot access management routes.
- Only published and public content appears publicly.
- Content counts exclude non-public and non-published content.
- Availability changes are saved correctly.
- Online status expires after the configured timeout.
- Language switching works.
- Unauthorized requests are rejected.

### 14.2 Security tests

- Login rate limiting works.
- CSRF protection is enabled.
- Invalid file uploads are rejected.
- Unauthorized record IDs cannot bypass ownership checks.
- User-generated text is safely escaped.
- Sensitive information is not included in public responses or activity logs.

### 14.3 UI tests

Test key pages at:

- Mobile width.
- Tablet width.
- Desktop width.

Check navigation, forms, status labels, content cards, empty states, and language switching.

Detailed test cases will be defined in `07_Testing_Plan.md`.

---

## 15. Deployment and Environment

### 15.1 Environments

Maintain separate environments:

- Local development
- Staging/testing
- Production

Production credentials and data must never be copied into public repositories.

### 15.2 Production requirements

- Linux server.
- Nginx.
- Compatible PHP-FPM version.
- MySQL.
- Composer dependencies installed for production.
- Vite production assets.
- HTTPS certificate.
- Correct storage and cache permissions.
- Laravel scheduler configured if scheduled tasks are used.
- Queue worker configured if background jobs are used.
- Automated database backup process.

### 15.3 Deployment checklist

1. Pull the approved application version.
2. Install production dependencies.
3. Configure environment variables.
4. Build frontend assets.
5. Run database migrations after backup and review.
6. Create or verify the storage link.
7. Clear and rebuild Laravel caches as appropriate.
8. Confirm file and directory permissions.
9. Verify login and authorization.
10. Verify public pages and uploads.
11. Verify logs and backup operation.

Deployment must be repeatable and documented.

---

## 16. Development Standards

- Use clear, descriptive names for classes, methods, variables, and database columns.
- Follow PSR-12 and Laravel conventions.
- Keep controllers focused.
- Use migrations for database changes.
- Use seeders for development/demo data.
- Use factories for automated tests.
- Never use production data as test fixtures.
- Commit changes in small, understandable units.
- Do not commit generated secrets or local environment files.
- Document important technical decisions.
- Review authorization whenever a new management feature is added.

### 16.1 AI-assisted development rules

AI-generated code must be reviewed before acceptance.

For every implementation task:

1. Read the relevant project documentation.
2. Identify the affected modules and files.
3. Explain the planned approach before large structural changes.
4. Implement only the approved scope.
5. Follow existing conventions.
6. Run relevant tests.
7. Review security and authorization.
8. Summarize changed files and remaining issues.

Do not allow an AI coding agent to redesign approved UI, change the stack, add unrelated features, or modify business rules without approval.

---

## 17. MVP Technical Scope

### Included

- Laravel application foundation.
- Public website.
- Bangla and English interface.
- Admin and Moderator authentication.
- Server-side role and ownership authorization.
- Moderator profiles.
- Content management for permitted gaming-related material.
- Admin review and publishing workflow.
- Public moderator directory and details pages.
- Online/offline presence using heartbeat.
- Manually controlled Available/Busy status.
- Announcements and scam-awareness notices.
- Activity logs.
- Responsive UI.
- Automated tests for important business rules.
- Production deployment configuration.

### Excluded from the MVP

- Public visitor registration.
- Customer accounts and customer dashboards.
- Payment processing.
- Escrow or transaction management.
- Account trading or account-transfer marketplace functionality.
- Account-transfer purchase buttons or sale-related WhatsApp flows.
- Separate React or Vue frontend.
- Microservices.
- Complex analytics infrastructure.
- Mobile applications.

Account-transfer and sale-related functionality remains excluded unless compliance is independently verified and the project scope is formally revised.

---

## 18. Technical Risks and Mitigation

| Risk | Mitigation |
|---|---|
| Unauthorized moderator access | Server-side middleware and policies |
| Moderator editing another user's content | Ownership checks and policy tests |
| Stale online status | Heartbeat and configurable timeout |
| Large image uploads | File validation and image optimization |
| Slow public pages | Eager loading, pagination, and selective caching |
| Dependency incompatibility | Verify versions before installation |
| Scope expansion | Follow approved MVP and decision log |
| Platform policy concerns | Keep restricted account-transfer features out of scope |
| UI inconsistency | Follow the approved UI specification and shared components |

---

## 19. Technical Decisions Pending Confirmation

The following decisions should be finalized before or during the relevant implementation stage.

| Decision | Proposed default | Status |
|---|---|---|
| Laravel version | Latest compatible stable release | Verify at setup |
| Database | MySQL | Proposed |
| Frontend | Blade + Tailwind CSS + Alpine.js | Proposed |
| Authentication | Laravel-based Admin/Moderator authentication | Proposed |
| Role implementation | Simple role field with policies, unless complexity requires a package | Proposed |
| Presence | Heartbeat polling first | Proposed |
| Realtime updates | Laravel Reverb only if justified | Deferred |
| Cache | Laravel cache; start with database/file driver as appropriate | Proposed |
| Queue | Add when background jobs are needed | Deferred |
| Media storage | Laravel local storage initially | Proposed |
| Deployment | Linux + Nginx + PHP-FPM | Proposed |

Any change to these decisions should be recorded in `08_Decision_Log.md`.

---

## 20. Definition of Technical Readiness

The project is technically ready to proceed to database design when:

- The architecture is approved.
- The stack is confirmed.
- Authentication and role boundaries are understood.
- Content ownership and publication rules are clear.
- Presence and availability behavior is defined.
- Restricted account-transfer functionality remains excluded.
- Database entities can be derived from the agreed business rules.
- No unresolved technical decision blocks the database schema.

---

## 21. Next Document

After this TRD is reviewed and approved, prepare:

**`05_Database_Schema.md` — Database Schema and Relationship Design**

It will define:

- Tables and columns.
- Data types.
- Primary and foreign keys.
- Relationships.
- Indexes and unique constraints.
- Enums or status values.
- Soft-delete and retention rules.
- ER diagram.
- Example records and migration considerations.

**Document status:** Draft — Pending Technical Review.