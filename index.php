<?php

require_once './vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class user{

	private $database;
	private $dbname;

	public function __construct()
	{
			$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/secret/my-project-1556194970442-7b8481b94474.json');

			$firebase = (new Factory)
			    ->withServiceAccount($serviceAccount)
			    ->create();

			$this->database = $firebase->getDatabase();
	}

	public function insert($data)
	{
			if( empty($data) || !isset($data) )  return false;
		
				$this->database->getReference('admin')->push($data);				
	}

	public function getData($email)
	{
			if( empty($email) || !isset($email) )  return false;

				$data = $this->database->getReference('admin')->orderByChild('address')->equalTo('delhi')->getValue();
				return $data;

	}

	public function delete( $table )
	{

			if( empty($table) || !isset($table) )  return false;	

			if( $this->database->getReference($table.'/LfO9q6L7Y6XI7_r_5QW')->getSnapshot()->hasChild('email') ){				
					$this->database->getReference($table.'/LfO9q6L7Y6XI7_r_5QW')->getChild('email')->remove();	
					return true;
				}
	
			return false;
			
	}

	public function update( $data, $key )
	{
		if( empty($data) || !isset($data) )  return false;

		$this->database->getReference('admin/'.$key)->update($data);
	}
}

$user = new user();


// $user->insert(array(
	
// 		'id' => 1,
// 		'name' => 'sunil bansal',
// 		'email' => 'sunil	@gmail.com',
// 		'address' => 'delhi',
// 		'phone' => '123456789'
	
// ));

// $user->insert(array(
// 	'id' => 2
// 	));

$data = $user->getData("kunal@gmail.com");
echo "<pre>";
print_r($data);
die;
$i=0;
foreach ($data as $key => $value) {
	$user->update(['id' => $i++], $key);
}

//$user->update(['email' => 'cyber1@gmail.com'], $key);
// if($user->delete('admin')){
// 	echo 'true';
// }else{
// 	echo 'false';
// }


