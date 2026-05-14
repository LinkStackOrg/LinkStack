# Livelatch Fork Summary

This file tracks changes made in the Livelatch fork only. It intentionally excludes the inherited upstream LinkStack history.

Fork range used for the initial backfill: `upstream/main..main`.

Current coverage: 27 fork commits from `8e19376` on 2026-05-12 through `c45776a` on 2026-05-14.

## Recent Changes

### 2026-05-14
- Added an `AGENTS.md` convention for owner-authored notes in `summary.md`; future reports should preserve those notes and treat them as additional context/justification.
- Updated `AGENTS.md` to require future `summary.md` entries to preserve the current format, date heading style, fork-only scope, and separation between recent changes and fork history.
- Added `AGENTS.md` with repo-level instructions for future agent sessions, including automatic `summary.md` updates after changes and PNG output for generated Open Graph previews.
- Replaced the previous full-repository history digest with a fork-only summary based on `upstream/main..main`.
- Kept the file focused on Livelatch-specific deployment, S3 media, dashboard avatar, and Open Graph work.
- Expanded the 2026-05-14 fork history entry so every commit from today is listed, not only representative commits.

## Fork History Digest

### 2026-05-12

15 commits: `8e19376` through `81c76d8`.

#### Platform Identity
- Reworked the README to introduce the project as Livelatch rather than stock LinkStack.
- Removed/renamed legacy install documentation that no longer matched the Railway-oriented setup.

#### Composer And Runtime Alignment
- Updated `composer.json` and `composer.lock` to align the app with Livelatch runtime needs.
- Added compatibility dependencies for S3-compatible object storage.
- Added `composer.lock.old` during Composer recovery work.
- Pulled in Laravel language/runtime files needed after dependency changes.

#### Railway Deployment
- Added `railpack.json` for Railway builds.
- Adjusted Laravel app config and routes to avoid post-deploy Artisan/runtime errors.
- Added a clean redeploy trigger commit.
- Updated `.gitattributes` and route/view references involved in deployment fixes.

#### Routing And UI Cleanup
- Adjusted `routes/web.php`, `routes/home.php`, and the PHP info view during route repair.
- Edited the dashboard sidebar and added a sidebar backup/copy during layout changes.

Representative commits: `8e19376`, `faeb738`, `8de0844`, `7a27f03`, `2fa2778`, `78024b8`, `81c76d8`.

### 2026-05-14

12 commits: `6b5e32b` through `c45776a`.

Commit list:
- `6b5e32b` - Update `AdminController.php`.
- `a06a373` - Add S3 implementation for profile photo storage.
- `94fb68f` - Fix profile photo rendering in the UI.
- `6e46408` - Resolve the correct S3 path for profile photos and add the `profile_image` storage path.
- `7d6435d` - Add profile image media caching/proxy logic to avoid exposing AWS credentials.
- `41707fc` - Add dashboard and studio rendering logic for S3-backed profile photos.
- `f2d2138` - Edit README.
- `750cab6` - Add dynamic Open Graph and Twitter Card metadata for public profile pages.
- `67e21b9` - Add the internal Open Graph editor.
- `cc59f68` - Add the generated Open Graph card design.
- `e2209c7` - Fix Discord compatibility for Open Graph previews.
- `c45776a` - Fix PNG preview resolution and rendering quality.

#### Private S3 Profile Image Storage
- Replaced local profile photo writes under `assets/img` with Laravel S3 disk uploads.
- Added profile image upload logging and safer filename/path handling.
- Added support for storing the actual profile image path separately from existing profile settings data.
- Added `users.profile_image` migration and updated user/profile controllers to prefer that field.

#### Profile Image Rendering
- Added helper logic for empty/default images, legacy local filenames, S3 object paths, and full URLs.
- Fixed the bug where JSON profile settings were being treated as an image filename.
- Updated public, dashboard, studio, sidebar, admin bar, and related avatar views to use safe shared image resolution.

#### Private Media Proxy
- Added `MediaController`.
- Added public media routes for profile images.
- Proxied private S3-backed profile images through clean app URLs instead of exposing signed S3 URLs.
- Added cache headers suitable for Cloudflare and browser caching.
- Added fallback behavior for missing, invalid, legacy local, or default images.

#### Open Graph And Discord Preview Images
- Added dynamic Open Graph and Twitter Card metadata to public profile pages.
- Added a generated Open Graph preview image route.
- Added `opengraph.php`, an internal editor/tool for designing generated profile preview cards.
- Updated the generated preview card design from the editor output.
- Switched Discord-facing preview images to PNG output instead of SVG.
- Improved PNG rendering quality by rendering at higher internal resolution, downsampling, improving fallbacks, and cache-busting the OG image URL.

!! I need to look in to font rendering for opengraph, please provide some suggestions for this.

#### Documentation
- Made a small README edit after the media/Open Graph work.

All commits for this date are listed above.

## Ongoing Summary Rules

- After each future code/config change, append a dated entry under **Recent Changes**.
- Keep entries focused on what changed, why it changed, and the user-facing/deployment impact.
- As this file grows, compress older detailed entries into shorter dated summaries instead of keeping every implementation detail forever.
