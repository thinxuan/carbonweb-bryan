# Equipment Icons Directory

This directory should contain the following equipment icon images:

## Fuel Equipment Icons (5 total):
1. **fuel-equipment.svg** - General fuel equipment icon
2. **generator.svg** - Generator icon
3. **boiler.svg** - Boiler icon
4. **furnace.svg** - Furnace icon
5. **engine.svg** - Engine icon

## Refrigerant Equipment Icons (5 total):
1. **refrigerant-equipment.svg** - General refrigerant equipment icon
2. **chiller.svg** - Chiller icon
3. **air-conditioner.svg** - Air conditioner icon
4. **refrigerator.svg** - Refrigerator icon
5. **freezer.svg** - Freezer icon

## Industrial Gas Equipment Icons (5 total):
1. **gas-equipment.svg** - General gas equipment icon
2. **tank.svg** - Gas tank icon
3. **cylinder.svg** - Gas cylinder icon
4. **pipeline.svg** - Gas pipeline icon
5. **valve.svg** - Gas valve icon

## Image Specifications:
- **Format**: SVG (recommended) or PNG
- **Size**: 64x64px or 128x128px (will be scaled by CSS to 100x100px for choices, 150x150px for selected)
- **Background**: Transparent or white
- **Style**: Simple, clean equipment silhouettes or icons
- **Colors**: Preferably monochrome or simple colors that work well with the blue accent color

## Usage:
These images are used in the equipment creation form where users can select an equipment icon to represent their equipment type. The icon grid changes dynamically based on the equipment checkbox selected:

- **This equipment consumes fuel**: Shows 5 fuel-related equipment icons
- **This equipment uses refrigerants**: Shows 5 refrigerant-related equipment icons
- **This equipment uses industrial gases**: Shows 5 industrial gas-related equipment icons

The images are displayed in a grid layout with a larger preview (150x150px) on the left and smaller choices (100x100px) on the right.

## Dynamic Loading:
The system automatically loads different icon sets based on the equipment checkbox selected:
- Fuel equipment icons are loaded when "This equipment consumes fuel" is checked
- Refrigerant equipment icons are loaded when "This equipment uses refrigerants" is checked
- Industrial gas equipment icons are loaded when "This equipment uses industrial gases" is checked

## Fallback:
If images are not available, the system will show broken image placeholders. Make sure to add all required images to this directory.
