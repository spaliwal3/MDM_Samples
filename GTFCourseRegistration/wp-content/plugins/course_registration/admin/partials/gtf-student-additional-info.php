<?php

/**
 *
 * GTF student additional information page.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/admin/partials
 */

$STATE_LIST = array(
    "AK" => "Alaska",
    "AL" => "Alabama",
    "AR" => "Arkansas",
    "AZ" => "Arizona",
    "CA" => "California",
    "CO" => "Colorado",
    "CT" => "Connecticut",
    "DC " => "District of Columbia",
    "DE " => "Delaware",
    "FL " => "Florida",
    "GA" => "Georgia",
    "HI" => "Hawaii",
    "IA " => "Iowa",
    "ID " => "Idaho",
    "IL " => "Illinois",
    "IN " => "Indiana",
    "KS " => "Kansas",
    "KY " => "Kentucky",
    "LA " => "Louisiana",
    "MA " => "Massachusetts",
    "MD " => "Maryland",
    "ME " => "Maine",
    "MI " => "Michigan",
    "MN " => "Minnesota",
    "MO " => "Missouri",
    "MS " => "Mississippi",
    "MT " => "Montana",
    "NC " => "North Carolina",
    "ND " => "North Dakota",
    "NE " => "Nebraska",
    "NH " => "New Hampshire",
    "NJ " => "New Jersey",
    "NM " => "New Mexico",
    "NV " => "Nevada",
    "NY " => "New York",
    "OH " => "Ohio",
    "OK " => "Oklahoma",
    "OR " => "Oregon",
    "PA " => "Pennsylvania",
    "PR " => "Puerto Rico",
    "RI " => "Rhode Island",
    "SC " => "South Carolina",
    "SD " => "South Dakota",
    "TN " => "Tennessee",
    "TX " => "Texas",
    "UT " => "Utah",
    "VA " => "Virginia",
    "VT " => "Vermont",
    "WA " => "Washington",
    "WI " => "Wisconsin",
    "WV " => "West Virginia",
    "WY " => "Wyoming"
);

$YEAR_OF_EXPERIENCE = array(
    1 => "<= 2 ",
    2 => "3 - 5 years",
    3 => "6 - 10 years",
    4 => ">10 years"
);

$DEPARTMENT = array(
    "ER",
    "OR",
    "ICU",
    "Floor",
    "Pre-Hosp",
    "Other"
);

