# 07 — Testing Plan

**Project:** Gaming Brand & Community Website  
**Document Version:** 1.0  
**Status:** Draft — Pending Review  
**Related Documents:** PRD v1.1, App Flow v1.0, UI/UX Specification v2.0, TRD v1.0, Database Schema v1.0, Implementation Plan v1.0

---

## 1. Purpose

This document defines the testing strategy for the website.

The goal is to ensure that the application is functional, secure, responsive, maintainable, and consistent with the approved project requirements.

Testing must happen throughout development rather than only at the end.

## 2. Testing Objectives

The project must be tested to verify that:

- Public visitors can access permitted public pages without authentication.
- Admin and Moderator accounts have the correct access permissions.
- Moderators can manage only their own permitted content.
- Admins can manage moderators and website content.
- Online/offline presence and Available/Busy states work correctly.
- Content publication and visibility rules are enforced.
- Bangla and English language switching works correctly.
- The website works on desktop, tablet, and mobile devices.
- Sensitive information is protected.
- Important actions are recorded in activity logs.
- No restricted account-trading or transfer functionality is exposed.

## 3. Testing Strategy

The project will use the following testing levels.

### 3.1 Unit Testing

Test individual classes, methods, and business rules independently.

Examples:

- Content publication eligibility.
- Content ownership checks.
- Moderator availability updates.
- Moderator account status validation.
- Public content count calculation.
- Activity log creation.
- Input validation rules.

### 3.2 Feature Testing

Test complete application features through HTTP requests and database interactions.

Examples:

- Admin login.
- Moderator login.
- Content creation and publication.
- Moderator profile updates.
- Announcement management.
- Public moderator directory.
- Public content listing.
- Language switching.

### 3.3 Integration Testing

Verify that related application components work together.

Examples:

- Authentication with authorization.
- Content publication with public visibility.
- Moderator presence with directory status.
- Content ownership with update/delete operations.
- Activity logging with administrative actions.

### 3.4 Manual UI Testing

Manually inspect the website in a browser.

Check:

- Visual consistency with the approved UI specification.
- Navigation and interactive elements.
- Mobile menu behavior.
- Form usability.
- Empty, loading, and error states.
- Bangla typography and text wrapping.
- Image rendering and responsive layouts.

### 3.5 Security Testing

Test authentication, authorization, validation, session handling, and protection against common web vulnerabilities.

Security testing must not be limited to hiding unauthorized buttons in the interface.

## 4. Functional Test Cases

### 4.1 Public Website

| ID | Test | Expected Result |
|---|---|---|
| PUB-01 | Open homepage without login | Homepage loads |
| PUB-02 | Open public content page | Only permitted public content appears |
| PUB-03 | Open content details | Correct content details appear |
| PUB-04 | Open moderator directory | Public moderator profiles appear |
| PUB-05 | Open moderator details | Correct profile and permitted content appear |
| PUB-06 | Open About page | Page loads correctly |
| PUB-07 | Open Contact page | Permitted contact information appears |
| PUB-08 | Switch to Bangla | Bangla content and labels appear |
| PUB-09 | Switch to English | English content and labels appear |
| PUB-10 | Open an invalid content URL | Appropriate not-found response appears |

### 4.2 Authentication

| ID | Test | Expected Result |
|---|---|---|
| AUTH-01 | Login with valid Admin credentials | Admin dashboard opens |
| AUTH-02 | Login with valid Moderator credentials | Moderator dashboard opens |
| AUTH-03 | Login with incorrect credentials | Login fails safely |
| AUTH-04 | Open dashboard without login | Redirect to login |
| AUTH-05 | Logout | Session is invalidated |
| AUTH-06 | Access dashboard after logout | Access is denied |
| AUTH-07 | Login as suspended Moderator | Access is denied |
| AUTH-08 | Login as deactivated Moderator | Access is denied |

### 4.3 Moderator Management

| ID | Test | Expected Result |
|---|---|---|
| MOD-01 | Admin creates Moderator | Account is created |
| MOD-02 | Admin edits Moderator profile | Changes are saved |
| MOD-03 | Admin suspends Moderator | Moderator cannot access protected features |
| MOD-04 | Admin reactivates Moderator | Access follows account status and authentication rules |
| MOD-05 | Moderator edits own profile | Permitted changes are saved |
| MOD-06 | Moderator attempts to edit another profile | Request is denied |
| MOD-07 | Public visits Moderator details | Only public profile information appears |

