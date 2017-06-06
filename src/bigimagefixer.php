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
                #$this->app->enqueueMessage("function article: <pre>" . print_r($article, TRUE) . "</pre>" );
                $this->app->enqueueMessage("function introtext: " . $article->introtext );
                $this->app->enqueueMessage("function fulltext: " . $article->fulltext );
                
            }
            
            # read in the text
            $article_text = $article->introtext . " " . $article->fulltext;
            
            
            # find any images in it, making an array
            $number_of_images = substr_count($article_text, "<img ");
            if ($debug) $this->app->enqueueMessage("number_of_images: " . $number_of_images );
            
            $images_array = array();
            
            $doc = new DOMDocument();
            @$doc->loadHTML($article_text);

            $tags = $doc->getElementsByTagName('img');

            if ($debug) $this->app->enqueueMessage("tags: <pre>" . print_r($tags, TRUE) . "</pre>" );

            
            foreach ($tags as $tag) {
                echo $tag->getAttribute('src');
                $images_array[] = $tag->getAttribute('src');
            }

            if ($debug) $this->app->enqueueMessage("images: <pre>" . print_r($images_array, TRUE) . "</pre>" );

            
            /*
            $images_html_array = explode("<img ", $article_text);
            if ($debug) $this->app->enqueueMessage("function article: <pre>" . print_r($images_html_array, TRUE) . "</pre>" );
            
            foreach ($images_html_array AS $html_chunk) {
                if ($debug) $this->app->enqueueMessage("html_chunk: <pre>" . $html_chunk . "</pre>");
                $start_pos = strpos($html_chunk, "src=");
                if ($debug) $this->app->enqueueMessage("start_pos: " . rand(10,20) . $start_pos );
                
            }
            */
            
            # loop through the images 
            foreach ($images as $image_fn) {
                
                
                $size = getimagesize($image_fn);
                $width = $size[0];
                $height = $size[1];
                $type = $size[2];
                
                if ( $type )
                

                
            }            
            
            
            
            
            
            # check the size
            
            
            
            # take a copy if backupbigimage is set
	
	
	
	}




}
