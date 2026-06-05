# Royal Ark College — Landing Pages UI Blueprint
**"Royalty in Excellence"**

---

## 1. BRAND & DESIGN SYSTEM

### 1.1 Color Palette

The palette draws from the school's orange-and-purple identity, treated with restraint and sophistication — deep jewel tones as the backbone, warm amber-gold as the prestige accent, and clean neutrals for breathing room.

```
/* Primary — Deep Royal Purple */
--royal:         #3D1A6E   /* dominant brand color */
--royal-mid:     #5B2D9E   /* hover states, accents */
--royal-light:   #7C4DBF   /* subtle tints */
--royal-pale:    #EDE4F9   /* backgrounds, cards */
--royal-ghost:   #F7F3FD   /* page background tints */

/* Accent — Warm Amber / Burnt Orange */
--amber:         #C85A00   /* CTA buttons, badges, key highlights */
--amber-mid:     #E06B10   /* hover */
--amber-light:   #F5892E   /* soft accents */
--amber-pale:    #FFF0E4   /* warm tinted backgrounds */
--amber-gold:    #F4C240   /* decorative gold, star ratings */

/* Neutrals */
--ink:           #1A1025   /* near-black with purple undertone */
--text-dark:     #2D1F40   /* body headings */
--text-mid:      #5A4F6B   /* body copy */
--text-light:    #8B7FA0   /* captions, meta */
--text-muted:    #B0A8C0   /* placeholder, disabled */

/* Surfaces */
--white:         #FFFFFF
--cream:         #FAF8FC   /* slight purple tint on off-white */
--cream-2:       #F3EEFA
--border:        #E4D9F5
--border-dark:   #C8B8E0

/* Status */
--success:       #1A7A4A
--success-bg:    #D4F5E4
--warning:       #B56B00
--warning-bg:    #FDEFD6
--danger:        #B52B2B
--danger-bg:     #FDE4E4
--info:          #1A5C99
--info-bg:       #D6ECFF

/* Shadows */
--shadow-xs:  0 1px 4px rgba(61,26,110,0.07);
--shadow-sm:  0 3px 12px rgba(61,26,110,0.10);
--shadow-md:  0 6px 24px rgba(61,26,110,0.14);
--shadow-lg:  0 12px 48px rgba(61,26,110,0.18);
--shadow-xl:  0 24px 80px rgba(61,26,110,0.22);
```

---

### 1.2 Typography

```
/* Display — editorial, prestigious */
--font-display: 'Cormorant Garamond', Georgia, serif;
/* Used for: page titles, hero headings, section titles, pull quotes */

/* Heading — clean authority */
--font-heading: 'Outfit', sans-serif;
/* Used for: card titles, navbar links, sub-headings, labels */

/* Body — highly readable */
--font-body: 'Source Serif 4', Georgia, serif;
/* Used for: paragraphs, descriptions, body copy */

/* Mono / Labels */
--font-label: 'Outfit', sans-serif;
/* Used for: badges, form labels, stat labels, nav labels */
```

**Scale:**
```
--text-xs:    0.7rem      /* badges, fine print */
--text-sm:    0.8rem      /* captions, meta */
--text-base:  0.9rem      /* body paragraphs */
--text-md:    1rem        /* sub-headings */
--text-lg:    1.15rem     /* card titles */
--text-xl:    1.4rem      /* section sub-headings */
--text-2xl:   1.85rem     /* section titles */
--text-3xl:   2.5rem      /* page hero headings */
--text-4xl:   3.5rem      /* homepage hero */
--text-hero:  clamp(3.2rem, 7vw, 6rem)  /* main hero */
```

---

### 1.3 Layout System

```
--nav-h:        72px
--radius-xs:    4px
--radius-sm:    8px
--radius-md:    14px
--radius-lg:    20px
--radius-xl:    28px
--radius-pill:  999px
--section-pad:  96px 0      /* desktop */
--section-pad-sm: 64px 0   /* tablet */
--section-pad-xs: 48px 0   /* mobile */
--container:    1200px
--container-sm: 880px
```

---

### 1.4 Motion & Animation

```
/* Transitions */
--ease:         cubic-bezier(0.25, 0.46, 0.45, 0.94)
--ease-spring:  cubic-bezier(0.34, 1.56, 0.64, 1)
--ease-in:      cubic-bezier(0.4, 0, 1, 1)
--duration-fast:   150ms
--duration-base:   250ms
--duration-slow:   450ms
--duration-reveal: 700ms
```

**Animation library (CSS classes):**
- `.fade-up` — translate Y 24px → 0, opacity 0 → 1
- `.fade-in` — opacity 0 → 1
- `.slide-right` — translate X -32px → 0, opacity 0 → 1
- `.slide-left` — translate X 32px → 0, opacity 0 → 1
- `.scale-in` — scale 0.92 → 1, opacity 0 → 1
- `.reveal` — intersection observer triggered, adds `.is-visible` class
- `.stagger-1` through `.stagger-5` — animation-delay multipliers
- `.hover-lift` — translateY(-4px) on hover
- `.hover-glow` — box-shadow pulse on hover

