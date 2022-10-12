<?php
define('NEED_AUTH', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ресайз картинок"); ?>

<?
if(!$USER->IsAdmin()) exit('Вы не админ');


// 365mg(temuch-13): путь к картинкам
define('IMPORT_PICTURES_FOLDER', '/import_1C/import_files/images_catalog_7/');
define('MAX_WIDTH', '700');
define('MAX_HEIGHT', '700');
define('IBLOCK_ID', 15);
$ptime = getmicrotime();

$path = $_SERVER['DOCUMENT_ROOT'] . IMPORT_PICTURES_FOLDER;

$i = 0;
$checked = false;
$i_del = 0;
$attypes = [];
$break = false;
$i_all = 0;


if (is_dir($path)) {

    $arFiles = [];
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (is_dir($path . $file)) {

                    $has_pics = false;

                    $path_inner = $path . $file . '/';
                    if ($handle_inner = opendir($path_inner)) {
                        while (false !== ($file_inner = readdir($handle_inner))) {
                            if ($file_inner != "." && $file_inner != ".." || !is_dir($path_inner . $file_inner)) {
                                $filepath = $path_inner . $file_inner;

                                pre($filepath);
                                pre($arFile['type']);
//                                if(!filesize($filepath)>0) continue;
                                $arFile = CFile::MakeFileArray($filepath);
                                $size = getimagesize($filepath);
                                if (strpos($arFile['type'], 'image') !== false) {
                                    $i_all++;
//                                    pre($filepath);
//                                    pre(getimagesize($filepath));
                                    if ($size[0] > MAX_WIDTH || $size[1] > MAX_HEIGHT) {
                                        $i++;
                                        CAllFile::ResizeImage(
                                            $arFile, // путь к изображению, сюда же будет записан уменьшенный файл
                                            array(
                                                "width" => MAX_WIDTH,  // новая ширина
                                                "height" => MAX_HEIGHT // новая высота
                                            ),
                                            BX_RESIZE_IMAGE_PROPORTIONAL
                                        );
                                        //pre($arFile);
                                        pre('RESIZE');
                                        unlink($filepath);
                                        rename($arFile['tmp_name'], $filepath);
                                         pre($arFile['tmp_name']);
                                         pre($filepath);
                                        //pre(getimagesize($filepath));
                                       
                                    }
                                    $has_pics = 1;
                                    if ($i >= 500) {
                                        $break = 1;
                                        break;
                                    }
                                } else {
                                	unlink($filepath);
                                    $i_del++;
                                }
                            }
                        }
                        closedir($handle_inner);
                        if (!$has_pics)
                            pre($path_inner);
                    }
                }
            }
            if ($break) break;
        }

        closedir($handle);
    }
}
echo "Цикл выполнялся " . round(getmicrotime() - $ptime, 3) . " секунд";
pre("Обработано картинок <b>$i из $i_all </b>");
pre("Удалено файлов <b> $i_del </b>");


if ($i > 0) {
    ?>
    <script>
        setTimeout(function () {
           window.location.reload(1);
        }, 5000);

    </script>
    <?
}

?>
