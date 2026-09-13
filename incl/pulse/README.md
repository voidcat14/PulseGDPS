# PulseGDPS Core Rewrite

This directory contains the new PulseGDPS foundation. The rewrite is intentionally incremental: existing MegaSa1nt-compatible endpoints remain available while new services are moved onto smaller, testable components.

## Direction

- PDO-first database access
- MySQL/MariaDB and PostgreSQL support
- Explicit transactions
- Small service classes instead of one giant library
- API-first endpoints
- Centralized validation and error handling
- Dashboard separated from core logic

Do not delete the legacy core until its functionality has been replaced and tested.
