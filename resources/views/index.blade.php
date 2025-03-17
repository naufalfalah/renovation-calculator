<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Renovation Calculator</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
</head>
<body>
  <header>
    <h1>Renovation Cost Estimator</h1>
  </header>

  <main>
    <div class="calculator-container">
      <div class="form-step step active" data-step="1" id="step1">
        <h2>Step 1: Property Details</h2>

        <div class="form-group">
          <p><strong>Property Type</strong></p>
          <label><input type="radio" name="propertyType" value="HDB" /> HDB</label>
          <label><input type="radio" name="propertyType" value="Condo" /> Condo</label>
          <label><input type="radio" name="propertyType" value="Landed" /> Landed</label>
        </div>

        <div class="form-group">
          <p><strong>Property Status</strong></p>
          <label><input type="radio" name="propertyStatus" value="New" /> New</label>
          <label><input type="radio" name="propertyStatus" value="Resale" /> Resale</label>
        </div>

        <div class="form-group">
          <label for="propertySize"><strong>Property Size (sqft)</strong></label>
          <input type="number" id="propertySize" placeholder="Enter size in sqft" />
        </div>

        <div class="form-group">
          <label for="bedrooms"><strong>Number of Bedrooms</strong></label>
          <select id="bedrooms">
            <option value="">Select</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5+">5+</option>
          </select>
        </div>

        <div class="form-group">
          <label for="bathrooms"><strong>Number of Bathrooms</strong></label>
          <select id="bathrooms">
            <option value="">Select</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5+">5+</option>
          </select>
        </div>

        <div>
            <button class="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="2">
        <h2>Step 2: Rooms Selection</h2>
        <p>Select the rooms you want to renovate:</p>
        <label><input type="checkbox" name="rooms" value="Living/Dining" /> Living/Dining</label><br />
        <label><input type="checkbox" name="rooms" value="Kitchen" /> Kitchen</label><br />
        <label><input type="checkbox" name="rooms" value="Bedrooms" /> Bedrooms</label><br />
        <label><input type="checkbox" name="rooms" value="Bathrooms" /> Bathrooms</label><br />

        <div>
            <button class="prev-btn">Previous</button>
            <button class="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="3">
        <h2>Step 3: Living/Dining Room Works</h2>
        <p>If you selected Living/Dining, fill in the works below:</p>

        <h3>Hacking</h3>
        <label><input type="radio" name="living_hacking" value="Light" /> Light ($100-$200): Dismantling one fixture, excluding wall/floor hackings</label><br />
        <label><input type="radio" name="living_hacking" value="Moderate" /> Moderate ($200-$300): Dismantling several fixtures, partial wall/floor hackings</label><br />
        <label><input type="radio" name="living_hacking" value="Extensive" /> Extensive ($300-$5,500): Dismantling all fixtures, complete wall/floor hackings</label><br />

        <h3>Masonry</h3>
        <label><input type="radio" name="living_masonry" value="Light" /> Light ($100-$200): Basic construction of appliance/cabinet bases</label><br />
        <label><input type="radio" name="living_masonry" value="Moderate" /> Moderate ($200-$2,400): Regular construction, post-hacking touch up and tiling</label><br />
        <label><input type="radio" name="living_masonry" value="Extensive" /> Extensive ($2,400-$20,500): Comprehensive construction, post-hacking touch up and tiling</label><br />

        <div>
            <button class="prev-btn">Previous</button>
            <button class="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="4">
        <h2>Step 4: Kitchen Works</h2>
        <p>If you selected Kitchen, fill in the works below:</p>

        <h3>Hacking</h3>
        <label><input type="radio" name="kitchen_hacking" value="Light" /> Light ($100-$200): Dismantling one fixture</label><br />
        <label><input type="radio" name="kitchen_hacking" value="Moderate" /> Moderate ($200-$300): Several fixtures, partial hacking of walls/floors</label><br />
        <label><input type="radio" name="kitchen_hacking" value="Extensive" /> Extensive ($300-$7,800): All fixtures, complete hacking of walls/floors</label><br />

        <div>
            <button class="prev-btn">Previous</button>
            <button class="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="5">
        <h2>Step 5: Bedroom Works</h2>
        <p>If you selected Bedrooms, fill in the works below:</p>

        <h3>Hacking</h3>
        <label><input type="radio" name="bedroom_hacking" value="Light" /> Light (Price TBD)</label><br />
        <label><input type="radio" name="bedroom_hacking" value="Moderate" /> Moderate (Price TBD)</label><br />
        <label><input type="radio" name="bedroom_hacking" value="Extensive" /> Extensive ($2,100-$7,400)</label><br />

        <div>
            <button class="prev-btn">Previous</button>
            <button class="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="6">
        <h2>Step 6: Bathroom Works</h2>
        <p>If you selected Bathrooms, fill in the works below:</p>

        <h3>Hacking</h3>
        <label><input type="radio" name="bathroom_hacking" value="Light" /> Light (Price TBD)</label><br />
        <label><input type="radio" name="bathroom_hacking" value="Moderate" /> Moderate (Price TBD)</label><br />
        <label><input type="radio" name="bathroom_hacking" value="Extensive" /> Extensive (Price TBD)</label><br />

        <div>
            <button class="prev-btn">Previous</button>
            <button class="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="7">
        <h2>Step 7: Additional Works</h2>

        <!-- Electrical Works -->
        <div class="work-category">
          <h3>Electrical Works</h3>
          <label><input type="radio" name="electricalWorks" value="light"> Light ($100-$1,000): Basic electrical outlets for select rooms</label><br>
          <label><input type="radio" name="electricalWorks" value="moderate"> Moderate ($200-$1,700): Intermediate electrical outlets for most areas of the house</label><br>
          <label><input type="radio" name="electricalWorks" value="extensive"> Extensive ($1,700-$16,000): Comprehensive electrical outlets, extra lighting points and wire extensions</label>
        </div>

        <!-- Painting -->
        <div class="work-category">
          <h3>Painting</h3>
          <label><input type="radio" name="painting" value="light"> Light ($100-$200): Wall and ceiling paint for 1 room</label><br>
          <label><input type="radio" name="painting" value="moderate"> Moderate ($200-$700): Wall and ceiling paint for 2 rooms</label><br>
          <label><input type="radio" name="painting" value="extensive"> Extensive ($700-$7,800): Wall and ceiling paint for 3 or more rooms</label>
        </div>

        <!-- Glass & Aluminium -->
        <div class="work-category">
          <h3>Glass & Aluminium</h3>
          <label><input type="radio" name="glassAluminium" value="light"> Light ($100-$700): 1-2 glass fixtures, little to no aluminium works</label><br>
          <label><input type="radio" name="glassAluminium" value="moderate"> Moderate ($700-$2,900): 2 or more glass fixtures, additional aluminium works e.g. fitting new window grilles</label><br>
          <label><input type="radio" name="glassAluminium" value="extensive"> Extensive ($2,900-$30,200): 2 or more glass fixtures, major aluminium works e.g. changing window grilles and gate</label>
        </div>

        <!-- Cleaning & Polishing -->
        <div class="work-category">
          <h3>Cleaning & Polishing</h3>
          <label><input type="radio" name="cleaningPolishing" value="light"> Light ($100-$200): Cleaning of the entire house, corrugated paper for floor protection, minor haulage and debris disposal</label><br>
          <label><input type="radio" name="cleaningPolishing" value="moderate"> Moderate ($200-$300): Cleaning of the entire house with chemical wash, corrugated paper for floor protection, minor/regular haulage and debris disposal</label><br>
          <label><input type="radio" name="cleaningPolishing" value="extensive"> Extensive ($300-$12,400): Cleaning of the entire house with chemical wash, corrugated paper for floor protection plus floor polish, major haulage and debris disposal</label>
        </div>

        <div>
            <button class="prev-btn">Previous</button>
            <button class="next-btn">Next</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="8">
        <h2>Step 8: Contact Information</h2>

        <label for="fullName">Full Name</label><br>
        <input type="text" id="fullName" name="fullName" required><br><br>

        <label for="email">Email Address</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="contactNumber">Contact Number</label><br>
        <select name="countryCode" id="countryCode">
          <option value="+65">+65 (Singapore)</option>
          <option value="+62">+62 (Indonesia)</option>
          <!-- Tambahkan opsi lain sesuai kebutuhan -->
        </select>
        <input type="tel" id="contactNumber" name="contactNumber" required><br><br>

        <label><input type="checkbox" name="shortlistDesigners"> Get a shortlist of Interior Designers</label><br><br>

        <label><input type="checkbox" name="acceptTerms" required> I accept the terms of service</label><br><br>

        <div>
            <button class="submit-btn" type="submit" id="generateReportBtn">Generate Report</button>
        </div>
      </div>

      <div class="form-step step hidden" data-step="9">
        <h2>Step 9: Results</h2>

        <p><strong>Your Estimated Budget Range:</strong></p>
        <p id="budgetRangeDisplay">$34,700 - $41,640</p> <!-- This can be dynamically updated with JS -->

        <p>A confirmation email with the PDF report has been sent to <strong id="userEmailDisplay">user@example.com</strong>.</p>

        <div id="nextSteps">
          <!-- Conditional next steps based on user choices -->
          <p>Our team will reach out with a shortlist of Interior Designers shortly.</p>
        </div>

        <button class="restart-btn" type="button" id="restartBtn">Start Over</button>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Renovation Calculator</p>
  </footer>

  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
