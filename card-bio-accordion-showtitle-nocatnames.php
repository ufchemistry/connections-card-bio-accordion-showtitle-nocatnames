<?php
/**
 * @package    Connections
 * @subpackage Template : Bio Card Accordion Showtitle No Category Names
 * @author     Steven A. Zahm
 * @since      0.7.9
 * @license    GPL-2.0+
 * @link       http://connections-pro.com
 * @copyright  2013 Steven A. Zahm
 *
 * @wordpress-plugin
 * Plugin Name:       Bio Card Accordion Showtitle No Category Names - Template
 * Plugin URI:        http://connections-pro.com
 * Description:       This is a variation of the default template which shows the bio field for an entry.
 * Version:           2.0.1
 * Author:            Steven A. Zahm
 * Author URI:        http://connections-pro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function getHtmlTagArrayAccTitleNoCatNames($htmlTag) {
	##parse html tag into an array of paramaters=>values
	##print("*test: <pre>htmlTag1=$htmlTag</pre><br />\n");
	$htmlTag = str_replace('<img ', '"img" ', $htmlTag);
	##print("*test: htmlTag2=$htmlTag<br />\n");
	$htmlTag = str_replace('<', ' ', $htmlTag);
	$htmlTag = str_replace('>', ' ', $htmlTag);
	##print("*test: htmlTag3=$htmlTag<br />\n");
	$paramArray = preg_split("[\" ]", $htmlTag);
	$htmlTagArray = '';
	if (is_array($paramArray)) {
		while($current = each($paramArray)) {
			$key = $current['key'];
			$value = trim($current['value']);
			##print("*test: $key=$value<br/>\n");
			if (strstr($value, '=')) {
				list($thiskey, $thisvalue) = preg_split("[=]", $value);
				$thiskey = trim($thiskey);
				$thisvalue = trim($thisvalue);
				$thisvalue = str_replace('"', '', $thisvalue);
				$thisvalue = str_replace("'", '', $thisvalue);
				if (($thiskey) AND ($thisvalue)) { $htmlTagArray[$thiskey] = $thisvalue; }
			}
		}
	}
	return($htmlTagArray);
} ##END function getHtmlTagArrayAccTitleNoCatNames($imgTag)


function cn_remove_list_no_result_message55() {
    remove_action( 'cn_list_no_results', array( 'cnTemplatePart', 'noResults' ), 10 );
}

add_action( 'plugins_loaded', 'cn_remove_list_no_result_message55', 12 );


if ( ! class_exists( 'CN_Bio_Card_Accordion_Showtitle_Nocatnames_Template' ) ) {

	class CN_Bio_Card_Accordion_Showtitle_Nocatnames_Template {

		public static function register() {

			$atts = array(
				'class'       => 'CN_Bio_Card_Accordion_Showtitle_Nocatnames_Template',
				'name'        => 'Bio Card Accordion Showtitle No Category Names',
				'slug'        => 'card-bio-accordion-showtitle-nocatnames',
				'type'        => 'all',
				'version'     => '2.0.1',
				'author'      => 'Steven A. Zahm',
				'authorURL'   => 'connections-pro.com',
				'description' => 'This is a variation of the default template which shows the bio field for an entry.',
				'custom'      => TRUE,
				'path'        => plugin_dir_path( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
				'thumbnail'   => 'thumbnail.png',
				'parts'       => array(),
				);

			cnTemplateFactory::register( $atts );
		}

		public function __construct( $template ) {
			$this->template = $template;

			$template->part( array( 'tag' => 'card', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
			$template->part( array( 'tag' => 'card-single', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
		}


		public static function card( $entry, $template, $atts ) {

/*

global $noResultMessage, $defaults;
$noResultMessage = 'test';
$defaults['message'] = 'test2';
print("*TEST!");
*/
			?>
<?php
global $thisCatFound;
$thisCat = strip_tags($entry->getCategoryBlock( array( 'label' => '', 'separator' => ', ', 'before' => '', 'after' => '', 'return' => TRUE ) ));
?>
<?php
$paddingBottom = '0px';
/* Remove category name display
if (!$thisCatFound[$thisCat]) {
	print('<h2 style="padding-left:20px; padding-top:20px" id="squelch-taas-title-0" class="squelch-taas-group-title">');
	print($thisCat);
	print("</h2>\n");
	$paddingBottom = '0px';
	$thisCatFound[$thisCat] = TRUE;
}
*/
?>
<div style="padding-left:10px; padding-bottom:<?php print($paddingBottom); ?>" role="tablist" id="squelch-taas-accordion-0" class="squelch-taas-accordion squelch-taas-override ui-accordion ui-widget ui-helper-reset" data-active="false" data-disabled="false" data-autoheight="false" data-collapsible="true">
<h3 style="padding-top:5px !important; line-height:26px;" tabindex="-1" aria-selected="false" aria-controls="ui-accordion-squelch-taas-accordion-0-panel-0" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ui-accordion-icons" id="squelch-taas-header-0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span><a href="#squelch-taas-accordion-shortcode-content-0">
<?php echo $entry->getNameBlock(array('link' => '')); ?></a><br /> <span style="font-size: 18px; font-weight:100;"><?php
$title = '';
$title = $entry->getTitleBlock(array('return' => TRUE));
$title = strip_tags($title);
echo $title;
 ?></span></h3>
