<?php

/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */
class Cluster {

    /**
     *
     * @param array $markers
     * @param integer $distance
     * @param integer $zoom
     * @return array
     */

    const OFFSET = 268435456;
    const RADIUS = 85448179; //OFFSET / pi()


    function clusterer($markers, $distance, $zoom) {
        $clustered = array();
        /* Loop until all markers have been compared. */

        while (count($markers)) {
            $marker = array_pop($markers);
            $cluster = array();
            /* Compare against all markers which are left. */
            foreach ($markers as $key => $target) {
                $pixels = $this->_pixelDistance($marker['lat'], $marker['lng'], $target['lat'], $target['lng'], $zoom);
                /* If two markers are closer than given distance remove */
                /* target marker from array and add it to cluster.      */
                if ($distance > $pixels) {
                    /* printf("Distance between %s,%s and %s,%s is %d pixels.\n", 
                      $marker['lat'], $marker['lng'],
                      $target['lat'], $target['lng'],
                      $pixels); */
                    unset($markers[$key]);
                    $cluster[] = $target;
                }
            }

            /* If a marker has been added to cluster, add also the one  */
            /* we were comparing to and remove the original from array. */
            if (count($cluster) > 0) {
                $cluster[] = $marker;
                $clustered[] = $cluster;

            } else {
                $clustered[] = $marker;
            }
        }
        return $clustered;
    }

    /**
     *
     * @param float $lat1
     * @param float $lng1
     * @param float $lat2
     * @param float $lng2
     * @param integer $zoom
     * @return type
     */
    private function _pixelDistance($lat1, $lng1, $lat2, $lng2, $zoom) {
        $x1 = $this->_lngToX($lng1);
        $y1 = $this->_latToY($lat1);
        $x2 = $this->_lngToX($lng2);
        $y2 = $this->_latToY($lat2);
        return sqrt(pow(($x1 - $x2), 2) + pow(($y1 - $y2), 2)) >> (21 - $zoom);
    }

    /**
     *
     * @param float $lng
     * @return type
     */
    private function _lngToX($lng) {
        return round(self::OFFSET + self::RADIUS * $lng * pi() / 180);
    }

    /**
     *
     * @param float $lat
     * @return type
     */
    private function _latToY($lat) {
        return round(self::OFFSET - self::RADIUS *
            log((1 + sin($lat * pi() / 180)) /
                (1 - sin($lat * pi() / 180))) / 2);
    }
}
