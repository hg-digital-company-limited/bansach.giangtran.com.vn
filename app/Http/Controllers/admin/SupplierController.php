<?php
namespace App\Http\Controllers\admin;

use App\Models\admin\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate();

        return view('admin.supplier.index', compact('suppliers'))
            ->with('i', (request()->input('page', 1) - 1) * $suppliers->perPage());
    }

    public function create()
    {
        $supplier = new Supplier();
        return view('admin.supplier.create', compact('supplier'));
    }

    public function store(Request $request)
    {
        request()->validate(Supplier::$rules);

        // Không cần thêm CreatedBy và ModifiedBy
        $supplier = Supplier::create($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Nhà cung cấp đã được tạo thành công.');
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        return view('admin.supplier.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        request()->validate(Supplier::$rules);

        // Không cần thêm ModifiedBy
        $supplier->update($request->all());

        return redirect()->route('supplier.index')
            ->with('success', 'Nhà cung cấp đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        Supplier::find($id)->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Nhà cung cấp đã được xóa thành công.');
    }

    public function getAll()
    {
        return response()->json(Supplier::all());
    }
}
