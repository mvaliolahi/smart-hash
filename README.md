# Laravel Eloquent Models Smart-HashIDs

### What is the hashids? 

> Hashids is a small open-source library that generates short, unique, non-sequential ids from numbers.
    It converts numbers like 347 into strings like “yr8”, or array of numbers like [27, 986] into “3kTMd”.
    
For more information visit [hashids.org](https://hashids.org/).

# Why we should use this library?

- Easy to use!
- Hidden our database ids from client.
- Automatic encode model id for front-end and decode for back-end (Decode all `id` or `ids` requests from parameters or the body)
- Does not need to methods like `findByHashid`

# Installation

```bash
composer require mvaliolahi/smart-hash
```

## How to use

1. inside your Model use `SmartHash` trait.

```php
class Category extends Model
{
    use SmartHash;
}
```

    Note: You can access to original id using the $category->id() method.

After use SmartHash Trait, Category::first()->id will return `jR` not `1`

2. Inside you boot method in AppServiceProvider define your models because of `route model binding`: 

```php
$this->app->singleton('smart-hash', function() {
    return [
        'category' => Category::class,
        'user'     => User::class,
    ];
});
```

## What happens if the client send us  hash id or ids parameter?

Your client deals with hash id, but each time your app received `id` or `ids` in the request SmartHash will decode it for you.


## road-map:

    Step 2 can be removed in the next version.