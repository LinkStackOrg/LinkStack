# Agent Instructions

This repository is the Livelatch Laravel/LinkStack fork. Follow the existing app patterns and keep changes scoped to the requested behavior.

## Change Summary

After making code, config, migration, route, view, asset, tooling, or documentation changes, append a dated entry to `summary.md`.

Each entry should briefly cover:

- what changed
- why it changed
- files or work areas affected
- validation performed

Keep entries concise. As `summary.md` grows, compress older detailed entries into shorter dated summaries instead of deleting history.

Maintain the current `summary.md` format:

- keep **Recent Changes** at the top
- use `### YYYY-MM-DD` date headings
- write short bullets under each date
- keep the fork-history section separate from recent work
- when adding commit-history details, list exact commit hashes only for the fork-specific range being discussed
- do not reintroduce inherited upstream LinkStack history into the fork summary

Manual context notes in `summary.md`:

- lines or bullets beginning with `!!` are manually entered by the repo owner
- treat `!!` notes as additional context and justification to consider when writing reports
- preserve `!!` notes when editing or compressing `summary.md`
- do not rewrite owner-authored `!!` notes unless explicitly asked

## Open Graph Images

When implementing generated Open Graph preview cards from the internal editor output, assume the production output should be PNG unless explicitly instructed otherwise.
