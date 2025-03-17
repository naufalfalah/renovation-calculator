<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interior Space Budget Report</title>
    <style>
        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            color: #333;
            line-height: 1.5;
        }

        .page {
            padding: 20px 40px;
            margin-bottom: 20px;
            border-top: 10px solid #5A2828;
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
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
        }

        .report-title h1 {
            color: #5A2828;
            font-size: 26px;
            margin-bottom: 5px;
        }

        .report-title p {
            font-size: 14px;
            color: #555;
        }

        /* Section styles */
        .section-header {
            background-color: #5A2828;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 20px;
        }

        .section-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .property-info {
            flex: 1;
            padding: 0 15px;
        }

        .property-info h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .property-info p {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .budget-info {
            text-align: center;
            flex: 1;
        }

        .budget-amount {
            font-size: 32px;
            font-weight: bold;
            color: #5A2828;
        }

        /* Table styles */
        .works-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .work-section {
            flex: 1;
            min-width: 300px;
        }

        .work-title {
            font-size: 18px;
            margin-bottom: 10px;
            text-align: center;
        }

        .work-table {
            width: 100%;
            border-collapse: collapse;
        }

        .work-table tr {
            background-color: #5A2828;
            color: white;
            margin-bottom: 5px;
        }

        .work-item {
            padding: 10px 15px;
            font-weight: bold;
            width: 40%;
        }

        .work-level {
            padding: 10px;
            text-align: center;
            width: 30%;
        }

        .work-cost {
            padding: 10px 15px;
            text-align: right;
            width: 30%;
        }

        .other-works {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .other-work-item {
            width: 23%;
            text-align: center;
            margin-bottom: 20px;
        }

        .other-work-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .other-work-level {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .other-work-cost {
            font-size: 14px;
        }

        /* Marketing section */
        .marketing {
            background-color: #f4f4f8;
            padding: 30px;
            border-radius: 10px;
            display: flex;
            margin-bottom: 20px;
        }

        .marketing-text {
            flex: 3;
        }

        .marketing-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .marketing-description {
            font-size: 14px;
            margin-bottom: 15px;
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
            margin-bottom: 30px;
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
            margin-bottom: 10px;
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
            margin-bottom: 30px;
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
            margin-bottom: 10px;
        }

        .cost-range-title {
            font-size: 14px;
            margin-bottom: 5px;
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
            margin-bottom: 20px;
        }

        /* Page 3 styles */
        .charts-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .chart-section {
            width: 48%;
            background-color: #f4f4f8;
            border-radius: 10px;
            padding: 20px;
        }

        .chart-title {
            background-color: #5A2828;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-align: center;
            margin-bottom: 15px;
        }

        .chart-description {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .pie-chart {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            position: relative;
            background: conic-gradient(
                #23263b 0% 57%,
                #3498db 57% 66%,
                #e84393 66% 87%,
                #f1c40f 87% 94%,
                #e74c3c 94% 95%,
                #7ed6df 95% 100%
            );
        }

        .pie-chart2 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: conic-gradient(
                #23263b 0% 13%,
                #3498db 13% 55%,
                #e84393 55% 100%
            );
        }

        .chart-legend {
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
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
            margin-bottom: 30px;
        }

        .hack-item {
            flex: 1;
            min-width: 45%;
            background-color: #f4f4f8;
            border-radius: 10px;
            padding: 20px;
        }

        .hack-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
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

        .flooring-hack {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Page 1 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="logo">INTERIOR<span>SPACE</span></div>
            <div class="report-title">
                <h1>Budget Report</h1>
                <p>Generated by Qanvast on 19th February 2025</p>
            </div>
        </div>

        <!-- Overview Section -->
        <div class="section-header">Overview</div>

        <div class="section-content">
            <div class="property-info">
                <h3>Property Details</h3>
                <p>HDB, New, 1,100sq ft</p>
                <p>4 Bedrooms, 0 Bathrooms</p>
            </div>

            <div class="property-info">
                <h3>Rooms to Renovate</h3>
                <p>Living/Dining Kitchen,</p>
                <p>Bedrooms</p>
            </div>

            <div class="budget-info">
                <h3>Your Estimated Renovation Budget</h3>
                <div class="budget-amount">$34,700-$41,640</div>
            </div>
        </div>

        <!-- Main Works -->
        <div class="section-header" style="border-radius: 30px;">Main Works</div>

        <div class="works-container">
            <div class="work-section">
                <div class="work-title">Living/Dining</div>
                <table class="work-table">
                    <tr>
                        <td class="work-item">Hacking</td>
                        <td class="work-level">Moderate</td>
                        <td class="work-cost">$200-$300</td>
                    </tr>
                    <tr>
                        <td class="work-item">Masonry</td>
                        <td class="work-level">Moderate</td>
                        <td class="work-cost">$900-$3,200</td>
                    </tr>
                    <tr>
                        <td class="work-item">Carpentry</td>
                        <td class="work-level">Light</td>
                        <td class="work-cost">100-$3,000</td>
                    </tr>
                    <tr>
                        <td class="work-item">Ceiling & Partition</td>
                        <td class="work-level">Moderate</td>
                        <td class="work-cost">$200-$1,100</td>
                    </tr>
                </table>
            </div>

            <div class="work-section">
                <div class="work-title">Kitchen</div>
                <table class="work-table">
                    <tr>
                        <td class="work-item">Hacking</td>
                        <td class="work-level">Light</td>
                        <td class="work-cost">100-$200</td>
                    </tr>
                    <tr>
                        <td class="work-item">Masonry</td>
                        <td class="work-level">Moderate</td>
                        <td class="work-cost">700-$3,700</td>
                    </tr>
                    <tr>
                        <td class="work-item">Carpentry</td>
                        <td class="work-level">Extensive</td>
                        <td class="work-cost">8,700-$30,500</td>
                    </tr>
                    <tr>
                        <td class="work-item">Plumbing</td>
                        <td class="work-level">Extensive</td>
                        <td class="work-cost">300-$3,200</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="works-container">
            <div class="work-section">
                <div class="work-title">Bedrooms</div>
                <table class="work-table">
                    <tr>
                        <td class="work-item">Hacking</td>
                        <td class="work-level">Extensive</td>
                        <td class="work-cost">$2,100-$7,400</td>
                    </tr>
                    <tr>
                        <td class="work-item">Masonry</td>
                        <td class="work-level">Moderate</td>
                        <td class="work-cost">$2,300-$4,300</td>
                    </tr>
                    <tr>
                        <td class="work-item">Carpentry</td>
                        <td class="work-level">Moderate</td>
                        <td class="work-cost">$5,200-$8,800</td>
                    </tr>
                    <tr>
                        <td class="work-item">Ceiling & Partition</td>
                        <td class="work-level">Moderate</td>
                        <td class="work-cost">$1,700-$2,300</td>
                    </tr>
                </table>
            </div>

            <div class="work-section">
                <div class="work-title">Bathrooms</div>
                <table class="work-table">
                    <tr>
                        <td class="work-item">Hacking</td>
                        <td class="work-level">None</td>
                        <td class="work-cost">-</td>
                    </tr>
                    <tr>
                        <td class="work-item">Masonry</td>
                        <td class="work-level">None</td>
                        <td class="work-cost">-</td>
                    </tr>
                    <tr>
                        <td class="work-item">Carpentry</td>
                        <td class="work-level">None</td>
                        <td class="work-cost">-</td>
                    </tr>
                    <tr>
                        <td class="work-item">Plumbing</td>
                        <td class="work-level">None</td>
                        <td class="work-cost">-</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Other Additional Works -->
        <div class="section-header" style="border-radius: 30px;">Other Additional Works</div>

        <div class="other-works">
            <div class="other-work-item">
                <div class="other-work-title">Electrical Works</div>
                <div class="other-work-level">Light</div>
                <div class="other-work-cost">$100-$1,000</div>
            </div>

            <div class="other-work-item">
                <div class="other-work-title">Glass & Aluminium</div>
                <div class="other-work-level">Light</div>
                <div class="other-work-cost">$100-$1,500</div>
            </div>

            <div class="other-work-item">
                <div class="other-work-title">Painting</div>
                <div class="other-work-level">Light</div>
                <div class="other-work-cost">$100-$1,100</div>
            </div>

            <div class="other-work-item">
                <div class="other-work-title">Cleaning & Polishing</div>
                <div class="other-work-level">Light</div>
                <div class="other-work-cost">$100-$1,000</div>
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <div class="marketing-text">
                <div class="marketing-title">Make your renovation easy and rewarding.</div>
                <div class="marketing-description">
                    The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast Guarantee.
                </div>
                <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                <a href="#" class="marketing-button">Find Out More</a>
            </div>
            <div class="marketing-image">
                <!-- Placeholder for image -->
                <img src="https://placehold.co/600x400/EEE/31343C" alt="Renovation illustration">
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from 2021 till present. This report should only be used as a guide. Costs may vary depending on interior design firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>

    <!-- Page 2 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="logo">INTERIOR<span>SPACE</span></div>
            <div class="report-title">
                <h1>Budget Report</h1>
                <p>Generated by Qanvast on 19th February 2025</p>
            </div>
        </div>

        <!-- Average Renovation Costs -->
        <div class="section-header">Average Renovation Costs for HDB (New)</div>

        <div class="average-costs">
            <div class="budget-box">
                <div class="budget-box-title">Your Budget</div>
                <div class="budget-box-amount">$34,700-$41,640</div>
            </div>

            <!-- Cost Distribution Graph -->
            <div class="cost-distribution">
                <div class="cost-marker">
                    <div class="cost-marker-arrow"></div>
                </div>
                <!-- Distribution graph would be here -->
            </div>

            <div class="cost-range">
                <div class="cost-range-item">
                    <div class="cost-range-box">
                        <div class="cost-range-title">Lower-end</div>
                        <div class="cost-range-amount">$27,000</div>
                    </div>
                </div>

                <div class="cost-range-item">
                    <div class="cost-range-box">
                        <div class="cost-range-title">Average</div>
                        <div class="cost-range-amount">$45,000</div>
                    </div>
                </div>

                <div class="cost-range-item">
                    <div class="cost-range-box">
                        <div class="cost-range-title">Higher-end</div>
                        <div class="cost-range-amount">$72,000</div>
                    </div>
                </div>
            </div>

            <div class="cost-info-box">
                Based on $52,277,000 worth of HDB (New) contracts in our database, the average renovation cost is $45,000.
            </div>

            <div class="cost-info-box">
                Your renovation budget of $34,700-$41,640 falls within the lower-end range.
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <div class="marketing-text">
                <div class="marketing-title">Make your renovation easy and rewarding.</div>
                <div class="marketing-description">
                    The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast Guarantee.
                </div>
                <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                <a href="#" class="marketing-button">Find Out More</a>
            </div>
            <div class="marketing-image">
                <!-- Placeholder for image -->
                <img src="https://placehold.co/600x400/EEE/31343C" alt="Renovation illustration">
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from 2021 till present. This report should only be used as a guide. Costs may vary depending on interior design firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>

    <!-- Page 3 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="logo">INTERIOR<span>SPACE</span></div>
            <div class="report-title">
                <h1>Budget Report</h1>
                <p>Generated by Qanvast on 19th February 2025</p>
            </div>
        </div>

        <!-- Budget Breakdowns -->
        <div class="charts-container">
            <div class="chart-section">
                <div class="chart-title">Budget Breakdown by Works</div>
                <div class="chart-description">Here's the budget breakdown allocated for each work required.</div>

                <!-- Pie Chart for Works -->
                <div class="pie-chart"></div>

                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #23263b;"></div>
                        <div class="legend-text">Carpentry</div>
                        <div class="legend-value">57% (approx. $19,800)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #3498db;"></div>
                        <div class="legend-text">Hacking</div>
                        <div class="legend-value">9% (approx. $3,100)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #e84393;"></div>
                        <div class="legend-text">Masonry</div>
                        <div class="legend-value">21% (approx. $7,300)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #f1c40f;"></div>
                        <div class="legend-text">Ceiling & Partition</div>
                        <div class="legend-value">7% (approx. $2,500)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #e74c3c;"></div>
                        <div class="legend-text">Plumbing</div>
                        <div class="legend-value">1% (approx. $200)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #7ed6df;"></div>
                        <div class="legend-text">Other General Works</div>
                        <div class="legend-value">5% (approx. $1,800)</div>
                    </div>
                </div>
            </div>

            <div class="chart-section">
                <div class="chart-title">Budget Breakdown by Room Type</div>
                <div class="chart-description">Here's the budget breakdown allocated for each room.</div>

                <!-- Pie Chart for Room Type -->
                <div class="pie-chart2"></div>

                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #23263b;"></div>
                        <div class="legend-text">Living / Dining</div>
                        <div class="legend-value">13% (approx. $4,200)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #3498db;"></div>
                        <div class="legend-text">Kitchen</div>
                        <div class="legend-value">42% (approx. $13,900)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #e84393;"></div>
                        <div class="legend-text">Bedrooms</div>
                        <div class="legend-value">45% (approx. $14,800)</div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #f8f9fa;"></div>
                        <div class="legend-text">Bathrooms</div>
                        <div class="legend-value">0% (approx. $0)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <div class="marketing-text">
                <div class="marketing-title">Make your renovation easy and rewarding.</div>
                <div class="marketing-description">
                    The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast Guarantee.
                </div>
                <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                <a href="#" class="marketing-button">Find Out More</a>
            </div>
            <div class="marketing-image">
                <!-- Placeholder for image -->
                <img src="https://placehold.co/600x400/EEE/31343C" alt="Renovation illustration">
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from 2021 till present. This report should only be used as a guide. Costs may vary depending on interior design firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>

    <!-- Page 4 -->
    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="logo">INTERIOR<span>SPACE</span></div>
            <div class="report-title">
                <h1>Budget Report</h1>
                <p>Generated by Qanvast on 19th February 2025</p>
            </div>
        </div>

        <!-- Renovation Budgeting Hacks -->
        <div class="section-header">Renovation Budgeting Hacks</div>

        <div style="margin-bottom: 30px; text-align: center;">
            <p>We hope our report gives you a better idea of how much to budget for your renovation. Still, it never hurts to save more! Here are some tips that can help shave your renovation bill and avoid extra costs.</p>
        </div>

        <div class="hacks-container">
            <div class="hack-item">
                <div class="hack-title">
                    <div class="hack-icon"></div>
                    Renovation Packages
                </div>
                <div class="hack-description">
                    Renovation packages aren't always the most cost-efficient option out there. Decide wisely many come with limitations in terms of design, amount of work done and materials. Sometimes, top-ups may even end up costing more
                </div>
            </div>

            <div class="hack-item">
                <div class="hack-title">
                    <div class="hack-icon"></div>
                    Electrical Wiring
                </div>
                <div class="hack-description">
                    Don't go overboard installing power points having more sockets means more rewiring work and expenses. This could mean your final expenditure on electrical works will end up being significantly higher, especially if you're completing rewiring an older resale flat
                </div>
            </div>

            <div class="hack-item">
                <div class="hack-title">
                    <div class="hack-icon"></div>
                    Carpentry
                </div>
                <div class="hack-description">
                    Customised carpentry is one of the more expensive components in a renovation quote, as prices vary based on the materials used and amount of workmanship required. If you are working with a tight budget, consider going for more loose furniture instead.
                </div>
            </div>

            <div class="hack-item">
                <div class="hack-title">
                    <div class="hack-icon"></div>
                    Hacking
                </div>
                <div class="hack-description">
                    If you're working on a tight budget, skip out on hacking wherever you can as it can easily set you back by hundreds to thousands. In fact, half-hacked walls are more expensive than fully hacked ones. Why? Additional work is required to fully hack and patch the wall back up to half length.
                </div>
            </div>

            <div class="hack-item flooring-hack">
                <div class="hack-title">
                    <div class="hack-icon"></div>
                    Flooring
                </div>
                <div class="hack-description">
                    Flooring is another expensive component; changing the entire floor can be relatively costly given the area size. Check with your interior designer if an overlay is feasible instead. If you're on a budget, consider vinyl flooring over ceramic tiles or stone for a more wallet-friendly option.
                </div>
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="marketing">
            <div class="marketing-text">
                <div class="marketing-title">Make your renovation easy and rewarding.</div>
                <div class="marketing-description">
                    The Qanvast Trust Programme is a free initiative that simplifies your search for a reliable interior firm and rewards you with upsized furnishing deals and perks. Meet reliable firms backed by homeowners' reviews and enjoy peace of mind with refundable deposits and our $50,000 Qanvast Guarantee.
                </div>
                <div class="marketing-description">Connect with an interior firm via Qanvast to get started!</div>
                <a href="#" class="marketing-button">Find Out More</a>
            </div>
            <div class="marketing-image">
                <!-- Placeholder for image -->
                <img src="https://placehold.co/600x400/EEE/31343C" alt="Renovation illustration">
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="disclaimer">
            Disclaimer: The estimated figures for the cost breakdown are derived from renovation contracts received from 2021 till present. This report should only be used as a guide. Costs may vary depending on interior design firms and other factors like supply and demand of materials and labour costs.
        </div>
    </div>
</body>
</html>
