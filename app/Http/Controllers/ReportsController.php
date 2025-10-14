<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function cdp()
    {
        // Sample data placeholders; replace with real metrics later
        $reportingYear = now()->year + 1; // show 2025 like reference
        $reportData = [
            'reporting_year' => (string) $reportingYear,
            'period' => [
                'start' => '01-01-' . ($reportingYear - 1),
                'end' => '12-31-' . ($reportingYear - 1),
            ],
            'scope1' => [
                ['label' => 'Carbon Dioxide (CO2)', 'value' => null],
                ['label' => 'Methane (CH4)', 'value' => null],
                ['label' => 'Nitrous Oxide (N2O)', 'value' => null],
                ['label' => 'Hydrofluorocarbons (HFCs)', 'value' => null],
                ['label' => 'Perfluorocarbons (PFCs)', 'value' => null],
                ['label' => 'Sulfur Hexafluoride (SF6)', 'value' => null],
                ['label' => 'Nitrogen Trifluoride (NF3)', 'value' => null],
                ['label' => 'Other', 'value' => null],
            ],
            'scope1_activity' => [
                ['label' => 'Stationary Combustion - Facility', 'value' => null],
                ['label' => 'Fugitive Emissions - Industrial Gases', 'value' => null],
                ['label' => 'Fugitive Emissions - Refrigeration', 'value' => null],
                ['label' => 'Mobile Combustion', 'value' => null],
            ],
            'scope2_activity' => [
                ['label' => 'Purchased Electricity - Facility', 'value' => null],
                ['label' => 'Purchased Cooling', 'value' => null],
                ['label' => 'Purchased Heat & Steam', 'value' => null],
            ],
            'scope1_country' => [
                ['label' => "Your location's country #1", 'value' => null],
                ['label' => "Your location's country #2", 'value' => null],
                ['label' => "Your location's country #3", 'value' => null],
                ['label' => "Your location's country #4", 'value' => null],
                ['label' => "Your location's country #5", 'value' => null],
            ],
            'scope2_country' => [
                ['label' => "Your location's country #1", 'value' => null],
                ['label' => "Your location's country #2", 'value' => null],
                ['label' => "Your location's country #3", 'value' => null],
                ['label' => "Your location's country #4", 'value' => null],
                ['label' => "Your location's country #5", 'value' => null],
            ],
            'scope3_category' => [
                ['label' => 'Business Travel', 'value' => null],
                ['label' => 'Upstream T&D', 'value' => null],
            ],
        ];

        return view('admin.reports.cdp', compact('reportData'));
    }

    public function methodology()
    {
        // Match CDP layout: Reporting Period, Scope 1, Scope 2, Scope 3 (placeholders)
        $reportingYear = now()->year + 1; // e.g., 2025
        $reportData = [
            'reporting_year' => (string) $reportingYear,
            'period' => [
                'start' => '01-01-' . ($reportingYear - 1),
                'end' => '12-31-' . ($reportingYear - 1),
            ],
            'scope1_sections' => [
                'Mobile Combustion',
                'Fugitive Emissions - Refrigeration',
                'Stationary Combustion - Facility',
                'Fugitive Emissions - Industrial Gases',
            ],
            'scope2_sections' => [
                'Purchased Electricity - Facility',
                'Purchased Heat & Steam',
                'Purchased Cooling',
            ],
            'scope3_sections' => [
                'Category 4: Upstream Transportation and Distribution',
                'Category 6: Business Travel - Hotel Stay',
                'Category 6: Business Travel - Private Air Travel',
            ],
        ];

        return view('admin.reports.methodology', compact('reportData'));
    }

    public function sustainability()
    {
        $reportingYear = (int) date('Y') - 1; // example selection
        return view('admin.reports.sustainability', [
            'reportingYear' => $reportingYear,
            'supportsFromYear' => 2024,
        ]);
    }

    public function secr()
    {
        $reportingYear = (int) date('Y') - 1;
        $periods = [
            ($reportingYear - 1) => '01-01-' . ($reportingYear - 1) . ' to 12-31-' . ($reportingYear - 1),
            ($reportingYear) => '01-01-' . ($reportingYear) . ' to 12-31-' . ($reportingYear),
        ];

        $rowsScope1 = [
            ['unit' => 't CO2e', 'category' => 'Stationary Combustion Including...', 'y1' => null, 'y2' => null, 'change' => null],
            ['unit' => 't CO2e', 'category' => 'Combustion of Fuels for Transport', 'y1' => null, 'y2' => null, 'change' => null],
            ['unit' => 't CO2e', 'category' => 'Fugitive Emissions', 'y1' => null, 'y2' => null, 'change' => null],
        ];

        $rowsScope2Loc = [
            ['unit' => 't CO2e', 'category' => 'Purchased Electricity - Location-Based', 'y1' => null, 'y2' => null, 'change' => null],
            ['unit' => 't CO2e', 'category' => 'Purchased Heat and Steam - Location-Based', 'y1' => null, 'y2' => null, 'change' => null],
            ['unit' => 't CO2e', 'category' => 'Purchased Cooling - Location-Based', 'y1' => null, 'y2' => null, 'change' => null],
        ];

        $rowsScope2Mkt = [
            ['unit' => 't CO2e', 'category' => 'Purchased Electricity - Market-Based', 'y1' => null, 'y2' => null, 'change' => null],
        ];

        return view('admin.reports.secr', compact('reportingYear', 'periods', 'rowsScope1', 'rowsScope2Loc', 'rowsScope2Mkt'));
    }
}


