<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Formation;
use App\Models\FormationUnits;
use App\Models\FundCat;
use App\Models\FundSubCat;
use App\Models\IssueProducts;
use App\Models\Item;

use App\Models\Products;
use App\Models\Rank;
use App\Models\Store;
use App\Models\Unit;
use App\Models\WpnAllot;
use App\Models\WpnIssueRec;
use App\Models\WpnList;
use App\Models\WpnType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;


use Session;
use App\Models\User;
use App\Models\ProductCat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\AssignAccessory;
use App\Models\AssignCard;
use App\Models\AssignProduct;
use App\Models\Employee;

class AdminController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

// //**********************manage product_cat *************** */


// public function manage_product_cat(Request $request)
// {   
//     $veh_cat = ProductCat::paginate(20);
//     return view('admin.dashboard.manage_veh',compact('veh_cat'));
// }

// public function add_product_cat(Request $request)
// {
//     $category = new ProductCat();
//     $category->p_cat_name = $request->input('item_category_name');
//     $category->save();
//     // Redirect with success message
//     return redirect()->back()->with('success', 'Data Added Successfully');
// }


// public function delete_product_cat(Request $request){
//     $request->validate([
//         'del_id' => 'required|integer',
//     ]);
//     $id = $request->input('del_id');
//     // dd($id);
//     $category = ProductCat::find($id);
//     $category->delete();
//     return redirect()->back()->with('success', 'Category Deleted'); 
// }

// public function update_product_cat(Request $request){
//     $request->validate([
//         'cat_id' => 'required|exists:product_cat,id',
//         'category_name' => 'required|string|max:255',
//     ]);

//     $category = ProductCat::find($request->input('cat_id'));
//     $category->p_cat_name = $request->input('category_name'); 
//     $category->save();
//     return redirect()->route('manage.product.category')->with('success', 'Category Updated');
// }



//*************manage Rank *************** */

public function manage_rank(Request $request)
{   
    $veh_cat = Rank::orderBy('sort', 'asc')->paginate(100); 
    return view('admin.dashboard.manage_rank', compact('veh_cat'));
}

// public function add_rank(Request $request)
// {
//     $category = new Rank();
//     $category->rank_name = $request->input('item_category_name');
//     $category->sort = $request->input('sort');
//     $category->save();
//     // Redirect with success message
//     return redirect()->back()->with('success', 'Rank Added Successfully');
// }

public function add_rank(Request $request)
{
    // Validate the input
    $request->validate([
        'item_category_name' => 'required|string|max:255',
        'sort' => 'required|integer|unique:rank,sort', // Ensure unique sort value
    ], [
        'sort.unique' => 'Sort order already exists.', // Custom error message
    ]);

    // Create new rank entry
    Rank::create([
        'rank_name' => $request->input('item_category_name'),
        'sort' => $request->input('sort'),
    ]);

    // Redirect with success message
    return redirect()->back()->with('success', 'Rank Added Successfully');
}



public function delete_rank(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $category = Rank::find($id);
    $category->delete();
    return redirect()->back()->with('success', 'Rank Deleted'); 
}

// public function update_rank(Request $request){
//     $request->validate([
//         'cat_id' => 'required|exists:rank,id',
//         'category_name' => 'required|string|max:255',
//         'sort' => 'required',
//     ]);

//     $category = Rank::find($request->input('cat_id'));
//     $category->rank_name = $request->input('category_name'); 
//     $category->sort = $request->input('edit_sort');
//     $category->save();
//     return redirect()->route('manage.rank')->with('success', 'Rank Updated');
// }

public function update_rank(Request $request)
{
    $request->validate([
        'cat_id' => 'required|exists:rank,id',
        'category_name' => 'required|string|max:255',
        'edit_sort' => 'required|integer|unique:rank,sort,' . $request->cat_id, // Ignore current record
    ], [
        'edit_sort.unique' => 'Sort order already exists.', // Custom error message
    ]);

    // Find the category and update
    $category = Rank::find($request->input('cat_id'));
    if (!$category) {
        return redirect()->route('manage.rank')->with('error', 'Rank not found.');
    }

    $category->rank_name = $request->input('category_name'); 
    $category->sort = $request->input('edit_sort');
    $category->save();

    return redirect()->route('manage.rank')->with('success', 'Rank Updated Successfully');
}


//*************manage Company *************** */

public function manage_company(Request $request)
{   
    $veh_cat = Company::paginate(20);
    return view('admin.dashboard.manage_company',compact('veh_cat'));
}

public function add_company(Request $request)
{
    $category = new Company();
    $category->company_name = $request->input('item_category_name');
    $category->save();
    // Redirect with success message
    return redirect()->back()->with('success', 'company Added Successfully');
}


public function delete_company(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $category = Company::find($id);
    $category->delete();
    return redirect()->back()->with('success', 'company Deleted'); 
}

public function update_company(Request $request){
    $request->validate([
        'cat_id' => 'required|exists:companys,id',
        'category_name' => 'required|string|max:255',
    ]);

    $category = Company::find($request->input('cat_id'));
    $category->company_name = $request->input('category_name'); 
    $category->save();
    return redirect()->route('manage.company')->with('success', 'company Updated');
}


//*************manage Wpn Type *************** */

public function manage_wpntype(Request $request)
{   
    $veh_cat = WpnType::paginate(20);
    return view('admin.dashboard.manage_wpntype',compact('veh_cat'));
}

public function add_wpntype(Request $request)
{
    $category = new WpnType();
    $category->type = $request->input('item_category_name');
    $category->qty = $request->input('qty'); 
    $category->save();
    // Redirect with success message
    return redirect()->back()->with('success', 'Wpn type Added Successfully');
}


public function delete_wpntype(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $category = WpnType::find($id);
    $category->delete();
    return redirect()->back()->with('success', 'Wpn type Deleted'); 
}

public function update_wpntype(Request $request){
    $request->validate([
        'cat_id' => 'required|exists:wpn_types,id',
        'category_name' => 'required|string|max:255',
    ]);

    $category = WpnType::find($request->input('cat_id'));
    $category->type = $request->input('category_name'); 
    $category->qty = $request->input('edit_qty'); 
    $category->save();
    return redirect()->route('manage.wpntype')->with('success', 'wpntype Updated');
}



// ************manage Unit*************//
public function manage_unit(Request $request)
{   
    $unit = Unit::paginate(20);
    return view('admin.dashboard.manage_unit',compact('unit'));
}

public function add_unit(Request $request)
{
    $unit = new Unit();
    $unit->unit_name = $request->input('item_unit_name');
    $unit->save();

    // Redirect with success message
    return redirect()->back()->with('success', 'Data Added Successfully');
}


public function delete_unit(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $unit = Unit::find($id);
    $unit->delete();
    return redirect()->back()->with('success', 'unit Deleted'); 
}

public function update_unit(Request $request){
    $request->validate([
        'cat_id' => 'required|exists:units,id',
        'category_name' => 'required|string|max:255',
    ]);

    $unit = Unit::find($request->input('cat_id'));
    $unit->unit_name = $request->input('category_name'); 
    $unit->save();
    return redirect()->route('manage.unit')->with('success', 'unit Updated');
}

//****************Add Indl ****************//
public function add_Indl(Request $request){
    $rank = Rank::get();
    $unit = Unit::get();
    $company = Company::get();
    return view('admin.dashboard.add_indl',compact('rank','unit','company'));
}

// public function add_indlAction(Request $request){
//         // $userId = Auth::id();
//         $capture_image = $request->image;
//         $imagePath = ''; // Unified variable for storing the path

//         if ($capture_image) {
//             // Handle base64 image
//             $img = $capture_image;
//             $folderPath = "public/images/"; // Save to storage/app/public/images
//             $image_parts = explode(";base64,", $img);
//             $image_type_aux = explode("image/", $image_parts[0]);
//             $image_type = $image_type_aux[1]; // Example: png
//             $image_base64 = base64_decode($image_parts[1]);
//             $fileName = uniqid() . '.' . $image_type;

//             // Save the image in the same folder
//             $storedPath = $folderPath . $fileName;
//             \Storage::put($storedPath, $image_base64);

//             // Generate a public URL for the image
//             $imagePath = \Storage::url($storedPath);
//         }

//         if ($request->file('file')) {
//             // Handle file upload
//             $image = $request->file('file');
//             $storedPath = $image->store('images', 'public'); // Save to storage/app/public/images
//             $imagePath = \Storage::url($storedPath);
//         }
//         // dd($request->emp_id);
//         // Save to the database
//         Employee::create([
//             'emp_id' => $request->emp_id,
//             'rank_id' => $request->rank_id,
//             'name' => $request->name,
//             'unit_id' => $request->unit_id,
//             'company_id' => $request->company_id,
//             'photo' => $imagePath, // Unified path for both methods
//         ]);

        
//     return redirect()->back()->with('success','employee added successfully');
   
// }

public function add_indlAction(Request $request) {
    // Check if emp_id already exists
    $existingEmployee = Employee::where('emp_id', $request->emp_id)->first();
    
    if ($existingEmployee) {
        return redirect()->back()->with('error', 'Indl ID already exists.');
    }

    $capture_image = $request->image;
    $imagePath = ''; // Unified variable for storing the path

    if ($capture_image) {
        // Handle base64 image
        $img = $capture_image;
        $folderPath = "/public/images/"; // Save to storage/app/public/images
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1]; // Example: png
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.' . $image_type;

        // Save the image in the same folder
        $storedPath = $folderPath . $fileName;
        \Storage::put($storedPath, $image_base64);

        // Generate a public URL for the image
        $imagePath = $storedPath;
        // dd($imagePath,$storedPath);
    }

    if ($request->file('file')) {
        // Handle file upload
        $image = $request->file('file');
        $storedPath = $image->store('images', 'public'); // Save to storage/app/public/images
        $imagePath = \Storage::url($storedPath);
        
    }

    // Save to the database
    Employee::create([
        'emp_id' => $request->emp_id,
        'rank_id' => $request->rank_id,
        'name' => $request->name,
        'unit_id' => $request->unit_id,
        'company_id' => $request->company_id,
        'photo' => $imagePath, // Unified path for both methods
    ]);

    return redirect()->route('indl.list')->with('success', 'Indl added successfully');
}



public function edit_Indl(Request $request,$id){
    $employee = Employee::where('id',$id)->first();
    $rank = Rank::get();
    $unit = Unit::get();
    $company = Company::get();
    return view('admin.dashboard.edit_indl',compact('rank','unit','company','employee'));
}


