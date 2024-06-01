<?php

namespace App\Http\Controllers;

use App\Models\Permissionuser;
use Illuminate\Http\Request;
use App\Models\Receive_order;
use App\Models\Receive_order_item;
use App\Models\Product;
use App\Models\Purchase_order;
use App\Models\Purchase_invoice;
use App\Models\Purchase_invoice_item;
use App\Models\Purchase_order_item;
use App\Models\Roleshaspermission;
use App\Models\Roleuser;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Userhaserole;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AjaxController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function setrolepermission(Request $request)
    {
        $datarequest = $request->all();
        if ($request->checked == 'true') {
            $checkRolePermission = Roleshaspermission::where('role_id', $request->roleId)->where('permission_id', $request->permissionId)->get();
            if ($checkRolePermission->isEmpty()) {
                try {
                    $permission = Permission::find($request->permissionId);
                    $permission->assignRole($request->roleId);
                    return response()->json(['message' => 'Roles and Permission has created successfully', 'datarequest' => $permission]);
                } catch (\Throwable $th) {
                    return response()->json(['message' => 'Failed to add data', 'datarequest' => $th]);
                }
            } else {
                return response()->json(['message' => 'Roles and Permission has exist', 'data' => $datarequest, 'datarequest' => $datarequest]);
            }
        } else {
            try {
                $permission = Permission::find($request->permissionId);
                $permission->removeRole($request->roleId);

                return response()->json(['message' => 'Roles and Permission has deleted successfully', 'data' => $permission, 'datarequest' => $datarequest]);
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Failed to delete data', 'data' => $permission, 'datarequest' => $datarequest]);
            }
        }
    }
    public function getpurchaseorder(Request $request)
    {
        if (Auth::user()->hasRole('superadmin')) {
            $search = $request->search;
            if ($search == '') {
                $purchaseorder = Purchase_order::select("id", "po_number")
                    ->where('fulfilled', '=', 'false')
                    ->limit(6)
                    ->get();
            } elseif ($search != '') {
                $purchaseorder =  Purchase_order::select("id", "po_number")
                    ->where('status', '=', 'finish', 'and', 'po_number', 'LIKE', "%$search%")
                    ->where('fulfilled', '=', 'false')
                    ->limit(6)
                    ->get();
            } else {
                $purchaseorder =  Purchase_order::select("id", "po_number")
                    ->where('status', '=', 'finish', 'and', 'po_number', 'LIKE', "%$search%")
                    ->where('fulfilled', '=', 'false')
                    ->limit(6)
                    ->get();
            }
            $response = array();
            foreach ($purchaseorder as $purchaseorders) {
                $response[] = array(
                    "id" => $purchaseorders->id,
                    "text" => $purchaseorders->po_number
                );
            }
            return json_encode($response);
            exit;
        } else {
            $search = $request->search;
            if ($search == '') {
                $purchaseorder = Purchase_order::with('garageid')->select("id", "po_number")
                    ->where('fulfilled', '=', 'false')
                    ->whereRelation('garageid', 'id', Auth()->user()->garage_id)
                    ->limit(6)
                    ->get();
            } elseif ($search != '') {
                $purchaseorder =  Purchase_order::with('garageid')->select("id", "po_number")
                    ->whereRelation('garageid', 'id', Auth()->user()->garage_id)
                    ->where('status', '=', 'finish', 'and', 'po_number', 'LIKE', "%$search%")
                    ->where('fulfilled', '=', 'false')
                    ->limit(6)
                    ->get();
            } else {
                $purchaseorder =  Purchase_order::with('garageid')->select("id", "po_number")
                    ->whereRelation('garageid', 'id', Auth()->user()->garage_id)
                    ->where('status', '=', 'finish', 'and', 'po_number', 'LIKE', "%$search%")
                    ->where('fulfilled', '=', 'false')
                    ->limit(6)
                    ->get();
            }
            $response = array();
            foreach ($purchaseorder as $purchaseorders) {
                $response[] = array(
                    "id" => $purchaseorders->id,
                    "text" => $purchaseorders->po_number
                );
            }
            return json_encode($response);
            exit;
        }
    }
    public function getpodetail($id)
    {
        $datadetails = Purchase_invoice::with("puchaseorderid", "supplierid", "garageid")
            ->where("purchase_order_id", $id)
            ->first();
        $datadetailsitem = Purchase_order_item::with("productid")
            ->where('purchase_order_id', $datadetails->purchase_order_id)->get();


        $response = array();
        foreach ($datadetailsitem as $datadetailsitems) {
            $response[] = array(
                "id" => $datadetailsitems->id,
                "productname" => $datadetailsitems->productid->product_name,
                "productcode" => $datadetailsitems->productid->product_code,
                "quantity" => $datadetailsitems->quantity,
                "price" => $datadetailsitems->price,
                "total" => $datadetailsitems->subtotal,
            );
        }
        $variable = array(
            'purchaseorder' => $datadetails->puchaseorderid->po_number,
            'purchaser' => $datadetails->createdby->name,
            'orderdate' => date_format($datadetails->puchaseorderid->created_at, "yy-m-d"),
            'purchaseinvoice' => $datadetails->pi_number,
            'invoicedate' => date_format($datadetails->created_at, "yy-m-d"),
            'supplier' => $datadetails->supplierid->supplier_name,
            'garage' => $datadetails->garageid->garagename,
            'total' => $datadetails->puchaseorderid->total,
            'notes' => $datadetails->puchaseorderid->note,
            'response' => $response,
        );
        return json_encode($variable);
        exit;
    }
    public function getproduct(Request $request)
    {
        $search = $request->search;
        $arrayid = $request->arrayid;
        if ($search == '') {
            $products = Product::select("id", "product_name")
                ->limit(6)
                ->get();
        } elseif ($search != '' && $arrayid != null) {
            $products =  Product::select("id", "product_name")
                ->where('product_name', 'LIKE', "%$search%")
                ->whereNotIn('id', $arrayid)
                ->limit(6)
                ->get();
        } else {
            $products =  Product::select("id", "product_name", "product_code", "selling_price")
                ->where('product_name', 'LIKE', "%$search%")
                ->limit(6)
                ->get();
        }
        $response = array();
        foreach ($products as $productss) {
            $response[] = array(
                "id" => $productss->id,
                "text" => $productss->product_name,
                "product_code" => $productss->product_code,
                "selling_price" => $productss->selling_price
            );
        }
        return json_encode($response);
        exit;
    }
    public function getusers(Request $request)
    {
        $search = $request->search;
        $arrayid = $request->arrayid;
        if ($search == '') {
            $users = User::select("id", "email")
                ->limit(6)
                ->get();
        } elseif ($search != '' && $arrayid != null) {
            $users =  User::select("id", "email")
                ->where('email', 'LIKE', "%$search%")
                ->whereNotIn('id', $arrayid)
                ->limit(6)
                ->get();
        } else {
            $users =  User::select("id", "email")
                ->where('email', 'LIKE', "%$search%")
                ->limit(6)
                ->get();
        }
        $response = array();
        foreach ($users as $user) {
            $response[] = array(
                "id" => $user->id,
                "text" => $user->email
            );
        }
        return json_encode($response);
        exit;
    }
    public function getproductreceive(Request $request)
    {
        $search = $request->search;
        $arrayid = $request->arrayid;
        $purchaseorder_id = $request->po_number;
        $po_items = Purchase_order_item::select('product_id')
            ->where('purchase_order_id', $purchaseorder_id)
            ->get();
        if ($search == '') {
            $products = Product::select("id", "product_name")
                ->wherein('id', $po_items)
                ->limit(10)
                ->get();
        } elseif ($search != '' && $arrayid != null) {
            $products =  Product::select("id", "product_name")
                ->where('product_name', 'LIKE', "%$search%")
                ->whereNotIn('id', $arrayid)
                ->wherein('id', $po_items)
                ->limit(6)
                ->get();
        } else {
            $products =  Product::select("id", "product_name")
                ->where('product_name', 'LIKE', "%$search%")
                ->wherein('id', $po_items)
                ->limit(6)
                ->get();
        }
        $response = array();
        foreach ($products as $productss) {
            $response[] = array(
                "id" => $productss->id,
                "text" => $productss->product_name
            );
        }
        return json_encode($response);
        exit;
    }
    public function getproductdetail($id)
    {
        $datadetails = Product::where("id", $id)->pluck("product_code", "id");
        return json_encode($datadetails);
    }
    public function getstockitem(Request $request)
    {
        $products = Product::select('products.product_code', 'b.stock')
            ->leftJoin('product_garage_stocks as b', 'b.product_id', '=', 'products.id')
            ->leftJoin('garages as c', 'c.id', '=', 'b.garage_id')
            ->where('c.id', $request->garageid)
            ->where('products.id', $request->id)
            ->first();

        if ($products == null) {
            $stock = 0;
            $productcode = Product::select('product_code')
                ->where('id', $request->id)
                ->first();
            $variable = array(
                "product_code" => $productcode->product_code,
                "stock" => $stock,
            );
            return json_encode($variable);
        } else {
            $variable = array(
                "product_code" => $products->product_code,
                "stock" => $products->stock,
            );
            return json_encode($variable);
        }
    }
}
