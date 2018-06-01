<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.CCCyoutubefield
 *
 * @copyright   Copyright (C) 2017 Coolcat-Creations.com, Elisa Foltyn.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class PlgContentCccyoutube extends CMSPlugin
{


	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer') {
			return true;
		}

		if (is_object($row)) {


			$this->youtubeToVideo($row->text);

			HTMLHelper::_('jquery.framework');

			HTMLHelper::_('stylesheet', 'plg_cccyoutube/cccyoutube.css', array('version' => 'auto', 'relative' => true));
			HTMLHelper::_('script', 'plg_cccyoutube/cccyoutube.js', array('version' => 'auto', 'relative' => true));


			return true;
		}

		$this->youtubeToVideo($row);

		return true;
	}

	protected function youtubeToVideo(&$text)
	{


		$tagname = "cccyoutube";

		$pattern = "#{\s*?$tagname\b[^}]*}(.*?){/$tagname\b[^}]*}#s";

		$text = preg_replace($pattern, $this->replaceYoutube('$1'), $text);

		return true;
	}

	protected function replaceYoutube($videoId)
	{

		$replaceString = '<div class="cccyoutube" data-embed="' . htmlentities($videoId) . '"><div class="play-button"></div></div>';

		return $replaceString;
	}

}



