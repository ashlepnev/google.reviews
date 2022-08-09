<?php

use \Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid())
	return;

Loc::loadMessages(__FILE__);
?>

<form action="<?echo $APPLICATION->GetCurPage();?>">
	<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
	<input type="hidden" name="id" value="sintex.googlereviews">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">
	<?echo CAdminMessage::ShowMessage(Loc::getMessage("SINTEX_GOOGLEREVIEWS_MODULE_UNINSTALL_WARNING"));?>
	<input type="submit" name="" value="<?echo Loc::getMessage("SINTEX_GOOGLEREVIEWS_MODULE_UNINSTALL_DELETE")?>">
</form>