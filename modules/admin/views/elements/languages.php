<?php 
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
?>
<div class="dropdown dropdown-lang">
	                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                           <?php 
	                           	  if(\Yii::$app->language == 'en-EN' || \Yii::$app->language == 'en' || \Yii::$app->language == '')
	                           	  	  $lang_common = 'us';
	                           	  else if ( \Yii::$app->language == 'vi' )
	                           	  	  $lang_common = 'vn';
	                           	  else
	                           	      $lang_common =  \Yii::$app->language;		
	                           ?>
	                            <span class="flag-icon flag-icon-<?php echo $lang_common; ?>"></span>
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right">
	                            <div class="dropdown-menu-col">
	                                <a class="dropdown-item <?php echo (\Yii::$app->language=="ru")? 'current':'' ?>" href="?lang=ru"><span class="flag-icon flag-icon-ru"></span>Русский</a>
	                                <a class="dropdown-item <?php echo (\Yii::$app->language=="de")? 'current':'' ?>" href="?lang=de"><span class="flag-icon flag-icon-de"></span>Deutsch</a>
	                                <a class="dropdown-item <?php echo (\Yii::$app->language=="fr")? 'current':'' ?>" href="?lang=fr"><span class="flag-icon flag-icon-fr"></span>Français</a>
	                          
	                            </div>
	                            <div class="dropdown-menu-col">
	                                <a class="dropdown-item <?php echo (\Yii::$app->language=="en" || \Yii::$app->language=="en-EN" || \Yii::$app->language == '')? 'current':'' ?>" href="?lang=en"><span class="flag-icon flag-icon-us"></span>English</a>
	                                <a class="dropdown-item <?php echo (\Yii::$app->language=="vi")? 'current':'' ?>" href="?lang=vi"><span class="flag-icon flag-icon-vn"></span>Vietnamese</a>
	                                <a class="dropdown-item <?php echo (\Yii::$app->language=="jp")? 'current':'' ?>" href="?lang=jp"><span class="flag-icon flag-icon-jp"></span>Japanese</a>
	                            </div>
	                        </div>
</div>