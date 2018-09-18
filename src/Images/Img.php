<?php
/*
 *
 * 
 */

namespace U0mo5\Tools\Images;

class Img
{
    /**
     * 缩放图片
     * @param $filename
     * @param $tmpname
     * @param $xmax
     * @param $ymax
     * @return resource
     *
     */
    public static  function resize_image($filename, $tmpname, $xmax, $ymax)
    {
        $ext = explode(".", $filename);
        $ext = $ext[count($ext)-1];

        if ($ext == "jpg" || $ext == "jpeg") {
            $im = imagecreatefromjpeg($tmpname);
        } elseif ($ext == "png") {
            $im = imagecreatefrompng($tmpname);
        } elseif ($ext == "gif") {
            $im = imagecreatefromgif($tmpname);
        }

        $x = imagesx($im);
        $y = imagesy($im);

        if ($x <= $xmax && $y <= $ymax) {
            return $im;
        }

        if ($x >= $y) {
            $newx = $xmax;
            $newy = $newx * $y / $x;
        } else {
            $newy = $ymax;
            $newx = $x / $y * $newy;
        }

        $im2 = imagecreatetruecolor($newx, $newy);
        imagecopyresized($im2, $im, 0, 0, 0, 0, floor($newx), floor($newy), $x, $y);
        return $im2;
    }
}