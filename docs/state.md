# Project Blackboard — Delta Livings (TailPress Theme)

> This file is the single source of truth for the agent's understanding of the project.
> It is version-controlled and updated after every task. See `.agent/rules/blackboard.md` for the update protocol.

---

## Active Mission

_No active mission. Awaiting next task assignment._

---

## Architecture Decisions

| Decision                             | Rationale                                                                               | Date         |
| ------------------------------------ | --------------------------------------------------------------------------------------- | ------------ |
| WordPress + TailPress (Tailwind CSS) | Rapid theme development with utility-first CSS on a proven CMS                          | Pre-existing |
| Vite for asset compilation           | Fast HMR, modern bundling; configured with stable filenames for production              | 2026-02-16   |
| ACF for custom fields                | Flexible, developer-friendly custom field management for CPTs (Property, Unit, Listing) | Pre-existing |
| Alpine.js for interactivity          | Lightweight reactive JS for accordion, popups, and UI state without a heavy framework   | Pre-existing |
| Contact Form 7 for forms             | Industry-standard WP form plugin; styled to match theme design                          | Pre-existing |
| Swiper.js for carousels              | Performant, touch-friendly carousel used on home and property listing pages             | Pre-existing |

---

## The 'Why' Log

_Record explanations for complex or non-obvious code decisions here._

| File / Function | Why It's Written That Way |
| --------------- | ------------------------- |
|                 |                           |

---

## Blocking Issues

_Record anything the agent tried and failed to do._

| Issue | Details | Status |
| ----- | ------- | ------ |
|       |         |        |

---

## Technical Debt

_Track hacks, shortcuts, and things that need revisiting._

| Item | Location | Priority |
| ---- | -------- | -------- |
|      |          |          |

---

## Current Context

_Last updated: 2026-02-23_

Initial blackboard creation. No task changes to report yet.

---

## Next Steps

- Begin using this blackboard after every task per the rules in `.agent/rules/blackboard.md`.
- Run `/handoff` at the end of each session to commit state and generate a resume string.
