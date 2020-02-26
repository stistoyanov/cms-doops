<?php

namespace App\Http\Controllers;

use App\Helpers\Currency;
use App\Helpers\DataMapper;

use App\Helpers\Language;
use App\Helpers\Timezone;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(DataMapper::DEFAULT_PAGINATE);
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * DataMapper::DEFAULT_PAGINATE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Product::$types;
        return view('products.create', [
            'types' => $types,
            'branchNameIdentifier' => DataMapper::BRANCH_NAME_IDENTIFIER,
            'dataMapper' => DataMapper::$magentoEnvSettings,
            'currencies' => Currency::all(),
            'languages' => Language::all(),
            'timezones' => Timezone::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('type') && $request->get('type') == Product::getTypeIndex(Product::TYPE_MAGENTO_2)) {
            request()->validate([
                'name' => 'required|max:255',
                'detail' => 'required|max:1000',
                DataMapper::BRANCH_NAME_IDENTIFIER => 'required|min:6|max:255',
                DataMapper::MAGENTO_MYSQL_HOST => 'required|min:2|max:255',
                DataMapper::MAGENTO_MYSQL_USER => 'required|min:2|max:255',
                DataMapper::MAGENTO_MYSQL_ROOT_PASSWORD => 'required|min:6|confirmed',
                DataMapper::MAGENTO_MYSQL_DATABASE => 'required|min:2|max:255',
                DataMapper::MAGENTO_MYSQL_PASSWORD => 'required|min:6|confirmed',
                DataMapper::MAGENTO_LANGUAGE => 'required',
                DataMapper::MAGENTO_TIMEZONE => 'required',
                DataMapper::MAGENTO_DEFAULT_CURRENCY => 'required',
                DataMapper::MAGENTO_URL => 'required|url',
                DataMapper::MAGENTO_BACKEND_FRONTNAME => 'required|max:255',
                DataMapper::MAGENTO_USE_SECURE => 'required',
                DataMapper::MAGENTO_BASE_URL_SECURE => 'required',
                DataMapper::MAGENTO_USE_SECURE_ADMIN => 'required',
                DataMapper::MAGENTO_ADMIN_FIRSTNAME => 'required|min:2|max:255',
                DataMapper::MAGENTO_ADMIN_LASTNAME => 'required|min:2|max:255',
                DataMapper::MAGENTO_ADMIN_EMAIL => 'required|max:255|email',
                DataMapper::MAGENTO_ADMIN_USERNAME => 'required|min:2|max:255',
                DataMapper::MAGENTO_ADMIN_PASSWORD => 'required|min:6|confirmed',
            ]);
        } else {
            // No other types for now so we redirect to products
            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        }

        $productId = Product::selfCreate($request->all());

        // TODO - next put in queue for handling

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $types = Product::$types;
        return view('products.show', [
            'product' => $product,
            'types' => $types,
            'branchNameIdentifier' => DataMapper::BRANCH_NAME_IDENTIFIER,
            'dataMapper' => DataMapper::$magentoEnvSettings,
            'currencies' => Currency::all(),
            'languages' => Language::all(),
            'timezones' => Timezone::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $types = Product::$types;
        return view('products.edit', [
            'product' => $product,
            'types' => $types,
            'branchNameIdentifier' => DataMapper::BRANCH_NAME_IDENTIFIER,
            'dataMapper' => DataMapper::$magentoEnvSettings,
            'currencies' => Currency::all(),
            'languages' => Language::all(),
            'timezones' => Timezone::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}