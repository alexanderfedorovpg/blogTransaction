<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class dataModel extends Model {
		protected $fillable = [ 'card_number', 'date', 'volume', 'service', 'address_id' ];
		protected $table = 'data';
	}
