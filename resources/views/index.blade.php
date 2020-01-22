@extends('layouts.layout')

@section('title')

@endsection

@section('style')
  <link rel="stylesheet" href="/css/swiper.min.css">
  <style>
    #search {
      display: none;
    }
    .swiper-button-next:after, .swiper-container-rtl .swiper-button-prev:after {
      content: 'next';
      color: #aaa;
    }
    .swiper-button-prev:after, .swiper-container-rtl .swiper-button-next:after {
      content: 'prev';
      color: #aaa;
    }
  </style>
@endsection

@section('content')
  <form name="paging">
    @csrf
    <input type="hidden" name="url"/>
    <input type="hidden" name="type"/>
    <input type="hidden" name="idx"/>
    <input type="hidden" name="sido"/>
    <input type="hidden" name="sigungu"/>
  </form>

  <section class="probootstrap-cover overflow-hidden relative" style="background-image: url('{{ $s3 }}/images/bg.jpg');"
           data-stellar-background-ratio="0.5" id="section-home">
    <div class="overlay"></div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md">
          <div class="header-search-bar">
            <div class="inner">
              <div class="searchbar">
                <div class="main-header-title-text-box">
                  <div class="main-header-title-text">
                      어디로 떠나고 싶으세요 ?
                  </div>
                </div>
                <div class="input-group" style="position: relative;">
                  <img src="{{ $s3 }}/images/serchbar.svg" class="main-search-ic">
                  <input type="text" placeholder="지역명 또는 공간명을 검색하세요."  autocomplete="off" class="form-control" style="border-radius: 0;"
                         onkeyup="search(this.value);" onfocus="searchShow();" onblur="searchHide();" >
                  <div class="searchresult-container" id="search">
                    <div class="searchresult-content searchresult-items">
                      <div class="searchresultitem-container searchresultitem-container-searched" id="searchresult">
                        <div class="searchresultitem-container">
                          <div class="searchresultitem-title">핫스팟</div>
                          <div class="searchresultitem-items">
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '경기', '가평군');">가평</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '제주특별자치도', '서귀포시');">서귀포</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '제주특별자치도', '제주시');">제주</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '전남', '여수시');">여수</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '충남', '태안군');">태안</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '강원', '양양군');">양양</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '경남', '거제시');">거제</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '경북', '경주시');">경주</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '강원', '강릉시');">강릉</div>
                            </div>
                            <div class="searchresultitem-item">
                              <div onclick="goPostPage('community', '모텔', '0', '강원', '평창군');">평창</div>
                            </div>
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '노원구');">노원</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '성북구');">수유</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '성동구');">왕십리</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '광진구');">건대</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '송파구');">잠실</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '강남구');">강남</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '강동구');">천호</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '서대문구');">신촌</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '중구');">종로</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '서울', '관악구');">신림</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '경기', '부천시');">부천</div>--}}
{{--                            </div>--}}
{{--                            <div class="searchresultitem-item">--}}
{{--                              <div onclick="goPostPage('community', '모텔', '0', '경기', '부평시');">인천</div>--}}
{{--                            </div>--}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->


  <section class="probootstrap_section" style="padding-top: 7rem;">
    <div class="container">
      <div class="row text-center mb-5 probootstrap-animate">
        <div class="col-md-12">
          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">모든 예약 집합소!</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          {{--          <a href="/goods?type=모텔&idx=0" class="probootstrap-thumbnail">--}}
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '모텔', '0', '', '')">
            <img src="{{ $s3 }}/images/cate_01_motel_img.png" alt="모텔" class="img-fluid w-100" >
            <div class="probootstrap-text">
              {{--          <h3>Road</h3>--}}
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          {{--          <a href="/goods?type=호텔&idx=1" class="probootstrap-thumbnail">--}}
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '호텔', '1', '', '')">
            <img src="{{ $s3 }}/images/cate_02_hotel_img.png" alt="호텔" class="img-fluid w-100" >
            {{--          <h3>Road</h3>--}}
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          {{--          <a href="/goods?type=펜션&idx=2" class="probootstrap-thumbnail">--}}
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '펜션', '2', '', '')">
            <img src="{{ $s3 }}/images/cate_03_pension_img.png" alt="펜션" class="img-fluid w-100">
            {{--          <h3>Australia</h3>--}}
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          {{--          <a href="/goods?type=캠핑/글램핑&idx=3" class="probootstrap-thumbnail">--}}
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '캠핑/글램핑', '3', '', '')">
            <img src="{{ $s3 }}/images/cate_04_glamping_img.png" alt="글램핑" class="img-fluid w-100">
            {{--          <h3>Japan</h3>--}}
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          {{--          <a href="/goods?type=공간대여&idx=4" class="probootstrap-thumbnail">--}}
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '공간대여', '4', '', '')">
            <img src="{{ $s3 }}/images/cate_05_space_img.png" alt="공간대여" class="img-fluid w-100">
            {{--          <h3>Japan</h3>--}}
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-4 probootstrap-animate mb-3">
          {{--          <a href="/goods?type=모텔&idx=0" class="probootstrap-thumbnail">--}}
          <a href="#none" class="probootstrap-thumbnail" onclick="goPostPage('community', '모텔', '0', '', '')">
            <img src="{{ $s3 }}/images/cate_06_special_img.png" alt="" class="img-fluid w-100">
            {{--          <h3>Japan</h3>--}}
          </a>
        </div>
      </div>
    </div>
  </section>