public function edit_indlAction(Request $request, $id)
{
    // Find employee record
    $employee = Employee::findOrFail($id);
    // dd($employee);
    if ($request->isMethod('put')) {
        $capture_image = $request->image;
        $imagePath = $employee->photo; // Default to existing photo

        if ($capture_image) {
            // Handle base64 image
            $img = $capture_image;
            $folderPath = "/public/images/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.' . $image_type;

            // Save the new image
            $storedPath = $folderPath . $fileName;
            \Storage::put($storedPath, $image_base64);
            $imagePath = $storedPath;
        }

        if ($request->file('file')) {
            // Handle file upload
            $image = $request->file('file');
            $storedPath = $image->store('images', 'public');
            $imagePath = \Storage::url($storedPath);
        }

        // Update employee record
        $employee->update([
            'rank_id' => $request->rank_id,
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'company_id' => $request->company_id,
            'photo' => $imagePath,
        ]);

        return redirect()->route('indl.list')->with('success', 'Indl updated successfully');
    }

    return redirect()->back()->with('error','There is an Error');
}




// public function indl_list(Request $request)
// {
//     // Initialize query
//     $query = Employee::with(['rank', 'unit', 'company']);

//     // Capture filter inputs
//     $filters = $request->only(['emp_id', 'name', 'rank', 'unit', 'company', 'status']);

//     // Apply filters
//     if (!empty($filters['emp_id'])) {
//         $query->where('emp_id', 'like', '%' . $filters['emp_id'] . '%');
//     }

//     if (!empty($filters['name'])) {
//         $query->where('name', 'like', '%' . $filters['name'] . '%');
//     }

//     if (!empty($filters['rank'])) {
//         $query->where('rank_id', $filters['rank']);
//     }

//     if (!empty($filters['unit'])) {
//         $query->where('unit_id', $filters['unit']);
//     }

//     if (!empty($filters['company'])) {
//         $query->where('company_id', $filters['company']);
//     }

//     if (!empty($filters['status'])) {
//         $query->where('status', $filters['status']);
//     }
//     $totalRecords = $query->count();
//     // Paginate with filters
//     $employee = $query->orderby('id','DESC')->paginate(50)->appends($filters);

//     // Fetch filter options
//     $ranks = Rank::all();
//     $units = Unit::all();
//     $companies = Company::all();

//     // Return view with data
//     return view('admin.dashboard.indl_list', compact('employee', 'ranks', 'units', 'companies', 'filters','totalRecords'));
// }

public function indl_allot_list(Request $request)
{
    // Initialize query
    $query = Employee::with(['rank', 'unit', 'company']);

    // Capture filter inputs
    $filters = $request->only(['emp_id', 'name', 'rank', 'unit', 'company', 'status']);

    // Apply filters
    if (!empty($filters['emp_id'])) {
        $query->where('emp_id', 'like', '%' . $filters['emp_id'] . '%');
    }

    if (!empty($filters['name'])) {
        $query->where('name', 'like', '%' . $filters['name'] . '%');
    }

    if (!empty($filters['rank'])) {
        $query->where('rank_id', $filters['rank']);
    }

    if (!empty($filters['unit'])) {
        $query->where('unit_id', $filters['unit']);
    }

    if (!empty($filters['company'])) {
        $query->where('company_id', $filters['company']);
    }

    if (!empty($filters['status'])) {
        $query->where('status', $filters['status']);
    }
    $totalRecords = $query->count();
    // Paginate with filters
    $employee = $query->paginate(50)->appends($filters);

    // Fetch filter options
    $ranks = Rank::all();
    $units = Unit::all();
    $companies = Company::all();

    // Return view with data
    return view('admin.dashboard.wpn_allot_list', compact('employee', 'ranks', 'units', 'companies', 'filters','totalRecords'));
}

public function delete_indl(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    $emp = Employee::find($id);
    $emp->delete();
    return redirect()->back()->with('success', 'Employee Deleted'); 
}





// ************** Add Wpn *********************//
public function add_wpn(Request $request){
    $wpntype = WpnType::get();
    $company = Company::get();
    return view('admin.dashboard.add_wpn',compact('company','wpntype'));
}


// public function add_wpnAction(Request $request){
//     // $userId = Auth::id();

//     WpnList::create([
//         'wpn_tag' => $request->wpn_tag,
//         'wpn_type' => $request->wpn_type,
//         'regd_no' => $request->regd_no,
//         'butt_no' => $request->butt_no,
//         'company_id' => $request->company_id,
//         'remarks' => $request->remarks,
//         'servicability' => $request->service,
//     ]);
// return redirect()->back()->with('success','Weapon added successfully');
// }

public function add_wpnAction(Request $request)
{
    // Validate input
    $request->validate([
        'wpn_tag' => 'required|string|max:255',
        'wpn_type' => 'required|string|max:255',
        'regd_no' => 'required|string|max:255',
        'butt_no' => 'nullable|string|max:255',
        'company_id' => 'required|integer',
        'remarks' => 'nullable|string',
        'service' => 'required|string|max:255',
    ]);


    $existingWeapon = WpnList::where('wpn_tag', $request->wpn_tag)
        ->orWhere('regd_no', $request->regd_no)
        ->first();

    if ($existingWeapon) {
        if ($existingWeapon->wpn_tag == $request->wpn_tag) {
            return redirect()->back()->with('error', 'Weapon Tag already exists.');
        }
        if ($existingWeapon->regd_no == $request->regd_no) {
            return redirect()->back()->with('error', 'Registration Number already exists.');
        }
    }
    // Create new weapon entry
    WpnList::create([
        'wpn_tag' => $request->wpn_tag,
        'wpn_type' => $request->wpn_type,
        'regd_no' => $request->regd_no,
        'butt_no' => $request->butt_no,
        'company_id' => $request->company_id,
        'remarks' => $request->remarks,
        'servicability' => $request->service,
    ]);
    return redirect()->route('wpn.list')->with('success', 'Weapon added successfully');
}


// public function wpn_list(Request $request)
// {
//     $query = WpnList::with(['wpn_types', 'company']);

//     // Capture filter inputs
//     $filters = $request->only(['wpn_tag', 'wpn_type', 'regd_no', 'butt_no', 'company', 'service']);

//     // Apply filters
//     if (!empty($filters['wpn_tag'])) {
//         $query->where('wpn_tag',$filters['wpn_tag']);
//     }

//     if (!empty($filters['wpn_type'])) {
//         $query->where('wpn_type',$filters['wpn_type']);
//     }

//     if (!empty($filters['regd_no'])) {
//         $query->where('regd_no', $filters['regd_no']);
//     }
//     if (!empty($filters['butt_no'])) {
//         $query->where('butt_no', $filters['butt_no']);
//     }

//     if (!empty($filters['company'])) {
//         $query->where('company_id', $filters['company']);
//     }


//     if (!empty($filters['service'])) {
//         $query->where('servicability', $filters['service']);
//     }

//     // Get the total number of records for the filtered query
//     $totalRecords = $query->count();

//     // Get weapons with pagination
//     $weapons = $query->paginate(50)->appends($filters);

//     $wpntype = WpnType::get();
//     $companies = Company::get();

//     // Pass total records to the view
//     return view('admin.dashboard.wpn_list', compact('weapons', 'wpntype', 'companies', 'filters', 'totalRecords'));
// }


public function delete_wpn(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    $emp = WpnList::find($id);
    $emp->delete();
    return redirect()->back()->with('success', 'Weapon Deleted'); 
}

public function edit_wpn($id){
    $wpn = WpnList::where('id',$id)->first();
    $wpntype = WpnType::get();
    $company = Company::get();
    return view('admin.dashboard.edit_wpn', compact('wpn','wpntype','company'));
} 

public function editWpnAction(Request $request, $id) {
    $validated = $request->validate([
        'wpn_tag' => 'required|string|max:255',
        'wpn_type' => 'required|exists:wpn_types,id',
        'regd_no' => 'required|string|max:255',
        'butt_no' => 'required|string|max:255',
        'company_id' => 'required|exists:companys,id',
        'remarks' => 'nullable|string',
        'service' => 'required|in:Yes,No',
    ]);

    $wpn = WpnList::findOrFail($id);
    $wpn->update($validated);

    return redirect()->route('wpn.list')->with('success', 'Weapon updated successfully!');
}



// *****************wpn allot *******************//
public function wpn_allot($id){
    $employee = Employee::with(['rank', 'unit', 'company'])->where('id',$id)->first();
    $wpn = WpnList::with(['wpn_types'])->get();
    $wpn_type = WpnType::get();
    $wpn_allot = WpnAllot::with(['wpns_list'])->where('emp_id',$employee->emp_id)->get();
    // dd($wpn_allot);
    return view('admin.dashboard.wpn_allot',compact('employee','wpn','wpn_allot','wpn_type'));
}




// **********************manage allot wpn **************//
public function addAllotWpn(Request $request)
{
    // Retrieve data from the request
    $empCode = $request->input('emp_id');
    $wpnId = $request->input('wpn_id');

    // Ensure emp_id and wpn_id are provided
    if (empty($empCode) || empty($wpnId)) {
        return response()->json(['status' => 4, 'message' => 'Employee code and weapon ID are required.']);
    }

    // Check if the weapon is already allotted to the employee
    $wpnAllot = WpnAllot::where('emp_id', $empCode)
        ->where('wpn_id', $wpnId)
        ->first();

    if ($wpnAllot) {
        return response()->json(['status' => 2, 'message' => 'Weapon already allotted to this employee.']);
    }

    // Prepare data for insertion
    $data = [
        'emp_id' => $empCode,
        'wpn_id' => $wpnId,
        'assign_type' => 'Secondary',
        'created_at' => now(), // Optionally include timestamps
        'updated_at' => now(),
    ];

    // Insert data into the database
    $result = WpnAllot::insert($data);

    // Return response based on result
    if ($result) {
        return response()->json(['status' => 1, 'message' => 'Weapon successfully allotted.']);
    } else {
        return response()->json(['status' => 0, 'message' => 'Failed to allot weapon.']);
    }
}


public function fetchWpnAllot(Request $request)
{
    $empCode = $request->input('emp_id');
    $type = $request->input('type');
    $buttNo = $request->input('butt_no');

    // Ensure emp_id is provided
    if (empty($empCode)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Employee code is required.',
        ]);
    }

    // Start query to get weapon allotment list
    $query = DB::table('wpn_allot')
        ->select(
            'wpn_allot.assign_type',
            'wpn_allot.id',
            'wpn_list.regd_no',
            'wpn_list.butt_no',
            'wpn_types.type'
        )
        ->join('wpn_list', 'wpn_list.id', '=', 'wpn_allot.wpn_id')
        ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
        ->where('wpn_allot.emp_id', $empCode);

    // Filter by type if provided
    if (!empty($type)) {
        $query->where('wpn_types.type', $type);
    }

    // Filter by butt_no if provided
    if (!empty($buttNo)) {
        $query->where('wpn_list.butt_no', 'like', '%' . $buttNo . '%');
    }

    $result = $query->get();

    // Check if any records are found and return response
    if ($result->isEmpty()) {
        return response()->json([
            'status' => 'success',
            'data' => [],
            'message' => 'No records found.',
        ]);
    } else {
        return response()->json([
            'status' => 'success',
            'data' => $result,
        ]);
    }
}


