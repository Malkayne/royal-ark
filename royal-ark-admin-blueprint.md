# Royal Ark College — Admin Dashboard Blueprint
**"Royalty in Excellence" · Internal Management System**
Version 1.0

---

## 1. DESIGN PHILOSOPHY & AESTHETIC DIRECTION

### 1.1 Concept
The admin dashboard takes a deliberate **tonal shift** from the public landing pages. Where the landing site is editorial and emotive (Cormorant Garamond, rich jewel tones, layered luxury), the admin is **precision-utilitarian with regal undertones** — like the interior of a well-run headmaster's office: structured, no-nonsense, but with inherited prestige.

**Aesthetic:** Dark-sidebar authority meets clean white content canvas. Think Bloomberg Terminal meets a private school prospectus — dense with information but never cluttered. Every element earns its place.

### 1.2 Color System (Admin-specific)

```css
/* Admin inherits brand variables but applies them differently */

/* Sidebar (dark authority) */
--sidebar-bg:       #180A30;   /* near-black with deep purple undertone */
--sidebar-border:   rgba(255,255,255,0.07);
--sidebar-active:   rgba(200,90,0,0.18);   /* amber glow on active */
--sidebar-hover:    rgba(255,255,255,0.06);
--sidebar-text:     rgba(255,255,255,0.65);
--sidebar-text-active: #FFFFFF;
--sidebar-accent:   #F4C240;   /* gold for active indicator */
--sidebar-w:        260px;
--sidebar-w-collapsed: 68px;

/* Content canvas (light, clean) */
--canvas-bg:        #F5F3F9;   /* very slight purple tint on white */
--canvas-surface:   #FFFFFF;
--canvas-border:    #EAE4F4;
--canvas-border-dark: #D5C8EE;

/* Topbar */
--topbar-bg:        #FFFFFF;
--topbar-h:         64px;

/* Status colors (admin-specific uses) */
--status-open:      #1A7A4A;
--status-open-bg:   #D4F5E4;
--status-pending:   #B56B00;
--status-pending-bg:#FDEFD6;
--status-rejected:  #B52B2B;
--status-rejected-bg:#FDE4E4;
--status-review:    #1A5C99;
--status-review-bg: #D6ECFF;
--status-draft:     #5A4F6B;
--status-draft-bg:  #EDE4F9;
```

### 1.3 Typography (Admin)

```
Display / headings:  'Outfit' 600–700   — clean authority, readable at small sizes
Body / data:         'DM Sans' 400–500  — optimized for dense data reading
Mono / IDs / codes:  'JetBrains Mono'  — for reference numbers, IDs, dates
```

### 1.4 Spacing & Radii (Admin)
```
--admin-radius-xs:  4px
--admin-radius-sm:  6px
--admin-radius-md:  10px
--admin-radius-lg:  14px
--content-pad:      28px        /* main content area internal padding */
--card-pad:         20px
--table-cell-h:     52px        /* minimum table row height */
```

---

## 2. AUTHENTICATION PAGES

### 2.1 Login Page (`auth/login.html`)

**Layout:** Split-screen — left brand panel (40%), right form panel (60%).

#### Left Panel — Brand
```
Background: linear-gradient(160deg, #180A30, #3D1A6E)
+ diagonal amber accent bar (right edge, 4px)
+ subtle crown/arch geometric pattern (very low opacity)
+ large school crest emoji/SVG (translucent, bottom-right watermark)

Content (vertically centered):
  [School Crest / Logo — 60px version]
  [School Name — Cormorant Garamond 2.8rem, white]
  "Royal Ark College"
  [Motto — Outfit 0.75rem, amber-gold, uppercase tracking]
  "Royalty in Excellence"

  [Divider — amber 48px line]

  [3 feature pills stacked]:
    🔐 Secure Admin Portal
    📊 Real-time Dashboard
    ⚡ Instant Updates

  [Bottom — subtle]:
  "Authorised access only. All activity is logged."
```

#### Right Panel — Form
```
Background: #FAF8FC (cream, slight purple tint)

[Logo small — top-left, for mobile only]

[Form card — white, shadow, rounded]:
  max-width: 420px, centered

  [H2 — Outfit 600]: Welcome Back
  [Sub]: Sign in to the Royal Ark admin panel.

  ─────────────────────────────────────
  Role Selector (tabbed pills):
    [● Admin]  [  Staff]  [  Bursar]
  ─────────────────────────────────────

  Email Address *
  [Input — email type, icon left: envelope]

  Password *
  [Input — password type, icon left: lock, eye-toggle right]

  [Row]: [Remember me checkbox]  [Forgot Password? →]

  [Sign In button — full width, amber primary, lg]

  [Divider]

  [Small text]: Having trouble? Contact your system administrator.
  support@royalark.edu.ng
```

**Interactions:**
- Role selector: clicking a pill animates underline + slides active bg
- Form validation: inline real-time — red border + shake + error msg below field
- Submit loading: button text → spinner + "Signing in…" (disabled state)
- Wrong credentials: amber warning alert slides in above form (not inline)
- Success: brief success flash → redirect with fade transition

**Special Elements:**
- Password strength not needed on login (only on reset)
- Auto-fill detection: if browser autofills, label floats correctly
- Keyboard: Enter submits form from any field

---

### 2.2 Forgot Password (`auth/forgot-password.html`)

```
Same layout shell as login.

Form card:
  [← Back to Login]
  [H2]: Reset Password
  [Sub]: Enter your email and we'll send a reset link.

  Email Address *
  [Send Reset Link button]

Success state (replaces form):
  ✅ [checkmark animation]
  "Reset link sent!"
  "Check your inbox at em***@royalark.edu.ng"
  [Resend link — 60s countdown timer]
  [← Back to Login]
```

---

### 2.3 Reset Password (`auth/reset-password.html`)

```
Form card:
  [H2]: Set New Password
  [Sub]: Choose a strong password for your account.

  New Password *    [strength bar — 4 segments]
  Confirm Password *
  [Update Password button]

  Password rules display (live check ✓/✗):
    ✓ At least 8 characters
    ✗ Contains uppercase letter
    ✓ Contains a number
    ✗ Contains a symbol
```

---

## 3. CORE LAYOUT SYSTEM

### 3.1 Shell Structure
```
┌─────────────────────────────────────────────────────────┐
│  [ADMIT BAR — optional global notice, collapsible]      │  ~36px
├──────────────┬──────────────────────────────────────────┤
│              │  TOPBAR                                  │  64px
│              ├──────────────────────────────────────────┤
│   SIDEBAR    │                                          │
│   260px      │  MAIN CONTENT AREA                       │
│   (fixed)    │  (scrollable, padding 28px)              │
│              │                                          │
│              │                                          │
└──────────────┴──────────────────────────────────────────┘
```

### 3.2 Sidebar (`#adminSidebar`)

**Width:** 260px expanded / 68px collapsed (icon-only mode).
**Position:** Fixed, full height, dark background.
**Behavior:** Toggle via topbar hamburger. On mobile: slides in as overlay with dark backdrop.