---

### 1.5 Shared UI Elements

**Badge types:**
- `.badge-royal` — purple bg/text (academic programs, labels)
- `.badge-amber` — amber bg/text (admissions open, CTA labels)
- `.badge-success` — green (verified, approved)
- `.badge-pill` — fully rounded
- `.badge-dot` — colored dot prefix

**Button system:**
- `.btn-primary` — amber fill, white text, `--radius-pill`, shadow
- `.btn-royal` — royal purple fill, white text
- `.btn-outline` — transparent, royal border, royal text
- `.btn-outline-white` — white border + text (on dark backgrounds)
- `.btn-ghost` — no border, royal text
- `.btn-gold` — gold/amber gradient, prestige CTA
- `.btn-sm` / `.btn-md` / `.btn-lg`
- Hover: lift + glow effect on primaries; border-fill transition on outlines

---

## 2. NAVIGATION ARCHITECTURE

### 2.1 Primary Navbar Strategy

**Desktop:** Sticky navbar, transparent on hero sections (transitions to solid on scroll), solid on interior pages.

**Structure:**
```
[Logo + School Name]  [Nav Links]  [CTA Buttons]  [Hamburger — mobile only]
```

**Nav Links (5 items + 1 dropdown):**

| Link | Type | Behavior |
|---|---|---|
| Home | Direct | `index.html` |
| About | Direct | `about.html` (single comprehensive page) |
| Academics | Direct | `academics.html` (single comprehensive page) |
| Admissions | Direct | `admissions.html` + Apply Now is separate CTA |
| Community | **Dropdown** | Sub-links: Events / News / Gallery |
| Contact | Direct | `contact.html` |

**CTA Area (far right):**
- `Apply Now` → `apply.html` — amber primary button
- `Staff Login` → small ghost/outline link (subtle, no distraction)

**Community Dropdown (mega-mini style):**
```
┌─────────────────────────────────┐
│  📅  Events     Latest & upcoming│
│  📰  News       School updates   │
│  🖼️  Gallery    Photos & videos  │
└─────────────────────────────────┘
```
Dropdown has icon + label + description per item. Soft royal-pale background, border, subtle shadow.

---

### 2.2 Mobile Navigation

- Hamburger (animated 3-bar → X)
- Full-screen slide-in drawer from right (or top push-down)
- All 6 links stacked vertically
- Community section expanded with 3 sub-links (no accordion, always visible in mobile)
- `Apply Now` button full-width at bottom of drawer (amber, prominent)
- `Staff Login` as small link below

---

### 2.3 Footer Navigation (All Links)

The footer displays all links regardless of nav hierarchy — no hiding.

**Footer columns:**
1. **School Info** — logo, tagline, address, phone, email, social icons
2. **Quick Links** — Home, About, Academics, Admissions, Contact
3. **Community** — Events, News, Gallery, Apply Now
4. **Academics** — Programs, Curriculum, Academic Calendar, School Fees
5. **Newsletter** — Email signup input + subscribe button

---

## 3. PAGE-BY-PAGE BLUEPRINT

---

### PAGE 1: Home (`index.html`)

**Purpose:** First impression, emotional hook, route visitors to the right section.

---

#### Section 1 — Navbar
*(See Section 2 above — transparent on this page, transitions to solid on scroll)*

---

#### Section 2 — Hero
**Layout:** Full-viewport height, rich layered background.

**Background treatment:**
- Deep royal-to-amber diagonal gradient mesh
- Subtle geometric pattern overlay (crown/arch motifs, very low opacity)
- Optional: CSS particle/floating-orb animation (3–4 soft glowing orbs)

**Content (centered or left-aligned):**
```
[Animated badge: "Est. 2005 · Accredited Institution"]
[H1 — hero font]: Nurturing Royalty.
                  Inspiring Excellence.
[Tagline]: Royal Ark College equips every student — from Creche through
           Secondary — with the character, knowledge, and ambition to lead.
[Motto badge]: "Royalty in Excellence"
[CTA row]:  [Apply Now →]  [Explore Our Programs]
[Scroll indicator]: animated chevron / line scroll hint
```

**Below hero fold — Stats Bar:**
```
┌──────────────────────────────────────────────────────────┐
│  🎓 1,200+ Students  │  👨‍🏫 80+ Staff  │  📅 18 Yrs  │  🏆 95% Pass Rate  │
└──────────────────────────────────────────────────────────┘
```
Stat bar: amber-pale or white pill with subtle royal border, counter animation on scroll.

**Special Elements:**
- Staggered entrance animation: badge → H1 (line by line) → tagline → CTAs
- Hero image or school crest as floating decorative element (right side, slight parallax)
- Animated gradient background (slow shift between royal/amber hues)

---

#### Section 3 — Welcome / About Snippet
**Layout:** 2-col (image left, text right) — alternating on mobile to text-then-image.