public function fetchWpnAvail(Request $request)
{
    $type = $request->input('type');
    $butt_no = $request->input('butt_no');

    // Build query to fetch weapon list
    $query = DB::table('wpn_list')
        ->select('wpn_list.regd_no', 'wpn_list.butt_no', 'wpn_types.type', 'wpn_list.wpn_tag', 'wpn_list.id','wpn_list.status')
        ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type');

    // Apply filters based on input
    if (!empty($type)) {
        $query->where('wpn_types.type', $type);
    }

    if (!empty($butt_no)) {
        $query->where('wpn_list.butt_no', 'like', '%' . $butt_no . '%');
    }

    $result = $query->get(); // Fetching the result

    // Return response based on records found
    if ($result->isEmpty()) {
        return response()->json([
            'status' => 'success',
            'data' => [],
            'message' => 'No records found.',
        ]);
    } else {
        return response()->json([
            'status' => 'success',
            'data' => $result,
        ]);
    }
}


// public function updateAsgnType(Request $request)
// {
//     $assignType = $request->input('asgn_type');
//     $id = $request->input('id');
//     $emp_code = $request->input('emp_code');

   
//     if (empty($assignType) || empty($id)) {
//         return response()->json([
//             'status' => 'error',
//             'message' => 'Both assign type and ID are required.',
//         ]);
//     }

//     // Update the record
//     $result = DB::table('wpn_allot')
//         ->where('id', $id)
//         ->update(['assign_type' => $assignType]);

//     // Check the update result
//     if ($result) {
//         return response()->json([
//             'status' => 'success',
//             'message' => 'Assign type updated successfully.',
//         ]);
//     } else {
//         return response()->json([
//             'status' => 'error',
//             'message' => 'Failed to update assign type.',
//         ]);
//     }
// }


public function updateAsgnType(Request $request)
{
    $assignType = $request->input('asgn_type');
    $id = $request->input('id');
    $emp_code = $request->input('emp_code');

    if (empty($assignType) || empty($id) || empty($emp_code)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Assign type, ID, and employee code are required.',
        ]);
    }

    // Check if the employee already has a Primary assignment
    $existingPrimary = DB::table('wpn_allot')
        ->where('emp_id', $emp_code)
        ->where('assign_type', 'Primary')
        ->exists();

    if ($assignType === 'Primary' && $existingPrimary) {
        // If a Primary already exists, force the update to Secondary
        $assignType = 'Secondary';
    }

    // Update the record
    $result = DB::table('wpn_allot')
        ->where('id', $id)
        ->update(['assign_type' => $assignType]);

    if ($result) {
        return response()->json([
            'status' => 'success',
            'message' => 'Assign type updated successfully.',
            'new_assign_type' => $assignType // Send back the updated type
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update assign type.',
        ]);
    }
}



public function delAllotWpn(Request $request)
{
    $id = $request->input('id');

    if (empty($id)) {
        return response()->json(4); // Invalid input
    }

    $result = DB::table('wpn_allot')->where('id', $id)->delete();

    if ($result) {
        return response()->json(1); // Success
    } else {
        return response()->json(0); // Failure
    }
}


// ********************wpn issue*****************//
public function fetchWpnAlloted(Request $request)
{
    $emp_id = $request->input('emp_id');
    // Ensure emp_id is provided
    if (empty($emp_id)) {
        return response()->json(['status' => 'error', 'message' => 'Employee code is required.']);
    }

    // Build the query to get weapon allotment list
    $query = DB::table('wpn_allot')
        ->select(
            'wpn_allot.assign_type',
            'wpn_list.wpn_tag',
            'wpn_allot.id',
            'wpn_list.regd_no',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.status'
        )
        ->join('wpn_list', 'wpn_list.id', '=', 'wpn_allot.wpn_id')
        ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
        ->where('wpn_allot.emp_id', $emp_id);

    // Check if type is provided and filter by type
    if ($request->filled('type')) {
        $query->where('wpn_types.type', $request->input('type'));
    }

    // Check if butt_no is provided and filter by it
    if ($request->filled('butt_no')) {
        $query->where('wpn_list.butt_no', 'like', '%' . $request->input('butt_no') . '%');
    }

    $result = $query->get(); // Fetching the result

    // Check if any records are found and return response
    if ($result->isEmpty()) {
        return response()->json(['status' => 'success', 'data' => [], 'message' => 'No records found.']);
    }

    return response()->json(['status' => 'success', 'data' => $result]);
}


// public function fetchWpnBarcodeSelected(Request $request)
// {
//     $barcode = $request->input('barcode');
//     $purpose = $request->input('purpose');
//     $emp_id = $request->input('emp_id');

//     if (!is_array($barcode)) {
//         $barcode = [$barcode];
//     }

//     $query =WpnList::select(
//             'wpn_list.regd_no',
//             'wpn_allot.emp_id',
//             'wpn_list.butt_no',
//             'wpn_types.type',
//             'wpn_list.wpn_tag',
//             'wpn_list.id',
//             'wpn_list.status'
//         )
//         ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
//         ->leftJoin('wpn_allot', 'wpn_allot.wpn_id', '=', 'wpn_list.id')
//         ->where('wpn_list.status', 0)
//         ->where(function ($query) use ($barcode) {
//             $query->whereIn('wpn_list.wpn_tag', $barcode)
//                   ->orWhereIn('wpn_list.butt_no', $barcode);
//         });

//     if (!empty($purpose)) {
//         $query->where('wpn_allot.emp_id', $emp_id);
//     }

//     $query->groupBy('wpn_list.id');

//     $result = $query->get();

//     if ($result->isEmpty()) {
//         return response()->json(['status' => 'success', 'data' => [], 'message' => 'No records found.']);
//     }

//     return response()->json($result);
// }

public function fetchWpnBarcodeSelected(Request $request)
{
    $barcode = $request->input('barcode');
    $purpose = $request->input('purpose');
    $emp_id = $request->input('emp_id');

    // $barcode = $validated['barcode'];
    // $purpose = $validated['purpose'] ?? null;
    // $emp_id = $validated['emp_id'] ?? null;

    try {
        $query = WpnList::select(
                'wpn_list.regd_no',
                'wpn_allot.emp_id',
                'wpn_list.butt_no',
                'wpn_types.type',
                'wpn_list.wpn_tag',
                'wpn_list.id',
                'wpn_list.status'
            )
            ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
            ->leftJoin('wpn_allot', 'wpn_allot.wpn_id', '=', 'wpn_list.id')
            ->where('wpn_list.status', 0)
            ->where(function ($query) use ($barcode) {
                $query->whereIn('wpn_list.wpn_tag', $barcode)
                      ->orWhereIn('wpn_list.butt_no', $barcode);
            });

        if (!empty($purpose)) {
            $query->where('wpn_allot.emp_id', $emp_id);
        }

        $query->groupBy(
            'wpn_list.id', 
            'wpn_list.regd_no', 
            'wpn_allot.emp_id', 
            'wpn_list.butt_no', 
            'wpn_types.type', 
            'wpn_list.wpn_tag', 
            'wpn_list.status'
        );

        $result = $query->get();

        if ($result->isEmpty()) {
            return response()->json(['status' => 'success', 'data' => [], 'message' => 'No records found.']);
        }

        return response()->json($result);
    } catch (\Exception $e) {
        \Log::error('Error fetching barcode data', ['error' => $e->getMessage()]);
        return response()->json(['status' => 'error', 'message' => 'Internal Server Error'], 500);
    }
}


public function fetchWpnBarcodeNotSelected(Request $request) 
{
    $barcode = $request->input('barcode');
    $purpose = $request->input('purpose');
    $emp_id = $request->input('emp_id');

    if (!is_array($barcode)) {
        $barcode = [$barcode];
    }

    $query = DB::table('wpn_list')
        ->select(
            'wpn_list.regd_no',
            'wpn_allot.emp_id',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.wpn_tag',
            'wpn_list.id',
            'wpn_list.status',
        )
        ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
        ->leftJoin('wpn_allot', 'wpn_allot.wpn_id', '=', 'wpn_list.id')
        ->where(function ($query) use ($barcode) {
            $query->whereNotIn('wpn_list.wpn_tag', $barcode)
                  ->WhereNotIn('wpn_list.butt_no', $barcode)
                  ->WhereNotIn('wpn_list.regd_no', $barcode);
        });

    // Apply purpose filter if provided
    if (!empty($purpose)) {
        $query->where('wpn_allot.emp_id', $emp_id);
    }

    // Group by necessary fields
    $query->groupBy(
        'wpn_list.id', 
        'wpn_list.regd_no', 
        'wpn_allot.emp_id', 
        'wpn_list.butt_no', 
        'wpn_types.type', 
        'wpn_list.wpn_tag', 
        'wpn_list.status'
    );

    // Get the result
    $result = $query->get();

    // Return response
    if ($result->isEmpty()) {
        return response()->json(['status' => 'success', 'data' => [], 'message' => 'No records found.']);
    }

    return response()->json($result);
}


public function addIssueReturn(Request $request)
{
    $wpn_ids = $request->input('wpn_ids');
    $purpose = $request->input('purpose');
    $emp_id = $request->input('emp_id');
    $nature = $request->input('nature');
    $megazins = $request->input('megazins');
    $slings = $request->input('slings');
    $bayonet = $request->input('bayonet');
    $remark = $request->input('remark');

    if (is_array($wpn_ids) && !empty($wpn_ids)) {
        foreach ($wpn_ids as $wpn_id) {
            DB::table('wpn_issue_rec')->insert([
                'emp_id' => $emp_id,
                'wpn_id' => $wpn_id,
                'nature' => $nature,
                'purpose' => $purpose,
                'megazins' => $megazins,
                'slings' => $slings,
                'bayonet' => $bayonet,
                'remark' => $remark,
            ]);

            DB::table('wpn_list')->where('id', $wpn_id)->update(['status' => 1]);
        }

        return response(1);
    }

    return response(0);
}

// **************** wpn return ***************//
public function wpn_return(Request $request){
    return view("admin.dashboard.wpn_return");
}