#### Sidebar Header
```
┌─────────────────────────────────────┐
│  [Crest 36px]  Royal Ark College   │
│                Admin Panel          │  ← gold badge
└─────────────────────────────────────┘
```

Collapsed state: only crest visible, centered.

#### Sidebar Navigation Structure

```
────────────────────────────
  Overview
────────────────────────────
  🏠  Dashboard

────────────────────────────
  School Management
────────────────────────────
  📋  Admissions        [badge: pending count]
  💬  Enquiries         [badge: unread count]

────────────────────────────
  Content Management
────────────────────────────
  🌐  Website Content   [expandable subnav ▾]
      ├─ Hero Section
      ├─ About Snippet
      ├─ Programs / Levels
      ├─ Why Choose Us
      ├─ Gallery
      ├─ Testimonials
      ├─ Stats Bar
      └─ Footer Info

  📅  Events            [expandable subnav ▾]
      ├─ All Events
      └─ New Event

  📰  Blog / News       [expandable subnav ▾]
      ├─ All Posts
      ├─ New Post
      └─ Categories

  🖼️  Media Library

────────────────────────────
  Settings
────────────────────────────
  ⚙️  School Settings
  👤  Admin Accounts
  🔐  Security
────────────────────────────
  [Bottom pinned]:
  [Avatar] [Name] [Role]
  [Logout →]
```

#### Sidebar Nav Item Anatomy
```
[active state]:
  ┌──────────────────────────────┐
  │ ▌ 🏠  Dashboard             │  ← 3px amber left bar, amber-tinted bg
  └──────────────────────────────┘

[hover state]:
  ┌──────────────────────────────┐
  │   🏠  Dashboard             │  ← subtle light bg
  └──────────────────────────────┘

[subnav expanded]:
  ┌──────────────────────────────┐
  │ ▾ 🌐  Website Content        │
  │    ├─ Hero Section           │  ← indented, smaller text
  │    ├─ Programs / Levels      │
  │    └─ ...                    │
  └──────────────────────────────┘
```

Subnav: smooth max-height CSS transition (0 → auto via JS height calc).
Collapsed sidebar: subnavs become tooltip flyouts on hover.

#### Sidebar Badge
```
[count pill — amber bg, white text, small]:
  Admissions  [14]
  Enquiries   [3]
```
Badge disappears in collapsed sidebar (visible as tooltip).

---

### 3.3 Topbar (`#adminTopbar`)

```
┌─────────────────────────────────────────────────────────────┐
│ [☰ Toggle]  [Breadcrumb: Dashboard / Admissions]           │
│                            [🔔 Notifs]  [👤 User dropdown] │
└─────────────────────────────────────────────────────────────┘
```

**Left:**
- Hamburger toggle (sidebar collapse/expand)
- Breadcrumb — shows current location (clickable parent links)

**Right:**
- 🔔 Notifications bell — badge with unread count → opens notification dropdown
- User avatar chip → dropdown: My Profile | Change Password | Logout

#### Notification Dropdown
```
┌──────────────────────────────────┐
│ Notifications        [Mark all] │
├──────────────────────────────────┤
│ 🟠 New admission — Chidi Obi    │ unread → amber left border
│    JSS1 · Just now              │
├──────────────────────────────────┤
│ 💬 New enquiry from parent      │ unread
│    3 minutes ago                │
├──────────────────────────────────┤
│ ✅ Blog post published           │ read → no border
│    2 hours ago                  │
├──────────────────────────────────┤
│       [View All Notifications]  │
└──────────────────────────────────┘
```

---

### 3.4 Global Admin Notice Bar
Optional sticky bar above topbar (admin-controlled):
```
[Type icon]  "School reopens January 6, 2026. Update website content before Dec 20."  [Edit]  [✕]
```
Types: info (blue) / warning (amber) / alert (red).

---

## 4. PAGE-BY-PAGE BLUEPRINT

---

### PAGE 1: Dashboard (`admin/dashboard.html`)

**Purpose:** Command center — instant overview of everything important.

---

#### Section A — Page Header
```
[H1]: Good morning, Mrs. Adeyemi 👋
[Sub]: Here's what's happening at Royal Ark today.
[Right]: [Date: Monday, 12 Jan 2025]  [View School Site ↗]
```

---

#### Section B — Stat Cards Row (4 cards)
```
┌──────────────────┐ ┌──────────────────┐ ┌──────────────────┐ ┌──────────────────┐
│  📋              │ │  💬              │ │  📅              │ │  🌐              │
│  Admissions      │ │  Enquiries       │ │  Events          │ │  Blog Posts      │
│                  │ │                  │ │                  │ │                  │
│  [48]            │ │  [12]            │ │  [3 upcoming]    │ │  [17 published]  │
│  Total received  │ │  Unread          │ │  this month      │ │  [2 drafts]      │
│  ─────────────── │ │  ─────────────── │ │  ─────────────── │ │  ─────────────── │
│  ↑ 14 pending    │ │  ↑ 3 today       │ │  Next: Dec 14    │ │  Last: 2 days ago│
└──────────────────┘ └──────────────────┘ └──────────────────┘ └──────────────────┘
```

Card anatomy:
- Icon in colored pill (royal-pale bg)
- Main metric: large Outfit 700 number
- Sub-metric: smaller muted text
- Bottom row: trend or quick fact
- Hover: shadow lifts, top amber accent bar animates in

---

#### Section C — Admissions Status Toggle (prominent)
```
┌──────────────────────────────────────────────────────────────┐
│ 🎓 Admissions Portal                                         │
│ ─────────────────────────────────────────────────────────────│
│ Current Session: 2025/2026 Academic Year                     │
│                                                              │
│  Status: [● OPEN]          ←→ Toggle Switch (large)         │
│  Applications window:                                        │
│  Opens:  Sep 1, 2025    Closes: Nov 30, 2025               │
│                                                              │
│  [Edit Session Dates]  [View Applications →]                │
└──────────────────────────────────────────────────────────────┘
```

Toggle switch: large (48px), amber when ON, grey when OFF.
On toggle: confirm modal → "Are you sure you want to close admissions? This will update the public website immediately."

---

#### Section D — Two-Column Grid

**Left (2/3):** Recent Admissions Table
```
┌─────────────────────────────────────────────────────┐
│ Recent Applications              [View All →]       │
├──────────┬────────────┬──────────┬──────────────────┤
│ Applicant│ Class      │ Date     │ Status           │
├──────────┼────────────┼──────────┼──────────────────┤
│ Chidi O. │ JSS 1      │ Jan 10   │ 🟠 Pending       │
│ Amaka U. │ Primary 4  │ Jan 10   │ 🟠 Pending       │
│ Tunde A. │ SSS 1      │ Jan 9    │ 🔵 In Review     │
│ Bisi K.  │ Nursery 2  │ Jan 8    │ ✅ Approved      │
│ Emeka N. │ JSS 3      │ Jan 7    │ ❌ Rejected      │
└──────────┴────────────┴──────────┴──────────────────┘
```

