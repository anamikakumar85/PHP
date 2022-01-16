<?php
namespace Classes;
class Filemanager
{
	public function file_upload($file)
	{
		$file_tempname = $file["tmp_name"]; // Wie heißt die Datei auf dem Server?
		$new_filename = uniqid("photo_").".jpg"; // bild_4743828dfjkw48357.png
		$this->file_copy($file_tempname, $new_filename);
		return $new_filename;	
	}
	public function file_delete($file)
	{
		unlink("uploads/".$file);
	}
	public function file_copy($file_tempname, $new_filename)
	{
		// kopiervorgang von A nach B (A = Quelle, B = Ziel)
		move_uploaded_file($file_tempname, "uploads/".$new_filename);
	}
	
	public function file_download($file)
	{
		$type = "image/jpg"; // Dateityp
		header("Content-type: $type"); // Welcher Typ soll geladen werden
		header("Content-Disposition: attachment; filename=bild.jpg"); // Name beim Client
		readfile($file); // Datei lesen		
	}
}
?>