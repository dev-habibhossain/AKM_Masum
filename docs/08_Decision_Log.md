# 08 — Project Decision Log

**Project:** Gaming Brand & Community Website  
**Document Version:** 1.0  
**Status:** Draft — Pending Review  
**Purpose:** Maintain a reliable record of project decisions, approvals, assumptions, and unresolved questions.

---

## 1. How to Use This Document

This document records decisions that affect product scope, architecture, design, database structure, security, and implementation.

Each decision has one of the following statuses:

| Status | Meaning |
|---|---|
| Proposed | Suggested but not approved |
| Approved | Explicitly accepted |
| Pending | Requires clarification or additional information |
| Superseded | Replaced by a newer decision |
| Rejected | Considered and intentionally not selected |

A discussion or general acknowledgment does not automatically mean a decision is approved.

When a decision changes, update this document rather than silently changing the project requirements.

## 2. Confirmed Project Decisions

### DEC-001 — Laravel-Based Application

**Status:** Approved  
**Decision:** Build the website using Laravel.

**Reason:** Laravel provides authentication, database management, validation, authorization, routing, and a maintainable backend foundation.

**Impact:** Backend implementation and application structure will follow Laravel conventions.

### DEC-002 — Primary and Secondary Languages

**Status:** Approved  
**Decision:** Bangla is the primary website language. English is the secondary language.

**Impact:**
- Public-facing content must support both languages.
- Navigation and interface labels must support language switching.
- Bengali typography must be considered during UI implementation.

### DEC-003 — No Public Registration

**Status:** Approved  
**Decision:** Public visitors do not need to register or log in.

Only Admin and Moderator accounts can authenticate.

**Impact:** No customer registration, customer dashboard, or public user-account system is required for the MVP.

### DEC-004 — Admin and Moderator Roles

**Status:** Approved  
**Decision:** The initial system has two management roles:

- Admin.
- Moderator.

Admin manages the platform. Moderators manage their own permitted content and profile-related settings.

**Impact:** Role-based authorization and ownership policies are required.

### DEC-005 — Public Moderator Directory

**Status:** Approved  
**Decision:** Visitors can browse a public Moderator directory and open individual Moderator detail pages.

**Impact:** Public profile information, status indicators, and permitted content must be available through public routes.

### DEC-006 — Separate Online and Availability Status

**Status:** Approved  
**Decision:** Online/offline and Available/Busy are independent status fields.

- Online/offline is derived from authenticated presence.
- Available/Busy is manually controlled by the Moderator.

**Impact:** The interface and backend must not combine these into a single status.

### DEC-007 — Moderator-Owned Content

**Status:** Approved  
**Decision:** Moderators can manage only their own permitted content. Admin has platform-level management permissions.

**Impact:** Ownership must be checked on the server for every relevant read, update, and delete operation.

### DEC-008 — Scam Awareness

**Status:** Approved  
**Decision:** Scam-awareness information and safety notices are important public website features.

**Impact:** Homepage and relevant public pages must provide clear safety information.

### DEC-009 — Brand-Led Gaming Editorial Design

**Status:** Approved Provisionally  
**Decision:** Use the Brand-led Gaming Editorial direction from UI/UX Specification v2.0 as the current design baseline.

**Design principles:**
- Creator-led identity.
- Distinctive typography.
- Clear content hierarchy.
- Restrained borders and effects.
- Real creator branding and imagery.
- Avoid generic neon gaming templates and generic SaaS layouts.

**Impact:** The design remains flexible. It can be revised after receiving the creator's actual logo, colors, and branding or after implementation review.

### DEC-010 — Documentation Before Implementation

**Status:** Approved  
**Decision:** Complete and review the core project documentation before starting full implementation.

**Impact:** Coding should follow the approved requirements, architecture, schema, implementation plan, and testing plan.

### DEC-011 — AI-Assisted Development With Human Review

**Status:** Approved  
**Decision:** AI tools may assist with planning, implementation, debugging, and documentation, but generated code must be reviewed and tested before acceptance.