<div aria-hidden="true" aria-expanded="false" role="tabpanel" aria-labelledby="squelch-taas-header-0" id="ui-accordion-squelch-taas-accordion-0-panel-0" style="display: none;" class="squelch-taas-accordion-shortcode-content-0 ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style=" padding-left:5px !important; padding-right: 5px !important;">
			<div class="cn-entry" style="-moz-border-radius:4px; background-color:#FFFFFF; border:1px solid #E3E3E3; color: #000000; margin:5px 0px; padding:3px; position: relative;">
					<?php 
$image = '';
$photo = '';
$photo2 = '';
$photo3 = '';
$photoTagArray = '';
$srcse = '';
$photoUrl = '';
$mag = '';
$photowidth = '';
$photoheight = '';
$photoalt = '';

##$entry->getImage();

$image = $entry->getImage( array( 'image' => 'photo' , 'preset' => 'thumbnail', 'return' => TRUE, 'action' => 'none' ) );
$photo = $entry->getImage( array( 'image' => 'photo' , 'preset' => 'profile', 'return' => TRUE, 'action' => 'none', 'style' => FALSE ) );

if ($photo) {
	list($span1, $span2, $photo2, $endspan1, $endspan2) = explode('><', $photo);
	$photoTagArray = getHtmlTagArrayAccTitleNoCatNames($photo);
	$srcset = $photoTagArray['srcset'];
	list($photoUrl, $mag) = explode(' ', $srcset);
	$photowidth = $photoTagArray['width'];
	$photoheight = $photoTagArray['height'];
	$photoalt = $photoTagArray['alt'];
	##echo "photoUrl=" . $photoUrl . "end<br>";
	echo "<div style=\"padding-right; 3px; width:{$photowidth}; height:{$photoheight};\">" . $photo . "</div>";
}
if ($photo2) {
	$photo3 = '<' . $photo2 . '>';
	$photo3 = str_replace(' 1x', '', $photo3);
	$photo3 = str_replace('srcset=', 'src=', $photo3);
}
if ((!$photo) AND ($photo3)) {
	echo '<span class="cn-image-style"><span style="display: block; max-width: 100%; width: 180px">' . $photo3 . '</span></span>';
}



?>
					<!--<div style="clear:both;"></div>-->
					<div style="margin-bottom: 10px; float:left; width:49%; padding-left:5px;">
						<!--<span style="font-size:larger;font-variant: small-caps"><strong><?php echo $entry->getNameBlock(array('link' => '')); ?></strong></span>-->
						
						<?php $entry->getOrgUnitBlock(); ?>
						<?php $entry->getContactNameBlock(); ?>

						<?php
							$address = $entry->getAddressBlock( array( 'return' => TRUE, 'action' => 'none' ) );
							$address = preg_replace('[Other]', 'Office', $address);
							$address = preg_replace('[<span class="address-name">Work</span>]', '', $address);

							echo $address;
##<span class="address-name">Work</span>
						?>
				</div>
<!--<div style="clear:both;"></div>-->
				<div style="margin-bottom: 10px;">

					<?php $entry->getFamilyMemberBlock(); ?>
					<?php $entry->getPhoneNumberBlock(); ?>
					<?php $entry->getEmailAddressBlock(); ?>
					<?php $entry->getSocialMediaBlock(); ?>
					<?php $entry->getImBlock(); ?>
					<?php
$website = $entry->getLinkBlock( array( 'return' => TRUE, 'action' => 'none' ) );
##$website = str_replace('_self', '_blank', $website);
$website = str_replace(' rel="nofollow"', '',  $website);
echo $website;
?>
					<?php $entry->getDateBlock(); ?>


				</div>

<?php
##global $atts;
##$test = $atts['str_other_addr'];
##$test2 = $atts['str_work_email'];
##echo '.<!--' . $test . ' ';
##print_r($entry);
##echo ' ' . $test . "-->.";
?>

				<!--<div style="clear:both"></div>-->

				<?php echo $entry->getBioBlock(); ?>
