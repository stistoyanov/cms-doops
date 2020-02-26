@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                </div>
                <hr>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Magento project"
                               value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="branches_name">Branches name</label>
                        <input type="text" id="{{ $branchNameIdentifier }}" name="{{ $branchNameIdentifier }}"
                               class="form-control" placeholder="magento_project"
                               value="{{ old($branchNameIdentifier) }}">
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" class="form-control" name="type">
                            @foreach($types as $key => $val)
                                <option value="{{ $key }}"{{ old('type') == $key ? ' selected' : '' }}>{{ ucfirst($val) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="magento2-env">
                <hr>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_HOST'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_MYSQL_HOST']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_HOST'] }}"
                               name="{{ $dataMapper['MAGENTO_MYSQL_HOST'] }}" type="text" class="form-control"
                               placeholder="db" value="{{ old($dataMapper['MAGENTO_MYSQL_HOST']) }}">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_USER'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_MYSQL_USER']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_USER'] }}"
                               name="{{ $dataMapper['MAGENTO_MYSQL_USER'] }}" type="text" class="form-control"
                               placeholder="magento" value="{{ old($dataMapper['MAGENTO_MYSQL_USER']) }}">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] }}"
                               name="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] }}" type="password"
                               class="form-control" placeholder="*****">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] . '_confirmation' }}">Repeat
                            password!</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] . '_confirmation' }}"
                               name="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] . '_confirmation' }}" type="password"
                               class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_DATABASE'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_MYSQL_DATABASE']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_DATABASE'] }}"
                               name="{{ $dataMapper['MAGENTO_MYSQL_DATABASE'] }}" type="text" class="form-control"
                               placeholder="magento" value="{{ old($dataMapper['MAGENTO_MYSQL_DATABASE']) }}">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_MYSQL_PASSWORD']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] }}"
                               name="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] }}" type="password" class="form-control"
                               placeholder="*****">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] . '_confirmation' }}">Repeat
                            password!</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] . '_confirmation' }}"
                               name="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] . '_confirmation' }}" type="password"
                               class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_LANGUAGE'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_LANGUAGE']))) }}</label>
                        <select id="{{ $dataMapper['MAGENTO_LANGUAGE'] }}" class="form-control"
                                name="{{ $dataMapper['MAGENTO_LANGUAGE'] }}">
                            @foreach($languages as $language)
                                <option value="{{ $language['id'] }}"{{ old($dataMapper['MAGENTO_LANGUAGE']) == $language['id'] ? ' selected' : '' }}>{{ $language['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_TIMEZONE'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_TIMEZONE']))) }}</label>
                        <select id="{{ $dataMapper['MAGENTO_TIMEZONE'] }}" class="form-control"
                                name="{{ $dataMapper['MAGENTO_TIMEZONE'] }}">
                            @foreach($timezones as $timezone)
                                <option value="{{ $timezone['id'] }}"{{ old($dataMapper['MAGENTO_TIMEZONE']) == $timezone['id'] ? ' selected' : '' }}>{{ $timezone['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_DEFAULT_CURRENCY'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_DEFAULT_CURRENCY']))) }}</label>
                        <select id="{{ $dataMapper['MAGENTO_DEFAULT_CURRENCY'] }}" class="form-control"
                                name="{{ $dataMapper['MAGENTO_DEFAULT_CURRENCY'] }}">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency['id'] }}"{{ old($dataMapper['MAGENTO_DEFAULT_CURRENCY']) == $currency['id'] ? ' selected' : '' }}>{{ $currency['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label for="{{ $dataMapper['MAGENTO_URL'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_URL']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_URL'] }}" name="{{ $dataMapper['MAGENTO_URL'] }}" type="text"
                               class="form-control" placeholder="http://local.magento"
                               value="{{ old($dataMapper['MAGENTO_URL']) }}">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label for="{{ $dataMapper['MAGENTO_BACKEND_FRONTNAME'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_BACKEND_FRONTNAME']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_BACKEND_FRONTNAME'] }}"
                               name="{{ $dataMapper['MAGENTO_BACKEND_FRONTNAME'] }}" type="text" class="form-control"
                               placeholder="admin" value="{{ old($dataMapper['MAGENTO_BACKEND_FRONTNAME']) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_USE_SECURE'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_USE_SECURE']))) }}</label>
                        <select id="{{ $dataMapper['MAGENTO_USE_SECURE'] }}" class="form-control"
                                name="{{ $dataMapper['MAGENTO_USE_SECURE'] }}">
                            <option value="0"{{ old($dataMapper['MAGENTO_USE_SECURE']) == '0' ? ' selected' : '' }}>No
                            </option>
                            <option value="1"{{ old($dataMapper['MAGENTO_USE_SECURE']) == '1' ? ' selected' : '' }}>
                                Yes
                            </option>
                        </select>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_BASE_URL_SECURE'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_BASE_URL_SECURE']))) }}</label>
                        <select id="{{ $dataMapper['MAGENTO_BASE_URL_SECURE'] }}" class="form-control"
                                name="{{ $dataMapper['MAGENTO_BASE_URL_SECURE'] }}">
                            <option value="0"{{ old($dataMapper['MAGENTO_BASE_URL_SECURE']) == '0' ? ' selected' : '' }}>
                                No
                            </option>
                            <option value="1"{{ old($dataMapper['MAGENTO_BASE_URL_SECURE']) == '1' ? ' selected' : '' }}>
                                Yes
                            </option>
                        </select>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_USE_SECURE_ADMIN'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_USE_SECURE_ADMIN']))) }}</label>
                        <select id="{{ $dataMapper['MAGENTO_USE_SECURE_ADMIN'] }}" class="form-control"
                                name="{{ $dataMapper['MAGENTO_USE_SECURE_ADMIN'] }}">
                            <option value="0"{{ old($dataMapper['MAGENTO_USE_SECURE_ADMIN']) == '0' ? ' selected' : '' }}>
                                No
                            </option>
                            <option value="1"{{ old($dataMapper['MAGENTO_USE_SECURE_ADMIN']) == '1' ? ' selected' : '' }}>
                                Yes
                            </option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_ADMIN_FIRSTNAME'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_ADMIN_FIRSTNAME']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_ADMIN_FIRSTNAME'] }}"
                               name="{{ $dataMapper['MAGENTO_ADMIN_FIRSTNAME'] }}" type="text" class="form-control"
                               placeholder="Admin" value="{{ old($dataMapper['MAGENTO_ADMIN_FIRSTNAME']) }}">
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_ADMIN_LASTNAME'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_ADMIN_LASTNAME']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_ADMIN_LASTNAME'] }}"
                               name="{{ $dataMapper['MAGENTO_ADMIN_LASTNAME'] }}" type="text" class="form-control"
                               placeholder="MyStore" value="{{ old($dataMapper['MAGENTO_ADMIN_LASTNAME']) }}">
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_ADMIN_EMAIL'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_ADMIN_EMAIL']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_ADMIN_EMAIL'] }}"
                               name="{{ $dataMapper['MAGENTO_ADMIN_EMAIL'] }}" type="text" class="form-control"
                               placeholder="amdin@example.com" value="{{ old($dataMapper['MAGENTO_ADMIN_EMAIL']) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label for="{{ $dataMapper['MAGENTO_ADMIN_USERNAME'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_ADMIN_USERNAME']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_ADMIN_USERNAME'] }}"
                               name="{{ $dataMapper['MAGENTO_ADMIN_USERNAME'] }}" type="text" class="form-control"
                               placeholder="admin" value="{{ old($dataMapper['MAGENTO_ADMIN_USERNAME']) }}">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_ADMIN_PASSWORD'] }}">{{ ucfirst(strtolower(str_replace('_', ' ', $dataMapper['MAGENTO_ADMIN_PASSWORD']))) }}</label>
                        <input id="{{ $dataMapper['MAGENTO_ADMIN_PASSWORD'] }}"
                               name="{{ $dataMapper['MAGENTO_ADMIN_PASSWORD'] }}" type="password" class="form-control"
                               placeholder="*****">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_ADMIN_PASSWORD'] . '_confirmation' }}">Repeat
                            password!</label>
                        <input id="{{ $dataMapper['MAGENTO_ADMIN_PASSWORD'] . '_confirmation' }}"
                               name="{{ $dataMapper['MAGENTO_ADMIN_PASSWORD'] . '_confirmation' }}" type="password"
                               class="form-control">
                    </div>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="detail">Detail:</label>
                        <textarea class="form-control" id="detail" rows="5" name="detail"
                                  placeholder="Detail . . .">{{ old('detail') }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>
    @include('partials.productScripts')
@endsection