php-malcode-cleaner-33db9538-9507c4e8-e5b57288-54dfa1cb
=======================================================
Recently our WordPress sites got hacked. I wrote these `php`s to help clean the malcode.

## Usage

Upload `__cleaner.php` and `__cleaner__trash.php` to the root directory of your site.

1. Request `http://yoursite.com/__cleaner.php` and check the logs on the screen.
   (If you accidently refresh the page you can still check `http://yoursite.com/__cleaner__log.html` for history.)

2. Carefully check your site's functionality.

3. After ensuring that everything goes well, request `http://yoursite.com/__cleaner__trash.php` to clean automatically generated backups.

4. Delete `__cleaner.php` and `__cleaner__trash.php`.

## References

Please see http://security.stackexchange.com/questions/47253/hacked-site-encrypted-code

In Chinese: http://www.v2ex.com/t/94586

## License

No license. Use at your own risk.