$WORK_FACILITY = array(
    1 => "Anchor Hospital",
    2 => "Appling Healthcare System",
    3 => "Athens Regional Medical Center",
    4 => "Atlanta Medical Center",
    5 => "Atlanta Medical Center South",
    6 => "Atlanta VA Medical Center",
    7 => "Bacon County Hospital",
    8 => "Barrow Regional Medical Center",
    9 => "Bleckley Memorial Hospital",
    10 => "Brooks County Hospital",
    11 => "Burke Medical Center",
    12 => "Candler County Hospital",
    13 => "Candler Hospital of Savannah",
    14 => "Carl Vinson VA Medical Center",
    15 => "Cartersville Medical Center",
    16 => "Central State Hospital",
    17 => "Charlie Norwood VAMC Augusta",
    18 => "Chatuge Regional Hospital",
    19 => "Chestatee Regional Hospital",
    20 => "CHOA at Egleston",
    21 => "CHOA at Hughes Spalding",
    22 => "CHOA at Scottish Rite",
    23 => "CHOA Neighborhood Facilities",
    24 => "Clearview Regional Medical Center",
    25 => "Clinch Memorial Hospital",
    26 => "Coastal Harbor Treatment Center",
    27 => "Coffee Regional Medical Center",
    28 => "Coliseum Medical Centers",
    29 => "Coliseum Northside Hospital",
    30 => "Colquitt Regional Medical Center",
    31 => "Columbus Specialty Hospital",
    32 => "Cook Medical Center - a Tift Regional Campus",
    33 => "Crescent Pines Hospital",
    34 => "Crisp Regional Hospital",
    35 => "Dekalb Medical At Downtown Decatur",
    36 => "Dekalb Medical Center",
    37 => "Dekalb Medical Center at Hillandale",
    38 => "Doctors Hospital - Augusta",
    39 => "Dodge County Hospital",
    40 => "Donalsonville Hospital",
    41 => "Dorminy Medical Center",
    42 => "East Alabama Medical Center",
    43 => "East Central Regional Hospital",
    44 => "East Georgia Regional Medical Center",
    45 => "Eastside Medical Center",
    46 => "Effingham Health System",
    47 => "Eisenhower Army Medical Center",
    48 => "Elbert Memorial Hospital",
    49 => "Emanuel Medical Center",
    50 => "Emory Johns Creek Hospital",
    51 => "Emory Rehabilitation Hospital",
    52 => "Emory St. Joseph's Hospital",
    53 => "Emory University Hospital",
    54 => "Emory University Hospital Midtown",
    55 => "Emory University Orthopaedics & Spine Hosp.",
    56 => "Emory Wesley Woods Geriatric",
    57 => "Erlanger at Hutcheson",
    58 => "Evans Memorial Hospital",
    59 => "Fairview Park Hospital",
    60 => "Fannin Regional Hospital",
    61 => "Flint River Community Hospital",
    62 => "Floyd Medical Center",
    63 => "Georgia Regents University Medical Center",
    64 => "Georgia Regional Hospital at Savannah",
    65 => "Georgia Regional Hospital Atlanta",
    66 => "Gordon Hospital",
    67 => "Grady General Hospital",
    68 => "Grady Health System",
    69 => "Gwinnett Medical Center",
    70 => "Gwinnett Medical Center - Duluth",
    71 => "Habersham Medical Center",
    72 => "Hamilton Medical Center",
    73 => "HealthSouth Rehab. Hospital of Newnan",
    74 => "Higgins General Hospital",
    75 => "Hillside Hospital",
    76 => "Houston Medical Center",
    77 => "Irwin County Hospital",
    78 => "Jack Hughston Memoral Hospital",
    79 => "Jasper Memorial Hospital",
    80 => "Jeff Davis Hospital",
    81 => "Jefferson Hospital",
    82 => "John D. Archbold Memorial Hospital",
    83 => "Kindred Hospital - Atlanta",
    84 => "Kindred Hospital - Rome",
    85 => "Lakeview Behavioral Health",
    86 => "Landmark Hospital of Athens",
    87 => "Landmark Hospital Savannah",
    88 => "Liberty Regional Medical Center",
    89 => "Lower Oconee Community Hospital",
    90 => "Macon Behavioral",
    91 => "Martin Army Community Hospital",
    92 => "Mayo Clinic Health System in Waycross",
    93 => "Meadows Regional Medical Center",
    94 => "Medical Center of Peach County - Navicent",
    95 => "Memorial Health University Medical Center",
    96 => "Memorial Hospital And Manor",
    97 => "Midtown Medical Center",
    98 => "Miller County Hospital",
    99 => "Mitchell County Hospital",
    100 => "Monroe County Hospital",
    101 => "Morgan Memorial Hospital",
    102 => "Mountain Lakes Medical",
    103 => "Murray Medical Center",
    104 => "Navicent Health",
    105 => "Newton Medical Center",
    106 => "North Fulton Regional Hospital",
    107 => "North Georgia Medical Center",
    108 => "Northeast Georgia Medical Center",
    109 => "Northeast Georgia Medical Center - Braselton",
    110 => "Northridge Medical Center",
    111 => "Northside Hospital",
    112 => "Northside Hospital ? Cherokee",
    113 => "Northside Hospital - Forsyth",
    114 => "Northside Medical Center - Columbus",
    115 => "Oconee Regional Medical Center",
    116 => "Optim Medical Center ? Jenkins",
    117 => "Optim Medical Center ? Screven",
    118 => "Optim Medical Center ? Tattnall",
    119 => "Optim Surgery Center",
    120 => "Peachford Hospital BHS",
    121 => "Perry Hospital",
    122 => "Phoebe North Campus",
    123 => "Phoebe Putney Memorial Hospital",
    124 => "Phoebe Sumter Medical Center",
    125 => "Phoebe Worth Medical Center",
    126 => "Piedmont Fayette Hospital",
    127 => "Piedmont Henry Hospital",
    128 => "Piedmont Hospital",
    129 => "Piedmont Mountainside Medical Center",
    130 => "Piedmont Newnan Hospital",
    131 => "Pioneer Community Hospital of Early",
    132 => "Polk Medical Center",
    133 => "Putnam General Hospital",
    134 => "Redmond Regional Medical Center",
    135 => "Regency Hospital of Central Georgia",
    136 => "Regional Rehabilitation Hospital",
    137 => "Rehabilitation Hospital Navicent Health",
    138 => "Ridgeview Institute",
    139 => "Riverwoods Behavioral Health System",
    140 => "Rockdale Medical Center",
    141 => "Roosevelt Warm Springs Institute",
    142 => "Select Specialty Hospital - Augusta",
    143 => "Select Specialty Hospital - Savannah",
    144 => "SGMC Berrien Campus",
    145 => "SGMC-Lanier Campus",
    146 => "Shepherd Center",
    147 => "South Georgia Medical Center",
    148 => "Southeast Ga Health System - Brunswick",
    149 => "Southeast Ga Health System - Camden",
    150 => "Southeastern Regional Medical Center / CTCA",
    151 => "Southern Regional Medical Center",
    152 => "Southwest Georgia Regional Medical Center",
    153 => "Spalding Regional Hospital",
    154 => "St Mary's Sacred Heart Hospital",
    155 => "St. Francis Hospital",
    156 => "St. Joseph's Hospital - Savannah",
    157 => "St. Mary?s Health Care System",
    158 => "St. Mary's Good Samaritan Hospital",
    159 => "St. Simons by-the-sea",
    160 => "Stephens County Hospital",
    161 => "Summitridge Hospital",
    162 => "Sylvan Grove Hospital",
    163 => "Talbott Recovery Campus",
    164 => "Tanner Medical Center-Carrollton",
    165 => "Tanner Medical Center-Villa Rica",
    166 => "Taylor Regional Hospital",
    167 => "Tift Regional Medical Center",
    168 => "Trinity Hospital of Augusta",
    169 => "Union General",
    170 => "University Hospital",
    171 => "University Hospital McDuffie",
    172 => "Upson Regional Medical Center",
    173 => "Walton Rehabilitation Hospital",
    174 => "Warm Springs Medical Center",
    175 => "Washington County Regional Medical Center",
    176 => "Wayne Memorial Hospital",
    177 => "Wellstar Cobb Hospital",
    178 => "Wellstar Douglas Hospital",
    179 => "Wellstar Kennestone Hospital",
    180 => "Wellstar Paulding Hospital",
    181 => "Wellstar Windy Hill Hospital",
    182 => "West Central Georgia Regional Hospital",
    183 => "West Georgia Health System",
    184 => "Willingway Hospital",
    185 => "Wills Memorial Hospital",
    186 => "Others",
    187 => "Not Applicable"
);

