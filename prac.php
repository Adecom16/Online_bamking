<?php
// class Age {
//   // Properties
//   public $age;

//   // Methods
//   function __construct($age) {
//     $this->age = $age;
//   }
//   function get_age() {
//     return $this->age;
//   }
// }

// $age = new Age(60 . 'years old');
// $secondAge = new Age(28 . 'years old');


// echo $age->get_age();
// echo "<br>";
// echo $secondAge->get_age();
?>


<?php
class Age {
  public $name;
  protected $age;
  private $weight;
}

$person = new Age();
$person->name = 'Adefokun'; // OK
$person->age = '19'; // ERROR
$person->weight = '300kg'; // ERROR
?>