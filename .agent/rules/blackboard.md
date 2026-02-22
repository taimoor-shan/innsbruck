# Rule: Git-Backed State Management

## After Every Task

After completing **any** task (bug fix, feature, refactor, etc.), you **must** update `docs/state.md` before considering the work done.

The update must include:

- **Current Context:** What was just changed and why.
- **Technical Debt:** Any "todo" items, hacks, or shortcuts introduced.
- **Next Steps:** Precise instructions for the next agent session to pick up where you left off.

## Commit Convention

1. Stage **both** the code changes **and** `docs/state.md` together.
2. Commit with the prefix: `agent(state): [Brief Description]`.

Example:

```
git add -A
git commit -m "agent(state): Added contact form validation and updated blackboard"
```

## Branching Rules

- **Never** update the blackboard directly on `master`.
- Each feature branch maintains its own local `docs/state.md` updates.
- When merging a PR, the `state.md` updates merge too — giving anyone who pulls `master` an immediate understanding of the project's global status.

## Context Bootstrapping

When starting a new session, your **first step** should be to read the state history:

```
git log -p docs/state.md
```

This gives you the full evolution of the project — not just where it is now, but _how_ it got here.
