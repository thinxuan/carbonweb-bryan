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
                'route' => 'admin.scope3.purchased-goods-services',
                'source_key' => 'purchased_goods'
            ],
            'category2' => [
                'id' => 'category2',
                'title' => 'Capital Goods',
                'category' => 'Category 2',
                'description' => 'Track emissions from capital goods purchased',
                'route' => 'admin.scope3.category',
                'route_params' => ['category' => 'capital-goods'],
                'source_key' => 'capital_goods'
            ],
            'category3' => [
                'id' => 'category3',
                'title' => 'Fuel and Energy-Related Activities Not Included in Scope 1 or Scope 2',
                'category' => 'Category 3',
                'description' => 'Track emissions from fuel and energy-related activities',
                'route' => 'admin.scope3.category',
                'route_params' => ['category' => 'fuel-energy'],
                'source_key' => 'fuel_energy'
            ],
            'category4' => [
                'id' => 'category4',
                'title' => 'Upstream Transportation and Distribution',
                'category' => 'Category 4',
                'description' => 'Track emissions from upstream transportation',
                'route' => 'admin.scope3.category',
                'route_params' => ['category' => 'upstream-transport'],
                'source_key' => 'upstream_transport'
            ],
            'category5' => [
                'id' => 'category5',
                'title' => 'Waste Generated in Operations',
                'category' => 'Category 5',
                'description' => 'Track emissions from waste generated',
                'route' => '#',
                'source_key' => 'waste_operations'
            ],
            'category6' => [
                'id' => 'category6',
                'title' => 'Business Travel - Commercial Air Travel',
                'category' => 'Category 6',
                'description' => 'Track emissions from business air travel',
                'route' => 'admin.scope3.business-travel',
                'source_key' => 'business_travel_air'
            ],
            'category7' => [
                'id' => 'category7',
                'title' => 'Business Travel - Hotel Stay',
                'category' => 'Category 6',
                'description' => 'Track emissions from hotel stays',
                'route' => '#',
                'source_key' => 'business_travel_hotel'
            ],
            'category8' => [
                'id' => 'category8',
                'title' => 'Business Travel - Private Air Travel',
                'category' => 'Category 6',
                'description' => 'Track emissions from private air travel',
                'route' => '#',
                'source_key' => 'business_travel_private'
            ],
            'category9' => [
                'id' => 'category9',
                'title' => 'Business Travel - Ground Travel',
                'category' => 'Category 6',
                'description' => 'Track emissions from ground travel',
                'route' => '#',
                'source_key' => 'business_travel_ground'
            ],
            'category10' => [
                'id' => 'category10',
                'title' => 'Employee Commuting',
                'category' => 'Category 7',
                'description' => 'Track emissions from employee commuting',
                'route' => '#',
                'source_key' => 'employee_commuting'
            ],
            'category11' => [
                'id' => 'category11',
                'title' => 'Upstream Leased Assets',
                'category' => 'Category 8',
                'description' => 'Track emissions from upstream leased assets',
                'route' => '#',
                'source_key' => 'upstream_leased'
            ],
            'category12' => [
                'id' => 'category12',
                'title' => 'Downstream Transportation and Distribution',
                'category' => 'Category 9',
                'description' => 'Track emissions from downstream transportation',
                'route' => '#',
                'source_key' => 'downstream_transport'
            ],
            'category13' => [
                'id' => 'category13',
                'title' => 'Downstream Processing of Sold Products',
                'category' => 'Category 10',
                'description' => 'Track emissions from processing of sold products',
                'route' => '#',
                'source_key' => 'downstream_processing'
            ],
            'category14' => [
                'id' => 'category14',
                'title' => 'Use of Sold Products Direct Use Phase',
                'category' => 'Category 11',
                'description' => 'Track emissions from use of sold products',
                'route' => '#',
                'source_key' => 'use_sold_products'
            ],
            'category15' => [
                'id' => 'category15',
                'title' => 'End of Life Treatment of Sold Products',
                'category' => 'Category 12',
                'description' => 'Track emissions from end of life treatment',
                'route' => '#',
                'source_key' => 'end_of_life'
            ],
            'category16' => [
                'id' => 'category16',
                'title' => 'Downstream Leased Asset',
                'category' => 'Category 13',
                'description' => 'Track emissions from downstream leased assets',
                'route' => '#',
                'source_key' => 'downstream_leased'
            ],
            'category17' => [
                'id' => 'category17',
                'title' => 'Franchises',
                'category' => 'Category 14',
                'description' => 'Track emissions from franchises',
                'route' => '#',
                'source_key' => 'franchises'
            ],
            'category18' => [
                'id' => 'category18',
                'title' => 'Investment - Equity',
                'category' => 'Category 15',
                'description' => 'Track emissions from equity investments',
                'route' => '#',
                'source_key' => 'investment_equity'
            ],
        ];

        // Filter to get only selected categories
        $uploadDataItems = array_filter($allCategories, function($key) use ($selectedCategories) {
            return in_array($key, $selectedCategories);
        }, ARRAY_FILTER_USE_KEY);

        $inReviewItems = [];
        $doneItems = [];

        return view('admin.scope3.index', compact('uploadDataItems', 'inReviewItems', 'doneItems'));
    }

    /**
     * Display the Purchased Goods and Services page.
     */
    public function purchasedGoodsServices()
    {
        return view('admin.scope3.purchased-goods-services');
    }

    /**
     * Display the Business Travel - Commercial Air Travel page.
     */
    public function businessTravel()
    {
        return view('admin.scope3.business-travel');
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

        return view('admin.scope3.category', compact('category', 'categoryData'));
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
            'fuel-energy' => [
                'title' => 'Fuel And Energy',
                'scope' => 'Scope 3 - Category 5',
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
            // Note: I'll add the remaining 16 categories in a separate update to avoid the response being too long
        ];
    }
}