```
[Image block]: School exterior or assembly photo (styled with border + offset shadow)
               Floating badge: "20+ Years of Excellence"

[Text block]:
  [Section label]: About Royal Ark College
  [H2]: A Legacy of Academic Royalty
  [Body]: 2–3 short paragraphs about school vision, values, levels offered
  [Feature pills]: ✓ Accredited  ✓ Experienced Faculty  ✓ Modern Facilities
  [CTA]: Learn Our Story →
```

**Special Elements:**
- Image has decorative corner frame in amber
- Scroll reveal: image slides from left, text slides from right
- Feature pills have hover border-fill animation

---

#### Section 4 — Programs / Levels Offered
**Layout:** Horizontal scroll on mobile, 4-col grid on desktop.

**Heading:**
```
[Section label]: What We Offer
[H2]: From First Steps to Final Exams
[Subtitle]: Royal Ark College spans every stage of a child's educational journey.
```

**Level Cards (4 cards):**
```
┌─────────────────┐
│   [emoji/icon]  │
│   Creche &      │
│   Nursery       │
│─────────────────│
│  Ages 1–4       │
│  Play-based     │
│  learning...    │
│                 │
│  Learn More →   │
└─────────────────┘
```
Cards: royal-pale bg, subtle royal border, `--radius-lg`, hover lifts + amber accent line appears on top.

**Cards:**
1. **Creche & Nursery** — Ages 1–4, icon 🧸
2. **Primary School** — Ages 5–11, icon 📚
3. **Junior Secondary** — JSS 1–3, icon 🔬
4. **Senior Secondary** — SSS 1–3, icon 🎓

**Special Elements:**
- Card top accent bar animates from 0 width to full on hover
- Icon has subtle bounce animation on hover

---

#### Section 5 — Admissions Status Banner
**Condition-driven visual block** (admin-controlled open/closed state).

**When OPEN:**
```
┌──────────────────────────────────────────────────────────────┐
│  🟢 Admissions Open — 2025/2026 Academic Session             │
│  We are now accepting applications for all classes.          │
│  Application closes: [Date]                                  │
│  [Apply Now →]   [View Requirements]                        │
└──────────────────────────────────────────────────────────────┘
```
Background: amber-pale with amber left border, animated pulsing green dot.

**When CLOSED:**
```
┌──────────────────────────────────────────────────────────────┐
│  📋 Admissions Closed — Next session opens [Month Year]      │
│  [Join the Waitlist / Get Notified]                         │
└──────────────────────────────────────────────────────────────┘
```
Background: cream-2 with muted border.

---

#### Section 6 — Why Choose Royal Ark
**Layout:** Feature grid, alternating icon + text tiles.

```
[H2]: The Royal Ark Difference
```

**6 features in 2-col grid (or 3-col on desktop):**
1. 👑 **Academic Excellence** — Consistent top results in WAEC/NECO examinations
2. 🏛️ **Modern Facilities** — Well-equipped laboratories, library, ICT centre
3. 👨‍🏫 **Experienced Faculty** — Qualified, dedicated teachers at every level
4. ⚽ **Holistic Development** — Sports, arts, clubs and extra-curricular activities
5. 🔒 **Safe Environment** — Secure campus, CCTV, pastoral care system
6. 🌍 **Values-Based Education** — Character formation alongside academic growth

**Special Elements:**
- Each feature tile has a hover state: royal-pale bg + amber icon
- Tiles stagger-animate into view on scroll

---

#### Section 7 — Gallery Preview / School Life
**Layout:** Asymmetric masonry grid, 5 placeholders.

```
[Section label]: School Life
[H2]: Royal Ark in Action
[Subtitle]: A glimpse into the vibrant community at Royal Ark College.

[Grid — 5 cells]:
  [Large cell (spans 2 rows)]: Main school life photo
  [2 smaller cells right side]
  [2 smaller cells bottom]
  [Overlay CTA on hover]: View Gallery →

[Bottom]: [View Full Gallery →] button
```

**Special Elements:**
- Hover on each cell: darkens + shows caption label + magnify icon
- One cell shows a video placeholder with play button overlay
- Subtle zoom-in animation on hover

---

#### Section 8 — Latest News & Events
**Layout:** 3-col grid — 1 featured (large) + 2 smaller.

```
[Section label]: Latest Updates
[H2]: News & Events

[Featured card — wider]:
  [Date badge]  [Category tag]
  [H3: Article title]
  [Preview text, 2 lines]
  [Read More →]

[2 Smaller cards]:
  Same structure, compact

[Bottom]: [All News →]  [All Events →]
```

**Special Elements:**
- Cards have amber left-border accent that slides up on hover
- Category tags styled as `.badge-royal` or `.badge-amber`

---

#### Section 9 — Testimonials
**Layout:** Carousel / slider (3 visible on desktop, 1 on mobile).