### 4.4 Content Management

| ID | Test | Expected Result |
|---|---|---|
| CNT-01 | Moderator creates content | Content is saved under that Moderator |
| CNT-02 | Moderator edits own content | Changes are saved |
| CNT-03 | Moderator edits another Moderator's content | Request is denied |
| CNT-04 | Moderator deletes own content | Deletion follows the defined lifecycle |
| CNT-05 | Admin reviews content | Admin can perform authorized review actions |
| CNT-06 | Draft content is opened publicly | Content is not publicly accessible |
| CNT-07 | Unpublished content is opened publicly | Content is not publicly accessible |
| CNT-08 | Published permitted content is opened | Content is visible |
| CNT-09 | Content is archived | Content is excluded from normal public listings |
| CNT-10 | Content is deleted | Deleted content is not publicly accessible |

**Important:** These tests apply only to permitted gaming-related content. Account sale, transfer, purchase, or related transaction features are outside the approved scope.

### 4.5 Moderator Presence and Availability

| ID | Test | Expected Result |
|---|---|---|
| PRE-01 | Authenticated Moderator is active | Presence is reported as online |
| PRE-02 | Moderator stops sending heartbeat | Presence eventually becomes offline |
| PRE-03 | Moderator logs out | Presence is cleared or expires |
| PRE-04 | Moderator changes availability to Busy | Busy status is displayed |
| PRE-05 | Moderator changes availability to Available | Available status is displayed |
| PRE-06 | Moderator becomes offline while Available | Offline and Available remain separate concepts |
| PRE-07 | Suspended Moderator attempts to update status | Request is denied |

Online/offline is system-derived. Available/Busy is manually controlled. They must not be treated as the same status.

### 4.6 Announcements and Scam Alerts

| ID | Test | Expected Result |
|---|---|---|
| ANN-01 | Admin creates announcement | Announcement is saved |
| ANN-02 | Admin publishes announcement | Public announcement appears |
| ANN-03 | Admin unpublishes announcement | Public announcement disappears |
| ANN-04 | Admin creates scam alert | Alert is saved |
| ANN-05 | Public opens scam-awareness section | Published safety information appears |
| ANN-06 | Unauthorized Moderator attempts admin-only action | Request is denied |

### 4.7 Activity Logs

| ID | Test | Expected Result |
|---|---|---|
| LOG-01 | Admin logs in | Login event is recorded |
| LOG-02 | Moderator creates content | Content creation event is recorded |
| LOG-03 | Moderator changes availability | Status change is recorded |
| LOG-04 | Admin suspends a Moderator | Administrative action is recorded |
| LOG-05 | Unauthorized action is attempted | Security-relevant event is handled according to logging policy |
| LOG-06 | Inspect activity log | Sensitive credentials and tokens are not exposed |

## 5. Authorization and Security Test Cases

The following cases are mandatory:

- A visitor cannot access management routes.
- A Moderator cannot access Admin-only routes.
- A Moderator cannot modify another Moderator's content by changing a URL or request parameter.
- A suspended or deactivated account cannot continue using protected management features.
- CSRF protection is enabled for applicable state-changing requests.
- Server-side validation is applied to user input.
- File uploads are validated for permitted types, size, and storage rules.
- Passwords are securely hashed.
- Sensitive configuration values are not exposed in source control or public responses.
- Session handling follows secure configuration.
- Mass assignment is controlled through explicit validation and model configuration.
- Public responses do not expose private user fields.
- Rate limiting is applied to authentication and other appropriate sensitive endpoints.

The test suite should include direct HTTP requests, not only browser navigation.

## 6. Database and Data Integrity Testing

Verify:

- Foreign key constraints work.
- Unique constraints prevent duplicate records where required.
- Required fields cannot be stored as invalid null values.
- Content ownership is preserved.
- Deleting or suspending a Moderator follows the approved relationship rules.
- Soft-deleted records do not appear in public queries.
- Transactions protect operations that require multiple database writes.
- Public content counts match the actual publication and availability rules.
- Database migrations work on a clean database.

