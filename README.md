# OSHITSD/onsitetracker
This is used for user onsite time tracking

[![oshit-sd - onsitetracker](https://img.shields.io/static/v1?label=oshit-sd&message=onsitetracker&color=blue&logo=github)](https://github.com/oshit-sd/onsitetracker "Go to GitHub repo")
[![stars - onsitetracker](https://img.shields.io/github/stars/oshit-sd/onsitetracker?style=social)](https://github.com/oshit-sd/onsitetracker)
[![forks - onsitetracker](https://img.shields.io/github/forks/oshit-sd/onsitetracker?style=social)](https://github.com/oshit-sd/onsitetracker)


_Repo metadata_


[![GitHub tag](https://img.shields.io/github/tag/oshit-sd/onsitetracker?include_prereleases=&sort=semver&color=blue)](https://github.com/oshit-sd/onsitetracker/releases/)
[![License](https://img.shields.io/badge/License-MIT-blue)](#license)
[![issues - onsitetracker](https://img.shields.io/github/issues/oshit-sd/onsitetracker)](https://github.com/oshit-sd/onsitetracker/issues)

## License

Released under [MIT](/LICENSE) by [@oshit-sd](https://github.com/oshit-sd).
## Installation

You can install the package in to a Laravel project that uses OnsiteTracker via composer:

```bash
composer require onsite/tracker
```

Next, run this command for publish assets

```console
php artisan vendor:publish --tag=tracker-assets

<!-- report controller -->
php artisan vendor:publish --tag=tracker-report-controller
```

Migrate Database -
```console
php artisan migrate
```

Finally, add this scripts on your app layout

```
@auth
<script>
    window.trackObj = { track: true, user_id: "{{ auth()->id() }}" }
</script>
<script src="{{ asset('vendor/onsitetracker/onsitetracker.min.js') }}"></script>
@endauth

or you can use publicly
<script>
    window.trackObj = { track: true }
</script>
<script src="{{ asset('vendor/onsitetracker/onsitetracker.min.js') }}"></script>
```

```
Report URL
http://localhost:8000/timeTrack

```