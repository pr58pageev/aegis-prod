<?php
define('NEED_AUTH', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Загрузка картинок"); ?>

<?
if(!$USER->IsAdmin()) exit('Вы не админ');

//die;// Убрать эту строку, если придется снова грузить фотки! (Remove this string when uploading imgs again)

// 365mg(temuch-13): путь к картинкам
define('IMPORT_PICTURES_FOLDER', '/import_1C/import_files_resized2/');
define('MAX_WIDTH', '700');
define('MAX_HEIGHT', '700');
define('PREVIEW_WIDTH', '300');
define('PREVIEW_HEIGHT', '300');
define('IBLOCK_ID', 15);
$ptime = getmicrotime();

$path = $_SERVER['DOCUMENT_ROOT'] . IMPORT_PICTURES_FOLDER;

$i = 0;
$checked = false;
$i_del = 0;
$attypes = [];
$break = false;


if(!CModule::IncludeModule('iblock')) exit('Нет модуля инфоблоков');

$res = CIblockElement::GetList([], ['IBLOCK_ID' => IBLOCK_ID], false, false, ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_KOD']);
$i = 0;
$i_start = isset($_GET['i']) ? intval($_GET['i']) : 0;
$step = 100;
while ($element = $res->GetNext()) {
    $kod = trim($element['PROPERTY_KOD_VALUE']);
    // temuch-13: пошаговость

    pre($kod);

    if ($i >= $i_start && !empty($kod)) {

        if ($i >= ($step + $i_start)) break;

        $path = $_SERVER['DOCUMENT_ROOT'] . IMPORT_PICTURES_FOLDER . $kod . '/';
        $checked = true;
        if (is_dir($path)) {
            unset($detail_picture);
            $arFiles = [];
           if ($handle = opendir($path)) {

                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $filepath = $path . $file;
//                        for ($key = 1; $key <= 4; $key++)
//                            if (strpos($file, " ($key).") !== false) {
//                                unlink($filepath);
//                                $i_del++;
//                            }

                        if (strpos($file, $kod . '.') !== false){

                            $detail_picture = CFile::MakeFileArray($filepath);

                        } else {
                            $new_picture = CFile::MakeFileArray($filepath);
                            $arFiles[] = array('VALUE' => $new_picture, 'DESCRIPTION' => $new_picture['name']);
                        }
                    }
                }
                closedir($handle);
            }



            if (empty($detail_picture))
                $detail_picture = $arFiles[0]['VALUE'];

            if(!empty($detail_picture)){


                $tmp_image = $_SERVER['DOCUMENT_ROOT'] . '/upload/egida_resize/' . $detail_picture['name'];

                CFile::ResizeImageFile(
                    $detail_picture['tmp_name'],
                    $tmp_image,
                    array('width'=>PREVIEW_WIDTH, 'height'=>PREVIEW_HEIGHT),
                    BX_RESIZE_IMAGE_PROPORTIONAL
                );

                $preview_picture = CFile::MakeFileArray($tmp_image);

            }

            

            $el = new CIblockElement();
            $el->Update($element['ID'], ['NAME'=>$element['NAME'],'PREVIEW_PICTURE' => $preview_picture, 'DETAIL_PICTURE' => $detail_picture]);
            if (!$el) die($el->LAST_ERROR);

            //Пробежимся по всем картинкам и оставим только те, у которых есть в названии "dop"
            foreach ($arFiles as $filec){
                $mystring = $filec['VALUE']['tmp_name'];
                $findme   = 'dop';
                $pos = strpos($mystring, $findme);
                if ($pos === false) {
                    //echo "Строка '$findme' не найдена в строке '$mystring'";
                } else {
                    $totalFiles[] = $filec;
                }
            }
            pre($element['ID']);
            pre($totalFiles);
            CIBlockElement::SetPropertyValuesEx($element['ID'], false, array("MORE_PHOTO" => $totalFiles));
           // die();

            
            
            unlink($tmp_image);


        }
    }

    $i++;

}
echo "Цикл выполнялся " . round(getmicrotime() - $ptime, 3) . " секунд";
//pre("Удалено файлов <b> $i_del </b>");


if ($checked) {
    
    ?>
    <script>
        setTimeout(function () {
            window.location.href = '<?=$APPLICATION->GetCurPage()?>?i=<?=$i?>';
        }, 5000);

    </script>
    <?
}else{
    exit('Импорт картинок окончен!');
}

exit;// Только удаление лишних

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
                                        unlink($filepath);
                                        rename($arFile['tmp_name'], $filepath);
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
