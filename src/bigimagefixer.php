<?php
/**
 * @package     SSOFB.Plugin
 * @subpackage  Content.bigimagefixer
 *
 * @copyright   Copyright (C) 2017 SSOFB. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Big Image Fixer Content Plugin
 *
 * @since  2.5
 */
class PlgContentBigimagefixer extends JPlugin
{

	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  3.7.0
	 */
	protected $app;


     /**
	 * Big image fixer after save content method.
	 * Content is passed by reference, but after the save, so no changes will be saved.
	 * Method is called right after the content is saved.
	 *
	 * @param   string  $context  The context of the content passed to the plugin
	 * @param   object  $article  A JTableContent object
	 *
	 * @return  void
	 *
	 * @since   3.7
	 */
	public function onContentAfterSave($context, $article)
	{
        # get the params
        $maxwidthpixels = (int)$this->params->get('maxwidthpixels', 1000);
        $maxheightpixels = (int)$this->params->get('maxheightpixels', 1000);
        $backupbigimage = (int)$this->params->get('backupbigimage', 1);
        $fixjpg = (int)$this->params->get('fixjpg', 1);
        $fixpng = (int)$this->params->get('fixpng', 1);
        $debug = (int)$this->params->get('debug', 0);
        
        if ($debug) {
            $this->app->enqueueMessage("plugin param, maxwidthpixels: " . $maxwidthpixels );
            $this->app->enqueueMessage("plugin param, maxheightpixels: " . $maxheightpixels );
            $this->app->enqueueMessage("plugin param, backupbigimage: " . $backupbigimage );
            $this->app->enqueueMessage("plugin param, fixjpg: " . $fixjpg );
            $this->app->enqueueMessage("plugin param, fixpng: " . $fixpng );
            $this->app->enqueueMessage("function context: " . $context );
            #$this->app->enqueueMessage("function introtext: " . $article->introtext );
            #$this->app->enqueueMessage("function fulltext: " . $article->fulltext );
        }
        
        # read in the text
        $article_text = $article->introtext . " " . $article->fulltext;

        # find any images in it, making an array
        $images_array = array();
        
        $doc = new DOMDocument();
        @$doc->loadHTML($article_text);

        $tags = $doc->getElementsByTagName('img');

        if ($debug) $this->app->enqueueMessage("tags: <pre>" . print_r($tags, TRUE) . "</pre>" );

        foreach ($tags as $tag) {
            $images_array[] = $tag->getAttribute('src');
        }

        if ($debug) $this->app->enqueueMessage("images: <pre>" . print_r($images_array, TRUE) . "</pre>" );
        if ($debug) $this->app->enqueueMessage("base: " . $_SERVER['DOCUMENT_ROOT'] );
        
        # loop through the images 
        foreach ($images_array as $i=>$image_fn) {
            
            $image_filepath = JPATH_ROOT . "/" . $image_fn;
            
            list($width, $height, $type) = getimagesize($image_filepath);

            if ($debug) $this->app->enqueueMessage("image " . $i . " fn: " . $image_filepath );
            if ($debug) $this->app->enqueueMessage("image " . $i . " width: " . $width );
            if ($debug) $this->app->enqueueMessage("image " . $i . " height: " . $height );
            if ($debug) $this->app->enqueueMessage("image " . $i . " type: " . $type );
            
            # check if it's too big
            if ($width > $maxwidthpixels OR $height > $maxheightpixels ) {

                # check if we're modifying this file type
                if ( ($type == 2 AND $fixjpg) OR ($type == 3 AND $fixpng) ) {
                    
                    # take a copy if backupbigimage is set
                    if ( $backupbigimage ) {
                        $backup_filename = $image_filepath . "_backup";
                        if ( ($type) == 2 ) $backup_filename .= ".jpg";
                        if ( ($type) == 3 ) $backup_filename .= ".png";
                        copy($image_filepath, $backup_filename);
                        if ($debug) $this->app->enqueueMessage("backed up image " . $i . " image as: " . $backup_filename );
                    }
                    
                    $JImage = new JImage($image_filepath);
                    $JImage->resize($maxwidthpixels, $maxheightpixels, FALSE, $JImage::SCALE_INSIDE);
                    $JImage->toFile($image_filepath, $type);
                    if ($debug) $this->app->enqueueMessage("Image " . $i . " resized");
                    
                } else {
                    if ($debug) $this->app->enqueueMessage("Image " . $i . " is type not to be resized" );
                }                         
            } else {
                if ($debug) $this->app->enqueueMessage("Image " . $i . " is ok, not too big" );
            }
        }            
    }
}
