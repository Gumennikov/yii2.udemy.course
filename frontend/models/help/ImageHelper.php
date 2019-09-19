<?php
namespace globals\help;

use Yii;

/**
 * Класс содержит методы для картинками
 */
class ImageHelper
{
    /**
     * Метод вычисляет новые размеры изображения, в соответствии
     * с заданными максимальными размерами ширины и высоты
     *
     * $pathImage: путь к файлу с изображением
     * $maxWidth: максимальная ширина
     * $maxHeight: максимальная высота
     */
    public static function calculateNewSizeImage($pathImage, $maxWidth=800, $maxHeight=600)
    {
        if (!file_exists($pathImage)) {
            // Файл не существует
            return false;
        }

        $size = getimagesize($pathImage);
        //var_dump($size); die();
        if (false == $size) {
            // Файл не является изображением
            return false;
        }

        $width = $size[0];
        $height = $size[1];

        $scaleW = $maxWidth / $width;
        $scaleH = $maxHeight / $height;

        // Если изображение меньше, чем заданные размеры
        if (($width <= $maxWidth) && ($height <= $maxHeight)) {
            $newWidth = $width;
            $newHeight = $height;
        }
        elseif (($scaleW * $height) < $maxHeight) {
            $newHeight = ceil($scaleW * $height);
            $newWidth = $maxWidth;
        }
        else {
            $newWidth = ceil($scaleH * $width);
            $newHeight = $maxHeight;
        }

        $newSize[0] = $newWidth;
        $newSize[1] = $newHeight;

        return $newSize;
    }
}