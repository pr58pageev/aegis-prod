<?

use Bitrix\Main\Localization\Loc;

?>
<div class="empty-filter">
	<div class="empty-filter__icon-wrapper">
	</div>
	<div class="empty-filter__text-block">
		<div class="empty-filter__text-block-title">
			 <?= Loc::getMessage("NO_RESULT_TITLE") ?>
		</div>
		<div class="empty-filter__text-block-subtitle">
			 <?= Loc::getMessage("TRY_ANOTHER_REQUEST") ?><a class="main-color_link" href="/catalog/"><?= Loc::getMessage("LINK_TEXT") ?></a>
		</div>
	</div>
</div>
<style>
    .empty-filter {
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 100%;
        padding: 30px;
        margin-bottom: 40px;
        background-color: #f7f7f7; }
    .empty-filter .empty-filter__icon {
        fill: #fb0040; }
    .empty-filter .empty-filter__icon-wrapper {
        margin-right: 20px; }
    .empty-filter .no-result_image {
        margin-right: 30px;
        width: 360px;
        height: 200px; }
    .empty-filter .empty-filter__text-block .empty-filter__text-block-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 15px; }
    .empty-filter .empty-filter__text-block .empty-filter__text-block-subtitle {
        font-size: 15px; }

    .main-color_link {
        color: #fb0040; }
    .main-color_link:hover {
        color: #fb0040; }

    @media screen and (max-width: 1024px) {
        .empty-filter {
            margin-bottom: 30px; }
        .empty-filter .empty-filter__text-block .empty-filter__text-block-title {
            line-height: 37px; } }

    @media screen and (max-width: 768px) {
        .empty-filter .empty-filter__text-block .empty-filter__text-block-title {
            font-size: 24px; }
        .empty-filter {
            margin-bottom: 30px; }
        .empty-filter .empty-filter__text-block .empty-filter__text-block-subtitle {
            font-size: 14px; } }

    @media screen and (max-width: 570px) {
        .empty-filter {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -moz-box-orient: vertical;
            -moz-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: center;
            -moz-box-align: center;
            -ms-flex-align: center;
            align-items: center; }
        .empty-filter .empty-filter__text-block .empty-filter__text-block-title {
            text-align: center;
            font-size: 20px;
            line-height: 26px;
            margin-bottom: 10px; }
        .empty-filter .empty-filter__text-block .empty-filter__text-block-subtitle {
            text-align: center;
            font-size: 13px; }
        .empty-filter .empty-filter__icon-wrapper {
            margin-right: 0;
            margin-bottom: 20px; } }

    @media screen and (max-width: 420px) {
        .empty-filter .empty-filter__text-block .empty-filter__text-block-title {
            font-size: 17px;
            line-height: 25px; } }
</style>