## 7. Responsive and Accessibility Testing

Test at representative viewport sizes:

| Device | Target Width |
|---|---:|
| Small mobile | 320–375px |
| Standard mobile | 390–430px |
| Tablet | 768px |
| Laptop | 1024–1440px |
| Large desktop | 1600px and above |

Check:

- No horizontal overflow.
- Navigation works on mobile.
- Buttons and links are usable with touch.
- Text remains readable.
- Images scale correctly.
- Forms fit small screens.
- Status indicators are not communicated by color alone.
- Keyboard navigation works.
- Focus indicators are visible.
- Form controls have accessible labels.
- Images have meaningful alternative text when appropriate.
- Color contrast meets WCAG 2.2 AA targets where applicable.

## 8. Browser Compatibility

Test the latest stable versions available during release of:

- Google Chrome.
- Mozilla Firefox.
- Microsoft Edge.
- Safari, if an Apple device is available for testing.

The primary development and QA environment may use Chrome and Firefox on desktop, but mobile browser behavior must also be checked.

## 9. Performance Testing

Check:

- Homepage loading performance.
- Public content listing performance.
- Moderator directory performance.
- Image optimization and lazy loading.
- Database query count and slow queries.
- Pagination for larger content collections.
- Efficient relationship loading to avoid N+1 queries.
- Caching for appropriate public data.
- Presence polling frequency and server load.

Do not add complex real-time infrastructure unless measurements or requirements justify it.

## 10. Deployment and Smoke Testing

After deployment to staging, verify:

1. Application loads using the configured domain.
2. HTTPS works.
3. Database connection works.
4. Migrations complete successfully.
5. Admin login works.
6. Moderator login works.
7. Public pages load.
8. Images and uploaded media load.
9. Language switching works.
10. Authorization restrictions work.
11. Logs and error reporting work.
12. Backups are configured and recoverable.

Repeat essential smoke tests after production deployment.

## 11. Test Environment

Recommended environments:

- Local development.
- Automated testing environment.
- Staging environment.
- Production environment.

Testing must use separate test data. Real credentials and production user data must not be copied into development unnecessarily.

## 12. Test Data

Use seeded test records for:

- One Admin.
- Multiple Moderators.
- Active and suspended Moderator accounts.
- Published and unpublished permitted content.
- Draft and archived content.
- Announcements.
- Scam-awareness notices.
- Activity log entries.

Use fake credentials and non-sensitive sample content.

## 13. Release Acceptance Criteria

A release can be considered ready when:

- All critical functional tests pass.
- All authorization tests pass.
- No known critical security issue remains.
- Database migrations succeed.
- Public pages work across supported viewport sizes.
- Admin and Moderator workflows work.
- Activity logging works for required actions.
- No restricted account-transfer or sale functionality is exposed.
- Staging smoke tests pass.
- Backup and rollback procedures are documented.

Critical security and authorization failures block release.

## 14. Bug Severity

| Severity | Description | Release Impact |
|---|---|---|
| Critical | Authentication bypass, data exposure, severe security issue | Block release |
| High | Major feature or permission failure | Block affected release |
| Medium | Feature partially fails or significant usability issue | Fix before release where practical |
| Low | Minor visual or non-blocking issue | May be scheduled for later |

## 15. Bug Report Format

Each bug report should include:

- Bug ID.
- Short title.
- Environment.
- Steps to reproduce.
- Expected result.
- Actual result.
- Screenshot or relevant log, if available.
- Severity.
- Status.
- Resolution notes.

## 16. Testing Tools

Recommended tools:

- Laravel PHPUnit or Pest for automated tests.
- Laravel HTTP testing utilities for feature tests.
- Browser developer tools for responsive and UI inspection.
- Postman for API testing where APIs are present.
- Lighthouse for performance and accessibility checks.
- Database inspection tools for data integrity verification.

Tool selection can be adjusted during implementation.

## 17. Final Testing Principle

Every important feature must be tested from both the user-interface and server-side perspectives.

A feature is not considered secure merely because an unauthorized button is hidden. The backend must independently enforce authentication, authorization, validation, and business rules.

**Document Status:** Draft — Pending Review.