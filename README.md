# OSHITSD/onsitetracker

## Installation

You can install the package in to a Laravel project that uses OnsiteTracker via composer:

```bash
composer require onsite/tracker
```

Next, run this command for publish assets

```console
php artisan vendor:publish --tag=time-track-assets
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