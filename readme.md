# Example addon extension to TYPO3 extension femanager
instruction related to the company

1) add these variables in the $GLOBALS['TYPO3_CONF_VARS']
```php
'API' => [
        'grant_type' => 'your salesforce account password',
        'client_id' => 'your salesforce client id',
        'client_secret' => 'your salesforce client secret',
        'username' => 'salesforce username',
        'password' => 'salesforce password',
    ]
```

2) modify the composer.json to look for packages on the server

```json
"repositories": [
        {
            "type": "path",
            "url": "ssh://admin@pasake.han-solo.net/home/admin/repositories/reactiverobotics/femanager-extended/*"
        },
        {
            "type": "composer",
            "url": "https://composer.typo3.org/"
        }
    ]
```