**Right (1/3):** Quick Actions Panel
```
┌────────────────────────┐
│  Quick Actions         │
│  ─────────────────     │
│  [+ New Blog Post]     │ → btn-royal
│  [+ Create Event]      │ → btn-outline
│  [📤 Export Report]    │ → btn-ghost
│  [✉️ View Enquiries]   │ → btn-ghost
│  ──────────────────    │
│  Website Status        │
│  ─────────────────     │
│  Admissions: [OPEN] ●  │
│  Hero Banner: ✓ Live   │
│  Gallery: 24 items     │
│  Last updated: 2hr ago │
└────────────────────────┘
```

---

#### Section E — Recent Enquiries + Upcoming Events (two columns)

**Left:** Recent Enquiries (last 5)
```
┌────────────────────────────────────────────┐
│ Recent Enquiries          [View All →]     │
├────────────────────────────────────────────┤
│ [💬]  Mrs. Fatima Bello                   │
│       Admission enquiry · 5 min ago        │  unread → left amber border
├────────────────────────────────────────────┤
│ [💬]  Mr. Chukwuma Eze                    │
│       Fee structure question · 1hr ago     │
├────────────────────────────────────────────┤
│ ...                                        │
└────────────────────────────────────────────┘
```

**Right:** Upcoming Events
```
┌──────────────────────────────────────┐
│ Upcoming Events       [Manage →]    │
├───────┬──────────────────────────────┤
│  DEC  │ Prize Giving Day            │
│  14   │ Main Hall · 10:00 AM        │
├───────┼──────────────────────────────┤
│  JAN  │ Third Term Resumption       │
│  6    │ All Classes                 │
└───────┴──────────────────────────────┘
```

---

### PAGE 2: Admissions (`admin/admissions/`)

#### 2A — All Applications (`index.html`)

**Page Header:**
```
[H1]: Admission Applications
[Sub]: 2025/2026 Academic Session — 48 total applications
[Right]: [Export CSV ↓]  [Filter ▾]  [Bulk Actions ▾]
```

**Filter Bar:**
```
[🔍 Search by name, email, ID…]  [Class ▾]  [Status ▾]  [Date Range ▾]  [Clear ×]
```

**Bulk Actions Bar (shows when rows checked):**
```
[3 selected]  [Approve ✓]  [Reject ✗]  [Move to Review]  [Delete]
```

**Responsive Table:**
```
┌─────┬──────────────────┬─────────────┬──────────┬──────────┬────────────┬──────────────┐
│ ☐   │ Applicant        │ Class       │ Parent   │ Date     │ Status     │ Actions      │
├─────┼──────────────────┼─────────────┼──────────┼──────────┼────────────┼──────────────┤
│ ☐   │ [Avatar] Chidi   │ JSS 1       │ Mr. Obi  │ Jan 10   │ 🟠 Pending │ [View][•••] │
│     │ Obi · RAC-0042   │             │          │          │            │              │
├─────┼──────────────────┼─────────────┼──────────┼──────────┼────────────┼──────────────┤
│ ☐   │ [Avatar] Amaka   │ Primary 4   │ Mrs.Uche │ Jan 10   │ 🟠 Pending │ [View][•••] │
│     │ Uche · RAC-0041  │             │          │          │            │              │
└─────┴──────────────────┴─────────────┴──────────┴──────────┴────────────┴──────────────┘
```

**Mobile table behavior:**
- Columns: Applicant (always visible) + Status (always visible) + Actions
- All other columns stack inside an expandable row-detail panel (tap to expand)
- No horizontal scroll — everything stacks or collapses gracefully

**Status badges:**
```
🟠 Pending    → amber pill
🔵 In Review  → blue pill
✅ Approved   → green pill
❌ Rejected   → red pill
⏳ Waitlisted → purple pill
```

**Action menu `[•••]`:**
```
┌───────────────────┐
│ 👁 View Details   │
│ ✅ Approve        │
│ 🔵 Mark In Review │
│ ❌ Reject         │
│ ─────────────── │
│ 🗑 Delete         │ ← danger red
└───────────────────┘
```

**Pagination:**
```
[← Prev]  [1] [2] [3] ... [8]  [Next →]    Showing 1–15 of 48
```

---

#### 2B — Application Detail (`detail.html`)

**Layout:** Two-column (detail left 2/3, actions right 1/3).

**Left — Full Application Data:**
```
┌─────────────────────────────────────────────────────┐
│  [← Back to Applications]                          │
│  Application: RAC-2025-0042                         │
│  Submitted: January 10, 2025 · 10:34 AM            │
├─────────────────────────────────────────────────────┤
│  TABS: [Student Info] [Parent Info] [Documents] [Notes]
├─────────────────────────────────────────────────────┤
│  [Tab content — rendered as clean key-value pairs]  │
│                                                     │
│  Student Name:    Chidi Emmanuel Obi               │
│  Date of Birth:   March 15, 2016                   │
│  Gender:          Male                             │
│  Nationality:     Nigerian                         │
│  Class Applying:  JSS 1                            │
│  ...                                               │
└─────────────────────────────────────────────────────┘
```

**Right — Action Panel (sticky):**
```
┌──────────────────────────────┐
│  Current Status              │
│  ──────────────────────────  │
│  🟠 Pending Review           │
│                              │
│  [✅ Approve Application]    │ → opens confirm modal
│  [🔵 Mark as In Review]      │
│  [❌ Reject Application]     │ → opens reject modal (reason field)
│  ────────────────────────    │
│  [Send Email to Parent]      │ → opens compose modal
│  ────────────────────────    │
│  Application ID              │
│  RAC-2025-0042               │
│  [📋 Copy ID]                │
│                              │
│  Submitted                   │
│  Jan 10, 2025 — 10:34 AM    │
└──────────────────────────────┘
```

**Documents Tab:**
```
┌─────────────────────────────────────┐
│ 📄 Birth Certificate                │
│    birth_cert_chidi.pdf             │
│    [View] [Download]                │
├─────────────────────────────────────┤
│ 📸 Passport Photograph              │
│    [Preview thumbnail]              │
│    [View Fullsize] [Download]       │
├─────────────────────────────────────┤
│ 📋 Last School Report               │
│    report_card_2024.pdf             │
│    [View] [Download]                │
└─────────────────────────────────────┘
```

**Notes Tab:**
```
Internal notes visible only to admins.

[Note 1 — Mrs. Adeyemi — Jan 11]:
"Parent called to confirm submission. Documents look complete."

[Add Note]:
[Textarea input]
[Save Note button]
```

---

#### Modals for Admissions

