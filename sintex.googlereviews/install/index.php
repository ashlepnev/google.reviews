<?php

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

Class sintex_googlereviews extends CModule
{
	function __construct()
	{
		$arModuleVersion = [];
		include(__DIR__."/version.php");
		
		$this->MODULE_ID = "sintex.googlereviews";
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = Loc::getMessage("SINTEX_GOOGLEREVIEWS_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("SINTEX_GOOGLEREVIEWS_MODULE_DESCRIPTION");
		
		$this->PARTNER_NAME = Loc::getMessage("SINTEX_GOOGLEREVIEWS_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("SINTEX_GOOGLEREVIEWS_PARTNER_URI");
		
		$this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = "Y";
		$this->MODULE_GROUP_RIGHTS = "Y";
	}
	
	function DoInstall()
	{
		global $APPLICATION;
		
		if ($this->isVersionD7())
		{
			\Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
			$this->InstallFiles();
		}
		else
		{
			$APPLICATION->ThrowException(Loc::getMessage("SINTEX_GOOGLEREVIEWS_INSTALL_ERROR_VERSION"));
		}
		
		$APPLICATION->IncludeAdminFile(
			Loc::getMessage("SINTEX_GOOGLEREVIEWS_INSTALL_TITLE"), 
			$this->GetPath() . "/install/step.php"
		);
	}
	
	
	function DoUninstall()
	{
		
		global $APPLICATION;
		
		$context = Application::getInstance()->getContext();
		$request = $context->getRequest();
		
		if ($request["step"] < 2)
		{
			$APPLICATION->IncludeAdminFile(
				Loc::getMessage("SINTEX_GOOGLEREVIEWS_UNINSTALL_TITLE"),
				$this->GetPath() . "/install/unstep1.php"
			);
		}
		elseif ($request["step"] == 2)
		{
			$this->UnInstallFiles();
		
			\Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
			
			$APPLICATION->IncludeAdminFile(
				Loc::getMessage("SINTEX_GOOGLEREVIEWS_UNINSTALL_TITLE"),
				$this->GetPath() . "/install/unstep2.php"
			);
		}
	}
	
	public function isVersionD7()
	{
		return CheckVersion(\Bitrix\Main\ModuleManager::getVersion("main"), "14.00.00");
	}
	
	public function GetPath($notDocumentRoot=false)
	{
		if($notDocumentRoot)
			return str_ireplace(Application::getDocumentRoot(),'',dirname(__DIR__));
		else
			return dirname(__DIR__);
	}
	
	function InstallFiles($arParams = [])
	{
		$path = $this->GetPath() . "/install/components";
		
		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path))
		{
			CopyDirFiles(
				$this->GetPath() . "/install/components", 
				$_SERVER["DOCUMENT_ROOT"] . "/bitrix/components",
				true,
				true
			);
		} 
		else
		{
			throw new \Bitrix\Main\IO\InvalidPathException($path);
		}
	}
	
	function UnInstallFiles()
	{
		\Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/sintex/google.reviews");
	}

}