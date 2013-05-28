# Curtiss
Curtiss is the lightweight static site framework built for use with PHP5.2. Curtiss comes from the name of 'Curtiss Carrier Pigeons', an old school way of 'routing' a message between to parties - which is essentially what this application is.

## Using Curtiss
Give him a whirl - follow these simple steps to get started:

#### Step 1:
Open up the .htaccess file and change the path of your site. Once you open the .htaccess you will see the blow, just replace the section highlighted:

```code
<IfModule mod_rewrite.c>
     RewriteEngine on

     RewriteCond %{REQUEST_FILENAME} !-f
     RewriteCond %{REQUEST_FILENAME} !-d

     RewriteRule ^(.*)$ /<strong>me</strong>index.php/$1 [L]
</IfModule>
```