**Approve Modal:**
```
┌────────────────────────────────────────┐
│  ✅ Approve Application                │ [✕]
│  ──────────────────────────────────── │
│  You are about to approve:            │
│  Chidi Emmanuel Obi — JSS 1           │
│                                       │
│  An email will be sent to the parent  │
│  at: okechukwuobi@gmail.com           │
│                                       │
│  [Add a note for the email]           │
│  [Textarea — optional message]        │
│                                       │
│  [Cancel]    [✅ Confirm Approval]    │
└────────────────────────────────────────┘
```

**Reject Modal:**
```
┌────────────────────────────────────────┐
│  ❌ Reject Application                 │ [✕]
│  ──────────────────────────────────── │
│  Rejection Reason * (required)        │
│  [Dropdown: Overage / Class full /    │
│   Incomplete docs / Other]            │
│                                       │
│  Additional note to parent            │
│  [Textarea]                           │
│                                       │
│  [Cancel]    [❌ Confirm Rejection]   │  ← danger button
└────────────────────────────────────────┘
```

---

### PAGE 3: Enquiries / Contact Messages (`admin/enquiries/`)

#### 3A — All Enquiries (`index.html`)

**Layout:** Email-client style — list left (1/3), detail right (2/3).

**Left Panel — Message List:**
```
[🔍 Search messages…]  [Unread ▾]

┌────────────────────────────────┐
│ ● Mrs. Fatima Bello           │  ← unread: bold, amber dot
│  Admission enquiry            │
│  5 min ago                    │
├────────────────────────────────┤
│   Mr. Eze Chukwuma            │  ← read: normal weight
│  Fee structure question       │
│  1 hour ago                   │
├────────────────────────────────┤
│ ● Anonymous                   │
│  General enquiry              │
│  Yesterday                    │
└────────────────────────────────┘
```

**Right Panel — Message Detail:**
```
┌─────────────────────────────────────────────────────┐
│  Mrs. Fatima Bello                                  │
│  fatima.bello@gmail.com · +234 803 xxx xxxx        │
│  Subject: Admission for my daughter — Primary 3    │
│  Received: Jan 10, 2025 · 9:12 AM                 │
├─────────────────────────────────────────────────────┤
│                                                     │
│  Good morning,                                      │
│  I would like to inquire about admission for my     │
│  daughter, Zainab, into Primary 3. She is           │
│  currently 8 years old and...                       │
│                                                     │
├─────────────────────────────────────────────────────┤
│  REPLY:                                             │
│  [Textarea — compose reply]                         │
│                                                     │
│  [Send Reply]    [Mark as Spam]    [Archive]       │
│  [🗑 Delete]                                        │
└─────────────────────────────────────────────────────┘
```

**Mobile:** List view only → tap message → full-screen detail view with back button.

**Status actions (top-right of message):**
```
[● Unread]  [Archive]  [Flag]  [Delete]
```

---

### PAGE 4: Website Content Management

This is the most important section — every subsection maps to a landing page section the admin can edit live.

---

#### 4A — Content Hub (`admin/content/index.html`)

**Overview grid — cards per managed section:**
```
[H1]: Website Content Manager
[Sub]: Changes here update the public website immediately.

┌─────────────────┐ ┌─────────────────┐ ┌─────────────────┐
│  🏠 Hero        │ │  ℹ️ About Snippet│ │  🎓 Programs    │
│  Section        │ │                 │ │  / Levels       │
│  ─────────────  │ │  ─────────────  │ │  ─────────────  │
│  Last edited:   │ │  Last edited:   │ │  Last edited:   │
│  2 days ago     │ │  1 week ago     │ │  3 days ago     │
│  [Edit →]       │ │  [Edit →]       │ │  [Edit →]       │
└─────────────────┘ └─────────────────┘ └─────────────────┘
┌─────────────────┐ ┌─────────────────┐ ┌─────────────────┐
│  👑 Why Choose  │ │  🖼️ Gallery     │ │  ⭐ Testimonials │
│  Us             │ │                 │ │                 │
│  [Edit →]       │ │  [Manage →]     │ │  [Edit →]       │
└─────────────────┘ └─────────────────┘ └─────────────────┘
┌─────────────────┐ ┌─────────────────┐
│  📊 Stats Bar   │ │  📌 Footer Info  │
│  (counters)     │ │                 │
│  [Edit →]       │ │  [Edit →]       │
└─────────────────┘ └─────────────────┘
```

Status indicator on each card:
- 🟢 Live & up to date
- 🟡 Has unpublished changes
- 🔴 Never configured

---

#### 4B — Hero Section Editor (`admin/content/hero.html`)

```
[H2]: Hero Section Editor
[Breadcrumb]: Content / Hero Section

[Live Preview toggle]: [👁 Preview on Website ↗]

┌─────────────────────────────────────────────────────────────┐
│  HERO CONTENT                                               │
├─────────────────────────────────────────────────────────────┤
│  Hero Badge Text                                            │
│  [Input]: "Est. 2005 · Accredited Institution"              │
│                                                             │
│  Main Heading Line 1 *                                      │
│  [Input]: "Nurturing Royalty."                              │
│                                                             │
│  Main Heading Line 2 *                                      │
│  [Input]: "Inspiring Excellence."                           │
│  [Italic word selector]: Which word should be italic?       │
│  [Radio: Line 1 | Line 2 | Both | None]                    │
│                                                             │
│  Subtitle / Tagline *                                       │
│  [Textarea, 2 rows]: "Royal Ark College equips..."          │
│                                                             │
│  Primary CTA Button                                         │
│  Label: [Input] "Apply Now"    URL: [Input] "/apply.html"   │
│                                                             │
│  Secondary CTA Button                                       │
│  Label: [Input] "Explore Programs"  URL: [Input]            │
│                                                             │
│  Background Style                                           │
│  [Radio]: ● Gradient (default) | ○ Image + overlay         │
│  [if Image]: [Upload hero background image]                 │
│              [Overlay opacity: ─────●─── 60%]              │
│                                                             │
│  [💾 Save Changes]      [Preview Changes ↗]                │
└─────────────────────────────────────────────────────────────┘
```

**On Save:** Toast → "✅ Hero section updated. Changes are live."

---

#### 4C — Stats Bar Editor (`admin/content/stats.html`)

```
[H2]: Homepage Stats Bar

┌────────────────────────────────────────────────┐
│  Stat 1                                        │
│  Label: [Input] "Students"                     │
│  Value: [Number input] 1200                    │
│  Suffix: [Input] "+"                           │
│  Prefix: [Input] (leave blank if none)         │
├────────────────────────────────────────────────┤
│  Stat 2                                        │
│  Label: [Input] "Staff"                        │
│  Value: [Number input] 80                      │
│  Suffix: [Input] "+"                           │
├────────────────────────────────────────────────┤
│  Stat 3  ...  │  Stat 4  ...                   │
└────────────────────────────────────────────────┘

[+ Add Stat]   (max 4)
[💾 Save]
```

---

#### 4D — About Snippet Editor (`admin/content/about-snippet.html`)

