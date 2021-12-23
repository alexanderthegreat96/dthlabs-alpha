<?php
namespace LexSystems\Framework\Kernel\Helpers\CoreUtils;
/**
 * Random Helper
 *
 * Retrieve commonly used random seed data
 *
 * @author  mahngiel <mahngiel@codezyne.me>
 * @version 1
 * @copyleft Use and abuse
 * @license http://en.wikipedia.org/wiki/Copyleft
 *
 */

class RandomSeeder
{
    /**
     * 2013 Most popular male names
     *
     * @var array
     */
    private $firstNamesMale = array(
        'Jacob', 'Mason', 'Ethan', 'Noah', 'William', 'Liam', 'Jayden', 'Michael', 'Alexander', 'Aiden', 'Daniel', 'Matthew', 'Elijah', 'James', 'Anthony',
        'Benjamin', 'Joshua', 'Andrew', 'David', 'Joseph', 'Logan', 'Jackson', 'Christopher', 'Gabriel', 'Samuel', 'Ryan', 'Lucas', 'John', 'Nathan', 'Isaac', 'Dylan',
        'Caleb', 'Christian', 'Landon', 'Jonathan', 'Carter', 'Luke', 'Owen', 'Brayden', 'Gavin', 'Wyatt', 'Isaiah', 'Henry', 'Eli', 'Hunter', 'Jack', 'Evan', 'Jordan', 'Nicholas', 'Tyler'
    );

    /**
     * 2013 Most popular female names
     *
     * @var array
     */
    private $firstNamesFemale = array(
        'Sophia', 'Emma', 'Isabella', 'Olivia', 'Ava', 'Emily', 'Abigail', 'Mia', 'Madison', 'Elizabeth', 'Chloe', 'Ella', 'Avery', 'Addison', 'Aubrey', 'Lily', 'Natalie',
        'Sofia', 'Charlotte', 'Zoey', 'Grace', 'Hannah', 'Amelia', 'Harper', 'Lillian', 'Samantha', 'Evelyn', 'Victoria', 'Brooklyn', 'Zoe', 'Layla', 'Hailey', 'Leah', 'Kaylee',
        'Anna', 'Aaliyah', 'Gabriella', 'Allison', 'Nevaeh', 'Alexis', 'Audrey', 'Savannah', 'Sarah', 'Alyssa', 'Claire', 'Taylor', 'Riley', 'Camila', 'Arianna', 'Ashley'
    );

    /**
     * 2013 Most popular surnames
     *
     * @var array
     */
    private $lastNames = array(
        'Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor', 'Anderson', 'Thomas', 'Jackson', 'White', 'Harris', 'Martin', 'Thompson', 'Garcia',
        'Martinez', 'Robinson', 'Clark', 'Rodriguez', 'Lewis', 'Lee', 'Walker', 'Hall', 'Allen', 'Young', 'Hernandez', 'King', 'Wright', 'Lopez', 'Hill', 'Scott', 'Green', 'Adams', 'Baker',
        'Gonzalez', 'Nelson', 'Carter', 'Mitchell', 'Perez', 'Roberts', 'Turner', 'Phillips', 'Campbell', 'Parker', 'Evans', 'Edwards', 'Collins', 'Stewart', 'Sanchez', 'Morris', 'Rogers',
        'Reed', 'Cook', 'Morgan', 'Bell', 'Murphy', 'Bailey', 'Rivera', 'Cooper', 'Richardson', 'Cox', 'Howard', 'Ward', 'Torres', 'Peterson', 'Gray', 'Ramirez', 'James', 'Watson', 'Brooks',
        'Kelly', 'Sanders', 'Price', 'Bennett', 'Wood', 'Barnes', 'Ross', 'Henderson', 'Coleman', 'Jenkins', 'Perry', 'Powell', 'Long', 'Patterson', 'Hughes', 'Flores', 'Washington', 'Butler',
        'Simmons', 'Foster', 'Gonzales', 'Bryant', 'Alexander', 'Russell', 'Griffin', 'Diaz', 'Hayes'
    );

