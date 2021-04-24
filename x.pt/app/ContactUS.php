<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class ContactUS extends Model
{
 
	public $table = 'create_contact_us_table';
	 
	public $fillable = ['nome','email','contacto','mensagem'];
 
}