```
Heading *
[Input]: "A Legacy of Academic Royalty"

Italic word override
[Input]: (which word gets em tag)

Body Paragraphs
[Rich Text Editor — Summernote or Quill]
(limited toolbar: Bold, Italic, Link, Paragraph only)

Feature Pills (up to 6)
[Pill 1]: [Icon emoji ▾] [Text input]   [Remove ×]
[Pill 2]: [Icon emoji ▾] [Text input]   [Remove ×]
[+ Add Feature Pill]

CTA Button
Label: [Input]   Link: [Select from pages ▾]

[💾 Save]
```

---

#### 4E — Programs / Levels Editor (`admin/content/programs.html`)

```
[H2]: Programs & Levels

┌────────────────────────────────────────────────────┐
│  [Card 1]: Creche & Nursery                        │
│  ─────────────────────────────────────────────     │
│  Icon:  [Emoji picker: 🧸]                         │
│  Title: [Input]                                    │
│  Age Range: [Input] "Ages 1–4"                     │
│  Description: [Textarea]                           │
│  CTA Link: [Input]                                 │
│  Visible: [Toggle ●]                               │
│  [Collapse ▲]                                      │
└────────────────────────────────────────────────────┘
  (repeat for Primary, JSS, SSS — drag to reorder)

[+ Add Level Card]
[💾 Save All]
```

Drag-to-reorder: handle icon `⠿` on left of each card.

---

#### 4F — Why Choose Us Editor (`admin/content/why-choose-us.html`)

```
Section Heading: [Input]

Feature Items (up to 8, drag to reorder):
┌──────────────────────────────────────────────┐
│  ⠿  Item 1                                   │
│     Icon: [🎓]   Title: [Input]              │
│     Description: [Textarea]                  │
│     [Remove]  [Collapse ▲]                   │
└──────────────────────────────────────────────┘

[+ Add Feature]
[💾 Save]
```

---

#### 4G — Testimonials Manager (`admin/content/testimonials.html`)

**List view:**
```
┌──────────────────────────────────────────────────────────┐
│ ★★★★★  "Royal Ark gave my son the foundation..."       │
│ — Mrs. Chioma Adeyemi, Parent                           │
│ Status: [Visible ●]    [Edit] [Hide] [Delete]           │
├──────────────────────────────────────────────────────────┤
│ ★★★★★  "The teachers here are exceptional..."          │
│ — Mr. Emeka Obi, Parent                                 │
│ Status: [Hidden ○]     [Edit] [Show] [Delete]           │
└──────────────────────────────────────────────────────────┘

[+ Add Testimonial]
```

**Add/Edit Testimonial Modal:**
```
┌────────────────────────────────────┐
│  Add Testimonial              [✕] │
│  ────────────────────────────────  │
│  Author Name *                    │
│  [Input]                          │
│                                   │
│  Author Role / Description        │
│  [Input] "Parent · JSS2"          │
│                                   │
│  Star Rating *                    │
│  [★ ★ ★ ★ ★] (clickable stars)   │
│                                   │
│  Testimonial Text *               │
│  [Textarea, max 280 chars]        │
│  [Character counter: 180/280]     │
│                                   │
│  Avatar Initial (auto-generated)  │
│  or [Upload Photo]                │
│                                   │
│  Show on Website                  │
│  [Toggle ●]                       │
│                                   │
│  [Cancel]   [💾 Save Testimonial] │
└────────────────────────────────────┘
```

---

#### 4H — Gallery Manager (`admin/content/gallery.html`)

**Top bar:**
```
[H2]: Media Gallery
[Upload button ▲]  [Filter: All | Photos | Videos]  [Category ▾]
```

**Upload Zone:**
```
┌─────────────────────────────────────────────────┐
│                                                 │
│  📤  Drag & drop photos or videos here          │
│      or [Browse Files]                          │
│                                                 │
│  Accepted: JPG, PNG, MP4, MOV · Max 20MB each  │
│                                                 │
└─────────────────────────────────────────────────┘
```

**Upload progress (during upload):**
```
[File name.jpg] ████████████░░ 80%  [✕ Cancel]
```

**Media grid:**
```
┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐
│ [Photo] │ │ [Photo] │ │ ▶ Video │ │ [Photo] │
│ ☐       │ │ ☐       │ │ ☐       │ │ ☐       │
│ [✏️][🗑]│ │ [✏️][🗑]│ │ [✏️][🗑]│ │ [✏️][🗑]│
└─────────┘ └─────────┘ └─────────┘ └─────────┘
```

Click on media item: opens **Lightbox**:
```
[← Prev]  [Full image / Video player]  [Next →]

[Caption field — editable inline]:
"Students during the 2024 Cultural Day"

[Category: Dropdown — Academic / Sports / Events / Facilities]

[Visible on site: Toggle]

[Download original]  [Delete]  [Close ✕]
```

Bulk select: checkbox per item → bulk actions bar appears:
```
[12 selected]  [Set Category ▾]  [Hide All]  [Delete All]
```

---

#### 4I — Footer Info Editor (`admin/content/footer.html`)

```
School Name: [Input]
Tagline / Motto: [Input]
About Text (short): [Textarea, max 200 chars]

Address *: [Textarea]
Phone 1 *: [Input]
Phone 2: [Input]
Email *: [Input]
Office Hours: [Input] "Mon–Fri: 8am–5pm, Sat: 9am–1pm"

Social Media Links:
  Facebook: [URL input]
  Instagram: [URL input]
  YouTube: [URL input]
  WhatsApp: [Phone/URL input]

Copyright Year: [Number input] 2025
Copyright Name: [Input] "Royal Ark College"

[💾 Save Footer Info]
```

---

### PAGE 5: Events Management (`admin/events/`)

#### 5A — All Events (`index.html`)

```
[H1]: Events
[Right]: [+ Create Event]

[Filter]: [All] [Upcoming] [Past] | [Category ▾]

Table:
┌──────┬─────────────────────────┬────────────┬──────────┬──────────────┐
│ Date │ Event Title             │ Category   │ Venue    │ Actions      │
├──────┼─────────────────────────┼────────────┼──────────┼──────────────┤
│DEC14 │ Prize Giving Day        │ Annual     │Main Hall │ [Edit][View] │
│JAN 6 │ Third Term Resumption   │ Academic   │ All      │ [Edit][•••]  │
└──────┴─────────────────────────┴────────────┴──────────┴──────────────┘
```

Date column: `DD MMM` format, bold, amber colored.
Past events: row slightly dimmed (opacity 0.6).

---

#### 5B — Create / Edit Event (`create.html` / `edit.html`)

```
[H2]: Create New Event

BASIC INFO
──────────────────────────────────────────────────────
Event Title *
[Input]

Category *
[Select: Academic / Sports / Cultural / Annual / Other]

Date *             Time *
[Date picker]      [Time picker]

End Date           End Time (optional)
[Date picker]      [Time picker]

Venue *
[Input]

Description *
[Rich text editor — Quill, full toolbar]

BANNER IMAGE
──────────────────────────────────────────────────────
[Upload zone — image only, 1200×600 recommended]
[or keep placeholder — shows emoji on public site]

RSVP SETTINGS
──────────────────────────────────────────────────────
Allow RSVP:  [Toggle]
(if on) RSVP Deadline: [Date picker]
(if on) Max Attendees: [Number input]

VISIBILITY
──────────────────────────────────────────────────────
Show on website: [Toggle ●]
Feature as "Next Major Event": [Toggle]

[Cancel]   [💾 Save Event]   [Preview →]
```