**Impact:**
- Follow project documentation.
- Work in small, reviewable tasks.
- Avoid unrequested architectural or design changes.
- Run relevant tests after implementation.
- Do not assume generated code is correct merely because it compiles.

### DEC-012 — Restricted Account Trading Scope

**Status:** Approved as a Project Restriction  
**Decision:** Account sale, purchase, transfer, transaction, payment, escrow, and related facilitation flows are excluded unless compliance is independently confirmed and the project owner explicitly approves a revised scope.

**Impact:**
- Do not implement account-transfer listings.
- Do not implement account purchase or sale actions.
- Do not implement transfer prices or transaction processing.
- Do not implement WhatsApp flows intended to facilitate account sales or transfers.

The content architecture may support legitimate gaming-related content that is independently permitted.

---

## 3. Current Technical Direction

These decisions are approved where explicitly marked. Other details remain proposals.

### DEC-013 — Frontend Rendering Approach

**Status:** Approved  
**Decision:** Use Laravel Blade with Tailwind CSS. Alpine.js may be used for lightweight interactions where needed.

**Impact:** Do not introduce React or Vue into this project unless a separate decision approves it.

### DEC-014 — Database Engine

**Status:** Proposed  
**Decision:** MySQL 8.0+ is the database target in the current technical and schema documentation.

**Pending:** Confirm the actual hosting environment and supported MySQL version before deployment.

### DEC-015 — Authentication and Authorization

**Status:** Approved as a Design Requirement  
**Decision:** Use secure Laravel authentication and server-side authorization.

**Impact:**
- Protect management routes.
- Enforce role permissions.
- Enforce Moderator content ownership.
- Reject suspended or deactivated accounts.
- Never rely only on frontend visibility rules.

The final authentication implementation details remain part of technical implementation.

### DEC-016 — Presence Implementation

**Status:** Proposed  
**Decision:** Start with a heartbeat-based presence approach and server-side timeout.

The Implementation Plan suggests an initial 60-second heartbeat and 180-second offline timeout.

**Pending:** Validate these intervals during implementation and performance testing.

### DEC-017 — Real-Time Technology

**Status:** Pending  
**Decision:** Laravel Reverb and broadcasting may be considered if actual real-time updates are required.

**Current direction:** Start with a simpler polling approach if it satisfies the requirements. Introduce Reverb only when justified.

**Reason:** Avoid unnecessary infrastructure complexity for the initial release.

### DEC-018 — Database Structure

**Status:** Draft — Pending Review  
**Decision:** The current schema document proposes the following core tables:

- users
- moderator_profiles
- content_categories
- contents
- content_media
- announcements
- activity_logs
- settings

Optional Laravel tables are also documented.

**Pending:** Review column definitions, relationships, indexes, and retention rules before migrations are treated as final.

---

## 4. UI and Product Decisions Still Pending

### DEC-019 — Final Brand Identity

**Status:** Pending  
**Question:** What exact logo, gaming name, brand colors, and visual assets will the creator provide?

**Impact:** Final color tokens, typography hierarchy, and brand imagery depend on the actual assets.

### DEC-020 — Public Content Categories

**Status:** Pending  
**Question:** What categories of legitimate gaming-related content should visitors be able to browse?

**Impact:** This affects category structure, filters, navigation, and database seed data.

### DEC-021 — Public Contact Information

**Status:** Pending  
**Question:** Which contact information should be publicly displayed on Moderator profiles?

**Impact:** Profile privacy, contact UI, and validation rules depend on this decision.

### DEC-022 — Content Media Rules

**Status:** Pending  
**Question:** Which image formats, maximum file sizes, and image dimensions should be allowed?

**Impact:** File validation, storage, optimization, and media display.

### DEC-023 — Search and Filtering

**Status:** Proposed  
**Decision:** Public search and filters may be included if they are useful for the final permitted content categories.

**Pending:** Confirm exact filters and whether they are required for the MVP.

---

## 5. Technical Decisions Still Pending

### DEC-024 — Contact Data Storage