    /**
     * US States
     *
     * @var array
     */
    private $states = array(
        'AL' => "Alabama",
        'AK' => "Alaska",
        'AZ' => "Arizona",
        'AR' => "Arkansas",
        'CA' => "California",
        'CO' => "Colorado",
        'CT' => "Connecticut",
        'DE' => "Delaware",
        'DC' => "District Of Columbia",
        'FL' => "Florida",
        'GA' => "Georgia",
        'HI' => "Hawaii",
        'ID' => "Idaho",
        'IL' => "Illinois",
        'IN' => "Indiana",
        'IA' => "Iowa",
        'KS' => "Kansas",
        'KY' => "Kentucky",
        'LA' => "Louisiana",
        'ME' => "Maine",
        'MD' => "Maryland",
        'MA' => "Massachusetts",
        'MI' => "Michigan",
        'MN' => "Minnesota",
        'MS' => "Mississippi",
        'MO' => "Missouri",
        'MT' => "Montana",
        'NE' => "Nebraska",
        'NV' => "Nevada",
        'NH' => "New Hampshire",
        'NJ' => "New Jersey",
        'NM' => "New Mexico",
        'NY' => "New York",
        'NC' => "North Carolina",
        'ND' => "North Dakota",
        'OH' => "Ohio",
        'OK' => "Oklahoma",
        'OR' => "Oregon",
        'PA' => "Pennsylvania",
        'RI' => "Rhode Island",
        'SC' => "South Carolina",
        'SD' => "South Dakota",
        'TN' => "Tennessee",
        'TX' => "Texas",
        'UT' => "Utah",
        'VT' => "Vermont",
        'VA' => "Virginia",
        'WA' => "Washington",
        'WV' => "West Virginia",
        'WI' => "Wisconsin",
        'WY' => "Wyoming"
    );

