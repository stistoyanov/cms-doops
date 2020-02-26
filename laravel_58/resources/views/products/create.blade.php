@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" class="form-control" name="type">
                            @foreach($types as $key => $val)
                                <option value="{{ $key }}">{{ ucfirst($val) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="magento2-env">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_HOST'] }}">{{ $dataMapper['MAGENTO_MYSQL_HOST'] }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_HOST'] }}" name="{{ $dataMapper['MAGENTO_MYSQL_HOST'] }}" type="text" class="form-control" placeholder="db">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_USER'] }}">{{ $dataMapper['MAGENTO_MYSQL_USER'] }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_USER'] }}" name="{{ $dataMapper['MAGENTO_MYSQL_USER'] }}" type="text" class="form-control" placeholder="magento">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] }}">{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] }}" name="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] }}" type="password" class="form-control" placeholder="*****">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] . '_CONFIRM' }}">{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] . '_CONFIRM' }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] . '_CONFIRM' }}" name="{{ $dataMapper['MAGENTO_MYSQL_ROOT_PASSWORD'] . '_CONFIRM' }}" type="text" class="form-control" placeholder="*****">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_DATABASE'] }}">{{ $dataMapper['MAGENTO_MYSQL_DATABASE'] }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_DATABASE'] }}" name="{{ $dataMapper['MAGENTO_MYSQL_DATABASE'] }}" type="text" class="form-control" placeholder="magento">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] }}">{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] }}" name="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] }}" type="password" class="form-control" placeholder="*****">
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <label for="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] . '_CONFIRM' }}">{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] . '_CONFIRM' }}</label>
                        <input id="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] . '_CONFIRM' }}" name="{{ $dataMapper['MAGENTO_MYSQL_PASSWORD'] . '_CONFIRM' }}" type="text" class="form-control" placeholder="*****">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_LANGUAGE'] }}">{{ $dataMapper['MAGENTO_LANGUAGE'] }}</label>
                        <select id="{{ $dataMapper['MAGENTO_LANGUAGE'] }}" class="form-control" name="{{ $dataMapper['MAGENTO_LANGUAGE'] }}">
                            @foreach($languages as $language)
                                <option value="{{ $language['id'] }}">{{ $language['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_TIMEZONE'] }}">{{ $dataMapper['MAGENTO_TIMEZONE'] }}</label>
                        <select id="{{ $dataMapper['MAGENTO_TIMEZONE'] }}" class="form-control" name="{{ $dataMapper['MAGENTO_TIMEZONE'] }}">
                            @foreach($timezones as $timezone)
                                <option value="{{ $timezone['id'] }}">{{ $timezone['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <label for="{{ $dataMapper['MAGENTO_DEFAULT_CURRENCY'] }}">{{ $dataMapper['MAGENTO_DEFAULT_CURRENCY'] }}</label>
                        <select id="{{ $dataMapper['MAGENTO_DEFAULT_CURRENCY'] }}" class="form-control" name="{{ $dataMapper['MAGENTO_DEFAULT_CURRENCY'] }}">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency['id'] }}">{{ $currency['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="details">Details:</label>
                        <textarea class="form-control" id="details" style="height:150px" name="detail"
                                  placeholder="Detail"></textarea>
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