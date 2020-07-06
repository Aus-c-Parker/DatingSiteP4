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
        $validStates = $this->getState();
        return in_array($state, $validStates);
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
        $indoor = array("tv", "movies", "cooking", "board games", "puzzles", "reading", "playing cards", "video games");
        return $indoor;
    }

    function getOutdoor()
    {
        $outdoor = array("hiking", "biking", "swimming", "collecting", "walking", "climbing");
        return $outdoor;
    }

    function validIndoor($indoor)
    {
        $validIndoor = $this->getIndoor();
        if (isset($indoor))
        {
            foreach ($indoor as $interest)
            {
                if (!in_array($interest, $validIndoor))
                {
                    return false;
                }

            }
            return true;
        }
        return false;
    }

    function validOutdoor($outdoor)
    {
        $validOutdoor = $this->getOutdoor();
        if (isset($outdoor)) {
            foreach ($outdoor as $interest) {
                if (!in_array($interest, $validOutdoor)){
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}


