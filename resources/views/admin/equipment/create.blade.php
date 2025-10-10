@extends('admin.layout')

@section('title', 'Add Equipment')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Add New Equipment</h1>
            <p class="text-muted mb-0">Add new equipment to your monitoring system</p>
        </div>
        <div>
            <a href="{{ route('admin.equipment.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Equipment
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <form action="{{ route('admin.equipment.store') }}" method="POST">
        @csrf

        <div class="text-center">
            <div class="header">Add Equipment</div>
            <p>Add equipment to your 2024 reporting year. This includes backup generators, chillers, and other machinery used by your organization. <a href="">Learn more</a></p>
        </div>

        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">What is the name or ID of this equipment?</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <h6 style="font-size: .75rem;">Give this equipment a name or ID number to make it easier to identify it later. Field required.</h6>
            </div>
        </div>

        <div class="row">
            <div class="mb-3">
                <label class="form-label">Please select the following that apply. You can always update these later.</label>
                <div class="checkbox">
                    <div class="">
                        <label class="checkbox-label">
                            <input type="checkbox" name="equipment[]" value="equipment_a" id="equipment_a" {{ in_array('equipment_a', old('equipment', [])) ? 'checked' : '' }}>
                            <div class="text-content">
                                <span>This equipment consumes fuel</span>
                                <h6>Select this if your equipment runs on fuel (gasoline, diesel, etc). To avoid double counting, if you’ve already accounted for natural gas usage at the facility level, there’s no need to add natural gas boilers as equipment here.</h6>
                            </div>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="equipment[]" value="equipment_b" id="equipment_b" {{ in_array('equipment_b', old('equipment', [])) ? 'checked' : '' }}>
                            <div class="text-content">
                                <span>This equipment uses refrigerants</span>
                                <h6>Select this if your company purchases refrigerants used by equipment owned by your organization including mobile air conditioning, chillers, retail food refrigeration, refrigerated transport, etc.</h6>
                            </div>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="equipment[]" value="equipment_c" id="equipment_c" {{ in_array('equipment_c', old('equipment', [])) ? 'checked' : '' }}>
                            <div class="text-content">
                                <span>This equipment uses industrial gases</span>
                                <h6>Select this if your company purchases industrial gases, such as carbon dioxide, methane, nitrous oxide, sulfur hexafluoride, and nitrogen trifluoride, used in manufacturing, testing, or laboratory applications.</h6>
                            </div>
                        </label>
                    </div>
                </div>
                @error('equipment')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row justify-content-center">
            <p style="margin-bottom: 0; text-align: center; border: 1px solid #ccc; border-radius: 6px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 1rem 1rem; width: 80%;">Looking for the option to track electricity by equipment? You’ll track your electricity usage in the utilities section when you add a location.</p>
        </div>

        <div class="row">
            <div class="mb-3">
                <label for="type" class="form-label">What kind of equipment is this?</label>
                <select class="form-select @error('type') is-invalid @enderror"
                        id="type" name="type" required>
                    <option value="">Select equipment type</option>
                    <option value="boiler" {{ old('type') == 'boiler' ? 'selected' : '' }}>Boiler</option>
                    <option value="burner" {{ old('type') == 'burner' ? 'selected' : '' }}>Burner</option>
                    <option value="dryer" {{ old('type') == 'dryer' ? 'selected' : '' }}>Dryer</option>
                    <option value="flare" {{ old('type') == 'flare' ? 'selected' : '' }}>Flare</option>
                    <option value="furnace" {{ old('type') == 'furnace' ? 'selected' : '' }}>Furnace</option>
                    <option value="generator" {{ old('type') == 'generator' ? 'selected' : '' }}>Generator</option>
                    <option value="heater" {{ old('type') == 'heater' ? 'selected' : '' }}>Heater</option>
                    <option value="incinerator" {{ old('type') == 'incinerator' ? 'selected' : '' }}>Incinerator</option>
                    <option value="internal_combustion_engine" {{ old('type') == 'internal_combustion_engine' ? 'selected' : '' }}>Internal Combustion Engine</option>
                    <option value="kiln" {{ old('type') == 'kiln' ? 'selected' : '' }}>Kiln</option>
                    <option value="open_burning" {{ old('type') == 'open_burning' ? 'selected' : '' }}>Open Burning</option>
                    <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                    <option value="oven" {{ old('type') == 'oven' ? 'selected' : '' }}>Oven</option>
                    <option value="thermal_oxidizer" {{ old('type') == 'thermal_oxidizer' ? 'selected' : '' }}>Thermal Oxidizer</option>
                    <option value="turbine" {{ old('type') == 'turbine' ? 'selected' : '' }}>Turbine</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Equipment Icon Selection -->
        <div id="equipment-icon-section" class="mb-3" style="display: none;">
            <label class="form-label">Equipment Icon</label>
            <div class="equipment-icon-container">
                <div class="equipment-icon-selected">
                    <div class="selected-icon" id="selectedEquipmentIcon">
                        <img src="/images/admin/equipment/portable.svg" />
                    </div>
                </div>
                <div class="equipment-icon-choices">
                    <div class="icon-grid" id="equipmentIconGrid">
                        <!-- Icons will be dynamically loaded based on equipment type -->
                    </div>
                </div>
            </div>
            <input type="hidden" name="equipment_icon" id="equipmentIconInput" value="portable.svg">
        </div>

        <div class="row">
            <div class="mb-3">
                <label for="location_id" class="form-label">Where is this equipment located?</label>
                <select class="form-select @error('location_id') is-invalid @enderror"
                        id="location_id" name="location_id">
                    <option value="">Select a location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.equipment.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Equipment
            </button>
        </div>
    </form>
</div>