    /**
     * World countries
     *
     * @var array
     */
    private $countries = array(
        'af' => 'Afghanistan',
        'al' => 'Albania',
        'dz' => 'Algeria',
        'ad' => 'Andorra',
        'ai' => 'Anguilla',
        'ag' => 'Antigua - Barbuda',
        'ar' => 'Argentina',
        'am' => 'Armenia',
        'aw' => 'Aruba',
        'au' => 'Australia',
        'az' => 'Azerbaijan',
        'bs' => 'Bahamas',
        'bh' => 'Bahrain',
        'bd' => 'Bangladesh',
        'bb' => 'Barbados',
        'by' => 'Belarus',
        'be' => 'Belgium',
        'bz' => 'Belize',
        'bj' => 'Benin',
        'bm' => 'Bermuda',
        'bt' => 'Bhutan',
        'bo' => 'Bolivia',
        'ba' => 'Bosnia',
        'bw' => 'Botswana',
        'br' => 'Brazil',
        'bn' => 'Brunei',
        'bg' => 'Bulgaria',
        'bf' => 'Burkina Faso',
        'bi' => 'Burundi',
        'kh' => 'Cambodia',
        'cm' => 'Cameroon',
        'ca' => 'Canada',
        'cv' => 'Cape Verde',
        'cf' => 'Central Africa Republic',
        'td' => 'Chad',
        'cl' => 'Chile',
        'ci' => 'Christmas Island',
        'cn' => 'China',
        'co' => 'Colombia',
        'cg' => 'Congo',
        'ck' => 'Cook Islands',
        'cr' => 'Costa Rica',
        'ct' => 'Cote D\'Ivoire',
        'hr' => 'Croatia',
        'cu' => 'Cuba',
        'cb' => 'Curacao',
        'cy' => 'Cyprus',
        'cz' => 'Czech Republic',
        'dk' => 'Denmark',
        'dj' => 'Djibouti',
        'dm' => 'Dominica',
        'do' => 'Dominican Republic',
        'ec' => 'Ecuador',
        'eg' => 'Egypt',
        'sv' => 'El Salvador',
        'gq' => 'Equatorial Guinea',
        'er' => 'Eritrea',
        'ee' => 'Estonia',
        'et' => 'Ethiopia',
        'fo' => 'Faroe Islands',
        'fj' => 'Fiji',
        'fi' => 'Finland',
        'fr' => 'France',
        'ge' => 'Georgia',
        'de' => 'Germany',
        'gh' => 'Ghana',
        'gb' => 'Great Britain',
        'gr' => 'Greece',
        'gl' => 'Greenland',
        'gd' => 'Grenada',
        'gp' => 'Guadaloupe',
        'gu' => 'Guam',
        'gt' => 'Guatemala',
        'gn' => 'Guinea',
        'gy' => 'Guyana',
        'ht' => 'Haiti',
        'hn' => 'Honduras',
        'hk' => 'Hong Kong',
        'hu' => 'Hungary',
        'is' => 'Iceland',
        'in' => 'India',
        'id' => 'Indonesia',
        'ia' => 'Iran',
        'iq' => 'Iraq',
        'ir' => 'Ireland',
        'il' => 'Israel',
        'it' => 'Italy',
        'jm' => 'Jamaica',
        'jp' => 'Japan',
        'jo' => 'Jordan',
        'kz' => 'Kazakhstan',
        'ke' => 'Kenya',
        'ki' => 'Kiribati',
        'kr' => 'Korea',
        'kw' => 'Kuwait',
        'kg' => 'Kyrgyzstan',
        'la' => 'Laos',
        'lv' => 'Latvia',
        'lb' => 'Lebanon',
        'lr' => 'Liberia',
        'li' => 'Liechtenstein',
        'lu' => 'Luxembourg',
        'ly' => 'Lybia',
        'mk' => 'Macedonia',
        'my' => 'Malaysia',
        'ml' => 'Mali',
        'mt' => 'Malta',
        'mx' => 'Mexico',
        'md' => 'Moldova',
        'mn' => 'Mongolia',
        'ma' => 'Morocco',
        'mz' => 'Mozambique',
        'mn' => 'Myanmar',
        'na' => 'Namibia',
        'nu' => 'Nauru',
        'np' => 'Nepal',
        'nl' => 'Netherlands',
        'nz' => 'New Zealand',
        'ni' => 'Nicaragua',
        'ne' => 'Niger',
        'ng' => 'Nigeria',
        'no' => 'Norway',
        'om' => 'Oman',
        'pk' => 'Pakistan',
        'pa' => 'Panama',
        'py' => 'Paraguay',
        'pe' => 'Peru',
        'ph' => 'Philippines',
        'pl' => 'Poland',
        'pt' => 'Portugal',
        'pr' => 'Puerto Rico',
        'qa' => 'Qatar',
        'ro' => 'Romania',
        'ru' => 'Russia',
        'rw' => 'Rwanda',
        'lc' => 'St Lucia',
        'sm' => 'San Marino',
        'sa' => 'Saudi Arabia',
        'sn' => 'Senegal',
        'ss' => 'Serbia - Montenegro',
        'sg' => 'Singapore',
        'sk' => 'Slovakia',
        'si' => 'Slovenia',
        'so' => 'Somalia',
        'za' => 'South Africa',
        'es' => 'Spain',
        'sd' => 'Sudan',
        'sr' => 'Suriname',
        'se' => 'Sweden',
        'ch' => 'Switzerland',
        'sy' => 'Syria',
        'tw' => 'Taiwan',
        'th' => 'Thailand',
        'tg' => 'Togo',
        'tk' => 'Tokelau',
        'to' => 'Tonga',
        'tt' => 'Tridinidad Tobago',
        'tn' => 'Tunisia',
        'tr' => 'Turkey',
        'ua' => 'Ukraine',
        'ae' => 'United Arab Emirate',
        'gb' => 'United Kingdom',
        'us' => 'United States',
        'uy' => 'Uruguay',
        'va' => 'Vatican',
        've' => 'Venezuela',
        'vn' => 'Vietnam',
        'za' => 'Zimbawe'
    );