{{--  <section class="probootstrap_section bg-light">--}}
{{--    <div class="container">--}}
{{--      <div class="row text-center mb-5 probootstrap-animate">--}}
{{--        <div class="col-md-12">--}}
{{--          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">기획전</h2>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="row">--}}
{{--        <div class="col-lg-3 col-6 probootstrap-animate mb-3">--}}
{{--          <a href="#" class="probootstrap-thumbnail2">--}}
{{--            <img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15628256865214.png?s=320x240?s=330x233"--}}
{{--                 alt="Free Template by uicookies.com" class="img-fluid">--}}
{{--            <div class="probootstrap-text">--}}
{{--              <h3>Buena</h3>--}}
{{--            </div>--}}
{{--          </a>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-6 probootstrap-animate mb-3">--}}
{{--          <a href="#" class="probootstrap-thumbnail2">--}}
{{--            <img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15591018541748.png?s=320x240?s=330x233"--}}
{{--                 alt="Free Template by uicookies.com" class="img-fluid">--}}
{{--            <h3>Road</h3>--}}
{{--          </a>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-6 probootstrap-animate mb-3">--}}
{{--          <a href="#" class="probootstrap-thumbnail2">--}}
{{--            <img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15591019070628.png?s=320x240?s=330x233"--}}
{{--                 alt="Free Template by uicookies.com" class="img-fluid">--}}
{{--            <h3>Australia</h3>--}}
{{--          </a>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-6 probootstrap-animate mb-3">--}}
{{--          <a href="#" class="probootstrap-thumbnail2">--}}
{{--            <img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15628256865214.png?s=320x240?s=330x233"--}}
{{--                 alt="Free Template by uicookies.com" class="img-fluid">--}}
{{--            <h3>Japan</h3>--}}
{{--          </a>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </section>--}}


  <section class="probootstrap_section d-none d-lg-inline-block">
    <div class="container">
      <a data-toggle="modal" data-target="#event" style="cursor: pointer">
{{--      <a href="https://blog.naver.com/mo-zip/221701934620" target="_blank">--}}
{{--        <img src="{{ $s3 }}/images/banner.png" class="w-100">--}}
        <img src="{{ $s3 }}/images/banner_03_2.png" class="w-100">
      </a>
    </div>
  </section>


  <section class="probootstrap_section d-block d-lg-none">
    <div class="container-fluid p-0">
      <a data-toggle="modal" data-target="#event">
{{--      <a href="https://blog.naver.com/mo-zip/221701934620" target="_blank" >--}}
{{--        <img src="{{ $s3 }}/images/m-banner.png" class="w-100" style="border-radius: 0 !important;">--}}
        <img src="{{ $s3 }}/images/banner_03_m.png" class="w-100" style="border-radius: 0 !important;">
      </a>
    </div>
  </section>

  {{--  <section class="probootstrap_section">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading">Our Services</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}


  {{--  <section class="probootstrap-section-half d-md-flex" id="section-about">--}}
  {{--    <div class="probootstrap-image probootstrap-animate" data-animate-effect="fadeIn"--}}
  {{--         style="background-image: url(/images/img_2.jpg)"></div>--}}
  {{--    <div class="probootstrap-text">--}}
  {{--      <div class="probootstrap-inner probootstrap-animate" data-animate-effect="fadeInRight">--}}
  {{--        <h2 class="heading mb-4">예약 건당 수수료 없음</h2>--}}
  {{--        <p>예약 건수가 100건 이든 1,000건 이든 예약 건이 발생해도 수수료가 0원! 나만의 홈페이지, 예약창에 대한 월 정액비 외 예약건에 대한 수수료는 발생하지 않습니다.</p>--}}
  {{--        <p>내가 직접 운영하는 홈페이지와 예약창으로 단골고객을 잡으세요!</p>--}}
  {{--        <p><a href="#" class="btn btn-primary">더보기</a></p>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}


  {{--  <section class="probootstrap-section-half d-md-flex">--}}
  {{--    <div class="probootstrap-image order-2 probootstrap-animate" data-animate-effect="fadeIn"--}}
  {{--         style="background-image: url(/images/img_3.jpg)"></div>--}}
  {{--    <div class="probootstrap-text order-1">--}}
  {{--      <div class="probootstrap-inner probootstrap-animate" data-animate-effect="fadeInLeft">--}}
  {{--        <h2 class="heading mb-4">포털 사이트 + SNS컨텐츠 등록</h2>--}}
  {{--        <p>홈페이지 제작 완료 시 네이버와 다움과 같은 포털사이트 등록, 더불어 모집에서 운영하는 인스타그램과 페이스북, 블로그 컨텐츠 등록 서비스.</p>--}}
  {{--        <p>사장님의 홈페이지를 운영에 도움을 드리며, 온라인의 핫한 각종 채널에 적극적으로 홍보해드립니다.</p>--}}
  {{--        <p><a href="#" class="btn btn-primary">더보기</a></p>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  {{--  <!-- END section -->--}}

  @foreach($cate as $ca)
    <section class="probootstrap_section">
      <div class="container">
        <div class="row text-center mb-5 probootstrap-animate">
          <div class="col-md-12">
            <h2
              class="display-5 border-bottom probootstrap-section-heading mb-0"> {{ $ca->community_category_name }}</h2>
          </div>
        </div>

        <div class="row probootstrap-animate">
          <div class="col-md-12">
            <!-- Swiper -->
            <div class="swiper-container">
              <div class="swiper-wrapper">
                @foreach($contents[$ca->community_category_idx] as $con)
                  <div class="swiper-slide">
                    <a href="{{ $con->community_link }}" target="_blank">
                      <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">
                        <img src="{{ $con->community_image_route . $con->community_image_save_name }}" height="100%"
                             alt="Free Template by uiCookies" class="img-fluid">
                      </div>
                      <div class="media-body new-media-body">
                        <p class="mb-0 text-white font-weight-bold">{{ $con->community_name }}</p>
                        <p class="font-80">{{ $con->community_sido }} {{ $con->community_sigungu }}</p>
                      </div>
                    </a></div>
                @endforeach
              </div>
              <!-- Add Arrows -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endforeach

  {{--  <section class="probootstrap_section">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">힐링하기 좋은 호텔/모텔</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}

  {{--      <div class="row probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <div class="owl-carousel js-owl-carousel-2">--}}
  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--          </div>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  {{--  <!-- END section -->--}}


  {{--  <section class="probootstrap_section">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">여행으로 즐기는 펜션/글램핑</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}

  {{--      <div class="row probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <div class="owl-carousel js-owl-carousel-2">--}}
  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--          </div>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  {{--  <!-- END section -->--}}


  {{--  <section class="probootstrap_section">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">잠깐 사용 할 공간대여</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}

  {{--      <div class="row probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <div class="owl-carousel js-owl-carousel-2">--}}
  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--          </div>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  {{--  <!-- END section -->--}}



  @if (count($new_datas) > 0)
  <section class="probootstrap_section">
    <div class="container">
      <div class="row text-center mb-5 probootstrap-animate">
        <div class="col-md-12">
          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">신규 공간 추천</h2>
        </div>
      </div>

      <div class="row probootstrap-animate">
        <div class="col-md-12">
          <!-- Swiper -->
          <div class="swiper-container">
            <div class="swiper-wrapper">
              @foreach($new_datas as $new)
                <div class="swiper-slide">
                  <a href="{{ $new->community_link }}" target="_blank">
                    <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">
                      <img src="{{ $new->community_image_route . $new->community_image_save_name }}" height="100%"
                           alt="Free Template by uiCookies" class="img-fluid">
                    </div>
                    <div class="media-body new-media-body">
                      <p class="mb-0 text-white font-weight-bold">{{ $new->community_name }}</p>
                      <p class="font-80">{{ $new->community_sido }} {{ $new->community_sigungu }}</p>
                    </div>
                  </a></div>
              @endforeach
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
  <!-- END section -->


  {{--  <section class="probootstrap_section">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading mb-0">특가 이벤트 / 소식</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}

  {{--      <div class="row probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <div class="owl-carousel js-owl-carousel-2">--}}
  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--                <div class="media-body">--}}
  {{--                  <h5 class="mb-3">02. Service Title Here</h5>--}}
  {{--                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live--}}
  {{--                    the blind texts. </p>--}}
  {{--                </div>--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--                <div class="media-body">--}}
  {{--                  <h5 class="mb-3">02. Service Title Here</h5>--}}
  {{--                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live--}}
  {{--                    the blind texts. </p>--}}
  {{--                </div>--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--                <div class="media-body">--}}
  {{--                  <h5 class="mb-3">02. Service Title Here</h5>--}}
  {{--                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live--}}
  {{--                    the blind texts. </p>--}}
  {{--                </div>--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--                <div class="media-body">--}}
  {{--                  <h5 class="mb-3">02. Service Title Here</h5>--}}
  {{--                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live--}}
  {{--                    the blind texts. </p>--}}
  {{--                </div>--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--                <div class="media-body">--}}
  {{--                  <h5 class="mb-3">02. Service Title Here</h5>--}}
  {{--                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live--}}
  {{--                    the blind texts. </p>--}}
  {{--                </div>--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--            <div>--}}
  {{--              <div class="media probootstrap-media d-block align-items-stretch mb-4 probootstrap-animate">--}}
  {{--                <img src="/images/sq_img_2.jpg" alt="Free Template by uiCookies" class="img-fluid">--}}
  {{--                <div class="media-body">--}}
  {{--                  <h5 class="mb-3">02. Service Title Here</h5>--}}
  {{--                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live--}}
  {{--                    the blind texts. </p>--}}
  {{--                </div>--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--            <!-- END slide item -->--}}

  {{--          </div>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  <!-- END section -->

  {{--  <section>--}}
  {{--    <div class="container">--}}
  {{--      <img src="https://d2mgzmtdeipcjp.cloudfront.net/files/upload/15500289017806.jpg?s=1336x470" class="w-100">--}}
  {{--    </div>--}}
  {{--  </section>--}}


  {{--  <section class="probootstrap_section">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading">Travel With Us</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}

  {{--      <div class="row probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <div class="owl-carousel js-owl-carousel">--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-teatro-de-la-caridad"></span>--}}
  {{--              <em>Teatro de la Caridad</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-royal-museum-of-the-armed-forces"></span>--}}
  {{--              <em>Royal Museum of the Armed Forces</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-parthenon"></span>--}}
  {{--              <em>Parthenon</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-marina-bay-sands"></span>--}}
  {{--              <em>Marina Bay Sands</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-samarra-minaret"></span>--}}
  {{--              <em>Samarra Minaret</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-chiang-kai-shek-memorial"></span>--}}
  {{--              <em>Chiang Kai Shek Memorial</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-heuvelse-kerk-tilburg"></span>--}}
  {{--              <em>Heuvelse Kerk Tilburg</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-cathedral-of-cordoba"></span>--}}
  {{--              <em>Cathedral of Cordoba</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-london-bridge"></span>--}}
  {{--              <em>London Bridge</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-taj-mahal"></span>--}}
  {{--              <em>Taj Mahal</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-leaning-tower-of-pisa"></span>--}}
  {{--              <em>Leaning Tower of Pisa</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-burj-al-arab"></span>--}}
  {{--              <em>Burj al Arab</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-gate-of-india"></span>--}}
  {{--              <em>Gate of India</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-osaka-castle"></span>--}}
  {{--              <em>Osaka Castle</em>--}}
  {{--            </a>--}}
  {{--            <a class="probootstrap-slide" href="#">--}}
  {{--              <span class="flaticon-statue-of-liberty"></span>--}}
  {{--              <em>Statue of Liberty</em>--}}
  {{--            </a>--}}

  {{--          </div>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  {{--  <!-- END section -->--}}

  {{--  <section class="probootstrap_section bg-light">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading">More Services</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--      <div class="row">--}}
  {{--        <div class="col-md-6">--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_1.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <h5 class="mb-3">01. Service Title Here</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_2.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <h5 class="mb-3">02. Service Title Here</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--        </div>--}}
  {{--        <div class="col-md-6">--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_4.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <h5 class="mb-3">03. Service Title Here</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_5.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <h5 class="mb-3">04. Service Title Here</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  {{--  <!-- END section -->--}}


  {{--  <section class="probootstrap_section bg-light">--}}
  {{--    <div class="container">--}}
  {{--      <div class="row text-center mb-5 probootstrap-animate">--}}
  {{--        <div class="col-md-12">--}}
  {{--          <h2 class="display-5 border-bottom probootstrap-section-heading">News</h2>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--      <div class="row">--}}
  {{--        <div class="col-md-6">--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_1.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <span class="text-uppercase">January 1st 2018</span>--}}
  {{--              <h5 class="mb-3">Travel To United States Without Visa</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--              <p><a href="#">Read More</a></p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_2.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <span class="text-uppercase">January 1st 2018</span>--}}
  {{--              <h5 class="mb-3">Travel To United States Without Visa</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--              <p><a href="#">Read More</a></p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--        </div>--}}
  {{--        <div class="col-md-6">--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_4.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <span class="text-uppercase">January 1st 2018</span>--}}
  {{--              <h5 class="mb-3">Travel To United States Without Visa</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--              <p><a href="#">Read More</a></p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--          <div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate">--}}
  {{--            <div class="probootstrap-media-image" style="background-image: url(/images/img_5.jpg)">--}}
  {{--            </div>--}}
  {{--            <div class="media-body">--}}
  {{--              <span class="text-uppercase">January 1st 2018</span>--}}
  {{--              <h5 class="mb-3">Travel To United States Without Visa</h5>--}}
  {{--              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the--}}
  {{--                blind texts. </p>--}}
  {{--              <p><a href="#">Read More</a></p>--}}
  {{--            </div>--}}
  {{--          </div>--}}

  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </section>--}}
  <!-- END section -->

  <div class="modal fade" id="event" tabindex="-1" role="dialog" aria-labelledby="event"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;
    right: 0;
    top: 10px;">
            <span aria-hidden="true" style="padding: 0.25rem 0.75rem;    color: #fff;
    cursor: pointer;">×</span>
          </button>
          <img src="//cloudfront.mo-zip.co.kr/mo-zip/images/event-header_2.png" class="w-100">
{{--          <div class="col-12 text-center">--}}
{{--            <a href="http://mozip.quv.kr/56" target="_blank" class="btn btn-primary">입점 신청하기</a>--}}
{{--            <a data-dismiss="modal" aria-label="Close" class="btn btn-primary" style="color: #fff;">닫기</a>--}}
{{--          </div>--}}
{{--          <img src="//cloudfront.mo-zip.co.kr/mo-zip/images/event-footer.png" class="w-100">--}}
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="/js/swiper.min.js"></script>
  <script>
      function search(value) {
          if (!value) {
              $("#searchresult").html("      <div class=\"searchresultitem-title\">핫스팟</div>\n" +
                  "                          <div class=\"searchresultitem-items\">\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '경기', '가평군');\">가평</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '제주특별자치도', '서귀포시');\">서귀포</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '제주특별자치도', '제주시');\">제주</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '전남', '여수시');\">여수</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '충남', '태안군');\">태안</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '강원', '양양군');\">양양</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '경남', '거제시');\">거제</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '경북', '경주시');\">경주</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '강원', '강릉시');\">강릉</div>\n" +
                  "                            </div>\n" +
                  "                            <div class=\"searchresultitem-item\">\n" +
                  "                              <div onclick=\"goPostPage('community', '모텔', '0', '강원', '평창군');\">평창</div>\n" +
                  "                            </div>\n" +
                  "                          </div>");


              // $("#searchresult").html("      <div class=\"searchresultitem-title\">핫스팟</div>\n" +
              //     "                          <div class=\"searchresultitem-items\">\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '노원구');\">노원</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '성북구');\">수유</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '성동구');\">왕십리</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '광진구');\">건대</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '송파구');\">잠실</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '강남구');\">강남</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '강동구');\">천호</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '서대문구');\">신촌</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '중구');\">종로</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '서울', '관악구');\">신림</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '경기', '부천시');\">부천</div>\n" +
              //     "                            </div>\n" +
              //     "                            <div class=\"searchresultitem-item\">\n" +
              //     "                              <div onclick=\"goPostPage('community', '모텔', '0', '인천', '부평시');\">인천</div>\n" +
              //     "                            </div>\n" +
              //     "                          </div>");
          } else {
              $.ajax({
                  url: '/search',
                  type: "get",
                  dataType: "json",
                  data: {
                      "query": value
                  },
              }).done(function (response) {
                  $("#searchresult").html(response.datas);
              });
          }
      }

      function goPostPage(url, type, idx, sido, sigungu) {
          sessionStorage.setItem('type', type);
          sessionStorage.setItem('idx', idx);
          sessionStorage.setItem('sido', sido);
          sessionStorage.setItem('sigungu', sigungu);

          // name이 paging인 태그
          var f = document.paging;

          // form 태그의 하위 태그 값 매개 변수로 대입
          f.url.value = url;
          f.type.value = type;
          f.idx.value = idx;
          f.sido.value = sido;
          f.sigungu.value = sigungu;

          // input태그의 값들을 전송하는 주소
          f.action = "/" + url;

          // 전송 방식 : post
          f.method = "post"
          f.submit();
      }

      function searchShow() {
          $("#search").show();
      }

      function searchHide() {
          setTimeout(function () {
              $("#search").hide();
          }, 500);
      }

      var swiper = new Swiper('.swiper-container', {
          navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
          },
          breakpoints: {
              0 :{
                  slidesPerView: 1.2,
                  spaceBetween: 10
              },
              // when window width is >= 320px
              600: {
                  slidesPerView: 1.2,
                  spaceBetween: 10
              },
              // when window width is >= 480px
              800: {
                  slidesPerView: 2.2,
                  spaceBetween: 10
              },
              // when window width is >= 640px
              1000: {
                  slidesPerView: 3.2,
                  spaceBetween: 10
              }
          },
          freeMode: true,
          pagination: {
              el: '.swiper-pagination',
              clickable: true,
          },
      });
  </script>
@endsection
