@extends("layouts.auth")

@section('title')
    Register
@endsection

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="text-center">
                <h1>Joal <sup>id</sup></h1>
            </div>
            <div class="row align-items-center justify-content-center row-login">
                <div class="col-lg-6 text-center">
                    <p class="">Register</p>
                    <img src="/images/login-placeholder.png" alt="" class="w-50 mb-4 mb-lg-none">
                </div>
                <div class="col-lg-5">
                    <h2>
                    Belanja kebutuhan utama, <br>
                    menjadi lebih mudah
                    </h2>
                    <form method="POST" action="{{ route('register') }}" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input id="password-confirm" 
                                type="password" 
                                class="form-control @error('password_confirmation') is-invalid @enderror" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p>
                            Already Have Account ? 
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                    Login
                            </a>
                        </p>
                            <button type="submit" class="btn btn-success m-btn btn-block mt-4">
                                Register
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        Vue.use(Toasted);

        var register = new Vue({
            el: '#register',
            mounted() {
                AOS.init();
            },
            methods: {
                checkForEmailAvailability: function() {
                    var self = this;
                    axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: this.email
                        }
                    })
                    .then(function (response) {

                        if(response.data == 'Available') {
                            self.$toasted.show(
                            "Email anda tersedia! silahkan lanjut langkah selanjutnya",
                            {
                                position: "top-center",
                                className: "rounded",
                                duration: 5000
                            }
                            );
                            self.email_unavailable = false;
                        }else {
                            self.$toasted.error(
                            "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                            {
                                position: "top-center",
                                className: "rounded",
                                duration: 5000
                            }
                            );
                            self.email_unavailable = true;
                        }
                    })
                }
            },
            data() {
                return {
                name: "",
                email: "",
                is_store_open: true,
                store_name: "",
                email_unavailable: false
                }
            },
        });
    </script>
@endpush --}}