public function wpnReturnIndl(Request $request)
{
    $emp_id = $request->input('emp_id');

    if (empty($emp_id)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Employee code is required.',
        ]);
    }

    // Query to get weapon allotment list
    $result = DB::table('wpn_issue_rec')
        ->select(
            'wpn_list.wpn_tag',
            'wpn_issue_rec.megazins',
            'wpn_issue_rec.slings',
            'wpn_issue_rec.bayonet',
            'wpn_issue_rec.emp_id',
            'wpn_issue_rec.id',
            'wpn_list.regd_no',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.status',
            'wpn_issue_rec.nature',
            'wpn_issue_rec.purpose',
            'wpn_issue_rec.created_at'
        )
        ->join('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
        ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
        ->where('wpn_issue_rec.emp_id', $emp_id)
        ->whereNull('wpn_issue_rec.return_date')
        ->where('wpn_list.status', 1)
        ->groupBy(
            'wpn_issue_rec.wpn_id',
            'wpn_list.wpn_tag',
            'wpn_issue_rec.megazins',
            'wpn_issue_rec.slings',
            'wpn_issue_rec.bayonet',
            'wpn_issue_rec.emp_id',
            'wpn_issue_rec.id',
            'wpn_list.regd_no',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.status',
            'wpn_issue_rec.nature',
            'wpn_issue_rec.purpose',
            'wpn_issue_rec.created_at'
        )
        
        ->get();

    
    if ($result->isEmpty()) {
        return response()->json([
            'status' => 'success',
            'data' => [],
            'message' => 'No records found.',
        ]);
    }

    return response()->json([
        'status' => 'success',
        'data' => $result,
    ]);
}



public function fetchWpnBarcodeSelectedIndl(Request $request)
{
    $barcode = $request->input('barcode');
    $emp_id = $request->input('emp_id');

    // Ensure $barcode is an array
    if (!is_array($barcode)) {
        $barcode = [$barcode];
    }

    // Query to fetch weapon barcode and related details
    $result = DB::table('wpn_issue_rec')
        ->select(
            'wpn_list.regd_no',
            'wpn_issue_rec.megazins',
            'wpn_issue_rec.slings',
            'wpn_issue_rec.bayonet',
            'wpn_issue_rec.emp_id',
            'wpn_issue_rec.nature',
            'wpn_issue_rec.purpose',
            'wpn_issue_rec.created_at',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.wpn_tag',
            'wpn_list.id',
            'wpn_list.status'
        )
        ->join('wpn_list', 'wpn_issue_rec.wpn_id', '=', 'wpn_list.id') // Join wpn_list
        ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type') // Join wpn_type
        ->where('wpn_list.status', 1)
        ->where(function ($query) use ($barcode) {
            $query->whereIn('wpn_list.wpn_tag', $barcode)
                  ->orWhereIn('wpn_list.butt_no', $barcode);
        })
        ->where('wpn_issue_rec.emp_id', $emp_id)
        ->whereNull('wpn_issue_rec.return_date')
        ->groupBy([
            'wpn_list.regd_no',
            'wpn_issue_rec.megazins',
            'wpn_issue_rec.slings',
            'wpn_issue_rec.bayonet',
            'wpn_issue_rec.emp_id',
            'wpn_issue_rec.nature',
            'wpn_issue_rec.purpose',
            'wpn_issue_rec.created_at',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.wpn_tag',
            'wpn_list.id',
            'wpn_list.status'
        ])
        ->get();

    // Check if any records are found and return response
    if ($result->isEmpty()) {
        return response()->json([
            'status' => 'success',
            'data' => [],
            'message' => 'No records found.',
        ]);
    }

    return response()->json($result);
}


public function fetchWpnBarcodeNotSelectedIndl(Request $request)
{
    $barcode = $request->input('barcode');
    $emp_id = $request->input('emp_id');

    // Ensure $barcode is an array
    if (!is_array($barcode)) {
        $barcode = [$barcode];
    }

    // Query to fetch weapon barcodes not selected
    $result = DB::table('wpn_issue_rec')
        ->select(
            'wpn_list.regd_no',
            'wpn_issue_rec.megazins',
            'wpn_issue_rec.slings',
            'wpn_issue_rec.bayonet',
            'wpn_issue_rec.emp_id',
            'wpn_issue_rec.nature',
            'wpn_issue_rec.purpose',
            'wpn_issue_rec.created_at',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.wpn_tag',
            'wpn_list.id',
            'wpn_list.status'
        )
        ->join('wpn_list', 'wpn_issue_rec.wpn_id', '=', 'wpn_list.id') // Join wpn_list
        ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type') // Join wpn_type
        ->where('wpn_list.status', 1)
        ->where(function ($query) use ($barcode) {
            $query->whereNotIn('wpn_list.wpn_tag', $barcode)
                  ->whereNotIn('wpn_list.butt_no', $barcode);
        })
        ->where('wpn_issue_rec.emp_id', $emp_id)
        ->whereNull('wpn_issue_rec.return_date')
        ->groupBy([
            'wpn_list.regd_no',
            'wpn_issue_rec.megazins',
            'wpn_issue_rec.slings',
            'wpn_issue_rec.bayonet',
            'wpn_issue_rec.emp_id',
            'wpn_issue_rec.nature',
            'wpn_issue_rec.purpose',
            'wpn_issue_rec.created_at',
            'wpn_list.butt_no',
            'wpn_types.type',
            'wpn_list.wpn_tag',
            'wpn_list.id',
            'wpn_list.status'
        ])
        ->get();

    // Check if any records are found and return response
    if ($result->isEmpty()) {
        return response()->json([
            'status' => 'success',
            'data' => [],
            'message' => 'No records found.',
        ]);
    }

    return response()->json($result);
}