```
[Section label]: What Parents Say
[H2]: Voices from Our Community

[Testimonial card]:
  ★★★★★
  "Quote from parent/alumni — impactful, specific..."
  [Avatar placeholder] [Parent Name]
  [Class / Year or Role]
  [School crest watermark — subtle, bg]

[Dot navigation below]
[Prev / Next arrows — ghost style]
```

**Background:** royal-pale with subtle crown/arch pattern overlay.

---

#### Section 10 — CTA Banner (Pre-footer)
**Full-width, rich background.**

```
[Background]: royal gradient + amber geometric accents
[Crown icon / School crest — large, translucent right side]

[H2]: Begin Your Royal Journey
[Sub]: Applications are open for the 2025/2026 session. Secure your
       child's place in an institution committed to excellence.
[CTAs]: [Apply Now →]   [Contact Us]
[Small text]: Have questions? Call us: +234 XXX XXX XXXX
```

---

#### Section 11 — Footer
*(See Section 3.8 for footer blueprint)*

---

### PAGE 2: About (`about.html`)

**Purpose:** Full school profile — history, mission, leadership, facilities. Single comprehensive page.

---

#### Section 1 — Navbar (solid, no transparency)

#### Section 2 — Page Hero
```
[Background]: royal gradient, subtle pattern
[Breadcrumb]: Home / About
[H1]: About Royal Ark College
[Tagline]: Seven decades of shaping futures with purpose and pride.
[Scroll indicator]
```

#### Section 3 — Mission / Vision / Values Trio
```
[3 cards side by side]:

┌─────────────┐  ┌─────────────┐  ┌─────────────┐
│ 🎯 Mission  │  │ 🌟 Vision   │  │ 👑 Values   │
│─────────────│  │─────────────│  │─────────────│
│ Body text   │  │ Body text   │  │ Bullet list │
│ about what  │  │ about where │  │ of 5 core   │
│ we do daily │  │ we're going │  │ values      │
└─────────────┘  └─────────────┘  └─────────────┘
```
Center card (Vision) is elevated — royal bg, white text, slight scale(1.04).

#### Section 4 — Our Story / History
**Layout:** Timeline left-anchored + text right.

```
[H2]: Our Story
[Intro paragraph]

Timeline items (vertical):
  ● 2005 — School Founded
  ● 2008 — Secondary section added
  ● 2012 — First WAEC candidates
  ● 2018 — New campus facility opened
  ● 2023 — ICT Centre commissioned
  ● 2025 — Digital portal launched
```

Timeline dot: amber circle, connecting line in royal-pale. Hover: dot glows amber.

#### Section 5 — School Levels & Structure
**Layout:** 4-col grid, same as Home programs but expanded with more detail.

Each card:
- Level name + age range
- Number of classes / arms
- Key subjects/programs
- CTA → Academics page (anchor link)

#### Section 6 — Leadership / Management Team
```
[H2]: Our Leadership Team
[Subtitle]: Experienced educators guiding Royal Ark with vision and dedication.

[Team grid — 3 col desktop, 2 col tablet, 1 col mobile]:
  ┌──────────────────┐
  │ [Photo / Avatar] │
  │──────────────────│
  │  Principal Name  │
  │  Principal       │
  │  Brief bio 2 lines│
  │  [Qualifications]│
  └──────────────────┘
```
Cards: white bg, border, radius-lg. Hover: border-color → amber, name → royal.
Avatar placeholder: monogram initial in royal-pale bg.

#### Section 7 — Facilities
```
[H2]: World-Class Facilities
[Subtitle]: A campus built for inspired learning.

[Grid — icon + title + description]:
  🏫 Classrooms           🔬 Science Laboratory
  💻 ICT Centre           📚 Library
  ⚽ Sports Complex        🎨 Arts Studio
  🍽️ Dining Hall          🏥 Health Centre
```

Layout: 4-col icon-cards on desktop. Each card has soft hover: amber icon bg.

#### Section 8 — Accreditations & Affiliations
```
[H2]: Accreditations & Affiliations
Logo placeholders for: Ministry of Education, WAEC, NECO, etc.
Displayed as a logo bar (grayscale → color on hover)
```

#### Section 9 — CTA Banner
```
"Discover what makes Royal Ark the right choice for your child."
[Learn About Admissions →]   [Contact Us]
```

---

### PAGE 3: Academics (`academics.html`)

**Purpose:** Comprehensive guide to programs, curriculum, calendar, and academic performance.

---

#### Section 1 — Page Hero
```
[H1]: Academic Excellence at Every Level
[Sub]: Structured learning pathways designed to develop
       curious minds and confident futures.
[Quick tabs below hero — anchor links to sections]:
  Programs | Curriculum | Academic Calendar | Extra-Curricular
```

#### Section 2 — Programs Overview
**Tabbed interface** — one tab per level:

```
Tabs: [Creche & Nursery] [Primary] [Junior Secondary] [Senior Secondary]

Per tab content:
  [Level badge + icon]
  [H3]: Level name — "Primary School (Years 1–6)"
  [Left col]: Description, key objectives, class structure
  [Right col]: Subjects offered (pill list), entry age/requirements
  [Bottom]: Key external exams this level prepares for (if any)
```

