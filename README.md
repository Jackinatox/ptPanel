[![Logo Image](https://cdn.pterodactyl.io/logos/new/pterodactyl_logo.png)](https://pterodactyl.io)
# My Changes

## API Additions

### Application API — User API Key Management

Endpoints for managing API keys on behalf of any user via the admin application API.

| Method   | Endpoint                                              | Description                          |
| -------- | ----------------------------------------------------- | ------------------------------------ |
| `GET`    | `/api/application/users/{user}/api-keys`              | List all API keys for a user         |
| `POST`   | `/api/application/users/{user}/api-keys`              | Create a new API key for a user      |
| `DELETE` | `/api/application/users/{user}/api-keys/{identifier}` | Delete a specific API key for a user |


### Application API — Free Allocations

Endpoint to retrieve all unassigned allocations on a given node.

| Method | Endpoint                                         | Description                                       |
| ------ | ------------------------------------------------ | ------------------------------------------------- |
| `GET`  | `/api/application/nodes/{node}/allocations/free` | List all free (unassigned) allocations for a node |

---

### Client API — JSON File Write

An alternative file write endpoint that accepts `file` and `content` as JSON body fields, instead of the raw request body used by the existing `/files/write` endpoint.

| Method | Endpoint                                    | Description                                     |
| ------ | ------------------------------------------- | ----------------------------------------------- |
| `POST` | `/api/client/servers/{server}/files/update` | Write file content via JSON `{ file, content }` |

---

# Pterodactyl Panel

Pterodactyl® is a free, open-source game server management panel built with PHP, React, and Go. Designed with security
in mind, Pterodactyl runs all game servers in isolated Docker containers while exposing a beautiful and intuitive
UI to end users.

Stop settling for less. Make game servers a first class citizen on your platform.

![Image](https://cdn.pterodactyl.io/site-assets/pterodactyl_v1_demo.gif)

## Documentation

-   [Panel Documentation](https://pterodactyl.io/panel/1.0/getting_started.html)
-   [Wings Documentation](https://pterodactyl.io/wings/1.0/installing.html)
-   [Community Guides](https://pterodactyl.io/community/about.html)
-   Or, get additional help [via Discord](https://discord.gg/pterodactyl)

## Sponsors

I would like to extend my sincere thanks to the following sponsors for helping fund Pterodactyl's development.
[Interested in becoming a sponsor?](https://github.com/sponsors/pterodactyl)

| Company                                                                           | About                                                                                                                                                                                                                                           |
| --------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| [**Aussie Server Hosts**](https://aussieserverhosts.com/)                         | No frills Australian Owned and operated High Performance Server hosting for some of the most demanding games serving Australia and New Zealand.                                                                                                 |
| [**BisectHosting**](https://www.bisecthosting.com/)                               | BisectHosting provides Minecraft, Valheim and other server hosting services with the highest reliability and lightning fast support since 2012.                                                                                                 |
| [**MineStrator**](https://minestrator.com/)                                       | Looking for the most highend French hosting company for your minecraft server? More than 24,000 members on our discord trust us. Give us a try!                                                                                                 |
| [**HostEZ**](https://hostez.io)                                                   | US & EU Rust & Minecraft Hosting. DDoS Protected bare metal, VPS and colocation with low latency, high uptime and maximum availability. EZ!                                                                                                     |
| [**Blueprint**](https://blueprint.zip/?utm_source=pterodactyl&utm_medium=sponsor) | Create and install Pterodactyl addons and themes with the growing Blueprint framework - the package-manager for Pterodactyl. Use multiple modifications at once without worrying about conflicts and make use of the large extension ecosystem. |
| [**indifferent broccoli**](https://indifferentbroccoli.com/)                      | indifferent broccoli is a game server hosting and rental company. With us, you get top-notch computer power for your gaming sessions. We destroy lag, latency, and complexity--letting you focus on the fun stuff.                              |

### Supported Games

Pterodactyl supports a wide variety of games by utilizing Docker containers to isolate each instance. This gives
you the power to run game servers without bloating machines with a host of additional dependencies.

Some of our core supported games include:

-   Minecraft — including Paper, Sponge, Bungeecord, Waterfall, and more
-   Rust
-   Terraria
-   Teamspeak
-   Mumble
-   Team Fortress 2
-   Counter Strike: Global Offensive
-   Garry's Mod
-   ARK: Survival Evolved

In addition to our standard nest of supported games, our community is constantly pushing the limits of this software
and there are plenty more games available provided by the community. Some of these games include:

-   Factorio
-   San Andreas: MP
-   Pocketmine MP
-   Squad
-   Xonotic
-   Starmade
-   Discord ATLBot, and most other Node.js/Python discord bots
-   [and many more...](https://pterodactyleggs.com)

## License

Pterodactyl® Copyright © 2015 - 2022 Dane Everitt and contributors.

Code released under the [MIT License](./LICENSE.md).
