# TS3 Server Viewer
## Setup

1. Download the latest release (or clone the repo)
2. Unzip the files in a subfolder on your website
3. Edit the config.inc.php
4. Add the ServerViewer to your website via object or directly via php
5. ???
6. Profit

## Add the ServerViewer via object

Add the following to your website

```
<object type="text/html" data="PUBLIC PATH TO INDEX.PHP" style="width: 100%; height: 100%;"></object>
```


## Add the ServerViewer via PHP

You need to make sure that you have bootstrap 4 jquerry and fontawesome 4
Else you can edit the serverviewer.inc.php directly
Add the following inside your header or inside your custom.css file
```
<style>
    html {
      width: 100%;
      height: 100%;
    }
    /* Server Viewer */
    .server-viewer ul {
        list-style: none;
        padding-left: 1.5em;
    }

    .server-viewer .spacer {
       margin-top: 0.5rem;
       margin-bottom: 0.5rem;
    }
    .server-viewer .client , .server-viewer .channel {
     margin-top: 0.1rem;
     margin-bottom: 0.1rem;
    }
</style>
```
Then add the following at the point where you want have your serverviewer
```
<div class="server-viewer">
<?php
	require_once(__DIR__ . '/serverviewer.inc.php');
	echo(getServerViewer());
?>
</div>
```

## Files & Directories

- cache -> is used to cache the serverviewer
- lib
	-  simplephpcache used for the cache
	-  TeamSpeak3 this is used to get the ts3 server informations
- img -> contains images for the default server groups
- config.inc.php -> config file
- index.php -> provides the bootstrap default version for object/iframe
- serverviewer.inc.php -> contains the php code for building the tree for server viewer
- serverviewer.php -> displays a html version for the viewer. its also used for refreshing via ajax
- test.php -> Example Page with intergration via object

## Used Libaries and other Stuff
- Bootstrap 4 <https://github.com/twbs/bootstrap>
- Teamspeak 3 PHP Libary by Planet TeamSpeak <https://github.com/planetteamspeak/ts3phpframework>
- Simple-PHP-Cache by cosenary <https://github.com/cosenary/Simple-PHP-Cache>
- jQuery <https://jquery.com/>
