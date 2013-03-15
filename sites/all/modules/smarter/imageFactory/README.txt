Issue Summary

The imagefactory module can be used to resize image and add infinite text with cumstom fonts .
It will save picture on in public file path and add record to file_managed table.
Features

    You can set width and height to resize area.
    Ajax action to resize ,add text and save.
    You can upload fonts and manage them.

Usesg

  First use
    You should upload ttf fonts to server.
  The tmp picture remove
    When you create picture by imageFactory, module will create temporary file in public://imagefactory/tmp ,
     the cron job will automatic remove them. You can manually remove by call cron
  How to choose the image you create
    You can use 'IMCE for File Field' or 'entity reference'.

Requirements:
    GD library

module url
    http://drupal.org/sandbox/jeffstric/1937132

