# Rendrino
A simple Markdown-based static page CMS implemented with PHP. Easily maintain your static pages!

## Installation
Rendrino is designed to be up and running as soon as possible. You can expect to complete installation within 5 minutes. From there, we have extensive customizability.
By the way, we use Parsedown. We thank them for their amazing product and effort in creating such a great parser for Markdown!

### Requirements and recommendations
* PHP 5.3 or later (not clear about PHP 7 support)
* (Recommended) Apache 2

### Procedure
1. Copy our repo somewhere. The main file is called ```rendrino.php``` and is also the frontend.
2. Configure the settings of ```rendrino.php``` near the top of the file. There isn't much to do, and it will run well on the default settings if you
don't mess with anything in the repo. Basically, just make sure everything is in order.
3. Test it.

## Usage

### Viewing pages
Your pages will be served through ```rendrino.php``` and pass in the query ```?p=[pagenamehere]```. Rendrino will then serve the contents in ```[pagenamehere].md```
based on the settings specified in ```[pagenamehere].json```.

The default page that is served, in the absence of a value for the "p" URL query, is ```rendrino.md```. Think of it as ```index.html```.

Note that our included ```.htaccess``` file will now rewrite ```/rendrino.php?p=[value]``` to ```/s/[value]```.

### Creating pages
You can make pages by creating a corresponding ```.md``` and ```.json``` file. For example, a page accessible at ```/rendrino.php?p=mypgname``` would need
two files: ```mypgname.md``` and ```mypgname.json```.

#### .json configuration file
This is the configuration file for your ''individual'' Rendrino page (not for the entire Rendrino website). It contains things that you'd fill in for
the ```<title>, <meta name="description">, <meta name="author">, <head>, and <body>``` tags.

## Philosophy
We believe in:
* minimal resources. PHP achieves this because basically all web servers for hosting have this installed.
* minimal setup. Setup scripts are gross, and Rendrino will never require that.
* simplicity. JSON and Markdown should make your life much easier!