#### Section 3 — Curriculum Approach
```
[H2]: Our Curriculum Philosophy
[2-col layout]:
  Left: text — national curriculum base + enrichment
  Right: 4 approach pillars with icons
    📖 Knowledge-First     🧠 Critical Thinking
    🤝 Character Building  🌱 Growth Mindset
```

#### Section 4 — Academic Calendar
```
[H2]: Academic Calendar — 2025/2026 Session

[3 term columns]:
┌─────────────┐  ┌─────────────┐  ┌─────────────┐
│  First Term │  │ Second Term │  │  Third Term │
│─────────────│  │─────────────│  │─────────────│
│ Sep 8, 2025 │  │ Jan 6, 2026 │  │ Apr 20, 2026│
│ Resumption  │  │ Resumption  │  │ Resumption  │
│─────────────│  │─────────────│  │─────────────│
│ Key events  │  │ Key events  │  │ Key events  │
│ listed      │  │ listed      │  │ listed      │
│─────────────│  │─────────────│  │─────────────│
│ Dec 12, 2025│  │ Apr 3, 2026 │  │ Jul 18, 2026│
│ Break       │  │ Break       │  │ Long Vac.   │
└─────────────┘  └─────────────┘  └─────────────┘

[Download Calendar — PDF button]
```

#### Section 5 — Extra-Curricular Activities
```
[H2]: Beyond the Classroom
[Grid of activity cards]:
  ⚽ Football       🏀 Basketball    🎭 Drama Club
  🎵 Music/Choir   🧪 Science Club  🎨 Art & Design
  📰 Debate Club   🌿 Eco Club      💻 Coding Club
```

Each card: icon + name + short desc. Hover: amber bg tint.

#### Section 6 — CTA
```
"Ready to enrol your child in a school built for excellence?"
[Apply for Admission →]
```

---

### PAGE 4: Admissions (`admissions.html`)

**Purpose:** Everything a parent needs to understand and begin the admissions process.

---

#### Section 1 — Page Hero with Status Banner
```
[H1]: Admissions — 2025/2026 Session
[Dynamic status badge — large]: 🟢 Applications Open

[Hero sub]: Transparent process. Supportive team. A school worth choosing.
```

#### Section 2 — Admission Status Block
Full-width attention block (amber-pale bg):
```
┌──────────────────────────────────────────────────────┐
│  📋 APPLICATION WINDOW                               │
│  Opens:  September 1, 2025                           │
│  Closes: November 30, 2025                           │
│  [Countdown timer — days/hours]                      │
│  [Apply Now →]                                       │
└──────────────────────────────────────────────────────┘
```

#### Section 3 — Process Steps
```
[H2]: How to Apply

Step flow (horizontal on desktop, vertical on mobile):

  ①──────────②──────────③──────────④──────────⑤
 Fill Form  Pay Fee   Submit    Interview  Resumption
           Online    Docs      (if req'd)
```

Each step: number circle (amber) + title + 1-line desc.
Active/completed steps get filled amber circle.

#### Section 4 — Requirements per Level
**Accordion per level:**

```
▼ Creche & Nursery Admission Requirements
  - Age: 1–4 years
  - Documents: Birth certificate, passport photos, immunisation card
  - No entrance exam required

▼ Primary School Requirements
  ...

▼ Junior Secondary (JSS1) Requirements
  ...

▼ Senior Secondary (SSS1) Requirements
  ...
```

#### Section 5 — Fees Schedule
```
[H2]: Fee Structure

[Note]: Fees shown are indicative. Contact our office for current session rates.

[Table]:
Level     | Tuition   | Registration | Development | Total
Creche    | ₦XX,000   | ₦X,000       | ₦X,000      | ₦XX,000
Nursery   | ...
Primary   | ...
JSS       | ...
SSS       | ...

[Footnote]: Fees are payable per term. Payment plans available.
[CTA]: Request Detailed Fee Sheet →
```

#### Section 6 — Documents Checklist
```
[H2]: Documents Required
[Checklist visual — 2 col]:
  ☐ Birth Certificate (original + photocopy)
  ☐ Previous School Report Card (last 2 terms)
  ☐ Passport Photographs (4 copies)
  ☐ Parent/Guardian ID
  ☐ Immunisation Card (Nursery/Primary)
  ☐ BECE Result (for SSS1 entry)

[Download Checklist PDF button]
```

#### Section 7 — FAQ Accordion
```
[H2]: Frequently Asked Questions

Common questions:
Q: Is there an entrance examination?
Q: Can my child join mid-session?
Q: What is the school's feeding arrangement?
Q: Do you offer bursaries or scholarships?
Q: What is the uniform policy?
```

#### Section 8 — Contact / Enquiry Block
```
[H2]: Still Have Questions?
[2 col]: Left — contact details (phone, email, WhatsApp)
         Right — small enquiry form (name, phone, message)
```

