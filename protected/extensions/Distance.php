<?php
class Distance
{

    /**
     * 计算两组经纬度坐标 之间的距离
     * @param float $lng1 经度1
     * @param float $lat1 纬度1
     * @param float $lng2 经度1
     * @param float $lat2 纬度1
     * @return float 距离(米)
     * @demo GetDistance(116.4767, 39.908156, 116.450479, 39.908452);
     */
    public static function getDistance($lng1, $lat1, $lng2, $lat2, $decimal = 2)
    {
        $radLat1 = $lat1 * pi() / 180.0;
        $radLat2 = $lat2 * pi() / 180.0;
        $a = $radLat1 - $radLat2;
        $b = ($lng1 * pi() / 180.0) - ($lng2 * pi() / 180.0);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * 6371.004; // 地球的球面平均半径
        return round($s * 1000, $decimal);
    }

    public static function getAttactionsByWH($lng,$lat,$w='0',$h='0')
    {
        $w1 = $lng-$w/2;
        $w2 = $lng+$w/2;
        $h1 = $lat-$h/2;
        $h2 = $lat-$h/2;
        return Attraction::model()->findAll("longitude > $w1 and longitude < $w2 and latitude > $h1 and latitude > $h2");
    }

}