    /**
     * Generates a random string
     *
     * @return string Random characters formed into a word
     */
    public function String()
    {
        $validCharacters = "abcdefghijklmnopqrstuxyvwz";
        $validCharNumber = strlen( $validCharacters );

        $word = '';

        // Randomly set the number of letters
        $letters = rand( 3, 7 );

        for( $letter = 1; $letter <= $letters; $letter++ )
        {
            $index = mt_rand( 0, $validCharNumber - 1 );
            $word .= $validCharacters[ $index ];
        }

        return $word .= ' ';
    }

    /**
     * Generates a pseudo-sentence of random strings
     *
     * @param int $numWords Number of words to generate
     *
     * @return string Collection of random letters separated by a space
     */
    public function Words( $numWords = 5 )
    {
        $sentence = '';

        for( $words = 1; $words <= $numWords; $words++ )
        {
            $sentence .= $this->String() . ' ';
        }

        return rtrim( $sentence, ' ' ) . '.';
    }

    /**
     * Generates a collection of pseudo-sentences
     *
     * @param int $numSentences Number of sentences comprised of random words
     *
     * @return string Collection of random sentences
     */
    public function Paragraph( $numSentences = 5 )
    {
        $paragraph = '';

        for( $sentences = 1; $sentences <= $numSentences; $sentences++ )
        {
            // Randomly set the amount of words per sentence
            $words = rand( 6, 10 );

            $paragraph .= $this->Words( $words ) . ' ';
        }

        return $paragraph;
    }

    /**
     * Retrieves a random male name
     *
     * @return string Random popular US male name
     */
    public function MaleFirstName()
    {
        return $this->firstNamesMale[ rand( 0, 49 ) ];
    }

    /**
     * Retrieves a random female name
     *
     * @return string Random popular US female name
     */
    public function FemaleFirstName()
    {
        return $this->firstNamesFemale[ rand( 0, 49 ) ];
    }

    /**
     * Retrieves a random name
     *
     * @return string Random popular US first name
     */
    public function FirstName()
    {
        $allNames = array_merge( $this->firstNamesMale, $this->firstNamesFemale );

        return $allNames[ rand( 0, 99 ) ];
    }

    /**
     * Retrieves a random last name
     *
     * @return string Random popular US surname
     */
    public function LastName()
    {
        return $this->lastNames[ rand( 0, 99 ) ];
    }

    /**
     * Generates a random male name
     *
     * @return string Random popular US male first and surnames
     */
    public function MaleName()
    {
        return $this->MaleFirstName() . ' ' . $this->LastName();
    }

    /**
     * Generates a random female name
     *
     * @return string Random popular US female first and surnames
     */
    public function FemaleName()
    {
        return $this->FemaleFirstName() . ' ' . $this->LastName();
    }

    /**
     * Generates a random name
     *
     * @return string Random popular US first and surnames
     */
    public function Name()
    {
        return $this->FirstName() . ' ' . $this->LastName();
    }

    /**
     * Retrieves a random state abbreviation
     *
     * @return string Random US state abbreviation
     */
    public function StateAbbr()
    {
        $states = array_keys( $this->states );

        return $states[ rand( 0, 49 ) ];
    }

    /**
     * Retrieves a random state
     *
     * @return string Random US state name
     */
    public function State()
    {
        return $this->states[ $this->StateAbbr() ];
    }

    /**
     * Retrieves a random country abbreviation
     *
     * @return string Random country abbreviation
     */
    public function CountryAbbr()
    {
        $countries = array_keys( $this->countries );

        return $countries[ rand( 0, 167 ) ];
    }

    /**
     * Retrieves a random country
     *
     * @return string Random country name
     */
    public function Country()
    {
        return $this->countries[ $this->CountryAbbr() ];
    }
}