**Status:** Pending  
**Current schema proposal:** Store structured contact details in a JSON field.

**Alternative:** Use a separate contact-information table.

**Pending:** Select the approach based on validation, querying, privacy, and expected growth.

### DEC-025 — Activity Log Retention

**Status:** Pending  
**Question:** How long should activity logs be retained?

**Impact:** Database storage, cleanup jobs, audit requirements, and privacy.

### DEC-026 — Activity Log Subject Structure

**Status:** Pending  
**Current proposal:** Use a polymorphic subject relationship where appropriate.

**Pending:** Confirm whether this is preferable to explicit foreign keys for the expected audit requirements.

### DEC-027 — Sessions and Password Reset

**Status:** Pending  
**Question:** Which Laravel session driver and password-reset approach will the deployment environment support?

**Impact:** Authentication configuration, database tables, and deployment settings.

### DEC-028 — Hosting and Deployment

**Status:** Pending  
**Question:** Which hosting provider, server configuration, domain, and deployment workflow will be used?

**Impact:** PHP version, database version, queue configuration, file storage, HTTPS, backups, and deployment procedures.

### DEC-029 — Backup and Recovery

**Status:** Proposed  
**Decision:** Production deployment should include database and uploaded-media backup procedures.

**Pending:** Confirm backup frequency, retention, storage location, and recovery procedure.

### DEC-030 — Presence and Activity Retention

**Status:** Pending  
**Question:** Should historical presence sessions be stored, or should the system maintain only the latest presence state?

**Impact:** Database design, activity reporting, and storage requirements.

---

## 6. Superseded Decisions

| Decision | Previous Version | Current Version | Status |
|---|---|---|---|
| UI design direction | UI Specification v1.0 generic direction | Brand-led Gaming Editorial, v2.0 | Superseded |
| Homepage prototype | Initial dark/lime prototype | Refined editorial prototype and v2.0 direction | Superseded as design baseline |

The current approved design baseline is UI/UX Specification v2.0, subject to future review.

---

## 7. Compliance and Scope Change Control

Any proposed feature involving account ownership, account sales, purchases, transfers, payments, or transaction facilitation must be treated as out of scope.

A scope change requires:

1. Independent confirmation that the feature is permitted by applicable platform rules and law.
2. A documented explanation of the intended functionality.
3. Explicit project-owner approval.
4. Updates to the PRD, App Flow, UI Specification, TRD, Database Schema, and Testing Plan where relevant.
5. A security and risk review.

No implementation should begin based on an assumption that a restricted feature is permitted.

---

## 8. Decision Review Process

For every new significant decision:

1. Assign a unique decision ID.
2. Describe the decision and alternatives.
3. Record the reason.
4. Identify affected documents and features.
5. Set its status.
6. Record the approval date when explicitly approved.
7. Update related project documents.

When an approved decision changes, mark the previous entry as superseded and create a new entry.

---

## 9. Current Project Approval Summary

| Document | Current Version | Status |
|---|---:|---|
| PRD | 1.1 | Draft — Pending Review |
| App Flow | 1.0 | Draft — Pending Review |
| UI/UX Specification | 2.0 | Approved Provisionally |
| TRD | 1.0 | Approved |
| Database Schema | 1.0 | Draft — Pending Review |
| Implementation Plan | 1.0 | Draft — Pending Review |
| Testing Plan | 1.0 | Draft — Pending Review |
| Decision Log | 1.0 | Draft — Pending Review |

**Important:** Approval of one document does not automatically approve the others.

---

## 10. Documentation Completion

The initial documentation set is now prepared:

1. `01_PRD.md`
2. `02_App_Flow.md`
3. `03_UI_Spec.md`
4. `04_TRD.md`
5. `05_Database_Schema.md`
6. `06_Implementation_Plan.md`
7. `07_Testing_Plan.md`
8. `08_Decision_Log.md`

The next stage is a documentation review and consistency check.

Before implementation begins, resolve important pending decisions, approve the database schema and implementation plan, and confirm the final project scope.

**Document Status:** Draft — Pending Review.