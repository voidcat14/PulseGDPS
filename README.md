# PulseGDPS — MySQL + PostgreSQL

PulseGDPS is a self-hosted Geometry Dash private-server stack based on the MegaSa1nt core. It includes selectable MySQL/MariaDB or PostgreSQL PDO connections, an optional self-hosted Globed multiplayer stack, and an optional Geode mod index with persistent mod-file storage.

## Included services

| Service | What it does | Start command |
| --- | --- | --- |
| GDPS core | Game endpoints and web dashboard | Deploy this PHP project to your web server |
| MySQL / MariaDB | Default GDPS database backend | `docker compose --profile mysql up -d` |
| PostgreSQL | Alternate GDPS PDO backend | `docker compose --profile postgres up -d` |
| Globed | Real-time multiplayer central and game servers | `docker compose --profile globed up -d` |
| Geode Index | Private mod index, uploads, and downloads | `docker compose --profile geode up -d` |

Supported version of Geometry Dash: 1.0 - 2.208

(See [the backwards compatibility section of this article](https://github.com/Cvolton/GMDprivateServer/wiki/Deliberate-differences-from-real-GD) for more information)

Required version of PHP: 7.0+ (tested up to 8.3)

## Database configuration — no `.env` file

Credentials are stored in PHP config files, not an `.env` file:

1. Edit [config/mysql_connection.php](config/mysql_connection.php) for MySQL/MariaDB, or [config/postgresql_connection.php](config/postgresql_connection.php) for PostgreSQL.
2. Open [config/connection.php](config/connection.php) and set `$dbDriver` to `mysql` or `pgsql`.
3. Ensure the matching PHP extension is enabled: `pdo_mysql` or `pdo_pgsql`.

The supplied `database.sql` is the upstream MySQL/MariaDB schema. PostgreSQL connections are supported by the core’s PDO configuration, but a PostgreSQL-ready schema and review of legacy MySQL-specific queries are required before using PostgreSQL in production.

## Globed multiplayer

PulseGDPS includes the official Globed central-server and game-server images. Start the central server once to generate configuration, configure it to use your public GDPS API URL, then configure the game server with the generated password. Full setup and port requirements are in [docs/globed.md](docs/globed.md).

```bash
docker compose --profile globed up -d
```

## Geode mod index and storage

The Geode profile runs the official Geode Index API, PostgreSQL 17, and nginx. Mods uploaded to the index are persisted in a Docker volume and served through `/storage/`; Geode static assets are served through `/static/`. See [docs/geode.md](docs/geode.md) for deployment notes.

```bash
docker compose --profile geode up -d
```

## Basic setup

1. Deploy the project through PHP-FPM/nginx or another PHP-capable web server.
2. Choose a database backend and edit its config file as described above.
3. Create and import a schema. For MySQL/MariaDB, import `database.sql`.
4. Set your GDPS URL in the Geometry Dash client you control.
5. Open `/dashboard/` to finish dashboard installation and configure server settings.

## Updating

1) Upload the files on a webserver
2) Set `$installed` to false in config/dashboard.php
3) Run main dashboard's page

### Credits
Base for account settings and the private messaging system by someguy28

XOR encryption — https://github.com/sathoro/php-xor-cipher — (incl/lib/XORCipher.php)

Cloud save encryption — https://github.com/defuse/php-encryption — (incl/lib/defuse-crypto.phar)

Mail verification — https://github.com/phpmailer/phpmailer — (config/mail)

JQuery — https://github.com/jquery/jquery — (dashboard/lib/jq.js)

Image dominant color picker — https://github.com/swaydeng/imgcolr — (dashboard/lib/imgcolr.js)

Media cover — https://github.com/aadsm/jsmediatags — (dashboard/lib/jsmediatags.js)

Audio duration — https://github.com/JamesHeinrich/getID3 — (config/getid3)

Proxies list — https://github.com/SevenworksDev/proxy-list — (config/proxies.txt)

Common VPNs list — https://github.com/X4BNet/lists_vpn — (config/vpns.txt)

Discord Webhooks — https://github.com/renzbobz/DiscordWebhook-PHP — (config/webhooks/DiscordWebhook.php)

GD icons — https://github.com/oatmealine/gd-icon-renderer-web — (any page with player's username)

Cloudflare IPs List — https://www.cloudflare.com/ips — (incl/lib/mainLib.php & incl/lib/ipCheck.php)

Translit — https://github.com/ashtokalo/php-translit — (config/translit)

Snow — https://embed.im/snow — (dashboard)

Most of the stuff in generateHash.php has been figured out by pavlukivan and Italian APK Downloader, so credits to them
