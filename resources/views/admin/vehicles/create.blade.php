@extends('admin.layout')

@section('title', 'Add Vehicle')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Add New Vehicle</h1>
            <p class="text-muted mb-0">Add a new vehicle to your fleet</p>
        </div>
        <div>
            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Vehicles
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Validation Errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.vehicles.store') }}" method="POST">
        @csrf

        <div class="text-center">
            <div class="header">Add Vehicle Data</div>
            <p>Add an Internal Combustion Engine Vehicle (ICEV) to your 2024 reporting year. This includes cars, trucks, or other motorized vehicles used by your organization which do not run on electricity. To add data for electric vehicles, add their primary charging station as a "Location" <a href="">here</a>.</p>
        </div>

        <div class="row">
            <div class="mb-3">
                <label for="make" class="form-label">What is the name or ID of this vehicle?</label>
                <input type="text" class="form-control @error('make') is-invalid @enderror"
                        id="make" name="make" value="{{ old('make') }}" required>
                @error('make')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <h6 style="font-size: .75rem">Give this vehicle a name or ID number to make it easier to identify it later.</h6>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Auto-complete this form with VIN(Optional)</label>
                <input type="text" class="form-control @error('model') is-invalid @enderror"
                        id="model" name="model" value="{{ old('model') }}">
                @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <h6 style="font-size: .75rem">We will be able to complete information like Make, Model, Year, and Vehicle Type automatically using the VIN number.</h6>
            </div>

            <div class="" style="background: #dee2e6; padding: 1rem; border-radius: 15px;">
                <div class="" style="border-bottom: 1px solid gray; font-weight: 700; cursor: pointer; display: flex; justify-content: space-between; align-items: center;" onclick="toggleMakeModel()">
                    <span>Make / Model (Optional)</span>
                    <i id="makeModelIcon" class="fas fa-chevron-up" style="transition: transform 0.3s ease;"></i>
                </div>
                <div id="makeModelContent" style="display: block; margin-top: 1rem;">
                <div class="mb-3">
                    <label for="year" class="form-label">Year (Optional)</label>
                    <select class="form-select @error('year') is-invalid @enderror" id="year" name="year">
                        <option value="">Select Year</option>
                        @for($year = date('Y') + 1; $year >= 1990; $year--)
                            <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="make_optional" class="form-label">Make (Optional)</label>
                    <select class="form-select" id="make_optional" name="make_optional">
                        <option value="">Select Make</option>
                        <option value="Toyota" {{ old('make') == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                        <option value="Honda" {{ old('make') == 'Honda' ? 'selected' : '' }}>Honda</option>
                        <option value="Ford" {{ old('make') == 'Ford' ? 'selected' : '' }}>Ford</option>
                        <option value="Chevrolet" {{ old('make') == 'Chevrolet' ? 'selected' : '' }}>Chevrolet</option>
                        <option value="Nissan" {{ old('make') == 'Nissan' ? 'selected' : '' }}>Nissan</option>
                        <option value="BMW" {{ old('make') == 'BMW' ? 'selected' : '' }}>BMW</option>
                        <option value="Mercedes-Benz" {{ old('make') == 'Mercedes-Benz' ? 'selected' : '' }}>Mercedes-Benz</option>
                        <option value="Audi" {{ old('make') == 'Audi' ? 'selected' : '' }}>Audi</option>
                        <option value="Volkswagen" {{ old('make') == 'Volkswagen' ? 'selected' : '' }}>Volkswagen</option>
                        <option value="Hyundai" {{ old('make') == 'Hyundai' ? 'selected' : '' }}>Hyundai</option>
                        <option value="Kia" {{ old('make') == 'Kia' ? 'selected' : '' }}>Kia</option>
                        <option value="Mazda" {{ old('make') == 'Mazda' ? 'selected' : '' }}>Mazda</option>
                        <option value="Subaru" {{ old('make') == 'Subaru' ? 'selected' : '' }}>Subaru</option>
                        <option value="Lexus" {{ old('make') == 'Lexus' ? 'selected' : '' }}>Lexus</option>
                        <option value="Acura" {{ old('make') == 'Acura' ? 'selected' : '' }}>Acura</option>
                        <option value="Infiniti" {{ old('make') == 'Infiniti' ? 'selected' : '' }}>Infiniti</option>
                        <option value="Volvo" {{ old('make') == 'Volvo' ? 'selected' : '' }}>Volvo</option>
                        <option value="Jaguar" {{ old('make') == 'Jaguar' ? 'selected' : '' }}>Jaguar</option>
                        <option value="Land Rover" {{ old('make') == 'Land Rover' ? 'selected' : '' }}>Land Rover</option>
                        <option value="Porsche" {{ old('make') == 'Porsche' ? 'selected' : '' }}>Porsche</option>
                        <option value="Tesla" {{ old('make') == 'Tesla' ? 'selected' : '' }}>Tesla</option>
                        <option value="Other" {{ old('make') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="model_optional" class="form-label">Model (Optional)</label>
                    <select class="form-select" id="model_optional" name="model_optional">
                        <option value="">Select Model</option>
                        <!-- Toyota Models -->
                        <optgroup label="Toyota">
                            <option value="Camry" {{ old('model') == 'Camry' ? 'selected' : '' }}>Camry</option>
                            <option value="Corolla" {{ old('model') == 'Corolla' ? 'selected' : '' }}>Corolla</option>
                            <option value="RAV4" {{ old('model') == 'RAV4' ? 'selected' : '' }}>RAV4</option>
                            <option value="Highlander" {{ old('model') == 'Highlander' ? 'selected' : '' }}>Highlander</option>
                            <option value="Prius" {{ old('model') == 'Prius' ? 'selected' : '' }}>Prius</option>
                            <option value="Tacoma" {{ old('model') == 'Tacoma' ? 'selected' : '' }}>Tacoma</option>
                            <option value="Tundra" {{ old('model') == 'Tundra' ? 'selected' : '' }}>Tundra</option>
                        </optgroup>
                        <!-- Honda Models -->
                        <optgroup label="Honda">
                            <option value="Civic" {{ old('model') == 'Civic' ? 'selected' : '' }}>Civic</option>
                            <option value="Accord" {{ old('model') == 'Accord' ? 'selected' : '' }}>Accord</option>
                            <option value="CR-V" {{ old('model') == 'CR-V' ? 'selected' : '' }}>CR-V</option>
                            <option value="Pilot" {{ old('model') == 'Pilot' ? 'selected' : '' }}>Pilot</option>
                            <option value="Odyssey" {{ old('model') == 'Odyssey' ? 'selected' : '' }}>Odyssey</option>
                            <option value="HR-V" {{ old('model') == 'HR-V' ? 'selected' : '' }}>HR-V</option>
                        </optgroup>
                        <!-- Ford Models -->
                        <optgroup label="Ford">
                            <option value="F-150" {{ old('model') == 'F-150' ? 'selected' : '' }}>F-150</option>
                            <option value="Escape" {{ old('model') == 'Escape' ? 'selected' : '' }}>Escape</option>
                            <option value="Explorer" {{ old('model') == 'Explorer' ? 'selected' : '' }}>Explorer</option>
                            <option value="Focus" {{ old('model') == 'Focus' ? 'selected' : '' }}>Focus</option>
                            <option value="Fusion" {{ old('model') == 'Fusion' ? 'selected' : '' }}>Fusion</option>
                            <option value="Mustang" {{ old('model') == 'Mustang' ? 'selected' : '' }}>Mustang</option>
                        </optgroup>
                        <!-- BMW Models -->
                        <optgroup label="BMW">
                            <option value="3 Series" {{ old('model') == '3 Series' ? 'selected' : '' }}>3 Series</option>
                            <option value="5 Series" {{ old('model') == '5 Series' ? 'selected' : '' }}>5 Series</option>
                            <option value="X3" {{ old('model') == 'X3' ? 'selected' : '' }}>X3</option>
                            <option value="X5" {{ old('model') == 'X5' ? 'selected' : '' }}>X5</option>
                            <option value="X1" {{ old('model') == 'X1' ? 'selected' : '' }}>X1</option>
                        </optgroup>
                        <!-- Tesla Models -->
                        <optgroup label="Tesla">
                            <option value="Model S" {{ old('model') == 'Model S' ? 'selected' : '' }}>Model S</option>
                            <option value="Model 3" {{ old('model') == 'Model 3' ? 'selected' : '' }}>Model 3</option>
                            <option value="Model X" {{ old('model') == 'Model X' ? 'selected' : '' }}>Model X</option>
                            <option value="Model Y" {{ old('model') == 'Model Y' ? 'selected' : '' }}>Model Y</option>
                        </optgroup>
                        <option value="Other" {{ old('model') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">What usage data do you have for this vehicle?</label>
            <div class="mt-2">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="usage_data_type" id="usage_distance" value="distance" {{ old('usage_data_type') == 'distance' ? 'checked' : '' }} onchange="showVehicleType()">
                    <label class="form-check-label" for="usage_distance">
                        Vehicle Usage (Distance)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="usage_data_type" id="usage_fuel" value="fuel" {{ old('usage_data_type') == 'fuel' ? 'checked' : '' }} onchange="showVehicleType()">
                    <label class="form-check-label" for="usage_fuel">
                        Vehicle Usage (Fuel)
                    </label>
                </div>
            </div>
            @error('usage_data_type')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div id="vehicle-type-section" class="mb-3" style="display: none;">
            <label class="form-label">What kind of vehicle is this?</label>
            <div class="mt-2">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="car" value="car" {{ old('vehicle_type') == 'car' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="car">
                        Car - Average
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="truck" value="truck" {{ old('vehicle_type') == 'truck' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="truck">
                        Heavy Goods Vehicle (Truck)-Average
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="motorbike" value="motorbike" {{ old('vehicle_type') == 'motorbike' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="motorbike">
                        Motorbike - Average
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="van" value="van" {{ old('vehicle_type') == 'van' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="van">
                        Van- Average
                    </label>
                </div>
            </div>
            @error('vehicle_type')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div id="vehicle-icon-section" class="mb-3" style="display: none;">
            <label class="form-label">Vehicle Icon *</label>
            <div class="vehicle-icon-container">
                <div class="vehicle-icon-selected">
                    <div class="selected-icon" id="selectedIcon">
                        <img src="/images/admin/vehicles/sedan.svg" alt="Selected Vehicle" />
                    </div>
                </div>
                <div class="vehicle-icon-choices">
                    <div class="icon-grid">
                        <!-- Icons will be dynamically loaded based on vehicle type -->
                    </div>
                </div>
            </div>
            <input type="hidden" name="vehicle_icon" id="vehicleIconInput" value="sedan.svg">
        </div>

        <div class="mb-3">
            <label for="location_id" class="form-label">Where is this vehicle located?(Optional)</label>
            <select class="form-select @error('location_id') is-invalid @enderror" id="location_id" name="location_id">
                <option value="">Select a location</option>
                @if(isset($locations))
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('location_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Vehicle
            </button>
        </div>
    </form>
</div>

<script>
function toggleMakeModel() {
    const content = document.getElementById('makeModelContent');
    const icon = document.getElementById('makeModelIcon');

    if (content.style.display === 'none') {
        // Show content
        content.style.display = 'block';
        icon.className = 'fas fa-chevron-up';
        icon.style.transform = 'rotate(0deg)';
    } else {
        // Hide content
        content.style.display = 'none';
        icon.className = 'fas fa-chevron-down';
        icon.style.transform = 'rotate(0deg)';
    }
}

function showVehicleType() {
    const vehicleTypeSection = document.getElementById('vehicle-type-section');
    const usageDistance = document.getElementById('usage_distance');
    const usageFuel = document.getElementById('usage_fuel');

    if (usageDistance.checked || usageFuel.checked) {
        vehicleTypeSection.style.display = 'block';
    } else {
        vehicleTypeSection.style.display = 'none';
    }
}

function showVehicleIcon() {
    const vehicleIconSection = document.getElementById('vehicle-icon-section');
    const carRadio = document.getElementById('car');
    const truckRadio = document.getElementById('truck');
    const motorbikeRadio = document.getElementById('motorbike');
    const vanRadio = document.getElementById('van');

    if (carRadio.checked || truckRadio.checked || motorbikeRadio.checked || vanRadio.checked) {
        vehicleIconSection.style.display = 'block';

        // Update icon grid based on vehicle type
        updateIconGrid();
    } else {
        vehicleIconSection.style.display = 'none';
    }
}

function updateIconGrid() {
    const carRadio = document.getElementById('car');
    const truckRadio = document.getElementById('truck');
    const motorbikeRadio = document.getElementById('motorbike');
    const vanRadio = document.getElementById('van');
    const iconGrid = document.querySelector('.icon-grid');

    if (carRadio.checked) {
        // Show car icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="sedan.svg" data-label="Sedan">
                <img src="/images/admin/vehicles/sedan.svg"/>
            </div>
            <div class="icon-choice" data-icon="hatchback.svg" data-label="Hatchback">
                <img src="/images/admin/vehicles/hatchback.svg"/>
            </div>
            <div class="icon-choice" data-icon="suv.svg" data-label="SUV">
                <img src="/images/admin/vehicles/suv.svg"/>
            </div>
            <div class="icon-choice" data-icon="convertible.svg" data-label="Convertible">
                <img src="/images/admin/vehicles/convertible.svg"/>
            </div>
            <div class="icon-choice" data-icon="truck.svg" data-label="Truck">
                <img src="/images/admin/vehicles/truck.svg"/>
            </div>
        `;

        // Update selected icon to first car icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/sedan.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'sedan.svg';

    } else if (truckRadio.checked) {
        // Show truck icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="heavy-duty-truck.svg" data-label="Heavy Duty Truck">
                <img src="/images/admin/vehicles/heavy-duty-truck.svg" />
            </div>
            <div class="icon-choice" data-icon="lorry.svg" data-label="Lorry">
                <img src="/images/admin/vehicles/lorry.svg" />
            </div>
            <div class="icon-choice" data-icon="semi-lorry.svg" data-label="Semi Lorry">
                <img src="/images/admin/vehicles/semi-lorry.svg" />
            </div>
            <div class="icon-choice" data-icon="lift-truck.svg" data-label="Lift Truck">
                <img src="/images/admin/vehicles/lift-truck.svg" />
            </div>
            <div class="icon-choice" data-icon="fork-lift.svg" data-label="Fork Lift">
                <img src="/images/admin/vehicles/fork-lift.svg" />
            </div>
            <div class="icon-choice" data-icon="van.svg" data-label="Van">
                <img src="/images/admin/vehicles/van.svg" />
            </div>
            <div class="icon-choice" data-icon="metro-bus.svg" data-label="Metro Bus">
                <img src="/images/admin/vehicles/metro-bus.svg" />
            </div>
        `;

        // Update selected icon to first truck icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/heavy-duty-truck.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'heavy-duty-truck.svg';

    } else if (motorbikeRadio.checked) {
        // Show motorbike icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="motorbike.svg" data-label="Motorbike">
                <img src="/images/admin/vehicles/motorbike.svg" />
            </div>
            <div class="icon-choice" data-icon="bike.svg" data-label="Bike">
                <img src="/images/admin/vehicles/bike.svg" />
            </div>
        `;

        // Update selected icon to first motorbike icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/motorbike.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'motorbike.svg';

    } else if (vanRadio.checked) {
        // Show van icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="van.svg" data-label="Van">
                <img src="/images/admin/vehicles/van.svg" />
            </div>
            <div class="icon-choice" data-icon="passenger-car-truck.svg" data-label="Passenger Car Truck">
                <img src="/images/admin/vehicles/passenger-car-truck.svg" />
            </div>
            <div class="icon-choice" data-icon="car-van.svg" data-label="Car Van">
                <img src="/images/admin/vehicles/car-van.svg" />
            </div>
        `;

        // Update selected icon to first van icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/van.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'van.svg';
    }

    // Reattach event listeners to new icons
    attachIconListeners();
}

function attachIconListeners() {
    const iconChoices = document.querySelectorAll('.icon-choice');
    const selectedIcon = document.getElementById('selectedIcon');
    const vehicleIconInput = document.getElementById('vehicleIconInput');

    iconChoices.forEach(choice => {
        choice.addEventListener('click', function() {
            // Remove active class from all choices
            iconChoices.forEach(c => c.classList.remove('active'));

            // Add active class to clicked choice
            this.classList.add('active');

            // Update selected icon display
            const iconFilename = this.dataset.icon;
            selectedIcon.innerHTML = `<img src="/images/admin/vehicles/${iconFilename}" alt="Selected Vehicle" />`;

            // Update hidden input
            vehicleIconInput.value = iconFilename;
        });
    });
}

// Initialize sections on page load
document.addEventListener('DOMContentLoaded', function() {
    showVehicleType();
    showVehicleIcon();

    // If optional Make/Model are selected and primary fields are empty, copy over on submit
    const form = document.querySelector('form[action*="vehicles"]');
    form.addEventListener('submit', function() {
        const makePrimary = document.getElementById('make');
        const makeOptional = document.getElementById('make_optional');
        if (makePrimary && makeOptional && !makePrimary.value && makeOptional.value) {
            makePrimary.value = makeOptional.value;
        }

        const modelPrimary = document.getElementById('model');
        const modelOptional = document.getElementById('model_optional');
        if (modelPrimary && modelOptional && !modelPrimary.value && modelOptional.value) {
            modelPrimary.value = modelOptional.value;
        }
    });

    // Handle icon selection
    const iconChoices = document.querySelectorAll('.icon-choice');
    const selectedIcon = document.getElementById('selectedIcon');
    const vehicleIconInput = document.getElementById('vehicleIconInput');

    iconChoices.forEach(choice => {
        choice.addEventListener('click', function() {
            // Remove active class from all choices
            iconChoices.forEach(c => c.classList.remove('active'));

            // Add active class to clicked choice
            this.classList.add('active');

            // Update selected icon display
            const iconFilename = this.dataset.icon;
            selectedIcon.innerHTML = `<img src="/images/admin/vehicles/${iconFilename}" alt="Selected Vehicle" />`;

            // Update hidden input
            vehicleIconInput.value = iconFilename;
        });
    });
});
</script>

@endsection
