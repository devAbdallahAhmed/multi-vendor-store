<x-front-layouts title="Login">

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Tow Factor Authentication</h3>
                                <p>You can Enable/Disable 2FA .</p>
                            </div>

                            @if (session('status') == 'two-factor-authentication-confirmed')
                                <div class="mb-4 font-medium text-sm">
                                    Two factor authentication confirmed and enabled successfully.
                                </div>
                            @endif
                            <div class="button">
                                @if ($user)
                                    @if (!$user->two_factor_secret)
                                        <button class="btn" type="submit">Enable</button>
                                    @else
                                        {!! Auth::user()->twoFactorQrCodeSvg() !!}
                                        @method('DELETE')
                                        <button class="btn" type="submit">Disable</button>
                                    @endif
                                @else
                                    <p class="text-danger">Please login to manage two-factor authentication.</p>
                                @endif
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-front-layouts>
