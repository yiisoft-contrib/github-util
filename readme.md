# Various github-related utilities

## Ensure labels

For a each repository from `config/packages.php` renames labels according to `config/labels-rename.php` and then
ensures it has labels specified in `config/labels.php`.

Usage `php ensure-labels.php <your github token>`.
