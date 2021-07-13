# Laravel Smart Hash

### How to use

1. inside your Model use `SmartHash` trait.

```php
class Category extends Model
{
    use SmartHash;
}
```

    Note: You can access to original id using the $category->id() method.

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