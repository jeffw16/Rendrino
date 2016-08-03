# Rendrino
A simple Markdown-based static page CMS implemented with PHP. Easily maintain your static pages!

## Installation
Rendrino is designed to be up and running as soon as possible. You can expect to complete installation within 5 minutes. From there, we have extensive customizability.
By the way, we use Parsedown. We thank them for their amazing product and effort in creating such a great parser for Markdown!

### Requirements and recommendations
* PHP 5.3 or later (not clear about PHP 7 support)
* (Recommended) Apache 2

### Procedure
1. Copy our repo somewhere. The main file is called `rendrino.php` and is also the frontend.
2. Configure the settings of `rendrino.php` near the top of the file. There isn't much to do, and it will run well on the default settings if you don't mess with anything in the repo. Basically, just make sure everything is in order.
3. Test it.

## Usage

### Viewing pages
Your pages will be served through `rendrino.php` and pass in the query `?p=[pagenamehere]`. Rendrino will then serve the contents in `[pagenamehere].md` based on the settings specified in `[pagenamehere].json`.

The default page that is served, in the absence of a value for the "p" URL query, is `rendrino.md`. Think of it as `index.html`.

Note that our included `.htaccess` file will now rewrite `/rendrino.php?p=[value]` to `/s/[value]`. You may edit this directive yourself at your own risk.

### Creating pages
You can make pages by creating a corresponding `.md` and `.json` file. For example, a page accessible at `/rendrino.php?p=mypgname` would need two files: `mypgname.md` and `mypgname.json`.

#### Hierarchy of page storage
Your pages are stored within a folder that is specified by the user-configurable `$rendrino_assets` variable in `rendrino.php` and its default value is `rendrino_assets/`. The trailing slash is intentional and is required; if you choose, you are able to forgo the slash and configure `$rendrino_assets`'s value to be a common prefix instead.

#### .json configuration file
This is the configuration file for your ''individual'' Rendrino page (not for the entire Rendrino website). It contains things that you'd fill in for the `<title>, <meta name="description">, <meta name="author">, <head>, and <body>` tags. Additionally, you are able to add modules to your page. Currently, we have jQuery and Bootstrap, but we intend on creating an expandable system for serving dependencies.

To add a module, simply add this to your configuration file. (Module names are case sensitive.)
```
"modules": [
"jquery", "bootstrap"
]
```
Please note that this example lists both jQuery and Bootstrap in the required array format. In reality however, jQuery is itself a dependency of Bootstrap, so simply listing "bootstrap" would implicitly serve the jQuery module. Since we currently do not have any other modules, we are not able to show any other combinations.

#### .md content file
Your Markdown content should be stored in this file. The content will be parsed by Parsedown and directly inserted into the `<body>` portion of your webpage.

## Philosophy
We believe in:
* minimal resources. PHP achieves this because basically all web servers for hosting have this installed.
* minimal setup. Setup scripts are gross, and Rendrino will never require that.
* simplicity. JSON and Markdown should make your life much easier!