#### Section 9 — CTA
```
[Large amber CTA block]
"Secure Your Child's Future at Royal Ark College"
[Apply Online Now →]  [Download Prospectus]
```

---

### PAGE 5: Events (`events/index.html`)

**Purpose:** All upcoming and past school events.

---

#### Section 1 — Page Hero
```
[H1]: Events at Royal Ark College
[Sub]: From prize-giving day to sports week — there's always something
       extraordinary happening at Royal Ark.
[Filter tabs below]: Upcoming | Past | All
```

#### Section 2 — Featured / Next Major Event
```
[Wide card — full width or 2-col]:
  [Date badge — large, amber]: "SAT 14 DEC 2025"
  [Category]: Annual Event
  [H2]: 2025 Prize Giving & Graduation Day
  [Description paragraph]
  [Location + Time chips]
  [RSVP / Find Out More →]
```

#### Section 3 — Events Grid
**3-col grid (desktop), 2-col (tablet), 1-col (mobile):**

```
┌──────────────────┐
│ [Date badge top] │
│ [Category tag]   │
│──────────────────│
│ Event Title      │
│ Short desc       │
│──────────────────│
│ 📍 Venue         │
│ 🕐 Time          │
│──────────────────│
│ [Learn More →]   │
└──────────────────┘
```

Hover: card lifts, amber left border appears, title color → royal.

#### Section 4 — Event Detail Page (`event-detail.html`)
Separate page:
- Full event info: title, date/time, venue, full description
- Photo gallery strip (placeholder images)
- Google Maps embed placeholder
- RSVP form (name, phone, number attending)
- Related events sidebar

---

### PAGE 6: News (`news/index.html`)

**Purpose:** School updates, press releases, announcements.

---

#### Section 1 — Page Hero
```
[H1]: News & Updates
[Sub]: Stay informed with the latest from Royal Ark College.
[Search bar inline]
```

#### Section 2 — Featured Article
Full-width banner card:
```
[Large image placeholder]
[Category tag]  [Date]
[H2]: Article headline — bold and editorial
[Preview text — 2 lines]
[Author + Read time]
[Read Full Article →]
```

#### Section 3 — Article List + Sidebar

**Left (main, 2/3 width):** Article cards in list format
```
┌──────────────────────────────────────────┐
│ [Thumb]  [Category] [Date]               │
│          H3: Article title               │
│          Preview text, 2 lines           │
│          [Author] · [Read time] [Read →] │
└──────────────────────────────────────────┘
```

**Right (sidebar, 1/3 width):**
- Category filter chips
- Recent posts list
- Newsletter signup widget
- Admission CTA card

#### Section 4 — Article Detail (`news/article.html`)
- Full article body (rich text)
- Author bio box
- Tags
- Share buttons (WhatsApp, Facebook, copy link)
- Related articles

---

### PAGE 7: Gallery (`gallery.html`)

**Purpose:** Visual showcase of school life — photos and videos.

---

#### Section 1 — Page Hero
```
[H1]: Life at Royal Ark
[Sub]: Glimpses of the vibrant community that makes Royal Ark College
       more than just a school.
```

#### Section 2 — Filter Bar
```
[Category buttons — pill style]:
  [All]  [Academics]  [Sports]  [Events]  [Facilities]  [Arts & Culture]

[Media type toggle]:  📷 Photos  |  🎬 Videos
```

#### Section 3 — Media Grid
**Masonry-style grid, 4-col desktop → 2-col mobile.**

**Photo cell:**
```
┌──────────────┐
│              │ ← placeholder (aspect 4:3 or square)
│   [Image]    │
│              │
│ ─────────────│ ← on hover: overlay appears
│ Caption text │
│ [Magnify 🔍] │
└──────────────┘
```

**Video cell:**
```
┌──────────────┐
│ [Thumbnail]  │
│   ▶ ──────── │ ← play button overlay
│              │
│ Duration tag │
└──────────────┘
```

**Lightbox (on photo click):**
- Full-screen overlay, dark bg
- Arrow prev/next navigation
- Caption
- Download button
- Close (X or Escape)

**Video lightbox:**
- Embedded video player in modal overlay

#### Section 4 — Video Highlights Section
```
[H2]: Video Highlights
[2 or 3 large video cards]:
  - Annual Day 2024
  - Sports Day Highlights
  - Student Testimonials
```

---

### PAGE 8: Contact (`contact.html`)

**Purpose:** All ways to reach the school.

---

#### Section 1 — Page Hero
```
[H1]: Get in Touch
[Sub]: We'd love to hear from you — prospective parents,
       current families, or anyone with a question.
```

#### Section 2 — Contact Info + Form (2-col)

**Left (info):**
```
📍 Address block
📞 Phone numbers (main + admissions line)
✉️ Email addresses
💬 WhatsApp (clickable link)
🕐 Office hours (Mon–Fri, Sat)

[Social links row]

[Map embed placeholder]
  "Royal Ark College, [Address], Lagos"
```

