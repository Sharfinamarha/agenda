<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasFactory;
	public $table = "events";

	protected $fillable = [
		'title', 'location', 'peserta', 'penyelenggara', 'jam', 'start', 'end', 'user'
	];
}

?>
