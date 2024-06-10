<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Customer;

class CustomerController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/customers');
    }

    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();
        return view('panel.customers.index', compact('customers'));
    }

    public function create(Customer $customer)
    {
        return view('panel.customers.create', compact('customer'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Customer::create($data);
        return redirect('/panel/customers')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['logo'] = $fileName;
        }
        return $data;
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('panel.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $data = $this->handleRequest($request);
        $customer->update($data);
        return redirect('/panel/customers')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect('/panel/customers')->with('success', 'با موفقیت حذف شد!');
    }
}
