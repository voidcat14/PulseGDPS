# Globed multiplayer

This project runs the official Globed v2 central and game-server images. They are separate services: the central server accepts players and the game server runs gameplay.

1. Start the central server once: `docker compose --profile globed up -d globed-central`.
2. Edit the generated `core.toml` in the `globed-central-data` volume. Set `gd_api_base_url` to your public GDPS API base (for example, `https://gdps.example.com/database`) and keep the generated `gs_password` secret.
3. Configure the game server's generated `config.toml` with the central service URL, the same `gs_password`, and a public `server_address` such as `udp://play.example.com:4349`.
4. Start the game server: `docker compose --profile globed up -d globed-game`.

Expose TCP and UDP 4340, TCP 4342, and TCP/UDP 4349. In the Globed client, enable custom servers and add `tcp://your-host:4340`.

Do not publish the generated game-server password or the internal control port beyond the game server.
