# Graph Report - .  (2026-05-17)

## Corpus Check
- Corpus is ~19,554 words - fits in a single context window. You may not need a graph.

## Summary
- 117 nodes · 84 edges · 41 communities (37 shown, 4 thin omitted)
- Extraction: 89% EXTRACTED · 11% INFERRED · 0% AMBIGUOUS · INFERRED: 9 edges (avg confidence: 0.79)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- [[_COMMUNITY_TailPress Changelog & Vite|TailPress Changelog & Vite]]
- [[_COMMUNITY_Innsbruck City Website|Innsbruck City Website]]
- [[_COMMUNITY_Project Architecture & Why Log|Project Architecture & Why Log]]
- [[_COMMUNITY_Migration Spec & Guardrails|Migration Spec & Guardrails]]
- [[_COMMUNITY_Pagination Component|Pagination Component]]
- [[_COMMUNITY_Theme Identity & Metadata|Theme Identity & Metadata]]
- [[_COMMUNITY_Value Propositions|Value Propositions]]
- [[_COMMUNITY_Component-to-ACF Mapping|Component-to-ACF Mapping]]
- [[_COMMUNITY_ACF Integration Class|ACF Integration Class]]
- [[_COMMUNITY_Comment Walker|Comment Walker]]
- [[_COMMUNITY_Star Rating Icon|Star Rating Icon]]

## God Nodes (most connected - your core abstractions)
1. `Innsbruck City Apartments Homepage` - 9 edges
2. `React to WordPress Migration Architecture` - 8 edges
3. `Architecture Decisions Table` - 7 edges
4. `Pagination` - 6 edges
5. `TailPress` - 6 edges
6. `TailPress Project` - 5 edges
7. `TailPress v5.0.0 Major Update` - 5 edges
8. `Benefits Value Propositions` - 5 edges
9. `TailPress_ACF` - 3 edges
10. `Vite as Default Compiler` - 3 edges

## Surprising Connections (you probably didn't know these)
- `Decision: WordPress + TailPress` --semantically_similar_to--> `TailPress`  [INFERRED] [semantically similar]
  docs/state.md → README.MD
- `TailPress Theme Screenshot` --conceptually_related_to--> `TailPress`  [INFERRED]
  screenshot.png → README.MD
- `Innsbruck City Apartments Homepage` --semantically_similar_to--> `Innsbruck City Apartments Homepage (Earlier Capture)`  [INFERRED] [semantically similar]
  www.innsbruckcityapartments.com_.2026-05-15T17_38_20.555Z.md → www.innsbruckcityapartments.com_.2026-05-15T17_36_08.409Z.md
- `Decision: Vite for Asset Compilation` --semantically_similar_to--> `Vite as Default Compiler`  [INFERRED] [semantically similar]
  docs/state.md → CHANGELOG.md
- `Location Pin Icon` --conceptually_related_to--> `Location Heiliggeiststrasse Innsbruck`  [INFERRED]
  resources/icons/pin.svg → www.innsbruckcityapartments.com_.2026-05-15T17_38_20.555Z.md

## Hyperedges (group relationships)
- **Delta Livings Technology Stack** — state_tailpress_decision, state_vite_decision, state_acf_decision, state_alpinejs_decision, state_cf7_decision, state_swiper_decision [EXTRACTED 1.00]
- **React to WordPress Migration Workflow** — promptspec_phase_asset_integration, promptspec_phase_markup_translation, promptspec_phase_wp_integration [EXTRACTED 1.00]
- **Innsbruck City Apartments Value Propositions** — website_benefit_prime_location, website_benefit_luxury_amenities, website_benefit_city_center, website_benefit_business_travel [EXTRACTED 1.00]

## Communities (41 total, 4 thin omitted)

### Community 0 - "TailPress Changelog & Vite"
Cohesion: 0.18
Nodes (12): Composer Autoloading, TailwindCSS JIT Compilation, jQuery Dependency Removal, Pagination Class, CSS Safelist Feature, TailPress Project, tailpress/framework Package, Tailwind CSS v4 Support (+4 more)

### Community 2 - "Innsbruck City Website"
Cohesion: 0.22
Nodes (11): Home Navigation Icon, Location Pin Icon, Innsbruck City Apartments Business, Contact Information, Innsbruck City Apartments Homepage, Location Heiliggeiststrasse Innsbruck, Luxury Units, Navigation Structure (+3 more)

### Community 3 - "Project Architecture & Why Log"
Cohesion: 0.18
Nodes (11): Rationale: Alpine.js Lightweight Reactive JS, Decision: Alpine.js for Interactivity, Architecture Decisions Table, Decision: Contact Form 7 for Forms, Rationale: CF7 Industry-Standard WP Form Plugin, Delta Livings Project, Handoff Protocol, Decision: Swiper.js for Carousels (+3 more)

### Community 4 - "Migration Spec & Guardrails"
Cohesion: 0.22
Nodes (8): React to WordPress Migration Architecture, Performance Guardrail: No Unnecessary JS, Phase 1: Asset Integration, Phase 2: Markup Translation, Phase 3: WordPress Core Integration, Responsiveness Guardrail: Mobile-First, Preserve Tailwind Utility Classes Rule, WordPress CSS Class Safelist

### Community 6 - "Theme Identity & Metadata"
Cohesion: 0.29
Nodes (7): theme.json Migration, Jeffrey van Rossum, MIT License, TailPress, Tailwind CSS, WordPress, TailPress Theme Screenshot

### Community 7 - "Value Propositions"
Cohesion: 0.33
Nodes (6): Mountain Expertise Icon, Benefit: Business Travel, Benefit: City Center Attractions, Benefit: Luxury Amenities, Benefit: Prime Location, Benefits Value Propositions

### Community 8 - "Component-to-ACF Mapping"
Cohesion: 0.4
Nodes (5): 1:1 Component Mapping Strategy, React Component to PHP Template Mapping, React Props to ACF Fields Mapping, Decision: ACF for Custom Fields, Rationale: ACF Flexible Custom Field Management for CPTs

## Knowledge Gaps
- **36 isolated node(s):** `Tailwind CSS`, `Jeffrey van Rossum`, `MIT License`, `Composer Autoloading`, `tailpress/framework Package` (+31 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **4 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Architecture Decisions Table` connect `Project Architecture & Why Log` to `TailPress Changelog & Vite`, `Component-to-ACF Mapping`?**
  _High betweenness centrality (0.107) - this node is a cross-community bridge._
- **Why does `Decision: ACF for Custom Fields` connect `Component-to-ACF Mapping` to `Project Architecture & Why Log`?**
  _High betweenness centrality (0.060) - this node is a cross-community bridge._
- **Why does `Decision: Vite for Asset Compilation` connect `TailPress Changelog & Vite` to `Project Architecture & Why Log`?**
  _High betweenness centrality (0.054) - this node is a cross-community bridge._
- **Are the 2 inferred relationships involving `TailPress` (e.g. with `Decision: WordPress + TailPress` and `TailPress Theme Screenshot`) actually correct?**
  _`TailPress` has 2 INFERRED edges - model-reasoned connections that need verification._
- **What connects `Tailwind CSS`, `Jeffrey van Rossum`, `MIT License` to the rest of the system?**
  _36 weakly-connected nodes found - possible documentation gaps or missing edges._