# Livelatch

![AGPL-3.0 License](https://img.shields.io/github/license/livelatch/livelatch-dev-docker)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Flivelatch%2Flivelatch-dev-docker.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Flivelatch%2Flivelatch-dev-docker?ref=badge_shield)

![Status](https://img.shields.io/badge/status-alpha-orange)

Livelatch is a creator-focused link and community platform built for live audiences, social profiles, and interactive digital experiences.

---

## About

Livelatch began as a fork of LinkStack, and parts of the original LinkStack source code continue to be used within this project. We are grateful to the LinkStack maintainers and contributors for their work, and we respect the AGPL license that made this project possible.

Over time, Livelatch is being developed into its own platform with a separate vision, infrastructure approach, creator-focused tooling, and deployment workflow.

The goal of Livelatch is to create a more interactive and community-driven creator platform that goes beyond static link pages.

Current areas of focus include:

- Creator profile pages
- Community interaction systems
- Theme customization
- OAuth-based authentication
- Cloud-native deployment
- Latchdeck integration
- Analytics foundations
- Extensible creator tooling

---

## Project Status

⚠️ Livelatch is currently in **alpha**.

This means:

- Features may change rapidly
- APIs may change
- Database structures may change
- Breaking changes may occur
- Some systems may be incomplete

This repository exists to provide AGPL-compliant source availability and development transparency.

---

## Relationship to LinkStack

Livelatch started as a fork of LinkStack.

LinkStack remains an important foundation for this project, and Livelatch would not exist in its current form without the work of the LinkStack project and its contributors.

Livelatch is not presented as LinkStack, nor is it intended to replace LinkStack. It is a separate project with a different long-term direction, deployment model, and feature roadmap.

Upstream project links:

- https://linkstack.org
- https://github.com/LinkStackOrg/LinkStack

---

## Latchdeck

Latchdeck is a planned and actively developing subsystem within Livelatch focused on creator-linked digital collectibles and community engagement.

High-level goals include:

- Creator collectible cards
- Viewer engagement systems
- Event-based digital collections
- Supporter interaction mechanics
- Future gameplay integrations

Detailed documentation for Latchdeck will be added as development progresses.

---

## Deployment

Livelatch is currently being adapted for deployment on Railway.

High-level Railway deployment process:

1. Fork or clone this repository
2. Create a Railway project
3. Configure a database service
4. Configure environment variables
5. Configure object storage if required
6. Configure OAuth providers
7. Deploy the application
8. Run migrations and setup commands
9. Configure domains and SSL
10. Configure monitoring and backups

Example development commands:

```bash
composer install
npm install
npm run build
php artisan migrate
docker compose up -d
```

Commands and deployment steps may change as the platform evolves.

---

## Environment Configuration

Livelatch requires environment configuration before deployment.

Typical configuration areas include:

- Database connection
- Application URL
- Mail service
- OAuth credentials
- Storage providers
- Queue configuration
- Cache configuration
- Session configuration

Production secrets, infrastructure details, and private credentials are intentionally not included in this repository.

---

## Documentation

Additional documentation will be published as the project matures.

Useful resources:

- Laravel Documentation  
  https://laravel.com/docs

- Railway Documentation  
  https://docs.railway.com

- AGPL-3.0 License  
  https://www.gnu.org/licenses/agpl-3.0.en.html

---


[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Flivelatch%2Flivelatch-dev-docker.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Flivelatch%2Flivelatch-dev-docker?ref=badge_large)

## Security

Please do not publicly disclose security issues without first contacting the maintainers privately.

Security documentation and reporting procedures will expand as the platform matures.

---

## Contributing

Contributions may be accepted as development stabilizes.

Before contributing:

- Review the license
- Keep pull requests focused
- Avoid committing secrets or credentials
- Clearly document major changes
- Respect upstream open source projects and contributors

---

## License

This project is licensed under the GNU Affero General Public License v3.0.

See the `LICENSE` file for details.

---

## Acknowledgements

Special thanks to:

- The LinkStack maintainers and contributors
- The Laravel community
- The open source ecosystem
- Early testers and supporters of Livelatch

Livelatch may have started from a fork, but it is growing into its own platform with its own identity, goals, and direction.