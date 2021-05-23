<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusColor()
    {
        switch ($this->status) {
            case 'Menunggu Konfirmasi':
                return 'warning';
                break;
            case 'Telah Dikonfirmasi':
                return 'success';
                break;
            default:
                return 'danger';
                break;
        }
    }

    public function statusMessage()
    {
        switch ($this->status) {
            case 'Menunggu Konfirmasi':
                return 'Harap menunggu Admin untuk melakukan konfirmasi terhadap pesanan anda.';
                break;
            case 'Telah Dikonfirmasi':
                // return 'Pesanan anda telah dikonfirmasi dan akan segera dikirmkan. Harap hubungi WA 082822733372 untuk info pengiriman.';
                return 'Pesanan anda telah dikonfirmasi, pihak Paragon akan mengirim WA kepada anda untuk proses pembayaran dan pengiriman.';
                break;
            default:
                return 'Pesanan anda telah dibatalkan oleh Admin.';
                break;
        }
    }
}