<script>
function showEquipmentIcon() {
    const equipmentIconSection = document.getElementById('equipment-icon-section');
    const equipmentA = document.getElementById('equipment_a');
    const equipmentB = document.getElementById('equipment_b');
    const equipmentC = document.getElementById('equipment_c');

    if (equipmentA.checked || equipmentB.checked || equipmentC.checked) {
        equipmentIconSection.style.display = 'block';
        updateEquipmentIconGrid();
    } else {
        equipmentIconSection.style.display = 'none';
    }
}

function updateEquipmentIconGrid() {
    const equipmentA = document.getElementById('equipment_a');
    const equipmentB = document.getElementById('equipment_b');
    const equipmentC = document.getElementById('equipment_c');
    const iconGrid = document.getElementById('equipmentIconGrid');

    let iconsHTML = '';
    let defaultIcon = '';
    let defaultIconFile = '';

    // Fuel equipment icons
    const fuelIcons = `
        <div class="icon-choice" data-icon="portable.svg" data-label="Portable">
            <img src="/images/admin/equipment/portable.svg" />
        </div>
        <div class="icon-choice" data-icon="s-generator.svg" data-label="Generator Small">
            <img src="/images/admin/equipment/s-generator.svg" />
        </div>
        <div class="icon-choice" data-icon="generator-trailer.svg" data-label="Generator Trailer">
            <img src="/images/admin/equipment/generator-trailer.svg" />
        </div>
    `;

    // Refrigerant equipment icons
    const refrigerantIcons = `
        <div class="icon-choice" data-icon="refrigerator-1.svg" data-label="Refrigerant 1">
            <img src="/images/admin/equipment/refrigerator-1.svg" />
        </div>
        <div class="icon-choice" data-icon="refrigerator-2.svg" data-label="Refrigerator 2">
            <img src="/images/admin/equipment/refrigerator-2.svg" />
        </div>
        <div class="icon-choice" data-icon="refrigerator-3.svg" data-label="Refridgerator 3">
            <img src="/images/admin/equipment/refrigerator-3.svg" />
        </div>
        <div class="icon-choice" data-icon="refrigerator-4.svg" data-label="Refrigerator 4">
            <img src="/images/admin/equipment/refrigerator-4.svg" />
        </div>
        <div class="icon-choice" data-icon="freezer-1.svg" data-label="Freezer 1">
            <img src="/images/admin/equipment/freezer-1.svg" />
        </div>
        <div class="icon-choice" data-icon="freezer-3.svg" data-label="Freezer 3">
            <img src="/images/admin/equipment/freezer-3.svg" />
        </div>
        <div class="icon-choice" data-icon="aircon.svg" data-label="AC">
            <img src="/images/admin/equipment/aircon.svg" />
        </div>
    `;

    // Industrial gas equipment icons
    const gasIcons = `
        <div class="icon-choice" data-icon="gas1.svg" data-label="Gas 1">
            <img src="/images/admin/equipment/gas1.svg" />
        </div>
        <div class="icon-choice" data-icon="gas2.svg" data-label="Gas 2">
            <img src="/images/admin/equipment/gas2.svg" />
        </div>
        <div class="icon-choice" data-icon="gas3.svg" data-label="Gas 3">
            <img src="/images/admin/equipment/gas3.svg" />
        </div>
        <div class="icon-choice" data-icon="gas4.svg" data-label="Gas 4">
            <img src="/images/admin/equipment/gas4.svg" />
        </div>
        <div class="icon-choice" data-icon="gas5.svg" data-label="Gas 5">
            <img src="/images/admin/equipment/gas5.svg" />
        </div>
    `;

    // Combine icons based on selected checkboxes
    if (equipmentA.checked) {
        iconsHTML += fuelIcons;
        if (!defaultIcon) {
            defaultIcon = '<img src="/images/admin/equipment/portable.svg"/>';
            defaultIconFile = 'portable.svg';
        }
    }

    if (equipmentB.checked) {
        iconsHTML += refrigerantIcons;
        if (!defaultIcon) {
            defaultIcon = '<img src="/images/admin/equipment/refrigerator-1.svg" />';
            defaultIconFile = 'refrigerator-1.svg';
        }
    }

    if (equipmentC.checked) {
        iconsHTML += gasIcons;
        if (!defaultIcon) {
            defaultIcon = '<img src="/images/admin/equipment/gas1.svg"/>';
            defaultIconFile = 'gas1.svg';
        }
    }

    // Set the combined icons
    iconGrid.innerHTML = iconsHTML;

    // Set the first icon as active
    if (iconGrid.firstElementChild) {
        iconGrid.firstElementChild.classList.add('active');
    }

    // Set default selected icon
    document.getElementById('selectedEquipmentIcon').innerHTML = defaultIcon;
    document.getElementById('equipmentIconInput').value = defaultIconFile;

    attachEquipmentIconListeners();
}

function attachEquipmentIconListeners() {
    const iconChoices = document.querySelectorAll('#equipmentIconGrid .icon-choice');
    const selectedIcon = document.getElementById('selectedEquipmentIcon');
    const equipmentIconInput = document.getElementById('equipmentIconInput');

    iconChoices.forEach(choice => {
        choice.addEventListener('click', function() {
            iconChoices.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            const iconFilename = this.dataset.icon;
            selectedIcon.innerHTML = `<img src="/images/admin/equipment/${iconFilename}" alt="Selected Equipment" />`;
            equipmentIconInput.value = iconFilename;
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to checkboxes
    const equipmentCheckboxes = document.querySelectorAll('input[name="equipment[]"]');
    equipmentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            showEquipmentIcon();
        });
    });

    // Initialize on page load
    showEquipmentIcon();
});
</script>
@endsection