---

### PAGE 6: Blog / News Management (`admin/blog/`)

#### 6A — All Posts (`index.html`)

```
[H1]: Blog & News Posts
[Right]: [+ New Post]

[Filter]: [All] [Published] [Draft] [Scheduled] | [Category ▾]

Table:
┌───────────────────────────────┬────────────┬─────────────┬────────────┬──────────┐
│ Title                         │ Category   │ Author      │ Date       │ Status   │
├───────────────────────────────┼────────────┼─────────────┼────────────┼──────────┤
│ FDCMCS Bulk Purchase...       │ School News│ Mrs. Ade    │ Jan 10     │ ✅ Live  │
│ New School Calendar for...    │ Academic   │ Mr. Tunde   │ Jan 8      │ 📝 Draft │
│ Prize Giving Day 2025...      │ Events     │ Mrs. Ade    │ Scheduled  │ ⏰ Sched │
└───────────────────────────────┴────────────┴─────────────┴────────────┴──────────┘
```

Row hover: subtle bg + actions appear (edit, preview, delete).

---

#### 6B — Post Editor (`new.html` / `edit.html`)

**Two-column editor layout:**

**Left (main, 2/3):**
```
Post Title *
[Large input — Outfit 1.2rem, placeholder: "Post title..."]

Slug (auto-generated, editable)
[Input — monospace]: /news/prize-giving-day-2025

Featured Image
[Upload zone — wide, 16:9]
[Alt text input below]

Body Content *
[Rich text editor — Quill full toolbar]:
  Heading / Sub / Body / Bold / Italic / Link / Image / Quote /
  Unordered List / Ordered List / Code Block / Horizontal Rule
[Character/word count below editor]
```

**Right (sidebar, 1/3 — sticky):**
```
┌─────────────────────────────┐
│  PUBLISH                    │
│  ─────────────────────────  │
│  Status:   [Draft ▾]        │  select: Draft / Publish / Schedule
│  (if Schedule): Date/Time   │
│  Visibility: [Public ▾]     │  Public / Unlisted
│                             │
│  [Save Draft]               │
│  [Publish Now]              │
│                             │
│  CATEGORIES                 │
│  ─────────────────────────  │
│  ☐ School News              │
│  ☑ Academic                 │
│  ☐ Events                   │
│  ☐ Achievements             │
│  [+ Add Category]           │
│                             │
│  TAGS                       │
│  ─────────────────────────  │
│  [Tag input — comma sep.]   │
│                             │
│  SEO PREVIEW                │
│  ─────────────────────────  │
│  Meta Title: [Input]        │
│  Meta Desc:  [Textarea]     │
│  [156/160 chars]            │
│                             │
│  [Preview Post ↗]           │
└─────────────────────────────┘
```

---

#### 6C — Categories (`categories.html`)

```
[H2]: Post Categories

┌──────────────────┬──────────────────┬──────────┐
│ Category Name    │ Post Count       │ Actions  │
├──────────────────┼──────────────────┼──────────┤
│ School News      │ 12               │ [Edit][🗑]│
│ Academic         │ 8                │ [Edit][🗑]│
│ Sports           │ 5                │ [Edit][🗑]│
└──────────────────┴──────────────────┴──────────┘

[+ Add Category]:
[Name input]  [Slug input — auto]  [Add button]
```

---

### PAGE 7: School Settings (`admin/settings/`)

#### 7A — General Settings (`general.html`)

**Tabs across top:** [General] [Admissions] [Accounts] [Security]

```
SCHOOL IDENTITY
──────────────────────────────────────────────────────
School Full Name *
[Input]: "Royal Ark College"

School Short Name
[Input]: "RAC"

Official Motto *
[Input]: "Royalty in Excellence"

Year Established
[Number input]: 2005

School Logo
[Upload zone — square, PNG preferred, max 2MB]
[Current logo preview]

CONTACT & LOCATION
──────────────────────────────────────────────────────
Official Address * (multi-line)
[Textarea]

Primary Phone *          Secondary Phone
[Input]                  [Input]

Official Email *
[Input]

WhatsApp Number
[Input]

Office Hours
[Input]: "Mon–Fri: 8:00am–5:00pm"

[💾 Save General Settings]
```

---

#### 7B — Admissions Settings (`admissions-settings.html`)

```
CURRENT SESSION
──────────────────────────────────────────────────────
Academic Session *
[Input]: "2025/2026"

Admissions Status
[Large toggle]: ● OPEN / CLOSED

Application Opens:    Application Closes:
[Date picker]         [Date picker]

CLASSES ACCEPTING APPLICATIONS
──────────────────────────────────────────────────────
[Toggle row per class]:
  Creche         [●]
  Nursery 1      [●]
  Nursery 2      [●]
  Primary 1      [●]
  ...
  JSS 1          [●]
  ...
  SSS 1          [○]   ← closed (no vacancy)

NOTIFICATION SETTINGS
──────────────────────────────────────────────────────
Auto-send confirmation email to applicant:  [Toggle ●]
Notify admin on new application:            [Toggle ●]
Admin notification email: [Input]

[💾 Save Admissions Settings]
```

---

#### 7C — Admin Accounts (`accounts.html`)

```
[H2]: Admin Accounts

Table:
┌────────────────┬───────────┬──────────────┬────────────┬──────────┐
│ Name           │ Role      │ Email        │ Last Login │ Actions  │
├────────────────┼───────────┼──────────────┼────────────┼──────────┤
│ Mrs. Adeyemi   │ Super Admin│ …@royalark  │ Today      │ [Edit]   │
│ Mr. Tunde O.   │ Staff      │ …@royalark  │ 2 days ago │ [Edit][🗑]│
│ Ms. Ngozi B.   │ Bursar     │ …@royalark  │ 1 week ago │ [Edit][🗑]│
└────────────────┴───────────┴──────────────┴────────────┴──────────┘

[+ Add Admin Account]
```

**Add/Edit Account Modal:**
```
Full Name *      Email *
[Input]          [Input]

Role *
[Select: Super Admin / Content Manager / Admissions Officer / Viewer]

Temporary Password *
[Input]  [Generate Password]

[Send welcome email]  [Toggle ●]

[Cancel]   [Create Account]
```

---

## 5. SHARED COMPONENT LIBRARY

### 5.1 Modal System

**Base structure:**
```
[Backdrop — rgba dark, blur(6px)]
┌────────────────────────────────────┐
│  [Modal Header]                    │
│  Title             [✕ Close]       │
├────────────────────────────────────┤
│  [Modal Body]                      │
│  Content here                      │
├────────────────────────────────────┤
│  [Modal Footer]                    │
│  [Cancel]  [Primary Action]        │
└────────────────────────────────────┘
```

