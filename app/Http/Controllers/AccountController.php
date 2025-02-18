<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Account::create([
            'name' => $request->name,
        ]);

        return redirect()->route('accounts.index')->with('success', 'حساب جدید با موفقیت اضافه شد!');
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $account = Account::findOrFail($id);
        $account->update([
            'name' => $request->name,
        ]);

        return redirect()->route('accounts.index')->with('success', 'حساب با موفقیت به‌روزرسانی شد!');
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'حساب با موفقیت حذف شد!');
    }
}