<?php
/* ***Get Custom field results and display if they exist: Education & Keywords *** */
	##$thisentry = $entry->getMetaBlock(array('separator' => '-'),'',''); ##smk removed custom field display on 6/2/2017

	global $BlockResults;
	$fieldName = '';
	$BlockResults = '';
	$thisEducation = '';
	$fieldName = 'Education';
	echo '<!--';
	$thisEducation = $entry->getMetaBlock( array('key' => $fieldName, 'return' => TRUE), $atts['content'], $atts, $template );
	$thisEducation = $BlockResults;
	echo '-->';
	##echo '*test: thisEducation=' . $thisEducation . "<br>\n";
	$msplit1 = '1: </h3>1, ';
	$msplit2 = '0: </h3>0, ';
	$msplit3 = '</li>';
	if ( (!empty($thisEducation)) aND (!is_array($thisEducation)) AND ((stripos($thisEducation, $msplit1)) OR (stripos($thisEducation, $msplit2)) ) ) {
		if (stripos($thisEducation, $msplit1)) {
			list($meta1, $meta2) = preg_split("[$msplit1]", $thisEducation);
		}
		else if (stripos($thisEducation, $msplit2)) {
			list($meta1, $meta2) = preg_split("[$msplit2]", $thisEducation);
		}
		list($meta3, $meta4) = preg_split("[$msplit3]", $meta2);
		if (!empty($meta3)) {
			$thisEducation = '<span class="adr cn-address"><span class="address-name">' . $fieldName . ': </span>' . $meta3 . '</span>';
			##echo "*test meta2=$meta2<br>meta3=$meta3<br>";
			echo $thisEducation;
		}
	}

	$fieldName = '';
	$BlockResults = '';
	$thisEducation = '';
	$fieldName = 'Keywords';
	echo '<!--';
	$thisEducation = $entry->getMetaBlock( array('key' => $fieldName, 'return' => TRUE), $atts['content'], $atts, $template );
	$thisEducation = $BlockResults;
	echo '-->';
	##echo '*test: thisEducation=' . $thisEducation . "<br>\n";
	$msplit1 = '1: </h3>1, ';
	$msplit2 = '0: </h3>0, ';
	$msplit3 = '</li>';
	if ( (!empty($thisEducation)) aND (!is_array($thisEducation)) AND ((stripos($thisEducation, $msplit1)) OR (stripos($thisEducation, $msplit2)) ) ) {
		if (stripos($thisEducation, $msplit1)) {
			list($meta1, $meta2) = preg_split("[$msplit1]", $thisEducation);
		}
		else if (stripos($thisEducation, $msplit2)) {
			list($meta1, $meta2) = preg_split("[$msplit2]", $thisEducation);
		}
		list($meta3, $meta4) = preg_split("[$msplit3]", $meta2);
		if (!empty($meta3)) {
			$thisEducation = '<span class="adr cn-address"><span class="address-name">' . $fieldName . ': </span>' . $meta3 . '</span>';
			##echo "*test meta2=$meta2<br>meta3=$meta3<br>";
			echo $thisEducation;
		}
	}

/* ***END: Get Custom field results and display if they exist: Education & Keywords *** */

?>

				<!--<div style="clear:both"></div>-->

				<div class="cn-meta" align="left" style="margin-top: 6px">

					<?php
## remove this to get rid of duplicate "custom" field listings 2/24/2015 by SMK
 ##$entry->getContentBlock( $atts['content'], $atts, $template );

 ?>


					<!--<div style="display: block; margin-bottom: 8px;"><?php $entry->getCategoryBlock( array( 'separator' => ', ', 'before' => '<span>', 'after' => '</span>' ) ); ?></div>-->

					<?php if ( cnSettingsAPI::get( 'connections', 'connections_display_entry_actions', 'vcard' ) ) $entry->vcard( array( 'before' => '<span>', 'after' => '</span>' ) ); ?>

					<?php
					/*

					cnTemplatePart::updated(
						array(
							'timestamp' => $entry->getUnixTimeStamp(),
							'style' => array(
								'font-size'    => 'x-small',
								'font-variant' => 'small-caps',
								'position'     => 'absolute',
								'right'        => '36px',
								'bottom'       => '8px'
							)
						)
					);

					cnTemplatePart::returnToTop( array( 'style' => array( 'position' => 'absolute', 'right' => '8px', 'bottom' => '5px' ) ) );
					*/

					?>

				</div>

			</div>
</div>
</div>
<?php
		}

	}

	// Register the template.
	add_action( 'cn_register_template', array( 'CN_Bio_Card_Accordion_Showtitle_Nocatnames_Template', 'register' ) );
}