**Sizes:** `modal-sm` (400px) · `modal-md` (560px) · `modal-lg` (720px) · `modal-xl` (920px)

**Types:**
- Standard (white bg)
- Confirm Danger (red header stripe, red primary button)
- Confirm Warning (amber header stripe)
- Fullscreen (gallery lightbox)

**Animations:**
- Backdrop: fade in
- Modal: scale(0.94) + translateY(16px) → scale(1) + translateY(0)
- Close: reverse animation

**Keyboard:**
- Escape → close
- Tab trapped inside modal while open
- First focusable element auto-focused on open

---

### 5.2 Toast Notification System

**Position:** Bottom-right, stack upward (max 4 visible).

**Types:**
```
✅ Success  — green left border, check icon
⚠️ Warning  — amber left border, triangle icon
❌ Error    — red left border, X icon
ℹ️ Info     — blue left border, info icon
```

**Anatomy:**
```
┌──────────────────────────────────────────┐
│ ✅  Hero section updated successfully.   │  ← [✕] dismiss
│     Changes are live on the website.    │
└──────────────────────────────────────────┘
```

**Behavior:**
- Auto-dismiss: 4 seconds (success/info), 6 seconds (warning/error)
- Progress bar at bottom of toast shows time remaining
- Hover pauses timer
- Manual dismiss via ✕ button
- Max 4 stacked; oldest auto-removes when 5th appears

---

### 5.3 Alert / Inline Banners

For page-level feedback (not dismissible toasts):

```
SUCCESS:
┌──────────────────────────────────────────────────────┐
│ ✅  Application approved. Email sent to parent.      │  [✕]
└──────────────────────────────────────────────────────┘

WARNING:
┌──────────────────────────────────────────────────────┐
│ ⚠️  Admissions close in 3 days. Reminder set.       │  [✕]
└──────────────────────────────────────────────────────┘

ERROR:
┌──────────────────────────────────────────────────────┐
│ ❌  Could not send email. Check SMTP settings.       │  [✕]
└──────────────────────────────────────────────────────┘

INFO:
┌──────────────────────────────────────────────────────┐
│ ℹ️  Changes saved as draft. Not yet visible to public│  [Publish]  [✕]
└──────────────────────────────────────────────────────┘
```

---

### 5.4 Confirm Dialog

Used for destructive or irreversible actions (delete, reject, close admissions):

```
┌──────────────────────────────────────┐
│  ⚠️ Confirm Action              [✕] │
│  ──────────────────────────────────  │
│  Are you sure you want to delete    │
│  "Prize Giving Day 2025"?           │
│                                     │
│  This action cannot be undone.      │
│                                     │
│  [Cancel]     [🗑 Delete Post]      │  ← danger button
└──────────────────────────────────────┘
```

---

### 5.5 Table System (Responsive)

**Desktop:** standard horizontal table with fixed-height rows.

**Mobile strategy — no horizontal scroll:**
Instead of overflow-x scroll, each row becomes a **card** on mobile:

```
Mobile row card:
┌──────────────────────────────────┐
│  Chidi Emmanuel Obi              │ ← primary column (always)
│  RAC-2025-0042                   │
│  ───────────────────────────── │
│  Class:    JSS 1                │
│  Parent:   Mr. Obi              │
│  Date:     Jan 10, 2025         │
│  Status:   🟠 Pending           │
│  ───────────────────────────── │
│  [View Details]  [Approve] [✕] │
└──────────────────────────────────┘
```

**Implementation:** CSS `@media` switches from `<table>` display to stacked key-value list using `data-label` attributes + pseudo-elements.

**Sortable columns:**
- Click header → sorts ascending (↑ icon appears)
- Click again → descending (↓ icon)
- Third click → back to default
- Only one column sorted at a time

**Selection:**
- Header checkbox → select/deselect all visible
- Row checkbox → individual select
- Selected rows: highlighted row bg (amber ghost)
- Bulk action bar slides in from bottom

---

### 5.6 Image Lightbox (Gallery admin)

```
[Backdrop: rgba(10,4,20,0.96), blur(8px)]

[← Prev Arrow]   [Image / Video (max 90vw × 85vh)]   [Next → Arrow]

Below image:
[Caption — editable inline (click to edit)]
[Category badge]   [Date uploaded]

Right panel (slides in):
  [File name]
  [Dimensions: 1920×1080]
  [File size: 2.4 MB]
  [Category: ▾ dropdown]
  [Visible on site: Toggle]
  [Download ↓]   [Delete 🗑]

[Keyboard: ← → arrows, Escape to close]
[Touch: swipe left/right]
```

---

### 5.7 Rich Text Editor (Quill/Summernote)

Toolbar configuration for blog posts:
```
[H1][H2][H3] | [B][I][U][S] | [" Quote] | [Link][Image][Video]
[• List][1. List] | [Align ▾] | [Color ▾] | [Code] | [HR] | [Clear]
```

Toolbar for shorter content (about snippet, hero description):
```
[B][I][U] | [Link] | [• List]
```

Character/word counter below editor (where applicable).

---

### 5.8 Status Badge Component

```
Reusable .status-badge with variants:

.status-open        → 🟢 green pill
.status-pending     → 🟠 amber pill
.status-review      → 🔵 blue pill
.status-rejected    → 🔴 red pill
.status-waitlisted  → 🟣 purple pill
.status-draft       → ⚫ grey pill
.status-published   → 🟢 green pill
.status-scheduled   → 🕐 blue-grey pill
.status-hidden      → ○ dashed border pill
```

Each has: colored dot prefix + label text + light bg.

---

### 5.9 Empty States

For tables/lists with no data:

```
[Centered, padded area]:

  [Icon — large, muted, contextual]
      📋  (admissions) / 💬 (enquiries) / 📰 (blog)

  [H4]: No applications yet
  [P]:  When students submit applications, they'll appear here.

  [Action CTA if applicable]:
  [Share Application Link] or [Write First Post]
```

---

### 5.10 Skeleton Loaders

Used while async content loads (if JS fetch is used):

```
[Pulsing grey placeholder bars]:

┌─────────────────────────────────────┐
│  ████████████ ░░░░░░░░              │
│  ████████████████████ ░░░░░░        │  ← shimmer animation
│  █████████ ░░░░░░░░░░░░░░░          │
└─────────────────────────────────────┘
```

Animation: `linear-gradient` slides left to right continuously.

---

### 5.11 Emoji / Icon Picker (for content editing)

Small inline picker triggered by clicking emoji field:
```
┌──────────────────────────────────────┐
│  [Search emoji…]                     │
│  ──────────────────────────────────  │
│  Recent: 🎓 📚 🔬 🎨 ⚽ 🧸         │
│  ──────────────────────────────────  │
│  🎓 🏫 📚 🔬 🎨 ⚽ 🧸 💻 🌍        │
│  🏆 👑 ✨ 🔒 🤝 📊 🌱 🏥 🎵       │
└──────────────────────────────────────┘
```

