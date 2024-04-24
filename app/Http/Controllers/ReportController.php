<?php

namespace App\Http\Controllers;

use App\Models\ExpensesFromEquipment;
use App\Models\IncomeFromEquipment;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $Expenses=ExpensesFromEquipment::select('*')->get();
        $data=IncomeFromEquipment::select('*')->get();
      
       


        return view('frontend.report.incomereport',compact('Expenses','data'));
    
    }
    public function showIncomeReport(IncomeFromEquipment $incomeFromEquipment)
    {
        $data = DB::table('income_from_equipment')
            ->join('customers', 'income_from_equipment.customer_id', '=', 'customers.id')
            ->join('equipment', 'income_from_equipment.equipment_id', '=', 'equipment.id')
            ->select('income_from_equipment.*', 'equipment.equipment_name','customers.customer_name')
            ->get();
            return view('frontend.report.incomereport', compact('data'));
    }
    public function getPrimaryReport(Request $request)
    {
        $category = DB::table('item_categories')->select('*')->get();
        $category_id = $request->input('category_id');
        $report_date = $request->input('report_date');

        
        $query = "
SELECT
    primaryInventoryStore.inventoryID,
    item_settings.item_name,
    item_categories.cat_name,
    item_settings.normal_rate,
    SUM(primaryInventoryStore.instock) AS inqty,
    SUM(primaryInventoryStore.outstock) AS ouqty,
    SUM(primaryInventoryStore.instock) - SUM(primaryInventoryStore.outstock) AS totalQty,
    (SUM(primaryInventoryStore.instock) - SUM(primaryInventoryStore.outstock)) / item_settings.equal_value AS equalValue,
    (SUM(primaryInventoryStore.instock) - SUM(primaryInventoryStore.outstock)) / item_settings.equal_value * item_settings.normal_rate AS totalAmount
FROM
    `primaryInventoryStore`
    INNER JOIN item_settings ON primaryInventoryStore.inventoryID = item_settings.id
    INNER JOIN item_categories ON item_settings.cat_id = item_categories.id
WHERE
    item_settings.cancel = 0 AND primaryInventoryStore.cancel = 0";

        $bindings = [];

        if (!empty($category_id) || $category_id === '0') {
            $query .= " AND item_categories.id = ?";
            $bindings[] = $category_id;
        }

        if (!empty($report_date)) {
            $query .= " AND DATE(primaryInventoryStore.created_at) = ?";
            $bindings[] = $report_date;
        }

        $query .= " GROUP BY primaryInventoryStore.inventoryID, item_settings.item_name, item_categories.cat_name, item_settings.normal_rate, item_settings.equal_value";

        $reports = \DB::select($query, $bindings);

        return view('frontend.report.primarystockreport', compact('reports', 'category'));

    }
    public function getSecondaryReport(Request $request)
    {
        $category = DB::table('item_categories')->select('*')->get();
        $category_id = $request->input('category_id');
        $report_date = $request->input('report_date');

        $query = "
    SELECT
        secondary_inventory_store.inventoryID,
        item_settings.item_name,
        item_categories.cat_name,
        item_settings.normal_rate,
        SUM(secondary_inventory_store.instock) AS instock,
        SUM(secondary_inventory_store.outstock) AS outstock,
        SUM(secondary_inventory_store.instock) - SUM(secondary_inventory_store.outstock) AS totalQty,
        (SUM(secondary_inventory_store.instock) - SUM(secondary_inventory_store.outstock)) / item_settings.equal_value AS equalValue,
        (SUM(secondary_inventory_store.instock) - SUM(secondary_inventory_store.outstock)) / item_settings.equal_value * item_settings.normal_rate AS totalAmount
    FROM
        `secondary_inventory_store`
        INNER JOIN item_settings ON secondary_inventory_store.inventoryID = item_settings.id
        INNER JOIN item_categories ON item_settings.cat_id = item_categories.id
    WHERE
        item_settings.cancel = 0 AND secondary_inventory_store.cancel = 0";

        $bindings = [];

        if (!empty($category_id) || $category_id === '0') {
            $query .= " AND item_categories.id = ?";
            $bindings[] = $category_id;
        }

        if (!empty($report_date)) {
            $query .= " AND DATE(secondary_inventory_store.created_at) = ?";
            $bindings[] = $report_date;
        }

        $query .= " GROUP BY secondary_inventory_store.inventoryID, item_settings.item_name, item_categories.cat_name, item_settings.normal_rate, item_settings.equal_value";

        $reports = \DB::select($query, $bindings);

        return view('frontend.report.secondarystockreport', compact('reports', 'category'));

    }
   

}
