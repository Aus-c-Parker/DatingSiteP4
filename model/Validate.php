<?php
class Validate
{
    function validName($name)
    {
        return !empty(trim($name));
    }

    function validAge($age) {
        return $age > 18 && $age < 118;
    }

    function validGender($gender) {
        return $gender == "male" || $gender == "female";
    }

    function validPhone($phone) {
        return strlen($phone) == 10;
    }

    function validEmail($email) {
        return !empty(trim($email)) && strpos($email, "@") && strpos($email, ".");
    }

    function validState($state)
    {
        $validStates = getState();
        return in_array($state, $validStates);
    }

    function validIndoor($indoor)
    {
        $validInterests = getIndoor();
        return in_array($indoor, $validInterests);
    }

    function validOutdoor($outdoor)
    {
        $validInterests = getOutdoor();
        return in_array($outdoor, $validInterests);
    }

    function getState()
    {
        return array("Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware",
            "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana",
            "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
            "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio",
            "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "
        Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming");
    }


    function getIndoor()
    {
        return array("tv", "movies", "cooking", "board games", "puzzles", "reading", "playing cards", "video games");
    }

    function getOutdoor()
    {
        return array("hiking", "biking", "swimming", "collecting", "walking", "climbing");
    }
}

