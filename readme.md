# Various github-related utilities

## Ensure labels

For a given package renames labels according to `config/labels-rename.php` and then
ensures it has labels specified in `config/labels.php`.

Usage `php ensure-labels.php <vendor/package> <your github token>`.
