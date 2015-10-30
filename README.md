# Archive CMS Pages and CMS Blocks for Magento CE


### **Introduction**
This plugin adds version control to your CMS pages and blocks, automatically saving a revision every time you save.

You can restore, preview and delete previous revision using the simple interface. This means you can manage previous revisions easily.

### **Installation**
Disable all caches under “System > Cache Management” and make sure Magento Compilation is disabled under “System > Tools > Compilation”. This is necessary to avoid any caching problems after the installation of an extension.

Copy the files into your Magento Root directory

Re-enable your cache settings under “System > Cache Management” and if used enable Magento Compilation under “System > Tools > Compilation”. The installation is now completed.

You can view the Page Versioning  in menu “CMS => Pages” and there’s a new tab on the right hand side.
You can view the Block Versioning in menu “CMS => Static Blocks”, there's a new drop down in the top right corner.

### **Use**


Whenever you save a CMS Page, a revision is automatically created, with a revision you can

Restore – this restores the revision and overwrites the existing version

Preview – this allows you to see what this version looks like with the default store

Delete – this allows you to delete this version

### To Do

*Improve Static Block Archive UI

### Disclaimer

* Minimal support is offered, use at your own risk. I would recommend deploying to a dev/staging environment first and testing your site before deploying to a live site.

### License
The license is currently <a href="https://tldrlegal.com/license/creative-commons-attribution-noncommercial-(cc-nc)#summary">Creative Commons Attribution NonCommercial</a>.  TL;DR is that you can modify and distribute but not for commercial use.