---

### 5.12 Date & Time Pickers

- Date: native `<input type="date">` styled to match design system
- Time: native `<input type="time">` styled
- Date range: two date inputs with "to" separator
- Scheduled post: combined datetime-local picker

---

### 5.13 Toggle Switch

```
Default (OFF):   ○────── grey track, white knob
Active (ON):     ──────● amber/green track, white knob

Sizes: sm (32px) | md (40px) | lg (48px — for Admissions Status)

States: normal / hover (brighter) / disabled (faded)
```

Animation: knob slides smoothly (0.25s cubic-bezier spring).

---

### 5.14 Progress & Upload

```
Upload progress bar:
[File name.jpg]  ████████████████░░░░  80%  [Cancel]

File size warning:
If >20MB → red outline + error message before upload attempt

Drag-over state:
Dashed border → amber dashed border + bg tint + icon scales up
```

---

## 6. FILE STRUCTURE (Admin)

```
royal-ark/
├── admin/
│   ├── index.html              ← redirect to dashboard or login
│   │
│   ├── auth/
│   │   ├── login.html
│   │   ├── forgot-password.html
│   │   └── reset-password.html
│   │
│   ├── dashboard.html
│   │
│   ├── admissions/
│   │   ├── index.html          ← all applications
│   │   └── detail.html         ← single application
│   │
│   ├── enquiries/
│   │   └── index.html          ← all enquiries (split-pane)
│   │
│   ├── content/
│   │   ├── index.html          ← content hub overview
│   │   ├── hero.html
│   │   ├── about-snippet.html
│   │   ├── programs.html
│   │   ├── why-choose-us.html
│   │   ├── testimonials.html
│   │   ├── stats.html
│   │   ├── gallery.html
│   │   └── footer.html
│   │
│   ├── events/
│   │   ├── index.html
│   │   └── editor.html         ← create + edit (same template, pre-fill for edit)
│   │
│   ├── blog/
│   │   ├── index.html
│   │   ├── editor.html         ← create + edit
│   │   └── categories.html
│   │
│   └── settings/
│       ├── general.html
│       ├── admissions.html
│       └── accounts.html
│
├── css/
│   ├── main.css                ← landing design system (existing)
│   ├── home.css                ← homepage specific (existing)
│   └── admin.css               ← admin design system
│
└── js/
    ├── main.js                 ← landing JS (existing)
    └── admin.js                ← admin JS
```

---

## 7. ADMIN CSS & JS ARCHITECTURE

### 7.1 `css/admin.css` — What it covers
```
• CSS variables (admin-specific overrides)
• Sidebar layout + collapsed state + mobile drawer
• Topbar styles
• Content canvas base
• All admin component styles:
  - Tables (desktop + mobile card transform)
  - Forms (label-above style, tight spacing)
  - Modals (all sizes + types)
  - Toasts (stack system)
  - Alerts (inline banners)
  - Status badges (all variants)
  - Toggle switches (all sizes)
  - Upload zones + progress bars
  - Skeleton loaders
  - Stat cards
  - Lightbox overlay
  - Rich text editor overrides
  - Empty states
• Admin-specific typography scale
• Responsive breakpoints (mobile-first, all transforms)
```

### 7.2 `js/admin.js` — What it covers
```
• Sidebar: toggle collapse/expand, mobile drawer, overlay, localStorage state
• Subnav: accordion expand/collapse, active state from URL
• Topbar: active breadcrumb generation from URL
• Notification dropdown: open/close, mark as read
• Modal system: open(id), close(id), closeAll(), keyboard/backdrop dismiss
• Toast system: show(msg, type, duration), auto-dismiss, progress bar
• Table system:
  - Checkbox select (individual + master)
  - Bulk action bar show/hide
  - Column sort (client-side for small datasets)
  - Mobile card transform
• Confirm dialog: confirmAction(msg, onConfirm, type)
• Upload zones: drag-over states, file validation, progress simulation
• Toggle switches: change event + confirm if needed (admissions toggle)
• Rich text editor: init Quill instances
• Scroll to top
• Admissions toggle: open confirm modal before changing state
• Form validation: inline real-time + submit guard
• Lightbox: open(src, items), prev/next, keyboard, swipe
• Active sidebar item detection from URL
• Collapsible cards (content editor sections)
• Drag-to-reorder (programs, features — using SortableJS CDN)
```

---

## 8. RESPONSIVE BEHAVIOR SUMMARY

| Component         | Mobile (< 768px)                          | Tablet (768–1024px)              | Desktop                     |
|---|---|---|---|
| Sidebar           | Hidden, slide-in drawer overlay           | Collapsed (icons only)           | Expanded (260px)            |
| Topbar            | Logo visible, hamburger                   | Full topbar                      | Full topbar                 |
| Stat cards        | 2-col grid                                | 2-col or 4-col                   | 4-col row                   |
| Tables            | Stacked card per row, no scroll           | 2-col card or reduced columns    | Full horizontal table       |
| Modal             | Full-screen (100vw, 100dvh)              | Centered, max 90vw               | Centered, fixed max-width   |
| Toast             | Bottom-center, full-width                 | Bottom-right                     | Bottom-right                |
| Content editors   | Single column, all fields stacked         | Single column                    | 2-col (main + sidebar)      |
| Gallery grid      | 2-col                                     | 3-col                            | 4-col                       |
| Enquiry split     | List only → tap → detail (full screen)    | 30/70 split or stacked           | 33/67 split pane            |
| Lightbox          | Full screen, swipe navigation             | Full screen                      | Centered with side panel    |

---

## 9. IMPLEMENTATION PRIORITY ORDER (Admin)

**Phase A — Shell & Auth (build first):**
1. `css/admin.css` — full admin design system
2. `js/admin.js` — core JS (sidebar, modal, toast, table, form)
3. `auth/login.html` — login page
4. `auth/forgot-password.html`
5. `dashboard.html` — main dashboard

**Phase B — Core Operations:**
6. `admissions/index.html` — applications list
7. `admissions/detail.html` — application detail
8. `enquiries/index.html` — enquiry manager

**Phase C — Content Management:**
9. `content/index.html` — content hub
10. `content/hero.html` + `stats.html` (simple fields)
11. `content/testimonials.html` + `content/gallery.html`
12. `content/programs.html` + `content/why-choose-us.html`
13. `content/about-snippet.html` + `content/footer.html`

**Phase D — Blog & Events:**
14. `events/index.html` + `events/editor.html`
15. `blog/index.html` + `blog/editor.html`
16. `blog/categories.html`

**Phase E — Settings:**
17. `settings/general.html`
18. `settings/admissions.html`
19. `settings/accounts.html`

---

*Blueprint prepared for Royal Ark College Admin Dashboard*
*"Royalty in Excellence" · Internal Management System*
*Version 1.0*
