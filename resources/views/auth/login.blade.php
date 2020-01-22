@extends('layouts.app')

@section('title')

@endsection

@section('style')
  <link rel="stylesheet" href="/css/auth.css">
@endsection

@section('content')
  <section class="probootstrap_section" style="background: #fff;">
    <div class="container">
      <div class="row login-row">
        <div class="col-md-12  probootstrap-animate">
          <form action="{{ url('/login') }}" method="post"
                class="probootstrap-form probootstrap-form-box mb60 text-center">
            @csrf
{{--            <h4 class="mb-5">로그인</h4>--}}
            <a class="col-md-12 navbar-brand mb-3" href="/" ><img src="//cloudfront.mo-zip.co.kr/mo-zip/images/logo-black.svg"
                                                  class="logo-height" style="width: 100%" ></a>
            <div class="form-group">
              <a href="{{ url('/google/login') }}" id="google-login-btn" class="btn btn-primary btn_google"><span><i
                    class="icon-ic_login_google"></i> 로그인</span></a>
            </div>
            <div class="form-group">
              <a href="{{ url('/facebook/login') }}" id="fb-login-btn" class="btn btn-primary btn_fb"><span><i
                    class="icon-ic_login_fb"></i> 로그인</span></a>
            </div>
            <div class="form-group">
              <a href="{{ url('/kakao/login') }}" id="kakao-login-btn" class="btn btn-primary btn_kakao"><span><i
                    class="icon-ic_login_kakaotalk"></i> 로그인</span></a>
            </div>
            <div class="form-group">
              <a href="{{ url('/naver/login') }}" id="naver-login-btn" class="btn btn-primary btn_naver"><span><i
                    class="icon-ic_login_naver"></i> 로그인</span></a>
            </div>
            <p class="space_or"><span>또는</span></p>
            @if (session('error'))
              <label class="form-group mb-1">
                <span class="text-danger">{{ session('error') }}</span>
              </label>
            @endif
            <div class="form-group">
              <label for="email" class="sr-only sr-only-focusable">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                     placeholder="이메일 주소">
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <div class="form-group">
              <label for="password" class="sr-only sr-only-focusable">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                     name="password" placeholder="비밀번호">
              @error('password')
              <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary w-100" value="로그인">
            </div>
            <div class="sign-up-box">
              <span class="login-info-text">비밀번호를 잃어버리셨다구요?</span>
              <a class="sign-up underline login-sub-text text-highlight" name="btn-join" href="/verify">비밀번호 찾기</a>
            </div>
            <div class="sign-up-box">
              <span class="login-info-text">아직 모집 멤버가 아니세요?</span>
              <a class="sign-up underline login-sub-text text-highlight" name="btn-join" href="/register">회원가입</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->
@endsection

@section('scripts')
@endsection
