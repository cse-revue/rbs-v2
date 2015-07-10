<?php namespace rbs\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\stdClass;

class Production extends Model {

    // TODO: Refactor the SQL
    public static function get_ticket_totals($id) {
        $basesql = "select count(bs.id) from booking b, bookedseat bs where bs.booking = b.id and b.performance = perf.id";
        $endsql = "group by b.performance";
        $sql = "SELECT ";
        $sql .= "($basesql and bs.status = 1) bookedseats,";
        $sql .= "($basesql and bs.status = 3) confirmedseats,";
        $sql .= "($basesql and bs.status < 8 and bs.status > 3 or bs.status = 11) paidseats,";
        $sql .= "($basesql and bs.status = 8) ppseats,";
        $sql .= "($basesql and bs.status = 10) vipseats,";
        $sql .= "perf.id, perf.title from performance perf where perf.production = $id";
        $tt = DB::select(DB::raw($sql));
        $tt["Total"] = (object) array("confirmedseats" => 0, "paidseats" => 0, "vipseats" => 0, "ppseats" => 0, "bookedseats" => 0, "title" => "Total");
        $priceclass_basesql = "select p.name, count(bs.price) as count from booking b, bookedseat bs, price p, performance perf where bs.booking = b.id AND b.performance = perf.id AND perf.production = $id AND p.id = bs.price";
        $priceclass_confirmed = "$priceclass_basesql AND bs.status > 1 AND bs.status != 9 group by p.name";
        $priceclass_booked = "$priceclass_basesql AND bs.status = 1 group by p.name";
        $confirmed = DB::select(DB::raw($priceclass_confirmed));
        $booked = DB::select(DB::raw($priceclass_booked));
        $tt["Total"]->confirmed = $confirmed;
        $tt["Total"]->booked = $booked;
        foreach ($tt as $t) {
            if($t->title != "Total") {
                $tt["Total"]->bookedseats += $t->bookedseats;
                $tt["Total"]->confirmedseats += $t->confirmedseats;
                $tt["Total"]->paidseats += $t->paidseats;
                $tt["Total"]->vipseats += $t->vipseats;
                $tt["Total"]->ppseats += $t->ppseats;
            }
        }
        return $tt;
    }
}