$COUNTY_LIST = array(
    1 => "Appling",
    2 => "Atkinson",
    3 => "Bacon",
    4 => "Baker",
    5 => "Baldwin",
    6 => "Banks",
    7 => "Barrow",
    8 => "Bartow",
    9 => "Ben Hill",
    10 => "Berrien",
    11 => "Bibb",
    12 => "Bleckley",
    13 => "Brantley",
    14 => "Brooks",
    15 => "Bryan",
    16 => "Bulloch",
    17 => "Burke",
    18 => "Butts",
    19 => "Calhoun",
    20 => "Camden",
    21 => "Candler",
    22 => "Carroll",
    23 => "Catoosa",
    24 => "Charlton",
    25 => "Chatham",
    26 => "Chattahoochee",
    27 => "Chattooga",
    28 => "Cherokee",
    29 => "Clarke",
    30 => "Clay",
    31 => "Clayton",
    32 => "Clinch",
    33 => "Cobb",
    34 => "Coffee",
    35 => "Colquitt",
    36 => "Columbia",
    37 => "Cook",
    38 => "Coweta",
    39 => "Crawford",
    40 => "Crisp",
    41 => "Dade",
    42 => "Dawson",
    43 => "Decatur",
    44 => "DeKalb",
    45 => "Dodge",
    46 => "Dooly",
    47 => "Dougherty",
    48 => "Douglas",
    49 => "Early",
    50 => "Echols",
    51 => "Effingham",
    52 => "Elbert",
    53 => "Emanuel",
    54 => "Evans",
    55 => "Fannin",
    56 => "Fayette",
    57 => "Floyd",
    58 => "Forsyth",
    59 => "Franklin",
    60 => "Fulton",
    61 => "Gilmer",
    62 => "Glascock",
    63 => "Glynn",
    64 => "Gordon",
    65 => "Grady",
    66 => "Greene",
    67 => "Gwinnett",
    68 => "Habersham",
    69 => "Hall",
    70 => "Hancock",
    71 => "Haralson",
    72 => "Harris",
    73 => "Hart",
    74 => "Heard",
    75 => "Henry",
    76 => "Houston",
    77 => "Irwin",
    78 => "Jackson",
    79 => "Jasper",
    80 => "Jeff Davis",
    81 => "Jefferson",
    82 => "Jenkins",
    83 => "Johnson",
    84 => "Jones",
    85 => "Lamar",
    86 => "Lanier",
    87 => "Laurens",
    88 => "Lee",
    89 => "Liberty",
    90 => "Lincoln",
    91 => "Long",
    92 => "Lowndes",
    93 => "Lumpkin",
    94 => "Macon",
    95 => "Madison",
    96 => "Marion",
    97 => "McDuffie",
    98 => "McIntosh",
    99 => "Meriwether",
    100 => "Miller",
    101 => "Mitchell",
    102 => "Monroe",
    103 => "Montgomery",
    104 => "Morgan",
    105 => "Murray",
    106 => "Muscogee",
    107 => "Newton",
    108 => "Oconee",
    109 => "Oglethorpe",
    110 => "Paulding",
    111 => "Peach",
    112 => "Pickens",
    113 => "Pierce",
    114 => "Pike",
    115 => "Polk",
    116 => "Pulaski",
    117 => "Putnam",
    118 => "Quitman",
    119 => "Rabun",
    120 => "Randolph",
    121 => "Richmond",
    122 => "Rockdale",
    123 => "Schley",
    124 => "Screven",
    125 => "Seminole",
    126 => "Spalding",
    127 => "Stephens",
    128 => "Stewart",
    129 => "Sumter",
    130 => "Talbot",
    131 => "Taliaferro",
    132 => "Tattnall",
    133 => "Taylor",
    134 => "Telfair",
    135 => "Terrell",
    136 => "Thomas",
    137 => "Tift",
    138 => "Toombs",
    139 => "Towns",
    140 => "Treutlen",
    141 => "Troup",
    142 => "Turner",
    143 => "Twiggs",
    144 => "Union",
    145 => "Upson",
    146 => "Walker",
    147 => "Walton",
    148 => "Ware",
    149 => "Warren",
    150 => "Washington",
    151 => "Wayne",
    152 => "Webster",
    153 => "Wheeler",
    154 => "White",
    155 => "Whitfield",
    156 => "Wilcox",
    157 => "Wilkes",
    158 => "Wilkinson",
    159 => "Worth",
    160 => "Non-Georgia"
);

