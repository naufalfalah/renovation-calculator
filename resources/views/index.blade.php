@php
    use App\Enums\WorkPackageNameEnum;
    use App\Enums\WorkTypeEnum;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Renovation Calculator</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    <header>
        <h1>Renovation Cost Estimator</h1>
    </header>

    <main>
        <div class="calculator-container">
            <form action="{{ route('form.store') }}" method="POST" id="renovationForm">
                @csrf
                <div class="form-step step active" data-step="1" id="step1">
                    <h2>Step 1: Property Details</h2>

                    <div class="form-group">
                        <p><strong>Property Type</strong></p>
                        @foreach ($propertyTypes as $type)
                            <label><input type="radio" name="property_type" value="{{ $type }}" />
                                {{ $type->label() }}</label>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <p><strong>Property Status</strong></p>
                        @foreach ($propertyStatuses as $status)
                            <label><input type="radio" name="property_status" value="{{ $status }}" />
                                {{ $status->label() }}</label>
                        @endforeach
                    </div>

                    <input type="hidden" name="base_unit" value="{{ $baseUnit }}">
                    <div class="form-group">
                        <label for="size"><strong>Property Size (sqft)</strong></label>
                        <input type="number" name="size" id="size" placeholder="Enter size in sqft" />
                    </div>

                    @foreach ($roomsWithQuanity as $room)
                        <div class="form-group">
                            <label for="number_of_room_{{ $room->id }}"><strong>Number of
                                    {{ $room->name }}s</strong></label>
                            <select name="number_of_rooms[{{ $room->id }}]" id="number_of_room_{{ $room->id }}"
                                data-name="{{ $room->name }}">
                                <option value="">Select</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5+">5+</option>
                            </select>
                        </div>
                    @endforeach

                    <div>
                        <button class="next-btn" id="nextBtn1">Next</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="2">
                    <h2>Step 2: Rooms Selection</h2>
                    <p>Select the rooms you want to renovate:</p>
                    @foreach ($rooms as $room)
                        <label>
                            <input
                                type="checkbox"
                                name="rooms[]"
                                value="{{ $room->id }}"
                                data-id="{{ $room->id }}"
                            />
                            {{ $room->name }}
                        </label><br />
                    @endforeach

                    <div class="error-container"></div>

                    <div>
                        <button class="prev-btn">Previous</button>
                        <button class="next-btn" id="nextBtn2">Next</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="3">
                    <h2>Step 3: {{ $living->name }} Room Works</h2>
                    <p>If you selected Living/Dining, fill in the works below:</p>

                    @foreach ($living->works as $work)
                        <div class="work-section">
                            <h3>{{ WorkTypeEnum::labelFromValue($work->type) }}</h3>
                            @foreach ($work->packages as $package)
                                <label>
                                    <input
                                    type="radio"
                                    name="main[living][{{ $work->id }}]"
                                    value="{{ $package->id }}"
                                />
                                {{ WorkPackageNameEnum::labelFromValue($package->name) }}
                                (${{ $package->lower_bound_budget }}-${{ $package->upper_bound_budget }}):
                                {{ $package->description ?? '' }}
                            </label><br />
                            @endforeach
                        </div>
                    @endforeach

                    <div class="error-container"></div>

                    <div>
                        <button class="prev-btn">Previous</button>
                        <button class="next-btn">Next</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="4">
                    <h2>Step 4: {{ $kitchen->name }} Works</h2>
                    <p>If you selected Kitchen, fill in the works below:</p>

                    @foreach ($kitchen->works as $work)
                        <div class="work-section">
                            <h3>{{ WorkTypeEnum::labelFromValue($work->type) }}</h3>
                            @foreach ($work->packages as $package)
                                <label>
                                    <input
                                    type="radio"
                                    name="main[kitchen][{{ $work->id }}]"
                                    value="{{ $package->id }}"
                                />
                                {{ WorkPackageNameEnum::labelFromValue($package->name) }}
                                (${{ $package->lower_bound_budget }}-${{ $package->upper_bound_budget }}):
                                {{ $package->description ?? '' }}
                            </label><br />
                            @endforeach
                        </div>
                    @endforeach

                    <div class="error-container"></div>

                    <div>
                        <button class="prev-btn">Previous</button>
                        <button class="next-btn">Next</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="5">
                    <h2>Step 5: {{ $bedroom->name }}  Works</h2>
                    <p>If you selected Bedrooms, fill in the works below:</p>

                    @foreach ($bedroom->works as $work)
                        <div class="work-section">
                            <h3>{{ WorkTypeEnum::labelFromValue($work->type) }}</h3>
                            @foreach ($work->packages as $package)
                                <label>
                                    <input
                                    type="radio"
                                    name="main[bedroom][{{ $work->id }}]"
                                    value="{{ $package->id }}"
                                />
                                {{ WorkPackageNameEnum::labelFromValue($package->name) }}
                                (${{ $package->lower_bound_budget }}-${{ $package->upper_bound_budget }}):
                                {{ $package->description ?? '' }}
                            </label><br />
                            @endforeach
                        </div>
                    @endforeach

                    <div class="error-container"></div>

                    <div>
                        <button class="prev-btn">Previous</button>
                        <button class="next-btn">Next</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="6">
                    <h2>Step 6: {{ $bathroom->name }}  Works</h2>
                    <p>If you selected Bathrooms, fill in the works below:</p>

                    @foreach ($bathroom->works as $work)
                        <div class="work-section">
                            <h3>{{ WorkTypeEnum::labelFromValue($work->type) }}</h3>
                            @foreach ($work->packages as $package)
                                <label>
                                    <input
                                    type="radio"
                                    name="main[bathroom][{{ $work->id }}]"
                                    value="{{ $package->id }}"
                                />
                                {{ WorkPackageNameEnum::labelFromValue($package->name) }}
                                (${{ $package->lower_bound_budget }}-${{ $package->upper_bound_budget }}):
                                {{ $package->description ?? '' }}
                            </label><br />
                            @endforeach
                        </div>
                    @endforeach

                    <div class="error-container"></div>

                    <div>
                        <button class="prev-btn">Previous</button>
                        <button class="next-btn">Next</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="7">
                    <h2>Step 7: Additional Works</h2>

                    @foreach ($otherWorks as $work)
                        <div class="work-section">
                            <h3>{{ WorkTypeEnum::labelFromValue($work->type) }}</h3>
                            @foreach ($work->packages as $package)
                                <label>
                                    <input
                                    type="radio"
                                    name="additional[{{ $work->id }}]"
                                    value="{{ $package->id }}"
                                />
                                {{ WorkPackageNameEnum::labelFromValue($package->name) }}
                                (${{ $package->lower_bound_budget }}-${{ $package->upper_bound_budget }}):
                                {{ $package->description ?? '' }}
                            </label><br />
                            @endforeach
                        </div>
                    @endforeach

                    <div class="error-container"></div>

                    <div>
                        <button class="prev-btn">Previous</button>
                        <button class="next-btn">Next</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="8">
                    <h2>Step 8: Contact Information</h2>

                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="full_name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="contactNumber">Contact Number</label>
                        <div class="phone-input">
                            <select name="country_code" id="countryCode">
                                <option value="+65">+65 (SG)</option>
                            </select>
                            <input type="tel" id="contactNumber" name="contact_number" maxlength="8" required>
                        </div>
                        <div id="contactNumberGroupError"></div>
                    </div>

                    <div class="form-group checkbox-group">
                        <label><input type="checkbox" name="shortlist_designers"> Get a shortlist of Interior Designers</label>
                    </div>

                    <div class="form-group checkbox-group">
                        <label><input type="checkbox" name="accept_terms" required> I accept the terms of service</label>
                    </div>

                    <div class="error-container"></div>

                    <div class="form-actions">
                        <button class="submit-btn" type="submit">Generate Report</button>
                    </div>
                </div>

                <div class="form-step step hidden" data-step="9">
                    <h2>Step 9: Results</h2>

                    <p><strong>Your Estimated Budget Range:</strong></p>
                    <p id="budgetRangeDisplay"></p>

                    <p>A confirmation email with the PDF report has been sent to <strong
                            id="userEmailDisplay"></strong>.</p>

                    <div id="nextSteps">
                        <p>Our team will reach out with a shortlist of Interior Designers shortly.</p>
                    </div>

                    <button class="restart-btn" type="button" id="restartBtn">Start Over</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Renovation Calculator</p>
    </footer>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
