<?php

namespace Acme;

use Auth;
use DB;

class SalesReporterWithComments
{
    public function between($startDate, $endDate)
    {
        // Perform authentication
        // Why should this class be interested in the
        // authenticated user?
        // This is application logic!
/*        if (! Auth::check()) { // doesn't belong here. It should be moved to a controller.
            throw new \Exception('Authentication required for reporting!');
        }
*/

        // get sales from db
        $sales = $this->queryDBForSales($startDate, $endDate);

        // return results
        return $this->format($sales);
    }

    protected function queryDBForSales($startDate, $endDate)
    {
        // If we would update our persistence layer in the future,
        // we would have to do changes here too. <=> reason to change!
        return DB::table('sales')->whereBetween('created_at', [$startDate, $endDate])->sum('charge') / 100;
    }

    protected function format($sales)
    {
        // If we changed the way we want to format the output,
        // we would have to make changes here. <=> reason to change!
        return '<h1>Sales: ' . $sales . '</h1>';
    }
}