**Right (form):**
```
Name *
Email *
Phone
Subject [dropdown: Admissions / General / Academics / Other]
Message *
[Send Message button — amber primary]
```

Form success state: inline green banner "Message sent! We'll respond within 24 hours."

#### Section 3 — FAQ Quick Links
```
[H3]: Common Questions
Quick accordion — 5 most-asked questions
[View All FAQs →] → links to admissions FAQ section
```

---

### PAGE 9: Apply (`apply.html`)

**Purpose:** Online application form — multi-step, clean, guided.

---

#### Section 1 — Minimal Header
No full navbar distractions. Show:
```
[Logo]  [School Name]              [Need Help? 📞]
```

#### Section 2 — Progress Indicator
```
Step 1          Step 2          Step 3          Step 4          Step 5
Student Info  →  Parent Info  →  Prev. School  →  Documents  →  Review
[●]──────────────[○]──────────────[○]──────────────[○]──────────[○]
```

Completed steps: amber filled circle with checkmark.
Current step: royal filled circle.
Upcoming: ghost circle.

#### Step 1 — Student Information
```
First Name *      Last Name *
Date of Birth *   Gender *
Class Applying For * [dropdown — all levels]
Previous class attended
Nationality       State of Origin
```

#### Step 2 — Parent/Guardian Information
```
Parent/Guardian Full Name *
Relationship *    Occupation
Phone Number *    Email Address *
Home Address *
Emergency Contact (different person)
```

#### Step 3 — Previous School
```
Previous School Name
Address of School
Last Class Attended / Completed
Reason for Leaving
Any special learning needs? [Y/N + detail field if Y]
```

#### Step 4 — Documents Upload
```
[Upload zones — drag & drop]:
  📄 Birth Certificate *
  📸 Passport Photograph * (max 2MB, JPG/PNG)
  📋 Last School Report Card
  🪪 Parent/Guardian ID
  💉 Immunisation Record (nursery/primary)

[File type + size hints per field]
```

#### Step 5 — Review & Submit
```
Summary table of all entered info
[Edit link per section]
Agreement checkbox:
  "I confirm all information provided is accurate..."
[Submit Application →] button

On submit:
  Success modal:
    🎉 "Application Received!"
    "Your reference number: RAC-2025-XXXXX"
    "We'll contact you at [email] within 3–5 working days."
    [Save Reference Number]  [Back to Home]
```

---

### PAGE 10: Footer (Shared Component)

**Layout:** 5-column desktop grid, 2-col tablet, stacked mobile.

```
┌──────────────────────────────────────────────────────────────────┐
│  [Logo + Crest]                                                  │
│  Royal Ark College                                               │
│  "Royalty in Excellence"                                         │
│  Brief 2-line description                                        │
│  [📘 Facebook] [📸 Instagram] [▶️ YouTube] [💬 WhatsApp]         │
├───────────────┬───────────────┬───────────────┬──────────────────┤
│  Quick Links  │  Academics    │  Community    │  Newsletter      │
│  ──────────── │  ──────────── │  ──────────── │  ──────────────  │
│  Home         │  Programs     │  Events       │  Stay updated    │
│  About        │  Curriculum   │  News         │  with school     │
│  Admissions   │  Calendar     │  Gallery      │  updates.        │
│  Contact      │  School Fees  │  Apply Now    │                  │
│  Staff Login  │  Extra-Curr.  │               │  [Email input]   │
│               │               │               │  [Subscribe →]   │
├───────────────┴───────────────┴───────────────┴──────────────────┤
│  📍 Address, City, State     📞 +234 XXX XXXX  ✉️ info@royalark  │
│  © 2025 Royal Ark College · All Rights Reserved · Privacy Policy │
└──────────────────────────────────────────────────────────────────┘
```

**Design:** Dark royal bg (`--royal`), white/light text, amber accent links on hover.
Top section has subtle wave or diagonal divider from the page body.

---

## 4. SPECIAL UI ELEMENTS SPECIFICATION

### 4.1 Admission Status Banner (Sitewide)
A thin dismissible bar above the navbar — only shows when admissions are open.

```
[Pulsing amber dot] Applications for 2025/2026 are now open! [Apply Now →] [✕]
```
Background: amber gradient. Height: 40px. Sticky to top, pushes navbar down.

---

### 4.2 Page Hero System
All inner pages share a consistent hero pattern:
- Height: `min(380px, 40vw)` desktop, `220px` mobile
- Background: royal gradient + pattern overlay
- School crest: large, translucent, right-positioned (decorative)
- Breadcrumb: always present (amber > text color)
- H1: display font, white
- Subtitle: optional, muted white

---

### 4.3 Stats/Counter Widgets
- Animate numbers from 0 → target when scrolled into view
- Use `IntersectionObserver` + JS counter
- Format: large display font (amber or white), small label below

---

### 4.4 Section Labels
Small uppercase tracking text above H2 headings:
```css
.section-label {
  font-family: var(--font-label);
  font-size: var(--text-xs);
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--amber);
}
```
Always amber. Always precedes an H2.

