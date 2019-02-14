<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function books(){
        return $this->belongsToMany('App\Book')->withPivot('quantity');;
       }
    // Kode di atas merupakan definisi dynamic property di model Order penamaannya adalah menggunakan
    // format get dan diakhiri Attribute. Seperti contoh di atas nama dari functionnya adalah
    // getTotalQuantityAttribute sehingga kita bisa mengakses dengan cara $order->totalQuantity
    // tanpa get maupun Attribute. Bisa dipahami kan? Dynamic property tersebut kalo dilihat di kodenya akan
    // menjumlahkan quantity yang diambil dari tabel pivot, hasil penjumlahan tersebut yang akan menjadi nilai dari
    // dynamic property
    public function getTotalQuantityAttribute(){
        $total_quantity = 0;
        
        foreach($this->books as $book){
        $total_quantity += $book->pivot->quantity;
        }
        return $total_quantity;
    }
       
}
