@php
    use App\Enums\PropertyStatusEnum;
    use App\Enums\PropertyTypeEnum;
    use App\Enums\WorkPackageNameEnum;
    use App\Enums\WorkTypeEnum;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interior Space Budget Report</title>
    <style>
        /* Base styles */
        @media print {
            @page {
                margin: 50px;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }

        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .page-break {
            page-break-after: always;
        }

        header, footer {
            position: fixed;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            margin-bottom: 2px;
        }

        header {
            top: -30px;
        }

        footer {
            bottom: -30px;
        }

        .content {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo span {
            font-weight: normal;
        }

        .report-title {
            text-align: right;
            margin-bottom: 2px;
        }

        .report-title h1 {
            color: #5A2828;
            font-size: 26px;
            margin-bottom: 2px;
        }

        .report-title p {
            font-size: 14px;
            color: #555;
        }

        /* Section styles */
        .section-header {
            background-color: #5A2828;
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            margin-bottom: 4px;
            text-align: center;
            font-size: 14px;
        }

        .section-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .property-info {
            flex: 1;
            padding: 0 15px;
        }

        .property-info h3 {
            margin-bottom: 4px;
            font-size: 16px;
        }

        .property-info p {
            margin: 0;
            margin-bottom: 2px;
            font-size: 14px;
        }

        .budget-info {
            text-align: center;
            flex: 1;
        }

        .budget-info h3 {
            margin-bottom: 4px;
            font-size: 16px;
        }

        .budget-amount {
            font-size: 24px;
            font-weight: bold;
            color: #5A2828;
        }

        /* Table styles */
        .works-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 2px;
        }

        .work-section {
            flex: 1;
            /* min-width: 300px; */
            display: inline-block;
            width: 45%;
        }

        .work-title {
            margin-bottom: 8px;
            font-size: 16px;
            text-align: center;
        }

        .work-table {
            width: 100%;
            border-collapse: collapse;
        }

        .work-table tr {
            background-color: #5A2828;
            color: white;
            margin-bottom: 2px;
        }

        .work-item {
            padding: 8px;
            font-weight: bold;
            font-size: 12px;
        }

        .work-level {
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        .work-cost {
            padding: 8px;
            text-align: right;
            font-size: 12px;
        }

        .other-works {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .other-work-item {
            width: 100%;
            text-align: center;
            margin-bottom: 2px;
            font-size: 12px;
        }

        .other-work-title {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .other-work-level {
            font-size: 14px;
            color: #555;
            margin-bottom: 2px;
        }

        .other-work-cost {
            font-size: 14px;
        }

        /* Marketing section */
        .marketing {
            background-color: #f4f4f8;
            padding: 18px;
            border-radius: 10px;
            display: flex;
            margin-bottom: 2px;
        }

        .marketing-text {
            flex: 3;
        }

        .marketing-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .marketing-description {
            font-size: 12px;
            margin-bottom: 4px;
            line-height: 1.5;
        }

        .marketing-button {
            display: inline-block;
            background-color: #5A2828;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
        }

        .marketing-image {
            flex: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Disclaimer */
        .disclaimer {
            font-size: 10px;
            color: #777;
            margin-top: 20px;
            line-height: 1.2;
        }

        /* Page 2 styles */
        .average-costs {
            text-align: center;
            margin-bottom: 2px;
        }

        .budget-box {
            border: 2px solid #333;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            max-width: 300px;
            margin: 0 auto 30px;
        }

        .budget-box-title {
            font-size: 16px;
            margin-bottom: 2px;
        }

        .budget-box-amount {
            font-size: 24px;
            font-weight: bold;
            color: #5A2828;
        }

        .cost-distribution {
            background-color: #f4f4f8;
            height: 200px;
            margin: 30px 0;
            position: relative;
            border: 1px solid #ddd;
        }

        .cost-marker {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .cost-marker-arrow {
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 15px solid #5A2828;
            margin: 0 auto;
        }

        .cost-range {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .cost-range-item {
            width: 30%;
            text-align: center;
        }

        .cost-range-box {
            background-color: #5A2828;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 2px;
        }

        .cost-range-title {
            font-size: 14px;
            margin-bottom: 2px;
        }

        .cost-range-amount {
            font-size: 20px;
            font-weight: bold;
        }

        .cost-info-box {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 2px;
        }

        /* Page 3 styles */
        .charts-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .chart-section {
            width: 48%;
            background-color: #f4f4f8;
            border-radius: 10px;
            margin-bottom: 2px;
            padding: 20px;
        }

        .chart-title {
            background-color: #5A2828;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-align: center;
            margin-bottom: 2px;
        }

        .chart-description {
            text-align: center;
            margin-bottom: 2px;
            font-size: 14px;
        }

        .pie-chart {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            position: relative;
            background: conic-gradient(#23263b 0% 57%,
                    #3498db 57% 66%,
                    #e84393 66% 87%,
                    #f1c40f 87% 94%,
                    #e74c3c 94% 95%,
                    #7ed6df 95% 100%);
        }

        .pie-chart2 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: conic-gradient(#23263b 0% 13%,
                    #3498db 13% 55%,
                    #e84393 55% 100%);
        }

        .chart-legend {
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 2px;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            margin-right: 10px;
            border-radius: 3px;
        }

        .legend-text {
            flex: 1;
        }

        .legend-value {
            text-align: right;
            font-weight: bold;
        }

        /* Page 4 styles */
        .hacks-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 2px;
        }

        .hack-item {
            flex: 1;
            flex-grow: 1;
            min-width: 45%;
            background-color: #f4f4f8;
            border-radius: 10px;
            padding: 20px;
        }

        .hack-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hack-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            background-color: #5A2828;
            border-radius: 3px;
        }

        .hack-description {
            font-size: 14px;
            line-height: 1.5;
        }

        /* .flooring-hack {
            width: 100%;
            margin-top: 20px;
        } */

        .report-title-text {
            margin-bottom: 2px;
        }

        .date {
            margin: 0;
        }

        h3 {
            margin: 0;
        }

        #otherAdditional {
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <!-- Page 1 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="logo">INTERIOR<span>SPACE</span></div>
                    </td>
                    <td width="50%" style="text-align: end;">
                        <div class="report-title">
                            <h1 class="report-title-text">Budget Report</h1>
                            <p class="date">Generated by Qanvast on {{ $date ?? '' }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Overview Section -->
        <div class="section-header">Overview</div>

        <div class="section-content">
            <table>
                <tr>
                    <td style="vertical-align: top;">
                        <div class="property-info">
                            <h3>Property Details</h3>
                            <p>{{ PropertyTypeEnum::labelFromValue($property_type) }}, {{ PropertyStatusEnum::labelFromValue($property_status) }}, {{ $size ?? '' }}{{ $base_unit ?? '' }}
                            </p>
                            <p>{{ $number_of_rooms[3] }} Bedrooms, {{ $number_of_rooms[4] }} Bathrooms</p>
                        </div>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="property-info">
                            <h3>Rooms to Renovate</h3>
                            @foreach ($room_labels as $room)
                                <p>
                                    {{ $room }} @if (!$loop->last), @endif
                                </p>
                            @endforeach
                        </div>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="budget-info">
                            <h3>Your Estimated Renovation Budget</h3>
                            <div class="budget-amount">{{ $result['budget_range'] }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Main Works -->
        <div class="section-header" style="border-radius: 30px;">Main Works</div>

        <div class="works-container">
            <table width="100%">
                <tr style="width: 100%;">
                    <td style="width: 50%; padding: 4px;">
                        <div class="work-section" style="width: 100%;">
                            <div class="work-title">Living/Dining</div>
                            <table class="work-table">
                                <tr>
                                    <td class="work-item">Hacking</td>
                                    <td class="work-level">{{ isset($works[1]) ? WorkPackageNameEnum::labelFromValue($works[1]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[1]) ? $works[1]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Masonry</td>
                                    <td class="work-level">{{ isset($works[2]) ? WorkPackageNameEnum::labelFromValue($works[2]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[2]) ? $works[2]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Carpentry</td>
                                    <td class="work-level">{{ isset($works[3]) ? WorkPackageNameEnum::labelFromValue($works[3]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[3]) ? $works[3]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Ceiling & Partition</td>
                                    <td class="work-level">{{ isset($works[4]) ? WorkPackageNameEnum::labelFromValue($works[4]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[4]) ? $works[4]->formatted_budget : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="width: 50%; padding: 4px;">
                        <div class="work-section" style="width: 100%;">
                            <div class="work-title">Kitchen</div>
                            <table class="work-table">
                                <tr>
                                    <td class="work-item">Hacking</td>
                                    <td class="work-level">{{ isset($works[5]) ? WorkPackageNameEnum::labelFromValue($works[5]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[5]) ? $works[5]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Masonry</td>
                                    <td class="work-level">{{ isset($works[6]) ? WorkPackageNameEnum::labelFromValue($works[6]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[6]) ? $works[6]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Carpentry</td>
                                    <td class="work-level">{{ isset($works[7]) ? WorkPackageNameEnum::labelFromValue($works[7]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[7]) ? $works[7]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Plumbing</td>
                                    <td class="work-level">{{ isset($works[8]) ? WorkPackageNameEnum::labelFromValue($works[8]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[8]) ? $works[8]->formatted_budget : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="works-container">
            <table width="100%">
                <tr>
                    <td style="width: 50%; padding: 4px;">
                        <div class="work-section" style="width: 100%;">
                            <div class="work-title">Bedrooms</div>
                            <table class="work-table">
                                <tr>
                                    <td class="work-item">Hacking</td>
                                    <td class="work-level">{{ isset($works[9]) ? WorkPackageNameEnum::labelFromValue($works[9]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[9]) ? $works[9]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Masonry</td>
                                    <td class="work-level">{{ isset($works[10]) ? WorkPackageNameEnum::labelFromValue($works[10]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[10]) ? $works[10]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Carpentry</td>
                                    <td class="work-level">{{ isset($works[11]) ? WorkPackageNameEnum::labelFromValue($works[11]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[11]) ? $works[11]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Ceiling & Partition</td>
                                    <td class="work-level">{{ isset($works[12]) ? WorkPackageNameEnum::labelFromValue($works[12]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[12]) ? $works[12]->formatted_budget : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="width: 50%; padding: 4px;">
                        <div class="work-section" style="width: 100%;">
                            <div class="work-title">Bathrooms</div>
                            <table class="work-table">
                                <tr>
                                    <td class="work-item">Hacking</td>
                                    <td class="work-level">{{ isset($works[13]) ? WorkPackageNameEnum::labelFromValue($works[13]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[13]) ? $works[13]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Masonry</td>
                                    <td class="work-level">{{ isset($works[14]) ? WorkPackageNameEnum::labelFromValue($works[14]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[14]) ? $works[14]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Carpentry</td>
                                    <td class="work-level">{{ isset($works[15]) ? WorkPackageNameEnum::labelFromValue($works[15]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[15]) ? $works[15]->formatted_budget : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="work-item">Plumbing</td>
                                    <td class="work-level">{{ isset($works[16]) ? WorkPackageNameEnum::labelFromValue($works[16]->name) : '-' }}</td>
                                    <td class="work-cost">{{ isset($works[16]) ? $works[16]->formatted_budget : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Other Additional Works -->
        <div class="section-header" style="border-radius: 30px;" id="otherAdditional">Other Additional Works</div>

        <div class="other-works">
            <table width="100%">
                <tr>
                    <td style="width: 25%; text-align: center;">
                        <div class="other-work-item">
                            <div class="other-work-title">Electrical Works</div>
                            <div class="other-work-level">{{ isset($other_works[1]) ? WorkPackageNameEnum::labelFromValue($other_works[1]->name) : '-' }}</div>
                            <div class="other-work-cost">{{ isset($other_works[1]) ? $other_works[1]->formatted_budget : '-' }}</div>
                        </div>
                    </td>
                    <td style="width: 25%; text-align: center;">
                        <div class="other-work-item">
                            <div class="other-work-title">Glass & Aluminium</div>
                            <div class="other-work-level">{{ isset($other_works[2]) ? WorkPackageNameEnum::labelFromValue($other_works[2]->name) : '-' }}</div>
                            <div class="other-work-cost">{{ isset($other_works[2]) ? $other_works[2]->formatted_budget : '-' }}</div>
                        </div>
                    </td>
                    <td style="width: 25%; text-align: center;">
                        <div class="other-work-item">
                            <div class="other-work-title">Painting</div>
                            <div class="other-work-level">{{ isset($other_works[3]) ? WorkPackageNameEnum::labelFromValue($other_works[3]->name) : '-' }}</div>
                            <div class="other-work-cost">{{ isset($other_works[3]) ? $other_works[3]->formatted_budget : '-' }}</div>
                        </div>
                    </td>
                    <td style="width: 25%; text-align: center;">
                        <div class="other-work-item">
                            <div class="other-work-title">Cleaning & Polishing</div>
                            <div class="other-work-level">{{ isset($other_works[4]) ? WorkPackageNameEnum::labelFromValue($other_works[4]->name) : '-' }}</div>
                            <div class="other-work-cost">{{ isset($other_works[4]) ? $other_works[4]->formatted_budget : '-' }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <table>
                <tr>
                    <td style="width: 75%; padding: 10px;">
                        <div class="marketing-text">
                            <div class="marketing-title">Make your renovation easy and rewarding.</div>
                            <div class="marketing-description">
                                The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior
                                firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by
                                homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast
                                Guarantee.
                            </div>
                            <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                            <a href="#" class="marketing-button">Find Out More</a>
                        </div>
                    </td>
                    <td style="width: 25%; padding: 10px;">
                        <div class="marketing-image">
                            <!-- Placeholder for image -->
                            <img src="assets/images/31343C.svg" alt="Renovation illustration" width="100%">
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from
            2021 till present. This report should only be used as a guide. Costs may vary depending on interior design
            firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>

    <div class="page-break"></div>

    <!-- Page 2 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="logo">INTERIOR<span>SPACE</span></div>
                    </td>
                    <td width="50%" style="text-align: end;">
                        <div class="report-title">
                            <h1 class="report-title-text">Budget Report</h1>
                            <p class="date">Generated by Qanvast on {{ $date ?? '' }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Average Renovation Costs -->
        <div class="section-header">Average Renovation Costs for HDB (New)</div>

        <div class="average-costs">
            <div class="budget-box">
                <div class="budget-box-title">Your Budget</div>
                <div class="budget-box-amount">{{ $result['budget_range'] }}
                </div>
            </div>

            <!-- Cost Distribution Graph -->
            <div class="cost-distribution">
                <div class="cost-marker">
                    <div class="cost-marker-arrow"></div>
                </div>
                <!-- Distribution graph would be here -->
            </div>

            <div class="cost-range">
                <div class="cost-range-item" style="display: inline-block;">
                    <div class="cost-range-box">
                        <div class="cost-range-title">Lower-end</div>
                        <div class="cost-range-amount">$27,000</div>
                    </div>
                </div>

                <div class="cost-range-item" style="display: inline-block;">
                    <div class="cost-range-box">
                        <div class="cost-range-title">Average</div>
                        <div class="cost-range-amount">$45,000</div>
                    </div>
                </div>

                <div class="cost-range-item" style="display: inline-block;">
                    <div class="cost-range-box">
                        <div class="cost-range-title">Higher-end</div>
                        <div class="cost-range-amount">$72,000</div>
                    </div>
                </div>
            </div>

            <div class="cost-info-box">
                Based on $52,277,000 worth of HDB (New) contracts in our database, the average renovation cost is
                $45,000.
            </div>

            <div class="cost-info-box">
                Your renovation budget of {{ $result['budget_range'] }} falls within the lower-end range.
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <table>
                <tr>
                    <td style="width: 75%; padding: 10px;">
                        <div class="marketing-text">
                            <div class="marketing-title">Make your renovation easy and rewarding.</div>
                            <div class="marketing-description">
                                The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior
                                firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by
                                homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast
                                Guarantee.
                            </div>
                            <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                            <a href="#" class="marketing-button">Find Out More</a>
                        </div>
                    </td>
                    <td style="width: 25%; padding: 10px;">
                        <div class="marketing-image">
                            <!-- Placeholder for image -->
                            <img src="assets/images/31343C.svg" alt="Renovation illustration" width="100%">
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from
            2021 till present. This report should only be used as a guide. Costs may vary depending on interior design
            firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>

    <div class="page-break"></div>

    <!-- Page 3 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="logo">INTERIOR<span>SPACE</span></div>
                    </td>
                    <td width="50%" style="text-align: end;">
                        <div class="report-title">
                            <h1 class="report-title-text">Budget Report</h1>
                            <p class="date">Generated by Qanvast on {{ $date ?? '' }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Budget Breakdowns -->
        <div class="charts-container">
            <div class="chart-section" style="width: 100%;">
                <div class="chart-title">Budget Breakdown by Works</div>
                <div class="chart-description">Here's the budget breakdown allocated for each work required.</div>

                <table>
                    <tr>
                        <td style="width: 50%;">
                            <!-- Pie Chart for Works -->
                            <img src="{{ $work_image_path ?? '' }}" alt="Work Chart" style="width: 100%; height: auto;" />
                        </td>
                        <td style="width: 50%;">
                            <div class="chart-legend">
                                @php
                                    $colorIndex = 0;
                                @endphp
                                @foreach ($result['work_percentages'] as $workType => $percentage)
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: {{ $result['work_colors'][$colorIndex] }}; display: inline-block;"></div>
                                        <div class="legend-text" style="display: inline-block;">{{ WorkTypeEnum::labelFromValue($workType) }}</div>
                                        <div class="legend-value" style="display: inline-block; width: auto;">{{ number_format($percentage, 2) }}% (approx. ${{ number_format($result['work_budgets'][$workType]) }})</div>
                                    </div>
                                    @php
                                        $colorIndex++;
                                    @endphp
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="chart-section" style="width: 100%">
                <div class="chart-title">Budget Breakdown by Room Type</div>
                <div class="chart-description">Here's the budget breakdown allocated for each room.</div>

                <table>
                    <tr>
                        <td style="width: 50%;">
                            <!-- Pie Chart for Room Type -->
                            <img src="{{ $room_image_path ?? '' }}" alt="Room Chart" style="width: 100%; height: auto;" />
                        </td>
                        <td style="width: 50%;">
                            <div class="chart-legend">
                                @php
                                    $colorIndex = 0;
                                @endphp
                                @foreach ($result['room_percentages'] as $roomName => $percentage)
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: {{ $result['room_colors'][$colorIndex] }}; display: inline-block;"></div>
                                        <div class="legend-text" style="display: inline-block;">{{ $roomName }}</div>
                                        <div class="legend-value" style="display: inline-block;">{{ number_format($percentage, 2) }}% (approx. ${{ number_format($result['room_budgets'][$roomName]) }})</div>
                                    </div>
                                    @php
                                        $colorIndex++;
                                    @endphp
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <table>
                <tr>
                    <td style="width: 75%; padding: 10px;">
                        <div class="marketing-text">
                            <div class="marketing-title">Make your renovation easy and rewarding.</div>
                            <div class="marketing-description">
                                The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior
                                firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by
                                homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast
                                Guarantee.
                            </div>
                            <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                            <a href="#" class="marketing-button">Find Out More</a>
                        </div>
                    </td>
                    <td style="width: 25%; padding: 10px;">
                        <div class="marketing-image">
                            <!-- Placeholder for image -->
                            <img src="assets/images/31343C.svg" alt="Renovation illustration" width="100%">
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from
            2021 till present. This report should only be used as a guide. Costs may vary depending on interior design
            firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>

    <div class="page-break"></div>

    <!-- Page 4 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <div class="logo">INTERIOR<span>SPACE</span></div>
                    </td>
                    <td width="50%" style="text-align: end;">
                        <div class="report-title">
                            <h1 class="report-title-text">Budget Report</h1>
                            <p class="date">Generated by Qanvast on {{ $date ?? '' }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Renovation Budgeting Hacks -->
        <div class="section-header">Renovation Budgeting Hacks</div>

        <div style="margin-bottom: 2px; text-align: center;">
            <p>We hope our report gives you a better idea of how much to budget for your renovation. Still, it never
                hurts to save more! Here are some tips that can help shave your renovation bill and avoid extra costs.
            </p>
        </div>

        <div class="hacks-container">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%; max-width: 50%; padding: 4px; align-items: stretch;">
                        <div class="hack-item">
                            <div class="hack-title" style="vertical-align: top;">
                                <div class="hack-icon" style="display: inline-block;"></div>
                                <div style="display: inline-block;">Renovation Packages</div>
                            </div>
                            <div class="hack-description">
                                Renovation packages aren't always the most cost-efficient option out there. Decide wisely many come
                                with limitations in terms of design, amount of work done and materials. Sometimes, top-ups may even
                                end up costing more
                            </div>
                        </div>
                    </td>
                    <td style="width: 50%; max-width: 50%; padding: 4px; align-items: stretch;">
                        <div class="hack-item">
                            <div class="hack-title" style="vertical-align: top;">
                                <div class="hack-icon" style="display: inline-block;"></div>
                                <div style="display: inline-block;">Electrical Wiring</div>
                            </div>
                            <div class="hack-description">
                                Don't go overboard installing power points having more sockets means more rewiring work and
                                expenses. This could mean your final expenditure on electrical works will end up being significantly
                                higher, especially if you're completing rewiring an older resale flat
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%; max-width: 50%; padding: 4px; align-items: stretch;">
                        <div class="hack-item">
                            <div class="hack-title" style="vertical-align: top;">
                                <div class="hack-icon" style="display: inline-block;"></div>
                                <div style="display: inline-block;">Carpentry</div>
                            </div>
                            <div class="hack-description">
                                Customised carpentry is one of the more expensive components in a renovation quote, as prices vary
                                based on the materials used and amount of workmanship required. If you are working with a tight
                                budget, consider going for more loose furniture instead.
                            </div>
                        </div>
                    </td>
                    <td style="width: 50%; max-width: 50%; padding: 4px; align-items: stretch;">
                        <div class="hack-item">
                            <div class="hack-title" style="vertical-align: top;">
                                <div class="hack-icon" style="display: inline-block;"></div>
                                <div style="display: inline-block;">Hacking</div>
                            </div>
                            <div class="hack-description">
                                If you're working on a tight budget, skip out on hacking wherever you can as it can easily set you
                                back by hundreds to thousands. In fact, half-hacked walls are more expensive than fully hacked ones.
                                Why? Additional work is required to fully hack and patch the wall back up to half length.
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px;">
                        <div class="hack-item flooring-hack">
                            <div class="hack-title" style="vertical-align: top;">
                                <div class="hack-icon" style="display: inline-block;"></div>
                                <div style="display: inline-block;">Flooring</div>
                            </div>
                            <div class="hack-description">
                                Flooring is another expensive component; changing the entire floor can be relatively costly given
                                the area size. Check with your interior designer if an overlay is feasible instead. If you're on a
                                budget, consider vinyl flooring over ceramic tiles or stone for a more wallet-friendly option.
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <table>
                <tr>
                    <td style="width: 75%; padding: 4px;">
                        <div class="marketing-text">
                            <div class="marketing-title">Make your renovation easy and rewarding.</div>
                            <div class="marketing-description">
                                The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior
                                firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by
                                homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast
                                Guarantee.
                            </div>
                            <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                            <a href="#" class="marketing-button">Find Out More</a>
                        </div>
                    </td>
                    <td style="width: 25%; padding: 10px;">
                        <div class="marketing-image">
                            <!-- Placeholder for image -->
                            <img src="assets/images/31343C.svg" alt="Renovation illustration" width="100%">
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from
            2021 till present. This report should only be used as a guide. Costs may vary depending on interior design
            firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>
</body>

</html>
