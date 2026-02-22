---
description: End-of-session handoff — summarize work, update state.md, commit, and generate a resume string
---

# /handoff Workflow

Run this workflow at the end of a session to cleanly hand off context to the next agent or developer.

// turbo-all

## Steps

### 1. Summarize Session Work

Review all changes made during the current session. Produce a concise summary covering:

- What was built, fixed, or changed
- Any decisions made and why
- Any blockers encountered

### 2. Update `docs/state.md`

Update the following sections of `docs/state.md`:

- **Active Mission:** Update or clear based on whether the mission is complete.
- **Current Context:** Describe what was just changed.
- **Technical Debt:** Add any new items introduced during the session.
- **The 'Why' Log:** Add entries for any complex or non-obvious code written.
- **Blocking Issues:** Document anything that failed or is unresolved.
- **Next Steps:** Write precise instructions for the next session to continue seamlessly.

### 3. Stage and Commit

Stage all changes (code + state) and commit with the blackboard prefix:

```bash
git add -A
git commit -m "agent(state): [Brief description of session work]"
```

### 4. Push the Branch

Push the current branch to the remote:

```bash
git push origin HEAD
```

> If there is no remote configured, skip this step and note it in the output.

### 5. Generate Resume String

Output a **Resume String** — a single paragraph that can be pasted into a new chat to instantly reboot the agent's context. The resume string must include:

- The branch name
- A one-sentence summary of what was done
- The key next step
- Any blocking issues

**Format example:**

> **Resume:** On branch `feature/contact-form`, I completed the contact form validation and styled the submit button. The form now captures leads via a popup before document download. Next step: add email notification on form submission. No blockers.

Present this resume string clearly to the user so they can copy it.
