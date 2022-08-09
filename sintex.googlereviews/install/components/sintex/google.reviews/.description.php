<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * Описание компонента «Отзывы из Google Maps»
 *
 * Вывод на сайте отзывов о компании из сервиса Google Maps
 * @author Шлепнёв Андрей
 * @version 1.0.0
 *
 */

$arComponentDescription = array(
	"NAME" => GetMessage("SINTEX_GOOGLE_REVIEWS_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("SINTEX_GOOGLE_REVIEWS_COMPONENT_DESCRIPTION"),
	"COMPLEX" => "N",
	"PATH" => array(
		"ID" => "content"
	),
);

?>