?>
<h3>Extra student profile information</h3>
      <table class="form-table">
            <tr>
            <th><label for='cellphone'>Cell phone</label></th>
                <td>
                    <input type="text" name="cellphone" id="cellphone" value="<?php echo esc_attr( get_the_author_meta( 'cellphone', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>
            <tr>
                <th><label for="last_4_ssn">Last 4 digits of SSN</label></th>
                <td>
                    <input type="text" name="last_4_ssn" id="last_4_ssn" value="<?php echo esc_attr( get_the_author_meta( 'last_4_ssn', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description">Please enter the last 4 digits SSN of the user.</span>
                </td>
            </tr>

          <tr>
            <th><label for='address'>Address 1</label></th>
                <td>
                    <input type="text" name="address1" id="address1" value="<?php echo esc_attr( get_the_author_meta( 'address1', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
          </tr>
            <tr>
                <th><label for='address'>Address 2</label></th>
                    <td>
                        <input type="text" name="address2" id="address2" value="<?php echo esc_attr( get_the_author_meta( 'address2', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
            </tr>
            <tr>
                <th><label for='city'>City</label></th>
                    <td>
                        <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
            </tr>
            <tr>
                <th><label for='county'>County</label></th>
                    <td>
                        <?php
                            $county = get_the_author_meta( 'county', $user->ID );
                        ?>
                        <select id="county" name="county">
                            <?php
                            if (!$county) $county='Appling';
                            foreach($COUNTY_LIST as $key => $value)
                            {
                                $selected = 'false';
                                if($county == $key)
                                {
                                    echo "<option value='$key' selected='selected' >$value</option>";
                                }
                                else
                                {
                                    echo "<option value='$key' >$value</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
            </tr>
            <tr>
                <th><label for='state'>State</label></th>
                    <td>
                        <?php
                            $state = get_the_author_meta( 'state', $user->ID );
                        ?>
                        <select id="state" name="state">
                            <?php
                            if (!$state) $state='GA';
                            foreach($STATE_LIST as $key => $value)
                            {
                                $selected = 'false';
                                if($state == $key)
                                {
                                    echo "<option value='$key' selected='selected' >$value</option>";
                                }
                                else
                                {
                                    echo "<option value='$key' >$value</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
            </tr>
            <tr>
                <th><label for='zipcode'>Zip code</label></th>
                    <td>
                        <input type="text" name="zipcode" id="zipcode" value="<?php echo esc_attr( get_the_author_meta( 'zipcode', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
            </tr>

            <tr>
                <th><label for='degree'>Degree</label></th>
                    <td>
                        <input type="text" name="degree" id="degree" value="<?php echo esc_attr( get_the_author_meta( 'degree', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
            </tr>
            <tr>
                <th><label for='work_facility'>Work facility</label></th>
                    <td>
                        <?php
                            $work_facility = get_the_author_meta( 'work_facility', $user->ID );
                        ?>
                        <select  id="work_facility" name="work_facility">
                            <?php
                            if (!$work_facility) $work_facility=1;
                            foreach($WORK_FACILITY as $key => $value)
                            {
                                $selected = 'false';
                                if($key == $work_facility)
                                {
                                    echo "<option value='$key' selected='selected' >$value</option>";
                                }
                                else
                                {
                                    echo "<option value='$key'>$value</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
            </tr>

            <tr>
                <th><label for='work_department'>Work department</label></th>
                    <td>
                        <?php
                            $work_department = get_the_author_meta( 'work_department', $user->ID );
                        ?>
                        <select id="work_department" name="work_department">
                            <?php
                            if (!$work_department) $work_department='Facility 1';
                            foreach($DEPARTMENT as $value)
                            {
                                $selected = 'false';
                                if($value == $work_department)
                                {
                                    echo "<option value='$value' selected='selected' >$value</option>";
                                }
                                else
                                {
                                    echo "<option value='$value'>$value</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
            </tr>
          <tr>
            <th><label for='job_title'>Job Title</label></th>
                <td>
                    <input type="text" name="job_title" id="job_title" value="<?php echo esc_attr( get_the_author_meta( 'job_title', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
          </tr>
            <tr>
                <th><label for='year_of_experience'>Year of experience</label></th>
                    <td>
                        <?php
                            $year_of_experience = get_the_author_meta( 'year_of_experience', $user->ID );
                        ?>
                        <select id="year_of_experience" name="year_of_experience">
                            <?php
                            if (!$year_of_experience) $year_of_experience=$YEAR_OF_EXPERIENCE[0];
                            foreach($YEAR_OF_EXPERIENCE as $key => $value)
                            {
                                $selected = 'false';
                                if($year_of_experience == $key)
                                {
                                    echo "<option value='$key' selected='selected' >$value</option>";
                                }
                                else
                                {
                                    echo "<option value='$key'>$value</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
            </tr>
          <tr>
            <th><label for='dietary_needs'>Dietary Needs</label></th>
                <td>
                    <input type="text" name="dietary_needs" id="dietary_needs" value="<?php echo esc_attr( get_the_author_meta( 'dietary_needs', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
          </tr>
          <tr>
            <th><label for='registed_courses'>Registed Programs</label></th>
              <td>
                <?php
                $courses = get_posts(
                  array(
                  'post_type' => 'course',
                  'post_status' => array('publish', 'pending', 'draft', 'future', 'private', 'inherit'),
                  'orderby'   => 'post__in',
                ));
                if($courses){
                  foreach($courses as $course){
                    $cname = $course->post_title;
                    $cid = $course->ID;
                    //$cid = get_post_meta($course->ID, 'eventbrite_event_id', true);
                    $checked = get_the_author_meta( 'registed_courses', $user->ID );
                ?>
                      <input type="checkbox" name="registed_courses[]"
                      <?php if(!empty($checked) and in_array($cid, $checked)){ echo 'checked';  } ?>
                      value="<?php echo esc_attr($cid); ?>"/>
              <?php echo esc_attr($cname); ?>
                      <br />
                    <?php
                  }
                } ?>
              </td>
          </tr>
      </table>
