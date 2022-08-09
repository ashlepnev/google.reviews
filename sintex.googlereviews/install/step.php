<?php

use \Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid())
	return;

if ($ex = $APPLICATION->GetException())
{
	echo CAdminMessage::ShowMessage([
		"TYPE" => "ERROR",
		"MESSAGE" => Loc::getMessage("MODULE_INSTALL_ERROR"),
		"DETAILS" => $ex->GetString(),
		"HTML" => true
	]);
}
else
{
	echo CAdminMessage::ShowNote(Loc::getMessage("MODULE_INSTALL_SUCCESS"));
}

?>

<form action="<?echo $APPLICATION->GetCurPage();?>">
	<input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
	<input type="submit" name="" value="<?echo Loc::getMessage("MODULE_INSTALL_BACK")?>">
</form>
