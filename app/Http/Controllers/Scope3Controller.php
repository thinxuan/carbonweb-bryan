<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Scope3Controller extends Controller
{
    /**
     * Display the Scope 3 page.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Get selected categories from session (default to category1 and category2)
        $selectedCategories = session('scope3_selected_categories', ['category1', 'category2']);

        // Define all available categories
        $allCategories = [
            'category1' => [
                'id' => 'category1',
                'title' => 'Purchased Goods and Services',
                'category' => 'Category 1',
                'description' => 'Track emissions from goods and services purchased by your organization',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'purchased-goods'],
                'source_key' => 'purchased_goods'
            ],
            'category2' => [
                'id' => 'category2',
                'title' => 'Capital Goods',
                'category' => 'Category 2',
                'description' => 'Track emissions from capital goods purchased',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'capital-goods'],
                'source_key' => 'capital_goods'
            ],
            'category3' => [
                'id' => 'category3',
                'title' => 'Fuel and Energy-Related Activities Not Included in Scope 1 or Scope 2',
                'category' => 'Category 3',
                'description' => 'Track emissions from fuel and energy-related activities',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'fuel-energy'],
                'source_key' => 'fuel_energy'
            ],
            'category4' => [
                'id' => 'category4',
                'title' => 'Upstream Transportation and Distribution',
                'category' => 'Category 4',
                'description' => 'Track emissions from upstream transportation',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'upstream-transport'],
                'source_key' => 'upstream_transport'
            ],
            'category5' => [
                'id' => 'category5',
                'title' => 'Waste Generated in Operations',
                'category' => 'Category 5',
                'description' => 'Track emissions from waste generated',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'waste-operations'],
                'source_key' => 'waste_operations'
            ],
            'category6' => [
                'id' => 'category6',
                'title' => 'Business Travel - Commercial Air Travel',
                'category' => 'Category 6',
                'description' => 'Track emissions from business air travel',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'business-travel-air'],
                'source_key' => 'business_travel_air'
            ],
            'category7' => [
                'id' => 'category7',
                'title' => 'Business Travel - Hotel Stay',
                'category' => 'Category 6',
                'description' => 'Track emissions from hotel stays',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'business-travel-hotel'],
                'source_key' => 'business_travel_hotel'
            ],
            'category8' => [
                'id' => 'category8',
                'title' => 'Business Travel - Private Air Travel',
                'category' => 'Category 6',
                'description' => 'Track emissions from private air travel',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'business-travel-private'],
                'source_key' => 'business_travel_private'
            ],
            'category9' => [
                'id' => 'category9',
                'title' => 'Business Travel - Ground Travel',
                'category' => 'Category 6',
                'description' => 'Track emissions from ground travel',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'business-travel-ground'],
                'source_key' => 'business_travel_ground'
            ],
            'category10' => [
                'id' => 'category10',
                'title' => 'Employee Commuting',
                'category' => 'Category 7',
                'description' => 'Track emissions from employee commuting',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'employee-commuting'],
                'source_key' => 'employee_commuting'
            ],
            'category11' => [
                'id' => 'category11',
                'title' => 'Upstream Leased Assets',
                'category' => 'Category 8',
                'description' => 'Track emissions from upstream leased assets',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'upstream-leased'],
                'source_key' => 'upstream_leased'
            ],
            'category12' => [
                'id' => 'category12',
                'title' => 'Downstream Transportation and Distribution',
                'category' => 'Category 9',
                'description' => 'Track emissions from downstream transportation',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'downstream-transport'],
                'source_key' => 'downstream_transport'
            ],
            'category13' => [
                'id' => 'category13',
                'title' => 'Downstream Processing of Sold Products',
                'category' => 'Category 10',
                'description' => 'Track emissions from processing of sold products',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'downstream-processing'],
                'source_key' => 'downstream_processing'
            ],
            'category14' => [
                'id' => 'category14',
                'title' => 'Use of Sold Products Direct Use Phase',
                'category' => 'Category 11',
                'description' => 'Track emissions from use of sold products',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'use-sold-products'],
                'source_key' => 'use_sold_products'
            ],
            'category15' => [
                'id' => 'category15',
                'title' => 'End of Life Treatment of Sold Products',
                'category' => 'Category 12',
                'description' => 'Track emissions from end of life treatment',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'end-of-life'],
                'source_key' => 'end_of_life'
            ],
            'category16' => [
                'id' => 'category16',
                'title' => 'Downstream Leased Asset',
                'category' => 'Category 13',
                'description' => 'Track emissions from downstream leased assets',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'downstream-leased'],
                'source_key' => 'downstream_leased'
            ],
            'category17' => [
                'id' => 'category17',
                'title' => 'Franchises',
                'category' => 'Category 14',
                'description' => 'Track emissions from franchises',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'franchise'],
                'source_key' => 'franchises'
            ],
            'category18' => [
                'id' => 'category18',
                'title' => 'Investment - Equity',
                'category' => 'Category 15',
                'description' => 'Track emissions from equity investments',
                'route' => 'account.scope3.category',
                'route_params' => ['category' => 'investment-equity'],
                'source_key' => 'investment_equity'
            ],
        ];

        // Filter to get only selected categories
        $uploadDataItems = array_filter($allCategories, function($key) use ($selectedCategories) {
            return in_array($key, $selectedCategories);
        }, ARRAY_FILTER_USE_KEY);

        $inReviewItems = [];
        $doneItems = [];

        return view('account.scope3.index', compact('uploadDataItems', 'inReviewItems', 'doneItems'));
    }

    /**
     * Display the Purchased Goods and Services page.
     */
    public function purchasedGoodsServices()
    {
        return view('account.scope3.purchased-goods-services');
    }

    /**
     * Remove a source from the upload data items.
     */
    public function removeSource(Request $request)
    {
        $sourceType = $request->input('source_type');

        // Map source types to category IDs
        $sourceToCategoryMap = [
            'purchased_goods' => 'category1',
            'capital_goods' => 'category2',
            'fuel_energy' => 'category3',
            'upstream_transport' => 'category4',
            'waste_operations' => 'category5',
            'business_travel_air' => 'category6',
            'business_travel_hotel' => 'category7',
            'business_travel_private' => 'category8',
            'business_travel_ground' => 'category9',
            'employee_commuting' => 'category10',
            'upstream_leased' => 'category11',
            'downstream_transport' => 'category12',
            'downstream_processing' => 'category13',
            'use_sold_products' => 'category14',
            'end_of_life' => 'category15',
            'downstream_leased' => 'category16',
            'franchises' => 'category17',
            'investment_equity' => 'category18',
        ];

        $categoryId = $sourceToCategoryMap[$sourceType] ?? null;

        if ($categoryId) {
            // Get current selected categories from session
            $selectedCategories = session('scope3_selected_categories', ['category1', 'category2']);

            // Remove the category from selected list
            $selectedCategories = array_filter($selectedCategories, function($cat) use ($categoryId) {
                return $cat !== $categoryId;
            });

            // Update session with filtered categories
            session(['scope3_selected_categories' => array_values($selectedCategories)]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Emissions source removed successfully. You can add it back at any time.'
        ]);
    }

    /**
     * Restore a previously removed source.
     */
    public function restoreSource(Request $request)
    {
        $sourceType = $request->input('source_type');

        // Get current removed sources from session
        $removedSources = session('removed_sources', []);

        // Remove the source from removed list
        $removedSources = array_filter($removedSources, function($source) use ($sourceType) {
            return $source !== $sourceType;
        });

        session(['removed_sources' => array_values($removedSources)]);

        return response()->json([
            'success' => true,
            'message' => 'Emissions source restored successfully.'
        ]);
    }

    /**
     * Save selected categories from Edit Sources modal.
     */
    public function saveCategories(Request $request)
    {
        $requestedCategories = (array) $request->input('categories', []);

        // Allowed keys: category1..category18
        $allowed = array_map(function ($n) { return 'category' . $n; }, range(1, 18));

        // Sanitize: keep only allowed and unique values, preserve order
        $cleaned = [];
        foreach ($requestedCategories as $cat) {
            if (in_array($cat, $allowed, true) && !in_array($cat, $cleaned, true)) {
                $cleaned[] = $cat;
            }
        }

        // Persist in session
        session(['scope3_selected_categories' => $cleaned]);

        return response()->json([
            'success' => true,
            'message' => 'Categories saved successfully.',
            'selected_count' => count($cleaned),
            'categories' => $cleaned,
        ]);
    }

    /**
     * Show dynamic category page
     */
    public function showCategory($category)
    {
        $categories = $this->getCategoriesConfig();

        if (!isset($categories[$category])) {
            abort(404, 'Category not found');
        }

        $categoryData = $categories[$category];

        return view('account.scope3.category', compact('category', 'categoryData'));
    }

    public function footprintAnalytics()
    {
        // Sample data for footprint analytics
        $footprintData = [
            'total_emissions' => '7,685.25',
            'reporting_year' => '2024',
            'date_range' => '01-01-2024 - 12-31-2024',
            'last_updated' => 'Sat, Oct 11, 2025, 03:02:28 AM GMT+8',
            'scopes' => [
                'scope1' => [
                    'value' => '7,681.58',
                    'color' => '#fbbf24', // yellow
                    'label' => 'Scope 1'
                ],
                'scope2' => [
                    'value' => '3.67',
                    'color' => '#8b5cf6', // purple
                    'label' => 'Scope 2'
                ],
                'scope3' => [
                    'value' => '0',
                    'color' => '#ec4899', // pink
                    'label' => 'Scope 3'
                ]
            ]
        ];

        return view('account.scope3.footprint-analytics', compact('footprintData'));
    }

    /**
     * Get all categories configuration
     */
    private function getCategoriesConfig()
    {
        return [
            'purchased-goods' => [
                'title' => 'Purchased Goods & Services',
                'scope' => 'Scope 3 - Category 1',
                'description' => 'This category accounts for upstream (cradle-to-gate) emissions from products purchased or acquired in 2024. The two most common calculation approaches are the spend-based method and the physical quantity method.',
                'additional_text' => 'The spend-based method uses the monetary value of purchased goods and services to calculate emissions, while the physical quantity method uses the actual amount of goods purchased (e.g., weight, volume, number of units).',
                'template_type' => 'dual_option',
                'options' => [
                    'amount_spent' => [
                        'title' => 'Amount spent in 2024',
                        'recommended' => true,
                        'description' => 'To proceed using amount spent, download and complete the Spend-Based Industry Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Spend-Based Industry',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the amount spent, the following four columns require data:',
                            'columns' => [
                                [
                                    'title' => 'Purchase Spend',
                                    'description' => 'Amount of money your organization spent on each line item in your ledger.'
                                ],
                                [
                                    'title' => 'Purchase Spend UOM',
                                    'description' => 'Select a currency unit that is applicable to the Purchase Spend. This information can be sourced from your purchase records.'
                                ],
                                [
                                    'title' => 'Country',
                                    'description' => 'Choose a country where the purchase was made from the dropdown list. For example, if you are a US-based company purchasing a good from France, you would select France for this field, not the US.'
                                ],
                                [
                                    'title' => 'Sub Industry',
                                    'description' => 'Select the specific sub-industry related to the purchase type. If you already classify your spend to North American Industry Classification System (NAICS) sub-industries, there is no additional work that needs to be done and you can simply copy and paste that into the template. If you need to do the mapping to sub-industry on your own, pick the best fit for each line of spend. If you need help, please reach out to your climate professional for assistance.'
                                ]
                            ]
                        ]
                    ],
                    'physical_quantity' => [
                        'title' => 'Physical quantity purchased in 2024 (e.g., weight, volume, # of units)',
                        'recommended' => false,
                        'description' => 'To proceed using physical quantity, download and complete the Average-Data Based Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Average-Data Based',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The Average-Data Based template allows you to calculate your emissions based on the physical quantity (e.g., weight, volume, # of units). The following three columns require data:',
                            'columns' => [
                                [
                                    'title' => 'Product Category',
                                    'description' => 'Choose a product category from the dropdown list. If you don\'t see a good fit based on your industry, you may want to try the spend-based method instead or contact your climate professional for help.'
                                ],
                                [
                                    'title' => 'Purchased Quantity',
                                    'description' => 'Enter the total weight of purchased goods for this Footprint Activity in this freeform text entry field. This data can be sourced from your purchase records.'
                                ],
                                [
                                    'title' => 'Purchased Quantity UOM',
                                    'description' => 'Select a unit of measure that is applicable to the Purchase Quantity.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'capital-goods' => [
                'title' => 'Capital Goods',
                'scope' => 'Scope 3 - Category 2',
                'description' => 'This category accounts for upstream emissions resulting from the production and transportation of Capital Goods purchased by the reporting company. Similar to Category 1,',
                'additional_text' => 'it is up to your organization to determine which goods are considered Capital Goods and which are Purchased Goods and Services. Typically, any good or asset that your organization considers to be a depreciating asset would fall under Capital Goods. It is best practice to align carbon accounting to financial accounting where possible. There is only one way to calculate emissions from Capital Goods in Pro, and that is to use the economic value spent in reporting year 2024 on Capital Goods. Typically your accounting, finance, or procurement team will have a list of all of the major capital expenditures your company made in your 2024 reporting period.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Capital Goods Data',
                        'description' => 'To proceed using amount spent, download and complete the Spend-Based Industry Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Spend-Based Industry',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the amount spent, the following columns require data:',
                            'columns' => [
                                [
                                    'title' => 'Purchase Spend',
                                    'description' => 'Enter the amount of money your organization spent on each capital good.'
                                ],
                                [
                                    'title' => 'Purchase Spend UOM',
                                    'description' => 'Select a currency unit that is applicable to the Purchase Spend. This information can be sourced from your purchase records.'
                                ],
                                [
                                    'title' => 'Country',
                                    'description' => 'Choose a country where the purchase was made from the dropdown list. For example, if you are a US-based company purchasing a capital good from France, you would select France for this field, not the US.'
                                ],
                                [
                                    'title' => 'Sub Industry',
                                    'description' => 'Select the specific sub-industry related to the purchase type. If you already classify your spend to North American Industry Classification System (NAICS) sub-industries, there is no additional work that needs to be done and you can simply copy and paste that into the template. If you need to do the mapping on your own, pick the best fit for each line of spend. If you need help, please reach out to your climate professional for assistance.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'fuel-energy' => [
                'title' => 'Fuel And Energy',
                'scope' => 'Scope 3 - Category 3',
                'description' => 'This category accounts for the upstream emissions resulting from the extraction, production, and transportation of fuels which are ultimately consumed by the reporting company in their',
                'additional_text' => 'operations for reporting year 2024. It excludes emissions from the combustion of fuels or electricity consumed by the reporting company because they are already included in scope 1 or scope 2. This category does not require the collection of any additional data - the same fuel, electricity, and / or purchased heat & steam data you collected to calculate your scope 1 & 2 numbers is used here. The material difference is that the scope 3 portion accounts for the emissions from fuels before they are combusted to produce heat or electricity.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Fuel And Energy Data',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Fuel-used Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The eight columns in this template that require data are:',
                            'columns' => [
                                [
                                    'title' => 'Address',
                                    'description' => 'This is the physical address of the location, including City, State/Province, Country and postal code that consumed the fuel, electricity, heat or steam. (required)'
                                ],
                                [
                                    'title' => 'Electricity Used',
                                    'description' => 'This is the total amount of electricity consumed at the given Address within your reporting year. (if applicable)'
                                ],
                                [
                                    'title' => 'Electricity Used UOM',
                                    'description' => 'Select the unit of measure applicable to the electricity used from the dropdown list. (if applicable)'
                                ],
                                [
                                    'title' => 'Fuel Name',
                                    'description' => 'Select the fuel name associated with the fuel type burned. (if applicable)'
                                ],
                                [
                                    'title' => 'Fuel Used',
                                    'description' => 'This is the total amount of fuel that was consumed at the given Address within your reporting year. (if applicable)'
                                ],
                                [
                                    'title' => 'Fuel Used UOM',
                                    'description' => 'Select the unit of measure applicable to the fuel used from the dropdown list. (if applicable)'
                                ],
                                [
                                    'title' => 'Heat & Steam',
                                    'description' => 'This is the total amount of Heat & Steam that was consumed at the given Address within your reporting year. (if applicable)'
                                ],
                                [
                                    'title' => 'Heat & Steam UOM',
                                    'description' => 'Select the unit of measure applicable to the heat & steam used from the dropdown list. (if applicable)'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'upstream-transport' => [
                'title' => 'Upstream Transportation And Distribution',
                'scope' => 'Scope 3 - Category 4',
                'description' => 'This category accounts for emissions resulting from the transportation and distribution of products purchased in reporting year 2024 between a company’s tier 1 suppliers and its own',
                'additional_text' => 'operations in vehicles not owned or operated by the reporting company, as well as third-party transportation and distribution services purchased by the company. The most accurate way to calculate emissions in Pro is to use the weight and distance traveled of each shipment. If this data is not readily available, your logistics or accounting / finance team will typically have access to the amount spent on transportation and distribution services. If you still have questions, please use the message center on the right.',
                'template_type' => 'dual_option',
                'options' => [
                    'weight_distance' => [
                        'title' => 'Weight and distance traveled of each shipment in 2024',
                        'recommended' => true,
                        'description' => 'To proceed using weight and distance traveled of each shipment, download and complete the Distance-Based Weight-Distance Excel template below.',
                        'template_name' => 'Distance-Based Weight-Distance',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The five columns in this template that require data are:',
                            'additional_note' => 'Please note that in order to get an accurate calculation, it is important to calculate each unit of measure of freight transport on a separate line in the file upload data template rather than aggregating. If you must aggregate, then you should either use the total distance traveled and the average shipment weight (mass) OR the average distance traveled and the total shipment weight (mass). Summing both of these, will overcount your emissions.',
                            'columns' => [
                                [
                                    'title' => 'Mass of Goods Transferred',
                                    'description' => 'Enter the mass of goods transported in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Mass of Goods Transferred UOM',
                                    'description' => 'Select a unit of measure applicable to the Mass of Goods Transported from the dropdown list.'
                                ],
                                [
                                    'title' => 'Distance Traveled',
                                    'description' => 'Enter the distance traveled in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Distance Traveled UOM',
                                    'description' => 'Select a unit of measure applicable to the Distance Traveled from the dropdown list.'
                                ],
                                [
                                    'title' => 'Vehicle Type',
                                    'description' => 'Choose a Vehicle Type to classify the vehicle driven from the dropdown list.'
                                ],
                            ]
                        ]
                    ],
                    'amount_spent' => [
                        'title' => 'Amount spent in 2024',
                        'recommended' => false,
                        'description' => 'To proceed using spend data, download and complete the Spend-Based Industry Excel template below.',
                        'template_name' => 'Spend-Based Industry',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The four columns in the template that require data for this category are:',
                            'columns' => [
                                [
                                    'title' => 'Purchase Spend',
                                    'description' => ' Enter the amount of money your organization spent on each line item in your ledger.'
                                ],
                                [
                                    'title' => 'Purchase Spend UOM',
                                    'description' => 'Select a currency unit that is applicable to the Purchase Spend. This information can be sourced from your purchase records.'
                                ],
                                [
                                    'title' => 'Country',
                                    'description' => 'Choose a country where the purchase was made from the dropdown list. For example, if you are a US-based company purchasing a good from France, you would select France for this field, not the US.'
                                ],
                                [
                                    'title' => 'Sub Industry',
                                    'description' => 'Select the best available sub-industry to identify whether the shipment was made by truck, rail, boat, or aircraft.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'waste-operations' => [
                'title' => 'Waste Generated in Operations',
                'scope' => 'Scope 3 - Category 5',
                'description' => 'This category accounts for emissions from third-party disposal, transport, and treatment / decomposition of waste generated in the reporting year 2024 for the company/s owned or',
                'additional_text' => 'controlled operations in the reporting year. This includes emissions from the disposal of both solid waste and wastewater. For emissions accounting purposes, waste is not segregated into hazardous and not hazardous waste. Rather, it is the actual material being disposed of that impacts the emissions. In Pro, classify your waste into various categories and provide the relevant quantity of each category along with how it was disposed. If this data is not readily available, you can typically request it from your facilities management team or waste management contractor. Companies that generate a lot of waste in operations typically keep good records of the waste disposed. Asset-light companies with mostly office waste may need to make estimations based on trash bin size.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Waste Generated Data',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Waste Generated Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The five columns in this template that require data are:',
                            'columns' => [
                                [
                                    'title' => 'Waste Category',
                                    'description' => 'Select a Waste Category to classify the waste type from the dropdown list.'
                                ],
                                [
                                    'title' => 'Waste Sub Category',
                                    'description' => 'Select a Waste Sub-Category that further classifies the waste type from the dropdown list. This field/s dropdown list is dependent on the Waste Category type chosen.'
                                ],
                                [
                                    'title' => 'Waste Quantity',
                                    'description' => 'Enter the total weight of waste generated over the reporting year in this freeform numerical field.'
                                ],
                                [
                                    'title' => 'Waste Quantity UOM',
                                    'description' => 'Select a unit of measure applicable to Waste Quantity from the dropdown list.'
                                ],
                                [
                                    'title' => 'Waste Treatment Method',
                                    'description' => 'Select a method for how the waste was treated from the dropdown list. This field/s dropdown options are dependent on the Waste Category chosen.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'business-travel-air' => [
                'title' => 'Business Travel - Commercial Air Travel',
                'scope' => 'Scope 3 - Category 6',
                'description' => 'This category accounts for the transportation of employees for business-related activities in commercial flights operated by third parties in the reporting year 2024. The most accurate',
                'additional_text' => 'way to calculate emissions is by using the distance traveled for each flight. If this data is not readily available, alternately you can request spend data from your accounting, finance, or HR team. Most companies track business travel in a 3rd party expense tracking system, like SAP Concur or Navan. If you still have questions, please use the message center on the right.',
                'template_type' => 'dual_option',
                'options' => [
                    'distance_traveled' => [
                        'title' => 'Distance traveled in 2024',
                        'recommended' => true,
                        'description' => 'To proceed with Distance-Based data, download and complete the Excel template below.',
                        'template_name' => 'Distance-traveled',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the distance traveled, the two columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Distance Traveled',
                                    'description' => 'Enter the distance traveled in this freeform text entry field. This could be for a single flight or summed across all flights.'
                                ],
                                [
                                    'title' => 'Distance Traveled UOM',
                                    'description' => 'Select a unit of measure applicable to the Distance Traveled from the dropdown list.'
                                ]
                            ]
                        ]
                    ],
                    'amount_spent' => [
                        'title' => 'Amount spent in 2024',
                        'recommended' => false,
                        'description' => 'To proceed with Spend-Based Industry data, download and complete the Excel template below.',
                        'template_name' => 'Spend-Based Industry',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the amount spent, the three columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Purchase Spend',
                                    'description' => 'Enter the amount of money your organization spent on commercial air travel. This can be for a single flight or summed across all flights.'
                                ],
                                [
                                    'title' => 'Purchase Spend UOM',
                                    'description' => 'Select a currency unit that is applicable to the Purchase Spend.'
                                ],
                                [
                                    'title' => 'Country',
                                    'description' => 'Select a country where the purchase was made from the dropdown list.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'business-travel-hotel' => [
                'title' => 'Business Travel - Hotel Stay',
                'scope' => 'Scope 3 - Category 6',
                'description' => 'This category accounts for emissions resulting from the accommodation of employees for business-related activities in facilities owned or operated by third parties in the reporting year',
                'additional_text' => '2024. The most accurate data uses the total number of nights stayed. If you don/t have this data readily available, you can use the amount spent on hotel accommodation for business travel from your accounting, finance, or HR team. Most companies track business travel in a 3rd party expense tracking system, like SAP Concur or Navan. If you still have questions, please use the message center on the right.',
                'template_type' => 'dual_option',
                'options' => [
                    'num_of_nights_stayed' => [
                        'title' => 'Number of nights stayed in 2024',
                        'recommended' => true,
                        'description' => 'To proceed using number of nights stay data, download and complete the Average-Data Based Excel template below.',
                        'template_name' => 'number-of-nights-stayed',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions using average data based on the number of nights stayed, the three columns are:',
                            'columns' => [
                                [
                                    'title' => 'Country -',
                                    'description' => "Choose a country where the Hotel Stay took place, not the currency used to purchase the stay. For example, if you paid for a Hotel in Mexico with US Dollars, you would select Mexico for this field, not the US.\n\nNote: If your desired Country is not listed, use this tool (https://www.hotelfootprints.org/) and the color-coded map to find a Country with the same color-coding (based on the Carbon Emissions per Room Night [KgCO2e]) and a comparable Rooms Footprint, and use that Country instead. For example, Croatia is not listed in Persefoni, so a Country with a matching color and similar Rooms Footprint (such as Switzerland) can be used in its place."
                                ],
                                [
                                    'title' => 'State (optional)',
                                    'description' => 'Optionally, choose a State associated with the Country in which the hotel stay took place from the dropdown list. The State field/s dropdown list is dependent on the Country chosen. Select a Country before a State.'
                                ],
                                [
                                    'title' => 'Number of Nights Stayed',
                                    'description' => 'Enter the total number of nights stayed over your reporting period in this freeform numerical field.'
                                ]
                            ]
                        ]
                    ],
                    'amount_spent' => [
                        'title' => 'Amount spent in 2024',
                        'recommended' => false,
                        'description' => 'To proceed with Spend-Based Industry data, download and complete the Excel template below.',
                        'template_name' => 'Spend-Based Industry',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the amount spent, the three columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Purchase Spend',
                                    'description' => 'Enter the amount of money your organization spent on commercial air travel. This can be for a single flight or summed across all flights.'
                                ],
                                [
                                    'title' => 'Purchase Spend UOM',
                                    'description' => 'Select a currency unit that is applicable to the Purchase Spend.'
                                ],
                                [
                                    'title' => 'Country',
                                    'description' => 'Select a country where the purchase was made from the dropdown list.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'business-travel-ground' => [
                'title' => 'Business Travel - Ground Travel',
                'scope' => 'Scope 3 - Category 6',
                'description' => 'This category accounts for emissions resulting from the transportation of employees for business-related activities in vehicles owned or operated by third parties in reporting year',
                'additional_text' => '2024. This could include bus, subway, taxi, rail, rental car, personal vehicle, or other transportation methods. The most accurate way to calculate this is using the total distance traveled for each type of ground travel. If you don/t have this data readily available, you can use the amount spent on each type of ground travel. You can typically request it from your accounting, finance, or HR team. Most companies track business travel in a 3rd party expense tracking system like SAP Concur or Navan. If you still have questions, please use the message center on the right.',
                'template_type' => 'dual_option',
                'options' => [
                    'total_distance' => [
                        'title' => 'Total distance traveled in 2024',
                        'recommended' => true,
                        'description' => 'To proceed using Distance-Based data, download and complete the Excel template below.',
                        'template_name' => 'distance-traveled',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the distance traveled, the three columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Vehicle Type',
                                    'description' => 'Choose the best fit for the type of Ground Travel from the dropdown list.'
                                ],
                                [
                                    'title' => 'Distance Traveled',
                                    'description' => 'Enter the distance traveled in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Distance Traveled UOM',
                                    'description' => 'Select a unit of measure applicable to the Distance Traveled from the dropdown list.'
                                ],
                            ]
                        ]
                    ],
                    'amount_spent' => [
                        'title' => 'Amount spent in 2024',
                        'recommended' => false,
                        'description' => 'To proceed with Spend-Based Industry data, download and complete the Excel template below.',
                        'template_name' => 'Spend-Based Industry',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the amount spent, the three columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Sub Industry',
                                    'description' => 'Choose the best fit for the type of Ground Travel from the dropdown list.'
                                ],
                                [
                                    'title' => 'Purchase Spend',
                                    'description' => 'Enter the amount of money your organization spent on commercial air travel. This can be for a single flight or summed across all flights.'
                                ],
                                [
                                    'title' => 'Purchase Spend UOM',
                                    'description' => 'Select a currency unit that is applicable to the Purchase Spend.'
                                ],
                                [
                                    'title' => 'Country',
                                    'description' => 'Select a country where the purchase was made from the dropdown list.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'business-travel-private' => [
                'title' => 'Business Travel - Private Air Travel',
                'scope' => 'Scope 3 - Category 6',
                'description' => 'This category accounts for emissions resulting from the transportation of employees for business-related activities in a private aircraft owned or operated by third parties in reporting',
                'additional_text' => 'year 2024. The most accurate way to calculate this in Pro is using the amount of fuel consumed. If you don/t have this data readily available, you can use the aircraft type and flight time. An executive assistant might be best to provide flight data for private flights. If you still have questions, please use the message center on the right.',
                'template_type' => 'dual_option',
                'options' => [
                    'fuel_amount' => [
                        'title' => 'Fuel amount used in 2024',
                        'recommended' => true,
                        'description' => 'To proceed using fuel data, download and complete the Fuel-Based Fuel Type Excel template below.',
                        'template_name' => 'number-of-nights-stayed',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the amount of fuel consumed, the two columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Fuel Quantity',
                                    'description' => 'Enter the amount of fuel used in this freeform text entry field. This can be for a single flight or summed across all flights.'
                                ],
                                [
                                    'title' => 'Fuel Quantity UOM',
                                    'description' => 'Select a unit of measure that is applicable to the Fuel Amount from the dropdown list.'
                                ]
                            ]
                        ]
                    ],
                    'aircraft_type' => [
                        'title' => 'Aircraft type and flight time in 2024',
                        'recommended' => false,
                        'description' => 'To proceed using aircraft type and flight time data, download and complete the Fuel-Based Time In Transit Excel template below.',
                        'template_name' => 'aircraft-type',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the aircraft type and flight time, the three columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Vehicle Type',
                                    'description' => 'Choose a Vehicle Type to classify the aircraft from the dropdown list.'
                                ],
                                [
                                    'title' => 'Time In Transit',
                                    'description' => 'Enter the total time in transit. This can be for a single flight or summed across all flights.'
                                ],
                                [
                                    'title' => 'Time In Transit UOM',
                                    'description' => 'Choose a unit of measure associated with Time in Transit from the dropdown list.'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            'employee-commuting' => [
                'title' => 'Employee Commuting',
                'scope' => 'Scope 3 - Category 7',
                'description' => 'This category accounts for emissions resulting from the transportation of employees between their homes and their worksites in vehicles not owned or operated by the company in',
                'additional_text' => 'reporting year 2024. The primary way to calculate emissions from this category is to survey employees on their commuting habits. This can be a complex and time consuming exercise depending on how large your organization is, and in the absence of company specific data you can default to industry averages or conservative assumptions. The minimum requirement for this calculation in Pro is to provide the total number of FTE employees during your reporting year. The platform will then apply conservative assumptions to estimate emissions. Optionally, you may provide more details including the number of working days at your organization, the distance from the office, or the type of transportation used. These details will allow your estimated emissions to be more accurate.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Employee Commuting',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Employee-commuting Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'This template consists of one required column and four optional columns:',
                            'columns' => [
                                [
                                    'title' => 'Population Size (required)',
                                    'description' => 'Input the total number of FTE employees working at your organization during the reporting year.'
                                ],
                                [
                                    'title' => 'Annual Working Days',
                                    'description' => 'Input the total number of working days at your organization. If you don/t have this information, default it to 260.'
                                ],
                                [
                                    'title' => 'Vehicle Type',
                                    'description' => 'Select the most applicable vehicle type from the dropdown list. If your employees use multiple vehicle types, you can add a row per vehicle type. If you don/t have this information, default it to passenger car.'
                                ],
                                [
                                    'title' => 'Average One-Way Distance Traveled',
                                    'description' => 'Input the average one way distance for the employees that use the selected Vehicle Type. If you don/t have this information, default it to 15.32 mi.'
                                ],
                                [
                                    'title' => 'Average Distance Traveled UOM',
                                    'description' => 'Select whether the Average One-Way Distance Traveled is in miles or kilometers.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'upstream-leased' => [
                'title' => 'Upstream Leased Assets',
                'scope' => 'Scope 3 - Category 8',
                'description' => 'This category accounts for emissions from the operation of facilities that are leased by the reporting organization (acting as a lessee) in the reporting year 2024. This category is rarely',
                'additional_text' => 'reported when a company defines their organizational boundary through the operational control approach. Operational control is by far the most common approach and the default in Persefoni Pro. This is because under the operational control approach, a company accounts for the emissions from assets they have operating control over in their scope 1 & 2, regardless of whether they are leased or owned. Therefore, the emissions from leased assets frequently end up in scope 1 & 2 of the lessee, rather than their scope 3. If you believe for some reason this category is still relevant for you, please reach out to your climate professional to discuss. The only way to calculate emissions from this category in Pro is to obtain the energy used by each leased asset.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Upstream Leased Assets',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Electricity Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The three required columns in this template are:',
                            'columns' => [
                                [
                                    'title' => 'Address',
                                    'description' => 'This is the physical address of the leased asset, including City, State/Province, Country and postal code.'
                                ],
                                [
                                    'title' => 'Electricity Used',
                                    'description' => 'Enter the amount of electrical energy used by each Address in this freeform text entry field. This information can be sourced from your electricity bill.'
                                ],
                                [
                                    'title' => 'Electricity UOM',
                                    'description' => 'Select a unit of measure that is applicable to Electricity Used from the dropdown list. This information can be sourced from your electricity bill.'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            'downstream-transport' => [
                'title' => 'Downstream Transportation and Distribution',
                'scope' => 'Scope 3 - Category 9',
                'description' => 'This category accounts for emissions resulting from reporting year 2024 the transportation and distribution of sold products in vehicles and facilities not owned or controlled by your',
                'additional_text' => 'company and that your company doesn/t pay for the transportation/distribution expense. Common occurrences of downstream transportation include when your customers arrange for goods to be picked up directly from your warehouse, or when customers drive to a retail store. The most accurate way to calculate emissions in Pro is to use the weight and distance traveled of each shipment. If this data is not readily available, your logistics or accounting / finance team will typically have access to the amount spent on transportation and distribution services. Because of the types of activities captured in downstream transportation and distribution, emissions in this category are often based on assumptions and estimates of your customer’s activities. It is fine to estimate where there is no real data available if you believe this calculation is material. If you still have questions, please use the message center on the right.',
                'template_type' => 'dual_option',
                'options' => [
                    'weight_and_distance' => [
                        'title' => 'Weight and distance traveled of each shipment in 2024',
                        'recommended' => true,
                        'description' => 'To proceed using weight and distance traveled of each shipment, download and complete the Distance-Based Weight-Distance Excel template below.',
                        'template_name' => 'distance-based-weight-distance',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the distance traveled and weight of shipments, the five columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Mass of Goods Transferred',
                                    'description' => 'Enter the mass of goods transported in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Mass of Goods Transferred UOM',
                                    'description' => 'Select a unit of measure applicable to the Mass of Goods Transported from the dropdown list.'
                                ],
                                [
                                    'title' => 'Distance Traveled',
                                    'description' => 'Enter the distance traveled in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Distance Traveled UOM',
                                    'description' => 'Select a unit of measure applicable to the Distance Traveled from the dropdown list.'
                                ],
                                [
                                    'title' => 'Vehicle Type',
                                    'description' => 'Choose a Vehicle Type to classify the vehicle driven from the dropdown list.'
                                ],
                            ]
                            , 'additional_note' => 'Please note that in order to get an accurate calculation, it is important to calculate each unit of measure of freight transport on a separate line in the file upload data template rather than aggregating. If you must aggregate, then you should either use the total distance traveled and the average shipment weight OR the average distance traveled and the total shipment weight. If you sum both of these, you will overcount emissions.'
                        ]
                    ],
                    'amount_spent' => [
                        'title' => 'Amount spent in 2024',
                        'recommended' => false,
                        'description' => 'To proceed with Spend-Based Industry data, download and complete the Excel template below.',
                        'template_name' => 'Spend-Based Industry',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your emissions based on the amount spent, the four columns which require data are:',
                            'columns' => [
                                [
                                    'title' => 'Purchase Spend',
                                    'description' => 'Enter the amount of money your customer spent on each shipment (or a sum total by shipment type).'
                                ],
                                [
                                    'title' => 'Purchase Spend UOM',
                                    'description' => 'Select a currency unit that is applicable to the Purchase Spend.'
                                ],
                                [
                                    'title' => 'Country',
                                    'description' => 'Select a country where the purchase was made from the dropdown list.'
                                ],
                                [
                                    'title' => 'Sub Industry',
                                    'description' => 'Select the best available sub-industry to identify whether the shipment was made by truck, rail, boat, or aircraft.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'downstream-processing' => [
                'title' => 'Downstream Processing of Sold Products',
                'scope' => 'Scope 3 - Category 10',
                'description' => 'This category accounts for emissions from the reporting company that sold the intermediate products allocating those emissions in reporting year 2024. This includes the scope 1 and',
                'additional_text' => 'scope 2 emissions of downstream value chain partners (e.g., fabricator, assembler, manufacturer) related to processing the intermediate products. Intermediate products are products that require further processing, transformation, and inclusion in another product before use e.g., engine, motor, or heating component. This activity data is often challenging for organizations to obtain because it is rarely known exactly what happens to an intermediate product once it is sold. Because of this, the only way to calculate emissions from this category in Pro is to obtain absolute scope 1 & 2 emissions data from your clients and attribute the relevant percentage to your scope 3. Each client can use a tool like Persefoni Pro to measure their emissions. The columns in the template simply require you to input the amount of relevant scope 1 & 2, and optionally scope 3, data from your downstream clients. If you want more information or support calculating this category, please reach out to your climate professional.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Downstream Processing of Sold Products',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Downstream-processor Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'Due to the nature of this category, emissions must be calculated independently by the downstream processors of your sold products. They can then be input into this template using the below columns.',
                            'columns' => [
                                [
                                    'title' => 'Scope 1 Amount',
                                    'description' => 'The number of reported emissions for this scope. Enter the value into the freeform numerical field.'
                                ],
                                [
                                    'title' => 'Scope 1 UOM',
                                    'description' => 'Units applicable to scope 1. Select from the dropdown list.'
                                ],
                                [
                                    'title' => 'Scope 2 Amount',
                                    'description' => 'The number of reported emissions for this scope. Enter the value into the freeform numerical field.'
                                ],
                                [
                                    'title' => 'Scope 2 UOM',
                                    'description' => 'Units applicable to scope 2. Select from the dropdown list.'
                                ],
                                [
                                    'title' => 'Scope 3 Amount',
                                    'description' => 'The number of reported emissions for this scope. Enter the value into the freeform numerical field.'
                                ],
                                [
                                    'title' => 'Scope 3 UOM',
                                    'description' => 'Units applicable to scope 3. Select from the dropdown list.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'use-sold-products' => [
                'title' => 'Use of Sold Products Direct Use Phase',
                'scope' => 'Scope 3 - Category 11',
                'description' => 'This category accounts for the reporting company/s scope 3 emissions from the use of sold products that either consume energy or are themselves combusted and result in greenhouse',
                'additional_text' => 'gas emissions in reporting year 2024. These emissions are in the scope 3 of the seller but the scope 1 and scope 2 emissions of end users, which could be both consumers and business customers. It should be noted that the Greenhouse Gas Protocol does not require this category for any products that indirectly produce emissions in their use phase. For example, the electricity needed to wash and dry clothing, generally is not required but these emissions can be reported optionally. Also, the Greenhouse Gas Protocol acknowledges that use phase data simply does not exist for some products, making emissions exceedingly difficult to estimate. In these cases, companies may disclose and justify the exclusion of downstream emissions. If you don/t have this data readily available, you can typically request it from your product management team or operations managers.',
                'template_type' => 'dual_option',
                'options' => [
                    'fuel_sold' => [
                        'title' => 'Amount of fuel sold in 2024',
                        'recommended' => true,
                        'description' => 'To proceed using the amount of fuel sold, download and complete the Fuels and Feedstocks Excel template below.',
                        'template_name' => 'fuels-sold',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate emissions using the amount fuel sold, the three required columns are:',
                            'columns' => [
                                [
                                    'title' => 'Fuel Name',
                                    'description' => 'Choose the type of fuel sold.'
                                ],
                                [
                                    'title' => 'Fuel Amount',
                                    'description' => 'Enter the amount of fuel used in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Fuel Amount UOM',
                                    'description' => 'Select a unit of measure that is applicable to the Fuel Amount from the dropdown list. The unit can be in mass/volume of Fuel Amount or energy created from the fuel usage.'
                                ],
                            ]
                        ]
                    ],
                    'fuel_consumed' => [
                        'title' => 'Average amount of fuel, electricity, and/or refrigerants that sold products consume in 2024.',
                        'recommended' => false,
                        'description' => 'To proceed using the average amount of fuel, electricity, and/or refrigerants that sold products consume, download and complete the Products that Directly Consume Energy Excel template below.',
                        'template_name' => 'fuel-consumed',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate emissions from products that directly consume energy, you can find a comprehensive list of all columns and their description below. The first three fields are required and the remaining columns to complete are conditional based on whether the given product consumes fuel, electricity, or refrigerants.',
                            'columns' => [
                                [
                                    'title' => 'Number Of Unit Sold',
                                    'description' => 'Enter the total number of individual Products sold in the Sales State over the reporting period in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Product Lifespan',
                                    'description' => 'Enter the lifespan of a Product in this freeform text entry field. This data can be sourced from a Product/s warranty life, durability testing, return data, or refurbishment data.'
                                ],
                                [
                                    'title' => 'Product Lifespan UOM',
                                    'description' => 'Select a time period associated with the Product Lifespan from the dropdown list.'
                                ],
                                [
                                    'title' => 'Fuel Name',
                                    'description' => 'Choose a Fuel Name from the dropdown list that is used by the Product.'
                                ],
                                [
                                    'title' => 'Fuel Amount',
                                    'description' => 'Enter the fuel amount used per product sold in this freeform text entry field. For example, if one Product sold uses 10 gallons of fuel over 1 year, you would enter 10 in the Fuel Amount. Persefoni takes into account the Product Lifespan and the Number of Units Sold.'
                                ],
                                [
                                    'title' => 'Fuel Amount UOM',
                                    'description' => 'Select a unit of measure that is applicable to Fuel Amount from the dropdown list.'
                                ],
                                [
                                    'title' => 'Sales Country',
                                    'description' => 'Select a Country associated with where the Product is being sold and used from the dropdown list.'
                                ],
                                [
                                    'title' => 'Sales State',
                                    'description' => 'Select a State associated with where the Product is being sold and used from the dropdown list. The Sales State ID dropdown choices are dependent on the Sales Country ID field.'
                                ],
                                [
                                    'title' => 'Electricity Used',
                                    'description' => 'Enter the electricity amount used per product sold in this freeform text entry field. For example, if one Product sold uses 10 kwh of electricity over 1 year, you would enter 10 in the Energy Used. Persefoni takes into account the Product Lifespan and the Number of Units Sold.'
                                ],
                                [
                                    'title' => 'Electricity Used UOM',
                                    'description' => 'Select a unit of measure that is applicable to Electricity Used from the dropdown list.'
                                ],
                                [
                                    'title' => 'Refrigerant Name',
                                    'description' => 'Select a GHG refrigerant gas that is associated with the Product and processes that contain fugitive refrigeration emissions from the dropdown list.'
                                ],
                                [
                                    'title' => 'Refrigerant Leakage Amount',
                                    'description' => 'Enter the refrigerant leakage amount used per product sold in this freeform text entry field. For example, if one Product sold leaks 10 gallons of refrigerant over 1 year, you would enter 10 in the Refrigerant Leakage Amount. Persefoni takes into account the Product Lifespan and the Number of Units Sold. This information can be sourced from your product/s specifications and is measured on an annual basis.'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            'end-of-life' => [
                'title' => 'End of Life Treatment of Sold Products',
                'scope' => 'Scope 3 - Category 12',
                'description' => 'This category accounts for emissions generated in reporting year 2024 when third-party consumers dispose of sold company products and packaging, including disposal, waste',
                'additional_text' => 'transport, and waste treatment/decomposition. To account for emissions from end of life treatment, classify the end of life waste into various categories and provide the relevant quantity of each category along with how it was disposed. If you don/t have this data readily available, you can typically request it from your product management team.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'End of Life Treatment of Sold Products',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Waste Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The five required columns in this template are:',
                            'columns' => [
                                [
                                    'title' => 'Waste Category',
                                    'description' => 'Select a Waste Category to classify the waste type from the dropdown list.'
                                ],
                                [
                                    'title' => 'Waste Sub Category',
                                    'description' => 'Select a Waste Sub-Category that further classifies the waste type from the dropdown list. This field/s dropdown list is dependent on the Waste Category type chosen.'
                                ],
                                [
                                    'title' => 'Waste Quantity',
                                    'description' => 'Enter the total weight of end of life waste produced over the reporting year in this freeform numerical field.'
                                ],
                                [
                                    'title' => 'Waste Quantity UOM',
                                    'description' => 'Select a unit of measure applicable to Waste Quantity from the dropdown list.'
                                ],
                                [
                                    'title' => 'Waste Treatment Method',
                                    'description' => 'Select a method for how the waste was treated from the dropdown list. This field/s dropdown options are dependent on the Waste Category chosen. Most organizations have no way of tracking this but can take a reasonable guess based off of the type of product and relevant disposal laws where it is sold.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'downstream-leased' => [
                'title' => 'Downstream Leased Assets',
                'scope' => 'Scope 3 - Category 13',
                'description' => 'This category accounts for emissions in reporting year 2024 from the operation of facilities leased from the reporting organization (acting as a lessor) in the reporting year. It is specific',
                'additional_text' => 'to lessors, i.e., organizations that receive payments from lessees, and therefore not a common category for most organizations to report. The only way to calculate emissions from this category in Pro is to obtain the energy used by each leased asset.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Downstream Leased Assets',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Electricity Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'The three required columns in this template are:',
                            'columns' => [
                                [
                                    'title' => 'Address',
                                    'description' => 'This is the physical address of the leased asset, including City, State/Province, Country and postal code.'
                                ],
                                [
                                    'title' => 'Electricity Used',
                                    'description' => 'Enter the amount of electrical energy used by each Address in this freeform text entry field. This information can be sourced from your electricity bill.'
                                ],
                                [
                                    'title' => 'Electricity UOM',
                                    'description' => 'Select a unit of measure that is applicable to Energy Used from the dropdown list. This information can be sourced from your electricity bill.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'franchise' => [
                'title' => 'Franchises',
                'scope' => 'Scope 3 - Category 14',
                'description' => 'This category applies to franchisors which are companies that grant licenses to other entities to sell or distribute their goods or services in return for payments, such as royalties for using',
                'additional_text' => 'trademarks and other services. Franchisors should account for emissions that occur from the operation of franchises in reporting year 2024, i.e., the scope 1 and scope 2 emissions of franchisees, in this category. The only way to calculate emissions from this category in Pro is to obtain absolute scope 1 & 2 emissions data from your franchises and attribute the relevant percentage to your scope 3. Each Franchise can use a tool like Persefoni Pro to measure their emissions. The columns in the template simply require you to input the amounts of relevant scope 1 & 2, and optionally scope 3, data from your franchises. If you want more information or support calculating this category, please reach out to your climate professional.',
                'template_type' => 'direct_upload',
                'options' => [
                    'direct' => [
                        'title' => 'Franchises',
                        'description' => 'To proceed, download and complete the Excel template below. Once completed, upload the file to submit it to your climate professional to review.',
                        'template_name' => 'Franchise Data',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'Due to the nature of this category, emissions must be calculated independently by your franchises. They can then be input into this template using the below columns.',
                            'columns' => [
                                [
                                    'title' => 'Franchise',
                                    'description' => 'Enter a specific name or unique term that identifies this Franchise in this freeform text entry field.'
                                ],
                                [
                                    'title' => 'Scope 1 Amount',
                                    'description' => 'The number of reported emissions for this scope. Enter the value into the freeform numerical field.'
                                ],
                                [
                                    'title' => 'Scope 1 UOM',
                                    'description' => 'Units applicable to scope 1. Select from the dropdown list.'
                                ],
                                [
                                    'title' => 'Scope 2 Amount',
                                    'description' => 'The number of reported emissions for this scope. Enter the value into the freeform numerical field.'
                                ],
                                [
                                    'title' => 'Scope 2 UOM',
                                    'description' => 'Units applicable to scope 2. Select from the dropdown list.'
                                ],
                                [
                                    'title' => 'Scope 3 Amount',
                                    'description' => 'The number of reported emissions for this scope. Enter the value into the freeform numerical field.'
                                ],
                                [
                                    'title' => 'Scope 3 UOM',
                                    'description' => 'Units applicable to scope 3. Select from the dropdown list.'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'investment-equity' => [
                'title' => 'Investments - Equity',
                'scope' => 'Scope 3 - Category 15',
                'description' => 'This category accounts for emissions in reporting year 2024 resulting from financing other companies and projects through purchasing an equity stake. The Partnership for Carbon',
                'additional_text' => 'Accounting Financials (PCAF) provides additional guidance on calculating financed emissions beyond the Greenhouse Gas Protocol, so both methodologies are available, though not all calculation approaches are available in Pro. Financed emissions are a complex and nuanced topic, so please reach out to your climate professional if you have any questions, and consider upgrading to Persefoni Advanced for more complex inventories, including for non-equity asset classes.',
                'template_type' => 'dual_option',
                'options' => [
                    'non-financial-institution' => [
                        'title' => 'Non-financial institution - use Greenhouse Gas Protocol (GHGP)',
                        'recommended' => true,
                        'description' => 'To proceed with the Greenhouse Gas Protocol methodology, download and complete the Excel template below.',
                        'template_name' => 'Greenhouse Gas Protocol',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your financed emissions using GHGP, the six required columns are:',
                            'columns' => [
                                [
                                    'title' => 'Financed Entity',
                                    'description' => 'Name of the entity you are financing.'
                                ],
                                [
                                    'title' => 'Financed Entity Country',
                                    'description' => 'Country where the financed entity is domiciled.'
                                ],
                                [
                                    'title' => 'Financed Entity Sub Industry',
                                    'description' => 'Primary North American Industry Classification System (NAICS) code for the financed entity.'
                                ],
                                [
                                    'title' => 'Company Revenue',
                                    'description' => 'Annual revenue of financed entity from most recent reporting year.'
                                ],
                                [
                                    'title' => 'Company Revenue UOM',
                                    'description' => 'Currency unit that is applicable to the Company Revenue.'
                                ],
                                [
                                    'title' => 'Equity Share Percentage',
                                    'description' => 'Percent of financed entity/s total balance sheet equity that is owned by your organization.'
                                ],
                            ]
                        ]
                    ],
                    'pcaf' => [
                        'title' => 'Financial institution - use Partnership for Carbon Accounting Financials (PCAF)',
                        'recommended' => false,
                        'description' => 'To proceed with the Partnership for Carbon Accounting Financials methodology, download and complete the Excel template below.',
                        'template_name' => 'pcaf',
                        'learn_more' => [
                            'title' => 'Template Details',
                            'description' => 'To calculate your financed emissions using PCAF, the ten required columns are:',
                            'columns' => [
                                [
                                    'title' => 'Finance Entity',
                                    'description' => ' Name of the entity you are financing.'
                                ],
                                [
                                    'title' => 'Financed Entity Country',
                                    'description' => 'Country where the financed entity is domiciled.'
                                ],
                                [
                                    'title' => 'Finance Entity Sub Industry',
                                    'description' => 'Primary North American Industry Classification System (NAICS) code for the financed entity.'
                                ],
                                [
                                    'title' => 'Ownership Percentage',
                                    'description' => 'Percent of financed entity/s total balance sheet equity that is owned by your organization.'
                                ],
                                [
                                    'title' => 'Balance Sheet Total Equity',
                                    'description' => 'Total assets minus total liabilities.'
                                ],
                                [
                                    'title' => 'Balance Sheet Total Equity UOM',
                                    'description' => 'Currency units applicable to the Balance Sheet Total Equity.'
                                ],
                                [
                                    'title' => 'Balance Sheet Total Debt',
                                    'description' => 'Short-term and long-term debt combined.'
                                ],
                                [
                                    'title' => 'Balance Sheet Total Debt UOM',
                                    'description' => 'Currency units applicable to the Balance Sheet Total Debt'
                                ],
                                [
                                    'title' => 'Company Revenue',
                                    'description' => 'Annual revenue of financed entity from most recent reporting year.'
                                ],
                                [
                                    'title' => 'Company Revenue UOM',
                                    'description' => 'Currency units applicable to the Company Revenue.'
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            // Note: I'll add the remaining 16 categories in a separate update to avoid the response being too long
        ];
    }
}
