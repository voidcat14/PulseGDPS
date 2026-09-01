# Geode mod index and storage

The `geode` Compose profile runs the official Geode Index server, PostgreSQL 17, and nginx. Uploaded mod packages and public downloads persist in the `geode-storage` Docker volume; API data persists in `geode-postgres-data`.

Set a strong `GEODE_DB_PASSWORD` in your environment, then start it:

```bash
docker compose --profile geode up -d
```

Set `GEODE_APP_URL` and `GEODE_FRONT_URL` to your public HTTPS URL before production use. The nginx container serves `/static/` and `/storage/` directly and proxies the API to the Geode server. Configure your outer HTTPS proxy to forward to `GEODE_PORT` (default 3000).

Only upload mods you are authorized to distribute. Back up both Geode volumes before upgrades.
