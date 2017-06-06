# Big Image Fixer - Joomla Plugin
This is a Joomla Plugin to fix big images

https://github.com/AndyGaskell/joomla_plugin_bigimagefixer

This plugin will, on save, reduce overly large images that may have been added to content.  The idea came from a chat with Pete Rosetti at J & Beyond in 2017.  It seemed like a simple solution for a problem that comes up somtimes.  The problem is that sometimes an inexpeienced CMS user will upload images without resizing them for web use, which can result in very large page sizes.  These large images are often not noticed by users due to css limiting image size to 100%, or similar template code.  So, in a sense, the plug-in provides a bit of insurance against that happening.


## Installing
I'll try and add this to the JED, but for now, best option is to just go to https://github.com/AndyGaskell/joomla_plugin_bigimagefixer/raw/master/dist/bigimagefixer_latest.zip and install it in the normal way.


## Options
The plugin has a few options, they are...
* Maximum width in pixels: The maximum width in pixels is the size, above which, images will be reduced.
* Maximum height in pixels: The maximum height in pixels is the size, above which, images will be reduced.
* Backup large image: you want to keep a backup of the large image? It will have th suffix _backup
* Process JPG files: Process this file type.
* Process PNG files: Process this file type.
* Enable debug: This enables quite verbose debug.


## Feedback - issues, questions and suggestions
Any ideas, issues or sugestions, please just add an issue in GitHub at https://github.com/AndyGaskell/joomla_plugin_bigimagefixer/issues


## Distribution from GitHub
I was wondering if it is possible to distribute and manage a Joomla extention, with updates, listed on the JED, entierly from GitHub. So it's a bit of a proof-of-concept


## Tools
* create-release.sh - This takes the src files and creates a zip
* git-to-local.sh - copy the git working copy files to a joomla install, the joomla install path is set in the script
* local-to-git.sh - copy files from a joomla install into the git working copy, the joomla install path is set in the script


## Notes and docs
* https://docs.joomla.org/Deploying_an_Update_Server
* https://docs.joomla.org/Help37:Extensions_Extension_Manager_Update
* https://joomla.org/
* https://extensions.joomla.org/
* https://downloads.joomla.org/
* http://rogerdudler.github.io/git-guide/
* https://api.joomla.org/cms-3/classes/JImage.html 
* https://github.com/joomla-framework/image 


## Git cheatsheet

Clone the repo from github to local...

`git clone https://github.com/AndyGaskell/joomla_plugin_bigimagefixer.git`

Add a file...

`git add dist/blah.php`

Commit...

`git commit -m "updates"`

Commit...

`git commit -a -m "udates"`

Send updates to master...

`git push -u origin master`

Get updates from master...

`git fetch origin`

`git pull`


