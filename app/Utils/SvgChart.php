<?php

namespace App\Utils;

class SvgChart
{
    public static function generatePieChartSVGFromAssoc($data, $size = 200) {
        $total = array_sum($data);
        if ($total == 0) {
            return '<svg width="'.$size.'" height="'.$size.'"><text x="10" y="20">No data</text></svg>';
        }

        $defaultColors = ['#3498db', '#e84393', '#f1c40f', '#2ecc71', '#9b59b6', '#34495e'];

        $svgSize = 32;
        $radius = $svgSize / 2;

        $svg = '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$svgSize.' '.$svgSize.'">';
        $startAngle = 0;
        $index = 0;

        foreach ($data as $label => $value) {
            $percentage = $value / $total;
            $angle = $percentage * 360;

            $x1 = cos(deg2rad($startAngle - 90)) * $radius + $radius;
            $y1 = sin(deg2rad($startAngle - 90)) * $radius + $radius;

            $endAngle = $startAngle + $angle;
            $x2 = cos(deg2rad($endAngle - 90)) * $radius + $radius;
            $y2 = sin(deg2rad($endAngle - 90)) * $radius + $radius;

            $largeArcFlag = ($angle > 180) ? 1 : 0;

            $pathData = sprintf(
                'M%d,%d L%f,%f A%d,%d 0 %d,1 %f,%f z',
                $radius, $radius, $x1, $y1,
                $radius, $radius, $largeArcFlag, $x2, $y2
            );

            $color = $defaultColors[$index % count($defaultColors)];

            $svg .= '<path d="'.$pathData.'" fill="'.$color.'"></path>';

            $startAngle += $angle;
            $index++;
        }

        $svg .= '</svg>';

        return $svg;
    }
}