public function updateReturnWpn(Request $request)
{
    $wpn_ids = $request->input('wpn_ids'); // Array of weapon IDs
    $emp_id = $request->input('emp_id');

    // Check if wpn_ids is an array and not empty
    if (is_array($wpn_ids) && !empty($wpn_ids)) {
        foreach ($wpn_ids as $wpn_id) {
            $id = $wpn_id['id'];
            $megazins = $wpn_id['megazins'];
            $slings = $wpn_id['slings'];
            $bayonet = $wpn_id['bayonet'];

            // Fetch the weapon issue record
            $wpn_issue_id = DB::table('wpn_issue_rec')
                ->where('emp_id', $emp_id)
                ->where('wpn_id', $id)
                ->whereNull('return_date')
                ->first();

            if ($wpn_issue_id) {
                // Data to update `wpn_issue_rec`
                $data = [
                    'return_date' => now(),
                    'status'  => 1,
                ];

                // Data to insert into `wpn_ret_mag_history`
                $data2 = [
                    'emp_id' => $emp_id,
                    'wpn_id' => $id,
                    'issue_id' => $wpn_issue_id->id,
                    'ret_megazins' => $megazins,
                    'ret_slings' => $slings,
                    'ret_bayonet' => $bayonet,
                ];

                // Insert into `wpn_ret_mag_history`
                DB::table('wpn_ret_mag_history')->insert($data2);

                // Update the `wpn_issue_rec` table
                DB::table('wpn_issue_rec')
                    ->where('id', $wpn_issue_id->id)
                    ->update($data);

                // Update the `wpn_list` table
                DB::table('wpn_list')
                    ->where('id', $id)
                    ->update(['status' => 0]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Records updated successfully.']);
    }

    // If no wpn_ids were provided, send an error response
    return response()->json(['status' => 'error', 'message' => 'No weapon IDs provided.'], 400);
}


public function wpn_issue(Request $request){
    return view("admin.dashboard.wpn_issue");
}

// ************ reports ******************//

public function reports(Request $request){
    return view('admin.dashboard.reports');
}

// public function master_report(Request $request)
// {
//     $employees = Employee::get();
//     $ranks = Rank::get();
//     $units = Unit::get();
//     $companys = Company::get();
//     $wpn_types = WpnType::get();
//     $query = WpnIssueRec::select([
//         'wpn_issue_rec.*',
//         'rank.rank_name',
//         'employees.name as emp_name',
//         'employees.emp_id',
//         'wpn_types.type',
//         'wpn_list.regd_no',
//         'wpn_list.butt_no',
//         'wpn_ret_mag_history.ret_megazins',
//         'wpn_ret_mag_history.ret_slings',
//         'wpn_ret_mag_history.ret_bayonet',
//         'wpn_issue_rec.created_at',
//         'wpn_list.status',
//     ])
//     ->leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
//     ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
//     ->leftJoin('employees', 'employees.emp_id', '=', 'wpn_issue_rec.emp_id')
//     ->leftJoin('rank', 'rank.id', '=', 'employees.rank_id')
//     ->leftJoin('wpn_ret_mag_history', 'wpn_ret_mag_history.issue_id', '=', 'wpn_issue_rec.id');

//     $filters = $request->only(['emp_id', 'name', 'rank', 'status', 'nature', 'purpose','wpn_type','butt_no','regd_no','from_date','to_date']);

//     // Handling dynamic GET filters
//     if ($request->filled('name')) {
//         $query->where('employees.name', 'like', '%' . $request->name . '%');
//     }

//     if ($request->filled('emp_id')) {
//         $query->where('employees.emp_id', $request->emp_id);
//     }

//     if ($request->filled('rank')) {
//         $query->where('rank.id', $request->rank);
//     }

//     if ($request->filled('status')) {
//         $query->where('wpn_list.status', $request->status);
//     }

//     if ($request->filled('nature')) {
//         $query->where('wpn_issue_rec.nature', $request->nature);
//     }

//     if ($request->filled('purpose')) {
//         $query->where('wpn_issue_rec.purpose', $request->purpose);
//     }

//     if ($request->filled('wpn_type')) {
//         $query->where('wpn_types.id', $request->wpn_type);
//     }

//     // if ($request->filled('butt_no')) {
//     //     $query->where('wpn_list.butt_no', $request->butt_no);
//     // }
//     if (!empty($filters['butt_no'])) {
//         $query->where('wpn_list.butt_no', $filters['butt_no']);
//     }

//     if ($request->filled('regd_no')) {
//         $query->where('wpn_list.regd_no', 'like', '%' . trim($request->regd_no) . '%');
//     }

//     // Handling date filters
//     if ($request->filled('from_date') || $request->filled('to_date')) {
//         $fromDate = $request->from_date;
//         $toDate = $request->to_date;

//         if ($fromDate && $toDate) {
//             $query->whereBetween('wpn_issue_rec.created_at', [$fromDate, $toDate]);
//         } elseif ($fromDate) {
//             $query->where('wpn_issue_rec.created_at', '>=', $fromDate);
//         } elseif ($toDate) {
//             $query->where('wpn_issue_rec.created_at', '<=', $toDate);
//         }
//     }

//     // Execute the query and get results
//     $data = $query->paginate(20)->appends($filters);
//     // dd($data);
//     return view('admin.dashboard.master_report', compact('employees', 'ranks', 'units', 'companys', 'wpn_types', 'data'));
// }

public function master_report(Request $request)
{
    $employees = Employee::get();
    $ranks = Rank::get();
    $units = Unit::get();
    $companys = Company::get();
    $wpn_types = WpnType::get();

    $query = WpnIssueRec::select([
        'wpn_issue_rec.*',
        'rank.rank_name',
        'employees.name as emp_name',
        'employees.emp_id',
        'wpn_types.type',
        'wpn_list.regd_no',
        'wpn_list.butt_no',
        'wpn_ret_mag_history.ret_megazins',
        'wpn_ret_mag_history.ret_slings',
        'wpn_ret_mag_history.ret_bayonet',
        'wpn_issue_rec.created_at',
        'wpn_list.status',
    ])
    ->leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
    ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
    ->leftJoin('employees', 'employees.emp_id', '=', 'wpn_issue_rec.emp_id')
    ->leftJoin('rank', 'rank.id', '=', 'employees.rank_id')
    ->leftJoin('wpn_ret_mag_history', 'wpn_ret_mag_history.issue_id', '=', 'wpn_issue_rec.id');

    $filters = $request->only(['emp_id', 'name', 'rank', 'status', 'nature', 'purpose', 'wpn_type', 'butt_no', 'regd_no', 'from_date', 'to_date']);

    if ($request->filled('name')) {
        $query->where('employees.name', 'like', '%' . trim($request->name) . '%');
    }
    if ($request->filled('emp_id')) {
        $query->where('employees.emp_id', $request->emp_id);
    }
    if ($request->filled('rank')) {
        $query->where('rank.id', $request->rank);
    }
    if ($request->filled('status')) {
        $query->where('wpn_issue_rec.status', $request->status);
    }
    if ($request->filled('nature')) {
        $query->where('wpn_issue_rec.nature', $request->nature);
    }
    if ($request->filled('purpose')) {
        $query->where('wpn_issue_rec.purpose', $request->purpose);
    }
    if ($request->filled('wpn_type')) {
        $query->where('wpn_types.id', $request->wpn_type);
    }
    if ($request->filled('butt_no')) {
        $query->where('wpn_list.butt_no', trim($request->butt_no));
    }
    if ($request->filled('regd_no')) {
        $query->where('wpn_list.regd_no', 'like', '%' . trim($request->regd_no) . '%');
    }
    if ($request->filled('from_date') || $request->filled('to_date')) {
        $fromDate = $request->from_date;
        // $toDate = $request->to_date;
        $toDate = $request->to_date ? date('Y-m-d', strtotime($request->to_date . ' +1 day')) : null;

        if ($fromDate && $toDate) {
            $query->whereBetween('wpn_issue_rec.created_at', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $query->where('wpn_issue_rec.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $query->where('wpn_issue_rec.created_at', '<=', $toDate);
        }
    }

    $data = $query->paginate(20)->appends($filters);
    
    if($request->has('export_excel')){
        $excelData = $data->getCollection();
        $exportData = $excelData->map(function($item){
            return [
                $item -> created_at,
                $item -> return_date,
                $item -> emp_id,
                $item -> rank_name,
                $item -> emp_name,
                $item ->nature == 0 ? "Less Than 24hr" : "More Than 24hr",
                $item -> purpose,
                $item -> type,
                $item -> butt_no,
                $item -> regd_no,
                $item -> megazins,
                $item -> ret_megazins,
                $item -> slings,
                $item -> ret_slings,
                $item -> bayonet,
                $item -> ret_bayonet,


            ];
        });
         return Excel::download(new class($exportData) implements \Maatwebsite\Excel\Concerns\FromArray {
        protected $data;

        public function __construct($data)
        {
            $this->data = $data;
        }

        public function array(): array
        {
            $headers = [
                	"Date and Time Out","Date and Time In","ID No","Rank","Name","Nature","Purpose" ,"Type of Wpn","Butt No.","Regd No.","Mag Issued","Mag Return","Slings Issued","Slings REturn","Bayonet Issued","Bayonet Return"
            ];

            return array_merge([$headers], $this->data->toArray());
        }
    }, 'weaponHistory.xlsx');
    }



    return view('admin.dashboard.master_report', compact('employees', 'ranks', 'units', 'companys', 'wpn_types', 'data', 'filters'));
}



public function inout_report(){

    // $wpntype = DB::table('wpn_types')->get();

    // $data = $wpntype->map(function ($key) {
    //     $held = DB::table('wpn_list')
    //         ->where('wpn_type', $key->id)
    //         ->count();

    //     $kote = DB::table('wpn_list')
    //         ->where('wpn_type', $key->id)
    //         ->where('status', 0)
    //         ->count();

    //     $less24 = DB::table('wpn_issue_rec')
    //         ->join('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
    //         ->where('wpn_list.wpn_type', $key->id)
    //         ->whereNull('wpn_issue_rec.return_date')
    //         ->where('wpn_issue_rec.nature', 0)
    //         ->count();

    //     $more24 = DB::table('wpn_issue_rec')
    //         ->join('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
    //         ->where('wpn_list.wpn_type', $key->id)
    //         ->whereNull('wpn_issue_rec.return_date')
    //         ->where('wpn_issue_rec.nature', 1)
    //         ->count();

    //     $key->held = $held;
    //     $key->kote = $kote;
    //     $key->less24 = $less24;
    //     $key->more24 = $more24;

    //     return $key;
    // });

    return view('admin.dashboard.inout_report');
}

public function getHeldWpn(Request $request)
{
    $wpnTypeId = $request->input('wpn_type_id');

    $result = DB::table('wpn_list')
                ->select('wpn_list.*', 'wpn_types.type')
                ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
                ->where('wpn_list.wpn_type', $wpnTypeId)
                ->get();

    return response()->json($result);
}


public function getKoteWpn(Request $request)
{
    $wpnTypeId = $request->input('wpn_type_id');

    $result = DB::table('wpn_list')
                ->select('wpn_list.*', 'wpn_types.type')
                ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
                ->where('wpn_list.wpn_type', $wpnTypeId)
                ->where('wpn_list.status', 0)
                ->get();

    return response()->json($result);
}


public function getLess24Wpn(Request $request)
{
    $wpnTypeId = $request->input('wpn_type_id');

    $result = DB::table('wpn_issue_rec')
    ->select(
        'wpn_list.*',
        'wpn_types.type',
        'employees.emp_id',
        'wpn_issue_rec.purpose',
        'employees.name as emp_name',
        'rank.rank_name',
        'wpn_issue_rec.created_at'
    )
    ->leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
    ->leftJoin('employees', 'employees.emp_id', '=', 'wpn_issue_rec.emp_id')
    ->leftJoin('rank', 'rank.id', '=', 'employees.rank_id')
    ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
    ->where('wpn_list.wpn_type', $wpnTypeId)
    ->whereNull('wpn_issue_rec.return_date')
    ->where('wpn_issue_rec.nature', 0)
    ->get();

 return response()->json($result);
}


public function getMore24Wpn(Request $request)
{
    $wpnTypeId = $request->input('wpn_type_id');

    $result = DB::table('wpn_issue_rec')
                ->select(
                    'wpn_list.*',
                    'wpn_types.type',
                    'employees.emp_id',
                    'wpn_issue_rec.purpose',
                    'employees.name as emp_name',
                    'rank.rank_name',
                    'wpn_issue_rec.created_at'
                )
                ->join('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
                ->join('employees', 'employees.emp_id', '=', 'wpn_issue_rec.emp_id')
                ->join('rank', 'rank.id', '=', 'employees.rank')
                ->join('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
                ->where('wpn_list.wpn_type', $wpnTypeId)
                ->whereNull('wpn_issue_rec.return_date') // Check for NULL return_date
                ->where('wpn_issue_rec.nature', 1) // Nature = 1 for more than 24 hours
                ->get();

    return response()->json($result);
}


public function wpn_summary(Request $request){
    $query = WpnList::with(['wpn_types', 'company']);

    // Capture filter inputs
    $filters = $request->only(['wpn_tag', 'wpn_type', 'regd_no', 'butt_no', 'company', 'service']);

    // Apply filters
    if (!empty($filters['wpn_tag'])) {
        $query->where('wpn_tag',$filters['wpn_tag']);
    }

    if (!empty($filters['wpn_type'])) {
        $query->where('wpn_type',$filters['wpn_type']);
    }

    if (!empty($filters['regd_no'])) {
        $query->where('regd_no', $filters['regd_no']);
    }
    if (!empty($filters['butt_no'])) {
        $query->where('butt_no', $filters['butt_no']);
    }

    if (!empty($filters['company'])) {
        $query->where('company_id', $filters['company']);
    }


    if (!empty($filters['service'])) {
        $query->where('servicability', $filters['service']);
    }

    // Get the total number of records for the filtered query
    $totalRecords = $query->count();

     if ($request->has('export_excel')) {
        $excelData = $query->get()->map(function ($item, $index) {
            return [
                'S.No' => $index + 1,  // Auto-increment serial number
                'WPN TAG' => $item->wpn_tag,
                'WPN TYPE' => $item->wpn_types->wpn_type ?? '-',
                'REGD NO.' => $item->regd_no,
                'BUTT NO.' => $item->butt_no,
                'Company' => $item->company->company_name ?? '-',
                'REMARKS' => $item->remarks ?? '-',
                'SERVICABILITY' => $item->servicability,
            ];
        });

        return Excel::download(new class($excelData) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                $headers = ["S.No", "WPN TAG", "WPN TYPE", "REGD NO.", "BUTT NO.", "Company", "REMARKS", "SERVICABILITY"];
                return array_merge([$headers], $this->data->toArray());
            }
        }, 'weapon_summary.xlsx');
    }

    // Get weapons with pagination
    $weapons = $query->paginate(50)->appends($filters);

    $wpntype = WpnType::get();
    $companies = Company::get();

    // Pass total records to the view

     return view('admin.dashboard.wpn_summary',compact('weapons', 'wpntype', 'companies', 'filters', 'totalRecords'));

}



// public function getWeaponIssueRecords(Request $request)
// {
//     $query = WpnIssueRec::select([
//             'wpn_issue_rec.*',
//             'rank.rank_name',
//             'employees.name as emp_name',
//             'employees.emp_id',
//             'wpn_types.type',
//             'wpn_list.regd_no',
//             'wpn_list.butt_no',
//             'wpn_ret_mag_history.ret_megazins',
//             'wpn_ret_mag_history.ret_slings',
//             'wpn_ret_mag_history.ret_bayonet',
//             'wpn_issue_rec.created_at',
//             'wpn_list.status',
//         ])
//         ->leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
//         ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type_id')
//         ->leftJoin('employee', 'employee.emp_id', '=', 'wpn_issue_rec.emp_id')
//         ->leftJoin('rank', 'rank.id', '=', 'employee.rank')
//         ->leftJoin('wpn_ret_mag_history', 'wpn_ret_mag_history.issue_id', '=', 'wpn_issue_rec.id');  // equivalent to "WHERE posted_out IS NULL"

//     // Handling dynamic GET filters
//     if ($request->has('name') && $request->name != '') {
//         $query->where('employee.name', 'like', '%' . $request->name . '%');
//     }

//     if ($request->has('emp_id') && $request->army_no != '') {
//         $query->where('employee.emp_id', $request->army_no);
//     }

//     if ($request->has('rank') && $request->rank != '') {
//         $query->where('rank', $request->rank);
//     }

//     if ($request->has('status') && $request->status != '') {
//         $query->where('wpn_issue_rec.status', $request->status);
//     }

//     if ($request->has('nature') && $request->nature != '') {
//         $query->where('wpn_issue_rec.nature', $request->nature);
//     }

//     if ($request->has('purpose') && $request->purpose != '') {
//         $query->where('wpn_issue_rec.purpose', $request->purpose);
//     }

//     if ($request->has('wpntype') && $request->wpntype != '') {
//         $query->where('wpn_types.id', $request->wpntype);
//     }

//     if ($request->has('butt_no') && $request->butt_no != '') {
//         $query->where('wpn_list.butt_no', $request->butt_no);
//     }

//     if ($request->has('regd_no') && $request->regd_no != '') {
//         $query->where('wpn_list.regd_no', 'like', '%' . trim($request->regd_no) . '%');
//     }

//     // Handling date filters
//     if (($request->has('date_from') && $request->date_from != '') || ($request->has('date_to') && $request->date_to != '')) {
//         $dateFrom = $request->date_from;
//         $dateTo = $request->date_to;

//         if ($dateFrom && $dateTo) {
//             $query->whereBetween('wpn_issue_rec.created_at', [$dateFrom, $dateTo]);
//         } elseif ($dateFrom) {
//             $query->where('wpn_issue_rec.created_at', '>=', $dateFrom);
//         } elseif ($dateTo) {
//             $query->where('wpn_issue_rec.created_at', '<=', $dateTo);
//         }
//     }

  

//     // Execute the query and get results
//     $data = $query->paginate(20);

//     return response()->json($data);
// }

// ************manage fund_cat *************//
// public function manage_fund_cat(Request $request)
// {   
//     $company = Rank::paginate(20);
//     return view('admin.dashboard.manage_rank',compact('rank'));
// }

// public function add_fund_cat(Request $request)
// {
//     $rank = new Rank();
//     $rank->rank_name = $request->input('item_rank_name');
//     $rank->save();

//     $rank->rank_id = 'R' . $rank->id;
//     $rank->save(); // Save again to update the veh_id

//     // Redirect with success message
//     return redirect()->back()->with('success', 'Data Added Successfully');
// }


// public function delete_fund_cat(Request $request){
//     $request->validate([
//         'del_id' => 'required|integer',
//     ]);
//     $id = $request->input('del_id');
//     // dd($id);
//     $rank = Rank::find($id);
//     $rank->delete();
//     return redirect()->back()->with('success', 'Rank Deleted'); 
// }

// public function update_fund_cat(Request $request){
//     $request->validate([
//         'cat_id' => 'required|exists:rank,id',
//         'category_name' => 'required|string|max:255',
//     ]);

//     $rank = Rank::find($request->input('cat_id'));
//     $rank->rank_name = $request->input('category_name'); 
//     $rank->save();
//     return redirect()->route('manage.rank')->with('success', 'Rank Updated');
// }

// ****************manange branches*******************//
public function manage_branches(Request $request)
{   
    $branches = Branch::paginate(20);
    return view('admin.dashboard.manage_branch',compact('branches'));
}

public function add_branches(Request $request)
{
    $destination = new Branch();
    $destination->branch_name = $request->input('dest_name');
    $destination->save();

    // Redirect with success message
    return redirect()->back()->with('success', 'Data Added Successfully');
}


public function delete_branches(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $destination = Branch::find($id);
    $destination->delete();
    return redirect()->back()->with('success', 'Branch Deleted'); 
}

public function update_branches(Request $request){
    $request->validate([
        'cat_id' => 'required|exists:branches,id',
        'category_name' => 'required|string|max:255',
    ]);

    $destination = Branch::find($request->input('cat_id'));
    $destination->branch_name = $request->input('category_name'); 
    $destination->save();
    return redirect()->route('manage.branches')->with('success', 'Branch Updated');
}


// ************manage Fund Cat *************//
public function manage_fund_cat(Request $request)
{   
    $fund_cat = FundCat::paginate(20);
    return view('admin.dashboard.manage_fund_cat',compact('fund_cat'));
}

public function add_fund_cat(Request $request)
{
    $fund_cat = new FundCat();
    $fund_cat->fund_cat_name = $request->input('item_formation_name');
    $fund_cat->save();
    // Redirect with success message
    return redirect()->back()->with('success', 'Data Added Successfully');
}


public function delete_fund_cat(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $fund_cat = FundCat::find($id);
    $fund_cat->delete();
    return redirect()->back()->with('success', 'Fund category  Deleted'); 
}

public function update_fund_cat(Request $request){
    $request->validate([
        'cat_id' => 'required|exists:fund_cat,id',
        'category_name' => 'required|string|max:255',
    ]);

    $fund_cat = FundCat::find($request->input('cat_id'));
    $fund_cat->fund_cat_name = $request->input('category_name'); 
    $fund_cat->save();
    return redirect()->route('manage.fund.cat')->with('success', 'Fund category Updated');
}


// ************Manage Fund Sub Cat *************//
public function manage_fund_subcat(Request $request)
{   
    $formationUnits = FundSubCat::join('fund_cat','fund_subcat.fund_cat_id','=','fund_cat.id')->select('fund_subcat.*','fund_cat.fund_cat_name')->paginate(20);
    $formations = FundCat::get();
    return view('admin.dashboard.manage_fundsubcat',compact('formationUnits','formations'));
}

public function add_fund_subcat(Request $request)
{
    $formationUnits = new FundSubCat();
    $formationUnits->fund_cat_id = $request->input('f_id');
    $formationUnits->fund_subcat_name = $request->input('f_unit_name');
    $formationUnits->save();

    // Redirect with success message
    return redirect()->back()->with('success', 'Data Added Successfully');
}


public function delete_fund_subcat(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    $formationUnits = FundSubCat::find($id);
    $formationUnits->delete();
    return redirect()->back()->with('success', 'Sub Category Deleted'); 
}

public function update_fund_subcat(Request $request){

    $formationUnits = FundSubCat::find($request->input('cat_id'));
    $formationUnits->fund_cat_id = $request->input('edit_f_id'); 
    $formationUnits->fund_subcat_name = $request->input('edit_f_unit_name'); 
    $formationUnits->save();
    return redirect()->route('manage.fund.subcat')->with('success', 'Sub Category Updated');
}





// ************manage store*************//
public function manage_store(Request $request)
{   
    $store = Store::paginate(20);
    return view('admin.dashboard.manage_store',compact('store'));
}

public function add_store(Request $request)
{
    $store = new store();
    $store->store_name = $request->input('item_store_name');
    $store->save();


    // Redirect with success message
    return redirect()->back()->with('success', 'Data Added Successfully');
}


public function delete_store(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $store = store::find($id);
    $store->delete();
    return redirect()->back()->with('success', 'store Deleted'); 
}

public function update_store(Request $request){
    $request->validate([
        'cat_id' => 'required|exists:stores,id',
        'category_name' => 'required|string|max:255',
    ]);

    $store = store::find($request->input('cat_id'));
    $store->store_name = $request->input('category_name'); 
    $store->save();
    return redirect()->route('manage.store')->with('success', 'store Updated');
}





//********************* assign veh form **********************//

public function assign_form(Request $request){
    $productCat = ProductCat::get();
    $fundCat = FundCat::get();
    $fundSubCat = FundSubCat::get();
    return view('admin.dashboard.veh_assign_form',compact('productCat','fundCat','fundSubCat'));
}


public function edit_assign_form($id){
    $products = Products::where('id',$id)->first();
    $productCat = ProductCat::get();
    $fundCat = FundCat::get();
    $fundSubCat = FundSubCat::get();
    return view('admin.dashboard.edit_product',compact('products','productCat','fundCat','fundSubCat'));

}

public function edit_productaction(Request $request){
    DB::transaction(function () use ($request) {
        $userId = Auth::id();
        $imagePath = null;
    
        $product = Products::findOrFail($request->id); 
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            if ($image->isValid()) {
                $imagePath = $image->store('images', 'public');
                if ($product->product_img && file_exists(storage_path('app/public/' . $product->product_img))) {
                    unlink(storage_path('app/public/' . $product->product_img));
                }
            }
        }
        // Prepare data for updating product
        $updateData = [
            'product_name' => $request->product_name,
            'product_qty' => $request->qty,
            'having_serial' => $request->hasSerial,
            'serial_no' => $request->serialNo,
            'product_cat_id' => $request->category,
            'fund_sub_cat_id' => $request->fund_category,
            'fund_sub_id' => $request->fund_sub_category,
            'crv_no' => $request->crv_no,
            'crv_date' => $request->crv_date,
            'ledger_no' => $request->ledger_no,
            'ledger_page_no' => $request->ledger_page_no,
            'issue_voucher_no' => $request->issue_voucher_no,
            'issue_voucher_date' => $request->issue_voucher_date,
            'bill_no' => $request->bill_no,
            'bill_date' => $request->bill_date,
            'warranty_yr' => $request->warranty_years,
            'warranty_exp_date' => $request->warranty_expiry_date,
            'amc_due_date' => $request->amc_due_date,
            'price' => $request->price,
            'annual_dep' => $request->annual_dep,
            'current_price' => $request->current_price,
            'scan_barcode' => $request->barcode,
            'remarks' => $request->remarks,
        ];
    
        if ($imagePath) {
            $updateData['product_img'] = $imagePath;
        }
        // Update the product with the new data
        // $product->update($updateData);
    });
    
    return redirect()->route('assign.list')->with('success', 'Product Updated');
}




public function assign_veh(Request $request)
{
   
        $userId = Auth::id();
        $imagePath = '';

        // Check if the request has a file for 'product_image'
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
        
            // Ensure the file is valid
            if ($image->isValid()) {
                // Store the file in the 'images' directory in the public disk
                $imagePath = $image->store('images', 'public'); 
            }
        }

        $serialNumbers = $request->hasSerial === 'yes' ? json_encode($request->serialNo) : null;
        // dd($request->destination);
        $product = Products::create([
            'product_name' => $request->product_name,
            'product_qty' => $request->qty,
            'having_serial' => $request->hasSerial ?? null,
            'serial_no' => $serialNumbers,
            'product_cat_id' => $request->category ?? null,
            'product_img' => $imagePath ?? "",
            'fund_sub_cat_id' => $request->fund_category ?? null,
            'fund_sub_id' => $request->fund_sub_category ?? null,
            'crv_no' => $request->crv_no ?? null,
            'crv_date' => $request->crv_date ?? null,
            'ledger_no' => $request->ledger_no ?? null,
            'ledger_page_no' => $request->ledger_page_no ?? null,
            'issue_voucher_no' => $request->issue_voucher_no ?? null,
            'issue_voucher_date' => $request->issue_voucher_date ?? null,
            'bill_no' => $request->bill_no ?? null,
            'bill_date' => $request->bill_date ?? null,
            'warranty_yr' => $request->warranty_years ?? null,
            'warranty_exp_date' => $request->warranty_expiry_date ?? null,
            'amc_due_date' => $request->amc_due_date ?? null,
            'price' => $request->price ?? null,
            'annual_dep' => $request->annual_dep ?? null,
            'current_price' => $request->current_price ?? null,
            'scan_barcode' => $request->barcode ?? null,
            'remarks' => $request->remarks ?? null,
        ]);
        // dd($product);
    

    
    return redirect()->back()->with('success', 'Product Added'); 
}




public function assign_list(){
    $product_list = Products::leftjoin('product_cat','product_cat.id', '=', 'products.product_cat_id')
                    ->leftjoin('fund_cat','fund_cat.id','=','products.fund_sub_cat_id')
                    ->leftjoin('fund_subcat','fund_subcat.id','=','products.fund_sub_id')
                    ->select('products.*','fund_cat.fund_cat_name','product_cat.p_cat_name','fund_subcat.fund_subcat_name')
                    ->orderBy('products.id','desc')
                    ->paginate(20);
    // dd($product_list);
    return view('admin.dashboard.stage1_tab',compact('product_list'));
}



public function view_user(){
    $user = User::paginate(20);
    return view('admin.dashboard.manage_user',compact('user'));
}

public function add_user(Request $request){
    $user = new User();
    $user->username = $request->input('name');
    $user->email = $request->input('username');
    $user->password = Hash::make($request->input('password'));
    $user->role_id = $request->input('role');
    $user->save();
    // Redirect with success message
    return redirect()->back()->with('success', 'Data Added Successfully');
}


public function delete_user(Request $request){
    $request->validate([
        'del_id' => 'required|integer',
    ]);
    $id = $request->input('del_id');
    // dd($id);
    $user = User::find($id);
    $user->delete();
    return redirect()->back()->with('success', 'user Deleted'); 
}

public function update_user(Request $request){    
    $user = User::find($request->input('id'));
    $user->username = $request->input('edit_name');
    $user->email = $request->input('edit_username');
    if ($request->filled('edit_password')) {
        $user->password =Hash::make($request->input('edit_password'));
    }
    $user->role_id = $request->input('edit_role');
    $user->save();
    return redirect()->route('view.user')->with('success', 'user Updated');
}


public function stage1tabs(){
    return view('admin.dashboard.stage1_tabs');
}


public function issue_products($id){
    $products = Products::leftjoin('product_cat','product_cat.id', '=', 'products.product_cat_id')
                    ->leftjoin('fund_cat','fund_cat.id','=','products.fund_sub_cat_id')
                    ->leftjoin('fund_subcat','fund_subcat.id','=','products.fund_sub_id')
                    ->select('products.*','fund_cat.fund_cat_name','product_cat.p_cat_name','fund_subcat.fund_subcat_name')
                    ->where('products.id',$id)
                    ->first();
    $branch = Branch::get();
    $store = Store::get();
    // dd($products);
    if($products->having_serial == "yes"){
    $serialNumbers = json_decode($products->serial_no, true);

        // Ensure it's an array and handle edge cases
        if (!is_array($serialNumbers)) {
            $serialNumbers = []; // Default to an empty array if parsing fails
        }
    }else{
        $serialNumbers = [];
    }
    // $serialNumbers = $products->having_serial == "yes" ? explode(',', $products->serial_no) : [];
    // dd($serialNumbers);
    return view('admin.dashboard.issue_product',compact('products','store','branch','serialNumbers'));
}

// public function issue_productsaction(Request $request)
// {
//     $b_s_id = $request->branch_id ?? $request->store_id;
//     // dd($request->having_serial);
//     DB::beginTransaction();
    
//     try {
//         if($request->having_serial === 'yes'){
//         $product = Products::findOrFail($request->product_id);
//         $existingSerialNumbers = json_decode($product->serial_no, true);

//         $serialNumbersToIssue = $request->having_serial === 'yes' ? $request->serial_numbers : null;
//         // dd($existingSerialNumbers);
//         $remainingSerialNumbers = array_diff($existingSerialNumbers, $serialNumbersToIssue);
//         }
//         $serialNumbers = $request->having_serial === 'yes' ? json_encode($request->serial_numbers) : null;
//         // dd($serialNumbers);
//         $issueProduct = IssueProducts::create([
//             'product_id' => $request->product_id,
//             'issued_qty' => $request->quantity_to_issue,
//             'issued_to' => $request->issueOption,
//             'serial_no' => $serialNumbers,
//             'branch_store_id' => $b_s_id,
//         ]);

    
//         $updated = Products::where('id', $request->product_id)
//             ->update([
//                 'product_qty' => DB::raw("product_qty - {$request->quantity_to_issue}"),
//                 'issued_qty' => DB::raw("issued_qty + {$request->quantity_to_issue}"),
//                 'serial_no' => json_encode(array_values($remainingSerialNumbers)) // Store remaining serial numbers
//             ]);

//         $this->sendMessage();
//         // Check if the update was successful
//         if (!$updated) {
//             throw new \Exception('Failed to update product details');
//         }

//         DB::commit(); // Commit the transaction
//         return redirect()->back()->with('success', 'Product issued successfully.');
//     } catch (\Exception $e) {
//         DB::rollBack(); // Rollback the transaction on error
//         return back()->withErrors(['error' => $e->getMessage()]);
//     }
// }



// public function sendMessage()
// {
//     $url = "https://hisocial.in/api/send";

//     // Data for the POST request
//     $data = [
//         "number" => 9896482119,
//         "type" => "text",
//         "message" => "Hello, this is a test message.",
//         "instance_id" => "6778D22413B00",
//         "access_token" => "6778d146ea584"
//     ];

//     // Make the POST request
//     $response = Http::withHeaders([
//         'Content-Type' => 'application/json',
//     ])->post($url, $data);

//     // Handle response
//     if ($response->successful()) {
//         return $response->json(); // Return the API response as JSON
//     } else {
//         return response()->json(['error' => 'Failed to send message'], $response->status());
//     }
// }

public function issue_productsaction(Request $request)
{
    $b_s_id = $request->branch_id ?? $request->store_id;
    DB::beginTransaction();

    try {
        if ($request->having_serial === 'yes') {
            $product = Products::findOrFail($request->product_id);
            $existingSerialNumbers = json_decode($product->serial_no, true);

            if (!is_array($existingSerialNumbers)) {
                throw new \Exception('Invalid serial numbers format in product data.');
            }

            $serialNumbersToIssue = $request->serial_numbers ?? [];
            $remainingSerialNumbers = array_diff($existingSerialNumbers, $serialNumbersToIssue);
        }

        $serialNumbers = $request->having_serial === 'yes' ? json_encode($request->serial_numbers) : null;

        $issueProduct = IssueProducts::create([
            'product_id' => $request->product_id,
            'issued_qty' => $request->quantity_to_issue,
            'issued_to' => $request->issueOption,
            'serial_no' => $serialNumbers,
            'branch_store_id' => $b_s_id,
        ]);

        if (!$issueProduct) {
            throw new \Exception('Failed to create issue product entry.');
        }

        $updated = Products::where('id', $request->product_id)
            ->update([
                'product_qty' => DB::raw("product_qty - {$request->quantity_to_issue}"),
                'issued_qty' => DB::raw("issued_qty + {$request->quantity_to_issue}"),
                'serial_no' => json_encode(array_values($remainingSerialNumbers)),
            ]);

        if (!$updated) {
            throw new \Exception('Failed to update product details.');
        }

        $messageResponse = $this->sendMessage();

        if (isset($messageResponse['error'])) {
            throw new \Exception('Message sending failed: ' . $messageResponse['error']);
        }

        DB::commit(); // Commit the transaction
        return redirect()->back()->with('success', 'Product issued successfully.');

    } catch (\Exception $e) {
        DB::rollBack(); // Rollback the transaction on error
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

public function sendMessage()
{
    $url = "https://hisocial.in/api/send";

    $data = [
        "number" => 9896482119,
        "type" => "text",
        "message" => "Hello, this is a test message.",
        "instance_id" => "6778D22413B00",
        "access_token" => "6778d146ea584"
    ];

    try {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        if ($response->successful()) {
            return $response->json(); // Return the API response as JSON
        } else {
            return ['error' => 'Failed to send message: ' . $response->body()];
        }
    } catch (\Exception $e) {
        return ['error' => 'Message sending exception: ' . $e->getMessage()];
    }
}

public function wpn_section()
{   
    return view('admin.dashboard.wpn_section');
}

public function indl_section()
{   
    return view('admin.dashboard.indl_section');
}

public function indl_list2(Request $request)
{
    $query = Employee::with(['rank', 'unit', 'company']);
    $filters = $request->only(['emp_id', 'name', 'rank', 'unit', 'company', 'status']);
    if (!empty($filters['emp_id'])) {
        $query->where('emp_id', 'like', '%' . $filters['emp_id'] . '%');
    }

    if (!empty($filters['name'])) {
        $query->where('name', 'like', '%' . $filters['name'] . '%');
    }

    if (!empty($filters['rank'])) {
        $query->where('rank_id', $filters['rank']);
    }

    if (!empty($filters['unit'])) {
        $query->where('unit_id', $filters['unit']);
    }

    if (!empty($filters['company'])) {
        $query->where('company_id', $filters['company']);
    }

    if (!empty($filters['status'])) {
        $query->where('status', $filters['status']);
    }

    $totalRecords = $query->count();

    $employee = $query->orderby('id','DESC')->paginate(50);


    if ($request->has('export_excel')) {
        $excelData = $query->get()->map(function ($item, $index) {
            return [
                'S.No' => $index + 1,  // Auto-increment serial number
                'Id No.' => $item->emp_id,
                'Rank' => $item->rank->rank_name ?? '-',
                'Name' => $item->name,
                'Unit' => $item->unit->unit_name ?? '-',
                'Company' => $item->company->company_name ?? '-',
            ];
        });

        return Excel::download(new class($excelData) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                $headers = ["S.No", "Id No.", "Rank", "Name", "Unit", "Company"];
                return array_merge([$headers], $this->data->toArray());
            }
        }, 'employee_list.xlsx');
    }

    $ranks = Rank::all();
    $units = Unit::all();
    $companies = Company::all();

    return view('admin.dashboard.indl_list2', compact('employee','totalRecords','ranks','units','companies','filters'));
}
// public function current_history(Request $request) {

//     $id = $request->get('id');
    
//     $record = WpnIssueRec::where('emp_id', $id)
//     ->where('status', 0)
//     ->whereNull('return_date')
//     ->get();

//     return response()->json($record);
// }



public function current_history(Request $request) {
    $id = $request->get('id');

    $record = WpnIssueRec::leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
        ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
        ->select(
            'wpn_issue_rec.emp_id', 
            'wpn_types.type', 
            DB::raw("CASE 
                        WHEN wpn_issue_rec.nature = 0 THEN 'Less than 24hr' 
                        WHEN wpn_issue_rec.nature = 1 THEN 'More than 24hr' 
                        ELSE 'Unknown' 
                    END AS nature"),
            'wpn_issue_rec.purpose', 
            'wpn_issue_rec.megazins as Magazine', 
            'wpn_issue_rec.slings', 
            'wpn_issue_rec.bayonet',
            'wpn_issue_rec.remark', 
            DB::raw("DATE_FORMAT(wpn_issue_rec.created_at, '%d-%m-%Y %H:%i:%s') AS Issue_Date") // Formatting date
        )
        ->where('wpn_issue_rec.emp_id', $id)
        ->where('wpn_issue_rec.status', 0)
        ->whereNull('wpn_issue_rec.return_date')
        ->orderBy('wpn_issue_rec.created_at', 'desc') // Sorting in descending order
        ->get();

    return response()->json($record);
}


public function weapon_history($id){
    
    $query = WpnIssueRec::select([
        'wpn_issue_rec.*',
        'rank.rank_name',
        'employees.name as emp_name',
        'employees.emp_id',
        'wpn_types.type',
        'wpn_list.regd_no',
        'wpn_list.butt_no',
        'wpn_list.wpn_tag',
        'wpn_ret_mag_history.ret_megazins',
        'wpn_ret_mag_history.ret_slings',
        'wpn_ret_mag_history.ret_bayonet',
        'wpn_issue_rec.created_at',
        'wpn_list.status',
      
    ])
    ->leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
    ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
    ->leftJoin('employees', 'employees.emp_id', '=', 'wpn_issue_rec.emp_id')
    ->leftJoin('rank', 'rank.id', '=', 'employees.rank_id')
    ->leftJoin('wpn_ret_mag_history', 'wpn_ret_mag_history.issue_id', '=', 'wpn_issue_rec.id')
    ->where('wpn_ret_mag_history.emp_id',$id)
    ->where('wpn_issue_rec.status', 1)
    ->whereNotNull('return_date');

  $records = $query->paginate(20);

  $count = $query->count();
    return view('admin.dashboard.weapon_history',compact('records','count'));

}
public function weapon_current_history(Request $request) {

    $id = $request->get('id');
    
    $record = WpnIssueRec::where('wpn_id', $id)
    ->where('status', 0)
    ->whereNull('return_date')
    ->get();

    return response()->json($record);
}
public function weapon_issue_history($id){
       $query = WpnIssueRec::select([
        'wpn_issue_rec.*',
        'rank.rank_name',
        'employees.name as emp_name',
        'employees.emp_id',
        'wpn_types.type',
        'wpn_list.regd_no',
        'wpn_list.butt_no',
        'wpn_list.wpn_tag',
        'wpn_ret_mag_history.ret_megazins',
        'wpn_ret_mag_history.ret_slings',
        'wpn_ret_mag_history.ret_bayonet',
        'wpn_issue_rec.created_at',
        'wpn_list.status',
      
    ])
    ->leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_issue_rec.wpn_id')
    ->leftJoin('wpn_types', 'wpn_types.id', '=', 'wpn_list.wpn_type')
    ->leftJoin('employees', 'employees.emp_id', '=', 'wpn_issue_rec.emp_id')
    ->leftJoin('rank', 'rank.id', '=', 'employees.rank_id')
    ->leftJoin('wpn_ret_mag_history', 'wpn_ret_mag_history.issue_id', '=', 'wpn_issue_rec.id')
    ->where('wpn_issue_rec.wpn_id',$id)
    ->where('wpn_issue_rec.status', 1)
    ->whereNotNull('return_date');

  $records = $query->paginate(20);
//   dd($records);

return view('admin.dashboard.weapon_issue_history',compact('records'));
}

public function allot_wpn_report(Request $request)
{

    $filters = $request->only(['rank', 'unit', 'company', 'name', 'emp_id']);

    $query = Employee::select([
            'employees.*',
            'wpn_allot.*',
            'wpn_list.wpn_type',
            'wpn_list.regd_no',
            'wpn_list.butt_no',
            'wpn_list.wpn_tag',
            'rank.rank_name',
            'units.unit_name',
            'companys.company_name'
        ])
        ->with("wpn_types")
        ->join('wpn_allot', 'wpn_allot.emp_id', '=', 'employees.emp_id')
        ->leftJoin('wpn_list', 'wpn_list.id', '=', 'wpn_allot.wpn_id')
        ->leftJoin('rank', 'rank.id', '=', 'employees.rank_id')
        ->leftJoin('units', 'units.id', '=', 'employees.unit_id')
        ->leftJoin('companys', 'companys.id', '=', 'employees.company_id');

    // Apply filters using request()
    if ($request->filled('rank')) {
        $query->where('employees.rank_id', $request->rank);
    }
    if ($request->filled('unit')) {
        $query->where('employees.unit_id', $request->unit);
    }
    if ($request->filled('company')) {
        $query->where('employees.company_id', $request->company);
    }
    if ($request->filled('name')) {
        $query->where('employees.name', 'like', '%' . $request->name . '%');
    }
    if ($request->filled('emp_id')) {
        $query->where('employees.emp_id', $request->emp_id);
    }

    // Paginate and preserve filters
    $employees = $query->paginate(50)->appends($filters);


    if ($request->has('export_excel')) {
        $excelData = $query->get()->map(function ($item, $index) {
            return [
                'S.No' => $index + 1,  // Auto-increment serial number
                'Emp ID' => $item->emp_id,
                'Name' => $item->name,
                'Mobile' => $item->mobile,
                'Status' => $item->status == 1 ? 'Active' : 'Inactive',
                'Rank Name' => $item->rank_name,
                'Unit Name' => $item->unit_name,
                'Company Name' => $item->company_name,
                'Assign Type' => $item->assign_type,
                'Weapon Tag' => $item->wpn_tag,
                'Weapon Type' => $item->wpn_type,
                'Regd No.' => $item->regd_no,
                'Butt No.' => $item->butt_no,
            ];
        });

        return Excel::download(new class($excelData) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                $headers = [
                    "S.No", "Emp ID", "Name", "Mobile", "Status", "Rank Name", "Unit Name", 
                    "Company Name", "Assign Type", "Weapon Tag", "Weapon Type", "Regd No.", "Butt No."
                ];

                return array_merge([$headers], $this->data->toArray());
            }
        }, 'allotment_report.xlsx');
    }

    // Fetch dropdown values
    $ranks = Rank::all();
    $units = Unit::all();
    $companies = Company::all();

    return view('admin.dashboard.allot_wpn_report', compact('employees', 'ranks', 'units', 'companies','filters'));
}
public function wpn_list(Request $request)
{
    $query = WpnList::with(['wpn_types', 'company']);

    $filters = $request->only(['wpn_tag', 'wpn_type', 'regd_no', 'butt_no', 'company', 'service']);

    if (!empty($filters['wpn_tag'])) {
        $query->where('wpn_tag', $filters['wpn_tag']);
    }
    if (!empty($filters['wpn_type'])) {
        $query->where('wpn_type', $filters['wpn_type']);
    }
    if (!empty($filters['regd_no'])) {
        $query->where('regd_no', $filters['regd_no']);
    }
    if (!empty($filters['butt_no'])) {
        $query->where('butt_no', $filters['butt_no']);
    }
    if (!empty($filters['company'])) {
        $query->where('company_id', $filters['company']);
    }
    if (!empty($filters['service'])) {
        $query->where('servicability', $filters['service']);
    }

    $totalRecords = $query->count();
    $data = $query->orderBy('id', 'desc')->paginate(50)->appends($filters);

    $weapons = $data;
    if ($request->has('export_excel')) {
        $excelData = $query->get();
        $exportData = $excelData->map(function ($item) {
            return [
                'WPN Tag' => $item->wpn_tag,
                'WPN Type' => $item->wpn_types->type,
                'Regd No' => $item->regd_no,
                'Butt No' => $item->butt_no,
                'Company' => $item->company->company_name,
                'Serviceability' => $item->servicability,
            ];
        });

        return Excel::download(new class($exportData) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct($data) { $this->data = $data; }
            public function array(): array {
                $headers = ['WPN Tag', 'WPN Type', 'Regd No', 'Butt No', 'Company', 'Serviceability'];
                return array_merge([$headers], $this->data->toArray());
            }
        }, 'wpn_list.xlsx');
    }

    $wpntype = WpnType::get();
    $companies = Company::get();

    return view('admin.dashboard.wpn_list', compact('data','weapons', 'wpntype', 'companies', 'filters','totalRecords'));
}

public function indl_list(Request $request)
{
    // Initialize query
    $query = Employee::with(['rank', 'unit', 'company']);

    // Capture filter inputs
    $filters = $request->only(['emp_id', 'name', 'rank', 'unit', 'company', 'status']);

    // Apply filters
    if (!empty($filters['emp_id'])) {
        $query->where('emp_id', 'like', '%' . $filters['emp_id'] . '%');
    }

    if (!empty($filters['name'])) {
        $query->where('name', 'like', '%' . $filters['name'] . '%');
    }

    if (!empty($filters['rank'])) {
        $query->where('rank_id', $filters['rank']);
    }

    if (!empty($filters['unit'])) {
        $query->where('unit_id', $filters['unit']);
    }

    if (!empty($filters['company'])) {
        $query->where('company_id', $filters['company']);
    }

    if (!empty($filters['status'])) {
        $query->where('status', $filters['status']);
    }

    $totalRecords = $query->count();
    
    // Paginate with filters
    $employee = $query->orderby('id','DESC')->paginate(50)->appends($filters);
    
    // Fetch filter options
    $ranks = Rank::all();
    $units = Unit::all();
    $companies = Company::all();
    
    // Export feature
    if ($request->has('export_excel')) {
        $excelData = $query->get();
        $exportData = $excelData->map(function ($item) {
            return [
                $item->emp_id,
                $item->name,
                $item->rank->rank_name ?? '',
                $item->unit->unit_name ?? '',
                $item->company->company_name ?? '',
               
            ];
        });

        return Excel::download(new class($exportData) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                $headers = [
                    "ID No", "Name", "Rank", "Unit", "Company"
                ];

                return array_merge([$headers], $this->data->toArray());
            }
        }, 'individualList.xlsx');
    }
    
    // Return view with data
    return view('admin.dashboard.indl_list', compact('employee', 'ranks', 'units', 'companies', 'filters', 'totalRecords'));
}

}