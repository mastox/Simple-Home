@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile informations</div>

                <div class="card-body">
                    {!! form($profileInformationForm) !!}
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row justify-content-center" id="settings">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('user.setting') }}</div>

                <div class="card-body">
                    {!! form($settingForm) !!}
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Password change</div>

                <div class="card-body">
                    {!! form($changePasswordForm) !!}
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete account</div>

                <div class="card-body">
                    <?php if (Session::get('verifyDelete')): ?>
                        {!! form($realyDeleteProfileForm) !!}
                    <?php else: ?>
                        {!! form($deleteProfileForm) !!}
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">MFA - Muti Factor Authentication</div>

                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Private API Tokens</div>

                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
