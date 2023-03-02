# OSHITSD/onsitetracker
This is used for user onsite time tracking

[![Latest Version](https://img.shields.io/github/release/guzzle/guzzle.svg?style=flat-square)](https://github.com/oshit-sd/onsitetracker/releases)
[![Build Status](https://img.shields.io/github/workflow/status/guzzle/guzzle/CI?label=ci%20build&style=flat-square)](https://github.com/oshit-sd/onsitetracker/actions?query=workflow%3ACI)
[![Total Downloads](https://img.shields.io/packagist/dt/guzzlehttp/guzzle.svg?style=flat-square)](https://packagist.org/packages/onsite/)

## Installation

You can install the package in to a Laravel project that uses OnsiteTracker via composer:

```bash
composer require onsite/tracker
```

Next, run this command for publish assets

```console
php artisan vendor:publish --tag=tracker-assets
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
