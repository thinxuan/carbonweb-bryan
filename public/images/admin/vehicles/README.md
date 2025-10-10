# Vehicle Icons Directory

This directory should contain the following vehicle icon images:

## Car Icons (5 total):
1. **sedan.svg** - Standard sedan car icon
2. **hatchback.svg** - Hatchback car icon  
3. **suv.svg** - SUV icon
4. **convertible.svg** - Convertible car icon
5. **truck.svg** - Standard truck icon

## Heavy Goods Vehicle (Truck) Icons (7 total):
1. **heavy-duty-truck.svg** - Heavy duty truck icon
2. **lorry.svg** - Lorry icon
3. **semi-lorry.svg** - Semi lorry icon
4. **lift-truck.svg** - Lift truck icon
5. **fork-lift.svg** - Fork lift icon
6. **van.svg** - Van icon
7. **metro-bus.svg** - Metro bus icon

## Motorbike Icons (2 total):
1. **motorbike.svg** - Standard motorbike icon
2. **bike.svg** - Bike icon

## Van Icons (3 total):
1. **van.svg** - Standard van icon
2. **passenger-car-truck.svg** - Passenger car truck icon
3. **car-van.svg** - Car van icon

## Image Specifications:
- **Format**: SVG (recommended) or PNG
- **Size**: 64x64px or 128x128px (will be scaled by CSS to 100x100px for choices, 150x150px for selected)
- **Background**: Transparent or white
- **Style**: Simple, clean vehicle silhouettes or icons
- **Colors**: Preferably monochrome or simple colors that work well with the blue accent color

## Usage:
These images are used in the vehicle creation form where users can select a vehicle icon to represent their vehicle type. The icon grid changes dynamically based on the vehicle type selected:

- **Car - Average**: Shows 5 car-related icons in a 4-column grid
- **Heavy Goods Vehicle (Truck)-Average**: Shows 7 truck-related icons in a 4-column grid (2 rows)
- **Motorbike - Average**: Shows 2 motorbike-related icons in a 4-column grid
- **Van - Average**: Shows 3 van-related icons in a 4-column grid

The images are displayed in a grid layout with a larger preview (150x150px) on the left and smaller choices (100x100px) on the right.

## Dynamic Loading:
The system automatically loads different icon sets based on the vehicle type selected:
- Car icons are loaded when "Car - Average" is selected
- Truck icons are loaded when "Heavy Goods Vehicle (Truck)-Average" is selected
- Motorbike icons are loaded when "Motorbike - Average" is selected
- Van icons are loaded when "Van - Average" is selected

## Fallback:
If images are not available, the system will show broken image placeholders. Make sure to add all required images to this directory.
