<?php
namespace Classes\form_generator;

 class Formgenerator{
	protected $targetfile;
	protected $method;
	#protected $heading;
	#protected $description;
	protected $formfields = array();
	protected $submitbutton_name = "standard";
	
	public function __construct($submitbutton_name, $targetfile, $method = "post")
	{
		$this->configuration($submitbutton_name, $targetfile, $method);
	}
	
	
	protected function configuration($submitbutton_name, $targetfile, $method)
	{
		$this->submitbutton_name = $submitbutton_name;
		$this->targetfile = $targetfile;
		$this->method = $method;
	}
	
	public function add_field(Formfield $field)
	{
		$this->formfields[] = $field;
	}
	
	public function generate_code($submitcaption)
	{
		$string =	'<form  action ="'.$this->targetfile.'" method="'.$this->method.'">' ."\n" ;
		
		foreach($this->formfields as $formfield)
		{
			$string .= $formfield->generate_code();
			$string .= "<br/>"."\n";
		} 
	
		$string .=	'<input type="submit" name="'.$this->submitbutton_name.'" value="'.$submitcaption.'" />'."\n";
		$string .="</form>";
		return $string;
	}
}



class Formfield {
	protected $label;
	protected $value;
	protected $type ;
	#protected $name;
	#protected $width;
	
	public function __construct($label ="Fieldname",
								 $type ="text",
								 $value ="pre-assignment")
	{
		$this->configuration($label,$type,$value);
	}
	
	protected function configuration($label ="Fieldname",
								 $type ="text",
								 $value ="pre-assignment")
	{							 
		$this->label = $label;
		$this->type = $type;
		$this->value = $value;
	}
	public function generate_code()
	{
	
	$string = $this->label."<br/>".'<input  name ="'.$this->label.'"  type="'.$this->type.'" value="'.$this->value.'"/>'."\n";
	return $string;
	}
	
} 
 
/*  $form = new Formgenerator("Register",$_SERVER["PHP_SELF"]);
$form->add_field(new Formfield("Firstname","text",""));
$form->add_field(new Formfield("Lastname","text",""));
$form->add_field(new Formfield("UserID","text",""));
$form->add_field(new Formfield("Password","password",""));
$form->add_field(new Formfield("Password Repeat","password",""));
$this->content="<h1>Please Register Here</h1>".$form->generate_code("Complete Registration");  */	
	

?>