---

### 4.5 Gallery Lightbox
```
[Overlay]: rgba(10, 4, 20, 0.95) — dark royal-black
[Image]: centered, max 90vw × 90vh, rounded corners
[Controls]:
  [← Prev]  [Caption text]  [Next →]
  [Download]                [✕ Close]
[Keyboard]: Arrow keys + Escape
[Touch]: swipe left/right on mobile
```

---

### 4.6 Event Cards
Unique date treatment:
```
┌──────┐
│  14  │  ← day (large, amber)
│ DEC  │  ← month (small, royal)
└──────┘
```
Date block floats top-left of card. Card has category tag + title + location row + time row.

---

### 4.7 Countdown Timer (Admissions Page)
```
┌──────────┬──────────┬──────────┬──────────┐
│  23      │  14      │  07      │  42      │
│  Days    │  Hours   │  Minutes │  Seconds │
└──────────┴──────────┴──────────┴──────────┘
```
Styled boxes, amber numbers, label below. Updates every second via JS.

---

### 4.8 Scroll Reveal System
All major sections use a unified reveal pattern:
```javascript
// IntersectionObserver
// Adds .is-visible to .reveal elements
// CSS handles the animation via transition

.reveal {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}
.reveal.is-visible {
  opacity: 1;
  transform: translateY(0);
}
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }
```

---

### 4.9 Toast Notifications
Positioned bottom-right, stack upward:
- Success: green bg + checkmark
- Info: royal bg + info icon
- Warning: amber bg + triangle icon
- Auto-dismiss after 4 seconds
- Manual dismiss X

---

### 4.10 Program Level Cards (Hover)
```
Default state:   cream bg, royal border (subtle), icon in royal-pale bg
Hover state:     white bg, amber border (top only, 3px), icon bg → amber-pale,
                 shadow lifts, title → royal
Active/selected: royal bg, white text (for tab selection use)
```

---

### 4.11 Form Controls (Apply page + Contact)
- All inputs: subtle royal border, focus → amber border + royal glow ring
- Error state: red border + shake animation + error message below
- Success state: green border + check icon appears inside input
- Dropdowns: custom styled (no native appearance), royal caret icon
- File upload: dashed border zone, drag-over → amber dashed border
- Submit buttons: amber primary, loading state (spinner + "Submitting...")

---

## 5. RESPONSIVE BREAKPOINTS

```
--bp-xs:  480px   /* large phones */
--bp-sm:  640px   /* small tablets */
--bp-md:  768px   /* tablet portrait */
--bp-lg:  1024px  /* tablet landscape / small laptop */
--bp-xl:  1200px  /* desktop */
--bp-2xl: 1440px  /* wide desktop */
```

**Mobile-first approach:** All base styles target mobile. `@media (min-width: ...)` adds complexity upward.

**Grid behavior:**
| Component | Mobile | Tablet | Desktop |
|---|---|---|---|
| Programs cards | 1 col | 2 col | 4 col |
| Why Choose Us | 1 col | 2 col | 3 col |
| Team cards | 1 col | 2 col | 3 col |
| Footer | stacked | 2 col | 5 col |
| Gallery | 2 col | 3 col | 4 col |
| News articles | 1 col | 2 col | 3 col |
| Stats bar | 2×2 | 4 col | 4 col |

---

## 6. FILE STRUCTURE

```
royal-ark/
├── index.html
├── about.html
├── academics.html
├── admissions.html
├── gallery.html
├── contact.html
├── apply.html
│
├── pages/
│   ├── events/
│   │   ├── index.html
│   │   └── event-detail.html
│   └── news/
│       ├── index.html
│       └── article.html
│
├── css/
│   ├── main.css          ← design system, shared components
│   ├── home.css          ← homepage-specific
│   └── forms.css         ← apply form styles
│
├── js/
│   ├── main.js           ← navbar, scroll reveal, counters, toast
│   ├── gallery.js        ← lightbox, filter, masonry
│   └── apply.js          ← multi-step form logic, validation
│
└── assets/
    ├── images/
    │   └── placeholders/
    ├── icons/
    └── fonts/            ← if self-hosting
```

---

## 7. IMPLEMENTATION PRIORITY ORDER

**Phase 1 — Core (build first):**
1. `css/main.css` — full design system
2. `js/main.js` — navbar, reveal, counters
3. `index.html` — homepage
4. Shared navbar + footer components

**Phase 2 — Inner Pages:**
5. `about.html`
6. `academics.html`
7. `admissions.html`
8. `contact.html`

**Phase 3 — Community:**
9. `pages/events/index.html`
10. `pages/news/index.html`
11. `gallery.html`

**Phase 4 — Forms & Details:**
12. `apply.html`
13. `event-detail.html`
14. `news/article.html`

---

*Blueprint prepared for Royal Ark College — "Royalty in Excellence"*
*Version 1.0 — Landing Pages UI/UX Blueprint*
