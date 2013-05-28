# Curtiss
Curtiss is the lightweight static site framework built for use with PHP5.2. Curtiss comes from the name of 'Curtiss Carrier Pigeons', an old school way of 'routing' a message between to parties - which is essentially what this application is; routing a url to a view.

## Using Curtiss
Give him a whirl - follow these simple steps to get started:

#### Step 1 - Change the .htaccess:
Open up the .htaccess file and change the path of your site. Once you open the .htaccess you will see something similar to the below, you will want to put whatever the directory of your site is in place of the 'replaceme' shown below:
```code
<IfModule mod_rewrite.c>
     RewriteEngine on

     RewriteCond %{REQUEST_FILENAME} !-f
     RewriteCond %{REQUEST_FILENAME} !-d

     RewriteRule ^(.*)$ /replaceme/index.php/$1 [L]
</IfModule>
```

#### Step 2 - Create a view:
All views are held within the folder /views. Create a new view within here.

You have two options, you can use the default header &amp; footer or you can use your own within that view. Your best off using the generic header &amp; footers though.

#### Step 3 - Routing the view:

Assuming you haven't skipped step 2 and you have a view, you will need to route to that view.

Open up index.php - this is the main application file, this is the only file you will be working from.

For each view, you are going to use the Template classes Render method. To load in a test.php view to load from /test you would do the following:

```php
    /**
     * /test is the location within the URL
     * test.php is the view to load
     */
    Template::render('/test', 'test.php');
```

### Advanced!

Welcome to the advanced section, this is where you will learn how to do more than just load a view!

#### Passing in parameters
You may need to pass in parameters into the view, such as setting the script or stylesheet. You can do this by passing in an array into the Render method, like so:

```php
    /**
     * /test is the location within the URL
     * test.php is the view to load
     */
    Template::render('/test', 'test.php', array('style' => 'home', 'script' => 'main'));
```

#### Custom Header or Footer

You may not want to use the default header and footers, good news is that you can use your own within the view itself!

You will just need to set the last couple of arguments going into Render to FALSE - as they are defaulted to TRUE at all times.

```php
    /**
     * /test is the location within the URL
     * test.php is the view to load
     */
    Template::render('/test', 'test.php', array('style' => 'home', 'script' => 'main'), false, false);
```

### Additional Note:

If you have PHP5.4 installed on your computer, point to it! Ironically, although this is a PHP5.2 application I've set up a Rake task to load an internal PHP Server.

So if you run the command `Rake server` you can access the site at `localhost:9292` in your browser.

Why would you do this?! To keep everything seperate from MAMP and to load in the specific site of course.

